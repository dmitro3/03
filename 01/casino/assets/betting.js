function addToCart(href1) {
    $.get(href1, function() {
        location.reload(true);
    });
}

function RemoveCart(href) {
    $.get(href, function() {
        location.reload(true);
    });
}

$(".stake_input").keyup(function() { //Dynamically updates the amounts shown below the input fields to reflect the values entered by the user
    var juice = $(this).parent().attr('data-juice');
    if (Math.sign(juice) == -1) {
        var risk = juice * ($(this).val() / 100);
        $(this).prev().val(Math.abs(risk).toFixed(2));
    } else {
        var risk = 1 * $(this).val() / (juice / 100);
        $(this).prev().val(Math.abs(risk).toFixed(2));
    }

    var sum = 0;
    $('.risk_input').each(function() {
        sum = sum + Number($(this).val());
    });
    $('#risk').html(sum.toFixed(2));
    $('#risk_total').val(sum.toFixed(2));

    var sum = 0;
    $('.stake_input').each(function() {
        sum = sum + Number($(this).val());
    });
    $('#total').html(sum.toFixed(2));
    $('#win_total').val(sum.toFixed(2));
});

$(".risk_input").keyup(function() {
    var juice = $(this).parent().attr('data-juice');
    if (Math.sign(juice) == 1) {
        var risk = juice * ($(this).val() / 100);
        $(this).next().val(Math.abs(risk).toFixed(2));
    } else {
        var win = $(this).val() / (juice / 100);
        $(this).next().val(Math.abs(win).toFixed(2));

    }
    var sum = 0;
    $('.risk_input').each(function() {
        sum = sum + Number($(this).val());
    });
    $('#risk').html(sum.toFixed(2));
    $('#risk_total').val(sum.toFixed(2));

    var sum = 0;
    $('.stake_input').each(function() {
        sum = sum + Number($(this).val());
    });
    $('#total').html(sum.toFixed(2));
    $('#win_total').val(sum.toFixed(2));

    document.cookie = "total_stake=1";
});

function replace() {
    jQuery("#empty_message").show();
    jQuery(".loader-wrap").show();
    var ajaxurl = jQuery("#remove_button").attr("ajax-url");
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: { "action": "clear_cart_custom" },
        success: function(data) { location.reload(); }
    });

}
jQuery('.add_cart_link_01').click(function(e) {
    e.preventDefault();
    jQuery(".loader-wrap").show();
    var ajaxurl = jQuery(this).attr('data-href');
    // console.log(ajaxurl);
    window.location.href = ajaxurl;

    // jQuery.ajax({
    //     type: 'POST',
    //     url: ajaxurl,
    //     success: function(data) {
    //         location.reload();
    //     }
    // });

    return false;
});