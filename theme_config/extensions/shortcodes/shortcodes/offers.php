<?php
function tfuse_offers($atts, $content = null)
{
    extract( shortcode_atts(array('cat' => '','img' => '', 'title' => ''), $atts) );
    
    $out = '';
    
    if($cat != 0)
    {
        $term = get_term_by( 'id', $cat, 'offers');
        $args = array(
            'posts_per_page' => -1,
                'tax_query' => array(
                        array(
                            'taxonomy' => 'offers',
                            'field' => 'id',
                            'terms' => $cat
                        )
                )
        );
        $query = new WP_Query($args);
        $posts = $query->posts; 
        
        if(!empty($posts))
        {
            $out .= '<div class="block-item">
                    <div class="block-image">
                        <img src="'.TF_GET_IMAGE::get_src_link($img,300,280).'" alt=""/>
                        <div class="block-caption"><h2>'.$title.'</h2></div>
                    </div>
                    <div class="block-aside">
                        <div class="offer-slider">
                            <ul id="offers">';
                                foreach ($posts as $post) { 
                                    $out .='<li class="offer-slide">
                                                <h3><span>'.__('Special Offer','tfuse').': </span>
                                                    <a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>
                                                </h3>
                                                <p>'.strip_tags(tfuse_shorten_string(apply_filters('the_content',$post->post_content),23)).'</p>
                                            </li>';
                                }
                           $out .='</ul>
                            <div class="slider-navi">
                                <div class="pag" id="offers_pag"></div>
                                <a href="#" class="prev" id="offers_prev"><span class="icon icon-angle-left"></span></a>
                                <a href="#" class="next" id="offers_next"><span class="icon icon-angle-right"></span></a>
                            </div>
                        </div>
                        <script>
                            jQuery(document).ready(function($) {
                                jQuery("#offers").carouFredSel({
                                    circular	: true,
                                    infinite	: false,
                                    auto 		: false,
                                    items       : 1,
                                    responsive: true,
                                    prev : "#offers_prev",
                                    next : "#offers_next",
                                    pagination : "#offers_pag"
                                });
                            });
                        </script>
                    </div>
                    <div class="block-meta">
                        <a href="'.get_term_link( $term, 'offers' ).'">'.__('VIEW DETAILS','tfuse').'</a>
                    </div>
                </div>';
        }
    }
    return $out;
}

$atts = array(
    'name' => __('Offers', 'tfuse'),
    'desc' => __('Here comes some lorem ipsum description for the box shortcode.', 'tfuse'),
    'category' => 11,
    'options' => array(
        array(
            'name' => __('Select Category','tfuse'),
            'desc' => 'Select Offer Category',
            'id' => 'tf_shc_offers_cat',
            'value' => '',
            'options' =>  tfuse_list_offers(),
            'type' => 'select',
            'divider'=> true
        ),
        array(
            'name' => __('Title','tfuse'),
            'desc' => __('Shortcode Title','tfuse'),
            'id' => 'tf_shc_offers_title',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
        array(
            'name' => __('Image','tfuse'),
            'desc' => __('Shortcode Image','tfuse'),
            'id' => 'tf_shc_offers_img',
            'value' => '',
            'type' => 'text',
            'divider' => true
        ),
    )
);

tf_add_shortcode('offers', 'tfuse_offers', $atts);
