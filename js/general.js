var $ = jQuery;
// Topmenu <ul> replace to <select>
function responsive(mainNavigation) {
	var $ = jQuery;
	var screenRes = $('.body_wrap').width();
	
	if ($('.topmenu select').length == 0) {			  
		/* Replace unordered list with a "select" element to be populated with options, and create a variable to select our new empty option menu */
		$('.topmenu').append('<select class="select_styled" id="topm-select" style="display:none;"></select>');
		var selectMenu = $('#topm-select');

		/* Navigate our nav clone for information needed to populate options */
		$(mainNavigation).children('div').children('ul').children('li').each(function () {

			/* Get top-level link and text */
			var href = $(this).children('a').attr('href');
			var text = $(this).children('a').text();

			/* Append this option to our "select" */
			if ($(this).is(".current-menu-item") && href != '#') {
				$(selectMenu).append('<option value="' + href + '" selected>' + text + '</option>');
			} else if (href == '#') {
				$(selectMenu).append('<option value="' + href + '" disabled="disabled">' + text + '</option>');
			} else {
				$(selectMenu).append('<option value="' + href + '">' + text + '</option>');
			}

			/* Check for "children" and navigate for more options if they exist */
			if ($(this).children('ul').length > 0) {
				$(this).children('ul').children('li').not(".mega-nav-widget").each(function () {

					/* Get child-level link and text */
					var href2 = $(this).children('a').attr('href');
					var text2 = $(this).children('a').text();

					/* Append this option to our "select" */
					if ($(this).is(".current-menu-item") && href2 != '#') {
						$(selectMenu).append('<option value="'+href2+'" selected> - '+text2+'</option>');
					} else if (href2 == '#') {
						$(selectMenu).append('<option value="'+href2+'" disabled="disabled"> - '+text2+'</option>');
					} else {
						$(selectMenu).append('<option value="'+href2+'"> - '+text2+'</option>');
					}

					/* Check for "children" and navigate for more options if they exist */
					if ($(this).children('ul').length > 0) {
						$(this).children('ul').children('li').each(function () {

							/* Get child-level link and text */
							var href3 = $(this).children('a').attr('href');
							var text3 = $(this).children('a').text();

							/* Append this option to our "select" */
							if ($(this).is(".current-menu-item")) {
								$(selectMenu).append('<option value="' + href3 + '" class="select-current" selected> -- ' + text3 + '</option>');
							} else {
								$(selectMenu).append('<option value="' + href3 + '"> -- ' + text3 + '</option>');
							}

						});
					}
				});
			}
		});
	}
	if(screenRes >= 750){
        $('.topmenu select:first').hide();
        $('.topmenu ul:first').show();      
    }else{
        $('.topmenu ul:first').hide();
        $('.topmenu select:first').show();             
    }

	/* When our select menu is changed, change the window location to match the value of the selected option. */
	$(selectMenu).change(function () {
		location = this.options[this.selectedIndex].value;
	});

    // mega dropdown menu
    $('.dropdown .mega-nav > ul.submenu-1').each(function(){
        var liItems = $(this);
        var Sum = 0;
        var liHeight = 0;
        if (liItems.children('li').length > 1){
            $(this).children('li').each(function(i, e){
                Sum += $(e).outerWidth(true);
            });
            $(this).width(Sum);
            liHeight = $(this).innerHeight();
            $(this).children('li').css({"height":liHeight});
        }
        var posLeft = 0;
        var halfSum = Sum/2;
        var screenRes = $(window).width();

        var margLeft = $(this).parent().offset().left;
        liItems.css({"width": screenRes, "left": -margLeft});
        var arrowPos = margLeft + $(this).parent().width() / 2 - 6;
        liItems.find(".dropdown_arrow").css('left',arrowPos);

    });
}

