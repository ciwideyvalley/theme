<?php
function tfuse_search_rooms($atts, $content = null)
{
    extract( shortcode_atts(array('title' => '','search' => ''), $atts) );
    
    $terms = get_terms('types');
    $result = array();
                
    if(!empty($terms))
        foreach ( $terms as $term ) { 
            $result[$term->slug] = $term->name;
        }
    $out = '<div class="reservation_bottom">
                <div class="col col-right">
                    <div class="reservation_form">
                        <form action="'.home_url( '/' ).'" method="get" id="reservation_form">
                            <div class="fields_wrap">
                                <h3>'.$title.'</h3>
                                <div class="row_field field_text">
                                    <label class="label_title">'.__('Check In','tfuse').'</label>
                                    <input type="text" name="check_in" value="" id="check_in">
                                    <span class="icon icon-calendar"></span>
                                </div>
                                <div class="row_field field_text">
                                    <label class="label_title">'.__('Check Out','tfuse').'</label>
                                    <input type="text" name="check_out" value="" id="check_out">
                                    <span class="icon icon-calendar"></span>
                                </div>
                                <div class="row_field input_styled">
                                </div>
                                <div class="row_divider"></div>
                                <div class="row_field field_select">
                                    <label class="label_title"><strong>'.__('Room Types','tfuse').':</strong></label>
                                    <select class="select_styled" name="types" style="width:225px">';
                                        $out .='<option value="all_rooms">'.__('All Types','tfuse').'</option>';
                                        if(!empty($result))
                                        {  
                                            foreach ($result as $key => $value) {
                                                $out .='<option value="'.$key.'">'.$value.'</option>';
                                            }
                                        }
                            $out .= '</select>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="row_field rowSubmit">
                                <input type="text" value="a" name="s" id="s" class="room_input_search" />
                                <button type="submit" id="room_search_submit">
                                    <span class="icon-stack">
                                    <i class="icon-circle icon-stack-base"></i>
                                    <i class="icon-search"></i></span> '.$search.'
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                jQuery(document).ready(function($) {
                    jQuery("#check_in").datepicker({
                        dateFormat: "yy-m-dd",
                        minDate: 0,
                        showOtherMonths: true,
                        firstDay: 1,
                        onSelect: function( selectedDate ) {
                            jQuery( "#check_out" ).datepicker( "option", "minDate", selectedDate );
                        },
                    });
                    jQuery("#check_out").datepicker({
                        dateFormat: "yy-m-dd",
                        minDate: 0,
                        showOtherMonths: true,
                        firstDay: 1,
                        onSelect: function( selectedDate ) {
                            jQuery( "#check_in" ).datepicker( "option", "maxDate", selectedDate );
                        },
                    });
                });
            </script>';
    
    
    return $out;
}

$atts = array(
    'name' => __('Search Rooms', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Shortcode Title','tfuse'),
            'id' => 'tf_shc_search_rooms_title',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('Search Label','tfuse'),
            'desc' => __('Search Label','tfuse'),
            'id' => 'tf_shc_search_rooms_search',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
    )
);

tf_add_shortcode('search_rooms', 'tfuse_search_rooms', $atts);
