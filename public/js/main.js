/*  ---------------------------------------------------
  Template Name: Megalimed
  Description: Megalimed ecommerce template
  Author: Wikko0
  Version: 1.0
  Created: Victor Minchev
---------------------------------------------------------  */

'use strict';

(function ($) {

    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Product filter
        --------------------*/
        $('.filter__controls li').on('click', function () {
            $('.filter__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.property__gallery').length > 0) {
            var containerEl = document.querySelector('.property__gallery');
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    //Search Switch
    $('.search-switch').on('click', function () {
        $('.search-model').fadeIn(400);
    });

    $('.search-close-switch').on('click', function () {
        $('.search-model').fadeOut(400, function () {
            $('#search-input').val('');
        });
    });


    //Account Switch
    $('.account-switch').on('click', function () {
        $('.account-model').fadeIn(400);
    });

    $('.account-close-switch').on('click', function () {
        $('.account-model').fadeOut(400, function () {
            $('#account-input').val('');
        });
    });

    $('.account-register-switch').on('click', function () {
        $('.account-model').fadeOut(400, function () {
            $('#account-input').val('');
        });
        $('.register-model').fadeIn(400);
    });

    //Register Switch
    $('.register-switch').on('click', function () {
        $('.register-model').fadeIn(400);
    });

    $('.register-close-switch').on('click', function () {
        $('.register-model').fadeOut(400, function () {
            $('#register-input').val('');
        });
    });

    $('.register-account-switch').on('click', function () {
        $('.register-model').fadeOut(400, function () {
            $('#register-input').val('');
        });
        $('.account-model').fadeIn(400);
    });


    //Calculator Switch
    $('.calculator-switch').on('click', function () {
        $('.calculator-model').fadeIn(400);
    });

    $('.calculator-close-switch').on('click', function () {
        $('.calculator-model').fadeOut(400, function () {
            $('#calculator-input').val('');
        });
    });

    //Calculator Post Switch
    $('.calculator-post-switch').on('click', function () {
        $('.calculator-post-model').fadeIn(400);
    });

    $('.calculator-post-close-switch').on('click', function () {
        $('.calculator-post-model').fadeOut(400, function () {
            $('#calculator-input').val('');
        });
    });


    //Canvas Menu
    $(".canvas__open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay, .offcanvas__close").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    /*------------------
		Navigation
	--------------------*/
    $(".header__menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Accordin Active
    --------------------*/
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active');
    });

    /*--------------------------
        Banner Slider
    ----------------------------*/
    $(".banner__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*--------------------------
        Categories Slider
    ----------------------------*/
    $(".categories__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*--------------------------
        Product Details Slider
    ----------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: false,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<i class='arrow_carrot-left'></i>","<i class='arrow_carrot-right'></i>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false,
        mouseDrag: false,
        startPosition: 'URLHash'
    }).on('changed.owl.carousel', function(event) {
        var indexNum = event.item.index + 1;
        product_thumbs(indexNum);
    });

    function product_thumbs (num) {
        var thumbs = document.querySelectorAll('.product__thumb a');
        thumbs.forEach(function (e) {
            e.classList.remove("active");
            if(e.hash.split("-")[1] == num) {
                e.classList.add("active");
            }
        })
    }


    /*------------------
		Magnific
    --------------------*/
    $('.image-popup').magnificPopup({
        type: 'image'
    });


    $(".nice-scroll").niceScroll({
        cursorborder:"",
        cursorcolor:"#dddddd",
        boxzoom:false,
        cursorwidth: 5,
        background: 'rgba(0, 0, 0, 0.2)',
        cursorborderradius:50,
        horizrailenabled: false
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview start
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    if(mm == 12) {
        mm = '01';
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, '0');
    }
    var timerdate = mm + '/' + dd + '/' + yyyy;
    // For demo preview end


    // Uncomment below and use your date //



    /*-------------------
		Range Slider
	--------------------- */
	var rangeSlider = $(".price-range"),
    minamount = $("#minamount"),
    maxamount = $("#maxamount"),
    minPrice = rangeSlider.data('min'),
    maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
    range: true,
    min: minPrice,
    max: maxPrice,
    values: [minPrice, maxPrice],
    slide: function (event, ui) {
        minamount.val(ui.values[0] + 'лв');
        maxamount.val(ui.values[1] + 'лв');
        }
    });
    minamount.val(rangeSlider.slider("values", 0) + 'лв');
    maxamount.val(rangeSlider.slider("values", 1) + 'лв');

    /*------------------
		Single Product
	--------------------*/
	$('.product__thumb .pt').on('click', function(){
		var imgurl = $(this).data('imgbigurl');
		var bigImg = $('.product__big__img').attr('src');
		if(imgurl != bigImg) {
			$('.product__big__img').attr({src: imgurl});
		}
    });

    /*-------------------
		Quantity change
	--------------------- */
    document.addEventListener('livewire:load', function () {
        var proQty = document.querySelectorAll('.pro-qty');

        proQty.forEach(function (element) {
            var input = element.querySelector('input');

            element.addEventListener('click', function (event) {
                if (event.target.classList.contains('qtybtn')) {
                    event.preventDefault();

                    var oldValue = parseFloat(input.value);
                    var newVal;

                    if (event.target.classList.contains('inc')) {
                        newVal = oldValue + 1;
                    } else {
                        if (oldValue > 0) {
                            newVal = oldValue - 1;
                        } else {
                            newVal = 0;
                        }
                    }
                    input.value = newVal;
                }
            });
        });
    });

    /*-------------------
		Radio Btn
	--------------------- */
    $(".size__btn label").on('click', function () {
        $(".size__btn label").removeClass('active');
        $(this).addClass('active');
    });

})(jQuery);

(function($) {

    "use strict";

    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });

})(jQuery);

/*-------------------
		Product Href and Change
	--------------------- */
var productImages = document.querySelectorAll('.product-image');

productImages.forEach(function(image) {
    var originalImageUrl = image.getAttribute('data-setbg'); // Запазваме оригиналната URL на снимката

    image.addEventListener('mouseover', function() {
        this.style.cursor = 'pointer';
        var secondImageUrl = this.getAttribute('data-product-image'); // Получаваме URL на втората снимка
        if (secondImageUrl) {
            this.style.backgroundImage = 'url(' + secondImageUrl + ')'; // Промяна на фона с втората снимка
        }
    });

    image.addEventListener('mouseout', function() {
        this.style.backgroundImage = 'url(' + originalImageUrl + ')'; // Възстановяване на оригиналната снимка при излизане на мишката
    });

    image.addEventListener('click', function() {
        var productUrl = this.getAttribute('data-product-url');
        if (productUrl) {
            window.location.href = productUrl;
        }
    });

    var imagePopups = image.parentElement.querySelectorAll('.image-popup');
    imagePopups.forEach(function(popup) {
        popup.addEventListener('click', function(event) {
            event.stopPropagation();
        });
    });
});
