<?php 
global $is_tf_blog_page,$post;
$id_post = $post->ID; 
if(tfuse_options('blog_page') != 0 && $id_post == tfuse_options('blog_page')) $is_tf_blog_page = true;
get_header();
if ($is_tf_blog_page) die(); 
?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php  tfuse_shortcode_content('before'); ?>
<?php if ($sidebar_position == 'left') : ?>
    <div class="middle cols2 noblog sidebar_left" style="background:<?php echo tfuse_middle_background();?>">
<?php endif;?>
<?php if ($sidebar_position == 'right') : ?>
    <div class="middle noblog cols2" style="background:<?php echo tfuse_middle_background();?>">
<?php endif;?>
<?php if ($sidebar_position == 'full') : ?>
    <div class="middle noblog full_width" style="background:<?php echo tfuse_middle_background();?>">
<?php endif; ?> 
    <div class="container ">
        <div class="content tf_room_types_reservations">
            <article class="post-detail">
                <?php tfuse_page_custom_title();?>
                <div class="entry clearfix">
                    <?php  while ( have_posts() ) : the_post();?>
                        <?php the_content(); ?>
                    <?php break; endwhile; // end of the loop. ?>
                </div>
            </article>
            <?php tfuse_comments(); ?>
            <?php tfuse_shortcode_content('after1'); ?>
        </div>
        <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
            <div class="sidebar">
                <?php get_sidebar(); ?>
            </div><!--/ .sidebar -->
        <?php endif; ?>
    </div> 
</div><!--/ .middle -->
<?php tfuse_shortcode_content('after'); ?>
<?php get_footer();?>