(function ($) {
    $.fn.tfGallery = function () {
        return $(this).each(function () {
            //var galleryID = $(this); // paste here a gallery ID
            //var galleryWrap = $(this).parents(".tf-gallery-wrap");
            var gallerySize = $(this).children(".gallery-images").children().size();

            $(this).children('.gallery-images').carouFredSel({
                prev : {
                    button: function() {
                        return $(this).parents(".tf-gallery-wrap").find(".prev");
                    }
                },
                next : {
                    button: function() {
                        return $(this).parents(".tf-gallery-wrap").find(".next");
                    }
                },
                circular: false,
                infinite: false,
                items: 1,
                auto: false,
                scroll: {
                    fx: "crossfade",
                    onBefore: function() {
                        var pos = $(this).triggerHandler('currentPosition');
                        $(this).closest(".tf-gallery-wrap").find(".image-count span.numb_active").html((pos+1));
                        $(this).closest(".tf-gallery-wrap").find(".image-count span.numb_all").html(gallerySize);
                        $(this).closest(".tf-gallery-wrap").find(".thumb-item").removeClass('selected');
                        $(this).closest(".tf-gallery-wrap").find('.gallery-thumbs div.itm'+pos).addClass('selected');
                        var currentText = $(this).children(".itm"+pos).children(".gallery-item-caption").html();
                        $(this).closest(".tf-gallery-wrap").find(".gallery-text").fadeOut(150, function() {
                            $(this).html(currentText);
                        }).fadeIn(150);
                        $(this).closest(".tf-gallery").find('.gallery-thumbs').trigger('slideTo', [pos, true]);
                    }
                },
                onCreate: function() {
                    $(this).children().each(function(i) {
                        $(this).addClass('itm'+i);
                    });
                    var currentText = $(this).find('.itm0 > .gallery-item-caption').html();
                    $(this).closest(".tf-gallery-wrap").find(".gallery-text").html(currentText);
                    $(this).closest(".tf-gallery-wrap").find(".midtab_right > .image-count span.numb_active").html('1');
                    $(this).closest(".tf-gallery-wrap").find(".midtab_right > .image-count span.numb_all").html(gallerySize);
                }
            });

            $(this).children('.gallery-thumbs').carouFredSel({
                width: "100%",
                auto: false,
                infinite: false,
                circular: false,
                scroll: {
                    items : 1,
                    width: 128,
                    height: 83
                },
                onCreate: function() {
                    $(this).children().each(function(i) {
                        $(this).addClass( 'itm'+i );
                        $(this).click(function() {
                            $(this).closest(".tf-gallery").find('.gallery-images').trigger('slideTo', [i, true]);
                        });
                    });
                    $(this).children('.itm0').addClass('selected');
                }
            });
        });
    };
}(jQuery));

