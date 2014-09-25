<?php
function tfuse_weather($atts, $content = null)
{
    $out = $count = '';
    $coords = explode(':', tfuse_options('your_location'));
    $tmp_conf = array();
    
    if(!empty($coords))
        {
            $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
            $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);
            if(!empty($tmp_conf['post_coords']['lat']) || !empty($tmp_conf['post_coords']['lng']))
            {
                $info_celcius = @json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/forecast/daily?lat='.$tmp_conf['post_coords']['lat'].'&lon='.$tmp_conf['post_coords']['lng'].'&cnt=7&units=metric&mode=json'));
                if(!empty($info_celcius))
                {
 
                    $location = $info_celcius->city->name.', '.$info_celcius->city->country;

                    $out = '
                        <div class="weather_block clearfix">

                            <div class="wcol wcol-title">
                                <div class="wcol-head"></div>
                                <div class="wcol-mid"><strong>7 '.__('DAY FORECAST','tfuse').'</strong> <br><a href="" class="weather_switch"><span>'.__('SWITCH TO ','tfuse').'</span><span class="farenh">F&deg;</span></a></div>
                                <div class="wcol-bot"><span class="weather-location">'.$location.'</span></div>
                            </div>';

                            $week = array(
                                    1   => __('MON','tfuse'),
                                    2   => __('TUE','tfuse'),
                                    3   => __('WED','tfuse'),
                                    4   => __('THU','tfuse'),
                                    5   => __('FRI','tfuse'),
                                    6   => __('SAT','tfuse'),
                                    7   => __('SUN','tfuse'),
                                );

                            foreach ($info_celcius->list as $day) { $count++;
                                $days = date("N",$day->dt);

                                $weather_type = $day->weather[0]->main;
                                $weather_description = $day->weather[0]->description;
                                
                                if($weather_type == 'Rain' && ($weather_description == 'light rain' || $weather_description == 'moderate rain') )
                                {
                                    $img = 'weather_icon_6.png';
                                }
                                elseif($weather_type == 'Rain')
                                {
                                    $img = 'rain.png';
                                }
                                elseif($weather_type == 'Clouds' && $weather_description == 'few clouds')
                                {
                                    $img = 'weather_icon_1.png';
                                }
                                elseif($weather_type == 'Clouds')
                                {
                                    $img = 'clouds.png';
                                }
                                elseif($weather_type == 'Snow')
                                {
                                    $img = 'snow.png';
                                }
                                elseif($weather_type == 'Clear')
                                {
                                    $img = 'clear.png';
                                }
                                else
                                {
                                    $img = 'weather_icon_1.png';
                                }

                                foreach($week as $key => $val)
                                {
                                    if($key == $days) $d = $val;

                                    if($count == 1) $d = __('TODAY','tfuse');
                                }

                                $out .='<div class="wcol wcol-'.$count.'">
                                    <div class="wcol-head">'.$d.'</div>
                                    <div class="wcol-mid">
                                        <img src="'.get_template_directory_uri().'/images/icons/'.$img.'" alt=""/>
                                    </div>
                                    <div class="wcol-bot"><span class="show_degrees">'.$day->temp->day.'</span><span class="days_degrees">&deg;C</span></div>
                                </div>';
                            }

                        $out .='</div>';
                }
            }
    }
    
    return $out;
}

$atts = array(
    'name' => __('Weather', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 11,
    'options' => array(
        
    )
);

tf_add_shortcode('weather', 'tfuse_weather', $atts);
