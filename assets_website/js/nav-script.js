(function() {
        // Main navigation & mega menu
        // ----------------------------------------------------------------
       function GFG() {
            var CustomOp = {
                center:new google.maps.LatLng(
                        28.502212, 77.405603),
                zoom:17,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            };
              
            // Map object
            var map = new google.maps.Map(
                document.getElementById("DivID"),
                CustomOp
            );
        }
        // Global menu variables

        var objSearch = $('.search-wrapper'),
            objLogin = $('.login-wrapper'),
            objCart = $('.cart-wrapper'),
            objMenu = $('.floating-menu'),
            objMenuLink = $('.floating-menu a'),
            $search = $('.open-search'),
            $login = $('.open-login'),
            $cart = $('.open-cart'),
            $menu = $('.open-menu'),
            $openDropdown = $('.open-dropdown'),
            $settingsItem = $('.nav-settings .nav-settings-list li'),
            $close = $('.close-menu');

        // Open/close login

        $login.on('click', function () {
            toggleOpen($(this));
            objLogin.toggleClass('open');
            closeSearch();
            closeCart();
        });

        // Open/close search bar

        $search.on('click', function () {
            toggleOpen($(this));
            objSearch.toggleClass('open');
            objSearch.find('input').focus();
            closeLogin();
            closeCart();
        });

        // Open/close cart

        $cart.on('click', function () {
            toggleOpen($(this));
            objCart.toggleClass('open');
            closeLogin();
            closeSearch();
        });

        // Mobile menu open/close

        $menu.on('click', function () {
            objMenu.addClass('expanded');
            closeSearch();
            closeLogin();
            closeCart();
        });

        // Settings language & currency dropdown

        $settingsItem.on('click', function () {
            var $value = $(this).closest('.nav-settings').find('.nav-settings-value');
            $value.text($(this).text());
        });

        // Floating menu hyperlink
        if ($('nav').hasClass('navbar-single-page')) {
            objMenuLink.on('click', function () {
                objMenu.removeClass('expanded');
            });
        }

        // Open dropdown/megamenu

        $openDropdown.on('click', function (e) {

            e.preventDefault();

            var liParent = $(this).parent().parent(),
                liDropdown = liParent.find('.navbar-dropdown');

            liParent.toggleClass('expanded');

            if (liParent.hasClass('expanded')) {
                liDropdown.slideDown();
            }
            else {
                liDropdown.slideUp();
            }
        });

        // Close menu (mobile)

        $close.on('click', function () {
            $('nav').find('.expanded').removeClass('expanded');
            $('nav').find('.navbar-dropdown').slideUp();
        });

        // Global functions

        function toggleOpen(el) {
            $(el).toggleClass('open');
        }

        function closeSearch() {
            objSearch.removeClass('open');
            $search.removeClass('open');
        }
        function closeLogin() {
            objLogin.removeClass('open');
            $login.removeClass('open');
        }
        function closeCart() {
            objCart.removeClass('open');
            $cart.removeClass('open');
        }

        // Sticky header
        // ----------------------------------------------------------------

        var navbarFixed = $('nav.navbar-fixed');
        // When reload page - check if page has offset
        if ($(document).scrollTop() > 94) {
            navbarFixed.addClass('navbar-sticked');
        }
        // Add sticky menu on scroll
        $(document).on('bind ready scroll', function () {
            var docScroll = $(document).scrollTop();
            if (docScroll >= 10) {
                navbarFixed.addClass('navbar-sticked');
            } else {
                navbarFixed.removeClass('navbar-sticked');
            }
        });

          
    });
     $('.slider-for').slick({
       slidesToShow: 1,
       slidesToScroll: 1,
       arrows: false,
       fade: true,
       asNavFor: '.slider-nav'
     });
     $('.slider-nav').slick({
       slidesToShow: 3,
       slidesToScroll: 1,
       asNavFor: '.slider-for',
       dots: true,
       focusOnSelect: true
     });
     $('a[data-slide]').click(function(e) {
       e.preventDefault();
       var slideno = $(this).data('slide');
       $('.slider-nav').slick('slickGoTo', slideno - 1);
     }); 
        $('.slick-arrow').hide();
        $('.slick-dots').hide();
        $('body > section.blog.blog-block > div > div > div.slider.forr.slick-initialized.slick-slider > div > div').css('height','100%');
        $('body > section.blog.blog-block > div > div > div.slider.sliderss.slick-initialized.slick-slider.slick-dotted > div > div').css('height','210px');
        
        var windowSize = $(window).width();
        if (windowSize <= 530) {
           $('body > section.blog.blog-block > div > div > div.slider.slider-nav.sliderss.slick-initialized.slick-slider.slick-dotted').css('margin-bottom','-133px');
           $('body > section.blog.blog-block > div > div > div.slider.slider-nav.sliderss.slick-initialized.slick-slider.slick-dotted').css('padding-top','0px');
           $('.video').css('height','273px');
           $('.quotes-style').css('width','100%');
        }
