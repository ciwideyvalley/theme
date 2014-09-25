<?php
/**
 * The template for displaying content in the single.php template.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since ParadiseCove 1.0
 */
global $post; $count = 0;
$slider_images = tfuse_gallery_attachment($post->ID,'amenity_gallery');
$countat = tfuse_count_attachment($post->ID,'amenity_gallery');
?>
<div class="post-item clearfix">
    <div class="block-meta">
        <?php
        if(!empty($slider_images)): static $d = 0;
            $hasmain = tfuse_hasmain_attachment($countat,$post->ID,'amenity_gallery');
            foreach($slider_images as $slider): $count++;
                if( $slider['main'] == 'yes'){  $d++; ?>
                    <a href="<?php echo $slider['img_full'];?>"  data-rel="prettyPhoto[<?php echo $post->ID ?>]" title="<?php tfuse_custom_title(); ?>">
                        <img src="<?php echo TF_GET_IMAGE::get_src_link($slider['img_full'],620,320);?>" alt="">
                    </a> 
                <?php 
                }
               else{ 
                    if($hasmain == 'yes') {?>
                        <a href="<?php echo $slider['img_full'];?>" data-rel="prettyPhoto[<?php echo $post->ID ?>]"></a>
                       <?php continue;                      
                    }  
                    $d++;
                    if($d == 1)
                    { ?>
                     <a href="<?php echo $slider['img_full'];?>" data-rel="prettyPhoto[<?php echo $post->ID ?>]">
                     <img src="<?php echo TF_GET_IMAGE::get_src_link($slider['img_full'],620,320);?>" alt="">
                     </a>
                    <?php continue;
                    }  ?>
                        <span class="hidden">
                            <a href="<?php echo $slider['img_full'];?>"  data-rel="prettyPhoto[<?php echo $post->ID ?>]" title="<?php tfuse_custom_title(); ?>">
                                <img src="<?php echo $slider['img_full'];?>" alt="">
                            </a>
                        </span>
            <?php }
            endforeach;
        endif;?>
    </div>
    <div class="post-title">
        <h1><?php tfuse_custom_title();?></h1>
    </div>
    <div class="post-meta-top">
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