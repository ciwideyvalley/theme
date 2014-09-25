<?php
/**
 * Play slider's configurations
 *
 * @since Evangelist 1.0
 */

$options = array(
    'tabs' => array(
        array(
            'name' => __('Slider Settings', 'tfuse'),
            'id' => 'slider_settings', #do no t change this ID
            'headings' => array(
                array(
                    'name' => __('Slider Settings', 'tfuse'),
                    'options' => array(
                        array('name' => __('Slider Title', 'tfuse'),
                            'desc' => __('Change the title of your slider. Only for internal use (Ex: Homepage)', 'tfuse'),
                            'id' => 'slider_title',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true
                            ),
                        array('name' => __('Enable info', 'tfuse'),
                            'desc' => __('Show More info', 'tfuse'),
                            'id' => 'slider_info',
                            'value' => false,
                            'type' => 'checkbox',
                            ),
                        array('name' => __('Enable Time', 'tfuse'),
                            'desc' => __('Show Local Time', 'tfuse'),
                            'id' => 'slider_time',
                            'value' => false,
                            'type' => 'checkbox',
                            ),
                        array('name' => __('Tripadvisor Widget Code', 'tfuse'),
                            'desc' => __('Get your widget code from ', 'tfuse') . '<a href="http://www.tripadvisor.com/Widgets-d0" target="_blank">'.__('http://www.tripadvisor.com/Widgets-d0','tfuse').'</a>',
                            'id' => 'slider_tripadvisor_code',
                            'value' => '',
                            'type' => 'textarea',
                            ),
                        array('name' => __('Button title', 'tfuse'),
                            'desc' => __('Button Title', 'tfuse'),
                            'id' => 'slider_button',
                            'value' => '',
                            'type' => 'text',
                            ),
                        array('name' => __('Link', 'tfuse'),
                            'desc' => __('Button Link', 'tfuse'),
                            'id' => 'slider_link',
                            'value' => '',
                            'type' => 'text',
                            ),
                    )
                )
            )
        ),
        array(
            'name' => __('Add/Edit Slides', 'tfuse'),
            'id' => 'slider_setup', #do not change ID
            'headings' => array(
                array(
                    'name' => __('Add New Slide', 'tfuse'), #do not change
                    'options' => array(
                        array('name' => __('Title', 'tfuse'),
                            'desc' => __('Give a title', 'tfuse'),
                            'id' => 'slide_title',
                            'value' => '',
                            'type' => 'text'),
                        array('name' => __('Icon Class', 'tfuse'),
                            'desc' => __('Give icon class (ex:icon-plane).More icons ', 'tfuse'). '<a href="http://getbootstrap.com/2.3.2/base-css.html#icons" target="_blank">'.__('http://getbootstrap.com/2.3.2/base-css.html#icons','tfuse').'</a>',
                            'id' => 'slide_icon',
                            'value' => '',
                            'type' => 'text'),
                        array('name' => __('Active', 'tfuse'),
                            'desc' => __('Select as active tab?', 'tfuse'),
                            'id' => 'slide_active',
                            'value' => 'no',
                            'options' => array('no'=>'No','yes'=> 'Yes'),
                            'type' => 'select'),
                        array('name' => __('Type', 'tfuse'),
                            'desc' => __('Select type', 'tfuse'),
                            'id' => 'slide_type',
                            'value' => '',
                            'options' => array('gallery'=>'Gallery','custom'=> 'Custom Info'),
                            'type' => 'select',
                            'divider' => true),
                        
                        array('name' => __('Gallery Title', 'tfuse'),
                            'desc' => __('Type Gallery Title', 'tfuse'),
                            'id' => 'slide_gallery_title',
                            'value' => '',
                            'type' => 'text'),
                        array('name' => __('Gallery', 'tfuse'),
                            'desc' => __('Upload Gallery', 'tfuse'),
                            'id' => 'slide_gallery',
                            'value' => '',
                            'type' => 'multi_upload2'),
                        array('name' => __('Type', 'tfuse'),
                            'desc' => __('Select type', 'tfuse'),
                            'id' => 'slide_type_2',
                            'value' => '',
                            'options' => array('image'=>'Image','map'=> 'Map'),
                            'type' => 'select'),
                        array('name' => __('Image', 'tfuse'),
                            'desc' => __('Upload Image', 'tfuse'),
                            'id' => 'slide_image',
                            'value' => '',
                            'type' => 'upload'),
                        array('name' => __('Map Position', 'tfuse'),
                            'desc' => __('Choose location', 'tfuse'),
                            'id' => 'slide_map',
                            'value' => '',
                            'type' => 'maps'),
                        array('name' => __('Left column', 'tfuse'),
                            'desc' => __('Info for left column', 'tfuse'),
                            'id' => 'slide_left',
                            'value' => '',
                            'type' => 'textarea'),
                        array('name' => __('Right column', 'tfuse'),
                            'desc' => __('Info for right column', 'tfuse'),
                            'id' => 'slide_right',
                            'value' => '',
                            'type' => 'textarea'),
                    )
                )
            )
        ),
        array(
            'name' => __('Category Setup', 'tfuse'),
            'id' => 'slider_type_categories',
            'headings' => array(
                array(
                    'name' => __('Category options', 'tfuse'),
                    'options' => array(
                        
                    )
                )
            )
        ),
        array(
            'name' => __('Posts Setup', 'tfuse'),
            'id' => 'slider_type_posts',
            'headings' => array(
                array(
                    'name' => __('Posts options', 'tfuse'),
                    'options' => array(
                        
                    )
                )
            )
        )
    )
);
$options['extra_options'] = array();
?>