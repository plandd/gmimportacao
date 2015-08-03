// Foundation JavaScript
// Documentation can be found at: http://foundation.zurb.com/docs
$(document).foundation();

//plugins
$.fn.getDataThumb = function(options) {
    options = $.extend({
        bgClass: 'bg-cover'
    }, options || {});
    return this.each(function() {
        var th = $(this).data('thumb');
        if (th) {
            $(this).css('background-image', 'url(' + th + ')').addClass(options.bgClass);
        }
    });
};
$('figure').getDataThumb(); // data-thumb para esses elementos

/**
 * Navegação
 * ---------------------------------------------------------------------
 */

//Escolher entre o menu de produtos ou grupos
$('a','div.main-items').on('click',function(e) {
	e.preventDefault();
	var i = $(this).index();
	console.log(i);
	$(this).toggleClass('active')
	.siblings('a').removeClass('active');

	$('ul','.search-menu').eq(i).addClass('active')
	.siblings('ul').removeClass('active');
});


/**
 * Sliders
 * ---------------------------------------------------------------------
 */

//Distribuidores oficiais
(function() {
    var partners = $("#list-partners");
    partners.owlCarousel({
        responsiveBaseWidth: $("#list-partners"),
        responsive: false,
        pagination: false,
        items: 5,
        rewindNav: false,
        rewindSpeed: 300,
        autoPlay : 5000
    });

    //navegação
    $(".next-partner").click(function(e){
        e.preventDefault();
        partners.trigger('owl.next');
    });
    $(".prev-partner").click(function(e){
        e.preventDefault();
        partners.trigger('owl.prev');
    });


    var testimonials = $("#nav-testimonials");
    testimonials.owlCarousel({
        responsiveBaseWidth: $("#nav-testimonials"),
        responsive: false,
        pagination: true,
        items: 1,
        rewindNav: false,
        rewindSpeed: 300,
        autoPlay : 5000
    });
})();
