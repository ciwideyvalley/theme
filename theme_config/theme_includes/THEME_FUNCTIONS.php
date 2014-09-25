<?php
if ( ! isset( $content_width ) ) $content_width = 900;

if (!function_exists('tfuse_class')) :
/* This Function Add the classes for middle container
 * To override tfuse_class() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/

    function tfuse_class($param, $return = false) {
        $tfuse_class = '';
        $sidebar_position = tfuse_sidebar_position();
        if ($param == 'middle') {
            if (is_page_template('template-contact.php')) {
                if ($sidebar_position == 'left')
                    $tfuse_class = ' class="middle sidebarLeft nobg"';
                elseif ($sidebar_position == 'right')
                    $tfuse_class = ' class="middle sidebarRight nobg"';
                else
                    $tfuse_class = ' class="middle"';
            }
            else {
                if ($sidebar_position == 'left')
                    $tfuse_class = ' class="middle sidebarLeft"';
                elseif ($sidebar_position == 'right')
                    $tfuse_class = ' class="middle sidebarRight"';
                else
                    $tfuse_class = ' class="middle"';
            }
        }
        elseif ($param == 'content') {
            $tfuse_class = ( isset($sidebar_position) && $sidebar_position != 'full' ) ? ' class="grid_8 content"' : ' class="content"';
        }

        if ($return)
            return $tfuse_class;
        else
            echo $tfuse_class;
    }
endif;


if (!function_exists('tfuse_sidebar_position')):
/* This Function Set sidebar position
 * To override tfuse_sidebar_position() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
*/
    function tfuse_sidebar_position() {
        global $TFUSE;

        $sidebar_position = $TFUSE->ext->sidebars->current_position;
        if ( empty($sidebar_position) ) $sidebar_position = 'full';

        return $sidebar_position;
    }

// End function tfuse_sidebar_position()
endif;


if (!function_exists('tfuse_count_post_visits')) :
/**
 * tfuse_count_post_visits.
 * 
 * To override tfuse_count_post_visits() in a child theme, add your own tfuse_count_post_visits() 
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_count_post_visits()
    {
        if ( !is_single() ) return;

        global $post;

        $views = get_post_meta($post->ID, TF_THEME_PREFIX . '_post_viewed', true);
        $views = intval($views);
        tf_update_post_meta( $post->ID, TF_THEME_PREFIX . '_post_viewed', ++$views);
    }
    add_action('wp_head', 'tfuse_count_post_visits');

// End function tfuse_count_post_visits()
endif;


if (!function_exists('tfuse_custom_title')):

    function tfuse_custom_title() {
        global $post;
        $tfuse_title_type = tfuse_page_options('page_title');

        if ($tfuse_title_type == 'hide_title')
            $title = '';
        elseif ($tfuse_title_type == 'custom_title')
            $title = tfuse_page_options('custom_title');
        else
            $title = get_the_title();

        echo ( $title ) ? $title  : '';
    }

endif;


if (!function_exists('tfuse_custom_offers_title')):

    function tfuse_custom_offers_title() {
        $tfuse_title_type = tfuse_page_options('page_title');

        if ($tfuse_title_type == 'hide_title')
            $title = '';
        elseif ($tfuse_title_type == 'custom_title')
            $title = tfuse_page_options('custom_title');
        else
            $title = get_the_title();

        return $title;
    }

endif;

// page custom title
if (!function_exists('tfuse_page_custom_title')):

    function tfuse_page_custom_title() {
        global $post;
        $tfuse_title_type = tfuse_page_options('page_title');

        if ($tfuse_title_type == 'hide_title')
            $title = '';
        elseif ($tfuse_title_type == 'custom_title')
            $title = tfuse_page_options('custom_title');
        else
            $title = get_the_title();

        echo ( $title ) ? '<h1>'.$title.'</h1>'  : '';
    }

endif;

if (!function_exists('tfuse_archive_custom_title')):
/**
 *  Set the name of post archive.
 *
 * To override tfuse_archive_custom_title() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_archive_custom_title()
    {
        $cat_ID = 0;
        if ( is_category() )
        {
            $cat_ID = get_query_var('cat');
            $title = single_term_title( '', false );
        }
        elseif ( is_tax() )
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $cat_ID = $term->term_id;
            $title = single_term_title( $term->name , false );
        }
        elseif ( is_post_type_archive() )
        {
            $title = post_type_archive_title('',false);
        }

        $tfuse_title_type = tfuse_options('page_title',null,$cat_ID);

        if ($tfuse_title_type == 'hide_title')
            $title = '';
        elseif ($tfuse_title_type == 'custom_title')
            $title = tfuse_options('custom_title',null,$cat_ID);

        echo !empty($title) ? '<h1>' . $title . '</h1>' : '';
    }

endif;



if (!function_exists('tfuse_user_profile')) :
/**
 * Retrieve the requested data of the author of the current post.
 *  
 * @param array $fields first_name,last_name,email,url,aim,yim,jabber,facebook,twitter etc.
 * @return null|array The author's spefified fields from the current author's DB object.
 */
    function tfuse_user_profile( $fields = array() )
    {
        $tfuse_meta = null;

        // Get stnadard user contact info
        $standard_meta = array(
            'first_name' => get_the_author_meta('first_name'),
            'last_name' => get_the_author_meta('last_name'),
            'email'     => get_the_author_meta('email'),
            'url'       => get_the_author_meta('url'),
            'aim'       => get_the_author_meta('aim'),
            'yim'       => get_the_author_meta('yim'),
            'jabber'    => get_the_author_meta('jabber')
        );

        // Get extended user info if exists
        $custom_meta = (array) get_the_author_meta('theme_fuse_extends_user_options');

        $_meta = array_merge($standard_meta,$custom_meta);

        foreach ($_meta as $key => $item) {
            if ( !empty($item) && in_array($key, $fields) ) $tfuse_meta[$key] = $item;
        }

        return apply_filters('tfuse_user_profile', $tfuse_meta, $fields);
    }

