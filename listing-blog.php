<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since ParadiseCove 1.0
 */
 global $more,$post;
    $more = apply_filters('tfuse_more_tag',0);
?>
<div class="post-item clearfix">
    <div class="post-image"><?php echo tfuse_media($return=false,$type = 'blog');?></div>
    <div class="post-title">
        <h2><a href="<?php the_permalink(); ?>"><?php  tfuse_custom_title(); ?></a></h2>
    </div>
    <div class="clear"></div>
    <div class="post-meta-top">
        <span class="post-meta-cats"><?php _e('Posted in ','tfuse'); tfuse_get_categories_for_post($post->ID,'category');?></span>
        <a href="<?php comments_link(); ?>" class="link-comments"><?php comments_number("0 ".__('Comments','tfuse'), "1 ".__('Comment','tfuse'), "% ".__('Comments','tfuse')); ?></a>
    </div>
    <div class="post-descr entry">
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
         <?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?>
	 </div>
    </div>
    <div class="post-meta-bot">
        <span class="post-author"><?php _e('Written by','tfuse'); ?>: <span><?php echo get_the_author(); ?></span></span>
        <a href="<?php the_permalink(); ?>"><?php _e('READ THE BLOG POST','tfuse'); ?></a>
    </div>
</div>