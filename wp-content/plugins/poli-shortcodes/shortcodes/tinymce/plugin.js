(function($) {
"use strict";
    
	tinymce.PluginManager.add( 'swmShortcodes', function( editor, url ) {
		
		editor.addCommand("swmPopup", function ( a, params )
		{
			var popup = params.identifier;
			tb_show("Shortcode", url + "/popup.php?popup=" + popup + "&width=" + 850);
		});

        editor.addButton( 'swm_button', {
            type: 'menubutton',
            icon: 'swmcustomicon',                    
			title:  'Shortcodes',					
			menu: 
			[
				{text: 'Column',
					menu: 
					[
						{text: '1/1',onclick:function(){
							editor.insertContent('[swm_one_full first] Add Content Here [/swm_one_full]');
						}},
						{text: '1/2 + 1/2',onclick:function(){
							editor.insertContent('[swm_one_half first] Add Content Here [/swm_one_half] <br /><br /> [swm_one_half] Add Content Here [/swm_one_half]');
						}},
						{text: '1/3 + 1/3 + 1/3',onclick:function(){
							editor.insertContent('[swm_one_third first] Add Content Here [/swm_one_third] <br /><br /> [swm_one_third] Add Content Here [/swm_one_third] <br /><br /> [swm_one_third] Add Content Here [/swm_one_third]');
						}},
						{text: '1/3 + 2/3',onclick:function(){
							editor.insertContent('[swm_one_third first] Add Content Here [/swm_one_third] <br /><br /> [swm_two_third] Add Content Here [/swm_two_third]');
						}},
						{text: '1/4 + 1/4 + 1/4 + 1/4',onclick:function(){
							editor.insertContent('[swm_one_fourth first] Add Content Here [/swm_one_fourth] <br /><br /> [swm_one_fourth] Add Content Here [/swm_one_fourth] <br /><br /> [swm_one_fourth] Add Content Here [/swm_one_fourth] <br /><br /> [swm_one_fourth] Add Content Here [/swm_one_fourth]');
						}},
						{text: '1/4 + 3/4',onclick:function(){
							editor.insertContent('[swm_one_fourth first] Add Content Here [/swm_one_fourth] <br /><br /> [swm_three_fourth] Add Content Here [/swm_three_fourth]');
						}},
						{text: '1/5 + 1/5 + 1/5 + 1/5 + 1/5',onclick:function(){
							editor.insertContent('[swm_one_fifth first] Add Content Here [/swm_one_fifth] <br /><br /> [swm_one_fifth] Add Content Here [/swm_one_fifth]  <br /><br /> [swm_one_fifth] Add Content Here [/swm_one_fifth]  <br /><br /> [swm_one_fifth] Add Content Here [/swm_one_fifth]  <br /><br /> [swm_one_fifth] Add Content Here [/swm_one_fifth]');
						}},
						{text: '1/5 + 4/5',onclick:function(){
							editor.insertContent('[swm_one_fifth first] Add Content Here [/swm_one_fifth] <br /><br /> [swm_one_fourth_fifth] Add Content Here [/swm_one_fourth_fifth]');
						}},
						{text: '1/6 + 1/6 + 1/6 + 1/6 + 1/6 + 1/6',onclick:function(){
							editor.insertContent('[swm_one_sixth first] Add Content Here [/swm_one_sixth] <br /><br /> [swm_one_sixth] Add Content Here [/swm_one_sixth]  <br /><br /> [swm_one_sixth] Add Content Here [/swm_one_sixth]  <br /><br /> [swm_one_sixth] Add Content Here [/swm_one_sixth]  <br /><br /> [swm_one_sixth] Add Content Here [/swm_one_sixth]  <br /><br /> [swm_one_sixth] Add Content Here [/swm_one_sixth]');
						}},						
						{text: '1/6 + 5/6',onclick:function(){
							editor.insertContent('[swm_one_sixth first] Add Content Here [/swm_one_sixth] <br /><br /> [swm_five_sixth] Add Content Here [/swm_five_sixth]');
						}}											
					]
				},

				{text: 'Common Elements',
					menu: 
					[                    	
                    	{text: 'Animated Colulmns',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Animated Colulmns',identifier: 'animatedcolumn'})
						}},
                    	{text: 'Block Quote',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Block Quote',identifier: 'blockquote'})
						}},
                    	{text: 'Button',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Button',identifier: 'button'})
						}},	
						{text: 'Dropcaps',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Dropcaps',identifier: 'dropcaps'})
						}},
						{text: 'Font',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Font',identifier: 'font'})
						}},
						{text: 'Gap',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Gap',identifier: 'gap'})
						}},					
						{text: 'Google Map',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Google Map',identifier: 'googlemap'})
						}},						
						{text: 'Horizontal Menu',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Horizontal Menu',identifier: 'horizontalmenu'})
						}},
						{text: 'Icon',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Icon',identifier: 'icon'})
						}},						
						{text: 'Promo Box',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Promo Box',identifier: 'promotionbox'})
						}},											
						{text: 'Pull Quote',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Pull Quote',identifier: 'pullquote'})
						}},						
						{text: 'Tabs',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Tabs',identifier: 'tabs'})
						}},
						{text: 'Toggle Accordion',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Toggle Accordion',identifier: 'toggleaccordion'})
						}},
						{text: 'Toggle Simple',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Toggle Simple',identifier: 'toggle'})
						}},
						{text: 'Tooltip',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Tooltip',identifier: 'tooltip'})
						}},
						{text: 'Video',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Video',identifier: 'video'})
						}},
						{text: 'Warning Box',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Warning Box',identifier: 'infoboxes'})
						}}
						
	                ]
				},			

				{text: 'Counters and Bars',
					menu: 
					[
						{text: 'Counter Boxes',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Counter Boxes',identifier: 'counterboxes'})
						}},
						{text: 'Counter Circles',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Counter Circles',identifier: 'countercircles'})
						}},
						{text: 'Progress Bars',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Progress Bars',identifier: 'progressbars'})
						}}
					]
				},
				{text: 'Full Width Section',onclick:function(){
					editor.execCommand("swmPopup", false, {title: 'Full Width Section',identifier: 'fullwidthsection'})
				}},									
				
				{text: 'List Styles',
					menu: 
					[
						{text: 'Icons List',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Icons List',identifier: 'iconlist'})
						}},
						{text: 'Ordered List',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Ordered List',identifier: 'textlist'})
						}}						
					]
				},

				{text: 'Image',onclick:function(){
					editor.execCommand("swmPopup", false, {title: 'Image',identifier: 'image'})
				}},
				{text: 'Pricing Table',onclick:function(){
					editor.execCommand("swmPopup", false, {title: 'Pricing Table',identifier: 'tables'})
				}},			

				{text: 'Recent Posts',
					menu: 
					[
						{text: 'Recent Posts Full',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Recent Posts Full',identifier: 'recentpostsfull'})
						}},
						{text: 'Recent Posts Tiny',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Recent Posts Tiny',identifier: 'recentpoststiny'})
						}},
						{text: 'Recent Posts Square Style',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Recent Posts Square Style',identifier: 'recentpostssquare'})
						}}				
					]
				},					

				{text: 'Sliders',
					menu: 
					[	
						{text: 'Image Slider',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Image Slider',identifier: 'imageslider'})
						}},						
						{text: 'Testimonials Slider',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Testimonials Slider',identifier: 'testimonialsslider'})
						}}						
					]
				},				

				{text: 'Social Media Icons',onclick:function(){
					editor.execCommand("swmPopup", false, {title: 'Social Media Icons',identifier: 'socialmedia'})
				}},

				{text: 'Testimonials',onclick:function(){
					editor.execCommand("swmPopup", false, {title: 'Testimonials',identifier: 'testimonials'})
				}},

				{text: 'Team Members',
					menu: 
					[
						{text: 'Team Member with Description',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Team Member with Description',identifier: 'teammember'})
						}},
						{text: 'Team Member with Short Details',onclick:function(){
							editor.execCommand("swmPopup", false, {title: 'Team Member with Short Details',identifier: 'supportteam'})
						}}
					]
				},
				
				{text: 'Upcoming Events',onclick:function(){
					editor.execCommand("swmPopup", false, {title: 'Upcoming Events',identifier: 'upcomingevents'})
				}}	
			
			]			
        
	  });
 
	});
 
})(jQuery);
