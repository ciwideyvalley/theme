<?php $bg = isset($slider['general']['slider_bg']) ? $slider['general']['slider_bg'] : '';?>
<div class="top_slider" style="background: url(<?php echo $bg; ?>);">
    <!-- slider boxed w tabs -->
    <div class="top_slider_tabs">
        <div class="top_slider_content" id="top_slider2">
            <?php foreach ($slider['slides'] as $slide):?>
                <div class="slide" title="<?php echo $slide['slide_title'];?>"><img src="<?php echo $slide['slide_src'];?>" alt=""></div>
            <?php endforeach;?>
        </div>
        <div class="top_slider_navi">
            <div class="inner" id="top_slider_pag"></div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
            jQuery("#top_slider2").carouFredSel({
                circular	: true,
                infinite	: false,
                auto 		: false,
                items       : 1,
                scroll      : {
                    fx: "crossfade"
                },
                responsive: true,
                height: "auto",
                pagination: {
                    container: '#top_slider_pag',
                    anchorBuilder: function() {
                        return '<a href="#">'+ this.title +'</a>';
                    }
                }
            });
        });
    </script>
    <!--/ slider boxed w tabs -->
</div>
<!--/ slider -->