jQuery(document).ready(function($) {
	var screenRes = $(window).width();

    //search on hover
    $(".hover-search").hoverIntent(
        function() {
            $(this).children(".btn-search").fadeOut();
            $(this).children("form").fadeIn();
        }, function() {
            $(this).children("form").fadeOut();
            $(this).children(".btn-search").fadeIn();
        }
    );

    $('.hover').bind('touchstart touchend', function(e) {
        e.preventDefault();
        $(this).toggleClass('hover_effect');
    });

    $('.dropdown .mega-nav > ul.submenu-1').each(function(){
        $(this).wrapInner('<div class="mega-wrap clearfix"></div>');
        $(this).prepend('<span class="dropdown_arrow"></span>');
    });
	
// Remove links outline in IE 7
	$("a").attr("hideFocus", "true").css("outline", "none");

// style Select, Radio, Checkbox
	if ($("select").hasClass("select_styled")) {
		var deviceAgent = navigator.userAgent.toLowerCase();
		var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
		if (agentID) {
			cuSel({changedEl: ".select_styled", visRows: 8, scrollArrows: true});	 // Add arrows Up/Down for iPad/iPhone
		} else {
			cuSel({changedEl: ".select_styled", visRows: 8, scrollArrows: false});
		}		
	}
	if ($("div,p").hasClass("input_styled")) {
		$(".input_styled input").iCheck({
            labelHover: false,
            checkboxClass: 'icheckbox_minimal-green',
            radioClass: 'iradio_minimal-green'
        });
	}

// centering dropdown submenu (not mega-nav)
	$(".dropdown > li:not(.mega-nav)").hover(function(){
		var dropDown = $(this).children("ul");
		var dropDownLi = $(this).children().children("li").innerWidth();		
		var posLeft = ((dropDownLi - $(this).innerWidth())/2);
		dropDown.css("left",-posLeft);		
	});	
	
// reload topmenu on Resize
	var mainNavigation = $('.topmenu').clone();
	responsive(mainNavigation);
	
    $(window).resize(function() {		
        var screenRes = $('.body_wrap').width();
        responsive(mainNavigation);
    });	
	
// responsive megamenu

    if (screenRes < 750) {
        //$(".dropdown li.mega-nav").removeClass("mega-nav");
    }
    if (screenRes > 320) {
        mega_show();
    }

    function mega_show(){
		$('.dropdown li').hoverIntent({
			sensitivity: 5,
			interval: 30,
			over: subm_show, 
			timeout: 0,
			out: subm_hide
		});
	}
	function subm_show(){	
		if ($(this).hasClass("parent")) {
			$(this).addClass("parentHover");
		};		
		$(this).children("ul").fadeIn(200);
	}
	function subm_hide(){ 
		$(this).removeClass("parentHover");
		$(this).children("ul").fadeOut(20);
	}
		
	$(".dropdown ul").closest("li").addClass("parent");
	$(".dropdown li:first-child, .pricing_box li:first-child, .sidebar .widget-container:first-child, .f_col .widget-container:first-child, .lang-list li:first-child").addClass("first");
	$(".dropdown li:last-child, .pricing_box li:last-child, .widget_twitter .tweet_item:last-child, .sidebar .widget-container:last-child, .f_col .widget-container li:last-child, .lang-list li:last-child").addClass("last");
	$(".dropdown li:only-child").removeClass("last").addClass("only");	
	$(".sidebar .current-menu-item, .sidebar .current-menu-ancestor").prev().addClass("current-prev");				
	
// tabs		
	var $tabs_on_page = $('.tabs').length;
	var $bookmarks = 0;

	for(var i = 1; i <= $tabs_on_page; i++){
		$('.tabs').eq(i-1).addClass('tab_id'+i);
		$bookmarks = $('.tab_id'+i+' li').length;
		$('.tab_id'+i).addClass('bookmarks'+$bookmarks);
	};
	$('.tabs li').click(function() {
    setTimeout(function () {
        for(var i = 1; i <= $tabs_on_page; i++){
            $bookmarks = $('.tab_id'+i+' li').length;
            for(var j = 1; j <= $bookmarks; j++){
                $('.tab_id'+i).removeClass('active_bookmark'+j);

                if($('.tab_id'+i+' li').eq(j-1).hasClass('active')){
                    $('.tab_id'+i).addClass('active_bookmark'+j);
                }
            }
        }
    }, 0)
});
	
// odd/even
	$("ul.recent_posts > li:odd, ul.popular_posts > li:odd, .table-striped table>tbody>tr:odd, .boxed_list > .boxed_item:odd, .grid_layout .post-item:odd").addClass("odd");
	$(".widget_recent_comments ul > li:even, .widget_recent_entries li:even, .widget_twitter .tweet_item:even, .widget_archive ul > li:even, .widget_categories ul > li:even, .widget_nav_menu ul > li:even, .widget_links ul > li:even, .widget_meta ul > li:even, .widget_pages ul > li:even, .event_list .event_item:even").addClass("even");
	
// cols
	$(".row .col:first-child").addClass("alpha");
	$(".row .col:last-child").addClass("omega"); 	

// toggle content
	$(".toggle_content").hide(); 	
	$(".toggle").toggle(function(){
		$(this).addClass("active");
		}, function () {
		$(this).removeClass("active");
	});
	
	$(".toggle").click(function(){
		$(this).next(".toggle_content").slideToggle(300,'easeInQuad');
	});
	
	
	$(".opened").find(".panel-collapse").addClass("in");
	$(".panel-toggle").click (function() {
		$(this).closest(".toggleitem").toggleClass("opened");;
	});
	
	$("[data-toggle='tooltip']").tooltip();

// pricing
	if (screenRes > 750) {
		// style 2
		$(".pricing_box ul").each(function () {
			$(".pricing_box .price_col").css('width',$(".pricing_box ul").width() / $(".pricing_box .price_col").size() - 10);			
		});
		
		var table_maxHeight = -1;
		$('.price_item .price_col_body ul').each(function() {
			table_maxHeight = table_maxHeight > $(this).height() ? table_maxHeight : $(this).height();
		});
		$('.price_item .price_col_body ul').each(function() {
			$(this).height(table_maxHeight);
		});	
	} 
jQuery(document).ready(function($) {
        jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
        });
        jQuery("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
        });
// grid list	
	if (screenRes > 600) {
		$(".gridlist .post-item:nth-child(3n), .block-list .block-item:nth-child(3n)").addClass("omega");
	}	
	
// buttons	
		$(".btn, .post-share a, .btn-submit").hover(function(){
			$(this).stop().animate({"opacity": 0.80});
		},function(){
			$(this).stop().animate({"opacity": 1});
		});	

// Smooth Scroling of ID anchors	
  function filterPath(string) {
  return string
    .replace(/^\//,'')
    .replace(/(index|default).[a-zA-Z]{3,4}$/,'')
    .replace(/\/$/,'');
  }
  var locationPath = filterPath(location.pathname);
  var scrollElem = scrollableElement('html', 'body');
 
  $('a[href*=#].anchor').each(function() {
    $(this).click(function(event) {
    var thisPath = filterPath(this.pathname) || locationPath;
    if (  locationPath == thisPath
    && (location.hostname == this.hostname || !this.hostname)
    && this.hash.replace(/#/,'') ) {
      var $target = $(this.hash), target = this.hash;
      if (target && $target.length != 0) {
        var targetOffset = $target.offset().top;
          event.preventDefault();
          $(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
            location.hash = target;
          });
      }
    }
   });	
  });
 
  // use the first element that is "scrollable"
  function scrollableElement(els) {
    for (var i = 0, argLength = arguments.length; i <argLength; i++) {
      var el = arguments[i],
          $scrollElement = $(el);
      if ($scrollElement.scrollTop()> 0) {
        return el;
      } else {
        $scrollElement.scrollTop(1);
        var isScrollable = $scrollElement.scrollTop()> 0;
        $scrollElement.scrollTop(0);
        if (isScrollable) {
          return el;
        }
      }
    }
    return [];
  }
  
	// prettyPhoto lightbox, check if <a> has atrr data-rel and hide for Mobiles
	if($('a').is('[data-rel]') && screenRes > 481) {
        $('a[data-rel]').each(function() {
			$(this).attr('rel', $(this).data('rel'));
		});
        $("a[rel^='prettyPhoto']").prettyPhoto({social_tools:false});
    }
    if($('a.popup').is('[data-rel]') && screenRes < 481) {
        $('a.popup[data-rel]').each(function() {
            $(this).attr('rel', $(this).data('rel'));
        });
        if (screenRes > 320) {
            $("a.popup[rel^='prettyPhoto']").prettyPhoto({
                social_tools:false,
                default_width: 400,
                default_height: 220,
            });
        } else {
            $("a.popup[rel^='prettyPhoto']").prettyPhoto({
                social_tools:false,
                default_width: 280,
                default_height: 220,
            });
        }
    }
	  
});

