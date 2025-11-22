$(document).ready(function(){
    
    var rtl = false;
    
    if($("html").attr("dir") == 'rtl'){
         rtl = true;
        $('.main-wrapper').addClass('rtl-style');
    }
    
    /* Header Fixed */
    
    $(window).scroll(function(){
            
        if ($(window).scrollTop() >= 100) {
            $('#header').addClass('fixed-header');
        }
        else {
            $('#header').removeClass('fixed-header');
        }
              
    });
    
    
    /* Hamburger */
    
    $(".hamburger").click(function () {
        $(".mobile-menu").addClass('active');
        $("body").addClass('active');
    });

    $(".is-closed").click(function () {
        $(".mobile-menu").removeClass('active');
        $("body").removeClass('active');
    });
    
    $(".hamburger-dash").click(function () {
        $(".aside-menu").addClass('active');
    });

    $(".closed").click(function () {
        $(".aside-menu").removeClass('active');
    });
   
    /* Owl Carousel */
  
    $("#services-slider").owlCarousel({
        loop: true,
        margin: 25,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            992: {
                items: 2,
            },
            1199: {
                items: 3,
            }
        },
        dots: false,
        nav: true,
        navText:['<i class="icon-arrow"></i>','<i class="icon-arrow"></i>'],
        rtl: rtl,
        autoplay: false
    });
    
    $("#portfolio-slider").owlCarousel({
        loop: true,
        margin: 25,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            992: {
                items: 2,
            },
            1199: {
                items: 5,
            }
        },
        dots: false,
        nav: false,
        rtl: rtl,
        autoplay: true
    });
    
});