endif;


if (!function_exists('tfuse_action_comments')) :
/**
 *  This function disable post commetns.
 *
 * To override tfuse_action_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_comments() {
        global $post;
        if (tfuse_page_options('disable_comments'))
            comments_template( '' );
    }

    add_action('tfuse_comments', 'tfuse_action_comments');
endif;


if (!function_exists('tfuse_get_comments')):
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_get_comments() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_get_comments($return = TRUE, $post_ID) {
        $num_comments = get_comments_number($post_ID);

        if (comments_open($post_ID)) {
            if ($num_comments == 0) {
                $comments = __('No Comments','tfuse');
            } elseif ($num_comments > 1) {
                $comments = $num_comments . __(' Comments','tfuse');
            } else {
                $comments = __('1 Comment','tfuse');
            }
            $write_comments = '<a class="link-comments" href="' . get_comments_link() . '">' . $comments . '</a>';
        } else {
            $write_comments = __('Comments are off','tfuse');
        }
        if ($return)
            return $write_comments;
        else
            echo $write_comments;
    }

endif;

if (!function_exists('tfuse_pagination')):
    
function tfuse_pagination( $args = array(), $query = '' ) {
   
    global $wp_rewrite, $wp_query;
        if ( $query ) {

            $wp_query = $query;

        } // End IF Statement
        /* If there's not more than one page, return nothing. */ 
        if ( 1 >= $wp_query->max_num_pages )
            return false;

        /* Get the current page. */
        $current = ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
        
        /* Get the max number of pages. */
        $max_num_pages = intval( $wp_query->max_num_pages );  

        /* Set up some default arguments for the paginate_links() function. */
        $defaults = array(
            'base' => add_query_arg( 'paged', '%#%' ),
            'format' => '',
            'total' => $max_num_pages,
            'current' => $current,
            'prev_next' => false,
            'show_all' => false,
            'end_size' => 2,
            'mid_size' => 1,
            'add_fragment' => '',
            'type' => 'plain',
            'before' => '',
            'after' => '',
            'echo' => true,
        );

        /* Add the $base argument to the array if the user is using permalinks. */
        if( $wp_rewrite->using_permalinks() )
            $defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );

        /* If we're on a search results page, we need to change this up a bit. */
        if ( is_search() ) {
            $search_permastruct = $wp_rewrite->get_search_permastruct();
            if ( !empty( $search_permastruct ) )
                $defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );
        }

        /* Merge the arguments input with the defaults. */
        $args = wp_parse_args( $args, $defaults ); 

        /* Don't allow the user to set this to an array. */
        if ( 'array' == $args['type'] )
            $args['type'] = 'plain';

        /* Get the paginated links. */
        $page_links = paginate_links( $args );

        /* Remove 'page/1' from the entire output since it's not needed. */
        $page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );

        /* Wrap the paginated links with the $before and $after elements. */
        $page_links = $args['before'] . $page_links . $args['after'];

        /* Return the paginated links for use in themes. */
            ?>
            <div class="middle middle_gray">
                <div class="container">
                    <div class="tf_other_pages">
                        <?php 
                            $next = get_next_posts_link('<span class="page_next btn btn-primary btn-lg">'.__('NEWER BLOG POSTS','tfuse').'</span>');
                            $prev = get_previous_posts_link('<span class="page_prev btn btn-default btn-lg">'.__('OLDER BLOG POSTS','tfuse').'</span>');
                            if(!empty($next)) echo $next;
                            else echo '<a href="javascript:void(0)" class="page_next btn btn-primary btn-lg">'.__('NEWER BLOG POSTS','tfuse').'</a>';

                            if(!empty($prev)) echo $prev;
                            else echo '<a href="javascript:void(0)" class="page_prev btn btn-default btn-lg">'.__('OLDER BLOG POSTS','tfuse').'</a>';
                        ?>
                    </div>
                </div>
            </div>
            <?php
}
endif;

if (!function_exists('tfuse_gallery_pagination')) :
/**
 * Display pagination to next/previous pages when applicable.
 * 
 * To override tfuse_pagination() in a child theme, add your own tfuse_pagination() 
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */
    function tfuse_gallery_pagination() {
        global $wp_query;

        if ( $wp_query->max_num_pages > 1 ) : ?>

            <div class="tf_pagination_center">
                <?php if(get_previous_posts_link())
                         previous_posts_link(__('< PREVIOUS PAGE', 'tfuse'));
                    else
                        echo '<a class="disabled">' . __('< PREVIOUS PAGE', 'tfuse') . '</a>';
                 ?>
                <span>|</span>
                <?php if(get_next_posts_link())
                          next_posts_link(__('NEXT PAGE >', 'tfuse'));
                    else
                        echo '<a class="disabled">' . __('NEXT PAGE >', 'tfuse') . '</a>';
                 ?>
                
            </div>	
	<?php endif;
}
endif; // tfuse_pagination


