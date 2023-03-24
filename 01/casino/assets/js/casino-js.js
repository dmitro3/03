jQuery(document).ready(function () {
    jQuery(".reset-filters").on("click", function () {
        jQuery("input[type=checkbox]").each(function () {
            jQuery(this).removeAttr("checked");
        });

        jQuery(".group-item ul li a").removeClass("active-type");
        jQuery(".group-item ul .game-type-all a").addClass("active-type");
        jQuery("input[name=gametype]").remove();
    });

    function gameTypeListSlick() {
        return {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: false,
            dots: false,
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
        };
    }

    jQuery(".game-type-list").slick(gameTypeListSlick());

    // var ajaxurl = jQuery(".game-load-more").attr("data-ajaxurl");

    var ajaxurl = jQuery("#ajaxurl").val();
    jQuery(".providers-filter__button").on("click", function () {
        jQuery(".providers-filter").toggleClass("filter-show");
    });

    jQuery(".game-search-icon").on("click", function () {
        jQuery(this).parent().toggleClass("search-show");
    });

    jQuery(".game-search__clear").on("click", function () {
        jQuery(".game-search__input--field").val("");
    });

    jQuery(".reset-filters").on("click", function () {
        jQuery("input[type=checkbox]").each(function () {
            jQuery(this).removeAttr("checked");
        });
    });

    jQuery(".close-game-popup").click(function () {
        jQuery(".game-popup-wrap").hide();
        jQuery("#game-tvbet-popup-inner").html("");
        jQuery(".fancybox-iframe").attr("src", "about:blank");
        jQuery(".fancybox-iframe").hide();

        var currentRequest = null;
        currentRequest = $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "current_user_balance",
            },
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (response) {
                update_wallet_balance("stop");

                if (jQuery.trim(response) != 0) {
                    jQuery("body .header-wallet-balance").html(response);
                }
            },
        });
    });

    if (jQuery("#pokerGame").hasClass("poker-iframe")) {
        update_wallet_balance("start");
    }
    var myInterval;
    function update_wallet_balance(Intervalupdate) {
        if (Intervalupdate == "start") {
            update_balance_using_interval();
        } else {
            clearInterval(myInterval);
        }
    }

    // Agere game Ajax

    jQuery("body").on("click", ".play-url-agere-game", function () {
        jQuery(".game-popup-wrap").show();

        var gameid = jQuery(this).attr("data-gameid");
        var provider = jQuery(this).attr("data-provider");
        var server_url = jQuery(this).attr("data-server");
        var providergameid = jQuery(this).attr("data-providergameid");
        var game_url = jQuery(this).attr("data-gameURL");
        var mode = jQuery(this).attr("data-mode");
        var type = jQuery(this).attr("data-type");
        var casino = jQuery(this).attr("data-casino");
        var token = jQuery(this).attr("data-token");

        if (mode == "online") {
            update_wallet_balance("start");
        }

        jQuery("#full-screen").attr("data-gameid", gameid);

        var data = {
            action: "free_play_agere_game_action",
            gameid: gameid,
            provider: provider,
            server_url: server_url,
            providergameid: providergameid,
            game_url: game_url,
            casino: casino,
            token: token,
            mode: mode,
        };

        jQuery.post(ajaxurl, data, function (response) {
            // console.log(response);

            var responseobj = jQuery.parseJSON(response);
            // console.log("responseobj ", responseobj);
            console.log("success ", responseobj.success);

            if (responseobj.error) {
                jQuery(".game-popup-inner").append("<strong>" + responseobj.error + "</strong>");
            } else {
                if (provider == 3 && type == "Live Games") {
                    jQuery(".fancybox-iframe").attr("allowfullscreen", true);
                    jQuery(".fancybox-iframe").attr("webkitallowfullscreen", true);
                    jQuery(".fancybox-iframe").attr("mozallowfullscreen", true);
                } else {
                    jQuery(".fancybox-iframe").removeAttr("allowfullscreen");
                    jQuery(".fancybox-iframe").removeAttr("webkitallowfullscreen");
                    jQuery(".fancybox-iframe").removeAttr("mozallowfullscreen");
                }

                jQuery(".fancybox-iframe").attr("src", responseobj.success);
                jQuery(".fancybox-iframe").show();
                // if (mode == "online") {

                // }
            }
        });
    });

    jQuery("#full-screen").on("click", function () {
        GoInFullscreen(jQuery(".game-popup-inner").get(0));
    });

    /** TVbet game type AJax Call Start */
    jQuery("body").on("click", ".play-url-agere-game-is_tvbet", function () {
        jQuery(".game-popup-wrap").show();
        jQuery(".fancy-loader-wrap").show();

        var gameid = jQuery(this).attr("data-gameid");
        var provider = jQuery(this).attr("data-provider");
        var providergameid = jQuery(this).attr("data-providergameid");
        var server_url = jQuery(this).attr("data-server");
        var mode = jQuery(this).attr("data-mode");
        jQuery("#full-screen").attr("data-gameid", gameid);

        var data = {
            action: "free_play_tvbet_game_action",
            gameid: gameid,
            provider: provider,
            providergameid: providergameid,
            server_url: server_url,
            mode: mode,
        };
        jQuery.post(ajaxurl, data, function (response) {
            new TvbetFrame({
                lng: "en",
                clientId: 4619,
                game_id: providergameid,
                token: response,
                server: "https://tvbetframe10.com",
                floatTop: "#fTop",
                containerId: "game-tvbet-popup-inner",
            });
            jQuery(".fancy-loader-wrap").hide();
        });
    });

    /** TVbet game type AJax Call End */

    /** scroll to load more game Start */
    window.addEventListener("scroll", function () {
        var element = document.querySelector(".game-load-more");
        var position = element.getBoundingClientRect();

        // checking for partial visibility
        if (position.top < window.innerHeight && position.bottom >= 0) {
            var abort = jQuery(".game-load-more").attr("data-abort");
            if (abort == 1) {
                jQuery(".game-load-more").trigger("click");
                jQuery(".game-load-more").attr("data-abort", 0);
            }
        }
    });
    /** scroll to load more game End */

    /** Load More Button click Start */
    jQuery("body").on("click", ".game-load-more", function (e) {
        var pageno = jQuery(this).attr("data-page");
        var provider = jQuery(this).attr("data-provider");
        var gametype = jQuery(this).attr("data-gametype");
        var gametypeSecondary = jQuery(this).attr("data-gameTypeSecondary");
        var abort = jQuery(this).attr("data-abort");
        var innerpage = jQuery(this).attr("data-innerpage");

        if ($("body").hasClass("featured-casino")) {
            var providerType = "featured";
        }

        var search_string = jQuery(".game-provider-ser").val();

       
        if(innerpage === 'slots') gametype = 'slots';
        

        jQuery(".load-more-div .ajax-loader").css("display", "inline-block");
        if (pageno == 0 && abort == 0) {
            jQuery(".load-more-div .ajax-loader").fadeOut();
            return false;
        }

        var currentRequest = null;
        currentRequest = $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "casino_load_more_game_list",
                no:1,
                pageno: pageno,
                provider: provider,
                gametype: gametype,
                gametypeSecondary: gametypeSecondary,
                search: search_string,
                innerpage: innerpage,
                providerType: providerType,
            },
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (response) {
                if (jQuery.trim(response) != 0) {
                    if (jQuery.trim(response) == "skipgame") {
                        jQuery(".game-load-more").attr("data-page", parseInt(pageno) + 1);
                        jQuery(".game-load-more").attr("data-abort", 1);
                        jQuery(".game-load-more").trigger("click");
                    } else {
                        jQuery(".game-wrap").append(response);
                        jQuery(".game-load-more").attr("data-page", parseInt(pageno) + 1);
                        jQuery(".game-load-more").attr("data-abort", 1);
                    }
                } else {
                    jQuery(".game-load-more").attr("data-page", 0);
                    jQuery(".game-load-more").fadeOut();
                }
                jQuery(".load-more-div .ajax-loader").fadeOut();
            },
        });
    });
    /** Load More Button click End */

    /** Game Type Sort AJAX Call JS Start  */
    jQuery("body").on("click", ".game-type-list li ", function () {
        jQuery(".game-type-list li a").removeClass("active-type");
        jQuery(this).find("a").addClass("active-type");
        var pageno = "";
        var gametype = jQuery(this).attr("data-gametype");

        var innerpage = jQuery(".game-load-more").attr("data-innerpage");
        jQuery(".game-load-more").attr("data-gametype", gametype);

        jQuery(".game-load-more").attr("data-gametype", gametype);
        if (gametype == "all") {
            var gametype = "";
        }
        if(innerpage === 'live') gametype = 'LiveGames';
       
       
        if(innerpage === 'slots') gametype = 'slots';
        

        var gametypeSecondary = jQuery(this).attr("data-gameTypeSecondary");
        jQuery(".game-load-more").attr("data-gameTypeSecondary", gametypeSecondary);
        if(gametypeSecondary === 'all') gametypeSecondary = '';

        var provider = "";
       
        var providerattr = jQuery(".game-load-more").attr("data-provider");
        if (typeof providerattr !== typeof undefined && providerattr !== false) {
            provider = jQuery(".game-load-more").attr("data-provider");
        }
        var search_string = jQuery(".game-provider-ser").val();

        jQuery(".from-loader-box .from-loader").css("display", "inline-block");
        var currentRequest = null;
        currentRequest = $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "casino_load_more_game_list",
                no: 2,
                gametype: gametype,
                gametypeSecondary: gametypeSecondary,
                provider: provider,
                search: search_string,
            },

            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },

            success: function (response) {
                if (jQuery.trim(response) != 0) {
                    jQuery(".game-wrap").html(response);
                    jQuery(".game-load-more").attr("data-page", 2);
                    jQuery(".game-load-more").attr("data-abort", 1);
                } else {
                    jQuery(".game-wrap").html("");
                }
                jQuery(".from-loader-box .from-loader").fadeOut();
            },
        });
    });
    /** Game Type Sort AJAX Call JS End  */

    /** Game Search AJAX Call JS Start */
    jQuery("body").on("submit", ".gameSearch", function (e) {
        e.preventDefault()
        var search_string = jQuery(".game-provider-ser").val();

        var pageno = "";
        var gametype = "";
        var provider = "";
        var gametypeSecondary = "";

        var innerpage = jQuery(".game-load-more").attr("data-innerpage");
        var providerattr = jQuery(".game-load-more").attr("data-provider");
        if (typeof providerattr !== typeof undefined && providerattr !== false) {
            provider = jQuery(".game-load-more").attr("data-provider");
        }

        var gametypeattr = jQuery(".game-load-more").attr("data-gametype");
        if (typeof gametypeattr !== typeof undefined && gametypeattr !== false) {
            gametype = jQuery(".game-load-more").attr("data-gametype");
        }
        if (gametype == "all") {
            var gametype = "";
        }
        
       
        if(innerpage === 'slots') gametype = 'slots';
        

        var gametypeSecondary = jQuery(".game-load-more").attr("data-gameTypeSecondary");
        jQuery(".game-load-more").attr("data-gameTypeSecondary", gametypeSecondary);
        if(gametypeSecondary === 'all') gametypeSecondary = '';

        jQuery(".from-loader-box .from-loader").css("display", "inline-block");


        // var currentRequest = null;
        // currentRequest = $.ajax({
        //     type: "POST",
        //     url: ajaxurl,
        //     data: {
        //         action: "casino_game_type",
        //         no: 3,
        //         provider: provider,
        //         gametype: gametype,
        //         gametypeSecondary: gametypeSecondary,
        //         search: search_string,
        //     },
        //     // beforeSend: function () {
        //     //     if (currentRequest != null) {
        //     //         currentRequest.abort();
        //     //     }
        //     // },
        //     // success: function (response) {
        //     //     if (jQuery.trim(response) != 0) {
        //     //         jQuery(".game-wrap").html(response);
        //     //         jQuery(".game-load-more").attr("data-page", 2);
        //     //         jQuery(".game-load-more").attr("data-abort", 1);
        //     //     } else {
        //     //         jQuery(".game-wrap").html("");
        //     //     }
        //     //     jQuery(".from-loader-box .from-loader").fadeOut();
        //     // },
        // });
        
        var currentRequest = null;
        currentRequest = $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "casino_load_more_game_list",
                no: 3,
                provider: provider,
                gametype: gametype,
                gametypeSecondary: gametypeSecondary,
                search: search_string,
            },
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (response) {
                if (jQuery.trim(response) != 0) {
                    jQuery(".game-wrap").html(response);
                    jQuery(".game-load-more").attr("data-page", 2);
                    jQuery(".game-load-more").attr("data-abort", 1);
                } else {
                    jQuery(".game-wrap").html("");
                }
                jQuery(".from-loader-box .from-loader").fadeOut();
            },
        });

        return false;
    });
    /** Game Search AJAX Call JS End  */

    /** Game Sort By provider AJAX Call JS Start */
    jQuery(".provider-checkbox, .featured-provider-checkbox").change(function () {
        var providerType = $(this).attr("data-provider");
        if ("featured" === providerType) {
            var gameProviderName = "featured-provider";
            $("body").addClass("featured-casino");
            $(".game-type-list").parent().hide();
        } else {
            var gameProviderName = "provider";
            $("body").removeClass("featured-casino");
            $(".game-type-list").parent().show();
        }

        if ($("body").hasClass("featured-casino")) {
            providerType = "featured";
        }

        if (jQuery(this).is(":checked")) {
            var checkedNum = jQuery('input[name="' + gameProviderName + '[]"]:checked').length;
            var provider = "";
            if (checkedNum == 1) {
                var provider = jQuery(this).val();
                provider = "&provider=" + provider;
            } else {
                var val = [];
                jQuery('input[name="' + gameProviderName + '[]"]:checked').each(function (i) {
                    val[i] = jQuery(this).val();
                });
                provider = "&provider=" + val.join(",");
            }
            jQuery(".game-load-more").attr("data-provider", provider);
        } else {
            // var checkedNum = jQuery('input[name="'+ gameProviderName + '[]"]:checked').length;
            // var provider = "";
            // if (checkedNum == 1) {
            //     var provider = jQuery(this).val();
            //     provider = '&provider=' + provider;
            // } else {

            //     var val = [];
            //     jQuery('input[name="'+ gameProviderName + '[]"]:checked').each(function (i) {
            //         val[i] = jQuery(this).val();
            //     });
            //     provider = '&provider=' + val.join(",");
            // }
            var val = [];
            jQuery('input[name="' + gameProviderName + '[]"]:checked').each(function (i) {
                val[i] = jQuery(this).val();
            });
            provider = "&provider=" + val.join(",");
            // console.log(provider);
            // var provider = "";
            jQuery(".game-load-more").removeAttr("data-provider");
            jQuery(".game-load-more").attr("data-provider", provider);
        }

        var pageno = "";
        var gametype = "";

        var gametypeattr = jQuery(".game-load-more").attr("data-gametype");
        var innerpage = jQuery(".game-load-more").attr("data-innerpage");

        if (typeof gametypeattr !== typeof undefined && gametypeattr !== false) {
            gametype = jQuery(".game-load-more").attr("data-gametype");
        }

       
        if(innerpage === 'slots') gametype = 'slots';
        
 
        var gametypeSecondary = jQuery('.game-load-more').attr("data-gameTypeSecondary");
        jQuery(".game-load-more").attr("data-gameTypeSecondary", gametypeSecondary);
        if(gametypeSecondary === 'all') gametypeSecondary = '';

        var search_string = jQuery(".game-provider-ser").val();

        jQuery(".from-loader-box .from-loader").css("display", "inline-block");

        var currentRequest = null;

        console.log('frsvgsvvv', ajaxurl);

        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "casino_game_provider",
                provider: provider,
                gametype: gametype,
                search: search_string,
                innerpage: innerpage,
                providerType: providerType,
            },
            success: function (response) {
                $(".game-type-list").slick("unslick");
                $(".game-type-list").html(response);
                $(".game-type-list").slick(gameTypeListSlick());
            },
        });

        currentRequest = $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "casino_load_more_game_list",
                no: 4,
                provider: provider,
                gametype: gametype,
                gametypeSecondary: gametypeSecondary,
                search: search_string,
                innerpage: innerpage,
                providerType: providerType,
            },
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (response) {
                if (jQuery.trim(response) != 0) {
                    if (jQuery.trim(response) == "skipgame") {
                        jQuery(".game-load-more").attr("data-page", 2);
                        jQuery(".game-load-more").attr("data-abort", 1);
                        jQuery(".game-wrap").html("");
                    } else {
                        jQuery(".game-wrap").html(response);
                        jQuery(".game-load-more").attr("data-page", 2);
                        jQuery(".game-load-more").attr("data-abort", 1);
                    }

                    // jQuery(".game-wrap").html(response);
                    // jQuery(".game-load-more").attr('data-page', 2);
                    // jQuery(".game-load-more").attr('data-abort', 1);
                } else {
                    jQuery(".game-wrap").html("");
                }
                jQuery(".from-loader-box .from-loader").fadeOut();
            },
        });
    });
    /** Game Sort By provider AJAX Call JS End */
});
