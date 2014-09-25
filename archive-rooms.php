<?php get_header();?>
<?php  tfuse_shortcode_content('before'); ?>
<div class="middle" style="background:<?php echo tfuse_middle_background();?>">
    <div class="container">
        <div class="room_list">
            <?php if (have_posts()) 
             { $count = 0;
                 while (have_posts()) : the_post(); $count++;
                     get_template_part('listing', 'rooms');
                 endwhile;
             } 
             else 
             { ?>
                 <h5><?php _e('Sorry, no posts matched your criteria.', 'tfuse'); ?></h5>
       <?php } ?>
        </div>
        <?php tfuse_shortcode_content('after1'); ?>
    </div> 
</div><!--/ .middle -->
<?php  tfuse_pagination();?>
<?php  tfuse_shortcode_content('after'); ?>
<?php get_footer();?>