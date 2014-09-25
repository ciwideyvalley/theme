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
                            'divider' => true),
                        array('name' => __('Resize images?', 'tfuse'),
                            'desc' => __('Want to let our script to resize the images for you? Or do you want to have total control and upload images with the exact slider image size?', 'tfuse'),
                            'id' => 'slider_image_resize',
                            'value' => 'false',
                            'type' => 'checkbox')
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
                        array('name' => __('Transition', 'tfuse'),
                            'desc' => __('Image Transition.', 'tfuse'),
                            'id' => 'slide_transition',
                            'value' => '',
                            'options' => array('random' => 'Random','fade' => 'Fade','boxslide'=>'Boxslide',
                                'boxfade' => 'Boxfade','slotzoom-horizontal' => 'Slotzoom-Horizontal',
                                'slotslide-horizontal' => 'Slotslide-Horizontal','slotfade-horizontal' => 'Slotfade-Horizontal',
                                'slotzoom-vertical' => 'Slotzoom-Vertical','slotslide-vertical' => 'Slotslide-Vertical',
                                'slotfade-vertical' => 'Slotfade-Vertical','curtain-1' => 'Curtain-1',
                                'curtain-2' => 'Curtain-2','curtain-3' => 'Curtain-3','slideleft' => 'Slideleft','slideright' => 'Slideright',
                                'slideup' => 'Slideup','slidedown' => 'Slidedown','slidehorizontal' => 'Slidehorizontal',
                                'slidevertical' => 'Slidevertical',
                                'papercut' => 'Papercut','flyin' => 'Flyin','turnoff' => 'Turnoff','cube' => 'Cube',
                                '3dcurtain-vertical' => '3dcurtain-vertical','3dcurtain-horizontal' => '3dcurtain-horizontal'),
                            'type' => 'select',
                            'divider' => true),
                        array('name' => __('Image <br />(1920px × 675px)', 'tfuse'),
                            'desc' => __('You can upload an image from your hard drive or use one that was already uploaded by pressing  "Insert into Post" button from the image uploader plugin.', 'tfuse'),
                            'id' => 'slide_src',
                            'value' => '',
                            'type' => 'upload',
                            'media' => 'image',
                            'required' => TRUE,
                            'divider' => true
                            ),
                        array('name' => __('Caption 1', 'tfuse'),
                            'desc' => __('Firt Caption', 'tfuse'),
                            'id' => 'slide_title1',
                            'value' => '',
                            'type' => 'text'
                            ),
                        array('name' => __('Advanced animation settings', 'tfuse'),
                            'desc' => __('Enable Advanced animation settings', 'tfuse'),
                            'id' => 'slide_advanced_animation_1',
                            'value' => true,
                            'type' => 'checkbox'
                            ),
                        array('name' => __('Incoming Animation', 'tfuse'),
                            'desc' => __('Select Caption Incoming Animation.', 'tfuse'),
                            'id' => 'slide_animation1',
                            'value' => 'sft',
                            'options' => array('sft' => 'Short from Top',
                                               'sfb' => 'Short from Bottom',
                                               'sfr' => 'Short from Right',
                                               'sfl' => 'Short from Left',
                                               'lft' => 'Long from Top',
                                               'lfb' => 'Long from Bottom',
                                               'lfr' => 'Long from Right',
                                               'lfl' => 'Long from Left',
                                               'fade' => 'Fading',
                                            ),
                            'type' => 'select'),
                        array('name' => __('Outgoing Animation', 'tfuse'),
                            'desc' => __('Select Caption Outgoing Animation.', 'tfuse'),
                            'id' => 'slide_outanimation1',
                            'value' => 'stt',
                            'options' => array('stt' => 'Short to Top',
                                               'stb' => 'Short to Bottom',
                                               'sfr' => 'Short to Right',
                                               'stl' => 'Short to Left',
                                               'ltt' => 'Long to Top',
                                               'ltb' => 'Long to Bottom',
                                               'ltr' => 'Long to Right',
                                               'ltl' => 'Long to Left',
                                               'fade' => 'Fading',
                                            ),
                            'type' => 'select'),
                        array('name' => __('Type', 'tfuse'),
                            'desc' => __('Caption Type.', 'tfuse'),
                            'id' => 'slide_type1',
                            'value' => '',
                            'options' => array('cap_small_white' => 'Caption Small White',
                                               'cap_big_white' => 'Caption Big White',
                                               'cap_medium_white' => 'Caption Medium White',
                                               'cap_small_white_bg' => 'Caption Small White With Background',
                                               'cap_big_white_bg' => 'Caption Big White With Background',
                                               'cap_medium_white_bg' => 'Caption Medium White With Background',
                                            ),
                            'type' => 'select'),
                        array('name' => __('Position X', 'tfuse'),
                            'desc' => __('Horizontal Position', 'tfuse'),
                            'id' => 'slide_pos1x',
                            'value' => '440',
                            'type' => 'text'
                            ),
                        array('name' => __('Position Y', 'tfuse'),
                            'desc' => __('Vertical Position', 'tfuse'),
                            'id' => 'slide_pos1y',
                            'value' => '430',
                            'type' => 'text'
                            ),
                        array('name' => __('Speed', 'tfuse'),
                            'desc' => __('Transition Speed', 'tfuse'),
                            'id' => 'slide_speed1',
                            'value' => '600',
                            'type' => 'text'
                            ),
                        array('name' => __('Start', 'tfuse'),
                            'desc' => __('Transition Start', 'tfuse'),
                            'id' => 'slide_start1',
                            'value' => '500',
                            'type' => 'text'
                            ),
                        array('name' => __('End', 'tfuse'),
                            'desc' => __('Transition End', 'tfuse'),
                            'id' => 'slide_end1',
                            'value' => '5000',
                            'type' => 'text',
                            'divider' => true
                            ),
                        array('name' => __('Caption 2', 'tfuse'),
                            'desc' => __('Firt Caption', 'tfuse'),
                            'id' => 'slide_title2',
                            'value' => '',
                            'type' => 'text'
                            ),
                        array('name' => __('Advanced animation settings', 'tfuse'),
                            'desc' => __('Enable Advanced animation settings', 'tfuse'),
                            'id' => 'slide_advanced_animation_2',
                            'value' => true,
                            'type' => 'checkbox'
                            ),
                        array('name' => __('Incoming Animation', 'tfuse'),
                            'desc' => __('Select Caption Incoming Animation.', 'tfuse'),
                            'id' => 'slide_animation2',
                            'value' => 'sft',
                            'options' => array('sft' => 'Short from Top',
                                               'sfb' => 'Short from Bottom',
                                               'sfr' => 'Short from Right',
                                               'sfl' => 'Short from Left',
                                               'lft' => 'Long from Top',
                                               'lfb' => 'Long from Bottom',
                                               'lfr' => 'Long from Right',
                                               'lfl' => 'Long from Left',
                                               'fade' => 'Fading',
                                            ),
                            'type' => 'select'),
                        array('name' => __('Outgoing Animation', 'tfuse'),
                            'desc' => __('Select Caption Outgoing Animation.', 'tfuse'),
                            'id' => 'slide_outanimation2',
                            'value' => 'stt',
                            'options' => array('stt' => 'Short to Top',
                                               'stb' => 'Short to Bottom',
                                               'sfr' => 'Short to Right',
                                               'stl' => 'Short to Left',
                                               'ltt' => 'Long to Top',
                                               'ltb' => 'Long to Bottom',
                                               'ltr' => 'Long to Right',
                                               'ltl' => 'Long to Left',
                                               'fade' => 'Fading',
                                            ),
                            'type' => 'select'),
                        array('name' => __('Type', 'tfuse'),
                            'desc' => __('Caption Type.', 'tfuse'),
                            'id' => 'slide_type2',
                            'value' => '',
                            'options' => array('cap_small_white' => 'Caption Small White',
                                               'cap_big_white' => 'Caption Big White',
                                               'cap_medium_white' => 'Caption Medium White',
                                               'cap_small_white_bg' => 'Caption Small White With Background',
                                               'cap_big_white_bg' => 'Caption Big White With Background',
                                               'cap_medium_white_bg' => 'Caption Medium White With Background',
                                            ),
                            'type' => 'select'),
                        array('name' => __('Position X', 'tfuse'),
                            'desc' => __('Horizontal Position', 'tfuse'),
                            'id' => 'slide_pos2x',
                            'value' => '440',
                            'type' => 'text'
                            ),
                        array('name' => __('Position Y', 'tfuse'),
                            'desc' => __('Vertical Position', 'tfuse'),
                            'id' => 'slide_pos2y',
                            'value' => '430',
                            'type' => 'text'
                            ),
                        array('name' => __('Speed', 'tfuse'),
                            'desc' => __('Transition Speed', 'tfuse'),
                            'id' => 'slide_speed2',
                            'value' => '600',
                            'type' => 'text'
                            ),
                        array('name' => __('Start', 'tfuse'),
                            'desc' => __('Transition Start', 'tfuse'),
                            'id' => 'slide_start2',
                            'value' => '500',
                            'type' => 'text'
                            ),
                        array('name' => __('End', 'tfuse'),
                            'desc' => __('Transition End', 'tfuse'),
                            'id' => 'slide_end2',
                            'value' => '5000',
                            'type' => 'text',
                            'divider' => true
                            ),
                        array('name' => __('Caption 3', 'tfuse'),
                            'desc' => __('Firt Caption', 'tfuse'),
                            'id' => 'slide_title3',
                            'value' => '',
                            'type' => 'text'
                            ),
                        array('name' => __('Advanced animation settings', 'tfuse'),
                            'desc' => __('Enable Advanced animation settings', 'tfuse'),
                            'id' => 'slide_advanced_animation_3',
                            'value' => true,
                            'type' => 'checkbox'
                            ),
                        array('name' => __('Incoming Animation', 'tfuse'),
                            'desc' => __('Select Caption Incoming Animation.', 'tfuse'),
                            'id' => 'slide_animation3',
                            'value' => 'sft',
                            'options' => array('sft' => 'Short from Top',
                                               'sfb' => 'Short from Bottom',
                                               'sfr' => 'Short from Right',
                                               'sfl' => 'Short from Left',
                                               'lft' => 'Long from Top',
                                               'lfb' => 'Long from Bottom',
                                               'lfr' => 'Long from Right',
                                               'lfl' => 'Long from Left',
                                               'fade' => 'Fading',
                                            ),
                            'type' => 'select'),
                        array('name' => __('Outgoing Animation', 'tfuse'),
                            'desc' => __('Select Caption Outgoing Animation.', 'tfuse'),
                            'id' => 'slide_outanimation3',
                            'value' => 'stt',
                            'options' => array('stt' => 'Short to Top',
                                               'stb' => 'Short to Bottom',
                                               'sfr' => 'Short to Right',
                                               'stl' => 'Short to Left',
                                               'ltt' => 'Long to Top',
                                               'ltb' => 'Long to Bottom',
                                               'ltr' => 'Long to Right',
                                               'ltl' => 'Long to Left',
                                               'fade' => 'Fading',
                                            ),
                            'type' => 'select'),
                        array('name' => __('Type', 'tfuse'),
                            'desc' => __('Caption Type.', 'tfuse'),
                            'id' => 'slide_type3',
                            'value' => '',
                            'options' => array('cap_small_white' => 'Caption Small White',
                                               'cap_big_white' => 'Caption Big White',
                                               'cap_medium_white' => 'Caption Medium White',
                                               'cap_small_white_bg' => 'Caption Small White With Background',
                                               'cap_big_white_bg' => 'Caption Big White With Background',
                                               'cap_medium_white_bg' => 'Caption Medium White With Background',
                                            ),
                            'type' => 'select'),
                        array('name' => __('Position X', 'tfuse'),
                            'desc' => __('Horizontal Position', 'tfuse'),
                            'id' => 'slide_pos3x',
                            'value' => '440',
                            'type' => 'text'
                            ),
                        array('name' => __('Position Y', 'tfuse'),
                            'desc' => __('Vertical Position', 'tfuse'),
                            'id' => 'slide_pos3y',
                            'value' => '430',
                            'type' => 'text'
                            ),
                        array('name' => __('Speed', 'tfuse'),
                            'desc' => __('Transition Speed', 'tfuse'),
                            'id' => 'slide_speed3',
                            'value' => '600',
                            'type' => 'text'
                            ),
                        array('name' => __('Start', 'tfuse'),
                            'desc' => __('Transition Start', 'tfuse'),
                            'id' => 'slide_start3',
                            'value' => '500',
                            'type' => 'text'
                            ),
                        array('name' => __('End', 'tfuse'),
                            'desc' => __('Transition End', 'tfuse'),
                            'id' => 'slide_end3',
                            'value' => '5000',
                            'type' => 'text',
                            'divider' => true
                            ),
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
                        array(
                            'name' => __('Select specific categories', 'tfuse'),
                            'desc' => __('Pick one or more
categories by starting to type the category name. If you leave blank the slider will fetch images
from all <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit-tags.php?taxonomy=events">Events Categories</a>.',
                            'id' => 'categories_select',
                            'type' => 'multi',
                            'subtype' => 'category'
                        ),
                        array(
                            'name' => __('Number of images in the slider', 'tfuse'),
                            'desc' => __('How many images do you want in the slider?', 'tfuse'),
                            'id' => 'sliders_posts_number',
                            'value' => 6,
                            'type' => 'text'
                        )
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
                        array(
                            'name' => __('Select specific Posts', 'tfuse'),
                            'desc' => __('Pick one or more <a target="_new" href="', 'tfuse') . get_admin_url() . 'edit.php">posts</a> by starting to type the Post name. The slider will be populated with images from the posts
you selected.',
                            'id' => 'posts_select',
                            'type' => 'multi',
                            'subtype' => 'post'
                        ),
                        array(
                            'name' => __('Number of images in the slider', 'tfuse'),
                            'desc' => __('How many images do you want in the slider?', 'tfuse'),
                            'id' => 'sliders_posts_number',
                            'value' => 6,
                            'type' => 'text'
                        )
                    )
                )
            )
        )
    )
);
$options['extra_options'] = array();
?>