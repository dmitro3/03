var ajaxurl = jQuery(".main-page-ajax-url").val();
/**
 * Featured provider to the casino page
 */
jQuery(document).on('click', '.featured-providers-main .featured-provider-list', function(event) {
    const featuredProviderId = $(this).children('label').attr('data-featured-id');
    const casinoPage = $('.casino-page-url').val();
    
    localStorage.setItem('featured-provider-id', featuredProviderId);
    window.location.href = casinoPage;
});

/**
 * Play featured games
 */
jQuery("body").on("click", ".play-url-agere-game", function () {
    jQuery(".game-popup-wrap").show();
    var ajaxurl = jQuery(".main-page-ajax-url").val();
    // var ajaxurl = jQuery(".game-load-more").attr("data-ajaxurl");
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
        console.log(response);

        var responseobj = jQuery.parseJSON(response);
        console.log("responseobj ", responseobj);
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

jQuery("#full-screen").on("click", function () {
    GoInFullscreen(jQuery(".game-popup-inner").get(0));
});