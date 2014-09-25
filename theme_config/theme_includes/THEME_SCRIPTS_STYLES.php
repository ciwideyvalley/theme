<?php

add_action( 'wp_enqueue_scripts', 'tfuse_add_css' );
add_action( 'wp_enqueue_scripts', 'tfuse_add_js' );

if ( ! function_exists( 'tfuse_add_css' ) ) :
/**
 * This function include files of css.
 */
    function tfuse_add_css()
    {

        wp_register_style( 'bootstrap',  tfuse_get_file_uri('/css/bootstrap.css', false, '') );
        wp_enqueue_style( 'bootstrap' );

        wp_register_style( 'fonts', 'http://fonts.googleapis.com/css?family=Montserrat:400,700|Magra:400,700');
        wp_enqueue_style( 'fonts' );

        wp_register_style( 'font-awesome',  tfuse_get_file_uri('/css/font-awesome.css', false, '') );
        wp_enqueue_style( 'font-awesome' );
        
        wp_register_style( 'style', get_stylesheet_uri());
        wp_enqueue_style( 'style' );
        
        wp_register_style( 'screen', tfuse_get_file_uri('/screen.css'));
        wp_enqueue_style( 'screen' );
        
        wp_register_style( 'custom_admin',  tfuse_get_file_uri('/css/custom_admin.css', false, '') );
        wp_enqueue_style( 'custom_admin' );

        wp_register_style( 'prettyPhoto', TFUSE_ADMIN_CSS . '/prettyPhoto.css', false, '' );
        wp_enqueue_style( 'prettyPhoto' );
        
        wp_register_style( 'cusel',  tfuse_get_file_uri('/css/cusel.css', false, '') );
        wp_enqueue_style( 'cusel' );
        
        wp_register_style( 'shCore',  tfuse_get_file_uri('/css/shCore.css', true, '') );
        wp_enqueue_style( 'shCore' );
        
        wp_register_style( 'settings',  tfuse_get_file_uri('/rs-plugin/css/settings.css', true, '') );
        wp_enqueue_style( 'settings' );
        
        wp_register_style( 'shThemeDefault',  tfuse_get_file_uri('/css/shThemeDefault.css', true, '') );
        wp_enqueue_style( 'shThemeDefault' );
        
        wp_register_style( 'jquery-ui-1.10.3.custom',  tfuse_get_file_uri('/css/dark-theme/jquery-ui-1.10.3.custom.css', true, '') );
        wp_enqueue_style( 'jquery-ui-1.10.3.custom' );
    }
endif;


if ( ! function_exists( 'tfuse_add_js' ) ) :
/**
 * This function include files of javascript.
 */
    function tfuse_add_js()
    {

        wp_enqueue_script( 'jquery' );
        
        wp_register_script( 'modernizr', tfuse_get_file_uri('/js/libs/modernizr.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'modernizr' );
        
         wp_register_script( 'jquery-migrate', tfuse_get_file_uri('/js/libs/jquery-migrate.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery-migrate' );
		
        wp_register_script( 'respond', tfuse_get_file_uri('/js/libs/respond.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'respond' );	

        wp_register_script( 'jquery-ui.custom', tfuse_get_file_uri('/js/libs/jquery-ui.custom.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery-ui.custom' );
        
       wp_register_script( 'bootstrap', tfuse_get_file_uri('/js/libs/bootstrap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'bootstrap' ); 

        wp_register_script( 'general', tfuse_get_file_uri('/js/general.js'), array('jquery'), '', true );
        wp_enqueue_script( 'general' );
        
	wp_register_script( 'touchSwipe', tfuse_get_file_uri('/js/jquery.touchSwipe.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'touchSwipe' );
        
        wp_register_script( 'cusel-min',  tfuse_get_file_uri('/js/cusel-min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'cusel-min' );
        
        wp_register_script( 'jquery.themepunch.revolution',  tfuse_get_file_uri('/rs-plugin/js/jquery.themepunch.revolution.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.themepunch.revolution' );
        
      wp_register_script( 'hoverIntent',  tfuse_get_file_uri('/js/hoverIntent.js'), array('jquery'), '', true );
        wp_enqueue_script( 'hoverIntent' );
		
	wp_register_script( 'jquery.easing.min',  tfuse_get_file_uri('/js/jquery.easing.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.easing.min' );
        
	wp_register_script( 'jquery.icheck.min',  tfuse_get_file_uri('/js/jquery.icheck.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.icheck.min' );
        
        wp_register_script( 'jquery.jscrollpane.min',  tfuse_get_file_uri('/js/jquery.jscrollpane.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.jscrollpane.min' );
		
	wp_register_script( 'jquery.carouFredSel',  tfuse_get_file_uri('/js/jquery.carouFredSel.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.carouFredSel' );
        
        wp_register_script( 'jquery.placeholder.min',  tfuse_get_file_uri('/js/jquery.placeholder.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.placeholder.min' );
        
        wp_register_script( 'jquery.mousewheel',  tfuse_get_file_uri('/js/jquery.mousewheel.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.mousewheel' );
        
        wp_register_script( 'leanModal',  tfuse_get_file_uri('/js/jquery.leanModal.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'leanModal' );
        
        wp_register_script('maps.google.com', 'http://maps.google.com/maps/api/js?sensor=false', array('jquery'), '1.0', true);
        wp_enqueue_script('maps.google.com');
        
        wp_register_script( 'jquery.gmap.min',  tfuse_get_file_uri('/js/jquery.gmap.min.js'), array('jquery'), '', true );
        wp_enqueue_script( 'jquery.gmap.min' );
        
        wp_register_script( 'sliderTabs',  tfuse_get_file_uri('/js/sliderTabs.js'), array('jquery'), '', true );
        wp_enqueue_script( 'sliderTabs' );
        
        wp_register_script( 'prettyPhoto', TFUSE_ADMIN_JS . '/jquery.prettyPhoto.js', array('jquery'), '3.1.4', true );
        wp_enqueue_script( 'prettyPhoto' );
        
        // JS is include on the footer
        wp_register_script( 'shCore', tfuse_get_file_uri('/js/shCore.js'), array('jquery'), '', true );
        wp_enqueue_script( 'shCore' );
        
        wp_register_script( 'shBrushPlain', tfuse_get_file_uri('/js/shBrushPlain.js'), array('jquery'), '', true );
        wp_enqueue_script( 'shBrushPlain' );
        
        wp_register_script( 'sintaxHighlighter', tfuse_get_file_uri('/js/sintaxHighlighter.js'), array('jquery'), '', true );
        wp_enqueue_script( 'sintaxHighlighter' );

    }
endif;
