<?php 
if (!function_exists('tfuse_rewrite_worpress_reading_options')):

    /**
     *
     *
     * To override tfuse_rewrite_worpress_reading_options() in a child theme, add your own tfuse_rewrite_worpress_reading_options()
     * to your child theme's file.
     */

    add_action('tfuse_admin_save_options','tfuse_rewrite_worpress_reading_options', 10, 1);

    function tfuse_rewrite_worpress_reading_options ($options)
    {
        if($options[TF_THEME_PREFIX . '_homepage_category'] == 'page')
        {
            update_option('show_on_front', 'page');
            update_option('page_on_front', intval($options[TF_THEME_PREFIX . '_home_page']));
        }
        else
        {
            update_option('show_on_front', 'posts');
            update_option('page_on_front', 0);
        }
    }
endif;


if (!function_exists('tfuse_ajax_get_rating')) :
    function tfuse_ajax_get_rating(){  
        if(is_singular('room')) die();
        
        $id = (intval($_POST['id'])); 
        $parent = $_POST['parent']; 
        $current = ($_POST['current']); 
        $rating_array = tfuse_object_to_array(json_decode(stripslashes($_POST['rating_array'])));
        
        $values = $rating_array;
        
            foreach ($values as  $key =>$value) {
                if($parent == $key)
                { 
                    $sum = $current + $value['val'];
                    $values[$key]['val'] = $sum;
                    $values[$key]['count'] = ++$value['count'];
                }

            tf_update_post_meta( $id, TF_THEME_PREFIX . '_rating', $values);
        }
        
        $rsp = $values;
        echo json_encode($rsp);
        die();
    }
    add_action('wp_ajax_tfuse_ajax_get_rating','tfuse_ajax_get_rating');
    add_action('wp_ajax_nopriv_tfuse_ajax_get_rating','tfuse_ajax_get_rating');
endif;

if (!function_exists('tfuse_object_to_array')) :
    function tfuse_object_to_array($data)
    {
        if (is_array($data) || is_object($data))
        {
            $result = array();
            foreach ($data as $key => $value)
            {
                $result[$key] = tfuse_object_to_array($value);
            }
            return $result;
        }
        return $data;
    }
endif;


if (!function_exists('tfuse_ajax_room_reservation')) :
    function tfuse_ajax_room_reservation(){  
        
        $id = (intval($_POST['id'])); 
        $email = $_POST['email']; 
        $phone = ($_POST['phone']); 
        $date_in = $_POST['date_in']; 
        $date_out = ($_POST['date_out']); 
        
        $the_blogname   = esc_attr(get_bloginfo('name'))." - ".$email;
        $admin_email = get_option('admin_email');
        $send_options   = get_option(TF_THEME_PREFIX . '_tfuse_contact_form_general');
        //get post title
        $title = get_the_title($id);
        //get type category info
        $term_id = tfuse_page_options('room_type','',$id);
        $term = get_term_by( 'id', $term_id, 'types');
        //get room price
        $price = tfuse_options('default_currency').tfuse_page_options('room_price','',$id);
        //get subject from framework
        $subject = tfuse_options('room_reservation_subject');
        
        //get template
        $template = tfuse_options('room_reservation_template');
        
        $tags = array("[room]", "[type]", "[price]", "[date_from]" ,"[date_to]" , "[email]", "[phone]");
        $values   = array($title, $term->name, $price, $date_in, $date_out, $email, $phone);
        
        //raplace values
        $template = str_replace($tags, $values , $template);
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        if(!empty($send_options))
        {
            if ($send_options['mail_type'] == 'wpmail')
            {
                if(wp_mail($admin_email, __('From : ','tfuse') . $the_blogname, $template,$headers))
                    echo 'true';
                else
                    echo 'false';

                die();
            }
            elseif($send_options['mail_type'] == 'smtp')
            {
                require_once ABSPATH . WPINC . '/class-phpmailer.php';
                require_once ABSPATH . WPINC . '/class-smtp.php';
                $phpmailer = new PHPMailer();
                $phpmailer->isSMTP();
                $phpmailer->IsHTML(true);
                $phpmailer->Port = $send_options['smtp_port'];
                $phpmailer->Host = $send_options['smtp_host'];
                $phpmailer->SMTPAuth = true;
                $phpmailer->SMTPDebug = false;
                $phpmailer->SMTPSecure = ($send_options['secure_conn'] != 'no') ? $send_options['secure_conn'] : null;
                $phpmailer->Username = $send_options['smtp_user'];
                $phpmailer->Password = $send_options['smtp_pwd'];
                $phpmailer->From   = $admin_email;
                $phpmailer->FromName   = $admin_email;
                $phpmailer->Subject    = $subject;
                $phpmailer->Body       = $template;
                $phpmailer->AltBody    = __('To view the message, please use an HTML compatible email viewer!','tfuse');
                $phpmailer->WordWrap   = 50;
                $phpmailer->MsgHTML($template);
                $phpmailer->AddAddress($admin_email);

                if(!$phpmailer->Send()) {
                    echo "false" . $phpmailer->ErrorInfo;
                } else {
                    echo "true";
                }
                die();
            }
            else
            {
                if(wp_mail($admin_email, $subject , $template))
                {
                    echo 'true';
                    die();
                }
                else
                {
                    echo 'false';
                    die();
                }
            }
        }
        else
        {
            echo 'false';
            die();
        }
    }
    add_action('wp_ajax_tfuse_ajax_room_reservation','tfuse_ajax_room_reservation');
    add_action('wp_ajax_nopriv_tfuse_ajax_room_reservation','tfuse_ajax_room_reservation');
