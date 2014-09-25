<?php
function tfuse_room_types($atts, $content = null) {
    global $room_types,$result;
    extract(shortcode_atts(array('reservation' => ''), $atts));
    
    $shortcode_reservation = '[tfuse_reservationform tf_rf_formid="'.$reservation.'"]';
    
    $get_room_types = do_shortcode($content);
    $i = $count = $c = 0; 
    $output = '';
        $output .= ' <div class="book-table tf_room_types_reservations">
                        <div class="row-head clearfix">
                            <div class="room-col-1">'.__('Room Type','tfuse').'</div>
                            <div class="room-col-2">'.__('Occupancy','tfuse').'</div>
                            <div class="room-col-3">'.__('Conditions','tfuse').'</div>
                            <div class="room-col-4">'.__('Reservation','tfuse').'</div>
                        </div>
                        <ul>';
            while (isset($room_types['post'][$i])){ $count++;
                //gt star rating
                $stars = tfuse_show_room_rating($room_types['post'][$i]);
                
                //get room dates
               $dates = tfuse_page_options('content_tabs_table','',$room_types['post'][$i]);
               
                //get room attachments
                $attachments = tfuse_get_gallery_images($room_types['post'][$i],TF_THEME_PREFIX . '_room_gallery');
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
                        $img = TF_GET_IMAGE::get_src_link($images['img_full'],160,160);
                        break;
                    }
                }
                else {
                    $img = TF_GET_IMAGE::get_src_link(get_template_directory_uri().'/images/room_shortcode.jpg',160,160);
                }
                
                $term_id = tfuse_page_options('room_type','',$room_types['post'][$i]);
                $term = get_term_by( 'id', $term_id, 'types');
                                
                $output .= '<li class="room-row clearfix">
                        <div class="room-col-1">
                            <img src="'.$img.'" alt="" class="room-img"/>
                            <div class="room-status">'.$room_types['subtitle'][$i].'</div>
                            <a href="'.get_permalink($room_types['post'][$i]).'"><h2>'.get_the_title($room_types['post'][$i]).'</h2></a>
                            <div class="star_rating rating5">
                                '.$stars.'
                            </div>
                            <div class="room-notice">'.$room_types['desc'][$i].'</div>
                        </div>
                        <div class="room-col-2">
                            <div class="room-type">'.strtoupper($term->name).'
                                <img src="'.TF_GET_IMAGE::get_src_link(tfuse_options('types_icon','',$term_id),39,39).'" alt=""/>
                            </div>
                            <div class="room-price">
                                <strong>
                                    <sup>'.tfuse_options('default_currency').'</sup>'.tfuse_page_options('room_price','',$room_types['post'][$i]).'
                                </strong>
                                <span>'.__('per night','tfuse').'</span></div>
                        </div>
                        <div class="room-col-3" id="col_datepickers">
                            <div class="room-cond clearfix">
                                <input type="text" name="check_in_'.$room_types['post'][$i].'" class="inputField check_in_date" value="" placeholder="'.__('Check-in date','tfuse').'" id="check_in_'.$room_types['post'][$i].'">
                                <span class="icon icon-calendar"></span>
                            </div>
                            <div class="room-cond clearfix">
                                <input type="text" name="check_out_'.$room_types['post'][$i].'" class="inputField check_out_date" value="" placeholder="'.__('Check-out date','tfuse').'" id="check_out_'.$room_types['post'][$i].'">
                                <span class="icon icon-calendar"></span>
                            </div>
                            <script> ';
                                    $result = array();
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
                                    
                         $output .='  
                            jQuery(document).ready(function($) {
                                var array = '.json_encode($result).'; 
                                    
                                jQuery("#check_in_'.$room_types['post'][$i].'").datepicker({
                                    dateFormat: "yy-m-dd",
                                    dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                                    minDate: 0,
                                    showOtherMonths: true,
                                    firstDay: 1,
									onSelect: function( selectedDate ) {
										jQuery( "#check_out_'.$room_types['post'][$i].'" ).datepicker( "option", "minDate", selectedDate );
									},
                                    beforeShowDay: function(date){ 
                                        var string = jQuery.datepicker.formatDate("yy-mm-dd", date);
                                        return [ array.indexOf(string) == -1 ]
                                    }
                                 });
                                jQuery("#check_out_'.$room_types['post'][$i].'").datepicker({
                                    dateFormat: "yy-m-dd",
                                    dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                                    minDate: 0,
                                    showOtherMonths: true,
                                    firstDay: 1,
									onSelect: function( selectedDate ) {
										jQuery( "#check_in_'.$room_types['post'][$i].'" ).datepicker( "option", "maxDate", selectedDate );
									},
                                    beforeShowDay: function(date){ 
                                        var string = jQuery.datepicker.formatDate("yy-mm-dd", date);
                                        return [ array.indexOf(string) == -1 ]
                                    }
                                });
                            });
                            </script>
                        </div>
                        <div class="room-col-4">
                            <div class="inner">
                                <a rel="leanModal" href="#modal_window_'.$room_types['post'][$i].'" class="btn-square popup" id="modal_window_link"><i class="icon-angle-right"></i> '.__('Book Now','tfuse').'</a>
                            </div>
                        </div>
                        <input type="hidden" id="tf_resrvation_room_title" value="'.get_the_title($room_types['post'][$i]).'" />
                        <input type="hidden" id="tf_resrvation_room_type" value="'.strtoupper($term->name).'" />
                        <input type="hidden" id="tf_resrvation_room_price" value="'.tfuse_page_options('room_price','',$room_types['post'][$i]).tfuse_options('default_currency').'" />
                        <input type="hidden" id="tf_resrvation_date_in" value="" />
                        <input type="hidden" id="tf_resrvation_date_out" value="" />';
                 if(!empty($reservation))
                    {
                        $output .='<div id="modal_window_'.$room_types['post'][$i].'"  class="modal_window_reservation" style="display: none;">
                                    <div class="inner">
                                        '.do_shortcode($shortcode_reservation).'
                                    </div>
                                </div>';
                    }
                  $output .='</li>';
                    
                $i++;
            }
            $output .= '</ul> 
                    </div>';
           
            
    return $output;
}
$forms_name=array(-1=>'Choose Form');
$forms_term = get_terms('reservations', array('hide_empty' => 0));
$forms=array();
foreach ($forms_term as $key => $form) {
    $forms[$form->term_id] = unserialize($form->description);
}
if(!empty($forms)){
    foreach($forms as $key=>$value){
        $forms_name[$key]=urldecode($value['form_name']);
    }
}
$atts = array(
    'name' => __('Room Reservation','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 4,
    'options' => array( 
        array(
            'name' => __('Reservation', 'tfuse'),
            'desc' => __('Select the form', 'tfuse'),
            'id' => 'tf_shc_room_types_reservation',
            'value' => '',
            'options' => $forms_name,
            'type' => 'select'
        ),
         array(
            'name' => __('Select Room','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_room_types_post',
            'value' => '',
            'options' => tfuse_list_rooms(),
            'properties' => array('class' => 'tf_shc_addable_0 tf_shc_addable'),
            'type' => 'select',
        ),
        array(
            'name' => __('Subtitle','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_room_types_subtitle',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_1 tf_shc_addable'),
            'type' => 'text',
        ),
        array(
            'name' => __('Description','tfuse'),
            'desc' => 'Short description',
            'id' => 'tf_shc_room_types_desc',
            'value' => '',
            'properties' => array('class' => 'tf_shc_addable_2 tf_shc_addable tf_shc_addable_last'),
            'type' => 'textarea',
        ),
    )
);

tf_add_shortcode('room_types', 'tfuse_room_types', $atts);


function tfuse_room_typ($atts, $content = null)
{
    global $room_types;
    extract(shortcode_atts(array('post'=>'','subtitle' => '','desc' => ''), $atts));
    $room_types['subtitle'][] = $subtitle;
    $room_types['post'][] = $post;
    $room_types['desc'][] = $desc;
}

$atts = array(
    'name' => __('Room Type','tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.','tfuse'),
    'category' => 3,
    'options' => array(
         array(
            'name' => __('Select Room','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_room_typ_post',
            'value' => '',
            'options' =>  tfuse_list_rooms(),
            'type' => 'select',
        ),
        array(
            'name' => __('Subtitle','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_room_typ_subtitle',
            'value' => '',
            'type' => 'text',
        ),
        array(
            'name' => __('Description','tfuse'),
            'desc' => '',
            'id' => 'tf_shc_room_typ_desc',
            'value' => '',
            'type' => 'textarea',
        )
    )
);

add_shortcode('room_typ', 'tfuse_room_typ', $atts);