if (!function_exists('tfuse_shortcode_content')) :
/**
 *  Get post comments for a specific post.
 *
 * To override tfuse_shortcode_content() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_shortcode_content($position = '', $return = false)
    {
        $page_shortcodes = '';
        global $is_tf_front_page,$is_tf_blog_page,$post,$TFUSE;
        $types = $TFUSE->request->isset_GET('types') ? $TFUSE->request->GET('types') : '';
        
        if($position == 'before') $position = 'content_top';
        elseif($position == 'after') $position =  'content_bottom';
        else $position = 'content_bot';

        if((is_front_page() || $is_tf_front_page) && !$is_tf_blog_page)
        {  
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page'){
                $page_id = tfuse_options('home_page'); 
                $page_shortcodes = tfuse_page_options($position,'',$page_id);
            }
            else
            $page_shortcodes = tfuse_options($position);
        }
        elseif($is_tf_blog_page)
        { 
           $position ='blog_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        elseif (is_singular()) {
            global $post;
            $page_shortcodes = tfuse_page_options($position);
        } 
        elseif (is_category()) {
            $cat_ID = get_query_var('cat');
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        } 
        elseif(is_search())
        { 
           $position ='search_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        elseif (is_tax() && $types != 'all_rooms') {
            $taxonomy = get_query_var('taxonomy');
            $term = get_term_by('slug', get_query_var('term'), $taxonomy);
            $cat_ID = $term->term_id;
            $page_shortcodes = tfuse_options($position, '', $cat_ID);
        }
        elseif(is_404())
        { 
           $position ='404_'.$position;
            $page_shortcodes = tfuse_options($position);
        }
        

        $page_shortcodes = tfuse_qtranslate($page_shortcodes);

        $page_shortcodes = apply_filters('themefuse_shortcodes', $page_shortcodes);

        if ($return)
            return $page_shortcodes;
        else
        {
            if((($position == 'content_bottom') && !empty($page_shortcodes)) || (($position == 'blog_content_bottom') && !empty($page_shortcodes)) || (($position == '404_content_bottom') && !empty($page_shortcodes)) || (($position == 'search_content_bottom') && !empty($page_shortcodes)))
            { 
               echo '<div class="middle middle_gray">
                        <div class="container">';
                            echo $page_shortcodes;
               echo '   </div>
                    </div>';
            }
            elseif((($position == 'content_top') && !empty($page_shortcodes))|| (($position == 'blog_content_top') && !empty($page_shortcodes) ) || (($position == '404_content_top') && !empty($page_shortcodes) ) || (($position == 'search_content_top') && !empty($page_shortcodes) ) )
            {
               echo '<div class="middle middle_gray">
                        <div class="container">';
                            echo $page_shortcodes;
               echo '   </div>
                    </div>';
            }
            else
                echo $page_shortcodes;
        }
    }

// End function tfuse_shortcode_content()
endif;


if (!function_exists('tfuse_category_on_front_page')) :
/**
 * Dsiplay homepage category
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_category_on_front_page()
    {
        if ( !is_front_page() ) return;

        global $is_tf_front_page,$homepage_categ;
        $is_tf_front_page = false;

        $homepage_category = tfuse_options('homepage_category');
        $homepage_category = explode(",",$homepage_category);
        foreach($homepage_category as $homepage)
        {
            $homepage_categ = $homepage;
        }

        if($homepage_categ == 'specific')
        {
            $is_tf_front_page = true;
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;           
            
            $specific = tfuse_options('categories_select_categ');

            $ids = explode(",",$specific);
            $posts = array(); 
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                        'cat' => $specific,
                        'orderby' => 'date',
                        'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
                        
            return;
        }
        elseif($homepage_categ == 'page')
        {
            global $front_page;
            $is_tf_front_page = true;
            $front_page = true;
            $archive = 'page.php';
            $page_id = tfuse_options('home_page');

            $args=array(
                'page_id' => $page_id,
                'post_type' => 'page',
                'post_status' => 'publish',
                'posts_per_page' => 1,
                'ignore_sticky_posts'=> 1
            );
            query_posts($args);
            include_once(locate_template($archive));
            wp_reset_query();
            return;
        }
        elseif($homepage_categ == 'all')
        {
            $archive = 'archive-content.php';

            $is_tf_front_page = true;
            wp_reset_postdata();
            include_once(locate_template($archive));
            return;
        }
 
    }

// End function tfuse_category_on_front_page()
endif;

if (!function_exists('tfuse_category_on_blog_page')) :
    /**
     * Dsiplay blogpage category
     *
     * To override tfuse_category_on_blog_page() in a child theme, add your own tfuse_count_post_visits()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

    function tfuse_category_on_blog_page()
    {
        global $is_tf_blog_page;
        $blogpage_categ ='';
        if ( !$is_tf_blog_page ) return;
        $is_tf_blog_page = false;

        $blogpage_category = tfuse_options('blogpage_category');
        $blogpage_category = explode(",",$blogpage_category);
        foreach($blogpage_category as $blogpage)
        {
            $blogpage_categ = $blogpage;
        }
        if($blogpage_categ == 'specific')
        {
            $is_tf_blog_page = true;
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $specific = tfuse_options('categories_select_categ_blog');

            $ids = explode(",",$specific);
            $posts = array();
            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'cat' => $specific,
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
        else
        {  
            $is_tf_blog_page = true;
            $archive = 'archive-content.php';
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $categories = get_categories();

            $ids = array();
            foreach($categories as $cats){
                $ids[] = $cats -> term_id;
            }
            $posts = array(); 

            foreach ($ids as $id){
                $posts[] = get_posts(array('category' => $id));
            }

            $args = array(
                'orderby' => 'date',
                'paged' => $paged
            );
            query_posts($args);

            include_once(locate_template($archive));
            return;
        }
    }
// End function tfuse_category_on_blog_page()
endif;

add_filter('get_archives_link','wid_link',99);
if (!function_exists('wid_link')) :
    function wid_link($url) {
        $url = str_replace( '</a>&nbsp;', '&nbsp;', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;

add_filter('wp_list_bookmarks','wid_link1',99);
if (!function_exists('wid_link1')) :
    function wid_link1($url) {
        $url = str_replace( '</a>', '', $url );
        $url = str_replace( '</li>', '</a></li>', $url );
        return $url;
    }
endif;

if (!function_exists('tfuse_action_footer')) :

/**
 * Dsiplay footer content
 *
 * To override tfuse_category_on_front_page() in a child theme, add your own tfuse_count_post_visits()
 * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
 */

    function tfuse_action_footer() {

    ?>
            <div class="col-md-4 f_col f_col_1">
                <?php dynamic_sidebar('footer-1'); ?>
            </div>
            <div class="col-md-2 f_col f_col_2">
                <?php dynamic_sidebar('footer-2'); ?>
            </div>
            <div class="col-md-2 f_col f_col_3">
                <?php dynamic_sidebar('footer-3'); ?>
            </div>
        <?php
    }
    add_action('tfuse_footer', 'tfuse_action_footer');