endif;


if (!function_exists('tfuse_ajax_switch_degree')) :
    function tfuse_ajax_switch_degree(){  
        $celsius = $_POST['celsius'];
        $count = 0;
        $coords = explode(':', tfuse_options('your_location'));
        $tmp_conf = $all_days = array();
        
        if(!empty($coords))
        {
            $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
            $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);
            if(!empty($tmp_conf['post_coords']['lat']) || !empty($tmp_conf['post_coords']['lng']))
            {
				$info_celcius = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/forecast/daily?lat='.$tmp_conf['post_coords']['lat'].'&lon='.$tmp_conf['post_coords']['lng'].'&cnt=7&units=metric&mode=json'));
				
                if($celsius == 'true')
                {
                    foreach ($info_celcius->list as $day) { $count++;
						$all_days[] = $day->temp->day;
					}
                }
                else
                {
					foreach ($info_celcius->list as $day) { $count++;
						$all_days[] = ($day->temp->day *  9/5) + 32;
					}
                }
                
                
            }
        }
        
        $rsp = $all_days;
        echo json_encode($rsp);
        die();
    }
    add_action('wp_ajax_tfuse_ajax_switch_degree','tfuse_ajax_switch_degree');
    add_action('wp_ajax_nopriv_tfuse_ajax_switch_degree','tfuse_ajax_switch_degree');
endif;

if (!function_exists('tfuse_add_post_to_types')){
    function tfuse_add_post_to_types($post_id){
        if (!tf_is_real_post_save($post_id)) {
            return;
        }
        $term = tfuse_page_options('room_type','',$post_id);
        
        if(!empty($term))
        {
            wp_set_post_terms( $post_id,array($term),'types' );
        }
    }
    add_action('save_post', 'tfuse_add_post_to_types', 10,2 );
}

if(!function_exists('tf_is_real_post_save')){
    /**
     * This function is used in 'post_updated' action
     *
     * @param $post_id
     * @return bool
     */
    function tf_is_real_post_save($post_id)
    {
        return !(
            wp_is_post_revision($post_id)
                || wp_is_post_autosave($post_id)
                || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                || (defined('DOING_AJAX') && DOING_AJAX)
        );
    }
}