var Hapro = Hapro || {};
var stickyNavTop = $('.navbar-collapse').offset().top;
Hapro = {
    global: {
        menuHover: function() {
            $('.navbar-nav li.parent-menu').hover(function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
            }, function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
            });
            $('.navbar-nav li.parent-menu').on('click', function() {
                var $el = $(this);
                if ($el.hasClass('open')) {
                    var $a = $el.children('a.dropdown-toggle');
                    if ($a.length && $a.attr('href')) {
                        location.href = $a.attr('href');
                    }
                }
            });
        },
        init: function() {
            this.menuHover();
        }
    },

    Homepage: {
        init: function() {
            this.bannerSlider();
            this.newsSlider('#business-news');
            this.newsSlider('#market-news');
            this.brandsSlider();
            this.replaceBG('.page-header .post-thumbnail img', '.page-header .post-thumbnail');
            this.replaceBG('.brand img', '.brand');
            $('.category-grid article').matchHeight();
        },
        bannerSlider: function() {
            $("#home-slider").slick({
                slidesToScroll: 1,
                autoplay: true,
                asNavFor: "#home-slider-nav",
                prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
                responsive: [{
                    breakpoint: 767,
                    settings: {
                        arrows: false,
                        slidesToShow: 1
                    }
                }]

            });
            $("#home-slider-nav").slick({
                asNavFor: "#home-slider",
                slidesToShow: 5,
                autoplay: true,
                slidesToScroll: 1,
                arrows: false,
                focusOnSelect: true,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }]
            })
        },
        newsSlider: function(element) {

            $(element).slick({
                slidesToScroll: 1,
                slidesToShow: 2,
                arrows: false,
                autoplay: true,
                dots: true,
                appendDots: $(element + "-paging"),
                responsive: [{
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1
                    }
                }]
            })
        },
        brandsSlider: function() {
            $("#brands-slider").slick({
                slidesToScroll: 1,
                slidesToShow: 6,
                autoplay: true,
                prevArrow: $("#slider-prev"),
                nextArrow: $("#slider-next"),
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4
                    }
                }, {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 3
                    }
                }, {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2
                    }
                }]
            })

        },
        replaceBG: function(element_img, element) {
            $(element_img).each(function() {
                var url = $(this).attr('src');
                $(this).parents(element).attr('style', 'background-image: url("' + url + '")');
            })

        }
    }
}
jQuery(document).ready(function($) {
    Hapro.Homepage.init();
    Hapro.global.init();
    var stickyNavTop = $('.navbar').offset().top;
    var stickyNav = function() {
        var scrollTop = $(window).scrollTop();
        if (scrollTop > stickyNavTop) {
            $('.navbar').addClass('sticky');
        } else {
            $('.navbar').removeClass('sticky');
        }
    };
    stickyNav();
    $(window).scroll(function() {
        stickyNav();
    });
})