$(window).load(function() {
    var $=jQuery;

	 // Rating Stars
 $(".rating span.star").hover(
  function() {
   $(".rating span.star").removeClass("on");
   $(this).prevAll().addClass("over");
  }
  , function() {
   $(this).removeClass("over");
  }
 );
 
 $(".rating").mouseleave(function(){
  $(this).parent().find('.over').removeClass('over');
 });
 
 
 $(".rating span.star").click( function() {
  $(this).parent().children(".star").removeClass("voted");
  $(this).prevAll().addClass("voted");
  $(this).addClass("voted");
 });

ajax_rating();
    //Map on homepage

});


function ajax_rating()
{
    
        var saved_vals = rating.rating_info;
        for(var val in saved_vals)
        {
            jQuery(".rating span.star").click( function() {
                jQuery('#'+val+' [rel="'+(Math.round(star)+1)+'"]').removeClass("half-star");
            });
            if(saved_vals[val].count == 0) continue;
            else
            {
                var star =  saved_vals[val].val/saved_vals[val].count;
                var star1 =  parseInt(saved_vals[val].val/saved_vals[val].count);
                
                var rest = star - star1;
                
                if(rest > 0.5)
                {
                    jQuery('#'+val+' [rel="'+Math.round(star)+'"]').prevAll().addClass("voted");
                    jQuery('#'+val+' [rel="'+Math.round(star)+'"]').addClass("voted");
                }
                else if(rest == 0)
                {
                    jQuery('#'+val+' [rel="'+Math.round(star)+'"]').prevAll().addClass("voted");
                    jQuery('#'+val+' [rel="'+Math.round(star)+'"]').addClass("voted");
                }
                else
                {
                    jQuery('#'+val+' [rel="'+Math.round(star)+'"]').prevAll().addClass("voted");
                    jQuery('#'+val+' [rel="'+(Math.round(star))+'"]').addClass("voted");
                    jQuery('#'+val+' [rel="'+(Math.round(star)+1)+'"]').addClass("voted half-star");
                }
            }
        }

            jQuery(".rating span.star").click( function() {
                var id = rating.id;  
                var rating_array = JSON.stringify(rating.rating_info);                        
                var parent = jQuery(this).parent().attr('id');
                var current = jQuery(this).attr('rel');

                jQuery(this).parent().children(".star").removeClass("voted");
                jQuery(this).prevAll().addClass("voted");
                jQuery(this).addClass("voted");

                var cookies = getCookie('rating');

                if(cookies)cookies = cookies.split(',');

                var is_in = jQuery.inArray(parent,cookies);

                if(is_in == -1)
                {
                    jQuery.ajax({
                        type: "POST",
                        url: tf_script.ajaxurl,
                        data:{"action" : "tfuse_ajax_get_rating", id : id, current:current, parent:parent, rating_array:rating_array},
                        success: function(rsp){
                           // var obj = jQuery.parseJSON(rsp); 
                            var obj = rsp; 
                            console.log(obj);
                        }
                    });
                }

                var saved_prop = getCookie('rating');

                if(saved_prop)saved_prop = saved_prop.split(',');
                else  saved_prop = new Array();

                var pos = jQuery.inArray(parent,saved_prop);  

                if(pos != -1)
                {
                    saved_prop = jQuery.grep(saved_prop, function(value) {
                        return value;
                    });
                }
                else
                    saved_prop.push(parent);

                saved_prop = saved_prop.join();

                setCookie('rating', saved_prop , 366);
            });
}