endif;

    
function new_excerpt_more( $more ) {
    $more = '';
        return $more;
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
    return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

if (!function_exists('tfuse_group_title')) :
    function tfuse_group_title(){
        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy') );
        $ID = $term->term_id;
        $title = tfuse_options('group_title',null,$ID);
        echo $title;
    }
endif;

if ( !function_exists('tfuse_img_content')):

    function tfuse_img_content(){ 
        $content = $link = '';
		$args = array(
			'numberposts'     => -1,
		); 
        $posts_array = get_posts( $args );
        $option_name = 'thumbnail_image';
		foreach($posts_array as $post):
			$featured = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID));  
			if(tfuse_page_options('thumbnail_image',false,$post->ID)) continue;
			
			if(!empty($featured))
			{
				$value = $featured[0];
				tfuse_set_page_option($option_name, $value, $post->ID);
				tfuse_set_page_option('disable_image', true , $post->ID); 
			}
			else
			{
				$args = array(
				 'post_type' => 'attachment',
				 'numberposts' => -1,
				 'post_parent' => $post->ID
				); 
				$attachments = get_posts($args);
				if ($attachments) {
				 foreach ($attachments as $attachment) { 
								$value = $attachment->guid; 
								tfuse_set_page_option($option_name, $value, $post->ID);
								tfuse_set_page_option('disable_image', true , $post->ID); 
							 }
				}
				else
				{
					$content = $post->post_content;
						if(!empty($content))
						{   
							preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content,$matches);
							if(!empty($matches))
							{
								$link = $matches[1]; 
								tfuse_set_page_option($option_name, $link , $post->ID);
								tfuse_set_page_option('disable_image', false , $post->ID);
							}
						}
				}
			}
                        
		endforeach;
			tfuse_set_option('enable_content_img',false, $cat_id = NULL);
    }
endif;

if ( tfuse_options('enable_content_img'))
{ 
    add_action('tfuse_head','tfuse_img_content');
}


//get current term slug
if (!function_exists('tfuse_get_term')) :	
    function tfuse_get_term() {
        $terms = get_queried_object()->name;
        $term = get_term_by('name', $terms , 'services');
        $term = $term->slug;
        return $term;
    }
endif;

if(!function_exists('tfuse_feedFilter')) :

    function tfuse_feedFilter($query) {
        if ($query->is_feed) {
            add_filter('the_content', 'tfuse_feedContentFilter');
        }
        return $query;
    }
    add_filter('pre_get_posts','tfuse_feedFilter');

    function tfuse_feedContentFilter($content) {
        $thumb = tfuse_page_options('single_image');
        $image = '';
        if($thumb) {
            $image = '<a href="'.get_permalink().'"><img align="left" src="'. $thumb .'" width="200px" height="150px" /></a>';
            echo $image;
        }
        $content = $image . $content;
        return $content;
    }

endif;

if (!function_exists('tfuse_aasort')) :
    /**
     *
     *
     * To override tfuse_aasort() in a child theme, add your own tfuse_aasort()
     * to your child theme's file.
     */
    function tfuse_aasort ($array, $key) {
        $sorter=array();
        $ret=array();
        if (!$array){$array = array();}
        reset($array);
        foreach ($array as $ii => $va) {
            $sorter[$ii]=$va[$key];
        }
        asort($sorter);
        foreach ($sorter as $ii => $va) {
            $ret[$ii]=$array[$ii];
        }
        return $ret;
    }
endif;

function tfuse_change_submenu_class($menu) {
    $menu = preg_replace('/ class="sub-menu"/','/ class="submenu-1" /',$menu);
    return $menu;
}
add_filter ('wp_nav_menu','tfuse_change_submenu_class');

