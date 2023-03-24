$(window).resize(function(){
   console.log(456);
    
    // need to have the same with set from JS on both divs. Otherwise it can push stuff around in HTML
    var trp_ls_shortcodes = document.querySelectorAll('.trp_language_switcher_shortcode .trp-language-switcher');
    if ( trp_ls_shortcodes.length > 0) {
        // get the last language switcher added
        var trp_el = trp_ls_shortcodes[trp_ls_shortcodes.length - 1];

        var trp_shortcode_language_item = trp_el.querySelector( '.trp-ls-shortcode-language' )
        // set width
        var trp_ls_shortcode_width                                               = trp_shortcode_language_item.offsetWidth + 16;
        trp_shortcode_language_item.style.width                                  = trp_ls_shortcode_width + 'px';
        trp_el.querySelector( '.trp-ls-shortcode-current-language' ).style.width = trp_ls_shortcode_width + 'px';

        // We're putting this on display: none after we have its width.
        trp_shortcode_language_item.style.display = 'none';
    }
   console.log(123);
});

if ($(window).width() < 1199) {
    $("body").removeClass("sidebar-open");
}

jQuery(document).on('click', '.menu-items .account-menu', function () {
    jQuery("body").addClass("sidebar-open");
    // jQuery('.toggle-sidebar').trigger('click');
    // console.log('sdefswfvsfvssv');
});

jQuery(document).on('click','.close', function(){
    jQuery('#exampleModalCenter').removeClass('show');
    jQuery('#exampleModalCenter').hide();
    
});
jQuery(document).ready(function ($) {


    jQuery("body").on("submit", ".login__form", function (e) {
        var username = jQuery(".login__form input[name=username]").val();
        var password = jQuery(".login__form input[name=password]").val();

        var err = 0;

        if (username != "") {
            jQuery(".login__form input[name=username]").removeClass("border-error");
        } else {
            jQuery(".login__form input[name=username]").addClass("border-error");
            err = 1;
        }

        if (password != "") {
            jQuery(".login__form input[name=password]").removeClass("border-error");
        } else {
            jQuery(".login__form input[name=password]").addClass("border-error");

            err = 1;
        }

        if (err == 1) {
            return false;
            e.preventDefault();
        }
        // var currentRequest = null;
        // currentRequest = $.ajax({
        //     type: "POST",
        //     url: ajaxurl,
        //     data: {
        //         action: "casino_admin_login",
        //         username: username,
        //         password: password,
        //     },
        //     beforeSend: function () {
        //         if (currentRequest != null) {
        //             currentRequest.abort();
        //         }
        //     },
        //     success: function (response) {
        //         if (response == 1) {
        //             location.reload();
        //         } else {
        //             jQuery("body .login__form .error-msg").text(response);
        //             jQuery("body .login__form .error-msg").css(
        //                 "display",
        //                 "block"
        //             );
        //         }
        //     },
        // });
    });

    if (jQuery("input[name=start_date]").length != 0) {
        var start_date = jQuery("input[name=start_date]").val();
        var end_date = jQuery("input[name=end_date]").val();
        if (start_date.length !== 0 && end_date.length !== 0) {
            jQuery(".transactions_datepicker").daterangepicker({
                startDate: start_date,
                endDate: end_date,
                locale: {
                    format: "YYYY-MM-DD",
                },
            });
        } else {
            jQuery(".transactions_datepicker").daterangepicker({
                autoUpdateInput: false,
            });
            jQuery(".transactions_datepicker").val("YYYY-MM-DD");
        }

        jQuery(".transactions_datepicker").on("apply.daterangepicker", function (ev, picker) {
            jQuery("input[name=start_date]").val(picker.startDate.format("YYYY-MM-DD"));
            jQuery("input[name=end_date]").val(picker.endDate.format("YYYY-MM-DD"));
            jQuery(".data-sort-option").submit();
        });
    }

    // Slick slider
    var $status = jQuery(".pagingInfo");
    var $slickElement = jQuery(".banner-slider");

    $slickElement.on("init reInit afterChange", function (event, slick, currentSlide, nextSlide) {
        //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
        var i = (currentSlide ? currentSlide : 0) + 1;
        $status.text(i + "/" + slick.slideCount);
    });

    jQuery(".banner-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true,
        dots: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 3000,
        prevArrow:
            '<button class="slide-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
        nextArrow:
            '<button class="slide-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: false,
                },
            },
        ],
    });

    jQuery(".casino_slider").slick({
        slidesToShow: 3,
        slidesToScroll: 2,
        infinite: true,
        dots: true,
        arrows: false,
        autoplay: false,
        variableWidth: true,
        // autoplaySpeed: 3000,
        prevArrow:
            '<button class="slide-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
        nextArrow:
            '<button class="slide-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: false,
                },
            },
        ],
    });

    jQuery(".home_game_slider").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        infinite: true,
        dots: true,
        arrows: false,
        autoplay: true,
        variableWidth: true,
        autoplaySpeed: 3000,
        prevArrow:
            '<button class="slide-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
        nextArrow:
            '<button class="slide-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        responsive: [
            {
                breakpoint: 1367,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: false,
                },
            },
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: false,
                },
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: false,
                },
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: false,
                },
            },
            {
                breakpoint: 430,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: false,
                },
            },
        ],
    });
    // Casino Page Filter Slider Start
    jQuery(".casino-filter-slider").slick({
        slidesToShow: 8,
        slidesToScroll: 1,
        infinite: false,
        dots: true,
        draggable: true,
        variableWidth: true,
        arrows: false,
        autoplay: false,
        autoplaySpeed: 3000,
        rows: 0,
        swipeToSlide: true,
        prevArrow:
            '<button type="button" class="slide-arrow prev-arrow"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
        nextArrow:
            '<button type="button" class="slide-arrow next-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        responsive: [
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    arrows: false,
                },
            },
        ],
    });

    // Casino Page Filter Slider End

    jQuery("body").on("click", ".casino-dropdown", function () {
        jQuery(this).toggleClass("casino-dropdown-open");
    });

    jQuery("body").on("click", ".button-popup-link", function () {
        var popup_id = jQuery(this).attr("data-id");
        jQuery("#" + popup_id).fadeIn();
    });

    jQuery("body").on("click", ".common-popup .popup-close-icon", function () {
        jQuery(this).closest(".common-popup").fadeOut();
    });

    /** Password Change Start */
    jQuery("body").on("submit", "#pwd-change-from", function () {
        vali_pwd();
        jQuery("#pwd-change-from").valid();
        var pwd = jQuery("#ch_pwd").val();
        var pwd_confirm = jQuery("#ch_confirm_pwd").val();

        if (jQuery("#pwd-change-from").valid()) {
            jQuery(".loader-box .change-pass-loader").fadeIn();
            var currentRequest = "";
            currentRequest = $.ajax({
                type: "POST",
                url: custom_call.ajaxurl,
                data: {
                    action: "pwd_change",
                    password: pwd,
                    password_confirm: pwd_confirm,
                },
                dataType: "text",
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
            });
        }
        return false;
    });
    function vali_pwd() {
        var validator = jQuery("#pwd-change-from").validate({
            rules: {
                password: "required",
                password_confirm: {
                    equalTo: "#ch_pwd",
                },
            },
            messages: {
                password: " Enter Password",
                password_confirm: " Enter Confirm Password Same as Password",
            },
        });
        if (validator.form()) {
            jQuery("#pwd-change-from .error").css("display", "none");
        }
        return false;
    }
    /** Password Change End */

    /** First Visit Popup JS Start  */
    let firstvisit = getCookie("firstvisit");
    if (firstvisit == "") {
        if (!jQuery(".cusino-video-popup").hasClass("popup-disable")) {
            jQuery(".cusino-video-popup").fadeIn();
            setCookie("firstvisit", "1", 365);
        }
    }
    jQuery("body").on("click", ".video-close-icon", function () {
        jQuery(".cusino-video-popup").fadeOut();
        setCookie("firstvisit", "1", 365);
    });
    /** First Visit Popup JS End  */

    /** My Account Wallet transition Table sorting Start */

    jQuery("body").on("change", ".data-sort-option select", function () {
        jQuery(".data-sort-option").submit();
    });
    /** My Account Wallet transition Table sorting end */

    /** setCookie and getCookie Function */
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(";");
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == " ") {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    /**
     * reCaptcha v2 script
     */
    let captchaSrc = "https://www.google.com/recaptcha/api.js?hl=";

    jQuery.ajax({
        type: "POST",
        url: custom_call.ajaxurl,
        data: {
            action: "language_code",
        },
        async: false,
        success: function (data) {
            d = document.createElement("script");
            jQuery(d)
                .addClass("recaptchav2")
                .attr("src", captchaSrc + data)
                .appendTo("head");
        },
    });
});
function update_balance_using_interval() {
    myInterval = setInterval(function () {
        var currentRequest = null;
        currentRequest = $.ajax({
            type: "POST",
            url: custom_call.ajaxurl,
            data: {
                action: "current_user_balance",
            },
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (response) {
                if (jQuery.trim(response) != 0) {
                    jQuery("body .header-wallet-balance").html(response);
                }
            },
        });
    }, 8000);
}

