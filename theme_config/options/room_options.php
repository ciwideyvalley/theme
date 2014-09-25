<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for posts area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    /* ----------------------------------------------------------------------------------- */
    /* Sidebar */
    /* ----------------------------------------------------------------------------------- */
    
    /* Single Post */
    array('name' => __('Single Post','tfuse'),
        'id' => TF_THEME_PREFIX . '_side_media',
        'type' => 'metabox',
        'context' => 'side',
        'priority' => 'low' /* high/low */
    ),
    
    array('name' => __('Enable Comments','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_disable_comments',
        'value' => tfuse_options('disable_posts_comments','true'),
        'type' => 'checkbox',
        'divider' => true
    ),

     // Post Title
    array('name' => __('Post Title','tfuse'),
        'desc' => __('Select your preferred Post Title.','tfuse'),
        'id' => TF_THEME_PREFIX . '_page_title',
        'value' => 'default_title',
        'options' => array('hide_title' => __('Hide Post Title','tfuse'), 'default_title' => __('Default Title','tfuse'), 'custom_title' => __('Custom Title','tfuse')),
        'type' => 'select'
    ),
    // Custom Title
    array('name' => __('Custom Title','tfuse'),
        'desc' => __('Enter your custom title for this post.','tfuse'),
        'id' => TF_THEME_PREFIX . '_custom_title',
        'value' => '',
        'type' => 'text'
    ),
    
    /* ----------------------------------------------------------------------------------- */
    /* After Textarea */
    /* ----------------------------------------------------------------------------------- */
    array('name' => __('Room Info','tfuse'),
        'id' => TF_THEME_PREFIX . '_room_info',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Thumbnail Image
    array('name' => __('Gallery','tfuse'),
        'desc' => __('Upload an image or more for your gallery post','tfuse'),
        'id' => TF_THEME_PREFIX . '_room_gallery',
        'value' => '',
        'type' => 'multi_upload',
        'divider' => true
        
    ),
    array('name' => __('Room type','tfuse'),
        'desc' => __('Select room type.','tfuse'),
        'id' => TF_THEME_PREFIX . '_room_type',
        'value' => 'without',
        'options' => tfuse_rooms_types(),
        'type' => 'select',
        'divider'=>true
    ),
    array('name' => __('Room Description','tfuse'),
        'desc' => __('Give a short room description.','tfuse'),
        'id' => TF_THEME_PREFIX . '_room_desc',
        'value' => '',
        'type' => 'textarea',
        'divider'=>true
    ),
    array('name' => __('Room Price','tfuse'),
        'desc' => __('Room type price.','tfuse'),
        'id' => TF_THEME_PREFIX . '_room_price',
        'value' => '',
        'type' => 'text',
        'divider'=>true
    ),
     array('name' => __('Room Price','tfuse'),
        'desc' => __('Room type price.','tfuse'),
        'id' => TF_THEME_PREFIX . '_roocm_price',
        'value' => '',
        'type' => 'datepicker',
        'divider'=>true
    ),
    array(
        'name' => __('Room Unavailable Between','tfuse'),
            'id' => TF_THEME_PREFIX . '_content_tabs_table',
            'desc' => __('In this time period the room will not be displayed in the search results.','tfuse'),
            'btn_labels'=>array('Add Row','Delete Row'),
            'class' => 'tf-post-table ',
            'style' => '',
            'default_value' => array(
                'tab_title'=>'',
                'tab_content'=>''
            ),
            'value' => array(
                array(
                    'tab_title'=>'',
                    'tab_content'=>''
                )
            ),
            'type' => 'div_table',
            'columns' => array(
                array(
                    'id' =>  'tab_title',
                    'type' => 'datepicker',
                    'properties' => array('placeholder' => __('Select Date', 'tfuse'))
                ),
                array(
                    'id' => 'tab_content',
                    'value' => '',
                    'type' => 'datepicker',
                    'properties' => array('placeholder' => __('Select Date', 'tfuse'))
                )
            )
        ),
    /* Header Options */
    array('name' => __('Header','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    // Element of Hedear
    array('name' => __('Element of Hedear','tfuse'),
        'desc' => __('Select type of element on the header.','tfuse'),
        'id' => TF_THEME_PREFIX . '_header_element',
        'value' => 'without',
        'options' => array('without' => __('Without Header Element','tfuse'),'slider' => __('Slider on Header','tfuse'),'map' => __('Map on Header','tfuse')),
        'type' => 'select'
    ),
    // Select Header Slider
    $this->ext->slider->model->has_sliders() ?
            array(
        'name' => __('Slider','tfuse'),
        'desc' => __('Select a slider for your post. The sliders are created on the','tfuse').' <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">'.__('Sliders page','tfuse').'</a>.',
        'id' => TF_THEME_PREFIX . '_select_slider',
        'value' => '',
        'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('code','codecanyonfull','tabs')),
        'type' => 'select'
            ) :
            array(
        'name' => __('Slider','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_select_slider',
        'value' => '',
        'html' => __('No sliders created yet. You can start creating one ','tfuse').'<a href="' . admin_url('admin.php?page=tf_slider_list') . '">'.__('here','tfuse').'</a>.',
        'type' => 'raw'
            ) ,
    array(
        'name' => __('Map position','tfuse'),
         'desc'=>__('Choose location','tfuse'),
        'id' => TF_THEME_PREFIX . '_page_map',
        'value' => '',
        'type' => 'maps',
        'divider' => true
    ),
    
     array('name' => __('Select Header Bottom','tfuse'),
            'desc' => __('Select your preferred  header bottom option.','tfuse'),
            'id' => TF_THEME_PREFIX . '_header_bottom',
            'value' => '',
            'options' => array('without' => __('Without Header Bottom Element','tfuse'),'slider' => __('Slider','tfuse')),
            'type' => 'select',
        ),
    // Select Header Slider
    $this->ext->slider->model->has_sliders() ?
            array(
        'name' => __('Slider','tfuse'),
        'desc' => __('Select a slider for your post. The sliders are created on the','tfuse').' <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">'.__('Sliders page','tfuse').'</a>.',
        'id' => TF_THEME_PREFIX . '_select_slider_bottom',
        'value' => '',
        'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('info')),
        'type' => 'select',
            ) :
            array(
        'name' => __('Slider','tfuse'),
        'desc' => '',
        'id' => TF_THEME_PREFIX . '_select_slider_bottom',
        'value' => '',
        'html' => __('No sliders created yet. You can start creating one ','tfuse').'<a href="' . admin_url('admin.php?page=tf_slider_list') . '">'.__('here','tfuse').'</a>.',
        'type' => 'raw'
            ) ,
    
	/* Content Options */
    array('name' => __('Content Options','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_option',
        'type' => 'metabox',
        'context' => 'normal'
    ),
    array(
        'name' => __('Content Color','tfuse'),
        'desc' => __('Change content color' ,'tfuse'),
        'id' => TF_THEME_PREFIX . '_content_color',
        'value' => tfuse_options('content_color'),
        'type' => 'colorpicker',
        'divider' => true
    ),
    array('name' => __('Shortcodes before Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_top',
        'value' => '',
        'type' => 'textarea'
    ),
    // Bottom Shortcodes
    array('name' => __('Shortcodes after Content','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bot',
        'value' => '',
        'type' => 'textarea'
    ),
    array('name' => __('Shortcodes after Content 2','tfuse'),
        'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
        'id' => TF_THEME_PREFIX . '_content_bottom',
        'value' => '',
        'type' => 'textarea'
    )
);

?>