function setCookie(c_name,value,exdays)
{
    var exdate=new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value=value + ((exdays==null) ? "" : "; expires="+exdate.toUTCString()+"; path=/;");
    document.cookie=c_name + "=" + c_value;
}
function getCookie(c_name)
{
    var i,x,y,ARRcookies=document.cookie.split(";");
    var result = false;
    for (i=0;i<ARRcookies.length;i++)
    {
        x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
        y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
        x=x.replace(/^\s+|\s+$/g,"");
        if (x==c_name)
        {
            result = y;
        }
    }
    return result;
}

function validateEmail(email) {
    if(!email)
        return false;
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if( !emailReg.test( email ) ) {
        return false;
    } else {
        return true;
    }
}

jQuery(document).ready(function($) {


    jQuery('#modal_window_reservation_post').live('click',function(){
        var room_title = jQuery('#tf_resrvation_room_title').val();
        var room_type = jQuery('#tf_resrvation_room_type').val();
        var room_price = jQuery('#tf_resrvation_room_price').val();        
        
        if(room_title)
            jQuery('.modal_window_reservation #reservationForm').find('input.tf_resrvation_room_title').attr('value',room_title);
        if(room_type)
            jQuery('.modal_window_reservation #reservationForm').find('input.tf_resrvation_room_type').attr('value',room_type);
        if(room_price)
            jQuery('.modal_window_reservation #reservationForm').find('input.tf_resrvation_room_price').attr('value',room_price);
    });
    
    jQuery('#modal_window_link').live('click',function(){
        var this_element = this;
        var check_in_date = jQuery(this_element).parents('.room-col-4').siblings('#col_datepickers').find('.inputField.check_in_date').val()
        var check_out_date = jQuery(this_element).parents('.room-col-4').siblings('#col_datepickers').find('.inputField.check_out_date').val()
        
        if(check_in_date.length == 0)
        {
            jQuery(this_element).parents('.room-col-4').siblings('#col_datepickers').find('.inputField.check_in_date').css('border','1px solid red');
        }
        
        if(check_out_date.length == 0)
        {
            jQuery(this_element).parents('.room-col-4').siblings('#col_datepickers').find('.inputField.check_out_date').css('border','1px solid red');
        }
        
        
        if(check_in_date.length == 0 ||  check_out_date.length == 0)
        {
            jQuery('.modal_window_reservation').hide();
            jQuery('#lean_overlay').hide();
        }
        
        var datepicker_in = jQuery('.modal_window_reservation #reservationForm').find('input.hasDatepicker').hasClass('tfuse_rf_post_datepicker_in');
        var datepicker_out = jQuery('.modal_window_reservation #reservationForm').find('input.hasDatepicker').hasClass('tfuse_rf_post_datepicker_out')
        
        if(check_in_date.length != 0)
        {
            jQuery(this_element).parents('.room-col-4').siblings('#col_datepickers').find('.inputField.check_in_date').removeAttr('style');
        }
        
        if(check_out_date.length != 0)
        {
            jQuery(this_element).parents('.room-col-4').siblings('#col_datepickers').find('.inputField.check_out_date').removeAttr('style');
        }

        if(datepicker_in)
        {
            var date_in = jQuery('.modal_window_reservation #reservationForm').find('input.tfuse_rf_post_datepicker_in');
            jQuery(date_in).attr('value',check_in_date).attr('readonly',true).css('opacity','0.5').datepicker( "option", { beforeShow: function() {return false;}});

        }
        
        if(datepicker_out)
        {
            jQuery(date_out).datepicker();
            var date_out = jQuery('.modal_window_reservation #reservationForm').find('input.tfuse_rf_post_datepicker_out');
            jQuery(date_out).attr('value',check_out_date);
            jQuery(date_out).attr('readonly',true).css('opacity','0.5').datepicker( "option", { beforeShow: function() {return false;}});
        }
        
        var room_title = jQuery(this_element).parents('.room-col-4').siblings('#tf_resrvation_room_title').val();
        var room_type = jQuery(this_element).parents('.room-col-4').siblings('#tf_resrvation_room_type').val();
        var room_price = jQuery(this_element).parents('.room-col-4').siblings('#tf_resrvation_room_price').val();
        
        if(room_title)
            jQuery('.modal_window_reservation #reservationForm').find('input.tf_resrvation_room_title').attr('value',room_title);
        if(room_type)
            jQuery('.modal_window_reservation #reservationForm').find('input.tf_resrvation_room_type').attr('value',room_type);
        if(room_price)
            jQuery('.modal_window_reservation #reservationForm').find('input.tf_resrvation_room_price').attr('value',room_price);
    });
    
     var topOff = 0;

    jQuery('a[rel*=leanModal]').leanModal({ top : topOff });

    jQuery('a[rel*=leanModal]').click(function(){
        var book_class = jQuery(this).parents('.book-table');
        
        if(jQuery(book_class).hasClass('book-table'))
        {
            if($(window).height() <= $('.modal_window_reservation').height()) {
            topOff = $(window).scrollTop() - $(".book-table ul").offset().top;
            } 
            else {
                topOff = $(window).scrollTop() - $(".book-table ul").offset().top + ($(window).height() - $('.modal_window_reservation').height())/2;
            }
        }
        else
        {
            if($(window).height() <= $('.modal_window_reservation').height()) {
                topOff = $(window).scrollTop() - $(".tf_room_types_reservations").offset().top;
            } 
            else {
                topOff = $(window).scrollTop() - $(".tf_room_types_reservations").offset().top + ($(window).height() - $('.modal_window_reservation').height())/2;
            }
        }
        jQuery('.modal_window_reservation').css('top',topOff);
    });
    
    jQuery('#room_search_submit').on('click',function(){ 
        
        if(jQuery('#reservation_form .select_styled .cusel-scroll-pane .cuselActive').attr('val') == 'all_rooms')
        {
            jQuery('#reservation_form .select_styled input').removeAttr('name');
        }
    });
    
    
    jQuery('.weather_block a.weather_switch').on('click',function(){
        var clicked = this;
        var celsius = true;
        
        jQuery(clicked).addClass('farenheit');
        jQuery('.weather_block span.days_degrees').addClass('celsius');

        if(jQuery(clicked).hasClass('farenheit') && jQuery(clicked).hasClass('celsius'))
        {  
            var celsius = true;
            jQuery(clicked).find('span.farenh').html('F&deg;')
            jQuery(clicked).removeClass('celsius');
        }
        else if(jQuery(clicked).hasClass('farenheit'))
        {
            var celsius = false;
            jQuery(clicked).find('span.farenh').html('&deg;C')
            jQuery(clicked).addClass('celsius');
        }
       
        jQuery.ajax({
            type: "POST",
            url: tf_script.ajaxurl,
            data:{"action" : "tfuse_ajax_switch_degree" , celsius : celsius},
            success: function(rsp){
                var obj = jQuery.parseJSON(rsp); 
              //  var obj = rsp; 
              //  console.log(obj);
                var c = 0;
                if(jQuery('.weather_block span.days_degrees').hasClass('farenheit') && jQuery('.weather_block span.days_degrees').hasClass('celsius'))
                {  
                    jQuery('.weather_block span.days_degrees').html('&deg;C')
                    jQuery('.weather_block span.days_degrees').removeClass('farenheit');
                }
                else if(jQuery('.weather_block span.days_degrees').hasClass('celsius'))
                {
                    jQuery('.weather_block span.days_degrees').html('F&deg;')
                    jQuery('.weather_block span.days_degrees').addClass('farenheit');
                }
                for(var degree in obj)
                {   
                    c++;
                    jQuery('.weather_block .wcol.wcol-'+c+' .wcol-bot span.show_degrees').html(obj[degree]);
                }
            }
        });
        return false;
    });
});