/**
 * My account - transactions informations
 */
jQuery(document).on("click", ".show-transaction-info", function () {
    if (jQuery(this).hasClass("active")) {
        jQuery(this).siblings(".transaction-details").fadeOut(500);
        jQuery(this).siblings(".bet-events-div").fadeOut(500);
        jQuery(this).removeClass("active").text("Show Details");
        jQuery(this)
            .siblings(".transaction-details")
            .find("td.transaction-bet-event")
            .removeClass("active")
            .text("Show Events");
    } else {
        jQuery(this).siblings(".transaction-details").fadeIn(500);
        jQuery(this).addClass("active").text("Hide Details");
    }
});

/**
 * My account - bet events
 */
jQuery(document).on("click", ".transaction-bet-event", function () {
    const id = $(this).attr("data-id");
    if (jQuery(this).hasClass("active")) {
        jQuery(`.bet-${id}`).hide();
        jQuery(this).removeClass("active").text("Show Events");
    } else {
        jQuery(`.bet-${id}`).show();
        jQuery(this).addClass("active").text("Hide Events");
    }
});

/**
 * Active bonus code form
 */
$(document).on("submit", "form#active-bonus-code-form", function (e) {
    const bonus = $(".bonus-code-input").val();

    if (bonus.trim().length === 0) {
        $("#active-bonus-code-form .error-msg").text("Please add bonus code").show();
        return false;
    } else {
        $("#active-bonus-code-form .error-msg").hide();
    }

    $.ajax({
        url: custom_call.ajaxurl,
        type: "POST",
        data: {
            action: "active_bonus_form",
            bonusCode: bonus,
        },
        success: function (response) {
            response = JSON.parse(response);
            if (response.status === "error") {
                $("#active-bonus-code-form .succuss-msg").hide();
                $("#active-bonus-code-form .error-msg").text(response.message).show();
            } else {
                $("#active-bonus-code-form .error-msg").hide();
                $("#active-bonus-code-form .succuss-msg").text(response.message).show();
                setTimeout(function () {
                    location.reload();
                }, 3000);
            }
        },
    });
    e.preventDefault();


});
