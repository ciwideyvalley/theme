<?php
if (!function_exists('tfuse_list_page_options')) :
    function tfuse_list_page_options() {
        $pages = get_pages();
        $result = array();
        $result[0] = 'Select a page';
        foreach ( $pages as $page ) {
            $result[ $page->ID ] = $page->post_title;
        }
        return $result;
    }
endif;


if (!function_exists('tfuse_list_posts')) :
    function tfuse_list_posts() {
        $posts = get_posts(array('post_type' => 'post','posts_per_page' => -1,'orderby' => 'post_date'));
		$result = array();
        foreach ( $posts as $post ) {
            $result[$post->ID] = get_the_title($post->ID);
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_rooms_types')) :
    function tfuse_rooms_types() {
        $args = array(
            'hide_empty'    => false, 
        ); 
        $terms = get_terms('types', $args); 
        $result = array();
        $result[0] = 'Select type';
                
        if(!empty($terms))
            foreach ( $terms as $term ) {
                $result[$term->term_id] = $term->name;
            }
        return $result;
    }
endif;

if (!function_exists('tfuse_list_rooms')) :
    function tfuse_list_rooms() {
        $posts = get_posts(array('post_type' => 'room','posts_per_page' => -1,'orderby' => 'post_date'));
		$result = array();
        foreach ( $posts as $post ) {
            $result[$post->ID] = get_the_title($post->ID);
        }
        return $result;
    }
endif;

if (!function_exists('tfuse_list_offers')) :
    function tfuse_list_offers() {
        $args = array(
            'hide_empty'    => false, 
        ); 
        $terms = get_terms('offers', $args); 
        $result = array();
        $result[0] = 'Select Category';
                
        if(!empty($terms))
            foreach ( $terms as $term ) {
                $result[$term->term_id] = $term->name;
            }
        return $result;
    }
endif;