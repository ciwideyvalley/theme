<?php
/*
Template Name: Page Full
*/
global $is_tf_blog_page,$post;
$id_post = $post->ID; 
if(tfuse_options('blog_page') != 0 && $id_post == tfuse_options('blog_page')) $is_tf_blog_page = true;
get_header();
if ($is_tf_blog_page) die(); 
?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php  tfuse_shortcode_content('before'); ?>
<?php if ($sidebar_position == 'left') : ?>
<div class="middle cols2 sidebar_left" style="background:<?php echo tfuse_middle_background();?>">
<?php endif;?>
<?php if ($sidebar_position == 'right') : ?>
    <div class="middle blog cols2" style="background:<?php echo tfuse_middle_background();?>">
<?php endif;?>
<?php if ($sidebar_position == 'full') : ?>
    <div class="middle" style="background:<?php echo tfuse_middle_background();?>">
<?php endif; ?> 
    <div class="container tf_room_types_reservations">
        <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
            <div class="content">
                <article class="postlist post-detail">
                    <div class="post-descr entry">
        <?php endif; ?>
            <div class="post-title"><?php tfuse_page_custom_title();?></div>
            <?php  while ( have_posts() ) : the_post();?>
                <?php the_content(); ?>
            <?php break; endwhile; // end of the loop. ?>
            <?php tfuse_comments(); ?>
        <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
                    </div>
                </article>
        <?php endif; ?>
        <?php tfuse_shortcode_content('after1'); ?>
        <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
            </div>
            
            <div class="sidebar">
                <?php get_sidebar(); ?>
            </div><!--/ .sidebar -->
        <?php endif; ?>
    </div> 
</div><!--/ .middle -->
<?php tfuse_shortcode_content('after'); ?>
<?php get_footer();?>