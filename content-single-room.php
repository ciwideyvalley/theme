<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since ParadiseCove 1.0
 */
global $post;     
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

$term_id = tfuse_page_options('room_type');
$term = get_term_by( 'id', $term_id, 'types');
?>
<div class="post-detail room-detail">
    <h1><?php tfuse_custom_title();?></h1>
    <div class="room-price"><?php echo tfuse_options('default_currency');?><?php echo tfuse_page_options('room_price');?>/<?php _e('night','tfuse');?></div>
    <div class='rating' id='room-<?php echo $post->ID;?>-rating'>
        <strong><?php _e('Your rating','tfuse');?>:</strong> 
        <span class='star' rel='1'></span>
        <span class='star' rel='2'></span>
        <span class='star' rel='3'></span>
        <span class='star' rel='4'></span>
        <span class='star' rel='5'></span>
    </div>
    <div class="entry">
        <?php echo tfuse_page_options('room_desc');?>
        <!-- room gallery -->
        <?php if(!empty($slider_images)):?>
            <div class="room clearfix">
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
                <script>
                    jQuery(document).ready(function($) {
                        jQuery("#room<?php echo $post->ID;?>-gallery").tfGallery();
                    });
                </script>
            </div>
        <?php endif;?>
        <?php the_content(); ?>
		<div class="clear"></div>
		<?php wp_link_pages(); ?>
        <input type="hidden" id="tf_resrvation_room_title" value="<?php echo get_the_title()?>" />
        <input type="hidden" id="tf_resrvation_room_type" value="<?php echo strtoupper($term->name)?>" />
        <input type="hidden" id="tf_resrvation_room_price" value="<?php echo tfuse_page_options('room_price').tfuse_options('default_currency');?>" />
    </div>
</div>