if (!function_exists('tfuse_gallery_attachment')) :	
    function tfuse_gallery_attachment($ID,$option) 
    {	
        $c = 0;
        $attachments = tfuse_get_gallery_images($ID,TF_THEME_PREFIX . '_' . $option);
        $slider_images = array();
        if ($attachments) {  
            foreach ($attachments as $attachment){ 
                $parent = $attachment->post_parent;
                
                if($attachment->image_options != null) 
                {  
                    $c++;
                    if($parent == $attachment->post_parent && $c > 1) continue;
                    $slider_images[] = array(
                    'order'        =>-1,
                    'img_full'    => $attachment->guid,
                    'main'        => $attachment->image_options['imgmain_check'],
                    'parent'  => $attachment->post_parent 
                        );
                }
                else
                { 
                    $slider_images[] = array(
                    'order'        =>$attachment->menu_order,
                    'img_full'    => $attachment->guid,
                    'main'        => 'no',
                    'parent'  => $attachment->post_parent
                    );

                }
            }
            
           
        }
        $slider_images = tfuse_aasort($slider_images,'order');
        
        return $slider_images;
       
    }
endif;

if (!function_exists('tfuse_count_attachment')) :	
    function tfuse_count_attachment($ID,$option) 
    {	
        $countat = 0;
        $attachments = tfuse_get_gallery_images($ID,TF_THEME_PREFIX . '_' . $option);
        if ($attachments) {  
            $countat = count($attachments);
        }
        return $countat;
    }
endif;

if (!function_exists('tfuse_hasmain_attachment')) :	
    function tfuse_hasmain_attachment($countat,$ID,$option) 
    {	
        $slider_images = tfuse_gallery_attachment($ID,$option);
        $hasmain = '';
        for($i = 0;$i < $countat;$i++)
            {
                if($slider_images[$i]['main'] == 'yes' )
                {
                    $hasmain = 'yes';
                    return $hasmain;
                }
            }
        
    }
endif;

//display logo
if (!function_exists('tfuse_type_logo')) :
    function tfuse_type_logo() { 
        $logo_upload = tfuse_options('logo');
        if(!empty($logo_upload)) 
        {  ?> 
              <div class="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo tfuse_options('logo'); ?>"  border="0" /></a></div>
  <?php }
        else
        {      
            ?>
                <div class="logo"><a href="<?php echo home_url(); ?>"><img src="<?php echo tfuse_logo(); ?>"   border="0" /></a></div>
            <?php 
         }
    }
endif;

if (!function_exists('tfuse_shorten_string')) :
    /**
     * To override tfuse_shorten_string() in a child theme, add your own tfuse_shorten_string()
     * to your child theme's theme_config/theme_includes/THEME_FUNCTIONS.php file.
     */

function tfuse_shorten_string($string, $wordsreturned)

{
    $retval = $string;

    $array = explode(" ", $string);
    if (count($array)<=$wordsreturned)

    {
        $retval = $string;
    }
    else

    {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array)." ...";
    }
    return $retval;
}

endif;

if (!function_exists('tfuse_gallery_widget')) :	
    function tfuse_gallery_widget($ID) 
    {	
        $attachments = tfuse_get_gallery_images($ID,TF_THEME_PREFIX . '_thumbnail_image');
        $slider_images = array();
        if ($attachments) {  
            foreach ($attachments as $attachment){ 
                 $slider_images[] = array(
                'order'        =>$attachment->menu_order,
                'img_full'    => $attachment->guid,
                );
            }
        }
        $slider_images = tfuse_aasort($slider_images,'order'); 
        return $slider_images;
       
    }
endif;

if ( !function_exists('tfuse_get_categories_for_post')):

    function tfuse_get_categories_for_post($id,$type) {
        $count = 0;   
        if($type == 'category')
        {   
            $cats = wp_get_post_categories( $id ); 
            if(!empty($cats))
            {
                foreach($cats as $cat)
                {
                    $count++;
                    if($count == count($cats))
                        echo   '<a href="'.get_category_link($cat).'">'.get_cat_name( $cat ).'</a>';
                    else
                        echo   '<a href="'.get_category_link($cat).'">'.get_cat_name( $cat ).'</a>, ';
                }
            }
        }
        else
        {
            $terms = wp_get_post_terms( $id ,'offers');
            
            if(!empty($terms))
            {
                foreach($terms as $term)
                {
                    $count++;
                    if($count == count($terms))
                        echo   '<a href="'.get_term_link($term,'offer').'">'.$term->name.'</a>';
                    else
                        echo   '<a href="'.get_term_link($term,'offer').'">'.$term->name.'</a>, ';
                }
            }
            
        }
        
        
    }
endif;

