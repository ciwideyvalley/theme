<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since ParadiseCove 1.0
 */
global $post;
?>
<div class="post-item clearfix">
    <div class="post-image"><?php echo tfuse_media($return=false,$type = 'blog');?></div>
    <div class="post-title">
        <h1><?php tfuse_custom_title();?></h1>
    </div>
    <div class="clear"></div>
    <div class="post-meta-top">
        <?php if ( tfuse_page_options('disable_meta')  ) : ?>
            <span class="post-meta-cats"><?php _e('Posted in ','tfuse'); tfuse_get_categories_for_post($post->ID,'');?></span>
        <?php endif;?>
        <?php if ( tfuse_page_options('disable_comments',tfuse_options('disable_posts_comments'))  ) : ?>
            <a href="#comments" class="link-comments anchor"><?php comments_number("0 ".__('Comments','tfuse'), "1 ".__('Comment','tfuse'), "% ".__('Comments','tfuse')); ?></a>
        <?php endif;?>
    </div>
    <div class="clear"></div>
    <div class="post-descr entry">
        <?php the_content(); ?> 
		<div class="clear"></div>
		<?php wp_link_pages(); ?>
    </div>
    <?php if ( tfuse_page_options('disable_author_info',tfuse_options('disable_author_info')) ) : ?>
        <div class="post-meta-bot">
            <span class="post-author"><?php _e('Written by','tfuse'); ?>: <span><?php echo get_the_author(); ?></span></span>
        </div>
    <?php endif;?>
</div>

<?php if ( tfuse_page_options('disable_author_info',tfuse_options('disable_author_info')) ) : ?>
    <?php get_template_part('content','author');?>
<?php endif; ?>