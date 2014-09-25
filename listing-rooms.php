<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since ParadiseCove 1.0
 */
global $post;
$tags = tfuse_get_room_tags($post->ID);
$attachments = tfuse_get_gallery_images($post->ID,TF_THEME_PREFIX . '_room_gallery');
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
?>
<div class="room clearfix">
    <div class="room-descr">
        <h2><a href="<?php the_permalink(); ?>"><?php  tfuse_custom_title(); ?></a></h2>
        <div class="room-price"><?php echo tfuse_options('default_currency');?><?php echo tfuse_page_options('room_price');?>/<?php _e('night','tfuse');?></div>
        <div class="room-text">
            <?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?>
        </div>
        <?php if(!empty($tags)):?>
            <div class="amenities-list">
                <h3><?php _e('Room Amenities','tfuse'); ?></h3>
                <div class="icons_carousel">
                    <ul id="room<?php echo $post->ID;?>-amenities">
                        <?php foreach ($tags as $key => $value) { ?>
                        <li><img src="<?php echo tfuse_options('tag_icon',null,$key);?>" alt="" data-toggle="tooltip" title="<?php echo $value;?>"/></li>   
                         <?php }?>
                    </ul>
                    <a class="prev" href="#" id="room<?php echo $post->ID;?>-amenities_prev"><span class="icon icon-angle-left"></span></a>
                    <a class="next" href="#" id="room<?php echo $post->ID;?>-amenities_next"><span class="icon icon-angle-right"></span></a>
                </div>
                <script>
                    jQuery(document).ready(function($) {
                        jQuery('#room<?php echo $post->ID;?>-amenities').carouFredSel({
                            prev : "#room<?php echo $post->ID;?>-amenities_prev",
                            next : "#room<?php echo $post->ID;?>-amenities_next",
                            auto: false,
                            circular: false,
                            infinite: true,
                            width: '100%',
                            scroll: {
                                items : 1
                            }
                        });
                    });
                </script>
            </div>
        <?php endif;?>
    </div>
    <?php if(!empty($slider_images)):?>
            <div class="tf-gallery-wrap clearfix">
                <div class="tf-gallery" id="room<?php echo $post->ID;?>-gallery">
                    <div class="gallery-images">
                        <?php foreach($slider_images as $slider):?>
                            <div class="gallery-item">
                                <img src="<?php echo TF_GET_IMAGE::get_src_link($slider['img_full'],556,310);?>" alt=""/>
                            </div>
                        <?php endforeach;?>
                    </div>
                    <div class="gallery-thumbs">
                        <?php foreach($slider_images as $images):?>
                            <div class="thumb-item">
                                <img src="<?php echo TF_GET_IMAGE::get_src_link($images['img_full'],72,40);?>" alt=""/>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
                <a href="#" class="prev"><i class="icon-angle-left"></i></a>
                <a href="#" class="next"><i class="icon-angle-right"></i></a>
            </div>
    <?php else: $img_default = get_template_directory_uri().'/images/rooms_default.jpg'?>
        <div class="tf-gallery-wrap clearfix">
            <div class="tf-gallery" id="room<?php echo $post->ID;?>-gallery">
                <div class="gallery-images">
                    <img src="<?php echo TF_GET_IMAGE::get_src_link($img_default,558,395);?>" alt="" />
                </div>
            </div>
        </div>
    <?php endif;?>
</div>
<script>
    jQuery(document).ready(function($) {
        jQuery("#room<?php echo $post->ID;?>-gallery").tfGallery();
    });
</script>