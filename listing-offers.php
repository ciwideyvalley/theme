<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since ParadiseCove 1.0
 */
 global $more;
    $more = apply_filters('tfuse_more_tag',0);
?>
<div class="block-item">
    <h2><?php echo strtoupper(tfuse_custom_offers_title()); ?></h2>
    <div class="subtitle"><?php echo tfuse_page_options('offer_subtitle');?></div>
    <div class="block-image"><?php echo tfuse_media($return=false,$type = 'offer');?></div>
    <div class="block-aside">
        <?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?>
    </div>
    <div class="block-meta">
        <a href="<?php the_permalink(); ?>"><?php _e('FIND OUT MORE','tfuse'); ?></a>
    </div>
</div>