<?php

$swm_sample_image = plugin_dir_url( __FILE__ ) . 'images/';
$swm_google_map_sample = $swm_sample_image . 'google_map_link.jpg';
$swm_google_map_img = '<img src="'.$swm_google_map_sample.'" alt="Google map screenshot" />';

function swm_one_to_final_number ( $final_number, $all = true, $default = false, $start_number = 1 ) {
	if($all) {
		$count_number['-1'] = 'All';
	}

	if($default) {
		$count_number[''] = 'Default';
	}

	foreach(range($start_number, $final_number) as $number) {
		$count_number[$number] = $number;
	}

	return $count_number;
}

// Fontawesome icons list
$fontAwesomeFile = '';
$fontStyleCode = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$fontAwesomeFilePath = SWM_PLUGIN_DIR . 'fonts/font-awesome.css';

if ( file_exists($fontAwesomeFilePath) ) {	
	$fontAwesomeFile = file_get_contents($fontAwesomeFilePath);
}

preg_match_all($fontStyleCode,$fontAwesomeFile, $matches, PREG_SET_ORDER);

$font_icons = array();

foreach($matches as $match){
	$font_icons[$match[1]] = $match[2];
}

$column_position = array(
	'type' => 'select',
	'label' => __('Column Position', '__poli-shortcodes__'),
	'desc' => __('Select "First" if this column is first ( left column )', '__poli-shortcodes__'),
	'options' => array(
	'other' => '',
	'first' => __('First Column', '__poli-shortcodes__')						
	)
);


/* ************************************************************************************** 
     COLUMNS
************************************************************************************** */

$swm_shortcodes['animatedcolumn'] = array(
	'params' => array(),
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __('Columns', '__poli-shortcodes__'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Column Width', '__poli-shortcodes__'),
				'desc' => __('Select the width of the column.', '__poli-shortcodes__'),
				'options' => array(
					'swm_one_third' => __('One Third', '__poli-shortcodes__'),					
					'swm_two_third' => __('Two Third', '__poli-shortcodes__'),					
					'swm_one_half' => __('One Half', '__poli-shortcodes__'),					
					'swm_one_fourth' => __('One Fourth', '__poli-shortcodes__'),					
					'swm_three_fourth' => __('Three Fourth', '__poli-shortcodes__'),
					'swm_one_fifth' => __('One Fifth', '__poli-shortcodes__'),					
					'swm_four_fifth' => __('Four Fifth', '__poli-shortcodes__'),					
					'swm_one_sixth' => __('One Sixth', '__poli-shortcodes__'),					
					'swm_five_sixth' => __('Five Sixth', '__poli-shortcodes__'),					
				)
			),
			'position' => array(
				'type' => 'select',
				'label' => __('Column Position', '__poli-shortcodes__'),
				'desc' => __('If this is first column in row then select "First" from above dropdown menu.', '__poli-shortcodes__'),
				'options' => array(
					'other' => __('Other', '__poli-shortcodes__'),					
					'first' => __('First', '__poli-shortcodes__')										
				)
			),
			'animation_style' => array(
				'type' => 'select',
				'label' => __('Animation Style', '__poli-shortcodes__'),
				'desc' => __('Select column animation style', '__poli-shortcodes__'),
				'options' => array(
					'none' => __('None', '__poli-shortcodes__'),
					'move_left_to_right' => __('Move Left to Right', '__poli-shortcodes__'),					
					'move_right_to_left' => __('Move Right to Left', '__poli-shortcodes__'),					
					'move_top_to_bottom' => __('Move Top to Bottom', '__poli-shortcodes__'),					
					'move_bottom_to_top' => __('Move Bottom to Top', '__poli-shortcodes__'),					
					'swm_center_expand' => __('Expand from Center', '__poli-shortcodes__')									
				)
			),
			'content' => array(
				'std' => 'Add colulmn content here',
				'type' => 'textarea',
				'label' => __('Column Content', '__poli-shortcodes__'),
				'desc' => __('Add the column content.', '__poli-shortcodes__'),
			)
		),
		'shortcode' => '[{{column}} position="{{position}}" animation_style="{{animation_style}}"] {{content}} [/{{column}}] ',
		'clone_button' => __('Add New Column', '__poli-shortcodes__')
	)
);

/* ************************************************************************************** 
   HORIZONTAL MENU
************************************************************************************** */

$swm_shortcodes['horizontalmenu'] = array(         
        'params' => array(
            'text1' => array(
                'std' => __('Tab 1 Text', '__poli-shortcodes__'),
                'type' => 'text',
                'label' => __('Tab 1 Text', '__poli-shortcodes__'),
                'desc' => '',
            ),
            'link1' => array(
			'std' => '#',
			'type' => 'text',
			'label' => __('Tab 1 link', '__poli-shortcodes__'),
			'desc' => '',
			),
			'text2' => array(
                'std' => __('Tab 2 Text', '__poli-shortcodes__'),
                'type' => 'text',
                'label' => __('Tab 2 Text', '__poli-shortcodes__'),
                'desc' => '',
            ),
            'link2' => array(
			'std' => '#',
			'type' => 'text',
			'label' => __('Tab 2 link', '__poli-shortcodes__'),
			'desc' => '',
			),
			'text3' => array(
                'std' => __('Tab 3 Text', '__poli-shortcodes__'),
                'type' => 'text',
                'label' => __('Tab 3 Text', '__poli-shortcodes__'),
                'desc' => '',
            ),
            'link3' => array(
			'std' => '#',
			'type' => 'text',
			'label' => __('Tab 3 link', '__poli-shortcodes__'),
			'desc' => '',
			),
			'text4' => array(
                'std' => __('Tab 4 Text', '__poli-shortcodes__'),
                'type' => 'text',
                'label' => __('Tab 4 Text', '__poli-shortcodes__'),
                'desc' => '',
            ),
            'link4' => array(
			'std' => '#',
			'type' => 'text',
			'label' => __('Tab 4 link', '__poli-shortcodes__'),
			'desc' => '',
			)
        ),
        'shortcode' => '[horizontal_tab]
[menu_tab text="{{text1}}" link="{{link1}}" active="true"]
[menu_tab text="{{text2}}" link="{{link2}}"]
[menu_tab text="{{text3}}" link="{{link3}}"]
[menu_tab text="{{text4}}" link="{{link4}}" ]
[/horizontal_tab]',        
		'no_preview' => true, 
		'popup_title' => __('Horizontal Menu', '__poli-shortcodes__')   
);


/* **************************************************************************************
   IMAGE SLIDER
************************************************************************************** */

