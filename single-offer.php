<?php get_header(); ?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php  tfuse_shortcode_content('before'); ?>
<?php if ($sidebar_position == 'left') : ?>
    <div class="middle cols2 blog sidebar_left" style="background:<?php echo tfuse_middle_background();?>">
<?php endif;?>
<?php if ($sidebar_position == 'right') : ?>
    <div class="middle cols2 blog" style="background:<?php echo tfuse_middle_background();?>">
<?php endif;?>
<?php if ($sidebar_position == 'full') : ?>
    <div class="middle full_width blog" style="background:<?php echo tfuse_middle_background();?>">
<?php endif; ?> 
    <div class="container">
        <div class="content tf_room_types_reservations">
            <article class="postlist post-detail">  
                <?php  while ( have_posts() ) : the_post();?>
                        <?php get_template_part('content','single-offer');?>
                        
                <?php endwhile; // end of the loop. ?> 
                <?php if ( tfuse_page_options('disable_comments',tfuse_options('disable_posts_comments')) ) : ?>
                   <?php  tfuse_comments(); ?>
                <?php endif; ?>
            </article>
            <?php tfuse_shortcode_content('after1'); ?>
        </div>
        <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
            <div class="sidebar clearfix">
                <?php get_sidebar(); ?>
            </div>
        <?php endif; ?>
    </div> 
</div><!--/ .middle -->
<?php tfuse_shortcode_content('after'); ?>
<?php get_footer();?>