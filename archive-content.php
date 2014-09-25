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
        <div class="content">
            <div class="postlist">
                <?php if (have_posts()) 
                 { $count = 0;
                     while (have_posts()) : the_post(); $count++;
                         get_template_part('listing', 'blog');
                     endwhile;
                 } 
                 else 
                 { ?>
                     <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
           <?php } ?>
            </div>
            <?php tfuse_shortcode_content('after1'); ?>
        </div>
        <?php if (($sidebar_position == 'right') || ($sidebar_position == 'left')) : ?>
            <div class="sidebar clearfix">
                <?php get_sidebar(); ?>
            </div><!--/ .sidebar -->
        <?php endif; ?>
    </div> 
</div><!--/ .middle -->
<?php  tfuse_pagination();?>
<?php  tfuse_shortcode_content('after'); ?>
<?php get_footer();?>