<?php
function tfuse_room_type($atts, $content = null)
{
    extract( shortcode_atts(array('post' => ''), $atts) );
    
    $out = '';
    $term_id = tfuse_page_options('room_type','',$post);
    $term = get_term_by( 'id', $term_id, 'types');
    
    //get room attachments
    $attachments = tfuse_get_gallery_images($post,TF_THEME_PREFIX . '_room_gallery');
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

    if(!empty($slider_images))
    {
        foreach($slider_images as $images)
        {
            $img = TF_GET_IMAGE::get_src_link($images['img_full'],150,140);
            break;
        }
    }
    else {
        $img = TF_GET_IMAGE::get_src_link(get_template_directory_uri().'/images/room_shortcode.jpg',150,140);
    }
    
    $out .= '<div class="widget-container widget_room">
                <h3 class="widget-title">'.strtoupper($term->name).'</h3>
                <div class="widget_room_content">
                    <div class="room_type"><img src="'.TF_GET_IMAGE::get_src_link(tfuse_options('types_icon','',$term_id),39,39).'" alt=""/></div>
                    <div class="room_image"><a href="'.get_permalink($post).'"><img src="'.$img.'" alt=""/></a></div>
                    <div class="room_price"><strong>'.tfuse_options('default_currency').tfuse_page_options('room_price','',$post).'</strong> <span>'.__('per night','tfuse').'</span></div>
                    <div class="room_detail">
                        <span class="icon-ok"></span>
                        <a href="'.get_permalink($post).'">'.__('DETAILS','tfuse').'</a>
                        <span class="icon-chevron-right"></span>
                    </div>
                </div>
            </div>';
    return $out;
}

$atts = array(
    'name' => __('M_Room Type', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Select Room','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_room_type_post',
            'value' => '',
            'options' =>  tfuse_list_rooms(),
            'type' => 'select',
        )
    )
);

tf_add_shortcode('room_type', 'tfuse_room_type', $atts);
