/* **************************************************************************************
	Post Type Portfolio  meta options Display as per Project Type
************************************************************************************** */

(function ($) {	$(document).ready(function(){

	// meta boxes
	var project_video = $( '#swm_portfolio_video_meta_section' );		

	function metabox_portfolio_project_dropdown() {
		var project_type = $( '#swm_portfolio_project_type' ).val();

		// remove by default		
		project_video.hide();		

		if ( project_type === 'Video') {			
			project_video.show();
		}		
	}
	// Fire the function immediately
	metabox_portfolio_project_dropdown();
	$( '#swm_portfolio_project_type' ).on( 'change', metabox_portfolio_project_dropdown );

	/* Sort Portfolio Items ------------------------------------------------------ */

	function swm_sort_custom_post_items() {
	    var swm_item_list = $('#swm_sort_items');
	    
	    swm_item_list.sortable({
	        update: function(event, ui) {
	            
	        var my_options = {
	                url: ajaxurl,
	                type: 'POST',
	                async: true,
	                cache: false,
	                dataType: 'json',
	                data:{
	                    action: 'swm_sort_order',
	                    order: swm_item_list.sortable('toArray').toString()
	                },
	                success: function(response) {
	                    return;
	                },
	                error: function(xhr,textStatus,e) {
	                    alert('There was an error saving the update.');
	                    return;
	                }
	            };
	            $.ajax(my_options);
	        }
	    });
	}

	swm_sort_custom_post_items();


}); })(jQuery);