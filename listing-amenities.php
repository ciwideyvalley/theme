<?php
/**
 * The template for displaying posts on archive pages.
 * To override this template in a child theme, copy this file 
 * to your child theme's folder.
 *
 * @since ParadiseCove 1.0
 */
global $post; $count  = 0;
$slider_images = tfuse_gallery_attachment($post->ID,'amenity_gallery');
$countat = tfuse_count_attachment($post->ID,'amenity_gallery');
?>
<div class="block-item">
    <div class="block-image"><?php echo tfuse_media($return=false,$type = 'amenity');?></div>
    <div class="block-aside">
        <h2 class="amenity_title"><a href="<?php the_permalink(); ?>"><?php  tfuse_custom_title(); ?></a></h2>
        <?php if ( tfuse_options('post_content') == 'content' ) the_content(''); else the_excerpt(); ?>
    </div>
    <div class="block-meta">
        <?php
        if(!empty($slider_images)):  static $d = 0;
            $hasmain = tfuse_hasmain_attachment($countat,$post->ID,'amenity_gallery');
            foreach($slider_images as $slider): $count++;
                if( $slider['main'] == 'yes'){ $d++;?>
                    <a href="<?php echo $slider['img_full'];?>"  data-rel="prettyPhoto[<?php echo $post->ID ?>]" title="<?php tfuse_custom_title(); ?>">
                       <?php _e('VIEW IMAGE GALLERY','tfuse'); ?>
                    </a> 
                <?php 
                }
                else{ $d++;                    
                    if($hasmain == 'yes') { ?>
                       <span class="hidden">
                            <a href="<?php echo $slider['img_full'];?>"  data-rel="prettyPhoto[<?php echo $post->ID ?>]" title="<?php tfuse_custom_title(); ?>">
                                <img src="<?php echo $slider['img_full'];?>" alt="">
                            </a>
                        </span>
                       <?php continue;                      
                    }  
                    if($d == 1)
                    { ?>
                     <a href="<?php echo $slider['img_full'];?>" data-rel="prettyPhoto[<?php echo $post->ID ?>]"><?php _e('VIEW IMAGE GALLERY','tfuse'); ?></a>
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
</div>