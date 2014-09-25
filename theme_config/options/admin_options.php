<?php

/* ----------------------------------------------------------------------------------- */
/* Initializes all the theme settings option fields for admin area. */
/* ----------------------------------------------------------------------------------- */

$options = array(
    'tabs' => array(
        array(
            'name' => __('General','tfuse'),
            'type' => 'tab',
            'id' => TF_THEME_PREFIX . '_general',
            'headings' => array(
                
                array(
                    'name' => __('General Settings','tfuse'),
                    'options' => array(/* 1 */
                        
                        // Custom Logo Option
                        array(
                            'name' => __('Custom Logo','tfuse'),
                            'desc' => __('Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_logo',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                        // Custom Favicon Option
                        array(
                            'name' => __('Custom Favicon','tfuse').' <br /> (16px x 16px)',
                            'desc' =>  __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_favicon',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                        array(
                            'name' => __('Content Color','tfuse'),
                            'desc' => __('Change content color' ,'tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_color',
                            'value' => '#fff',
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        array(
                            'name' => __('Your Location','tfuse'),
                            'desc' => __('Choose your location' ,'tfuse'),
                            'id' => TF_THEME_PREFIX . '_your_location',
                            'value' => '',
                            'type' => 'maps',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User for Local Date','tfuse'),
                            'desc' => __('Create user on ' ,'tfuse') . '<a href="http://www.geonames.org/" target="_blank">'.__('http://www.geonames.org/','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_local_date_user',
                            'value' => 'themefuse',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('Currency','tfuse'),
                            'desc' => __('Type your default Currency' ,'tfuse'),
                            'id' => TF_THEME_PREFIX . '_default_currency',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true
                        ),
                      
                         // Change default avatar
                        array(
                            'name' => __('Default Avatar','tfuse'),
                            'desc' => __('For users without a custom avatar of their own, you can either display a generic logo or a generated one based on their e-mail address.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_default_avatar',
                            'value' => '',
                            'type' => 'upload',
                            'divider' => true
                        ),
                        // Tracking Code Option
                        array(
                            'name' => __('Tracking Code','tfuse'),
                            'desc' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_google_analytics',
                            'value' => '',
                            'type' => 'textarea',
                            'divider' => true
                        ),
                        // Custom CSS Option
                        array(
                            'name' => __('Custom CSS','tfuse'),
                            'desc' => __('Quickly add some CSS to your theme by adding it to this block.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_custom_css',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    ) /* E1 */
                ),
                array(
                    'name' => __('Search Page','tfuse'),
                    'options' => array(
                        // Element of Hedear
                        array('name' => __('Element of Hedear','tfuse'),
                            'desc' => __('Select type of element on the header.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_element_search',
                            'value' => 'without',
                            'options' => array('without' => __('Without Header Element','tfuse'),'slider' => __('Slider on Header','tfuse'),'map' => __('Map on Header','tfuse')),
                            'type' => 'select'
                        ),
                        // Select Header Slider
                        $this->ext->slider->model->has_sliders() ?
                                array(
                            'name' => __('Slider','tfuse'),
                            'desc' => __('Select a slider for your post. The sliders are created on the','tfuse').' <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">'.__('Sliders page','tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_select_slider_search',
                            'value' => '',
                            'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('code','codecanyonfull','tabs')),
                            'type' => 'select'
                                ) :
                                array(
                            'name' => __('Slider','tfuse'),
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_select_slider_search',
                            'value' => '',
                            'html' => __('No sliders created yet. You can start creating one ','tfuse').'<a href="' . admin_url('admin.php?page=tf_slider_list') . '">'.__('here','tfuse').'</a>.',
                            'type' => 'raw'
                                ) ,
                        array(
                            'name' => __('Map position','tfuse'),
                             'desc'=>__('Choose location','tfuse'),
                            'id' => TF_THEME_PREFIX . '_page_map_search',
                            'value' => '',
                            'type' => 'maps',
                            'divider' => true
                        ),

                         array('name' => __('Select Header Bottom','tfuse'),
                                'desc' => __('Select your preferred  header bottom option.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_header_bottom_search',
                                'value' => '',
                                'options' => array('without' => __('Without Header Bottom Element','tfuse'),'slider' => __('Slider','tfuse')),
                                'type' => 'select',
                            ),
                        // Select Header Slider
                        $this->ext->slider->model->has_sliders() ?
                                array(
                            'name' => __('Slider','tfuse'),
                            'desc' => __('Select a slider for your post. The sliders are created on the','tfuse').' <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">'.__('Sliders page','tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_select_slider_bottom_search',
                            'value' => '',
                            'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('info')),
                            'type' => 'select',
                                    'divider'=>true
                                ) :
                                array(
                            'name' => __('Slider','tfuse'),
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_select_slider_bottom_search',
                            'value' => '',
                            'html' => __('No sliders created yet. You can start creating one ','tfuse').'<a href="' . admin_url('admin.php?page=tf_slider_list') . '">'.__('here','tfuse').'</a>.',
                            'type' => 'raw'
                                ) ,
                        array(
                            'name' => __('Content Color','tfuse'),
                            'desc' => __('Change content color' ,'tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_color_search',
                            'value' => tfuse_options('content_color'),
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_search_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes after Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_search_content_bot',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        array('name' => __('Shortcodes after Content 2','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_search_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                ),
                array(
                    'name' => __('404 Page','tfuse'),
                    'options' => array(
                        // Element of Hedear
                        array('name' => __('Element of Hedear','tfuse'),
                            'desc' => __('Select type of element on the header.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_element_404',
                            'value' => 'without',
                            'options' => array('without' => __('Without Header Element','tfuse'),'slider' => __('Slider on Header','tfuse'),'map' => __('Map on Header','tfuse')),
                            'type' => 'select'
                        ),
                        // Select Header Slider
                        $this->ext->slider->model->has_sliders() ?
                                array(
                            'name' => __('Slider','tfuse'),
                            'desc' => __('Select a slider for your post. The sliders are created on the','tfuse').' <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">'.__('Sliders page','tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_select_slider_404',
                            'value' => '',
                            'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('code','codecanyonfull','tabs')),
                            'type' => 'select'
                                ) :
                                array(
                            'name' => __('Slider','tfuse'),
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_select_slider_404',
                            'value' => '',
                            'html' => __('No sliders created yet. You can start creating one ','tfuse').'<a href="' . admin_url('admin.php?page=tf_slider_list') . '">'.__('here','tfuse').'</a>.',
                            'type' => 'raw'
                                ) ,
                        array(
                            'name' => __('Map position','tfuse'),
                             'desc'=>__('Choose location','tfuse'),
                            'id' => TF_THEME_PREFIX . '_page_map_404',
                            'value' => '',
                            'type' => 'maps',
                            'divider' => true
                        ),

                         array('name' => __('Select Header Bottom','tfuse'),
                                'desc' => __('Select your preferred  header bottom option.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_header_bottom_404',
                                'value' => '',
                                'options' => array('without' => __('Without Header Bottom Element','tfuse'),'slider' => __('Slider','tfuse')),
                                'type' => 'select',
                            ),
                        // Select Header Slider
                        $this->ext->slider->model->has_sliders() ?
                                array(
                            'name' => __('Slider','tfuse'),
                            'desc' => __('Select a slider for your post. The sliders are created on the','tfuse').' <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">'.__('Sliders page','tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_select_slider_bottom_404',
                            'value' => '',
                            'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('info')),
                            'type' => 'select',
                                    'divider'=>true
                                ) :
                                array(
                            'name' => __('Slider','tfuse'),
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_select_slider_bottom_404',
                            'value' => '',
                            'html' => __('No sliders created yet. You can start creating one ','tfuse').'<a href="' . admin_url('admin.php?page=tf_slider_list') . '">'.__('here','tfuse').'</a>.',
                            'type' => 'raw'
                                ) ,
                        array(
                            'name' => __('Content Color','tfuse'),
                            'desc' => __('Change content color' ,'tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_color_404',
                            'value' => tfuse_options('content_color'),
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_404_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes after Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_404_content_bot',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        array('name' => __('Shortcodes after Content 2','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_404_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                ),
                	array(
                    'name' => __('Twitter','tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Consumer Key','tfuse'),
                            'desc' => __('Set your' ,'tfuse').'<a href="http://screencast.com/t/zHu17C7nXy1">'.__('twitter' ,'tfuse').'</a> '.__('application' ,'tfuse').' <a href="http://screencast.com/t/yb44HiF2NZ">'.__('consumer key' ,'tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_key',
                            'value' => 'XW7t8bECoR6ogYtUDNdjiQ',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('Consumer Secret','tfuse'),
                            'desc' => __('Set your ','tfuse').'<a href="http://screencast.com/t/zHu17C7nXy1">'.__('twitter','tfuse').'</a> '.__('application','tfuse').' <a href="http://screencast.com/t/eaKJHG1omN">'.__('consumer secret key' ,'tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_consumer_secret',
                            'value' => 'Z7UzuWU8a4obyOOlIguuI4a5JV4ryTIPKZ3POIAcJ9M',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User Token','tfuse'),
                            'desc' => __('Set your ','tfuse').'<a href="http://screencast.com/t/zHu17C7nXy1">'.__('twitter','tfuse').'</a> '.__('application','tfuse').' <a href="http://screencast.com/t/QEEG2O4H">'.__('access token key' ,'tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_user_token',
                            'value' => '1510587853-ugw6uUuNdNMdGGDn7DR4ZY4IcarhstIbq8wdDud',
                            'type' => 'text',
                            'divider' => true
                        ),
                        array(
                            'name' => __('User Secret','tfuse'),
                            'desc' => __('Set your ','tfuse').'<a href="http://screencast.com/t/zHu17C7nXy1">'.__('twitter','tfuse').'</a>  '.__('application','tfuse').' <a href="http://screencast.com/t/Yv7nwRGsz">'.__('access token secret key' ,'tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_twitter_user_secret',
                            'value' => '7aNcpOUGtdKKeT1L72i3tfdHJWeKsBVODv26l9C0Cc',
                            'type' => 'text'
                        )
                    )
                ),
                array(
                    'name' => __('RSS','tfuse'),
                    'options' => array(
                        // RSS URL Option
                        array('name' => __('RSS URL','tfuse'),
                            'desc' => __('Enter your preferred RSS URL. (Feedburner or other)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_feedburner_url',
                            'value' => '',
                            'type' => 'text',
                            'divider' => true
                        ),
                        // E-Mail URL Option
                        array('name' => __('E-Mail URL','tfuse'),
                            'desc' => __('Enter your preferred E-mail subscription URL. (Feedburner or other)','tfuse'),
                            'id' => TF_THEME_PREFIX . '_feedburner_id',
                            'value' => '',
                            'type' => 'text','divider'=>true
                        ),
                    )
                ),
                array(
                    'name' => __('Enable Theme settings','tfuse'),
                    'options' => array(
                        // Disable Image for All Single Posts
                        array('name' => __('Image on Single Post','tfuse'),
                            'desc' => __('Enable Image on All Single Posts? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_image',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Video for All Single Posts
                        array('name' => __('Video on Single Post','tfuse'),
                            'desc' => __('Enable Video on All Single Posts? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_video',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable Comments for All Posts
                        array('name' => __('Post Comments','tfuse'),
                            'desc' => __('Enable Comments for All Posts? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_posts_comments',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        
                        // Disable Author Info
                        array('name' => __('Author Info','tfuse'),
                            'desc' => __('Enable Author Info? These settings may be overridden for individual articles.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_author_info',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable posts lightbox (prettyPhoto) Option
                        array('name' => __('prettyPhoto on Categories','tfuse'),
                            'desc' => __('Enable opening image and attachemnts in prettyPhoto on Categories listings? If YES, image link go to post.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_listing_lightbox',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable posts lightbox (prettyPhoto) Option
                        array('name' => __('prettyPhoto on Single Post','tfuse'),
                            'desc' => __('Enable opening image and attachemnts in prettyPhoto on Single Post?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_single_lightbox',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Disable preloadCssImages plugin
                        array('name' => __('preloadCssImages','tfuse'),
                            'desc' => __('Enable jQuery-Plugin "preloadCssImages"? This plugin loads automatic all images from css.If you prefer performance(less requests) deactivate this plugin.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_preload_css',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'on_update' => 'reload_page',
                            'divider' => true
                        ),
                        // Disable SEO
                        array('name' => __('SEO Tab','tfuse'),
                            'desc' => __('Enable SEO option?','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_tfuse_seo_tab',
                            'value' => true,
                            'type' => 'checkbox',
                            'on_update' => 'reload_page',
                            'divider' => true
                        ),
                        // Enable Dynamic Image Resizer Option
                        array('name' => __('Dynamic Image Resizer','tfuse'),
                            'desc' => __('This will Enable the thumb.php script that dynamicaly resizes images on your site. We recommend you keep this enabled, however note that for this to work you need to have "GD Library" installed on your server. This should be done by your hosting server administrator.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_disable_resize',
                            'value' => 'true',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        array('name' => __('Image from content','tfuse'),
                            'desc' => __('If no thumbnail is specified then the first uploaded image in the post is used.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_content_img',
                            'value' => 'false',
                            'type' => 'checkbox',
                            'divider' => true
                        ),
                        // Remove wordpress versions for security reasons
                        array(
                            'name' => __('Remove Wordpress Versions','tfuse'),
                            'desc' => __('Remove Wordpress versions from the source code, for security reasons.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_remove_wp_versions',
                            'value' => TRUE,
                            'type' => 'checkbox'
                        )
                    )
                ),
                array(
                    'name' => __('WordPress Admin Style','tfuse'),
                    'options' => array(
                        // Disable Themefuse Style
                        array('name' => __('ThemeFuse Style','tfuse'),
                            'desc' => __('Enable Themefuse Style','tfuse'),
                            'id' => TF_THEME_PREFIX . '_activate_tfuse_style',
                            'value' => true,
                            'type' => 'checkbox',
                            'on_update' => 'reload_page'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Homepage','tfuse'),
            'id' => TF_THEME_PREFIX . '_homepage',
            'headings' => array(
                array(
                    'name' => __('Homepage Population','tfuse'),
                    'options' => array(
                        array('name' => __('Homepage Population','tfuse'),
                            'desc' => __(' Select which categories to display on homepage. More over you can choose to load a specific page or change the number of posts on the homepage from ','tfuse').'<a target="_blank" href="' . network_admin_url('options-reading.php') . '">'.__('here','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_homepage_category',
                            'value' => '',
                            'options' => array('all' => __('From All Categories','tfuse'), 'specific' => __('From Specific Categories','tfuse'),'page' =>__('From Specific Page','tfuse')),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => __('Select specific categories to display on homepage','tfuse'),
                            'desc' => __('Pick one or more 
                            categories by starting to type the category name.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_categ',
                            'type' => 'multi',
                            'subtype' => 'category',
                        ),
                        // page on homepage
                        array('name' => __('Select Page','tfuse'),
                            'desc' => __('Select the page','tfuse'),
                            'id' => TF_THEME_PREFIX . '_home_page',
                            'value' => 'image',
                            'options' =>tfuse_list_page_options(),
                            'type' => 'select',
                        ),
                        array('name' => __('Use page options','tfuse'),
                            'desc' => __('Use page options','tfuse'),
                            'id' => TF_THEME_PREFIX . '_use_page_options',
                            'value' => 'false',
                            'type' => 'checkbox'
                        )
                    )
                ),
                array(
                    'name' => __('Homepage Header','tfuse'),
                    'options' => array(
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
    
                    )
                ),
                array(
                    'name' => __('Homepage Shortcodes','tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Content Color','tfuse'),
                            'desc' => __('Change content color' ,'tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_color_home',
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
                    )
                )
            )
        ),
        array(
            'name' => __('Blog','tfuse'),
            'id' => TF_THEME_PREFIX . '_blogpage',
            'headings' => array(
                array(
                    'name' => __('Blog Page Population','tfuse'),
                    'options' => array(
                        // Select the Blog Page
                        array('name' => __('Select Blog Page','tfuse'),
                            'desc' => __('Select the blog page','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_page',
                            'value' => 'image',
                            'options' => tfuse_list_page_options(),
                            'type' => 'select',
                            'divider' => true
                        ),
                        array('name' => __('Blog Page Population','tfuse'),
                            'desc' => __(' Select which categories to display on blogpage. More over you can choose to load a specific page or change the number of posts on the blogpage from ','tfuse').'<a target="_blank" href="' . network_admin_url('options-reading.php') . '">'.__('here','tfuse').'</a>',
                            'id' => TF_THEME_PREFIX . '_blogpage_category',
                            'value' => '',
                            'options' => array('all' => __('From All Categories','tfuse'), 'specific' => __('From Specific Categories','tfuse')),
                            'type' => 'select',
                            'install' => 'cat'
                        ),
                        array(
                            'name' => __('Select specific categories to display on blogpage','tfuse'),
                            'desc' => __('Pick one or more
                            categories by starting to type the category name.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_categories_select_categ_blog',
                            'type' => 'multi',
                            'subtype' => 'category',
                        )
                    )
                ),
                array(
                    'name' => __('Blog Page Header','tfuse'),
                    'options' => array(
                         // Element of Hedear
                        array('name' => __('Element of Hedear','tfuse'),
                            'desc' => __('Select type of element on the header.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_header_element_blog',
                            'value' => 'without',
                            'options' => array('without' => __('Without Header Element','tfuse'),'slider' => __('Slider on Header','tfuse'),'map' => __('Map on Header','tfuse')),
                            'type' => 'select'
                        ),
                        // Select Header Slider
                        $this->ext->slider->model->has_sliders() ?
                                array(
                            'name' => __('Slider','tfuse'),
                            'desc' => __('Select a slider for your post. The sliders are created on the','tfuse').' <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">'.__('Sliders page','tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_select_slider_blog',
                            'value' => '',
                            'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('code','codecanyonfull','tabs')),
                            'type' => 'select'
                                ) :
                                array(
                            'name' => __('Slider','tfuse'),
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_select_slider_blog',
                            'value' => '',
                            'html' => __('No sliders created yet. You can start creating one ','tfuse').'<a href="' . admin_url('admin.php?page=tf_slider_list') . '">'.__('here','tfuse').'</a>.',
                            'type' => 'raw'
                                ) ,
                        array(
                            'name' => __('Map position','tfuse'),
                             'desc'=>__('Choose location','tfuse'),
                            'id' => TF_THEME_PREFIX . '_page_map_blog',
                            'value' => '',
                            'type' => 'maps',
                            'divider' => true
                        ),

                         array('name' => __('Select Header Bottom','tfuse'),
                                'desc' => __('Select your preferred  header bottom option.','tfuse'),
                                'id' => TF_THEME_PREFIX . '_header_bottom_blog',
                                'value' => '',
                                'options' => array('without' => __('Without Header Bottom Element','tfuse'),'slider' => __('Slider','tfuse')),
                                'type' => 'select',
                            ),
                        // Select Header Slider
                        $this->ext->slider->model->has_sliders() ?
                                array(
                            'name' => __('Slider','tfuse'),
                            'desc' => __('Select a slider for your post. The sliders are created on the','tfuse').' <a href="' . admin_url( 'admin.php?page=tf_slider_list' ) . '" target="_blank">'.__('Sliders page','tfuse').'</a>.',
                            'id' => TF_THEME_PREFIX . '_select_slider_bottom_blog',
                            'value' => '',
                            'options' => $TFUSE->ext->slider->get_sliders_dropdown(array('info')),
                            'type' => 'select',
                                ) :
                                array(
                            'name' => __('Slider','tfuse'),
                            'desc' => '',
                            'id' => TF_THEME_PREFIX . '_select_slider_bottom_blog',
                            'value' => '',
                            'html' => __('No sliders created yet. You can start creating one ','tfuse').'<a href="' . admin_url('admin.php?page=tf_slider_list') . '">'.__('here','tfuse').'</a>.',
                            'type' => 'raw'
                                ) ,
    
                                        )
                ),
                array(
                    'name' => __('Blog Page Shortcodes','tfuse'),
                    'options' => array(
                        array(
                            'name' => __('Content Color','tfuse'),
                            'desc' => __('Change content color' ,'tfuse'),
                            'id' => TF_THEME_PREFIX . '_content_color_blog',
                            'value' => tfuse_options('content_color'),
                            'type' => 'colorpicker',
                            'divider' => true
                        ),
                        array('name' => __('Shortcodes before Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_content_top',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        // Bottom Shortcodes
                        array('name' => __('Shortcodes after Content','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_content_bot',
                            'value' => '',
                            'type' => 'textarea'
                        ),
                        array('name' => __('Shortcodes after Content 2','tfuse'),
                            'desc' => __('In this textarea you can input your prefered custom shotcodes.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_blog_content_bottom',
                            'value' => '',
                            'type' => 'textarea'
                        )
                    )
                ),
            )
        ),
        array(
            'name' => __('Posts','tfuse'),
            'id' => TF_THEME_PREFIX . '_posts',
            'headings' => array(
                array(
                    'name' => __('Default Post Options','tfuse'),
                    'options' => array(
                        // Post Content
                        array('name' => __('Post Content', 'tfuse'),
                            'desc' => __('Select if you want to show the full content (use <em>more</em> tag) or the excerpt on posts listings (categories).','tfuse'),
                            'id' => TF_THEME_PREFIX . '_post_content',
                            'value' => 'excerpt',
                            'options' => array('excerpt' => __('The Excerpt','tfuse'), 'content' => __('Full Content','tfuse')),
                            'type' => 'select',
                            'divider' => true
                        ),
                        // Single Image Position
                        array('name' => __('Image Position','tfuse'),
                            'desc' => __('Select your preferred image alignment','tfuse'),
                            'id' => TF_THEME_PREFIX . '_single_image_position',
                            'value' => 'alignleft',
                            'type' => 'images',
                            'options' => array('alignleft' => array($url . 'left_off.png', __('Align to the left','tfuse')), 'alignright' => array($url . 'right_off.png', __('Align to the right','tfuse')))
                        ),
                        // Single Image Dimensions
                        array('name' => __('Image Resize (px)','tfuse'),
                            'desc' => __('These are the default width and height values. If you want to resize the image change the values with your own. If you input only one, the image will get resized with constrained proportions based on the one you specified.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_single_image_dimensions',
                            'value' => array(620, 320),
                            'type' => 'textarray',
                            'divider' => true
                        ),
                        // Thumbnail Posts Position
                        array('name' => __('Thumbnail Position','tfuse'),
                            'desc' => __('Select your preferred thumbnail alignment','tfuse'),
                            'id' => TF_THEME_PREFIX . '_thumbnail_position',
                            'value' => 'alignleft',
                            'type' => 'images',
                            'options' => array('alignleft' => array($url . 'left_off.png', __('Align to the left','tfuse')), 'alignright' => array($url . 'right_off.png', __('Align to the right','tfuse')))
                        ),
                        // Posts Thumbnail Dimensions
                        array('name' => __('Thumbnail Resize (px)','tfuse'),
                            'desc' => __('These are the default width and height values. If you want to resize the thumbnail change the values with your own. If you input only one, the thumbnail will get resized with constrained proportions based on the one you specified.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_thumbnail_dimensions',
                            'value' => array(620, 320),
                            'type' => 'textarray',
                            'divider' => true
                        ),
                        // Video Position
                        array('name' => __('Video Position','tfuse'),
                            'desc' => __('Select your preferred video alignment','tfuse'),
                            'id' => TF_THEME_PREFIX . '_video_position',
                            'value' => 'alignright',
                            'type' => 'images',
                            'options' => array('alignleft' => array($url . 'left_off.png', __('Align to the left','tfuse')), 'alignright' => array($url . 'right_off.png', __('Align to the right','tfuse')))
                        ),
                        // Video Dimensions
                        array('name' => __('Video Resize (px)','tfuse'),
                            'desc' => __('These are the default width and height values. If you want to resize the video change the values with your own. If you input only one, the video will get resized with constrained proportions based on the one you specified.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_video_dimensions',
                            'value' => array(620, 320),
                            'type' => 'textarray'
                        )
                    )
                )
            )
        ),
        array(
            'name' => __('Footer','tfuse'),
            'id' => TF_THEME_PREFIX . '_footer',
            'headings' => array(
                
                array(
                    'name' => __('Footer Content','tfuse'),
                    'options' => array(
                        array('name' => __('Enable Newsletter','tfuse'),
                            'desc' => __('This will enable footer newsletter.','tfuse'),
                            'id' => TF_THEME_PREFIX . '_enable_footer_newsletter',
                            'value' => 'true',
                            'type' => 'checkbox'
                        ),
                        array('name' => __('Newsletter Title','tfuse'),
                            'desc' => __('Type newsletter title','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_news_title',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Facebook','tfuse'),
                            'desc' => __('Facebook Link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_newsletter_facebook',
                            'value' => '',
                            'type' => 'text'
                        ),
                        array('name' => __('Google+','tfuse'),
                            'desc' => __('Google+ Link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_newsletter_google',
                            'value' => '',
                            'type' => 'text'
                            ),
                        array('name' => __('Twitter','tfuse'),
                            'desc' => __('Twitter Link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_newsletter_twitter',
                            'value' => '',
                            'type' => 'text'
                            ),
                        array('name' => __('Pinterest','tfuse'),
                            'desc' => __('Pinterest Link','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_newsletter_pinterest',
                            'value' => '',
                            'type' => 'text',
                            'divider' =>true
                            ),
                        array('name' => __('Copyright','tfuse'),
                            'desc' => __('Change  bottom Copyright','tfuse'),
                            'id' => TF_THEME_PREFIX . '_footer_copyright',
                            'value' => '',
                            'type' => 'text'
                        )
                    )
                )
            )
        )
    )
);

?>