$swm_shortcodes['imageslider'] = array(
    'params' => array(
    	'animation_type' => array(
			'type' => 'select',
			'label' => __('Animation Type', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(					
				'fade' => __('Fade', '__poli-shortcodes__'),
				'slide' => __('Slide', '__poli-shortcodes__')												
			)
		),
		'auto_play' => array(
			'type' => 'select',
			'label' => __('Auto Play', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(					
				'true' => __('Yes', '__poli-shortcodes__'),
				'false' => __('No', '__poli-shortcodes__')												
			)
		),
		'bullet_navigation' => array(
			'type' => 'select',
			'label' => __('Display Bullet Navigation', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(					
				'true' => __('Yes', '__poli-shortcodes__'),
				'false' => __('No', '__poli-shortcodes__')												
			)
		),
		'arrow_navigation' => array(
			'type' => 'select',
			'label' => __('Display Arrow Navigation', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(					
				'true' => __('Yes', '__poli-shortcodes__'),
				'false' => __('No', '__poli-shortcodes__')												
			)
		),
		'slide_interval' => array(
			'type' => 'text',
			'label' => __('Slideshow Speed', '__poli-shortcodes__'),
			'desc' => __('Intreval between two slides. 1000=1 second, 5000= 5 second', '__poli-shortcodes__'),
			'std' => '5000'		
		)
    ),
    'no_preview' => true,
    'shortcode' => '[swm_image_slider animation_type="{{animation_type}}" auto_play="{{auto_play}}" bullet_navigation="{{bullet_navigation}}" arrow_navigation="{{arrow_navigation}}" slide_interval="{{slide_interval}}"] {{child_shortcode}} [/swm_image_slider]',
    'popup_title' => __('Image Slider', '__poli-shortcodes__'),
    
    'child_shortcode' => array(
        'params' => array(
            'src' => array(
				'type' => 'upload',
				'label' => __('Image', '__poli-shortcodes__'),
				'desc' => __('Maximum image width : 940px, height size is flexible.', '__poli-shortcodes__')				
			),
			'link' => array(
				'type' => 'text',
				'label' => __('Link on Image', '__poli-shortcodes__'),
				'desc' => __('Add link to open page or post by click on image', '__poli-shortcodes__'),
				'std' => '#'
			)
			                      
        ),        
        'shortcode' => '[swm_image_slide src="{{src}}" link="{{link}}" alt=""]',
		'no_preview' => true, 
        'clone_button' => __('Add Another Slide', '__poli-shortcodes__')
    )
);

/* ************************************************************************************** 
  RECENT POSTS
************************************************************************************** */

$recent_posts_cat = array(
	'type' => 'text',
	'label' => __('Categories', '__poli-shortcodes__'),
	'desc' => __('If you want to display specific category(ies) recent posts only, then add Category IDs with comma seperated (e.g. 1,2,3) or <strong>Leave it blank for default.</strong>', '__poli-shortcodes__'),
	'std' => ''		
);
$recent_posts_exclude= array(
	'type' => 'text',
	'label' => __('Exclude Categories', '__poli-shortcodes__'),
	'desc' => __('add post categories IDs with comma seperate to exclude from post list', '__poli-shortcodes__'),
	'std' => ''		
);
$recent_posts_desc_limit = array(
	'type' => 'text',
	'label' => __('Description Limit', '__poli-shortcodes__'),
	'desc' => __('Number of characters to display in summery text', '__poli-shortcodes__'),
	'std' => '150'
);
$recent_posts_read_more_text = array(
	'type' => 'text',
	'label' => __('Read More Link Text', '__poli-shortcodes__'),
	'desc' => __('Leave it blank to hide "Read More" link', '__poli-shortcodes__'),
	'std' => 'Read more'
);
$recent_posts_post_limit = array(
	'type' => 'text',
	'label' => __('Post Limit', '__poli-shortcodes__'),
	'desc' => __('Number of posts to display', '__poli-shortcodes__'),
	'std' => '2'
);

// Recent Posts Tiny

$swm_shortcodes['recentpoststiny'] = array(
	'params' => array(
		'post_limit' => $recent_posts_post_limit, 			
		'cat'  => $recent_posts_cat,
		'exclude' => $recent_posts_exclude
	),
	'shortcode' => '[recent_posts_tiny post_limit="{{post_limit}}" cat="{{cat}}" exclude="{{exclude}}"]',
	'no_preview' => true, 
	'popup_title' => __('Recent Posts', '__poli-shortcodes__')
);

// Recent Posts Full

$swm_shortcodes['recentpostsfull'] = array(
	'params' => array(
		'column' => array(
			'type' => 'select',
			'label' => __('Display Column', '__poli-shortcodes__'),
			'desc' => __('Select display column for recent posts', '__poli-shortcodes__'),
			'std' => '3',
			'options' => array(
				'2' => __('2 Column', '__poli-shortcodes__'),
				'3' => __('3 Column', '__poli-shortcodes__'),
				'4' => __('4 Column', '__poli-shortcodes__')								
			)
		),
		'post_limit' => $recent_posts_post_limit, 
		'desc_limit' => $recent_posts_desc_limit,
		'read_more_text' => $recent_posts_read_more_text,
		'date_comments' => array(
			'type' => 'select',
			'label' => __('Display Date and Comments', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '3',
			'options' => array(
				'true' => __('Yes', '__poli-shortcodes__'),
				'false' => __('No', '__poli-shortcodes__')								
			)
		),
		'cat'  => $recent_posts_cat,
		'exclude' => $recent_posts_exclude
	),
	'shortcode' => '[recent_posts_full column="{{column}}" post_limit="{{post_limit}}" desc_limit="{{desc_limit}}" read_more_text="{{read_more_text}}" date_comments="{{date_comments}}" cat="{{cat}}" exclude="{{exclude}}"]',
	'no_preview' => true, 
	'popup_title' => __('Recent Posts', '__poli-shortcodes__')
);

// Recent Posts Square Style

$swm_shortcodes['recentpostssquare'] = array(
	'params' => array(
		'post_limit' => $recent_posts_post_limit, 
		'desc_limit' => $recent_posts_desc_limit,			
		'cat'  => $recent_posts_cat,
		'exclude' => $recent_posts_exclude
	),
	'shortcode' => '[recent_posts_square post_limit="{{post_limit}}" desc_limit="{{desc_limit}}" cat="{{cat}}" exclude="{{exclude}}"]',
	'no_preview' => true, 
	'popup_title' => __('Recent Posts', '__poli-shortcodes__')
);


/* ************************************************************************************** 
	TESTIMONIALS
************************************************************************************** */

$swm_shortcodes['testimonials'] = array(
	'params' => array(
		'display_testimonials' => array(
			'type' => 'text',
			'label' => __('Number of Testimonials', '__poli-shortcodes__'),
			'desc' => __('Enter number to display testimonials', '__poli-shortcodes__'),
			'std' => '3'		
		),
		'columns' => array(
			'type' => 'select',
			'label' => __('Display Column', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '3',
			'options' => array(
				'1' => __('1 Column', '__poli-shortcodes__'),
				'2' => __('2 Column', '__poli-shortcodes__'),				
				'3' => __('3 Column', '__poli-shortcodes__'),		
				'4' => __('4 Column', '__poli-shortcodes__')			
			)
		),		
		'client_img' => array(
			'type' => 'select',
			'label' => __('Client Image', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(
				'true' => __('Display Client Image', '__poli-shortcodes__'),				
				'false' => __('Hide Client Image', '__poli-shortcodes__')				
			)
		),
		'exclude' => array(
			'type' => 'text',
			'label' => __('Exclude Categories', '__poli-shortcodes__'),
			'desc' => __('add testimonials categories IDs with comma seperate to exclude from display', '__poli-shortcodes__'),
			'std' => ''		
		),
		'infotext' => array(
			'type' => 'infotext',
			'label' => __('Note', '__poli-shortcodes__'),
			'desc' => '',
			'std' => __('Add Testimonials from left sidebar menu Testimonials > Add New ', '__poli-shortcodes__')
		)
	),
	'shortcode' => '[swm_testimonials display_testimonials="{{display_testimonials}}" columns="{{columns}}" client_img="{{client_img}}" exclude="{{exclude}}"]',
	'no_preview' => true,
	'popup_title' => __('Testimonials', '__poli-shortcodes__')
);


/* ************************************************************************************** 
	TESTIMONIALS SLIDER
************************************************************************************** */

$swm_shortcodes['testimonialsslider'] = array(
	'params' => array(		
		'client_img' => array(
			'type' => 'select',
			'label' => __('Client Image', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(
				'true' => __('Display Client Image', '__poli-shortcodes__'),				
				'false' => __('Hide Client Image', '__poli-shortcodes__')				
			)
		),
		'animation_type' => array(
			'type' => 'select',
			'label' => __('Animation Type', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(					
				'fade' => __('Fade', '__poli-shortcodes__'),
				'horizontal' => __('Horizontal', '__poli-shortcodes__'),												
				'vertical' => __('Vertical', '__poli-shortcodes__'),
			)
		),		
		'slide_interval' => array(
			'type' => 'text',
			'label' => __('Slideshow Speed', '__poli-shortcodes__'),
			'desc' => __('Intreval between two slides. 1000=1 second, 5000= 5 second', '__poli-shortcodes__'),
			'std' => '5000'		
		),
		'slide_limit' => array(
			'type' => 'text',
			'label' => __('Slide Limit', '__poli-shortcodes__'),
			'desc' => __('Enter number to display testimonials slides in slideshows', '__poli-shortcodes__'),
			'std' => '3'		
		)
	),	
	'shortcode' => '[swm_testimonials_slider client_img="{{client_img}}" animation_type="{{animation_type}}" slide_interval="{{slide_interval}}" slide_limit="{{slide_limit}}"]',
	'no_preview' => true,
	'popup_title' => __('Testimonials Slider', '__poli-shortcodes__')
);

/* ************************************************************************************** 
   VIDEO
************************************************************************************** */

$swm_shortcodes['video'] = array(
	'params' => array(
		'source' => array(
			'type' => 'text',
			'label' => __('Video URL', '__poli-shortcodes__'),
			'desc' => __('Enter embed YouTube/Vimeo video URL.<br />Use sample URLs and replace video ids in  sample URL<br /> YouTube : http://www.youtube.com/embed/sn1GG20V_m8 <br />Vimeo: http://player.vimeo.com/video/30955798 <br /> ', '__poli-shortcodes__'),
			'std' => 'http://www.youtube.com/embed/sn1GG20V_m8'
		)		
	),
	'shortcode' => '[swm_video source="{{source}}" ]',
	'no_preview' => true, 
	'popup_title' => __('Video', '__poli-shortcodes__')
);

/* ************************************************************************************** 
	SUPPORT TEAM
************************************************************************************** */

$swm_shortcodes['supportteam'] = array(
	'params' => array(
		'image_src' => array(
			'type' => 'upload',
			'label' => __('Team Member Image', '__poli-shortcodes__'),
			'desc' => __('Size - 99px width and 93px height', '__poli-shortcodes__')
			
		),
		'name' => array(
			'type' => 'text',
			'label' => __('Name', '__poli-shortcodes__'),
			'desc' => '',
			'std' => __('John Doe', '__poli-shortcodes__')
		),
		'position' => array(
			'type' => 'text',
			'label' => __('Position', '__poli-shortcodes__'),
			'desc' => '',
			'std' => __('Project Manager', '__poli-shortcodes__')
		),		
		'email' => array(
			'type' => 'text',
			'label' => __('Email Id', '__poli-shortcodes__'),
			'desc' => '',
			'std' => __('info@yourdomain.com', '__poli-shortcodes__')
		),	
		'phone' => array(
			'type' => 'text',
			'label' => __('Phone No.', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '880-654-3210'
		)		
		
	),
	'shortcode' => '[support_team image_src="{{image_src}}" name="{{name}}" position="{{position}}" email="{{email}}" phone="{{phone}}" ]',
	'no_preview' => true, 
	'popup_title' => __('Support Team', '__poli-shortcodes__')
);

/* ************************************************************************************** 
	TOOLTIPS
************************************************************************************** */

$swm_shortcodes['tooltip'] = array(
	'params' => array(
		'position' => array(
			'type' => 'select',
			'label' => __('Tooltip Position', '__poli-shortcodes__'),
			'desc' => __('Select tooltip display position', '__poli-shortcodes__'),
			'options' => array(
				'tipUp' => __('Up', '__poli-shortcodes__'),
				'tipDown' => __('Down', '__poli-shortcodes__'),	
				'tipLeft' => __('Left', '__poli-shortcodes__'),
				'tipRight' => __('Right', '__poli-shortcodes__')
			)
		),
		'tooltip_text' => array(
			'std' => __('Exmaple of tooltip text', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Tooltip Text', '__poli-shortcodes__'),
			'desc' => __('Enter text which you want to display in tooltip', '__poli-shortcodes__'),
		),
		'content' => array(
			'std' => __('Tooltip', '__poli-shortcodes__'),
			'type' => 'text',
			'label' => __('Content', '__poli-shortcodes__'),
			'desc' => ''
		)
		
	),
	'shortcode' => '[swm_tooltip position="{{position}}" tooltip_text="{{tooltip_text}}"] {{content}} [/swm_tooltip]',
	'no_preview' => true, 
	'popup_title' => __('Tooltips', '__poli-shortcodes__')
);

/* ************************************************************************************** 
    MAP
************************************************************************************** */

$swm_shortcodes['googlemap'] = array(
	'params' => array(		
		'height' => array(
                'std' => '300',
                'type' => 'text',
                'label' => __('Google Map Height', '__poli-shortcodes__'),
                'desc' => '',
            ),
		'src' => array(
                'std' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.313975261218!2d-74.00583600840093!3d40.71110418241921!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1440259795109',
                'type' => 'textarea',
                'label' => __('Google Map Link', '__poli-shortcodes__'),
                'desc' => __( '<a href="https://www.youtube.com/watch?v=HjZHkEWTCYg" target="_blank">Video tutorial to get google map embed code</a>', '__poli-shortcodes__' ),
            )		
	),
	'shortcode' => '[google_map height="{{height}}" src="{{src}}"] ',
	'no_preview' => true, 
	'popup_title' => __('Google Map ', '__poli-shortcodes__')
);

/* ************************************************************************************** 
   SOCIAL MEDIA
************************************************************************************** */

$swm_shortcodes['socialmedia'] = array(
	'params' => array(),
    'no_preview' => true,
    'shortcode' => '[social_media_icons] {{child_shortcode}} [/social_media_icons]',
    'popup_title' => __('Social Media Icons', '__poli-shortcodes__'),
    
    'child_shortcode' => array(
        'params' => array(            
			 'icon_name' => array(
				'type' => 'text',
				'label' => __('Social Media Icon', '__poli-shortcodes__'),
				'desc' => __('You can refer social media icon from this page :<a href="http://fortawesome.github.io/Font-Awesome/icons/#brand" target="_blank">FontAwesome</a>', '__poli-shortcodes__'),				
				'std' => 'fa-twitter'
			),	
            'link' => array(
			'type' => 'text',
			'label' => __('Link', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '#'
			),
        ),
        'shortcode' => '[{{icon_name}} link="{{link}}"]',
		'no_preview' => true, 
        'clone_button' => __('Add Another Icon', '__poli-shortcodes__')
    )
);

/* ************************************************************************************** 
  TEAM MEMBER
************************************************************************************** */

$swm_shortcodes['teammember'] = array(
	'params' => array(		
		'image_src' => array(
			'type' => 'upload',
			'label' => __('Team Member Photo', '__poli-shortcodes__'),
			'desc' => __('Upload team member image - size: 689 x 689 ( height size is flexible)', '__poli-shortcodes__')			
		),
		'name' => array(
			'type' => 'text',
			'label' => __('Name', '__poli-shortcodes__'),
			'desc' => '',
			'std' => __('John Doe', '__poli-shortcodes__')
		),
		'position' => array(
			'type' => 'text',
			'label' => __('Position', '__poli-shortcodes__'),
			'desc' => '',
			'std' => __('Project Manager', '__poli-shortcodes__')
		),		
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __('Team Member Info', '__poli-shortcodes__'),
			'desc' => __('if Team Member Style is "Team Member with Large Text"  then add text otherwise leave it blank.', '__poli-shortcodes__'),
		),		
		'column' => array(
			'type' => 'select',
			'label' => __('Display Column', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '',
			'options' => array(				
				'swm_one_half' => __('2 Column', '__poli-shortcodes__'),
				'swm_one_third' => __('3 Column', '__poli-shortcodes__'),
				'swm_one_fourth' => __('4 Column', '__poli-shortcodes__'),
				'swm_one_fifth' => __('5 Column', '__poli-shortcodes__'),
				'swm_one_sixth' => __('6 Column', '__poli-shortcodes__')													
			)
		),
		'column_position' => $column_position
	),
	'shortcode' => '[team_member image_src="{{image_src}}" name="{{name}}" position="{{position}}" column="{{column}}" column_position="{{column_position}}"] {{content}} [/team_member]',
	'no_preview' => true, 
	'popup_title' => __('Team Member', '__poli-shortcodes__')
);

/* ************************************************************************************** 
  	IMAGE FRAME WITH ALIGNMENT
************************************************************************************** */

$swm_shortcodes['image'] = array(	
	'params' => array(
		'src' => array(
			'type' => 'upload',
			'label' => __('Image', '__poli-shortcodes__'),
			'desc' => ''			
		),		
		'link' => array(
			'type' => 'text',
			'label' => __('Link on Image', '__poli-shortcodes__'),
			'desc' => __('If you want to add lightbox property on this image then give full size image path in above box.', '__poli-shortcodes__'),
			'std' => '#'
		),
		'align' => array(
			'type' => 'select',
			'label' => __('Image Alignment', '__poli-shortcodes__'),
			'desc' => __('Select column as per images size.', '__poli-shortcodes__'),
			'options' => array(
				'left' => __('Left Align', '__poli-shortcodes__'),
				'right' => __('Right Align', '__poli-shortcodes__'),
				'center' => __('Center Align', '__poli-shortcodes__')											
			)
		),				
		'alt' => array(
			'type' => 'text',
			'label' => __('Image Alternate Text', '__poli-shortcodes__'),
			'desc' => '',
			'std' => ''
		),		
		'title' => array(
			'type' => 'text',
			'label' => __('Image Title Text', '__poli-shortcodes__'),
			'desc' => '',
			'std' => ''
		)		
	),
	'shortcode' => '[swm_image src="{{src}}" align="{{align}}" link="{{link}}" alt="{{alt}}" title="{{title}}"]',
	'no_preview' => true, 
	'popup_title' => __('Image', '__poli-shortcodes__')
);

/* ************************************************************************************** 
 	PROMOTION BOX
************************************************************************************** */

$swm_shortcodes['promotionbox'] = array(
	'params' => array(
		'button_text' => array(
			'type' => 'text',
			'label' => __('Button Text', '__poli-shortcodes__'),
			'desc' => __('If you want to hide button then leave this field blank', '__poli-shortcodes__'),
			'std' => __('Signup Now!', '__poli-shortcodes__')
		),
		'button_link' => array(
			'type' => 'text',
			'label' => __('Button Link', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '#'
		),		
		'content' => array(
			'std' => __('This is title text of promotion box', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Promotion Text', '__poli-shortcodes__'),
			'desc' => __('Add the promotion text', '__poli-shortcodes__'),
		),
		'title_text_color' => array(
			'type' => 'color',
			'label' => __('Title Text Color', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '#575757'
		),
		'title_text_size' => array(
				'type' => 'select',
				'label' => __('Title Text Size', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '22',
				'options' => swm_one_to_final_number( 72, false, false )
		),
		'sub_text' => array(
			'std' => __('this is sub line promo text', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Sub Text', '__poli-shortcodes__'),
			'desc' => __('Add the subline promotext', '__poli-shortcodes__'),
		),
		'sub_text_color' => array(
			'type' => 'color',
			'label' => __('Sub Text Color', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '#575757'
		),		
		'sub_text_size' => array(
				'type' => 'select',
				'label' => __('Sub Text Size', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '13',
				'options' => swm_one_to_final_number( 36, false, false )
		),		
		'border' => array(
			'type' => 'select',
			'label' => __('Display Border Around Box', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(
				'true' => __('Yes', '__poli-shortcodes__'),
				'false' => __('No', '__poli-shortcodes__')		
			)
		),

	),
	'shortcode' => '[swm_promotion_box button_text="{{button_text}}" button_link="{{button_link}}" title_text_color="{{title_text_color}}" title_text_size="{{title_text_size}}" sub_text="{{sub_text}}" sub_text_color="{{sub_text_color}}" sub_text_size="{{sub_text_size}}" border="{{border}}" ] {{content}} [/swm_promotion_box]',
	'no_preview' => true,
	'popup_title' => __('Promo Box', '__poli-shortcodes__')
);

/* ************************************************************************************** 
   PRICING TABLES
************************************************************************************** */

$swm_shortcodes['tables'] = array(
	'params' => array(
		'table_column' => array(
			'type' => 'select',
			'label' => __('Table Column', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(
				'2' => __('Two Column Table', '__poli-shortcodes__'),
				'3' => __('Three Column Table', '__poli-shortcodes__'),	
				'4' => __('Four Column Table', '__poli-shortcodes__')				
			)
		),
		'title' => array(
			'type' => 'text',
			'label' => __('Table Title', '__poli-shortcodes__'),
			'desc' => '',
			'std' => __('Title Here', '__poli-shortcodes__')
		),		
		'price' => array(
			'type' => 'text',
			'label' => __('Price', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '$19'
		),
		'price_sub_text' => array(
			'type' => 'text',
			'label' => __('Price Sub Text', '__poli-shortcodes__'),
			'desc' => '',
			'std' => 'per month'
		),	
		'button_background' => array(
			'type' => 'color',
			'label' => __('Button Background Color', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '#575757'
		),
		'button_text_color' => array(
			'type' => 'color',
			'label' => __('Button Text Color', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '#FFFFFF'
		),
		'button_text' => array(
			'type' => 'text',
			'label' => __('Button Text', '__poli-shortcodes__'),
			'desc' => '',
			'std' => __('Buy Now!', '__poli-shortcodes__')
		),
		'button_link' => array(
			'type' => 'text',
			'label' => __('Button Link', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '#'
		),	
		'table_position' => array(
			'type' => 'select',
			'label' => __('Table Position', '__poli-shortcodes__'),
			'desc' => __('Select Table position. First,middle or last position.', '__poli-shortcodes__'),
			'options' => array(
				'other' => __('Middle', '__poli-shortcodes__'),		
				'first' => __('First Position', '__poli-shortcodes__'),
				'last' => __('Last Position', '__poli-shortcodes__')
			)
		),		
		'popular_plan' => array(
			'type' => 'select',
			'label' => __('Popular Plan', '__poli-shortcodes__'),
			'desc' => __('Select "Yes" if this table has most popular plan. It will display large than other tables.', '__poli-shortcodes__'),
			'options' => array(
				'false' => __('No', '__poli-shortcodes__'),
				'true' => __('Yes', '__poli-shortcodes__')				
			)
		),	
		
		'content' => array(
			'std' => '
<ul>
<li> Table Item One </li>
<li> Table Item Two </li>
<li> Table Item Three </li>
</ul>',
			'type' => 'textarea',
			'label' => __('Table Content', '__poli-shortcodes__'),
			'desc' => __('Add the table content in list format.', '__poli-shortcodes__'),
		)
		
	),
	'shortcode' => '[pricing_table column="{{table_column}}" title="{{title}}" price="{{price}}" price_sub_text="{{price_sub_text}}" button_background="{{button_background}}" button_text_color="{{button_text_color}}"  button_text="{{button_text}}" button_link="{{button_link}}" table_position="{{table_position}}" popular_plan="{{popular_plan}}"] {{content}} [/pricing_table]',
	'no_preview' => true,
	'popup_title' => __('Pricing Table', '__poli-shortcodes__')
);

/* ************************************************************************************** 
   BUTTONS
************************************************************************************** */

$swm_shortcodes['button'] = array(
	'params' => array(
		'button_color' => array(
			'type' => 'color',
			'label' => __('Button Color', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '#575757'
		),
		'font_color' => array(
			'type' => 'color',
			'label' => __('Font Color', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '#FFFFFF'
		),
		'size' => array(
			'type' => 'select',
			'label' => __('Button Size', '__poli-shortcodes__'),			
			'options' => array(				
				'tiny' => __('Tiny', '__poli-shortcodes__'),
				'small' => __('Small', '__poli-shortcodes__'),
				'medium' => __('Medium', '__poli-shortcodes__'),
				'large' => __('Large', '__poli-shortcodes__'),
				'xlarge' => __('X Large', '__poli-shortcodes__')																	
			)
		),
		'shape' => array(
			'type' => 'select',
			'label' => __('Button Shape', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(
				'square' => __('Square', '__poli-shortcodes__'),	
				'round' => __('Round', '__poli-shortcodes__'),
				'capsule' => __('Capsule', '__poli-shortcodes__')
			)
		),
		'button_style' => array(
			'type' => 'select',
			'label' => __('Button Style', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(
				'button_standard' => __('Standard', '__poli-shortcodes__'),	
				'button_outline' => __('Outline - Transparent Background', '__poli-shortcodes__')				
			)
		),	
		'button_3d' => array(
			'type' => 'select',
			'label' => __('3D Effect', '__poli-shortcodes__'),			
			'options' => array(				
				'false' => __('No', '__poli-shortcodes__'),
				'true' => __('Yes', '__poli-shortcodes__')																										
			)
		),	
		'content' => array(
			'std' => __('Read more', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Button Text', '__poli-shortcodes__'),
			'desc' => __('Add the button text. If you want to add icon before button text then use simple shortcode <br/>[fa_icon icon="fa-star"]<br />Icon Referce Website : <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Font Awesome</a>', '__poli-shortcodes__')
		),
		'link' => array(
			'type' => 'text',
			'label' => __('Button Link', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '#'
		),
		'target' => array(
			'type' => 'select',
			'label' => __('Link Target', '__poli-shortcodes__'),
			'desc' => __('Select display size of button', '__poli-shortcodes__'),
			'options' => array(				
				'_self' => __('Open page in same window', '__poli-shortcodes__'),
				'_blank' => __('Open page in new window', '__poli-shortcodes__')																						
			)
		),
		'text_shadow' => array(
			'type' => 'select',
			'label' => __('Text Shadow Color', '__poli-shortcodes__'),			
			'options' => array(				
				'dark' => __('Dark', '__poli-shortcodes__'),
				'light' => __('Light', '__poli-shortcodes__'),
				'none' => __('No Shadow', '__poli-shortcodes__')																				
			)
		),
		
	),
	'shortcode' => '[swm_button button_color="{{button_color}}" font_color="{{font_color}}" size="{{size}}" shape="{{shape}}"  button_style="{{button_style}}" button_3d="{{button_3d}}" link="{{link}}" target="{{target}}" text_shadow="{{text_shadow}}" ] {{content}} [/swm_button]',
	'no_preview' => true, 
	'popup_title' => __('Button', '__poli-shortcodes__')
);

/* ************************************************************************************** 
    TABS
************************************************************************************** */

$swm_shortcodes['tabs'] = array(         
        'params' => array(
            'style' => array(
				'type' => 'select',
				'label' => __('Tabs Style', '__poli-shortcodes__'),
				'desc' => '',
				'options' => array(
					'tabs_horizontal' => __('Horizontal Tabs', '__poli-shortcodes__'),
					'tabs_vertical' => __('Vertical Tabs', '__poli-shortcodes__')							
					)
			),
            'title1' => array(
                'std' => __('Tab 1', '__poli-shortcodes__'),
                'type' => 'text',
                'label' => __('Tab 1 Title', '__poli-shortcodes__'),
                'desc' => '',
            ),
            'content1' => array(
			'std' => __('tab description here', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Tab 1 Description', '__poli-shortcodes__'),
			'desc' => '',
			),
			'title2' => array(
                'std' => __('Tab 2', '__poli-shortcodes__'),
                'type' => 'text',
                'label' => __('Tab 2 Title', '__poli-shortcodes__'),
                'desc' => '',
            ),
            'content2' => array(
			'std' => __('tab description here', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Tab 2 Description', '__poli-shortcodes__'),
			'desc' => '',
			),
			'title3' => array(
                'std' => __('Tab 3', '__poli-shortcodes__'),
                'type' => 'text',
                'label' => __('Tab 3 Title', '__poli-shortcodes__'),
                'desc' => '',
            ),
            'content3' => array(
			'std' => __('tab description here', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Tab 3 Description', '__poli-shortcodes__'),
			'desc' => '',
			),
			'title4' => array(
                'std' => __('Tab 4', '__poli-shortcodes__'),
                'type' => 'text',
                'label' => __('Tab 4 Title', '__poli-shortcodes__'),
                'desc' => '',
            ),
            'content4' => array(
			'std' => __('tab description here', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Tab 4 Description', '__poli-shortcodes__'),
			'desc' => '',
			)
        ),
        'shortcode' => '[swm_tabs style="{{style}}" title="{{title1}},{{title2}},{{title3}},{{title4}}"] 
[tab_container] 
[tab tabno="1"] {{content1}} [/tab] 
[tab tabno="2"] {{content2}} [/tab] 
[tab tabno="3"] {{content3}} [/tab] 
[tab tabno="4"] {{content4}} [/tab] 
[/tab_container] 
[/swm_tabs]',        
		'no_preview' => true, 
		'popup_title' => __('Tabs', '__poli-shortcodes__')   
);

/* ************************************************************************************** 
    TOOGLE CONTENT
************************************************************************************** */

$swm_shortcodes['toggle'] = array(
	'params' => array(			
		'status' => array(
			'type' => 'select',
			'label' => __('Toogle Status', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(
				'closed' => __('Close', '__poli-shortcodes__'),
				'open' => __('Open', '__poli-shortcodes__')							
			)
		),
		'icon' => array(
				'type' => 'fonticon',
				'label' => __('Icon', '__poli-shortcodes__'),
				'desc' => __('Select and Deselect icon by click on icon', '__poli-shortcodes__'),				
				'options' => $font_icons
		),
		'title' => array(
			'type' => 'text',
			'label' => __('Toggle Content Title', '__poli-shortcodes__'),
			'desc' => __('Add the title that will go above the toggle content', '__poli-shortcodes__'),
			'std' => __('Title', '__poli-shortcodes__')
		),
		'content' => array(
			'std' => __(' [p] Insert toggle content here [/p]  ', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Toggle Content', '__poli-shortcodes__'),
			'desc' => __('Add the toggle content. If you are adding more than one line then you can remove [p]...[/p] shortcode because wordpress will automatically add paragraph tag for all next lines.', '__poli-shortcodes__'),
		)
		
	),
	'shortcode' => '[swm_toggle status="{{status}}" title="{{title}}" icon="{{icon}}"] {{content}} [/swm_toggle]',
	'no_preview' => true, 
	'popup_title' => __('Toggle Simple', '__poli-shortcodes__')
);

$swm_shortcodes['toggleaccordion'] = array(
	'params' => array(),
    'no_preview' => true,
    'shortcode' => '[swm_toggle_accordion_container] {{child_shortcode}} [/swm_toggle_accordion_container]',
    'popup_title' => __('Toggle Accordion', '__poli-shortcodes__'),
    
    'child_shortcode' => array(
        'params' => array(		
		'icon' => array(
				'type' => 'fonticon',
				'label' => __('Icon', '__poli-shortcodes__'),
				'desc' => __('Select and Deselect icon by click on icon', '__poli-shortcodes__'),				
				'options' => $font_icons
		),
		'title' => array(
			'type' => 'text',
			'label' => __('Toggle Content Title', '__poli-shortcodes__'),
			'desc' => __('Add the title that will go above the toggle content', '__poli-shortcodes__'),
			'std' => __('Title', '__poli-shortcodes__')
		),
		'content' => array(
			'std' => __(' [p] Insert toggle content here [/p]  ', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Toggle Content', '__poli-shortcodes__'),
			'desc' => __('Add the toggle content. If you are adding more than one line then you can remove [p]...[/p] shortcode because wordpress will automatically add paragraph tag for all next lines.', '__poli-shortcodes__'),
		)
		
	),
    'shortcode' => '[swm_toggle_accordion title="{{title}}" icon="{{icon}}"] {{content}} [/swm_toggle_accordion]',
	'no_preview' => true, 
    'clone_button' => __('Add Another Item', '__poli-shortcodes__')
    )
);


/* ************************************************************************************** 
    BLOCK QUOTE
************************************************************************************** */

$swm_shortcodes['blockquote'] = array(
	'params' => array(		
		'content' => array(
			'std' => __('This is sample text for blockquote', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Quote Text', '__poli-shortcodes__'),
			'desc' => __('Add the quote text', '__poli-shortcodes__'),
		)		
	),
	'shortcode' => '[blockquote] {{content}} [/blockquote]',
	'no_preview' => true, 
	'popup_title' => __('Quote', '__poli-shortcodes__')
);


/* ************************************************************************************** 
    PULL QUOTES
************************************************************************************** */

$swm_shortcodes['pullquote'] = array(
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Quote Style', '__poli-shortcodes__'),
			'desc' => __('Select quote style', '__poli-shortcodes__'),
			'options' => array(
				'pullquote_left' => __('Pull Quote Left', '__poli-shortcodes__'),
				'pullquote_right' => __('Pull Quote Right', '__poli-shortcodes__')										
			)
		),
		'content' => array(
			'std' => __('This is sample text', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Quote Text', '__poli-shortcodes__'),
			'desc' => __('Add the quote text', '__poli-shortcodes__'),
		)				
	),
	'shortcode' => '[{{style}} ] {{content}} [/{{style}}]',
	'no_preview' => true, 
	'popup_title' => __('Quote', '__poli-shortcodes__')
);

/* ************************************************************************************** 
    LIST STYLES
************************************************************************************** */

$swm_shortcodes['textlist'] = array(
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Ordered List Style', '__poli-shortcodes__'),
			'desc' => __('Select list style', '__poli-shortcodes__'),
			'options' => array(					
				'steps_with_circle' => __('Steps with circle icons style', '__poli-shortcodes__'),
				'steps_with_box' => __('Steps with Box style', '__poli-shortcodes__'),
				'list_lower_roman' => __('Lower Roman', '__poli-shortcodes__'),
				'list_upper_roman' => __('Upper Roman', '__poli-shortcodes__'),
				'list_lower_alpha' => __('Lower Alpha', '__poli-shortcodes__'),
				'list_upper_alpha' => __('Upper Alpha', '__poli-shortcodes__')											
			)
		),
		'content' => array(
			'std' => '
<ol>
<li> Item One </li>
<li> Item Two </li>
<li> Item Three </li>
</ol>',
			'type' => 'textarea',
			'label' => __('List Content', '__poli-shortcodes__'),
			'desc' => '',
		)		
	),
	'shortcode' => '[{{style}}] {{content}} [/{{style}}]',
	'no_preview' => true,
	'popup_title' => __('List', '__poli-shortcodes__')
);


/* ************************************************************************************** 
    INFO BOXES
************************************************************************************** */

$swm_shortcodes['infoboxes'] = array(
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Info Box Style', '__poli-shortcodes__'),
			'desc' => __('Select info box style', '__poli-shortcodes__'),
			'options' => array(
				'info' => __('Info', '__poli-shortcodes__'),
				'success' => __('Success', '__poli-shortcodes__'),
				'error' => __('Error', '__poli-shortcodes__'),
				'warning' => __('Warning', '__poli-shortcodes__'),
				'download' => __('Download', '__poli-shortcodes__'),
				'note' => __('Note', '__poli-shortcodes__')				
			)
		),
		'content' => array(
			'std' => __('Sample text', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Info Box Text', '__poli-shortcodes__'),
			'desc' => __('Add the info box text', '__poli-shortcodes__'),
		)
		
	),
	'shortcode' => '[{{style}}] {{content}} [/{{style}}]',
	'no_preview' => true, 
	'popup_title' => __('Info Box', '__poli-shortcodes__')
);

/* **************************************************************************************
   LIST ICONS
************************************************************************************** */

$swm_shortcodes['iconlist'] = array(
	'params' => array(),
    'no_preview' => true,
    'shortcode' => '[icon_list] {{child_shortcode}} [/icon_list]',
    'popup_title' => __('List Icons', '__poli-shortcodes__'),
    
    'child_shortcode' => array(
        'params' => array(
            'icon_name' => array(
				'type' => 'fonticon',
				'label' => __('Icon', '__poli-shortcodes__'),
				'desc' => __('Select and Deselect icon by click on icon', '__poli-shortcodes__'),				
				'options' => $font_icons
			),
			'content' => array(
                'std' => 'list item details here',
                'type' => 'textarea',
                'label' => __('List Content', '__poli-shortcodes__'),
                'desc' => '',
            ), 
        ),
        'shortcode' => '[swm_list_icon icon_name="{{icon_name}}"]{{content}}[/swm_list_icon]',
		'no_preview' => true, 
        'clone_button' => __('Add Another Item', '__poli-shortcodes__')
    )
);

/* **************************************************************************************
   ICON
************************************************************************************** */

$swm_shortcodes['icon'] = array(
	'params' => array(
		'infotext' => array(
			'type' => 'infotext',
			'label' => __('Note', '__poli-shortcodes__'),
			'desc' => '',
			'std' => __('If you want to display icon without any format then you can use simple shortcode <br /> [fa_icon icon="fa-star"] ', '__poli-shortcodes__')
		),
		'icon_name' => array(
			'type' => 'fonticon',
			'label' => __('Icon', '__poli-shortcodes__'),
			'desc' => __('Select and Deselect icon by click on icon', '__poli-shortcodes__'),
			'options' => $font_icons
		),
		'icon_color' => array(
			'type' => 'color',
			'label' => __('Icon Color', '__poli-shortcodes__'),
			'desc' => '',
			'std' => '#606060'
		),		
		'icon_size' => array(
			'type' => 'select',
			'label' => __('Icon Size', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(
				'tiny' => __('Tiny', '__poli-shortcodes__'),
				'small' => __('Small', '__poli-shortcodes__'),
				'medium' => __('Medium', '__poli-shortcodes__'),
				'large' => __('Large', '__poli-shortcodes__'),
				'xlarge' => __('xlarge', '__poli-shortcodes__')							
			)
		),
		'icon_style' => array(
			'type' => 'select',
			'label' => __('Icon Style', '__poli-shortcodes__'),
			'desc' => '',
			'options' => array(
				'default' => __('Default', '__poli-shortcodes__'),
				'square' => __('Icon with Square Shape', '__poli-shortcodes__'),
				'circle' => __('Icon with Circle Shape', '__poli-shortcodes__')						
			)
		),
		'icon_bg_color' => array(
			'type' => 'color',
			'label' => __('Icon Background', '__poli-shortcodes__'),
			'desc' => __('If "Icon Style" drodown is selected "Icon with Square or Circle Shape" then enter icon background color', '__poli-shortcodes__'),
			'std' => '#FFFFFF'
		),
		'icon_border' => array(
			'type' => 'select',
			'label' => __('Display Icon Border', '__poli-shortcodes__'),
			'desc' => __('If "Icon Style" drodown is selected "Icon with Square or Circle Shape" then you can add border on square or circle shape', '__poli-shortcodes__'),
			'options' => array(
				'false' => __('No', '__poli-shortcodes__'),
				'true' => __('Yes', '__poli-shortcodes__')				
			)
		),
		'border_color' => array(
			'type' => 'color',
			'label' => __('Border Color', '__poli-shortcodes__'),
			'desc' => __('If "Display Icon Border" drodown is selected "Yes" then enter icon border color', '__poli-shortcodes__'),
			'std' => '#FFFFFF'
		),
		'link' => array(
			'type' => 'text',
			'label' => __('Link', '__poli-shortcodes__'),
			'desc' => __('Enter full url to create clickable icon', '__poli-shortcodes__'),
			'std' => ''
		),	
		'margin' => array(
			'type' => 'select',
			'label' => __('Margin', '__poli-shortcodes__'),
			'desc' => __('Set margin around icon.', '__poli-shortcodes__'),
			'std' => '0',
			'options' => swm_one_to_final_number( 50, false, false, 0 )
		),
		'rotate' => array(
			'type' => 'select',
			'label' => __('Rotate Icon', '__poli-shortcodes__'),			
			'options' => array(
				'false' => __('No', '__poli-shortcodes__'),
				'true' => __('Yes', '__poli-shortcodes__')				
			)
		),	
		'animation_style' => array(
			'type' => 'select',
			'label' => __('Animation Style', '__poli-shortcodes__'),
			'desc' => __('Select icon animation style', '__poli-shortcodes__'),
			'options' => array(
				'none' => __('None', '__poli-shortcodes__'),
				'swm_center_expand' => __('Expand from Center', '__poli-shortcodes__'),
				'move_left_to_right' => __('Move Left to Right', '__poli-shortcodes__'),					
				'move_right_to_left' => __('Move Right to Left', '__poli-shortcodes__'),					
				'move_top_to_bottom' => __('Move Top to Bottom', '__poli-shortcodes__'),					
				'move_bottom_to_top' => __('Move Bottom to Top', '__poli-shortcodes__')
			)
		)
	),
	'shortcode' => '[swm_icon icon_name="{{icon_name}}" icon_color="{{icon_color}}" icon_size="{{icon_size}}" icon_style="{{icon_style}}" icon_bg_color="{{icon_bg_color}}" icon_border="{{icon_border}}" border_color="{{border_color}}" link="{{link}}" margin="{{margin}}" rotate="{{rotate}}" animation_style="{{animation_style}}" ]',
	'no_preview' => true, 
	'popup_title' => __('Icon', '__poli-shortcodes__')
);

/* **************************************************************************************
   GAP
************************************************************************************** */

$swm_shortcodes['gap'] = array(
	'params' => array(		
		'size' => array(
			'type' => 'text',
			'label' => __('Size', '__poli-shortcodes__'),
			'desc' => __('Enter gap size in pixels, ems, or percentages ( Example: 30px, 3em or 3% ).', '__poli-shortcodes__'),
			'std' => '30px'
		)			
	),
	'shortcode' => '[gap size="{{size}}"]',
	'no_preview' => true, 
	'popup_title' => __('Gap', '__poli-shortcodes__')
);

/* **************************************************************************************
   COUNTER BOXES
************************************************************************************** */

$swm_shortcodes['counterboxes'] = array(
	'params' => array(),
    'no_preview' => true,
    'shortcode' => '[swm_counter_boxes] {{child_shortcode}} [/swm_counter_boxes]',
    'popup_title' => __('Counter Box', '__poli-shortcodes__'),
    
    'child_shortcode' => array(
        'params' => array(
            'box_bg_color' => array(
				'type' => 'color',
				'label' => __('Box Background Color', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '#FFFFFF'
			),
			'font_color' => array(
				'type' => 'color',
				'label' => __('Font Color', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '#606060'
			),
			'icon' => array(
				'type' => 'fonticon',
				'label' => __('Icon', '__poli-shortcodes__'),
				'desc' => __('Select and Deselect icon by click on icon', '__poli-shortcodes__'),
				'options' => $font_icons
			),
			'icon_bg_color' => array(
				'type' => 'color',
				'label' => __('Icon Background Color', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '#606060'
			),
			'icon_color' => array(
				'type' => 'color',
				'label' => __('Icon Color', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '#FFFFFF'
			),
			'counter_number' => array(
				'type' => 'text',
				'label' => __('Counter Number', '__poli-shortcodes__'),
				'desc' => __('Counter will animated above numter', '__poli-shortcodes__'),
				'std' => '1000'
			),
			'unit' => array(
				'type' => 'text',
				'label' => __('Unit', '__poli-shortcodes__'),
				'desc' => __('Enter the unit for the counter number ( Example %, $, + ).', '__poli-shortcodes__'),
				'std' => ''
			),
			'unit_position' => array(
				'type' => 'select',
				'label' => __('Unit Position', '__poli-shortcodes__'),
				'desc' => '',
				'options' => array(
					'before_number' => __('Before Number', '__poli-shortcodes__'),
					'after_number' => __('After Number', '__poli-shortcodes__')					
				)
			),
			'speed' => array(
				'type' => 'text',
				'label' => __('Animation Speed', '__poli-shortcodes__'),
				'desc' => __('Add animation speed in miliseconds ( Example 1000 = 1 second, 5000 = 5 second. )', '__poli-shortcodes__'),
				'std' => '2000'
			),
			'column' => array(
				'type' => 'select',
				'label' => __('Columln', '__poli-shortcodes__'),
				'desc' => __('Select counter box display column', '__poli-shortcodes__'),
				'options' => array(
					'2' => __('2', '__poli-shortcodes__'),
					'3' => __('3', '__poli-shortcodes__'),
					'4' => __('4', '__poli-shortcodes__'),
					'5' => __('5', '__poli-shortcodes__')					
				)
			),
			'content' => array(
			'std' => __('description text', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Small Description text', '__poli-shortcodes__'),
			'desc' => '',
		)	            
        ),
        'shortcode' => '[swm_counter_box box_bg_color="{{box_bg_color}}" font_color="{{font_color}}" icon="{{icon}}" icon_bg_color="{{icon_bg_color}}" icon_color="{{icon_color}}" counter_number="{{counter_number}}" unit="{{unit}}" unit_position="{{unit_position}}" speed="{{speed}}" column="{{column}}"]{{content}}[/swm_counter_box]',
		'no_preview' => true, 
        'clone_button' => __('Add Another Item', '__poli-shortcodes__')
    )
);

/* **************************************************************************************
   PROGRESS BAR
************************************************************************************** */

$swm_shortcodes['progressbars'] = array(
	'params' => array(),
    'no_preview' => true,
    'shortcode' => '{{child_shortcode}}',
    'popup_title' => __('Progress Bar', '__poli-shortcodes__'),
    
    'child_shortcode' => array(
        'params' => array(
            'percentage' => array(
				'type' => 'select',
				'label' => __('Percentage', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '80',
				'options' => swm_one_to_final_number( 100, false, false )
			),
			'title_text' => array(
				'type' => 'text',
				'label' => __('Title Text', '__poli-shortcodes__'),
				'desc' => '',
				'std' => 'Skill Name'
			),
			'background' => array(
				'type' => 'color',
				'label' => __('Background Color', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '#606060'
			)			            
        ),
        'shortcode' => '[progress_bar percentage="{{percentage}}" title_text="{{title_text}}" background="{{background}}"]',
		'no_preview' => true, 
        'clone_button' => __('Add Another Item', '__poli-shortcodes__')
    )
);

/* **************************************************************************************
   COUNTER CIRCLES
************************************************************************************** */

$swm_shortcodes['countercircles'] = array(
	'params' => array(),
    'no_preview' => true,
    'shortcode' => '[counter_circles] {{child_shortcode}} [/counter_circles]',
    'popup_title' => __('Counter Circles', '__poli-shortcodes__'),
    
    'child_shortcode' => array(
        'params' => array(
            'percentage' => array(
				'type' => 'select',
				'label' => __('Percentage', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '80',
				'options' => swm_one_to_final_number( 100, false, false )
			),
            'bar_color' => array(
				'type' => 'color',
				'label' => __('Bar Color', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '#CCCCCC'
			),
			'track_color' => array(
				'type' => 'color',
				'label' => __('Track Color', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '#606060'
			),
			'track_line_width' => array(
				'type' => 'text',
				'label' => __('Track Line Width', '__poli-shortcodes__'),
				'desc' => __('Enter circle line width in number', '__poli-shortcodes__'),
				'std' => '10'
			),
			'size' => array(
				'type' => 'text',
				'label' => __('Circle Size', '__poli-shortcodes__'),
				'desc' => __('Enter circle size in number', '__poli-shortcodes__'),
				'std' => '220',				
			),
			'speed' => array(
				'type' => 'text',
				'label' => __('Animation Speed', '__poli-shortcodes__'),
				'desc' => __('Add animation speed in miliseconds ( Example 1000 = 1 second, 5000 = 5 second. )', '__poli-shortcodes__'),
				'std' => '2000'
			),
			'content' => array(
			'std' => __('Mytext', '__poli-shortcodes__'),
			'type' => 'text',
			'label' => __('Circle Text', '__poli-shortcodes__'),
			'desc' => __('This text will display inside animated circle', '__poli-shortcodes__'),
			),  
			'circle_text_size' => array(
				'type' => 'select',
				'label' => __('Circle Text Size', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '30',
				'options' => swm_one_to_final_number( 100, false, false )
			),
			'desc_text' => array(
				'type' => 'text',
				'label' => __('Description Text', '__poli-shortcodes__'),
				'desc' => __('This text will display below circle', '__poli-shortcodes__'),
				'std' => __('Description here', '__poli-shortcodes__'),
			),
			'desc_text_size' => array(
				'type' => 'select',
				'label' => __('Description Text Size', '__poli-shortcodes__'),
				'desc' => '',
				'std' => '30',
				'options' => swm_one_to_final_number( 100, false, false )
			)			         
        ),
        'shortcode' => '[counter_circle percentage="{{percentage}}" bar_color="{{bar_color}}" track_color="{{track_color}}" track_line_width="{{track_line_width}}" size="{{size}}" speed="{{speed}}" circle_text_size="{{circle_text_size}}" desc_text="{{desc_text}}" desc_text_size="{{desc_text_size}}"]{{content}}[/counter_circle]',
		'no_preview' => true, 
        'clone_button' => __('Add Another Item', '__poli-shortcodes__')
    )
);

/* **************************************************************************************
   FULL WIDTH SECTION
************************************************************************************** */

$swm_shortcodes['fullwidthsection'] = array(
	'params' => array(		
		'background_color' => array(
			'type' => 'color',
			'label' => __('Background Color', '__poli-shortcodes__'),
			'desc' => __('Set section backgorund color', '__poli-shortcodes__'),
			'std' => '#ffffff'
		),	
		'background_image' => array(
			'type' => 'upload',
			'label' => __('Background Image', '__poli-shortcodes__'),
			'desc' => __('Upload background image', '__poli-shortcodes__')			
		),
		'background_repeat' => array(
			'type' => 'select',
			'label' => __('Background Repeat', '__poli-shortcodes__'),
			'desc' => '',
			'std' => 'repeat',
			'options' => array(
				'repeat'    => __( 'Repeat', '__poli-shortcodes__' ),
		        'no-repeat' => __( 'No Repeat', '__poli-shortcodes__' ),
		        'repeat-x'  => __( 'Repeat X', '__poli-shortcodes__' ),
		        'repeat-y'  => __( 'Repeat Y', '__poli-shortcodes__' )  										
			)
		),	
		'background_position' => array(
			'type' => 'select',
			'label' => __('Background Position', '__poli-shortcodes__'),
			'desc' => '',
			'std' => 'center-top',
			'options' => array(
				"left-top"      => __( 'Left Top', '__poli-shortcodes__' ),
		        "left-center"   => __( 'Left Center', '__poli-shortcodes__' ),
		        "left-bottom"   => __( 'Left Bottom', '__poli-shortcodes__' ),
		        "right-top"     => __( 'Right Top', '__poli-shortcodes__' ),
		        "right-center"  => __( 'Right Center', '__poli-shortcodes__' ),
		        "right-bottom"  => __( 'Right Bottom', '__poli-shortcodes__' ),
		        "center-top"    => __( 'Center Top', '__poli-shortcodes__' ),
		        "center-center" => __( 'Center Center', '__poli-shortcodes__' ),
		        "center-bottom" => __( 'Center Bottom', '__poli-shortcodes__' ) 										
			)
		),	
		'background_attachment' => array(
			'type' => 'select',
			'label' => __('Background Attachment', '__poli-shortcodes__'),
			'desc' => '',
			'std' => 'fixed',
			'options' => array(
				'scroll'    => __( 'Scroll', '__poli-shortcodes__' ),
       			'fixed' => __( 'Fixed', '__poli-shortcodes__' )  									
			)
		),	
		'background_stretch' => array(
			'type' => 'select',
			'label' => __('100% Background Image Width', '__poli-shortcodes__'),
			'desc' => '',
			'std' => 'false',
			'options' => array(
				'false'    => __( 'No', '__poli-shortcodes__' ),
       			'true' => __( 'Yes', '__poli-shortcodes__' )  									
			)
		),	
		'parallax_effect' => array(
			'type' => 'select',
			'label' => __('Enable Parallax Scrolling', '__poli-shortcodes__'),
			'desc' => __('<a href="http://www.ianlunn.co.uk/plugins/jquery-parallax/" target="_blank">Click here</a> to know more about Parallax Scrolling', '__poli-shortcodes__'),
			'std' => 'false',
			'options' => array(
				'true' => __( 'Yes', '__poli-shortcodes__' ),
				'false'    => __( 'No', '__poli-shortcodes__' )       			  									
			)
		),
		'parallax_speed' => array(
			'type' => 'text',
			'label' => __('Parallax Scrolling Speed', '__poli-shortcodes__'),
			'desc' => __('Enter background image scrolling speed value in number between -10.0 to 10.0. <br />Minus value will scroll background image down. <br /> ( Example 1.5, 2.0, -4.5, 2.5 )  ', '__poli-shortcodes__'),
			'std' => '2.5'
		),
		'border_width' => array(
			'type' => 'select',
			'label' => __('Border Width', '__poli-shortcodes__'),	
			'desc' => __('If you want to make section with border then set border width and then set top and/or bottom border colors', '__poli-shortcodes__'),		
			'std' => '0',
			'options' => swm_one_to_final_number( 10, false, false, 0 )
		),	
		'border_top_color' => array(
			'type' => 'color',
			'label' => __('Top Border Color', '__poli-shortcodes__'),
			'std' => ''
		),
		'border_bottom_color' => array(
			'type' => 'color',
			'label' => __('Bottom Border Color', '__poli-shortcodes__'),			
			'std' => ''
		),
		'arrow_direction' => array(
			'type' => 'select',
			'label' => __('Arrow Direction', '__poli-shortcodes__'),
			'desc' => __('If you want to make section with top or bottom direction arrow then select from above drop down.', '__poli-shortcodes__'),
			'std' => 'fixed',
			'options' => array(
				'none'    => __( 'Hide Arrow', '__poli-shortcodes__' ),
				'top'    => __( 'Display Arrow Top', '__poli-shortcodes__' ),
       			'bottom' => __( 'Display Arrow Bottom', '__poli-shortcodes__' )								
			)
		),
		'arrow_color' => array(
			'type' => 'color',
			'label' => __('Arrow Color', '__poli-shortcodes__'),			
			'std' => ''
		),
		'padding_top' => array(
			'type' => 'text',
			'label' => __('Padding Top', '__poli-shortcodes__'),
			'desc' => __('Enter section padding top value in pixels or em. ( Example 20px, 2em )', '__poli-shortcodes__'),
			'std' => '40px'
		),
		'padding_bottom' => array(
			'type' => 'text',
			'label' => __('Padding Bottom', '__poli-shortcodes__'),
			'desc' => __('Enter section padding bottom value in pixels or em. ( Example 20px, 2em )', '__poli-shortcodes__'),
			'std' => '40px'
		),		
		'font_color' => array(
			'type' => 'color',
			'label' => __('Section Font Color', '__poli-shortcodes__'),			
			'std' => '#606060'
		),
		'section_id' => array(
			'type' => 'text',
			'label' => __('Section ID', '__poli-shortcodes__'),
			'desc' => __('Enter unique ID to style this section with custom CSS style.', '__poli-shortcodes__'),
			'std' => ''
		),
		'content' => array(
			'std' => __('Add section content here', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Section Content', '__poli-shortcodes__'),
			'desc' => ''
		)			
	),
	'shortcode' => '[swm_section background_color="{{background_color}}" background_image="{{background_image}}" background_repeat="{{background_repeat}}" background_position="{{background_position}}" background_attachment="{{background_attachment}}" background_stretch="{{background_stretch}}" parallax_effect="{{parallax_effect}}" parallax_speed="{{parallax_speed}}" padding_top="{{padding_top}}" padding_bottom="{{padding_bottom}}" font_color="{{font_color}}" border_top_color="{{border_top_color}}" border_bottom_color="{{border_bottom_color}}" border_width="{{border_width}}" arrow_direction="{{arrow_direction}}" arrow_color="{{arrow_color}}" section_id="{{section_id}}" ]{{content}}[/swm_section]',
	'no_preview' => true, 
	'popup_title' => __('Full Width Section for "Page"', '__poli-shortcodes__')
);

/* **************************************************************************************
   The Event Calendar - Upcoming Events
************************************************************************************** */

$swm_shortcodes['upcomingevents'] = array(
	'params' => array(		
		'post_limit' => array(
			'type' => 'text',
			'label' => __('Post Limit', '__poli-shortcodes__'),
			'desc' => __('Number of posts to display', '__poli-shortcodes__'),
			'std' => '4'
		),
		'desc_limit' => $recent_posts_desc_limit,
		'event_type' => array(
			'type' => 'select',
			'label' => __('Event Type', '__poli-shortcodes__'),
			'desc' => __('Select dropcaps style', '__poli-shortcodes__'),
			'options' => array(				
				'list' => __('Upcoming', '__poli-shortcodes__'),
				'past' => __('Past', '__poli-shortcodes__')				
			)
		),
			
	),
	'shortcode' => '[swm_upcoming_events post_limit="{{post_limit}}" desc_limit="{{desc_limit}}" event_type="{{event_type}}"]',
	'no_preview' => true, 
	'popup_title' => __('Upcoming Events', '__poli-shortcodes__')
);

/* ************************************************************************************** 
    DROPCAPS
************************************************************************************** */

$swm_shortcodes['dropcaps'] = array(
	'params' => array(		
		'style' => array(
			'type' => 'select',
			'label' => __('Dropcap Style', '__poli-shortcodes__'),
			'desc' => __('Select dropcaps style', '__poli-shortcodes__'),
			'options' => array(				
				'light' => __('Light', '__poli-shortcodes__'),
				'dark' => __('Dark', '__poli-shortcodes__')				
			)
		),
		'content' => array(
			'std' => __('A', '__poli-shortcodes__'),
			'type' => 'text',
			'label' => __('Dropcap Text', '__poli-shortcodes__'),
			'desc' => __('Add the dropcap text', '__poli-shortcodes__'),
		)
		
	),
	'shortcode' => '[swm_dropcap style="{{style}}"] {{content}} [/swm_dropcap]',
	'no_preview' => true, 
	'popup_title' => __('Dropcaps', '__poli-shortcodes__')
);

/* ************************************************************************************** 
    FONT
************************************************************************************** */

$swm_shortcodes['font'] = array(
	'params' => array(		
		'color' => array(
			'type' => 'color',
			'label' => __('Font Color', '__poli-shortcodes__'),			
			'std' => ''
		),
		'size' => array(
			'type' => 'select',
			'label' => __('Font Size', '__poli-shortcodes__'),			
			'std' => '22',
			'options' => swm_one_to_final_number( 200, false, false, 10 )
		),	
		'line_height' => array(
			'type' => 'select',
			'label' => __('Font Line Height', '__poli-shortcodes__'),			
			'std' => '22',
			'options' => swm_one_to_final_number( 200, false, false, 10 )
		),		
		'weight' => array(
			'type' => 'select',
			'label' => __('Font Weight', '__poli-shortcodes__'),			
			'options' => array(				
				'normal' => __('Normal', '__poli-shortcodes__'),
				'bold' => __('Bold', '__poli-shortcodes__')				
			)
		),	
		'content' => array(
			'std' => __('Your Text Here', '__poli-shortcodes__'),
			'type' => 'textarea',
			'label' => __('Description Text', '__poli-shortcodes__')
		)
		
	),
	'shortcode' => '[swm_font weight="{{weight}}" size="{{size}}" color="{{color}}" line_height="{{line_height}}"] {{content}} [/swm_font]',
	'no_preview' => true, 
	'popup_title' => __('Font', '__poli-shortcodes__')
);




?>