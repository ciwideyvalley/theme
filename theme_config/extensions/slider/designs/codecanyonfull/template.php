<div class="top_slider">
    <!-- slider fullwidth -->
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <ul>
                <?php foreach ($slider['slides'] as $slide):?>
                    <?php 
                        $slide_1 = isset($slide['slide_advanced_animation_1']) ? $slide['slide_advanced_animation_1'] : false;
                        $slide_2 = isset($slide['slide_advanced_animation_2']) ? $slide['slide_advanced_animation_2'] : false;
                        $slide_3 = isset($slide['slide_advanced_animation_3']) ? $slide['slide_advanced_animation_3'] : false;
                    ?>
                    <li data-transition="<?php echo $slide['slide_transition'];?>" data-slotamount="7" data-masterspeed="300">
                        <img src="<?php echo $slide['slide_src'];?>" alt="">
                        <?php if($slide_1):?>
                            <div class="caption <?php echo $slide['slide_animation1'];?> <?php echo $slide['slide_outanimation1'];?> <?php echo $slide['slide_type1'];?>"
                                 data-x="<?php echo $slide['slide_pos1x'];?>"
                                 data-y="<?php echo $slide['slide_pos1y'];?>"
                                 data-speed="<?php echo $slide['slide_speed1'];?>"
                                 data-start="<?php echo $slide['slide_start1'];?>"
                                 data-easing="easeOutExpo" data-end="<?php echo $slide['slide_end1'];?>" data-endspeed="300" data-endeasing="easeInSine"><?php echo $slide['slide_title1'];?></div>
                        <?php else:?>
                            <div class="caption sft stt cap_small_white"
                             data-x="440"
                             data-y="430"
                             data-speed="600"
                             data-start="500"
                             data-easing="easeOutExpo" data-end="5000" data-endspeed="300" data-endeasing="easeInSine"><?php echo $slide['slide_title1'];?></div>
                        <?php endif;?>
                        <?php if($slide_2):?>
                            <div class="caption <?php echo $slide['slide_animation2'];?> <?php echo $slide['slide_outanimation2'];?> <?php echo $slide['slide_type2'];?>"
                                 data-x="<?php echo $slide['slide_pos2x'];?>"
                                 data-y="<?php echo $slide['slide_pos2y'];?>"
                                 data-speed="<?php echo $slide['slide_speed2'];?>"
                                 data-start="<?php echo $slide['slide_start2'];?>"
                                 data-easing="easeOutExpo" data-end="<?php echo $slide['slide_end2'];?>" data-endspeed="300" data-endeasing="easeInSine"><?php echo $slide['slide_title2'];?></div>
                        <?php else:?>
                            <div class="caption fade fade cap_big_white"
                             data-x="260"
                             data-y="480"
                             data-speed="800"
                             data-start="1300"
                             data-easing="easeOutExpo" data-end="6000" data-endspeed="300" data-endeasing="easeInSine"><?php echo $slide['slide_title2'];?></div>
                        <?php endif;?>
                        <?php if($slide_3):?>
                            <div class="caption <?php echo $slide['slide_animation3'];?> <?php echo $slide['slide_outanimation3'];?> <?php echo $slide['slide_type3'];?>"
                                 data-x="<?php echo $slide['slide_pos3x'];?>"
                                 data-y="<?php echo $slide['slide_pos3y'];?>"
                                 data-speed="<?php echo $slide['slide_speed3'];?>"
                                 data-start="<?php echo $slide['slide_start3'];?>"
                                 data-easing="easeOutExpo" data-end="<?php echo $slide['slide_end3'];?>" data-endspeed="300" data-endeasing="easeInSine"><?php echo $slide['slide_title3'];?></div>
                        <?php else:?>
                            <div class="caption sfb stb cap_small_white"
                             data-x="400"
                             data-y="540"
                             data-speed="600"
                             data-start="2000"
                             data-easing="easeOutExpo" data-end="5000" data-endspeed="300" data-endeasing="easeInSine"><?php echo $slide['slide_title3'];?></div>
                        <?php endif;?>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
    <script type="text/javascript">
        var tpj=jQuery;
        tpj.noConflict();
        tpj(document).ready(function() {

            if (tpj.fn.cssOriginal!=undefined)
                tpj.fn.css = tpj.fn.cssOriginal;
            tpj('.fullwidthbanner').revolution(
                    {
                        delay:6000,
                        startwidth:990,
                        startheight:675,
                        onHoverStop:"on",						// Stop Banner Timet at Hover on Slide on/off
                        thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                        thumbHeight:50,
                        thumbAmount:3,
                        hideThumbs:0,
                        navigationType:"none",				// bullet, thumb, none
                        navigationArrows:"solo",				// nexttobullets, solo (old name verticalcentered), none
                        navigationStyle:"round",				// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom
                        navigationHAlign:"center",				// Vertical Align top,center,bottom
                        navigationVAlign:"center",					// Horizontal Align left,center,right
                        navigationHOffset:0,
                        navigationVOffset:20,
                        soloArrowLeftHalign:"left",
                        soloArrowLeftValign:"center",
                        soloArrowLeftHOffset:20,
                        soloArrowLeftVOffset:0,
                        soloArrowRightHalign:"right",
                        soloArrowRightValign:"center",
                        soloArrowRightHOffset:20,
                        soloArrowRightVOffset:0,
                        touchenabled:"on",						// Enable Swipe Function : on/off
                        stopAtSlide:-1,							// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
                        stopAfterLoops:-1,						// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic
                        hideCaptionAtLimit:0,					// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
                        hideAllCaptionAtLilmit:0,				// Hide all The Captions if Width of Browser is less then this value
                        hideSliderAtLimit:0,					// Hide the whole slider, and stop also functions if Width of Browser is less than this value
                        fullWidth:"on",
                        shadow:0								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows -  (No Shadow in Fullwidth Version !)
                    });
        });
    </script>
    <!--/ slider fullwidth -->
</div>
<!--/ slider -->