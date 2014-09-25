<!-- middle tab-box -->
<div class="middle-tabs">
    <div class="container">
        <ul class="nav nav-tabs-icons clearfix active_bookmark3">
			<?php $s = 0; $active = array(); foreach ($slider['slides'] as $sliders): $s++;?>
					<?php if($sliders['slide_active'] == 'yes'):?>
						<?php $active[$s] = true; break;?>
					<?php endif;?>
			<?php endforeach;?>
            <?php $c = 0; foreach ($slider['slides'] as $slide): $c++;?>
                <?php if(isset($active[$c]) && $active[$c]):?>
                    <li class="active">
                        <a href="#midtab_<?php echo $c;?>" data-toggle="tab">
                            <i class="<?php echo $slide['slide_icon'];?>"></i><span><?php echo $slide['slide_title'];?></span>
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="#midtab_<?php echo $c;?>" data-toggle="tab">
                            <i class="<?php echo $slide['slide_icon'];?>"></i><span><?php echo $slide['slide_title'];?></span>
                        </a>
                    </li>
                <?php endif;?>
            <?php endforeach;?>
        </ul>

        <div class="tab-content clearfix">
            <!-- airport tab -->			
            <?php $count = 0; foreach ($slider['slides'] as $sliders): $count++;?>			
                <?php if(isset($active[$count]) && $active[$count]):?>
                    <div id="midtab_<?php echo $count;?>" class="clearfix tab-pane fade in active">
                <?php else: ?>
                    <div id="midtab_<?php echo $count;?>" class="clearfix tab-pane fade">
                <?php endif;?>
                    <?php if($sliders['slide_type'] == 'custom'):?>
                        <div class="midtab_left">
                            <?php if($sliders['slide_type_2'] == 'map'):?>
                                <?php
                                    $coords = explode(':', $sliders['slide_map']);
                                    $tmp_conf['post_coords']['lat']     = preg_replace('[^0-9\.]', '', $coords[0]);
                                    $tmp_conf['post_coords']['lng']     = preg_replace('[^0-9\.]', '', $coords[1]);
                                ?>
                                <div id="airport_map_<?php echo $count;?>" class="map"></div>
                                <script>
                                    jQuery(window).load(function() {
                                        jQuery("a[href='#midtab_<?php echo $count;?>']").on('shown.bs.tab', function(){
                                            jQuery("#airport_map_<?php echo $count;?>").gMap({
                                                markers: [{
                                                    latitude: <?php echo $tmp_conf['post_coords']['lat'];?>,
                                                    longitude: <?php echo $tmp_conf['post_coords']['lng']?>}],
                                                zoom: 12,
                                                title: "",
                                                popup: false,
                                                scrollwheel: false
                                            });
                                        });
										
										<?php if(isset($active[$count]) && $active[$count]):?>
											jQuery("#airport_map_<?php echo $count;?>").gMap({
													markers: [{
														latitude: <?php echo $tmp_conf['post_coords']['lat'];?>,
														longitude: <?php echo $tmp_conf['post_coords']['lng']?>}],
													zoom: 12,
													title: "",
													popup: false,
													scrollwheel: false
												});
										<?php endif;?>
                                    });
                                </script>
                            <?php else: ?>
                                <img src="<?php echo TF_GET_IMAGE::get_src_link($sliders['slide_image'],670,318);?>" alt="" class="midtab_img_left"/>
                            <?php endif;?>
                            <div class="midtab_info_left">
                                <?php echo apply_filters('themefuse_shortcodes', $sliders['slide_left']);?>
                            </div>
                        </div>
                        <div class="midtab_right">
                            <?php echo apply_filters('themefuse_shortcodes', $sliders['slide_right']);?>
                        </div>
                    <?php else: ?>
                        <div class="tf-gallery-wrap clearfix">
                            <div class="tf-gallery" id="g-<?php echo $count;?>">
                                <?php $images = $sliders['slide_gallery'];?>
                                <div class="gallery-images">
                                    <?php if(!empty($images)):?>
                                        <?php foreach($images as $img):?>
                                            <div class="gallery-item">
                                                <img src="<?php echo TF_GET_IMAGE::get_src_link($img['url'],670,435);?>" alt=""/>
                                                <div class="gallery-item-caption">
                                                    <h4><?php echo $img['title'];?></h4>
                                                    <?php echo $img['desc'];?>
                                                </div>
                                            </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </div>
                                
                                <div class="gallery-thumbs">
                                    <?php if(!empty($images)):?>
                                        <?php foreach($images as $thumb):?>
                                            <div class="thumb-item">
                                                <img src="<?php echo TF_GET_IMAGE::get_src_link($thumb['url'],128,83);?>" alt=""/>
                                            </div>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </div>

                            </div>

                            <div class="midtab_right">
                                <div class="fields_wrap">
                                    <div class="midtab_right_title">
                                        <h3><?php echo $sliders['slide_gallery_title'];?></h3>
                                    </div>
                                    <div class="midtab_right_text">
                                        <div class="gallery-text"></div>
                                    </div>
                                </div>
                                <div class="image-count"><?php _e('Image ','tfuse');?><span class="numb_active"></span><?php _e(' of ','tfuse');?><span class="numb_all"></span></div>
                                <div class="midtab_big_btn text-right">
                                    <a href="#" class="prev"><span class="icon-stack"><i class="icon-circle icon-stack-base"></i><i class="icon-angle-left"></i></span> <?php _e(' PREV','tfuse');?></a>
                                    <a href="#" class="next"><?php _e(' NEXT','tfuse');?><span class="icon-stack"><i class="icon-circle icon-stack-base"></i><i class="icon-angle-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                        <script>
                            jQuery(window).load(function() {
                                jQuery("a[href='#midtab_<?php echo $count;?>']").on('shown.bs.tab', function(){
                                    jQuery("#g-<?php echo $count;?>").tfGallery();
                                });
								
								<?php if(isset($active[$count]) && $active[$count]):?>
									jQuery("#g-<?php echo $count;?>").tfGallery();
								<?php endif;?>
                            });
                        </script>
                    <?php endif;?>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>
