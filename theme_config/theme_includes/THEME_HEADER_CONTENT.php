<?php

if ( ! function_exists( 'tfuse_header_content' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override tfuse_slider_type() in a child theme, add your own tfuse_slider_type to your child theme's
 * functions.php file.
 */

    function tfuse_header_content($location = false)
    { 
        global $TFUSE, $post,$is_tf_blog_page,$header_map;
        $posts = $header_element = $slider  = $header_map = null;
        
        $types = $TFUSE->request->isset_GET('types') ? $TFUSE->request->GET('types') : '';
       
        
        if (!$location) return;
        switch ($location)
        { 
            case 'header' :
                if(is_front_page())
                {
                    if(!empty($post))$ID = $post->ID;  else $ID = '';
					
                    $page_id = tfuse_options('home_page');
                    $header_element = tfuse_options('header_element');
                    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
                    {   $header_element = tfuse_page_options('header_element','',$page_id);
                        if($page_id != 0 && tfuse_page_options('header_element','',$page_id)=='slider')
                            $slider = tfuse_page_options('select_slider','',$page_id);
                    }
                    else{
                        if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_slider');
                    }
                    
                }
                elseif($is_tf_blog_page)
                { 
                    $ID = $post->ID;
                    $header_element = tfuse_options('header_element_blog');
                    if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_slider_blog');
                }
                elseif ( is_singular() )
                {  
                    $ID = $post->ID;
                    $header_element = tfuse_page_options('header_element');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_page_options('select_slider');
                    elseif ( 'map' == $header_element )
                        $header_map['map'] = tfuse_page_options('page_map');

                }
                elseif ( is_category() )
                { 
                    $ID = get_query_var('cat');
                    $header_element = tfuse_options('header_element', null, $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider', null, $ID);
                    elseif ( 'map' == $header_element )
                        $header_map['map'] = tfuse_options('page_map', null, $ID);
                }
                elseif(is_search())
                {
                    if(!empty($post))$ID = $post->ID;  else $ID = '';
					
                    $header_element = tfuse_options('header_element_search');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_search');
                    
                }
                elseif ( is_tax() && $types != 'all_rooms')
                { 
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $ID = $term->term_id;
                    $header_element = tfuse_options('header_element', null, $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider', null, $ID);
                    elseif ( 'map' == $header_element )
                        $header_map['map'] = tfuse_options('page_map', null, $ID);
                } 
                elseif(is_404())
                {
                    if(!empty($post))$ID = $post->ID;  else $ID = '';
					
                    $header_element = tfuse_options('header_element_404');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_404');
                    
                }
                
            break;
            case 'bottom' :
                if(is_front_page())
                {
                    if(!empty($post))$ID = $post->ID;  else $ID = '';
					
                    $page_id = tfuse_options('home_page');
                    $header_element = tfuse_options('header_bottom');
                    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
                    {   $header_element = tfuse_page_options('header_bottom','',$page_id);
                        if($page_id != 0 && tfuse_page_options('header_bottom','',$page_id)=='slider')
                            $slider = tfuse_page_options('select_slider_bottom','',$page_id);
                    }
                    else{
                        if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_slider_bottom');
                    }
                    
                }
                elseif($is_tf_blog_page)
                { 
                    $ID = $post->ID;
                    $header_element = tfuse_options('header_bottom_blog');
                    if ( 'slider' == $header_element )
                            $slider = tfuse_options('select_slider_bottom_blog');
                }
                elseif ( is_singular() )
                {  
                    $ID = $post->ID;
                    $header_element = tfuse_page_options('header_bottom');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_page_options('select_slider_bottom');

                }
                elseif ( is_category() )
                { 
                    $ID = get_query_var('cat');
                    $header_element = tfuse_options('header_bottom', null, $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_bottom', null, $ID);
                }
                elseif(is_search())
                {
                    if(!empty($post))$ID = $post->ID;  else $ID = '';
					
                    $header_element = tfuse_options('header_bottom_search');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_bottom_search');
                }
                elseif ( is_tax() && $types != 'all_rooms')
                { 
                    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                    $ID = $term->term_id;
                    $header_element = tfuse_options('header_bottom', null, $ID);
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_bottom', null, $ID);
                } 
                elseif(is_404())
                {
                    if(!empty($post))$ID = $post->ID;  else $ID = '';
					
                    $header_element = tfuse_options('header_bottom_404');
                    if ( 'slider' == $header_element )
                        $slider = tfuse_options('select_slider_bottom_404');
                }
            break;
        }  
        if ( $header_element == 'map' )
        { 
            get_template_part( 'header', 'map' );
            return;
        }
        elseif ( !$slider )
            return;

        $slider = $TFUSE->ext->slider->model->get_slider($slider);

        switch ($slider['type']):
           case 'custom':
                if ( is_array($slider['slides']) ) :
                    $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? true : false;
                    foreach ($slider['slides'] as $k => $slide) : 
                        $image = new TF_GET_IMAGE();
                        if ( $slider['design'] == 'tabs')
                        { 
                            $slider['slides'][$k]['slide_src'] = $image->width(1280)->height(630)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                        }
                        elseif ( $slider['design'] == 'code')
                        { 
                            $slider['slides'][$k]['slide_src'] = $image->width(1920)->height(675)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                        }
                        elseif ( $slider['design'] == 'codecanyonfull')
                        { 
                            $slider['slides'][$k]['slide_src'] = $image->width(1920)->height(675)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                        }
                        else
                        { 
                            @$slider['slides'][$k]['slide_src'] = $image->width(1280)->height(630)->src($slide['slide_src'])->resize($slider_image_resize)->get_src();
                        }
                    endforeach;
                endif;

                break;
            case 'posts':
                $slides_posts = array();
                
                    $args = array( 'post__in' => explode(',',$slider['general']['posts_select']) );
                    $slides_posts = explode(',',$slider['general']['posts_select']);
               
                foreach($slides_posts as $slide_posts):
                    $posts[] = get_post($slide_posts);
                endforeach; 
                $posts = array_reverse($posts);
                $args = apply_filters('tfuse_slider_posts_args', $args, $slider);
                $args = apply_filters('tfuse_slider_posts_args_'.$ID, $args, $slider);
                break;
            case 'categories':
                    $args = 'cat='.$slider['general']['categories_select'].
                    '&posts_per_page='.$slider['general']['sliders_posts_number'];
                    $args = apply_filters('tfuse_slider_categories_args', $args, $slider);
                    $args = apply_filters('tfuse_slider_categories_args_'.$ID, $args, $slider);
                    $slides_posts = explode(',',$slider['general']['categories_select']);
                        $args = array(
                                'posts_per_page' => $slider['general']['sliders_posts_number'],
                                'relation' => 'AND',
                                'tax_query' => array(
                                        array(
                                                'taxonomy' => 'category',
                                                'field' => 'id',
                                                'terms' => $slides_posts
                                        )
                                )
                        );
                        $query = new WP_Query($args);
                        $posts  = $query->get_posts();
                break;

        endswitch;

        if ( is_array($posts) ) :
            $slider['slides'] = tfuse_get_slides_from_posts($posts,$slider);
        endif;

        if ( !is_array($slider['slides']) ) return;

        include_once(locate_template( '/theme_config/extensions/slider/designs/'.$slider['design'].'/template.php' ));
    }

endif;
add_action('tfuse_header_content', 'tfuse_get_header_content');

if ( ! function_exists( 'tfuse_get_slides_from_posts' ) ):
/**
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override tfuse_slider_type() in a child theme, add your own tfuse_slider_type to your child theme's
 * functions.php file.
 */
    function tfuse_get_slides_from_posts( $posts=array(), $slider = array() )
    {
        global $post;

        $slides = array(); $numb = $month = $day = '';
        $slider_image_resize = ( isset($slider['general']['slider_image_resize']) && $slider['general']['slider_image_resize'] == 'true' ) ? $slider['general']['slider_image_resize'] : false;
        $k = 0; 
        foreach ($posts as $k => $post) : $k++;
            setup_postdata( $post );
        if(!empty($slider['general']['sliders_posts_number'])) {$numb = $slider['general']['sliders_posts_number']; $numb += 1;}
        if($numb == $k) break;
        $tfuse_image = $image = null;
        
        $image = new TF_GET_IMAGE();
                
                $title = get_the_title();
                if (mb_strlen($title, 'UTF-8') > 20)  $title = substr($title, 0 ,30);
                $slides[$k]['slide_title'] = $title;
                $slides[$k]['slide_src'] = $tfuse_image;
                $slides[$k]['slide_url'] = get_permalink();
            
        endforeach;
		wp_reset_postdata();
        return $slides;
    }
endif;
