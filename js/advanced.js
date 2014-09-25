jQuery(document).ready(function($) {
    
    jQuery('.over_thumb ').bind('click', function(){
 
       window.setTimeout(function(){
           var sel = jQuery('#slider_design_type').val(); 
           if(sel == 'tabs' || sel == 'codecanyon' || sel == 'codecanyonfull'){
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option>');            }
           else
            {
                jQuery('#slider_type').html('<option value="">Choose your slider type</option><option value="custom">Manually, I\'ll upload the images myself</option>');
            }
               
       },12);
    });
  
  if(!$('#paradise-cove_enable_footer_newsletter').is(':checked')){
        jQuery('.paradise-cove_footer_news_title,.paradise-cove_enable_footer_newsletter_socials,.paradise-cove_footer_newsletter_facebook,.paradise-cove_footer_newsletter_twitter,.paradise-cove_footer_newsletter_google,.paradise-cove_footer_newsletter_pinterest').hide();
        }
            $('#paradise-cove_enable_footer_newsletter').live('change',function () {
            if(!jQuery(this).is(':checked'))
            {
                jQuery('.paradise-cove_footer_news_title,.paradise-cove_enable_footer_newsletter_socials,.paradise-cove_footer_newsletter_facebook,.paradise-cove_footer_newsletter_twitter,.paradise-cove_footer_newsletter_google,.paradise-cove_footer_newsletter_pinterest').hide();
            }
            else
            {
                jQuery('.paradise-cove_footer_news_title,.paradise-cove_enable_footer_newsletter_socials,.paradise-cove_footer_newsletter_facebook,.paradise-cove_footer_newsletter_twitter,.paradise-cove_footer_newsletter_google,.paradise-cove_footer_newsletter_pinterest').show();
            }
        });
        
        
    jQuery('#slide_advanced_animation_1').live('change',function () {
        if(!jQuery(this).siblings('.tf_checkbox_switch').hasClass('on')){
            jQuery('.slide_animation1,.slide_outanimation1,.slide_type1,.slide_pos1x,.slide_pos1y,.slide_speed1,.slide_start1,.slide_end1').hide();
        }
        else{
            jQuery('.slide_animation1,.slide_outanimation1,.slide_type1,.slide_pos1x,.slide_pos1y,.slide_speed1,.slide_start1,.slide_end1').show();
        }
    });
    
    jQuery('#slide_advanced_animation_2').live('change',function () {
        if(!jQuery(this).siblings('.tf_checkbox_switch').hasClass('on')){
            jQuery('.slide_animation2,.slide_outanimation2,.slide_type2,.slide_pos2x,.slide_pos2y,.slide_speed2,.slide_start2,.slide_end2').hide();
        }
        else{
            jQuery('.slide_animation2,.slide_outanimation2,.slide_type2,.slide_pos2x,.slide_pos2y,.slide_speed2,.slide_start2,.slide_end2').show();
        }
    });
    
    jQuery('#slide_advanced_animation_3').live('change',function () {
        if(!jQuery(this).siblings('.tf_checkbox_switch').hasClass('on')){
            jQuery('.slide_animation3,.slide_outanimation3,.slide_type3,.slide_pos3x,.slide_pos3y,.slide_speed3,.slide_start3,.slide_end3').hide();
        }
        else{
            jQuery('.slide_animation3,.slide_outanimation3,.slide_type3,.slide_pos3x,.slide_pos3y,.slide_speed3,.slide_start3,.slide_end3').show();
        }
    });
        
    
   jQuery(document).on('click','.image_frame',function(){
        if(jQuery(this).data('settings').slide_advanced_animation_1 == 'false'){
            jQuery('.slide_animation1,.slide_outanimation1,.slide_type1,.slide_pos1x,.slide_pos1y,.slide_speed1,.slide_start1,.slide_end1').hide();
        }
        else{
            jQuery('.slide_animation1,.slide_outanimation1,.slide_type1,.slide_pos1x,.slide_pos1y,.slide_speed1,.slide_start1,.slide_end1').show();
        }
   });
    
        
    if(!$('#slider_info').is(':checked')){
        jQuery('.slider_time,.slider_tripadvisor,.slider_tripadvisor,.slider_button,.slider_link').hide();
        }
            $('#slider_info').live('change',function () {
            if(!jQuery(this).is(':checked'))
            {
                jQuery('.slider_time,.slider_tripadvisor,.slider_tripadvisor,.slider_button,.slider_link').hide();
            }
            else
            {
                jQuery('.slider_time,.slider_tripadvisor,.slider_tripadvisor,.slider_button,.slider_link').show();
            }
        });


    jQuery('.tfbtq_shopping_add_row').click(function(){
        setTimeout(function (){
            jQuery('.div-table-td input.tfuse_option:text').removeClass('hasDatepicker');
            jQuery('.div-table-td input.tfuse_option:text').datepicker();
            },200);
    });

    jQuery('.tf-post-table').parent('.formcontainer').css('margin-top','10px');
    

jQuery('.tfuse_selectable_code').live('click', function () {
        var r = document.createRange();
        var w = jQuery(this).get(0);
        r.selectNodeContents(w);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(r);
    });

  

    function getUrlVars() {
        urlParams = {};
        var e,
            a = /\+/g,
            r = /([^&=]+)=?([^&]*)/g,
            d = function (s) {
                return decodeURIComponent(s.replace(a, " "));
            },
            q = window.location.search.substring(1);
        while (e = r.exec(q))
            urlParams[d(e[1])] = d(e[2]);
        return urlParams;
    }
	 $("#slider_slideSpeed,#slider_play,#slider_pause,#paradise-cove_map_zoom").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

    jQuery('#paradise-cove_map_lat,#paradise-cove_map_long').keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 190 || event.keyCode == 110|| event.keyCode == 189 || event.keyCode == 109 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

    $('#paradise-cove_framework_options_metabox .handlediv, #paradise-cove_framework_options_metabox .hndle').hide();
    $('#paradise-cove_framework_options_metabox .handlediv, #paradise-cove_framework_options_metabox .hndle').hide();

    var options = new Array();
    
    options['slide_type'] = jQuery('#slide_type').val();
    jQuery('#slide_type').bind('change', function() {
        options['slide_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['slide_type_2'] = jQuery('#slide_type_2').val();
    jQuery('#slide_type_2').bind('change', function() {
        options['slide_type_2'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
 
    
    options['paradise-cove_header_type'] = jQuery('#paradise-cove_header_type').val();
    jQuery('#paradise-cove_header_type').bind('change', function() {
        options['paradise-cove_header_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    
    options['paradise-cove_homepage_category'] = jQuery('#paradise-cove_homepage_category').val();
    jQuery('#paradise-cove_homepage_category').bind('change', function() {
        options['paradise-cove_homepage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

   
    options['paradise-cove_header_element'] = jQuery('#paradise-cove_header_element').val();
    jQuery('#paradise-cove_header_element').bind('change', function() {
        options['paradise-cove_header_element'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['paradise-cove_header_element_404'] = jQuery('#paradise-cove_header_element_404').val();
    jQuery('#paradise-cove_header_element_404').bind('change', function() {
        options['paradise-cove_header_element_404'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['paradise-cove_header_element_search'] = jQuery('#paradise-cove_header_element_search').val();
    jQuery('#paradise-cove_header_element_search').bind('change', function() {
        options['paradise-cove_header_element_search'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['paradise-cove_page_title'] = jQuery('#paradise-cove_page_title').val();
    jQuery('#paradise-cove_page_title').bind('change', function() {
        options['paradise-cove_page_title'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    options['slider_hoverPause'] = jQuery('#slider_hoverPause').val();
    jQuery('#slider_hoverPause').bind('change', function() {
       if (jQuery(this).next('.tf_checkbox_switch').hasClass('on'))  options['slider_hoverPause']= true;
        else  options['slider_hoverPause'] = false;
        tfuse_toggle_options(options);
    });

    options['map_type'] = jQuery('#paradise-cove_map_type').val();
    jQuery(' #paradise-cove_map_type').bind('change', function() {
        options['map_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    //blog page
    options['paradise-cove_blogpage_category'] = jQuery('#paradise-cove_blogpage_category').val();
     jQuery('#paradise-cove_blogpage_category').bind('change', function() {
         options['paradise-cove_blogpage_category'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });

     options['paradise-cove_header_element_blog'] = jQuery('#paradise-cove_header_element_blog').val();
     jQuery('#paradise-cove_header_element_blog').bind('change', function() {
         options['paradise-cove_header_element_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     options['paradise-cove_before_content_element_blog'] = jQuery('#paradise-cove_before_content_element_blog').val();
     jQuery('#paradise-cove_before_content_element_blog').bind('change', function() {
         options['paradise-cove_before_content_element_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
      options['paradise-cove_content_element'] = jQuery('#paradise-cove_content_element').val();
     jQuery('#paradise-cove_content_element').bind('change', function() {
         options['paradise-cove_content_element'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['paradise-cove_header_bottom'] = jQuery('#paradise-cove_header_bottom').val();
     jQuery('#paradise-cove_header_bottom').bind('change', function() {
         options['paradise-cove_header_bottom'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['paradise-cove_header_bottom_404'] = jQuery('#paradise-cove_header_bottom_404').val();
     jQuery('#paradise-cove_header_bottom_404').bind('change', function() {
         options['paradise-cove_header_bottom_404'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['paradise-cove_header_bottom_search'] = jQuery('#paradise-cove_header_bottom_search').val();
     jQuery('#paradise-cove_header_bottom_search').bind('change', function() {
         options['paradise-cove_header_bottom_search'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['paradise-cove_header_bottom_blog'] = jQuery('#paradise-cove_header_bottom_blog').val();
     jQuery('#paradise-cove_header_bottom_blog').bind('change', function() {
         options['paradise-cove_header_bottom_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
	
     
     options['posts_select_type'] = jQuery('#posts_select_type').val();
     jQuery('#posts_select_type').bind('change', function() {
         options['posts_select_type'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['paradise-cove_content_element_blog'] = jQuery('#paradise-cove_content_element_blog').val();
     jQuery('#paradise-cove_content_element_blog').bind('change', function() {
         options['paradise-cove_content_element_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
    tfuse_toggle_options(options);

    function tfuse_toggle_options(options)
    {

        jQuery('#paradise-cove_page_map_search,#paradise-cove_select_slider_search,#paradise-cove_page_map_404,#paradise-cove_select_slider_404,#paradise-cove_select_slider_bottom_404,#paradise-cove_select_slider_bottom_search,#paradise-cove_select_slider_bottom,#paradise-cove_select_slider_bottom_blog,#paradise-cove_page_map_blog,#paradise-cove_page_map_home,#paradise-cove_page_map,#paradise-cove_use_page_options,#paradise-cove_select_slider_blog,#paradise-cove_select_slider,#paradise-cove_home_page,#paradise-cove_categories_select_categ,#paradise-cove_slide_image,.homepage_category_header_element').parents('.option-inner').hide();
        jQuery('#paradise-cove_page_map_search,#paradise-cove_select_slider_search,#paradise-cove_page_map_404,#paradise-cove_select_slider_404,#paradise-cove_select_slider_bottom_404,#paradise-cove_select_slider_bottom_search,#paradise-cove_select_slider_bottom,#paradise-cove_select_slider_bottom_blog,#paradise-cove_page_map_blog,#paradise-cove_page_map_home,#paradise-cove_page_map,#paradise-cove_use_page_options,#paradise-cove_select_slider_blog,#paradise-cove_select_slider,#paradise-cove_home_page,#paradise-cove_categories_select_categ,#paradise-cove_slide_image,.homepage_category_header_element').parents('.form-field').hide();        

        /*--------------------------------------------------*/
        if(options['slide_type']=='gallery'){ 
            jQuery('.slide_gallery_title,.slide_gallery').show(); 
            jQuery('.slide_type_2,.slide_right,.slide_image,.slide_left,.slide_map').hide();
        }
        else
        {
            jQuery('.slide_type_2,.slide_custom_title,.slide_right,.slide_left').show();
            jQuery('.slide_gallery_title,.slide_gallery').hide(); 
            
            if(options['slide_type_2']=='image'){
                jQuery('.slide_image').show();
                jQuery('.slide_map').hide();
            }
            else
            {
                jQuery('.slide_map').show();
                jQuery('.slide_image').hide();
            }
        }
        
        //header bottom
        if(options['paradise-cove_header_bottom_404']=='slider'){ 
            jQuery('#paradise-cove_select_slider_bottom_404').parents('.option-inner').show();
            jQuery('#paradise-cove_select_slider_bottom_404').parents('.form-field').show();
        }
        
        if(options['paradise-cove_header_bottom_search']=='slider'){ 
            jQuery('#paradise-cove_select_slider_bottom_search').parents('.option-inner').show();
            jQuery('#paradise-cove_select_slider_bottom_search').parents('.form-field').show();
        }
        
       if(options['paradise-cove_header_bottom']=='slider'){ 
            jQuery('#paradise-cove_select_slider_bottom').parents('.option-inner').show();
            jQuery('#paradise-cove_select_slider_bottom').parents('.form-field').show();
        }

        if(options['paradise-cove_header_bottom_blog']=='slider'){
            jQuery('#paradise-cove_select_slider_bottom_blog').parents('.option-inner').show();
            jQuery('#paradise-cove_select_slider_bottom_blog').parents('.form-field').show();
        }

        //homepage
       if(options['paradise-cove_homepage_category']=='specific'){
            jQuery('.paradise-cove_display_type_home').show();
            jQuery('.paradise-cove_categories_select_categ').next().show();
            jQuery('#paradise-cove_categories_select_categ').parents('.option-inner').show();
            jQuery('#paradise-cove_categories_select_categ').parents('.form-field').show();
           
            if($('#paradise-cove_use_page_options').is(':checked')) 
                jQuery('#paradise-cove_header_element,#paradise-cove_content_color_home').closest('.postbox').removeAttr('style');
        }
        else if (options['paradise-cove_homepage_category']=='all')
        {
            jQuery('.paradise-cove_display_type_home').show();
            jQuery('.paradise-cove_categories_select_categ').next().show();
            if($('#paradise-cove_use_page_options').is(':checked')) 
                jQuery('#paradise-cove_header_element,#paradise-cove_content_color_home').closest('.postbox').removeAttr('style');
        }
        else if(options['paradise-cove_homepage_category']=='page'){
            jQuery('#paradise-cove_home_page,#paradise-cove_use_page_options').parents('.option-inner').show();
            jQuery('#paradise-cove_home_page,#paradise-cove_use_page_options').parents('.form-field').show();
            jQuery('.paradise-cove_categories_select_categ').next().hide();
            //use page options
            if($('#paradise-cove_use_page_options').is(':checked')) jQuery('#paradise-cove_header_element,#paradise-cove_content_color_home').closest('.postbox').hide();
            $('#paradise-cove_use_page_options').live('change',function () {
            if(jQuery(this).is(':checked'))
                    jQuery('#paradise-cove_header_element,#paradise-cove_content_color_home').closest('.postbox').hide();
            else
                    jQuery('#paradise-cove_header_element,#paradise-cove_content_color_home').closest('.postbox').show();
            });
        } 
        
        /*header element*/
        
        if (options['paradise-cove_header_element_404'] == 'slider')
        { 
            jQuery('#paradise-cove_select_slider_404').parents('.option-inner').show();
            jQuery('#paradise-cove_select_slider_404').parents('.form-field').show();
        }
        else if (options['paradise-cove_header_element_404'] == 'map')
        { 
            jQuery('#paradise-cove_page_map_404').parents('.option-inner').show();
            jQuery('#paradise-cove_page_map_404').parents('.form-field').show();
        }
        
        if (options['paradise-cove_header_element_search'] == 'slider')
        { 
            jQuery('#paradise-cove_select_slider_search').parents('.option-inner').show();
            jQuery('#paradise-cove_select_slider_search').parents('.form-field').show();
        }
        else if (options['paradise-cove_header_element_search'] == 'map')
        { 
            jQuery('#paradise-cove_page_map_search').parents('.option-inner').show();
            jQuery('#paradise-cove_page_map_search').parents('.form-field').show();
        }
        
        if (options['paradise-cove_header_element'] == 'slider')
        { 
            jQuery('#paradise-cove_select_slider').parents('.option-inner').show();
            jQuery('#paradise-cove_select_slider').parents('.form-field').show();
        }
        else if (options['paradise-cove_header_element'] == 'map')
        { 
            jQuery('#paradise-cove_page_map').parents('.option-inner').show();
            jQuery('#paradise-cove_page_map').parents('.form-field').show();
        }
        
        //header elements for blog page
        if (options['paradise-cove_header_element_blog'] == 'slider')
        { 
            jQuery('#paradise-cove_select_slider_blog').parents('.option-inner').show();
            jQuery('#paradise-cove_select_slider_blog').parents('.form-field').show();
        }
        else if (options['paradise-cove_header_element_blog'] == 'map')
        { 
            jQuery('#paradise-cove_page_map_blog').parents('.option-inner').show();
            jQuery('#paradise-cove_page_map_blog').parents('.form-field').show();
        }
        //blog page
        if(options['paradise-cove_blogpage_category']=='all'){
            jQuery('.paradise-cove_categories_select_categ_blog').hide();
        }
        else if(options['paradise-cove_blogpage_category']=='specific'){
            jQuery('.paradise-cove_categories_select_categ_blog').show();
        } 
        
        
       //header 
        var homepage = true;
        if (jQuery('.homepage_category_header_element').length == 1) homepage = false;
        if ( options['paradise-cove_homepage_category'] == 'tfuse_blog_posts' || options['paradise-cove_homepage_category'] == 'tfuse_blog_cases')
        {
            homepage = true;
            jQuery('.homepage_category_header_element').parents('.option-inner').show();
            jQuery('.homepage_category_header_element').parents('.form-field').show();
        }
        
        //hide page title
        if(options['paradise-cove_page_title'] == 'custom_title')
        { 
            jQuery('#paradise-cove_custom_title').parents('.option-inner').show();
            jQuery('#paradise-cove_custom_title').parents('.form-field').show();
        }
		else
        { 
            jQuery('#paradise-cove_custom_title').parents('.option-inner').hide();
            jQuery('#paradise-cove_custom_title').parents('.form-field').hide();
        }
        //slider
        if (options['slider_hoverPause'])
        {
            jQuery('.slider_pause').show();
            jQuery('.slider_pause').next('.tfclear').show();
        }
        else
        {
            jQuery('.slider_pause').hide();
            jQuery('.slider_pause').next('.tfclear').hide();
        }
    }
});

jQuery(window).load(function() {
var options1 = new Array();
jQuery('#slider_frames li').live('click', function(){
        options1['slide_type'] = jQuery('#slide_type').val();
        options1['slide_type_2'] = jQuery('#slide_type_2').val();
        tfuse_toggle_options2(options1);
    });
    
    function tfuse_toggle_options2(options1)
    {
        
        console.log(options1['slide_type']);
        if(options1['slide_type']=='gallery'){ 
            jQuery('.slide_gallery_title,.slide_gallery').show(); 
            jQuery('.slide_type_2,.slide_right,.slide_image,.slide_left,.slide_map').hide();
        }
        else
        {
            jQuery('.slide_type_2,.slide_custom_title,.slide_right,.slide_left').show();
            jQuery('.slide_gallery_title,.slide_gallery').hide(); 
            
            if(options1['slide_type_2']=='image'){
                jQuery('.slide_image').show();
                jQuery('.slide_map').hide();
            }
            else
            {
                jQuery('.slide_map').show();
                jQuery('.slide_image').hide();
            }
        }
    }
});