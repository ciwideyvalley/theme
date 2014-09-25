<?php  get_header();?>
<?php $sidebar_position = tfuse_sidebar_position(); ?>
<?php  tfuse_shortcode_content('before'); ?>
<?php if ($sidebar_position == 'left') : ?>
    <div class="middle middle_white cols2 noblog sidebar_left" style="background:<?php echo tfuse_middle_background();?>">
<?php endif;?>
<?php if ($sidebar_position == 'right') : ?>
    <div class="middle middle_white noblog cols2" style="background:<?php echo tfuse_middle_background();?>">
<?php endif;?>
<?php if ($sidebar_position == 'full') : ?>
    <div class="middle middle_white noblog full_width" style="background:<?php echo tfuse_middle_background();?>">
<?php endif; ?> 
    <div class="container">
        <div class="content">
            <article class="post-detail">
                <div class="entry clearfix">
                    <h1><?php _e('Page 404','tfuse');?></h1>
                    <p><?php _e('Page not found', 'tfuse') ?></p>
                    <p><?php _e('The page you were looking for doesn&rsquo;t seem to exist', 'tfuse') ?>.</p>
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
<?php  tfuse_shortcode_content('after'); ?>
<?php get_footer();?>