if (!function_exists('tfuse_filter_get_avatar')){

    function tfuse_filter_get_avatar($avatar, $id_or_email, $size, $default, $alt){
        $email_hash = '';
        $avatar_src = tfuse_options('default_avatar', false);
        if(empty($avatar_src)) {
            return $avatar;
        }

        $email = '';
        if ( is_numeric($id_or_email) ) {
            $id = (int) $id_or_email;
            $user = get_userdata($id);
            if ( $user )
                $email = $user->user_email;
        } elseif ( is_object($id_or_email) ) {
            // No avatar for pingbacks or trackbacks
            $allowed_comment_types = apply_filters( 'get_avatar_comment_types', array( 'comment' ) );
            if ( ! empty( $id_or_email->comment_type ) && ! in_array( $id_or_email->comment_type, (array) $allowed_comment_types ) )
                return false;

            if ( !empty($id_or_email->user_id) ) {
                $id = (int) $id_or_email->user_id;
                $user = get_userdata($id);
                if ( $user)
                    $email = $user->user_email;
            } elseif ( !empty($id_or_email->comment_author_email) ) {
                $email = $id_or_email->comment_author_email;
            }
        } else {
            $email = $id_or_email;
        }

        if ( !empty($email) )
            $email_hash = md5( strtolower( trim( $email ) ) );

        $url = 'http://gravatar.com/' . $email_hash . '.php'; 
        $result = unserialize(@file_get_contents($url)); 
        
        if(!is_array($result)){  
            $avatar = "<img alt='' src='".TF_GET_IMAGE::get_src_link($avatar_src)."' class='avatar avatar-".$size." photo avatar-default' height='".$size."' width='".$size."' />";
        }
        return $avatar;
    }
    add_filter('get_avatar', 'tfuse_filter_get_avatar',10,5);
}

if (!function_exists('tfuse_get_room_tags')) :	
    function tfuse_get_room_tags($id) 
    {	
        $terms = wp_get_post_terms( $id , 'tags' );
        $result = array();
        
        if(!empty($terms))
        {
            foreach ($terms as $term) {
                $result[$term->term_id] = $term->name;
            }
        }
        return $result;
    }
endif;


if ( !function_exists('tfuse_pass_post_id')):

    function tfuse_pass_post_id() {
        global $post;
        
        if(is_singular('room'))
        {  
            
                $rating = array();

                $rating['room-'.$post->ID.'-rating']['val'] = '';
                $rating['room-'.$post->ID.'-rating']['count'] = 0;
                                
                $rating_info = get_post_meta($post->ID, TF_THEME_PREFIX . '_rating', true);
                
                
                if(empty($rating_info)) {$rating_info = $rating;}
                
                wp_localize_script(
                        'general',
                        'rating',
                        array(
                            'id' => $post->ID,
                            'rating_info' => $rating_info,
                        )
                    );
        }
        else
        {
            wp_localize_script(
                        'general',
                        'rating',
                        array(
                            'id' => '',
                            'rating_info' => '',
                        )
                    );
        }
    }
    add_action('wp_print_scripts', 'tfuse_pass_post_id', 1000);
endif;

if (!function_exists('tfuse_get_room_rating')) :	
    function tfuse_get_room_rating($id) 
    {	
        $rating_info = get_post_meta($id, TF_THEME_PREFIX . '_rating', true);
        $all_stars = array();
        
        if(!empty($rating_info))
        {
            foreach ($rating_info as $value) {
                if(!empty($value))
                {
                    $stars = $value['val']/$value['count'];
                    $int_stars = (int)($value['val']/$value['count']);
                    $rest = $stars - $int_stars;
                    
                    if(($rest > 0.5) || ($rest == 0))
                    {
                        $all_stars['all_stars'] = round($stars);
                        $all_stars['half_star'] = false;
                    }
                    else
                    {
                        $all_stars['all_stars'] = $int_stars;
                        $all_stars['half_star'] = true;
                    }
                }
            }
        }
        return $all_stars;
    }
endif;

if (!function_exists('tfuse_show_room_rating')) :	
    function tfuse_show_room_rating($id) 
    {	
        $all_stars = tfuse_get_room_rating($id);
        $stars = '';
        
        if(!empty($all_stars))
        {
            switch($all_stars['all_stars'])
            {
                case 1: 
                    if($all_stars['half_star']) $stars = '<span class="star1"></span><span class="star2 half-star"></span>';
                    else $stars = '<span class="star1"></span>';
                    break;
                case 2: 
                    if($all_stars['half_star']) $stars = '<span class="star1"></span><span class="star2"></span><span class="star3 half-star"></span>';
                    else $stars = '<span class="star1"></span><span class="star2"></span>';
                    break;
                case 3: 
                    if($all_stars['half_star']) $stars = '<span class="star1"></span><span class="star2"></span><span class="star3"></span><span class="star4 half-star"></span>';
                    else $stars = '<span class="star1"></span><span class="star2"></span><span class="star3"></span>';
                    break;
                case 4: 
                    if($all_stars['half_star']) $stars = '<span class="star1"></span><span class="star2"></span><span class="star3"></span><span class="star4"></span><span class="star5 half-star"></span>';
                    else $stars = '<span class="star1"></span><span class="star2"></span><span class="star3"></span><span class="star4"></span>';
                    break;
                default: 
                    if($all_stars['half_star']) $stars = '<span class="star1"></span><span class="star2"></span><span class="star3"></span><span class="star4"></span><span class="star5"></span>';
                    else $stars = '<span class="star1"></span><span class="star2"></span><span class="star3"></span><span class="star4"></span><span class="star5"></span>';
                    break;
            }
        }
        return $stars;
    }
endif;

