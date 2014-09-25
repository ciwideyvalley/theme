<?php
function tfuse_special_offer($atts, $content = null)
{
    extract( shortcode_atts(array('post' => '','offers_link' => '','subtitle' => '','title' => '',
        'desc' => '','notice' => '','reserv_link' => '','email' => '','enable' => '',
        'phone' => '','contact_desc' => ''), $atts) );
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
            $img = TF_GET_IMAGE::get_src_link($images['img_full'],200,200);
            break;
        }
    }
    
    $out .= '<div class="reservation_bottom">
                <div class="col col-left">
                    <div class="offer_bottom">
                        <div class="offer-head">
                            <h2>'.__('Events','tfuse').'</h2>
                            <a href="'.$offers_link.'">'.__('View All Special Offers','tfuse').'</a>
                        </div>
                        <div class="offer-body clearfix">
                            <div class="offer-image"><a href="'.get_permalink($post).'"><img src="'.$img.'" alt=""/><span class="ribbon"><i class="icon-heart"></i></span></a></div>
                            <div class="offer-aside">
                                <div class="offer-subtitle">'.$subtitle.'</div>
                                <h3>'.$title.'</h3>
                                <p>'.$desc.'</p>
                                <div class="offer-meta">
                                    <img src="'.TF_GET_IMAGE::get_src_link(tfuse_options('types_icon','',$term_id),39,39).'" alt="" class="icon"/>
                                    <div class="offer-price"><strong><sup>'.tfuse_options('default_currency').'</sup>'.tfuse_page_options('room_price','',$post).'</strong> <span>'.__('per night','tfuse').'</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="offer-footer">
                            <div class="offer-date">'.$notice.'</div>
                            <a href="'.$reserv_link.'" class="offer-book-btn">'.__('Book Offer Now','tfuse').'</a>
                        </div>
                    </div>';
                  if($enable == 'yes')
                  {
                    $out .='<div class="title_block">
                          <span class="btn btn-white btn-lg">'.__('CALL US AT','tfuse').':  <span>'.$phone.'</span></span>
                          <a href="mailto:'.$email.'" class="btn btn-primary btn-lg">'.__('CONTACT US BY EMAIL','tfuse').'</a>
                          <p class="text_notice"><em>'.$contact_desc.'</em></p>
                      </div>';
                  }

              $out .='</div>
            </div>';
    return $out;
}

$atts = array(
    'name' => __('Special offer', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Select Room','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_special_offer_post',
            'value' => '',
            'options' =>  tfuse_list_rooms(),
            'type' => 'select',
            'divider' => true
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Shortcode title','tfuse'),
            'id' => 'tf_shc_special_offer_title',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('SubTitle','tfuse'),
            'desc' => __('Shortocde subtitle','tfuse'),
            'id' => 'tf_shc_special_offer_subtitle',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('All offers','tfuse'),
            'desc' => __('Link to all offers','tfuse'),
            'id' => 'tf_shc_special_offer_offers_link',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('Description','tfuse'),
            'desc' => __('Short description','tfuse'),
            'id' => 'tf_shc_special_offer_desc',
            'value' => '',
            'type' => 'textarea',
            'divider' => true
        ),
        array(
            'name' => __('Notice','tfuse'),
            'desc' => __('Shortcode notice','tfuse'),
            'id' => 'tf_shc_special_offer_notice',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('Reservations','tfuse'),
            'desc' => __('Link to all reservations','tfuse'),
            'id' => 'tf_shc_special_offer_reserv_link',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('Info','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_special_offer_enable',
            'value' => 'yes',
            'options' =>  array('no'=>'Don\'t show contact info','yes' => 'Show contact info'),
            'type' => 'select'
        ),
        array(
            'name' => __('Phone','tfuse'),
            'desc' => __('Phone number','tfuse'),
            'id' => 'tf_shc_special_offer_phone',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Email','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_special_offer_email',
            'value' => '',
            'type' => 'text'
        ),
         array(
            'name' => __('Description','tfuse'),
            'desc' => __('Contact description','tfuse'),
            'id' => 'tf_shc_special_offer_contact_desc',
            'value' => '',
            'type' => 'textarea'
        ),
    )
);

tf_add_shortcode('special_offer', 'tfuse_special_offer', $atts);
