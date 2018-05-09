<?php
/*
Plugin Name: Sidebar Generator
Plugin URI: http://www.getson.info
Description: This plugin generates as many sidebars as you need. Then allows you to place them on any page you wish. Version 1.1 now supports themes with multiple sidebars. 
Version: 50.2
Author: Kyle Getson
Author URI: http://www.kylegetson.com
Copyright (C) 2009 Kyle Robert Getson
*/

/*
Copyright (C) 2009 Kyle Robert Getson, kylegetson.com and getson.info

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

class swm_sidebar_generator {
	
	public function __construct() {

		add_action('init',array(&$this,'init'));
		add_action('admin_menu',array(&$this,'swm_admin_menu'));
		add_action('admin_print_scripts', array(&$this,'swm_admin_print_scripts'));

			
		//edit posts/pages
		add_action('edit_form_advanced', array(&$this, 'swm_edit_form'));
		add_action('edit_page_form', array(&$this, 'swm_edit_form'));
		
		//save posts/pages
		add_action('edit_post', array(&$this, 'swm_save_form'));
		add_action('publish_post', array(&$this, 'swm_save_form'));
		add_action('save_post', array(&$this, 'swm_save_form'));
		add_action('edit_page_form', array(&$this, 'swm_save_form'));
	}
	
	function init(){
		
		// Register AJAX hooks
		if (current_user_can('manage_options')){	
			add_action('wp_ajax_swm_add_sidebar', array(&$this,'swm_add_sidebar') );
			add_action('wp_ajax_swm_remove_sidebar', array(&$this,'swm_remove_sidebar') );
		}

		//go through each sidebar and register it
	    $swm_sidebars = self::get_sidebars();
	    $swm_multiple_sidebar_id = 100;	    

	    if(is_array($swm_sidebars)){
			foreach($swm_sidebars as $sidebar){
				$swm_sidebar_class = self::name_to_class($sidebar);

				$swm_register_sidebar_array = array(
					'name'=>$sidebar,
					'id'=>'dynamicsidebar-'.$swm_multiple_sidebar_id					
		    	);

		    	$swm_multiple_sidebar_after_before_elements = self::swm_multiple_sidebar_after_before();

		    	$swm_register_sidebar_array_total = array_merge($swm_register_sidebar_array,$swm_multiple_sidebar_after_before_elements);

				register_sidebar($swm_register_sidebar_array_total);

		    	$swm_multiple_sidebar_id++;
			}
		}
	}

	function swm_multiple_sidebar_after_before(){
		
		$swm_multiple_sidebar_after_before = array(
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="swm_widget_box">',
			'after_widget' => '<div class="clear"></div></div></div>',
			'before_title' => '<h3>',
			'after_title' => '</h3><div class="clear"></div>'
		);
		
		return apply_filters( 'swm_multiple_sidebar_after_before', $swm_multiple_sidebar_after_before );

	}
		
	function swm_admin_print_scripts(){
		wp_print_scripts( array( 'sack' ));
		?>
			<script>
				function swm_add_sidebar( sidebar_name )
				{					
					var swm_sack = new sack("<?php echo esc_url(site_url()); ?>/wp-admin/admin-ajax.php" );    
				
				  	swm_sack.execute = 1;
				  	swm_sack.method = 'POST';
				  	swm_sack.setVar( "action", "swm_add_sidebar" );
				  	swm_sack.setVar( "sidebar_name", sidebar_name );
				  	swm_sack.encVar( "cookie", document.cookie, false );
				  	swm_sack.onError = function() { alert('Ajax error. Cannot add sidebar' )};
				  	swm_sack.runAJAX();
					return true;
				}
				
				function swm_remove_sidebar( sidebar_name,num )
				{					
					var swm_sack = new sack("<?php echo esc_url(site_url()); ?>/wp-admin/admin-ajax.php" );    
				
				  	swm_sack.execute = 1;
				  	swm_sack.method = 'POST';
				  	swm_sack.setVar( "action", "swm_remove_sidebar" );
				  	swm_sack.setVar( "sidebar_name", sidebar_name );
				  	swm_sack.setVar( "row_number", num );
				  	swm_sack.encVar( "cookie", document.cookie, false );
				  	swm_sack.onError = function() { alert('Ajax error. Cannot add sidebar' )};
				  	swm_sack.runAJAX();					
					return true;
				}
			</script>
		<?php
	}
	
	function swm_add_sidebar(){
		$swm_sidebars = self::get_sidebars();
		$swm_sidebar_name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']);
		$swm_sidebar_id = self::name_to_class($swm_sidebar_name);
		if(isset($swm_sidebars[$swm_sidebar_id])){
			die("alert('Sidebar already exists, please use a different name.')");
		}
		
		$swm_sidebars[$swm_sidebar_id] = $swm_sidebar_name;
		self::update_sidebars($swm_sidebars);
		
		$swm_add_sidebar_js = "
			var tbl = document.getElementById('sbg_table');
			var lastRow = tbl.rows.length;
			// if there's no header row in the table, then iteration = lastRow + 1
			var iteration = lastRow;
			var row = tbl.insertRow(lastRow);
			
			// left cell
			var cellLeft = row.insertCell(0);
			var textNode = document.createTextNode('$swm_sidebar_name');
			cellLeft.appendChild(textNode);
			
			//middle cell
			var cellLeft = row.insertCell(1);
			var textNode = document.createTextNode('$swm_sidebar_id');
			cellLeft.appendChild(textNode);
			
			//var cellLeft = row.insertCell(2);
			//var textNode = document.createTextNode('[<a href=\'javascript:void(0);\' onclick=\'return swm_remove_sidebar_link($swm_sidebar_name);\'>Remove</a>]');
			//cellLeft.appendChild(textNode)
			
			var cellLeft = row.insertCell(2);
			removeLink = document.createElement('a');
      		linkText = document.createTextNode('remove');
			removeLink.setAttribute('onclick', 'swm_remove_sidebar_link(\'$swm_sidebar_name\')');
			removeLink.setAttribute('href', 'javascript:void(0)');
        
      		removeLink.appendChild(linkText);
      		cellLeft.appendChild(removeLink);			
		";
		
		die( "$swm_add_sidebar_js");
	}
	
	function swm_remove_sidebar(){
		$swm_sidebars = self::get_sidebars();
		$swm_sidebar_name = str_replace(array("\n","\r","\t"),'',$_POST['sidebar_name']);
		$swm_sidebar_id = self::name_to_class($swm_sidebar_name);
		if(!isset($swm_sidebars[$swm_sidebar_id])){
			die("alert('Sidebar does not exist.')");
		}
		$swm_sidebar_row_number = $_POST['row_number'];
		unset($swm_sidebars[$swm_sidebar_id]);
		self::update_sidebars($swm_sidebars);
		$swm_remove_sidebar_js = "
			var tbl = document.getElementById('sbg_table');
			tbl.deleteRow($swm_sidebar_row_number)
		";
		die($swm_remove_sidebar_js);
	}
	
	function swm_admin_menu(){
		add_theme_page('Sidebars', esc_html__('Multiple Sidebars', '__yoga-site-shortcodes__'), 'manage_options', 'multiple_sidebars', array('swm_sidebar_generator','swm_admin_page'));		
}
	
	public static function swm_admin_page(){
		?>
		<script>
			function swm_remove_sidebar_link(name,num){
				answer = confirm("Are you sure you want to remove " + name + "?\nThis will remove any widgets you have assigned to this sidebar.");
				if(answer){
					//alert('AJAX REMOVE');
					swm_remove_sidebar(name,num);
				}else{
					return false;
				}
			}
			function swm_add_sidebar_link(){
				var swm_sidebar_name = prompt("Sidebar Name:","");
				//alert(swm_sidebar_name);
				swm_add_sidebar(swm_sidebar_name);
			}
		</script>
		<div class="wrap">
			<h2>Multiple Sidebars</h2>
			<br />
			<table class="widefat page" id="sbg_table" style="width:600px;">
				<tr>
					<th>Sidebar Name</th>
					<th>CSS class</th>
					<th>Remove</th>
				</tr>
				<?php
				$swm_sidebars = self::get_sidebars();
				//$swm_sidebars = array('bob','john','mike','asdf');
				if(is_array($swm_sidebars) && !empty($swm_sidebars)){
					$swm_sidebar_counter=0;
					foreach($swm_sidebars as $sidebar){
						$swm_sidebar_alt = ($swm_sidebar_counter%2 == 0 ? 'alternate' : '');
				?>
				<tr class="<?php echo esc_attr($swm_sidebar_alt);?>">
					<td><?php echo esc_html($sidebar); ?></td>
					<td><?php echo esc_html(self::name_to_class($sidebar)); ?></td>
					<td><a href="javascript:void(0);" onclick="return swm_remove_sidebar_link('<?php echo esc_attr($sidebar); ?>',<?php echo $swm_sidebar_counter+1; ?>);" title="Remove this sidebar"><?php echo esc_html__('remove', '__yoga-site-shortcodes__'); ?></a></td>
				</tr>
				<?php
						$swm_sidebar_counter++;
					}
				}else{
					?>
					<tr>
						<td colspan="3"><?php esc_html_e('No Sidebars defined', '__yoga-site-shortcodes__') ?></td>
					</tr>
					<?php
				}
				?>
			</table><br /><br />
            <div class="swm_add_sidebar">
				<a href="javascript:void(0);" onclick="return swm_add_sidebar_link()" title="Add a sidebar" class="button-primary"><?php esc_html_e('+ Add Sidebar', '__yoga-site-shortcodes__') ?></a>

			</div>
			
		</div>
		<?php
	}
	
	/*for saving the pages/post */
	public static function swm_save_form($post_id){
		if (isset($_POST['sbg_edit'])) { 
			$swm_sidebar_is_saving = $_POST['sbg_edit'];
			if(!empty($swm_sidebar_is_saving)){
				delete_post_meta($post_id, 'sbg_selected_sidebar');
				delete_post_meta($post_id, 'sbg_selected_sidebar_replacement');
				add_post_meta($post_id, 'sbg_selected_sidebar', $_POST['swm_sidebar_generator']);
				add_post_meta($post_id, 'sbg_selected_sidebar_replacement', $_POST['swm_sidebar_generator_replacement']);
			}
		}

	}
	
	public static function swm_edit_form(){
	    global $post;
	    $post_id = $post;
	    if (is_object($post_id)) {
	    	$post_id = $post_id->ID;
	    }
	    $swm_selected_sidebar = get_post_meta($post_id, 'sbg_selected_sidebar', true);
	    if(!is_array($swm_selected_sidebar)){
	    	$swm_tmp_sidebar = $swm_selected_sidebar; 
	    	$swm_selected_sidebar = array(); 
	    	$swm_selected_sidebar[0] = $swm_tmp_sidebar;
	    }
	    $swm_selected_sidebar_replacement = get_post_meta($post_id, 'sbg_selected_sidebar_replacement', true);
		if(!is_array($swm_selected_sidebar_replacement)){
	    	$swm_tmp_sidebar = $swm_selected_sidebar_replacement; 
	    	$swm_selected_sidebar_replacement = array(); 
	    	$swm_selected_sidebar_replacement[0] = $swm_tmp_sidebar;
	    }
		?>
	 
	<div id='sbg-sortables' class='meta-box-sortables'>
		<div id="sbg_box" class="postbox " >
			<div class="handlediv" title="Click to toggle"><br /></div><h3 class='hndle'><span>Sidebar</span></h3>
			<div class="inside">
				<div class="sbg_container">
					<input name="sbg_edit" type="hidden" value="sbg_edit" />
					
					<p><?php esc_html_e('Please select the sidebar you would like to display on this page. Default sidebar is "Blog Sidebar". Note: You must first create the sidebar under Appearance > Multiple Sidebars.', '__yoga-site-shortcodes__') ?></p>
					<ul>
					<?php 
					global $wp_registered_sidebars;
					//var_dump($wp_registered_sidebars);		
						for($i=0;$i<1;$i++){ ?>
							<li>
							<select name="swm_sidebar_generator[<?php echo $i?>]" style="display: none;">
								<option value="0"<?php if($swm_selected_sidebar[$i] == ''){ echo " selected";} ?>>Default Sidebar</option>
							<?php
							$swm_sidebars = $wp_registered_sidebars;// swm_sidebar_generator::get_sidebars();
							if(is_array($swm_sidebars) && !empty($swm_sidebars)){
								foreach($swm_sidebars as $sidebar){

									$swm_get_sidebar_name = esc_attr($sidebar['name']);

									if($swm_selected_sidebar[$i] == $swm_get_sidebar_name){
										echo "<option value='{$swm_get_sidebar_name}' selected>{$swm_get_sidebar_name}</option>\n";
									}else{
										echo "<option value='{$swm_get_sidebar_name}'>{$swm_get_sidebar_name}</option>\n";
									}
								}
							}
							?>
							</select>
							<select name="swm_sidebar_generator_replacement[<?php echo $i?>]">
								<option value="0"<?php if($swm_selected_sidebar_replacement[$i] == ''){ echo " selected";} ?>><?php esc_html_e('Default Sidebar', '__yoga-site-shortcodes__') ?></option>
							<?php
							
							$swm_sidebar_replacements = $wp_registered_sidebars;//swm_sidebar_generator::get_sidebars();
							if(is_array($swm_sidebar_replacements) && !empty($swm_sidebar_replacements)){
								foreach($swm_sidebar_replacements as $sidebar){

									$swm_get_sidebar_name = esc_attr($sidebar['name']);
									
									if($swm_selected_sidebar_replacement[$i] == $swm_get_sidebar_name){
										echo "<option value='{$swm_get_sidebar_name}' selected>{$swm_get_sidebar_name}</option>\n";
									}else{
										echo "<option value='{$swm_get_sidebar_name}'>{$swm_get_sidebar_name}</option>\n";
									}
								}
							}
							?>
							</select> 
							
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

		<?php
	}
	
	/* called by the action get_sidebar. this is what places this into the theme */
	public static function get_sidebar($name="0"){
		if(!is_singular()){
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
			return;//dont do anything
		}
		global $wp_query;
		$post = $wp_query->get_queried_object();
		$swm_selected_sidebar = get_post_meta($post->ID, 'sbg_selected_sidebar', true);
		$swm_selected_sidebar_replacement = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
		$swm_did_sidebar = false;
		//this page uses a generated sidebar
		if($swm_selected_sidebar != '' && $swm_selected_sidebar != "0"){
			echo "";
			if(is_array($swm_selected_sidebar) && !empty($swm_selected_sidebar)){
				for($i=0;$i<sizeof($swm_selected_sidebar);$i++){					
					
					if($name == "0" && $swm_selected_sidebar[$i] == "0" &&  $swm_selected_sidebar_replacement[$i] == "0"){
						//echo "\n\n<!-- [called $name selected {$swm_selected_sidebar[$i]} replacement {$swm_selected_sidebar_replacement[$i]}] -->";
						dynamic_sidebar('blog-sidebar');//default behavior #########custom changes#########
						$swm_did_sidebar = true;
						break;
					}elseif($name == "0" && $swm_selected_sidebar[$i] == "0"){
						//we are replacing the default sidebar with something
						//echo "\n\n<!-- [called $name selected {$swm_selected_sidebar[$i]} replacement {$swm_selected_sidebar_replacement[$i]}] -->";
						dynamic_sidebar($swm_selected_sidebar_replacement[$i]);//default behavior
						$swm_did_sidebar = true;
						break;
					}elseif($swm_selected_sidebar[$i] == $name){
						//we are replacing this $name
						//echo "\n\n<!-- [called $name selected {$swm_selected_sidebar[$i]} replacement {$swm_selected_sidebar_replacement[$i]}] -->";
						$swm_did_sidebar = true;
						dynamic_sidebar($swm_selected_sidebar_replacement[$i]);//default behavior
						break;
					}
					//echo "<!-- called=$name selected={$swm_selected_sidebar[$i]} replacement={$swm_selected_sidebar_replacement[$i]} -->\n";
				}
			}
			if($swm_did_sidebar == true){
				echo "";
				return;
			}
			//go through without finding any replacements, lets just send them what they asked for
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
			echo "";
			return;			
		}else{
			if($name != "0"){
				dynamic_sidebar($name);
			}else{
				dynamic_sidebar();
			}
		}
	}
	
	/* replaces array of sidebar names*/
	public static function update_sidebars($sidebar_array){
		$swm_sidebars = update_option('sbg_sidebars',$sidebar_array);
	}	
	
	/* gets the generated sidebars */
	public static function get_sidebars(){
		$swm_sidebars = get_option('sbg_sidebars');
		return $swm_sidebars;
	}
	public static function name_to_class($name){
		$class = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name);
		return $class;
	}
	
}

new swm_sidebar_generator();

function swm_generated_dynamic_sidebar($id='0'){
	swm_sidebar_generator::get_sidebar($id);	
	return true;
}