if (!function_exists('tfuse_middle_background')):

    function tfuse_middle_background() {
        global $is_tf_blog_page,$is_tf_front_page,$TFUSE;
        $content = tfuse_options('content_color');
        $types = $TFUSE->request->isset_GET('types') ? $TFUSE->request->GET('types') : '';
        
        if($is_tf_front_page)
        {
            $page_id = tfuse_options('home_page');
            if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
            {
                $content = tfuse_page_options('content_color','',$page_id);
            }
            else{
                $content = tfuse_options('content_color_home');
            } 
        }
        elseif($is_tf_blog_page)
        {
            $content = tfuse_options('content_color_blog');
        }
        elseif(is_singular())
        {
            $content = tfuse_page_options('content_color');
        }
        elseif(is_category())
        {
            $ID = get_query_var('cat');
            $content = tfuse_options('content_color',null,$ID);
        }
        elseif(is_search())
        { 
            $content = tfuse_options('content_color_search');
        }
        elseif(is_tax() && $types != 'all_rooms')
        {
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $ID = $term->term_id;
            $content = tfuse_options('content_color',null,$ID);
        }
        elseif(is_404())
        { 
            $content = tfuse_options('content_color_404');
        }
        
        return $content;
    }

endif;

if (!function_exists('aj_get_url_data')) :
    function aj_get_url_data($url) {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
endif;

if (!function_exists('tfuse_show_local_titme')) :	
    function tfuse_show_local_titme() 
    {	
        $coords = explode(':', tfuse_options('your_location'));
        $tmp_conf = $time = array();
        
        if(!empty($coords))
        {
            $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
            $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);
            
            if(!empty($tmp_conf['post_coords']['lat']) || !empty($tmp_conf['post_coords']['lng']))
            {
                $user = tfuse_options('local_date_user');
                if(!empty($user))
                {
                    $url = 'http://api.geonames.org/timezone?lat='.$tmp_conf['post_coords']['lat'].'&lng='.$tmp_conf['post_coords']['lng'].'&username='.$user;
                    if(ini_get('allow_url_fopen')){
                        $data = simplexml_load_file($url);
                    }
                    elseif(function_exists('curl_init')){
                        $returned_content = aj_get_url_data($url);
                        $data = simplexml_load_string($returned_content) or die("Something is wrong");
                    }
                    else{
                        return;
                    }

                    $time['local'] = date("g:i A",strtotime($data->timezone->time));
                    $time['sunset'] = date("g:i A",strtotime($data->timezone->sunset));
                }
            }
        }
        
        return $time;
    }
endif;

if (!function_exists('tfuse_pre_get_posts')) :
    
function tfuse_pre_get_posts($query){
    global $TFUSE,$wp_query;
    if(($query->is_search && $TFUSE->request->isset_GET('check_in')) || ($query->is_search && $TFUSE->request->isset_GET('check_out')))
    {
        $d_in_flex = $d_out_flex = '';
        $ids = array();
        
        $date_in = $TFUSE->request->GET('check_in');
        $date_out = $TFUSE->request->GET('check_out');
        

        $d_in = strtotime($date_in);
        $d_out = strtotime($date_out);
        
        $slug = ($TFUSE->request->isset_GET('types')) ? $TFUSE->request->GET('types') : 'all_rooms';
        
        if($slug != 'all_rooms') { 
            $args = array(
            'posts_per_page' => -1,
            'post_type' => 'room',
            'tax_query' => array(
		array(
			'taxonomy' => 'types',
			'field' => 'slug',
			'terms' => $slug
                    )
                )
            );
        }
        elseif($slug == 'all_rooms') {
            $new_query = array(
                's' => 'a',
                'post_type'    => 'room',
            );
            
            $tax_query = array(
                'queries' => array(),
                'relation'    => 'AND',
            );
            
            unset($query->query_vars['types']);
            $query->query_vars['post_type'] = 'room';
            $query->query = $new_query;
            $query->tax_query = $tax_query;
            
            $args = array(
                'posts_per_page' => -1,
                'post_type' => 'room'
            );
        }
        
        $all_posts = new WP_Query( $args );
        $posts = $all_posts->posts;

        if(!empty($date_in) && !empty($date_out))
        {    
            if(!empty($posts))
                $post_dates = array();
                foreach ($posts as $post) {
                    $dates = tfuse_page_options('content_tabs_table','',$post->ID);
                    
                    if(!empty($dates))
                        foreach($dates as $key => $date)
                        {
                            $post_dates[$post->ID][$key] = $date;
                        }
                    else
                        $ids[] = $post->ID;
                }
                if(!empty($post_dates))
                {
                    foreach($post_dates as $post_id => $all_dates)
                    {
                        if(count($all_dates) == 1)
                        {
                            foreach($all_dates as $date_in_out)
                            {
                                $date_post_from = strtotime($date_in_out['tab_title']);
                                $date_post_to = strtotime($date_in_out['tab_content']);

                                if(( $d_in < $date_post_from &&  $d_out < $date_post_from) || ( $d_in > $date_post_to &&  $d_out > $date_post_to))
                                    $ids[] = $post_id;
                            }
                        }
                        else
                        {
                            foreach($all_dates as $date_in_out)
                            {
                                $date_post_from = strtotime($date_in_out['tab_title']);
                                $date_post_to = strtotime($date_in_out['tab_content']);
                                
                                if(( $d_in < $date_post_from &&  $d_out < $date_post_from) || ( $d_in > $date_post_to &&  $d_out > $date_post_to))
                                    $in_interval[] = true;
                                else
                                    $in_interval[] = false;
                            }
                            
                            if(!in_array(false,$in_interval))
                                    $ids[] = $post_id;
                        }
                    }
                }
                else {
                    foreach ($posts as $post) {
                        $ids[] = $post->ID;
                    }
                }
        }
        elseif((!empty($date_in) && empty($date_out)) || (empty($date_in) && !empty($date_out)))
        {    
            if(!empty($date_in) && empty($date_out)) $d = $d_in;
            else $d = $d_out;
            
            if(!empty($posts))
            {
                $post_dates = array();
                foreach ($posts as $post) {
                    $dates = tfuse_page_options('content_tabs_table','',$post->ID);
                    
                    if(!empty($dates))
                        foreach($dates as $key => $date)
                        {
                            $post_dates[$post->ID][$key] = ($date['tab_content']);
                        }
                }
                if(!empty($post_dates))
                {
                    foreach($post_dates as $post_id => $all_dates)
                    {
                        if(count($all_dates) == 1)
                            foreach($all_dates as $date_in_out)
                            {
                                if($d > strtotime($date_in_out) )
                                {
                                    $ids[] = $post_id;
                                }
                            }
                        else
                        {
                            $x = $all_dates[0];
                            for($i = 1; $i < count($all_dates); $i++)
                            {
                                if($all_dates[$i] > $x)
                                    $x = $all_dates[$i];
                            }
                            if($d > strtotime($x) )
                            {
                                $ids[] = $post_id;
                            }
                        }
                    }
                }
            }
        }
        else 
        {
            if(!empty($posts))
            foreach ($posts as $post) {
                $ids[] = $post->ID;
            }
        }

        
        if(!empty($ids) && $slug != 'all_rooms')
        {
            $query->set( 'post_type', array('room') );
            $query->set( 's', ' ' );
            $query->set( 'post__in', $ids );
        }
        elseif(!empty($ids) && $slug == 'all_rooms')
        {
            $query->set( 's', ' ' );
            $query->set( 'post__in', $ids );
        }
        else
        {
            $query->set( 'post__in', array(0));
        }
    }
    
    return $query;
}
add_filter('pre_get_posts', 'tfuse_pre_get_posts');

