<?php

// load wordpress
require_once('get_wp.php');

class swm_shortcodes
{
	var	$conf;
	var	$popup;
	var	$params;
	var	$shortcode;
	var $cparams;
	var $cshortcode;
	var $popup_title;
	var $no_preview;
	var $has_child;
	var	$output;
	var	$errors;

	// --------------------------------------------------------------------------

	function __construct( $popup ) {
		
		if( file_exists( dirname(__FILE__) . '/config.php' ) )
		{
			$this->conf = dirname(__FILE__) . '/config.php';
			$this->popup = $popup;
			
			$this->formate_shortcode();
		}
		else
		{
			$this->append_error('Config file does not exist');
		}
	}
	
	// --------------------------------------------------------------------------
	
	function formate_shortcode() 
	{
		
		// get config file
		require_once( $this->conf );
		
		if( isset( $swm_shortcodes[$this->popup]['child_shortcode'] ) )
			$this->has_child = true;
		
		if( isset( $swm_shortcodes ) && is_array( $swm_shortcodes ) ) {
			
			// get shortcode config stuff
			$this->params = $swm_shortcodes[$this->popup]['params'];
			$this->shortcode = $swm_shortcodes[$this->popup]['shortcode'];
			$this->popup_title = $swm_shortcodes[$this->popup]['popup_title'];
			
			// adds stuff for js use			
			$this->append_output( "\n" . '<div id="_swm_shortcode" class="hidden">' . $this->shortcode . '</div>' );
			$this->append_output( "\n" . '<div id="_swm_popup" class="hidden">' . $this->popup . '</div>' );
			
			if( isset( $swm_shortcodes[$this->popup]['no_preview'] ) && $swm_shortcodes[$this->popup]['no_preview'] ) {
				
				//$this->append_output( "\n" . '<div id="_swm_preview" class="hidden">false</div>' );
				$this->no_preview = true;		
			}
			
			// filters and excutes params
			foreach( $this->params as $pkey => $param ) {
				
				// prefix the fields names and ids with swm_
				$pkey = 'swm_' . $pkey;

				if(!isset($param['std'])) {
					$param['std'] = '';
				}

				if(!isset($param['desc'])) {
					$param['desc'] = '';
				}
				
				// popup form row start
				$row_start  = '<tbody class="'.$param['type'].'">' . "\n";
				$row_start .= '<tr class="form-row">' . "\n";
				$row_start .= '<td class="label">' . $param['label'] . ':</td>' . "\n";
				$row_start .= '<td class="field">' . "\n";
				
				// popup form row end
				$row_end	= '<span class="swm-form-desc">' . $param['desc'] . '</span>' . "\n";
				$row_end   .= '</td>' . "\n";
				$row_end   .= '</tr>' . "\n";					
				$row_end   .= '</tbody>' . "\n";
				
				switch( $param['type'] ) {
					
					case 'text' :
						
						// prepare
						$output  = $row_start;
						$output .= '<input type="text" class="swm-form-text swm-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'color' :
						
						// prepare
						$output  = $row_start;
						$output .= '<input type="text" class="swm-form-text swm-input wp-color-picker-field" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;

					case 'upload' :

						// prepare
						$output  = $row_start;
						$output .= '<div class="swm-upload-container">';
						$output .= '<img src="" alt="Image" class="uploaded-image" />';
						$output .= '<input type="hidden" class="swm-form-text swm-form-upload swm-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= '<a href="' . $pkey . '" class="swm-upload-button" data-upid="1"><i class="fa fa-arrow-up" ></i>Upload</a>';
						$output .= '</div>';
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					case 'fonticon' :

						// prepare
						$output  = $row_start;

						$output .= '<div class="fonticon">';
						foreach( $param['options'] as $value => $option ) {
							$output .= '<i class="fa ' . $value . '" data-icon="' . $value . '"></i>';
						}
						$output .= '</div>';

						if(!isset($param['std'])) {
							$param['std'] = '';
						}

						$output .= '<input type="hidden" class="swm-form-text swm-input" name="' . $pkey . '" id="' . $pkey . '" value="' . $param['std'] . '" />' . "\n";
						$output .= $row_end;

						// append
						$this->append_output( $output );

						break;

					case 'textarea' :
						
						// prepare
						$output  = $row_start;
						$output .= '<textarea rows="5" cols="60" name="' . $pkey . '" id="' . $pkey . '" class="swm-form-textarea swm-input">' . $param['std'] . '</textarea>' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'select' :
						
						// prepare
						$output  = $row_start;
						$output .= '<select name="' . $pkey . '" id="' . $pkey . '" class="swm-form-select swm-input">' . "\n";
						
						foreach( $param['options'] as $value => $option ) {
							
							$output .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
						}
						
						$output .= '</select>' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'checkbox' :
						
						// prepare
						$output  = $row_start;
						$output .= '<label for="' . $pkey . '" class="swm-form-checkbox">' . "\n";
						$output .= '<input type="checkbox" class="swm-input" name="' . $pkey . '" id="' . $pkey . '" ' . ( $param['std'] ? 'checked' : '' ) . ' />' . "\n";
						$output .= ' ' . $param['checkbox_text'] . '</label>' . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
						
					case 'infotext' :
						
						// prepare
						$output  = $row_start;
						$output .= $param['std'] . "\n";
						$output .= $row_end;
						
						// append
						$this->append_output( $output );
						
						break;
				}
			}
			
			// checks if has a child shortcode
			if( isset( $swm_shortcodes[$this->popup]['child_shortcode'] ) ) {
				
				// set child shortcode
				$this->cparams = $swm_shortcodes[$this->popup]['child_shortcode']['params'];
				$this->cshortcode = $swm_shortcodes[$this->popup]['child_shortcode']['shortcode'];
			
				// popup parent form row start
				$prow_start  = '<tbody>' . "\n";
				$prow_start .= '<tr class="form-row has-child">' . "\n";
				$prow_start .= '<td>';
				$prow_start .= '<div class="child-clone-rows">' . "\n";
				
				// for js use
				$prow_start .= '<div id="_swm_cshortcode" class="hidden">' . $this->cshortcode . '</div>' . "\n";
				
				// start the default row
				$prow_start .= '<div class="child-clone-row">' . "\n";
				$prow_start .= '<ul class="child-clone-row-form">' . "\n";
				
				// add $prow_start to output
				$this->append_output( $prow_start );
				
				foreach( $this->cparams as $cpkey => $cparam ) {
				
					// prefix the fields names and ids with swm_
					$cpkey = 'swm_' . $cpkey;

					if(!isset($cparam['std'])) {
						$cparam['std'] = '';
					}

					if(!isset($cparam['desc'])) {
						$cparam['desc'] = '';
					}
					
					// popup form row start
					$crow_start  = '<li class="child-clone-row-form-row">' . "\n";
					$crow_start .= '<div class="child-clone-row-label">' . "\n";
					$crow_start .= '<label>' . $cparam['label'] . ':</label>' . "\n";
					$crow_start .= '</div>' . "\n";
					$crow_start .= '<div class="child-clone-row-field">' . "\n";
					
					// popup form row end
					$crow_end	  = '<span class="child-clone-row-desc">' . $cparam['desc'] . '</span>' . "\n";
					$crow_end   .= '</div>' . "\n";
					$crow_end   .= '</li>' . "\n";
					
					switch( $cparam['type'] ) { 
					
						case 'text' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" class="swm-form-text swm-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;

						case 'color' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<input type="text" class="swm-form-text swm-cinput wp-color-picker-field" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;

						case 'upload' :

							if(!isset($cparam['std'])) {
								$cparam['std'] = '';
							}

							// prepare
							$coutput  = $crow_start;
							$coutput .= '<div class="swm-upload-container">';
							$coutput .= '<img src="" alt="Image" class="uploaded-image" />';
							$coutput .= '<input type="hidden" class="swm-form-text swm-form-upload swm-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= '<a href="' . $cpkey . '" class="swm-upload-button" data-upid="1">Upload</a>';
							$coutput .= '</div>';
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;

						case 'fonticon' :

							// prepare
							$coutput  = $crow_start;

							$coutput .= '<div class="fonticon">';
							foreach( $cparam['options'] as $value => $option ) {
								$coutput .= '<i class="fa ' . $value . '" data-icon="' . $value . '"></i>';
							}
							$coutput .= '</div>';

							$coutput .= '<input type="hidden" class="swm-form-text swm-cinput" name="' . $cpkey . '" id="' . $cpkey . '" value="' . $cparam['std'] . '" />' . "\n";
							$coutput .= $crow_end;

							// append
							$this->append_output( $coutput );

							break;
							
						case 'textarea' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<textarea rows="5" cols="60" name="' . $cpkey . '" id="' . $cpkey . '" class="swm-form-textarea swm-cinput">' . $cparam['std'] . '</textarea>' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;
							
						case 'select' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<select name="' . $cpkey . '" id="' . $cpkey . '" class="swm-form-select swm-cinput">' . "\n";
							
							foreach( $cparam['options'] as $value => $option )
							{
								$coutput .= '<option value="' . $value . '">' . $option . '</option>' . "\n";
							}
							
							$coutput .= '</select>' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;
							
						case 'checkbox' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= '<label for="' . $cpkey . '" class="swm-form-checkbox">' . "\n";
							$coutput .= '<input type="checkbox" class="swm-cinput" name="' . $cpkey . '" id="' . $cpkey . '" ' . ( $cparam['std'] ? 'checked' : '' ) . ' />' . "\n";
							$coutput .= ' ' . $cparam['checkbox_text'] . '</label>' . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;
							
							case 'infotext' :
							
							// prepare
							$coutput  = $crow_start;
							$coutput .= $cparam['std'] . "\n";
							$coutput .= $crow_end;
							
							// append
							$this->append_output( $coutput );
							
							break;
					}
				}
				
				// popup parent form row end
				$prow_end    = '</ul>' . "\n";		// end .child-clone-row-form
				$prow_end   .= '<a href="#" class="child-clone-row-remove"><i class="fa fa-times"></i> Remove</a>' . "\n";
				$prow_end   .= '<div class="clear"></div></div>' . "\n";		// end .child-clone-row				
				
				$prow_end   .= '</div>' . "\n";		// end .child-clone-rows
				$prow_end   .= '<a href="#" id="form-child-add" class="button-secondary"><i class="fa fa-plus"></i> ' . $swm_shortcodes[$this->popup]['child_shortcode']['clone_button'] . '</a>' . '</td>' . "\n";
				$prow_end   .= '</tr>' . "\n";					
				$prow_end   .= '</tbody>' . "\n";
				
				// add $prow_end to output
				$this->append_output( $prow_end );
			}			
		}
	}
	
	// --------------------------------------------------------------------------
	
	function append_output( $output ) {
		
		$this->output = $this->output . "\n" . $output;		
	}
	
	// --------------------------------------------------------------------------
	
	function reset_output( $output ) {
		
		$this->output = '';
	}
	
	// --------------------------------------------------------------------------
	
	function append_error( $error ) {
		
		$this->errors = $this->errors . "\n" . $error;
	}
}

?>