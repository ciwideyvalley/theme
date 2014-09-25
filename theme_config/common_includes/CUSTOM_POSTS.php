<?php
/**
 * Create custom posts types
 *
 * @since  ParadiseCove 1.0
 */

if ( !function_exists('tfuse_create_custom_post_types') ) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_create_custom_post_types()
    {
		//Reservation_form
		        $labels = array(
                        'name' => __('Reservation', 'tfuse'),
                        'singular_name' => __('Reservation', 'tfuse'),
                        'add_new' => __('Add New', 'tfuse'),
                        'add_new_item' => __('Add New Reservation', 'tfuse'),
                        'edit_item' => __('Edit Reservation info', 'tfuse'),
                        'new_item' => __('New Reservation', 'tfuse'),
                        'all_items' => __('All Reservations', 'tfuse'),
                        'view_item' => __('View Reservation info', 'tfuse'),
                        'parent_item_colon' => ''
                );
                $reservationform_rewrite=apply_filters('tfuse_reservationform_rewrite','reservationform_list');
                $res_args = array(
                                'labels' => $labels,
                                'public' => true,
                                'publicly_queryable' => false,
                                'show_ui' => false,
                                'query_var' => true,
                                'exclude_from_search'=>true,
                                //'menu_icon' => get_template_directory_uri() . '/images/icons/doctors.png',
                                'has_archive' => true,
                                'rewrite' => array('slug'=> $reservationform_rewrite),
                                'menu_position' => 6,
                                'supports' => array(null)
                        );
               register_taxonomy('reservations', array('reservations'), array(
                            'hierarchical' => true,
                            'labels' => array(
                                'name' => __('Reservation Forms', 'tfuse'),
                                'singular_name' => __('Reservation Form', 'tfuse'),
                                'add_new_item' => __('Add New Reservation Form', 'tfuse'),
                            ),
                            'show_ui' => false,
                            'query_var' => true,
                            'rewrite' => array('slug' => $reservationform_rewrite)
                        ));
                        register_post_type( 'reservations' , $res_args );
        
        // Faq
        $labels = array(
                'name' => __('Offers', 'tfuse'),
                'singular_name' => __('Offer', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Offer', 'tfuse'),
                'edit_item' => __('Edit Offer info', 'tfuse'),
                'new_item' => __('New Offer', 'tfuse'),
                'all_items' => __('All Offers', 'tfuse'),
                'view_item' => __('View Offer info', 'tfuse'),
                'search_items' => __('Search Offer', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $offerlist_rewrite = apply_filters('tfuse_offerlist_rewrite','all-offer-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $offerlist_rewrite),
                'menu_position' => 5,
                'supports' => array('title','editor','excerpt','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category','tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $offerlist_taxonomy_rewrite = apply_filters('tfuse_offerlist_taxonomy_rewrite','offer-list');
        register_taxonomy('offers', array('offer'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $offerlist_taxonomy_rewrite)
        ));
       

        register_post_type( 'offer' , $args );              
                        
        // Portfolio
        $labels = array(
                'name' => __('Amenities', 'tfuse'),
                'singular_name' => __('Amenity', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New', 'tfuse'),
                'edit_item' => __('Edit Amenity info', 'tfuse'),
                'new_item' => __('New Amenity', 'tfuse'),
                'all_items' => __('All Amenities', 'tfuse'),
                'view_item' => __('View Amenity info', 'tfuse'),
                'search_items' => __('Search Amenity', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $amenitylist_rewrite = apply_filters('tfuse_amenitylist_rewrite','all-amenity-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $amenitylist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','excerpt','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $amenitylist_taxonomy_rewrite = apply_filters('tfuse_amenitylist_taxonomy_rewrite','amenity-list');
        register_taxonomy('amenities', array('amenity'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $amenitylist_taxonomy_rewrite)
        ));
            

        register_post_type( 'amenity' , $args );
        
       // room
        $labels = array(
                'name' => __('Room Types', 'tfuse'),
                'singular_name' => __('Room Type', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Room Type', 'tfuse'),
                'edit_item' => __('Edit Room Types info', 'tfuse'),
                'new_item' => __('New Room Type', 'tfuse'),
                'all_items' => __('All Room Types', 'tfuse'),
                'view_item' => __('View Room Type info', 'tfuse'),
                'search_items' => __('Search Room Types', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $roomlist_rewrite = apply_filters('tfuse_roomlist_rewrite','all-room-list');
        $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'has_archive' => true,
                'rewrite' => array('slug'=> $roomlist_rewrite,'feeds'=>true),
                'menu_position' => 5,
                'supports' => array('title','editor','comments')
        );

        // Add new taxonomy, make it hierarchical (like categories)
        $labels = array(
            'name' => __('Categories', 'tfuse'),
            'singular_name' => __('Category', 'tfuse'),
            'search_items' => __('Search Categories','tfuse'),
            'all_items' => __('All Categories','tfuse'),
            'parent_item' => __('Parent Category','tfuse'),
            'parent_item_colon' => __('Parent Category:','tfuse'),
            'edit_item' => __('Edit Category','tfuse'),
            'update_item' => __('Update Category','tfuse'),
            'add_new_item' => __('Add New Category','tfuse'),
            'new_item_name' => __('New Category Name','tfuse')
        );

        $roomlist_taxonomy_rewrite = apply_filters('tfuse_roomlist_taxonomy_rewrite','room-list');
        register_taxonomy('rooms', array('room'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $roomlist_taxonomy_rewrite)
        ));
        
        $labels = array(
            'name' => __('Tags','tfuse' ),
            'singular_name' => __('Tag', 'tfuse'),
            'search_items' => __('Search Tags','tfuse'),
            'popular_items' => __( 'Popular Tags','tfuse' ),
            'all_items' => __('All Tags','tfuse'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Tag','tfuse'),
            'update_item' => __('Update Tag','tfuse'),
            'add_new_item' => __('Add New Tag','tfuse'),
            'new_item_name' => __('New Tag Name','tfuse'),
            'separate_items_with_commas' => __( 'Separate tags with commas','tfuse' ),
            'add_or_remove_items' => __( 'Add or remove tags','tfuse' ),
            'choose_from_most_used' => __( 'Choose from the most used tags','tfuse' ),
        );
		
            $reviewlist_taxonomy_tags_rewrite = apply_filters('tfuse_reviewlist_taxonomy_tags_rewrite','tag-list'); 
		
            register_taxonomy('tags', 'room', array(
                'hierarchical' => false,
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array('slug' => $reviewlist_taxonomy_tags_rewrite)
            ));    
        
        $labels = array(
            'name' => __('Types', 'tfuse'),
            'singular_name' => __('Type', 'tfuse'),
            'search_items' => __('Search Types','tfuse'),
            'all_items' => __('All Types','tfuse'),
            'parent_item' => __('Parent Type','tfuse'),
            'parent_item_colon' => __('Parent Type:','tfuse'),
            'edit_item' => __('Edit Type','tfuse'),
            'update_item' => __('Update Type','tfuse'),
            'add_new_item' => __('Add New Type','tfuse'),
            'new_item_name' => __('New Type Name','tfuse')
        );
        
        $typeslist_taxonomy_rewrite = apply_filters('tfuse_typeslist_taxonomy_rewrite','types-list');
        register_taxonomy('types', array('room'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array('slug' => $typeslist_taxonomy_rewrite)
        ));
            

        register_post_type( 'room' , $args );
        
        // TESTIMONIALS
        $labels = array(
                'name' => __('Testimonials', 'tfuse'),
                'singular_name' => __('Testimonial', 'tfuse'),
                'add_new' => __('Add New', 'tfuse'),
                'add_new_item' => __('Add New Testimonial', 'tfuse'),
                'edit_item' => __('Edit Testimonial', 'tfuse'),
                'new_item' => __('New Testimonial', 'tfuse'),
                'all_items' => __('All Testimonials', 'tfuse'),
                'view_item' => __('View Testimonial', 'tfuse'),
                'search_items' => __('Search Testimonials', 'tfuse'),
                'not_found' =>  __('Nothing found', 'tfuse'),
                'not_found_in_trash' => __('Nothing found in Trash', 'tfuse'),
                'parent_item_colon' => ''
        );

        $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'query_var' => true,
                //'menu_icon' => get_template_directory_uri() . '/images/icons/testimonials.png',
                'rewrite' => true,
                'menu_position' => 5,
                'supports' => array('title','editor')
        ); 

        register_post_type( 'testimonials' , $args );

    }
    tfuse_create_custom_post_types();

endif;

add_action('category_add_form', 'taxonomy_redirect_note');
add_action('specialties_add_form', 'taxonomy_redirect_note');
function taxonomy_redirect_note($taxonomy){
    echo '<p><strong>Note:</strong> More options are available after you add the '.$taxonomy.'. <br />
        Click on the Edit button under the '.$taxonomy.' name.</p>';
}