endif;

add_filter("comment_id_fields","tfuse_my_submit_comment_message");
function tfuse_my_submit_comment_message($result){
    return $result.'<a onclick="document.getElementById(&#39;addcomments&#39;).reset();return false" href="#" class="link-reset">'. __('Reset all fields', 'tfuse').'</a>';
}



if ( !function_exists('tfuse_languages_select')):

    function tfuse_languages_select() {
       if(!function_exists('qtrans_generateLanguageSelectCode'))
       {    return '';}
        
       qtrans_generateLanguageSelectCode('text');
       
    }
endif;

if ( !function_exists('tfuse_current_language')):

    function tfuse_current_language() {
       if(!function_exists('qtrans_getLanguage'))
       {    return '';}
        
       echo ucfirst(qtrans_getLanguage());
       
    }
endif;

if ( !function_exists('tfuse_dates_interval')):

    function tfuse_dates_interval() {
       $result = array(); global $post;
       
       $dates = tfuse_page_options('content_tabs_table','',$post->ID);
       
        if(!empty($dates))
        {
            if(count($dates) == 1)
            {
                foreach ($dates as $date) {
                    $alldates = array($date['tab_title']);
                    while(end($alldates) < $date['tab_content']){
                        $alldates[] = date('Y-m-d', strtotime(end($alldates).' +1 day'));
                    }
                }
                $result = $alldates;
            }
            else
            {
                $all_interval_dates = array();
                foreach ($dates as $date) {
                    $alldates = array($date['tab_title']);
                    while(end($alldates) < $date['tab_content']){
                        $alldates[] = date('Y-m-d', strtotime(end($alldates).' +1 day'));
                    }
                    $all_interval_dates[] = $alldates;
                }

                $result = call_user_func_array('array_merge_recursive', $all_interval_dates);
            }
        }
        return $result;
    }
endif;

if(!function_exists('tfuse_update_reservation_forms'))
{
    function tfuse_update_reservation_forms()
    {
        $forms = get_terms( 'reservations', array(
            'orderby'    => 'count',
            'hide_empty' => 0
        ) );

        $args = array(
            '0' =>  'text',
            '1' =>  'textarea',
            '2' =>  'radio',
            '3' =>  'checkbox',
            '4' =>  'select',
            '5' =>  'email',
            '6' =>  'captcha',
            '7' =>  'date_in',
            '8' =>  'date_out',
            '9' =>  'res_email',
        );

        foreach($forms as $form)
        {
            $check_option = get_option( 'tfuse_update_reservation_forms', 'none' );
            if($check_option == 'set')
            {
                return;
            }
            $description = unserialize($form->description);
            if(isset($description['version']) AND $description['version'] == '1.1')
                continue;

            foreach($description['input'] as $key => $input)
            {
                if(isset($args[$input['type']]))
                    $input['type'] = $args[$input['type']];
                $description['input'][$key]['type'] = $input['type'];
            }
            $description['version'] = '1.1';
            wp_update_term($form->term_id, 'reservations', array('description' => serialize($description)));
            add_option('tfuse_update_reservation_forms', 'set');
        }
    }
    add_action('wp_head', 'tfuse_update_reservation_forms');
}

add_theme_support( 'automatic-feed-links' );


function tfuse_feedburner_url($output, $feed)
{
    $feedburner_url = tfuse_options('feedburner_url');
    if($feedburner_url && (($feed == 'rss2') || ($feed == '' && false === strpos($output, '/comments/feed/'))) )
        return $feedburner_url;
    return $output;
}
add_filter('feed_link','tfuse_feedburner_url',10,2);