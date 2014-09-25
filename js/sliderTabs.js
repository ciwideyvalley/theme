var $=jQuery;
function sliderTabsCalc() {
	var st_mainWidth = jQuery(".top_slider_navi .inner").width();	
	var st_pageItem = jQuery(".top_slider_navi .inner a");
	var st_pageCount = st_pageItem.size();	
	st_pageItem.css("width", st_mainWidth/st_pageCount);
}
jQuery(window).load(function() {
		
	sliderTabsCalc();	
	jQuery(window).resize(function() {		        
        sliderTabsCalc();
    });	
});