<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new swm_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>
<div id="swm-popup">

	<div id="swm-shortcode-wrap">
		
		<div id="swm-sc-form-wrap">
		
			<div id="swm-sc-form-head">
			
				<?php echo $shortcode->popup_title; ?>
			
			</div>
			<!-- /#swm-sc-form-head -->
			
			<form method="post" id="swm-sc-form">
			
				<table id="swm-sc-form-table">
				
					<?php echo $shortcode->output; ?>
					
					<tbody>
						<tr class="form-row">
							<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
							<td class="field"><a href="#" class="button button-primary swm-insert button-large "><?php _e('Insert Shortcode', '__poli-shortcodes__') ?></a></td>							
						</tr>
					</tbody>
				
				</table>
				<!-- /#swm-sc-form-table -->
				
			</form>
			<!-- /#swm-sc-form -->
		
		</div>
		<!-- /#swm-sc-form-wrap -->		
		
		<div class="clear"></div>
		
	</div>
	<!-- /#swm-shortcode-wrap -->

</div>
<!-- /#swm-popup -->

</body>
</html>