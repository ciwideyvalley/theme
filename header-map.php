<?php
$template_directory = get_template_directory_uri();
wp_register_script('maps.google.com', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), '1.0', true);
wp_register_script('jquery.gmap', $template_directory . '/js/jquery.gmap.min.js', array('jquery', 'maps.google.com'), '', true);
wp_print_scripts('maps.google.com');
wp_print_scripts('jquery.gmap');

global $is_tf_blog_page;

if ( $is_tf_blog_page )
{
    //if is blog page
    $tmp_conf['post_id'] = $post->ID;
    $tmp_conf ['show_all_markers'] = false;
    $coords = explode(':', tfuse_options('page_map_blog'));
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

        $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
    }
}
elseif (is_front_page())
{
    $page_id = tfuse_options('home_page');
    if(tfuse_options('use_page_options') && tfuse_options('homepage_category')=='page')
    {   
        $tmp_conf['post_id'] = $page_id;
         $tmp_conf ['show_all_markers'] = false;
        $coords = explode(':', tfuse_page_options('page_map','',$page_id)); 
    }
    else
    {   
        $tmp_conf['post_id'] = $post->ID;
         $tmp_conf ['show_all_markers'] = false;
        $coords = explode(':', tfuse_options('page_map'));
    }
     if((!$coords[0]) || (!$coords[1]))
        {
            $tmp_conf ['show_all_markers'] = true;
        }
        else
        {
            $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
            $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

            $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
        }
}
elseif (is_category())
{
    //if is front_page
    $ID = get_query_var('cat'); 
    $tmp_conf ['show_all_markers'] = false;
    $coords = explode(':', tfuse_options('page_map',null,$ID));
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

        $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
    }
}
elseif (is_tax())
{
    $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
    $ID = $term->term_id;
    $tmp_conf ['show_all_markers'] = false;
    $coords = explode(':', tfuse_options('page_map',null,$ID));
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

        $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
    }
}
elseif ((is_page() || is_single()))
{
    //if is page
    $tmp_conf['post_id'] = $post->ID;
    $tmp_conf ['show_all_markers'] = false;
    $coords = explode(':', tfuse_page_options('page_map'));
    if((!$coords[0]) || (!$coords[1]))
    {
        $tmp_conf ['show_all_markers'] = true;
    }
    else
    {
        $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
        $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);

        $tmp_conf['post_coords']['html']    = '<strong>'.__('We','tfuse').'</strong><span>'.__('are','tfuse').'</span>'.__('here','tfuse');
    }
}



if(!empty($tmp_conf['post_coords']['lat']) || !empty($tmp_conf['post_coords']['lng'])):
?>	    
<div class="middle middle_dark">
        <div class="map_container">
        <div id="map-loc" class="map"></div>
        <script type="text/javascript">
            var $j = jQuery.noConflict();
            $j(window).load(function(){
                $j("#map-loc").gMap({
                    scrollwheel: false,
                    maptype: 'TERRAIN',
                    markers: [{
                        latitude:  <?php echo $tmp_conf['post_coords']['lat']?>,
                        longitude: <?php echo $tmp_conf['post_coords']['lng']?>}],
                    zoom: 14
                    });
            });
        </script>
        
    </div>
</div>
<?php endif;?>