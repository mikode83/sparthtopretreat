import $ from 'jquery';
window.jQuery = $; window.$ = $;
import 'slick-carousel';
import objectFitImages from 'object-fit-images';
// import {jarallax} from 'jarallax';
import './vendors/parallax.js';
import './vendors/magnific.js';



$(document).ready(function(){

    $(window).scroll(function (event) {
      var st = $(this).scrollTop();
      if (st > 120) {
        $("nav").addClass("stuck");
      } else {
        $("nav").removeClass("stuck");
      }
    });

    $('.burger').on('click', function(){
        $(this).toggleClass('active');
        $('nav ul').toggleClass('active');
        $('body').toggleClass('nav-active');
    })

    $('.hp__slick').slick({
        infinite: false,
        slidesToShow: 1,
        dots: false,
        arrows: false,
        rows: 0,
        slide: '.item',
        fade: true,
        autoplay: true,
        autoplaySpeed: 4000,
        speed: 1200,
        cssEase: 'linear',
        pauseOnHover: false
    });

    $('.hp__scroller').slick({
        infinite: false,
        slidesToShow: 1,
        dots: true,
        arrows: false,
        rows: 0,
        slide: '.item',
        autoplay: true,
        autoplaySpeed: 3500,
    });

    jarallax(document.querySelectorAll('.jarallax'), {
        speed: 0.1,
        disableParallax: /iPad|iPhone|iPod|Android/,
    });

    if ($('body').hasClass('page-template-template-gallery')) {
        $('.gallery').magnificPopup({
    		delegate: 'a',
    		type: 'image',
    		tLoading: 'Loading image #%curr%...',
    		mainClass: 'mfp-img-mobile',
    		gallery: {
    			enabled: true,
    			navigateByImgClick: true,
    			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
    		},
    		image: {
    			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
    			titleSrc: function(item) {
    				return item.el.attr('title') + '<small>Sparth Top Retreat</small>';
    			}
    		},
            zoom: {
    			enabled: true,
    			duration: 300, // don't foget to change the duration also in CSS
    			opener: function(element) {
    				return element.find('img');
    			}
    		}
    	});
    }

    $('#booking-form').on('submit', function(e){
        e.preventDefault();

        var form_data = $(this).serializeArray();

		$.ajax({
			url: ajaxurl,
			data: form_data,
			success: function (ajax_data) {
				var response = JSON.parse(ajax_data);

				/*
				*  To debug teh jaax response uncomment line below
				*/
				// console.log(response);

				if (response.status == 'success') {
					// if there was any errors... hide them now.
					$('.message__error').slideUp(400);
					// replace form html with the ajax response message
					$('#booking-form div, #booking-form h3').remove();
                    $('#booking-form').append('<p>Your booking request has been received. We will respond as soon as possible.</p>');
				} else {
					// add error message before form.
					$('#booking-form').append(response.message);
				}
			}
		});
    });

});
