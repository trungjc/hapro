var Hapro = Hapro || {};

Hapro = {
	Homepage:{
		init: function(){
			this.bannerSlider();
			this.newsSlider('#business-news');
			this.newsSlider('#market-news');
			this.brandsSlider();
		},
		bannerSlider : function(){
			$("#home-slider").slick({
				slidesToScroll: 1,
				asNavFor: "#home-slider-nav",
				prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
				nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
				responsive: [					
					{
						breakpoint: 767,						
						settings:{
							arrows: false,
							slidesToShow: 1
						}
					}
				]
				
			});
			$("#home-slider-nav").slick({
				asNavFor: "#home-slider",
				slidesToShow: 4,
				slidesToScroll: 1,
				arrows: false,
				focusOnSelect: true,
				responsive: [
					{
						breakpoint: 1024,
						settings:{
							slidesToShow: 3 
						}
					},
					{
						breakpoint: 767,
						settings:{
							slidesToShow: 3
						}
					},
					{
						breakpoint: 480,
						settings:{
							slidesToShow: 1
						}
					}
				]
			})
		},
		newsSlider: function(element){
			
			$(element).slick({
				slidesToScroll: 1,
				slidesToShow: 2,
				arrows: false,
				dots: true,
				appendDots: $(element+"-paging"),
				responsive: [
					{
						breakpoint: 480,
						settings:{
							slidesToShow: 1
						}
					}
				]
			})
		},
		brandsSlider: function(){
			$("#brands-slider").slick({
				slidesToScroll: 1,
				slidesToShow: 6,
				prevArrow: $("#slider-prev"),
				nextArrow: $("#slider-next"),
				responsive: [
					{
						breakpoint: 1024,
						settings:{
							slidesToShow: 4 
						}
					},
					{
						breakpoint: 767,
						settings:{
							slidesToShow: 3
						}
					},
					{
						breakpoint: 480,
						settings:{
							slidesToShow: 2
						}
					}
				]
			})
			
		}
	}
}
jQuery(document).ready(function($){
	Hapro.Homepage.init();
})