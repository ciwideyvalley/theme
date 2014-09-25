<?php
/**
 * Initializing deafault sidebars
 *
 * @since  ParadiseCove 1.0
 */
function sidebar_attachment ($post_types){
    unset($post_types['attachment']);
    return $post_types;
}
add_filter('tfuse_sidebar_posts', 'sidebar_attachment');

function sidebar_offers ($taxonomies){
    unset($taxonomies['offers']);
    return $taxonomies;
}
add_filter('tfuse_sidebar_taxonomies', 'sidebar_offers');

function sidebar_amenities ($taxonomies){
    unset($taxonomies['amenities']);
    return $taxonomies;
}
add_filter('tfuse_sidebar_taxonomies', 'sidebar_amenities');

function sidebar_types ($taxonomies){
    unset($taxonomies['types']);
    return $taxonomies;
}
add_filter('tfuse_sidebar_taxonomies', 'sidebar_types');

function sidebar_rooms ($taxonomies){
    unset($taxonomies['rooms']);
    return $taxonomies;
}
add_filter('tfuse_sidebar_taxonomies', 'sidebar_rooms');

function tf_sidebar_cfg() {
    static $sidebar_cfg = array();
    #Sidebar options
    $beforeWidget = '<div id="%1$s" class="box %2$s">';
    $afterWidget = '</div>';
    $beforeTitle = '<h3>';
    $afterTitle = '</h3>';
    #End sidebar options
    if (count($sidebar_cfg) == 0) {
        #Sidebar filters
        $beforeWidget = apply_filters('tfuse_filter_before_widget', $beforeWidget);
        $afterWidget = apply_filters('tfuse_filter_after_widget', $afterWidget);
        $beforeTitle = apply_filters('tfuse_filter_before_title', $beforeTitle);
        $afterTitle = apply_filters('tfuse_filter_after_title', $afterTitle);
        #End sidebar filters
        $sidebar_cfg = compact('beforeWidget', 'afterWidget', 'beforeTitle', 'afterTitle');
    }
    return $sidebar_cfg;
}

function tf_sidebars_init() {
    extract(tf_sidebar_cfg());
    register_sidebar(array('name' => __('General Sidebar', 'tfuse'), 'id' => 'sidebar-1', 'before_widget' => $beforeWidget, 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle, 'description' => ''));

    register_sidebar(array('name' => __('Footer 1', 'tfuse'), 'id' => 'footer-1', 'before_widget' => $beforeWidget, 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle));
    register_sidebar(array('name' => __('Footer 2', 'tfuse'), 'id' => 'footer-2', 'before_widget' => $beforeWidget, 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle));
    register_sidebar(array('name' => __('Footer 3', 'tfuse'), 'id' => 'footer-3', 'before_widget' => $beforeWidget, 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle));

}

tf_sidebars_init();
