<?php
function tf_reservationform_shortcode($atts){
    global $TFUSE,$is_preview,$result,$post;
    $pluginfolder = home_url() . '/wp-includes/js/jquery/ui';
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-datepicker', $pluginfolder . '/jquery.ui.datepicker.min.js', array('jquery', 'jquery-ui-core') );
    wp_register_script( 'reservation_forms_js', get_template_directory_uri().'/js/reservation_frontend.js', array('jquery'), '1.1.0', true );
    wp_enqueue_script( 'reservation_forms_js' );
    wp_enqueue_script('jquery-form');
    
    wp_register_style( 'reservation_forms_css', get_template_directory_uri().'/theme_config/extensions/reservationform/static/css/reservation_form.css', true, '1.1.0' );
    wp_enqueue_style( 'reservation_forms_css' );
    extract(shortcode_atts(array('tf_rf_formid' => '-1','tf_rf_display'=>'','tf_rf_button'=>'','tf_rf_color'=>'',), $atts));
    $out= $html_in = $html_out = '';
	
	$room_post_id = rand(1, 100);

    if($tf_rf_display == 'popup')
    {
        $html_in = '<div id="reserv_id_'.$room_post_id.'" class="modal_window_reservation" style="display: none;">';
        $html_out = '</div>';
        
        $out .= '<span class="modal_window_popup"><a rel="leanModal" href="#reserv_id_'.$room_post_id.'" class="btn btn-default btn-lg" id="modal_window_reservation_post" style="background:'.$tf_rf_color.'">'.$tf_rf_button.'</a></span>';
        
        if($post->post_type == 'room')
            $result = tfuse_dates_interval();
    }
    
    $form_exists=false;
	$is_preview=false;
    if($tf_rf_formid!='-1'){
        $is_preview=false;
        $form = get_term_by('id',$tf_rf_formid,'reservations');
        $form_exists = (is_object($form) && count($form) > 0)?true :false;
        $form = unserialize($form->description);

    } elseif($TFUSE->request->isset_COOKIE('res_form_array')){
        $is_preview=true;
        $form_exists=true;
        $form = unserialize($TFUSE->request->COOKIE('res_form_array'));
        $TFUSE->request->COOKIE('form_array',null);
    }
    if($form_exists){
        $room_post_id = rand(1, 100);
        $out .= $html_in.'<div class="add-comment contact-form" id="reserv_id_'.$room_post_id.'"><div class="add-comment-title"><h3 id="header_message">'.urldecode($form['header_message']).'</h3></div>';
        $out .= '<div id="form_messages" class="submit_message" ></div>';
        $inputs = $TFUSE->get->ext_config('RESERVATIONFORM', 'base');
        $input_array = $inputs['input_types'];
        $out.='<div class="comment-form">
                <form id="reservationForm" action="" method="post" class="reservationForm" name="reservationForm">';
        $out.='<input id="this_form_id" type="hidden" value="'. $tf_rf_formid.'" />';
        $fields='';

        $fcount = 1;
        $linewidth = 0;
        $earr=array();
        $linenr = 1;
        $lines=array();
        $countForm = count($form['input']);
        $dimension=42;
        $lines[$linenr] = 0;
        foreach($form['input'] as $form_input_arr){

            $earr[$fcount]['width'] = $form_input_arr['width'];
            $linewidth += $form_input_arr['width'];
            if (isset($form_input_arr['newline'])) {
                $linewidth = $form_input_arr['width'];
                $earr[$fcount]['class'] = ' ';
                if ($fcount>1) {$linenr++;
                    $lines[$linenr] = 0;}
                $earr[$fcount]['line'] = $linenr;
                $lines[$linenr] += $dimension;
            }
            elseif ($linewidth>100) {
                $linewidth = $form_input_arr['width'];
                $linenr++;
                $lines[$linenr] = 0;
                $earr[($fcount-1)]['class'] = ' omega ';
                $earr[$fcount]['class'] = ' ';
                $earr[$fcount]['line'] = $linenr;

                $lines[$linenr] += $dimension;
            }
            elseif($linewidth==100) {
                $linewidth = 0;
                $earr[$fcount]['class'] = ' omega ';
                $earr[$fcount]['line'] = $linenr;
                $lines[$linenr] += $dimension;
                $linenr++;
                $lines[$linenr]=0;
            }
            else {
                $earr[$fcount]['class'] = ' ';
                $earr[$fcount]['line'] = $linenr;
                $lines[$linenr] += $dimension;
            }

            if ($countForm==$fcount && !isset($form_input_arr['newline'])) {
                $earr[$fcount]['class'] = ' omega ';
            }
            $fcount++;
        }


        $text_type=array();
        $email_type = array();
        foreach($input_array as $input){
            if($input['name'] == 'Text line'){
                $text_type = $input;
            }
            if($input['name'] == 'Email'){
                $email_type = $input;
            }
            if(!empty($text_type) && !empty($email_type)) break;
        }
        $input_array['date_in'] = $text_type;
        $input_array['date_out'] = $text_type;
        $input_array['res_email'] = $email_type;

        $linewidth = 0;
        $fcount = 1;
        $margin=20;
        foreach($form['input'] as $form_input){
            $field='';
            $input = array();
            if(isset($input_array[$form_input['type']]))
            $input=$input_array[$form_input['type']];
            if(isset($input['properties'])){
                $proprstr='';
                foreach($input['properties'] as $key=>$value){
                    $proprstr .=$key."=".$value." ";
                }
            }
            $floating=(isset($form_input['newline']) )?'clear:left;':' ';
            if (!isset($input['properties']['class']))
                $input['properties']['class'] = '';
            $input['properties']['class'] .=(isset($input['name']) && $input['name']=='Email')?' '.TF_THEME_PREFIX.'_email':'';
            $input['properties']['class'] .=(isset($form_input['required']))?' tf_rf_required_input ':'';
            $label_text =(isset($form_input['required']))?trim(urldecode($form_input['label'])).' '.urldecode($form['required_text']):trim(urldecode($form_input['label']));
            $input['id']=(isset($input['id']))?str_replace('%%name%%',urldecode($form_input['shortcode']),$input['id']):TF_THEME_PREFIX.'_'.urldecode($form_input['shortcode']);

            $form_input['classes'] = $earr[$fcount]['class'];
            $form_input['floating'] = $floating;
            $form_input['label_text'] = $label_text;
            $label='<label for="' .TF_THEME_PREFIX."_".trim(urldecode($form_input['shortcode'])). '">'.urldecode($label_text).'</label><br/>';


            if($is_preview)
                $sidebar_position = 'full';
            else
                $sidebar_position = tfuse_sidebar_position();

            $element_line = $earr[$fcount]['line'];

            if ($sidebar_position == 'full')
            {
                if($is_preview){
                    $ewidth=468-$lines[$element_line]+$margin;}
                else
                    $ewidth=468-$lines[$element_line]+$margin;
            }
            else {
                $ewidth=468-$lines[$element_line]+$margin;
            }

            if (isset($form_input['newline']) && $form_input['newline'] == 1){
                $linewidth = $form_input['width'];
            }
            else $linewidth += $form_input['width'];


            if ($form_input['width']==100)
            {
                $form_input['ewidthpx'] = $ewidth;
                $linewidth = 0;
            }
            elseif ($linewidth>100 )
            {
                $form_input['ewidthpx'] = (int)($ewidth*$form_input['width']/100);
                $linewidth = 0;
            }
            else
            {
                $form_input['ewidthpx'] = (int)($ewidth*$form_input['width']/100);
            }

            if($lines[$element_line]==$dimension && $form_input['width']>=40 && $form_input['width']<=90){
                $form_input['ewidthpx'] = (int)(($ewidth-$dimension)*$form_input['width']/100);
            }
            elseif($lines[$element_line]==$dimension && $form_input['width']<40 && $form_input['width']>32){
                $form_input['ewidthpx'] = (int)(($ewidth-2*$dimension)*$form_input['width']/100);
            }
            elseif($lines[$element_line]==$dimension && $form_input['width']<33){
                $form_input['ewidthpx'] = (int)(($ewidth-3*$dimension)*$form_input['width']/100);
            }

            if($is_preview && $input['type'] == 'select') $form_input['ewidthpx'] -=20;
            if($is_preview && $input['type'] == 'radio') $form_input['ewidthpx'] -=14;
            if($is_preview && $input['type'] == 'checkbox') $form_input['ewidthpx'] -=14;

            if ($is_preview && $input['type'] == 'text' && ($form_input['type']=='date_in' || $form_input['type']=='date_out') ) $form_input['ewidthpx'] +=20;

            $fcount++;
            if(in_array($form_input['type'],array('date_in','date_out')))
                $input['type'] = 'res_datepicker';
            elseif($form_input['type'] == 'res_email')
                $input['type'] = 'res_text';
            else $input['type'] = 'res_'.$input['type'];
            $input_field=$input['type']($input,$form_input);
            if($input['type']=='checkbox'){
                $tmp=$label;
                $label=$input_field;
                $input_field=$tmp;
            }
            $fields .=$input_field;

        }
        $out .= $fields;
        $surse=get_template_directory_uri().'/images/ajax-loader.gif';
        $out.='<div class="clear"></div><div class="row rowSubmit clearfix">';
        $out.='<button id="sending" class="btn btn-primary btn-lg btn-send2" style="display: none;">'.__('Sending ...','tfuse').'</button>
             <button type="submit" id="send_reservation" class="btn btn-primary btn-lg btn-submit2" name="submit" >'. urldecode($form['submit_mess']).'</button>
                 <a onclick="resetFields(this,event)" href="#" class="link-reset">'.__('Reset all fields','tfuse').'</a>
            <img id="sending_img" src="'.$surse.'" alt="Sending" style="margin-left:5px; margin-bottom:-5px; display: none; border:0;" /></div>
        </form>
        </div></div>';
        $out.='<div class="clear"></div><div class="notice">'.urldecode($form['tf_rf_form_notice']).'</div>'.$html_out;
       if(!empty($result))
        $out .='
            <script type="text/javascript">
                jQuery(document).ready(function($) {

                    var array = '.json_encode($result).'; 

                    jQuery("#reserv_id_'.$room_post_id.' .tfuse_rf_post_datepicker_in").datepicker({
                        dateFormat: "yy-m-dd",
                        dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                        minDate: 0,
                        showOtherMonths: true,
                        firstDay: 1,
                        beforeShowDay: function(date){ 
                            var string = jQuery.datepicker.formatDate("yy-mm-dd", date);
                            return [ array.indexOf(string) == -1 ]
                        }
                        
                     });
                    jQuery("#reserv_id_'.$room_post_id.' .tfuse_rf_post_datepicker_out").datepicker({
                        dateFormat: "yy-m-dd",
                        dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                        minDate: 0,
                        showOtherMonths: true,
                        firstDay: 1,
                        beforeShowDay: function(date){ 
                            var string = jQuery.datepicker.formatDate("yy-mm-dd", date);
                            return [ array.indexOf(string) == -1 ]
                        }
                    });
         });   </script>
        ';
    }
    else {
        $out="<p>This Form is not defined!!</p>";
    } 
    
    return $out;
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
    'name' => __('Reservation Form', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 9,
    'options' => array(
        array(
            'name' => __('Type', 'tfuse'),
            'desc' => __('Select the form', 'tfuse'),
            'id' => 'tf_rf_formid',
            'value' => '',
            'options' => $forms_name,
            'type' => 'select'
        ),
        array(
            'name' => __('Display Type', 'tfuse'),
            'desc' => __('Select display type', 'tfuse'),
            'id' => 'tf_rf_display',
            'value' => 'popup',
            'options' => array('simple' => 'Simple','popup' => 'In popup'),
            'type' => 'select'
        ),
        array(
            'name' => __('Button Title', 'tfuse'),
            'desc' => __('Button Title', 'tfuse'),
            'id' => 'tf_rf_button',
            'value' => '',
            'type' => 'text'
        ),
        array(
            'name' => __('Button Color', 'tfuse'),
            'desc' => __('Button Color', 'tfuse'),
            'id' => 'tf_rf_color',
            'value' => '',
            'type' => 'colorpicker'
        )
    )
);

tf_add_shortcode('tfuse_reservationform', 'tf_reservationform_shortcode', $atts);

function res_text($input,$form_input){
    return "<div class='row alignleft field_text ".$form_input['classes']."' style='".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'><strong>".__($form_input['label_text'],'tfuse')."</strong></label>
                <input type='text' style='width:".$form_input['ewidthpx']."px;' class='".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'. trim($form_input['shortcode'])."'/>
            </div>";
}
function res_textarea($input,$form_input){
    return "<div class='clear'></div><div class='row".$form_input['classes']."' style='".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'><strong>".__($form_input['label_text'],'tfuse')."</strong></label>
                <textarea  style='width:".$form_input['ewidthpx']."px;' class='".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'.trim($form_input['shortcode'])."' rows='10' ></textarea>
            </div>";
}

function res_radio($input,$form_input){
    $checked='checked="checked"';
    $output="<div class='row alignleft input_styled inlinelist ".$form_input['classes']."' style='width:".($form_input['ewidthpx']+22)."px;".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'>".__($form_input['label_text'],'tfuse')."</label>";

    if(is_array($form_input['options'])){
        foreach ($form_input['options'] as $key => $option) {
            $output .= '<div class=rowRadio"><input '.$checked.' id="' .TF_THEME_PREFIX.'_'. trim($form_input['shortcode']). '_'.$key.'"  type="radio" name="' .TF_THEME_PREFIX.'_'. trim($form_input['shortcode']). '"  value="' .$option. '" /><label class="radiolabel" for="' .TF_THEME_PREFIX.'_'. trim($form_input['shortcode']). '_'.$key.'">' . urldecode($option) . '</label></div>';
            $checked='';
        }
    }

    $output .= "</div>";
    
    return $output;
}
function res_datepicker($input,$form_input){
    $output = '';

    $datepickers_classes = array('date_in' => ' tfuse_rf_post_datepicker_in', 'date_out' => ' tfuse_rf_post_datepicker_out');
    $input['properties']['class'] .= $datepickers_classes[$form_input['type']];
    $input['properties']['class'] .=  ' tf_rf_required_input ';
    $output .="<div class='row alignleft field_text ".$form_input['classes']."' style='".$form_input['floating']."'>
                 <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'><strong>".__($form_input['label_text'],'tfuse')."</strong></label>
                <input style='width:".($form_input['ewidthpx']-20)."px;' type='text' class='".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'. trim($form_input['shortcode'])."'/>
                   <span class='icon icon-calendar'></span> 
</div>";
    return $output;
}
function res_checkbox($input,$form_input){
    $checked = ($input['value'] == 'true') ? 'checked="checked"' : '';
    $output = "<div class='row alignleft input_styled checklist ".$form_input['classes']."' style='width:".($form_input['ewidthpx']+22)."px;".$form_input['floating']."'>
                <div class='rowCheckbox'>
                    <label class='labelchecked' for='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "'>".__($form_input['label_text'],'tfuse')."</label>
                    <input class='".$input['properties']['class']."' style='width:15px;' type='checkbox' name='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "' id='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "' value='".$form_input['label']."'" . $checked . "/>
                </div>
            </div>";
    return $output;
}


function res_captcha($input,$form_input){
    $input['properties']['class']="tfuse_captcha_input";
    $out="<div class='row alignleft field_text' style='width:".$form_input['width']."%;".$form_input['floating']."'>
            <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'><strong>".__($form_input['label_text'],'tfuse')."</strong></label>
            <img  src='".TFUSE_EXT_URI."/contactform/library/".$input['file_name']."?form_id=".TF_THEME_PREFIX.'_'.trim($form_input['shortcode'])."&ver=".rand(0, 15)."' class='tfuse_captcha_img' >
            <input type='button' class='tfuse_captcha_reload' /><br />
            <input style='width:".$form_input['ewidthpx']."px;' id='".trim($input['id'])."' type='text' class='".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'.trim($form_input['shortcode'])."' />
         </div>";
    return $out;
}

function res_select($input,$form_input){
    $input['properties']['class'].=' tfuse_option';
    $out = "<div class='row field_select alignleft ".$form_input['classes']."'  >
                <label class='label_title' for='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "'>".__($form_input['label_text'],'tfuse')."</label>
                <select style='width:".($form_input['ewidthpx']+20)."px !important;' class='select_styled' name='" .TF_THEME_PREFIX."_".trim($form_input['shortcode']). "' >";
    if(is_array($form_input['options'])){
        foreach ($form_input['options'] as $key => $option) {
            $out .= "<option value='" . urldecode($option) . "'>";
            $out .= urldecode($option);
            $out .= "</option>\r\n";
        }
    }
   
    $out .= '</select></div>';
    return $out;
}

function res_room_type($input,$form_input){
    global $post,$is_preview; $value = '';
    if(!$is_preview)
    {
        if($post->post_type == 'room')
        {
            $type_id = tfuse_page_options('room_type','',$post->ID);
            $term = get_term($type_id,'types');
            $value = $term->name;
        }
    }
    return "<div class='row alignleft field_text ".$form_input['classes']."' style='".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'><strong>".__($form_input['label_text'],'tfuse')."</strong></label>
                <input type='text' style='width:".$form_input['ewidthpx']."px;opacity: 0.5;' class='tf_resrvation_room_type ".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'. trim($form_input['shortcode'])."' readonly='readonly'/>
            </div>";
}

function res_room($input,$form_input){
    global $post,$is_preview; $value = '';
    if(!$is_preview)
        $value = ($post->post_type == 'room') ? get_the_title($post->ID) : '';
    return "<div class='row alignleft field_text ".$form_input['classes']."' style='".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'><strong>".__($form_input['label_text'],'tfuse')."</strong></label>
                <input type='text' style='width:".$form_input['ewidthpx']."px;opacity: 0.5;' class='tf_resrvation_room_title ".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'. trim($form_input['shortcode'])."' readonly='readonly'/>
            </div>";
}

function res_room_price($input,$form_input){
    global $post,$is_preview; $value = '';
    if(!$is_preview)
    {
        $currency = tfuse_options('default_currency');
        $value = ($post->post_type == 'room') ? tfuse_page_options('room_price','',$post->ID).$currency : '';
    }
    return "<div class='row alignleft field_text ".$form_input['classes']."' style='".$form_input['floating']."'>
                <label class='label_title' for='" .TF_THEME_PREFIX.'_'.trim($form_input['shortcode']). "'><strong>".__($form_input['label_text'],'tfuse')."</strong></label>
                <input type='text' style='width:".$form_input['ewidthpx']."px;opacity: 0.5;' class='tf_resrvation_room_price ".$input['properties']['class']."' name='".TF_THEME_PREFIX.'_'. trim($form_input['shortcode'])."' readonly='readonly' />
            </div>";
}