<!--/ middle tab-box -->
<?php $info = isset($slider['general']['slider_info']) ? $slider['general']['slider_info'] : '';?>
<?php if($info):?>
    <?php $time = isset($slider['general']['slider_time']) ? $slider['general']['slider_time'] : '';?>
    <?php $trip = isset($slider['general']['slider_tripadvisor_code']) ? $slider['general']['slider_tripadvisor_code'] : '';?>
    <div class="middle middle_white middle_pull_up">
        <div class="container">
            <div class="col-sm-3 col-md-3">
                <?php if($time):?> <?php $t = tfuse_show_local_titme();?>
                    <div class="local_time">
                        <?php if(!empty($t['local'])):?>
                            <?php echo _e('LOCAL TIME','tfuse');?>: <?php echo $t['local'];?><br>
                        <?php endif;?>
                        <?php if(!empty($t['sunset'])):?>
                            <?php echo _e('SUN SETS AT','tfuse');?> <?php echo $t['sunset'];?>
                        <?php endif;?>
                    </div>
                <?php endif;?>
            </div>
            <div class="col-sm-6 col-md-6 text-center">
                <?php if(!empty($slider['general']['slider_button'])):?>
                    <a href="<?php echo $slider['general']['slider_link'];?>" class="btn btn-primary btn-lg btn-wide"><?php echo $slider['general']['slider_button'];?></a>
                <?php endif;?>
            </div>
            <div class="col-sm-3 col-md-3">
                <?php if(!empty($trip)):?>
                    <div class="trip-advisor">
                        <?php echo $trip;?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
<?php endif; ?>
