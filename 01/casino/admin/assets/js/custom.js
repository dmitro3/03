
$(document).ready(function () {
    jQuery(document).on('click', '.menu-toggle', function() {
        jQuery('body').toggleClass('sidebar_open');
    });

    jQuery(document).on('click', '.collapse_menu', function() {
        jQuery('body').toggleClass('collapse-menu-active');
    });

    jQuery("body").on("click", "#change-language .trp-language-switcher-container", function () {
        // console.log("click event");
        jQuery(this).toggleClass("language-switcher-active");
    });

    var ajaxurl = jQuery("input[name=ajaxurl]").attr("data-ajaxurl");
    setTimeout(function () {
        $('body [data-button-toggle="tooltip"]').tooltip({
            trigger: "hover",
            html: true
        });
    }, 2000);

    function contactSupportFormImages() {
        const files = jQuery('.contact_support_form #attach_proof')[0].files;
        jQuery('.contact-support-image-count').text(`${files.length} image${files.length > 1 ? 's' : ''}`);

        if(files.length > 5) {
            jQuery('.error-msg.contact-support-image-err').text('You can attach up to 5 images').show();
            jQuery('.contact-support-image-count').css('color', 'red');
            return false;
        } else {
            jQuery('.error-msg.contact-support-image-err').text('').hide();
            jQuery('.contact-support-image-count').css('color', 'white');
        }

        jQuery.each( files, function( index, key ) {
            const fileName = key.name;
            const fileSize = key.size / 1024 / 1024;
            const fileExtension = fileName.split('.').pop().toLowerCase();

            if(jQuery.inArray(fileExtension, ['jpg', 'jpeg', 'png']) === -1) {
                jQuery('.error-msg.contact-support-image-err').text('Allowed file types are JPG, JPEG or PNG').show();
                return false;
            } else {
                jQuery('.error-msg.contact-support-image-err').text('').hide();
            }
            if (fileSize > 4) {
                jQuery('.error-msg.contact-support-image-err').text('Maximum 4 MB file size allowed per image').show();
                return false;
            } else {
                jQuery('.error-msg.contact-support-image-err').text('').hide();
            }
        });
    }

    jQuery('.contact_support_form #attach_proof').on('change', function() {
        contactSupportFormImages();
    });

    jQuery(document).on('submit', '.contact_support_form', function(event) {
        // initContactForm();
        // const subject = jQuery(".contact_support_form input[name=contact-support-subject]").val();
        // const message = jQuery(".contact_support_form textarea[name=contact-support-message]").val();
        const images = jQuery(".contact_support_form #attach_proof")[0].files;
        // let subjectError = messageError = false;

        // if( jQuery.trim(subject) == '' ) {
        //     jQuery('.error-msg.contact-support-subject-err').show();
        //     subjectError = true;
        // } else {
        //     jQuery('.error-msg.contact-support-subject-err').hide();
        //     subjectError = false;
        // }

        // if( jQuery.trim(message) == '' ) {
        //     jQuery('.error-msg.contact-support-message-err').show();
        //     messageError = true;
        // } else {
        //     jQuery('.error-msg.contact-support-message-err').hide();
        //     messageError = false;
        // }

        // if(subjectError && messageError) return false;
        contactSupportFormImages();

        // const formData = new FormData();
        // formData.append('subject', subject);
        // formData.append('message', message);
        // formData.append('action', 'contact_support_form');
        // jQuery.each( images, function( i, values ) {
        //     formData.append('files[]', values);
        // });

        // jQuery.ajax({
        //     type: 'POST',
        //     url: ajaxurl,
        //     data: formData,
        //     contentType: false,
        //     processData: false,
        //     success: function(response) {
        //         console.log(response);
        //     }
        // });
        // event.preventDefault();
    });

    if (window.location.href.indexOf("#wpcf7") > -1) {
        jQuery('body .contact-support-button').trigger('click');
    }

    /** Login Player & Agent Start */
    jQuery("body").on("submit", ".login__form", function (e) {
        var username = jQuery(".login__form input[name=username]").val();
        var password = jQuery(".login__form input[name=password]").val();

        var currentRequest = null;
        currentRequest = $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "casino_admin_login",
                username: username,
                password: password,
            },
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (response) {
                if (response == 1) {
                    location.reload();
                } else {
                    jQuery("body .login__form .error-msg").text(response);
                    jQuery("body .login__form .error-msg").css("display", "block");
                }
            },
        });

        return false;
        e.preventDefault();
    });
    /** Login Player & Agent End */

    /** Sidebar Sub Menu */
    jQuery("body").on("click", ".sidebar_sub_menu", function () {
        if (jQuery(this).hasClass("current_menu_active")) {
            // console.log("if con true");
            jQuery(this).next("ul").find("li").removeClass("nav_menu_open");
            jQuery(this).next("ul").find("a").removeClass("current_menu_active");
            jQuery(this).removeClass("current_menu_active");
            jQuery(this).closest(".sub_menu_li").removeClass("nav_menu_open");
        } else {
            if (jQuery(this).next("ul")) {
                jQuery(this).addClass("current_menu_active");
                jQuery(this).closest(".sub_menu_li").addClass("nav_menu_open");
                // jQuery(this).next("ul").addClass("active_sub_menu");
            } else {
                jQuery(this).next("ul").find("li").removeClass("nav_menu_open");
                jQuery(this).next("ul").find("a").removeClass("current_menu_active");
                jQuery(this).removeClass("current_menu_active");
                jQuery(this).closest(".sub_menu_li").removeClass("nav_menu_open");
                // jQuery(this).nextAll("ul").removeClass("active_sub_menu");
            }
        }
    });

    /** Click for Check All checkbox  */
    jQuery("body").on("click", ".vr_ck_everyone", function () {
        jQuery(this)
            .closest(".form_chechbox-sec")
            .find(".form_short-list-ck input[type=checkbox]")
            .not(this)
            .prop("checked", this.checked);
    });

    /** Remove All checkbox Checked */
    jQuery("body").on("click", "input[type=checkbox]", function () {
        if (!jQuery(this).hasClass("vr_ck_everyone")) {
            jQuery(this)
                .closest(".form_chechbox-sec")
                .find(".form_chocbox-header .vr_ck_everyone")
                .prop("checked", false);
        }
    });

    /** Add Commissions in all */
    jQuery("body").on("keyup", "input[name=everyone_commission]", function () {
        jQuery(this).closest(".all-commission-main-box").find("input[type=number]").val(jQuery(this).val());
    });

    /** Show & Hide Password  */
    jQuery("body").on("click", ".form_input_wp .fa-eye-slash", function () {
        jQuery(this).attr("class", "fal fa-eye");
        jQuery(this).next("input[type=text]").attr("type", "password");
    });
    jQuery("body").on("click", ".form_input_wp .fal.fa-eye", function () {
        jQuery(this).attr("class", "fal fa-eye-slash");
        jQuery(this).next("input[type=password]").attr("type", "text");
    });

    /** New User Modal Tabbing */
    jQuery("body").on("click", ".modal-content .modal_tablist ul li", function () {
        jQuery(this).closest(".modal-content").find(".modal_tablist ul li").removeClass("active_modal_tab");
        jQuery(this).addClass("active_modal_tab");
        var tab = jQuery(this).data("tab");
        jQuery(this).closest(".modal-content").find(".modal-from-section").css("display", "none");
        jQuery(this)
            .closest(".modal-content")
            .find("." + tab + "-sec")
            .show();
    });

    /**
     * Copy to clipboard
     */
    jQuery(document).on('click', '.generated-referral-link-icon-button', function() {
        var copyText = document.getElementById("generated-referral-link-input");

        // Select the text field
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
      
         // Copy the text inside the text field
        navigator.clipboard.writeText(copyText.value);

        jQuery(this).attr('title', 'Copied!');

        $('.generated-referral-link-icon-button[data-button-toggle="tooltip"]').tooltip('dispose');
        $('.generated-referral-link-icon-button[data-button-toggle="tooltip"]').tooltip();
    });

    /**
     * Create Referral Limnk
     */
    jQuery("body").on("submit", "#create_referral_link", function (event) {
        event.preventDefault;
        
        const referralSettlementType = jQuery(this).find("select[name=settlement_type]").val();
        const referralCommission = jQuery(this).find("input[name=referral_commission]").val();
        const referralCommissionLink = jQuery(this).find("input[name=referral_link]").val();
        const referralLink = jQuery(this).find("input[name=referral_link]").val();
        let referral_user_error = false;

        if(!('month' === referralSettlementType || 'week' === referralSettlementType)) {
            jQuery(this).find(".referral-settlement-type-err").css("display", "block");
            referral_user_error = true;
        } else {
            jQuery(this).find(".referral-settlement-type-err").css("display", "none");
        }

        if( referralCommission == '' ) {
            jQuery(this).find(".referral-commission-err").show();
            referral_user_error = true;
        } else {
            jQuery(this).find(".referral-commission-err").hide();
        }

        if( referralCommissionLink == '' ) {
            jQuery(this).find(".referral-commission-link-err").show();
            referral_user_error = true;
        } else {
            jQuery(this).find(".referral-commission-link-err").hide();
        }

        if( !referral_user_error ) {
            jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "create_referral_link",
                    referralCommission: referralCommission,
                    referralLink: referralLink,
                    settlement_type : referralSettlementType
                },
                // dataType: "text",
                beforeSend: function() {
                    jQuery(".load-more").fadeIn();
                },
                success: function (response) {
                    response = JSON.parse(response);
    
                    if(response.response === true) {
                        let anchor = $(document.createElement('a')).prop({
                            target: '_blank',
                            href: response.data,
                            innerText: response.data,
                            class: 'generated-referral-link-anchor'
                        });
                        
                        if (response.status === 'exists') {
                            jQuery('.generated-referral-link').hide();
                            jQuery('.generated-referral-link-anchor').removeAttr('href', '').text('');
                            jQuery('#generated-referral-link-input').val('');
                            jQuery('.response-referral-link').removeClass('success-msg').addClass('error-msg').html(response.message).show();
                        } else {
                            jQuery('.generated-referral-link').show();
                            jQuery('.generated-referral-link-anchor').attr('href', response.data).text(response.data);
                            jQuery('#generated-referral-link-input').val(response.data);
                            jQuery('.response-referral-link').removeClass('error-msg').addClass('success-msg').html(response.message).show();

                        }
                        jQuery('.referral-max-commission-err').hide();
                    } else {
                        jQuery('.error-msg').hide();
                        jQuery('.response-referral-link').hide(); 
                        jQuery('.generated-referral-link').hide();
                        jQuery('.referral-max-commission-err').text(response.message).show(); // response.message
                    }
                    jQuery(".load-more").fadeOut();
                },
                error: function () {
                    alert("There was an error while fetching the data.");
                },
            });
        } else {
            return false;
        }

        event.preventDefault();
    });

    /** Add New User AJAX */
    jQuery("body").on("submit", ".vr_add_user_from", function (event) {
        var username = jQuery(this).find("input[name=username]").val();
        var password = jQuery(this).find("input[name=password]").val();
        var useremail = jQuery(this).find("input[name=user_email]").val();
        var userrole = jQuery(this).find("input[name=user_role]").val();
        var userSettlementType = jQuery(this).find("select[name=settlement_type]").val();
        var commissionInput = jQuery(this).find("input[name='commission[casino]']").val();


        jQuery(".load-more").fadeIn();
        var err = 0;

        $this = jQuery(this);

        if (username != "") {
            jQuery(this).find(".vr-uname-err").css("display", "none");
            jQuery(this).closest(".modal-body").find("li[data-tab=entry]").removeClass("error-tab");
        } else {
            jQuery(this).find(".vr-uname-err").css("display", "block");
            jQuery(this).closest(".modal-body").find("li[data-tab=entry]").addClass("error-tab");
            err = 1;
        }

        if (password != "") {
            jQuery(this).find(".vr-pwd-err").css("display", "none");
            jQuery(this).closest(".modal-body").find("li[data-tab=entry]").removeClass("error-tab");
        } else {
            jQuery(this).find(".vr-pwd-err").css("display", "block");
            jQuery(this).closest(".modal-body").find("li[data-tab=entry]").addClass("error-tab");
            err = 1;
        }

        if (useremail != "") {
            jQuery(this).find(".vr-email-err").css("display", "none");
            jQuery(this)
                .closest(".modal-body")
                .find("li[data-tab=personal-information]")
                .removeClass("error-tab");
        } else {
            jQuery(this).find(".vr-email-err").css("display", "block");
            jQuery(this)
                .closest(".modal-body")
                .find("li[data-tab=personal-information]")
                .addClass("error-tab");
            err = 1;
        }

        if (userrole == "agent") {
        // var permission_ck = jQuery(".permission-sec .form_chechbox-sec-wp").find('input[type="checkbox"]:checked').length;
        // if (permission_ck != 0) {
        //     jQuery(this).find(".vr-permission-err").css("display", "none");
        //     jQuery(this).closest(".modal-body").find("li[data-tab=permission]").removeClass("error-tab");
        // } else {
        //     jQuery(this).find(".vr-permission-err").css("display", "block");
        //     jQuery(this).closest(".modal-body").find("li[data-tab=permission]").addClass("error-tab");
        //     err = 1;
        // }

        // var commission_error = 0;
        // jQuery(".permission-sec .form_chechbox-sec-wp").find('input[type="checkbox"]:checked').each(function () {
        //     var ck_val = $(this).val();
        //     var currGame_com = jQuery("input[name='commission[" + ck_val + "]']");
        //     var game_com = currGame_com.val();

        //     if (game_com != "") {
        //         currGame_com.removeClass('error-border');
        //     } else {
        //         currGame_com.addClass('error-border');
        //         commission_error = 1;
        //     }

        // });

        // if (commission_error != 0) {
        //     jQuery(this).closest(".modal-body").find("li[data-tab=commissions]").addClass("error-tab");
        //     err = 1;
        // } else {
        //     jQuery(this).closest(".modal-body").find("li[data-tab=commissions]").removeClass("error-tab");
        // }

        // var permission_ck = jQuery(".permission-sec .form_chechbox-sec-wp").find(
        //     'input[type="checkbox"]:checked'
        // ).length;
        // if (permission_ck != 0) {
        //     jQuery(this).find(".vr-permission-err").css("display", "none");
        //     jQuery(this).closest(".modal-body").find("li[data-tab=permission]").removeClass("error-tab");
        // } else {
        //     jQuery(this).find(".vr-permission-err").css("display", "block");
        //     jQuery(this).closest(".modal-body").find("li[data-tab=permission]").addClass("error-tab");
        //     err = 1;
        // }

        var commission_error = 0;
        var commission_type_error = 0;

        console.log(commissionInput);

        if (commissionInput != "") {
            jQuery(this).find("input[name='commission[casino]']").removeClass("error-border");
        } else {
            jQuery(this).find("input[name='commission[casino]']").addClass("error-border");
            commission_error = 1;
        }
        
        // if(jQuery(".permission-sec .form_chechbox-sec-wp").find('input[type="checkbox"]:checked').length > 0) {
            if(!('month' === userSettlementType || 'week' === userSettlementType)) {
                jQuery(this).find(".vr-commission-settlement-type-err").css("display", "block");
                commission_type_error = 1;
            } else {
                jQuery(this).find(".vr-commission-settlement-type-err").css("display", "none");
            }
        // }




        // jQuery(".commissions_modal_form .form_chechbox-sec-wp .error-border").removeClass("error-border");
        // jQuery(".permission-sec .form_chechbox-sec-wp")
        //     .find('input[type="checkbox"]:checked')
        //     .each(function () {
        //         var ck_val = $(this).val();
        //         var currGame_com = jQuery("input[name='commission[" + ck_val + "]']");
        //         var game_com = currGame_com.val();

        //         if (game_com != "") {
        //             if (game_com > 100) {
        //                 currGame_com.addClass("error-border");
        //                 commission_error = 1;
        //             } else {
        //                 currGame_com.removeClass("error-border");
        //             }
        //         } else {
        //             currGame_com.addClass("error-border");
        //             commission_error = 1;
        //         }
        //     });


        

        if (commission_error || commission_type_error) {
            jQuery(this).closest(".modal-body").find("li[data-tab=commissions]").addClass("error-tab");
            err = 1;
        } else {
            jQuery(this).closest(".modal-body").find("li[data-tab=commissions]").removeClass("error-tab");
        }

        }

        if (err == 0) {
            var form_data = $(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "add_new_user",
                    formdata: form_data,
                    userrole: userrole,
                },
                dataType: "text",
                success: function (response) {
                    // console.log(response);
                    var result = JSON.parse(response);

                    if (result.errors) {
                        result = result.errors;
                        if (result.existing_user_login) {
                            jQuery(".vr-uname-err").text(result.existing_user_login);
                            jQuery(".vr-uname-err").css("display", "block");
                        }
                        if (result.existing_user_email) {
                            jQuery(".vr-email-err").text(result.existing_user_email);
                            jQuery(".vr-email-err").css("display", "block");
                        }
                    } else {
                        jQuery(".vr_add_user_from").trigger("reset");

                        window.location.replace(jQuery(".vr_add_user_from").attr("action"));

                        return true;
                        // $this.find(".success-msg").css("display", "block");
                    }
                    jQuery(".load-more").fadeOut();
                },
                error: function () {
                    alert("There was an error while fetching the data.");
                },
            });
        } else {
            jQuery(".load-more").fadeOut();
        }

        event.preventDefault();

        return false;
    });
    /** Validation End */

    /**
     * User Page JS
     *
     * - Apply datatable with AJAX
     * -
     */
    /** User page user list datatable Start*/
    let superAdmin = jQuery('#super-admin-user').val();
    if(superAdmin === 'super-admin') {
        columnsData = [
            {
                data: "username",
                render: function (data, type, row, meta) {
                    return '<sapn class="' + data.role + '_user_column" >' + data.name + "</sapn>";
                },
            },
            { data: "user_id" },
            { data: "action" },
            { data: "info" },
        ];
    } else {
        columnsData = [
            {
                data: "username",
                render: function (data, type, row, meta) {
                    return '<sapn class="' + data.role + '_user_column" >' + data.name + "</sapn>";
                },
            },
            // { data: "user_id" }
        ];
    }

    var tab_html =
        '<div class="modal_tablist"><ul><li data-sort-value="everyone" class="active_modal_tab">Everyone</li><li data-sort-value="agent">Agents</li><li data-sort-value="player">Players</li><li data-sort-value="hidden">Hidden</li></ul></div>';
    var dataTable = $("#user_data").DataTable({
        dom: '<"table_filter_topbar" <"row align-items-center"<"col-sm-4"f><"col-sm-8"<"table_custom_filter"> >>>r <"responsive-table-scroll" t> <"table_filter_bottombar"<"row align-items-center"<"col-sm-3"l><"col-sm-9"p>>>',
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Username...",
            processing: '<i class="fad fa-spinner-third fa-spin"></i>',
        },
        ordering: false,
        processing: true,
        serverSide: true,
        serverMethod: "post",
        ajax: {
            url: ajaxurl + "?action=user_datatabel_data",
            data: function (data) {
                var sort_tab = $("body #user_data_wrapper .modal_tablist ul  .active_modal_tab").attr(
                    "data-sort-value"
                );
                var current_user = jQuery(".user_map .user_map_main_ul").attr("data-userid");

                data.sort_tab = sort_tab;
                data.current_user = current_user;
            },
        },
        columns: columnsData,
        pageLength: 10,
    });
    $("#user_data_filter input").addClass("form_input");
    $("div.table_custom_filter").html(tab_html);

    jQuery("body").on("click", "#user_data_wrapper .modal_tablist ul li", function () {
        if (jQuery(this).hasClass('active_modal_tab')) return;
        
        jQuery("body #user_data_wrapper .modal_tablist ul li").removeClass("active_modal_tab");
        jQuery(this).addClass("active_modal_tab");
        dataTable.draw(true);
        setTimeout(function () {
            $('body [data-button-toggle="tooltip"]').tooltip({
                trigger: "hover",
            });
        }, 1000);
    });
    /** User page user list datatable End*/

    /** User table show user information pop up */
    jQuery("body").on("click", ".modal-html-btn", function (e) {
        var user_id = jQuery(this).attr("data-user-id");
        var modal_name = jQuery(this).attr("data-target");

        if (jQuery(this).attr("data-loader") == 1) {
            jQuery(".common_page_loader").fadeIn();
        } else {
            jQuery(".dataTables_processing").fadeIn();
        }

        var currentRequest = null;
        currentRequest = $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "get_modal_html",
                user_id: user_id,
                modal_name: modal_name,
            },
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (response) {
                jQuery(".dataTables_processing").fadeOut();
                jQuery(".common_page_loader").fadeOut();

                if (response == "user_hide") {
                    dataTable.draw(true);
                    
                    setTimeout(function () {
                        $('body [data-button-toggle="tooltip"]').tooltip({
                            trigger: "hover",
                        });
                    }, 1000);
                } else {
                    jQuery("#" + modal_name + " .modal-body").html(response);
                    jQuery(".overflow-text").each((index, element) => new SimpleBar(element));
                    jQuery("#" + modal_name).modal("show");
                    $('[data-button-toggle="tooltip"]').tooltip({
                        trigger: "hover",
                    });
                }
            },
        });

        e.preventDefault();
        return false;
    });

    /** Credit and Debit modal increase & decrease value */
    jQuery("body").on("click", ".add_coin_group button", function () {
        var btn_val = jQuery(this).attr("data-value");
        jQuery(this).closest("form").find(".balance_input_group input[name=user_balance]").val(btn_val);
    });
    jQuery("body").on("click", ".btn-balance-increase-action", function () {
        var cur_user_balance = jQuery(this)
            .closest(".balance_input_group")
            .find("input[name=user_balance]")
            .val();
        jQuery(this)
            .closest(".balance_input_group")
            .find("input[name=user_balance]")
            .val(parseInt(cur_user_balance) + parseInt(50));
    });
    jQuery("body").on("click", ".btn-balance-decrease-action", function () {
        var cur_user_balance = jQuery(this)
            .closest(".balance_input_group")
            .find("input[name=user_balance]")
            .val();
        if (cur_user_balance > 0) {
            if (parseInt(cur_user_balance) - parseInt(50) > 0) {
                jQuery(this)
                    .closest(".balance_input_group")
                    .find("input[name=user_balance]")
                    .val(parseInt(cur_user_balance) - parseInt(50));
            } else {
                jQuery(this).closest(".balance_input_group").find("input[name=user_balance]").val(0);
            }
        }
    });

    jQuery("body").on("change", "input[name=register_charged]", function () {
        jQuery("body input[name=register_bonus]").prop("checked", false);
    });

    jQuery("body").on("change", "input[name=register_bonus]", function () {
        jQuery("body input[name=register_charged]").prop("checked", false);
    });

    /** Credit form submit ajax  */
    jQuery("body").on("submit", ".add_credit_form", function () {
        jQuery(this).find(".load-more").css("display", "inline-block");
        var balance = jQuery(this).find("input[name=user_balance]").val();
        var balance_action = jQuery(this).find("input[name=balance_action]").val();
        var err = 1;

        $this = jQuery(this);
        if (balance != 0) {
            err = 0;
        }

        if (err == 0) {
            var form_data = $(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "update_user_balance",
                    form_data: form_data,
                },
                dataType: "text",
                success: function (response) {
                    var result = JSON.parse(response);
                    jQuery(".add_credit_form").find(".load-more").css("display", "none");
                    if (result.current_user_balance) {
                        jQuery(".woo_current_user_balance").text(result.current_user_balance);

                        setTimeout(function () {
                            jQuery("body #add_" + balance_action + "_modal").modal("hide");
                        }, 200);
                        dataTable.draw(true);
                        setTimeout(function () {
                            $('body [data-button-toggle="tooltip"]').tooltip({
                                trigger: "hover",
                            });
                        }, 1000);
                    }
                    if (result.error) {
                        $this.find(".error-msg").text(result.error);
                        $this.find(".error-msg").css("display", "block");
                    }
                },
                error: function () {
                    alert("There was an error while update password.");
                },
            });
        } else {
            alert("There was an error while update balance.");
            jQuery(this).find(".load-more").css("display", "none");
        }

        event.preventDefault();

        return false;
    });

    /** Password Change AJax */
    jQuery("body").on(
        "submit",
        "#change_password .user_change_pwd_form,#main_change_password .user_change_pwd_form",
        function (event) {
            var new_pwd = jQuery("input[name=new_assword]").val();
            var confirm_pwd = jQuery("input[name=confirm_password]").val();
            var user_id = jQuery("input[name=user_id]").val();

            var err = 0;

            if (new_pwd != "") {
                jQuery(this).find(".vr-newpwd-err").css("display", "none");
            } else {
                jQuery(this).find(".vr-newpwd-err").text("Please enter password.");
                jQuery(this).find(".vr-newpwd-err").css("display", "block");
                err = 1;
            }

            if (confirm_pwd != "") {
                jQuery(this).find(".vr-conpwd-err").css("display", "none");
            } else {
                jQuery(this).find(".vr-conpwd-err").css("display", "block");
                err = 1;
            }

            if (err == 0) {
                if (new_pwd == confirm_pwd) {
                    jQuery(this).find(".vr-newpwd-err").css("display", "none");
                    jQuery.ajax({
                        type: "POST",
                        url: ajaxurl,
                        data: {
                            action: "change_user_password",
                            new_password: new_pwd,
                            user_id: user_id,
                        },
                        dataType: "text",
                        success: function (response) {
                            if (response == 0) {
                                jQuery(".pwd-success-msg").css("display", "block");
                                setTimeout(function () {
                                    jQuery("#change_password").modal("hide");
                                }, 500);
                            } else {
                                alert("There was an error while update password.");
                            }
                        },
                        error: function () {
                            alert("There was an error while update password.");
                        },
                    });
                } else {
                    jQuery(this).find(".vr-newpwd-err").text("Password and Confirm Password should be same.");
                    jQuery(this).find(".vr-newpwd-err").css("display", "block");
                }
            }

            event.preventDefault();

            return false;
        }
    );

    /** Edit User AJAX Start */
    jQuery("body").on("submit", ".vr_edit_user_from", function (event) {
        // console.log("vr_edit_user_from");
        var useremail = jQuery(this).find("input[name=user_email]").val();
        var userrole = jQuery(this).find("input[name=user_role]").val();
        var userSettlementType = jQuery(this).find("select[name=settlement_type]").val();
        var commissionInput = jQuery(this).find("input[name='commission[casino]']").val();

        var err = 0;
        $this = jQuery(this);

        if (useremail != "") {
            jQuery(this).find(".vr-email-err").css("display", "none");
            jQuery(this)
                .closest(".modal-body")
                .find("li[data-tab=personal-information]")
                .removeClass("error-tab");
        } else {
            jQuery(this).find(".vr-email-err").css("display", "block");
            jQuery(this)
                .closest(".modal-body")
                .find("li[data-tab=personal-information]")
                .addClass("error-tab");
            err = 1;
        }

        // if (userrole == "agent") {
        // var permission_ck = jQuery(".permission-sec .form_chechbox-sec-wp").find(
        //     'input[type="checkbox"]:checked'
        // ).length;
        // if (permission_ck != 0) {
        //     jQuery(this).find(".vr-permission-err").css("display", "none");
        //     jQuery(this).closest(".modal-body").find("li[data-tab=permission]").removeClass("error-tab");
        // } else {
        //     jQuery(this).find(".vr-permission-err").css("display", "block");
        //     jQuery(this).closest(".modal-body").find("li[data-tab=permission]").addClass("error-tab");
        //     err = 1;
        // }

        if (userrole == "agent") {
           
            var commission_error = 0;
            var commission_type_error = 0;

            console.log(commissionInput);

            if (commissionInput != "") {
                jQuery(this).find("input[name='commission[casino]']").removeClass("error-border");
            } else {
                jQuery(this).find("input[name='commission[casino]']").addClass("error-border");
                commission_error = 1;
            }
            
            // if(jQuery(".permission-sec .form_chechbox-sec-wp").find('input[type="checkbox"]:checked').length > 0) {
                if(!('month' === userSettlementType || 'week' === userSettlementType)) {
                    jQuery(this).find(".vr-commission-settlement-type-err").css("display", "block");
                    commission_type_error = 1;
                } else {
                    jQuery(this).find(".vr-commission-settlement-type-err").css("display", "none");
                }
            // }

            if (commission_error || commission_type_error) {
                jQuery(this).closest(".modal-body").find("li[data-tab=commissions]").addClass("error-tab");
                err = 1;
            } else {
                jQuery(this).closest(".modal-body").find("li[data-tab=commissions]").removeClass("error-tab");
            }











            // var commission_error = 0;
            // jQuery(".commissions_modal_form .form_chechbox-sec-wp .error-border").removeClass("error-border");
            // jQuery(".permission-sec .form_chechbox-sec-wp")
            //     .find('input[type="checkbox"]:checked')
            //     .each(function () {
            //         var ck_val = $(this).val();
            //         var currGame_com = jQuery("input[name='commission[" + ck_val + "]']");
            //         var game_com = currGame_com.val();

            //         if (game_com != "") {
            //             if (game_com > 100) {
            //                 currGame_com.addClass("error-border");
            //                 commission_error = 1;
            //             } else {
            //                 currGame_com.removeClass("error-border");
            //             }
            //         } else {
            //             currGame_com.addClass("error-border");
            //             commission_error = 1;
            //         }
            //     });

            // var commission_type_error = 0;
            // if(!('month' === userSettlementType || 'week' === userSettlementType)) {
            //     jQuery(this).find(".vr-commission-settlement-type-err").css("display", "block");
            //     commission_type_error = 1;
            // } else {
            //     jQuery(this).find(".vr-commission-settlement-type-err").css("display", "none");
            // }

            // if (commission_error || commission_type_error) {
            //     jQuery(this).closest(".modal-body").find("li[data-tab=commissions]").addClass("error-tab");
            //     err = 1;
            // } else {
            //     jQuery(this).closest(".modal-body").find("li[data-tab=commissions]").removeClass("error-tab");
            // }
            // return false;
        }

        // console.log(" Error ", err);

        if (err == 0) {
            jQuery(".vr_edit_user_from .load-more").fadeIn();

            var form_data = $(this).serialize();
            jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: "edit_user_information",
                    formdata: form_data,
                    userrole: userrole,
                },
                dataType: "text",
                success: function (response) {
                    // console.log("success response");
                    // console.log("edit_user_information" + response);
                    if (response == 1) {
                        jQuery(".vr_edit_user_from").trigger("reset");
                        // $this.find(".success-msg").css("display", "block");
                        dataTable.draw(true);
                        setTimeout(function () {
                            $('body [data-button-toggle="tooltip"]').tooltip({
                                trigger: "hover",
                            });
                        }, 1000);
                        jQuery("#modify_popup_agent").modal("hide");
                        jQuery("#modify_popup_player").modal("hide");
                    } else {
                        jQuery(".vr-email-err").text(response);
                        jQuery(".vr-email-err").css("display", "block");
                    }
                    jQuery(".vr_edit_user_from .load-more").fadeOut();
                },
                error: function () {
                    alert("There was an error while fetching the data.");
                },
            });
        }

        event.preventDefault();
        return false;
    });
    /** Edit User AJAX End */

    /** Block User AJAX Call  */
    jQuery("body").on("submit", ".user_block_form", function (event) {
        var user_block_reason = jQuery(this).find("textarea[name=user_block_reason]").val();
        var user_id = jQuery(this).find("input[name=user_id]").val();

        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "user_block",
                user_block_reason: user_block_reason,
                user_id: user_id,
            },
            dataType: "text",
            success: function (response) {
                jQuery("#to_lock_popup").modal("hide");
                dataTable.draw(true);
                setTimeout(function () {
                    $('body [data-button-toggle="tooltip"]').tooltip({
                        trigger: "hover",
                    });
                }, 1000);
            },
            error: function () {
                alert("There was an error while fetching the data.");
            },
        });

        event.preventDefault();
        return false;
    });

    /** User map sidebar drop down  */
    jQuery("body").on("click", ".user_map .user_dropdown i", function () {
        // jQuery(this).fadeToggle();
        jQuery(this).closest(".user_dropdown").toggleClass("hide");
        if (jQuery(this).closest(".user_dropdown").hasClass("hide")) {
            jQuery(this).next().next().fadeOut();
        } else {
            jQuery(this).next().next().fadeIn();
        }
    });

    /** user map ajax to change data in main table  */
    jQuery("body.page-template-template-users").on("click", " .user_map ul li a", function () {
        jQuery(".user_map ul li").removeClass("current_user");
        jQuery(this).closest("li").addClass("current_user");
        var user_id = jQuery(this).attr("data-user");
        jQuery(".user_map_main_ul").attr("data-userid", user_id);
        dataTable.draw(true);
        setTimeout(function () {
            $('body [data-button-toggle="tooltip"]').tooltip({
                trigger: "hover",
            });
        }, 1000);
    });

    /** User map sidebar include hide data or not  */
    jQuery("body").on("change", "input[name=user_map_hidden]", function () {
        var user_id = jQuery(".user_dropdown.current_user a").attr("data-user");
        if (this.checked) {
            var user_hide = 0;
        } else {
            var user_hide = 1;
        }

        var currentRequest = null;
        currentRequest = $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: "get_user_map_html",
                user_id: user_id,
                user_hide: user_hide,
            },
            beforeSend: function () {
                if (currentRequest != null) {
                    currentRequest.abort();
                }
            },
            success: function (response) {
                jQuery(".user_map_main_ul").html(response);
            },
        });
    });

    /** User information table player and agent count click */
    jQuery("body").on("click", ".user_info_sort", function () {
        var userrole = jQuery(this).attr("data-userrole");
        var userid = jQuery(this).attr("data-userid");

        jQuery(".user_map .user_map_main_ul").attr("data-userid", userid);

        jQuery("#user_data_wrapper .modal_tablist ul li[data-sort-value=" + userrole + "]").trigger("click");
        jQuery("#user_information_Modal").modal("hide");

        // jQuery(".user_map .user_map_main_ul li").removeClass()
        if (jQuery(".user_map .user_map_main_ul li a[data-user=" + userid + "]")) {
            jQuery(".user_map .user_map_main_ul li").removeClass("current_user");
            jQuery(".user_map .user_map_main_ul li a[data-user=" + userid + "]")
                .closest("li")
                .addClass("current_user");
        }
    });

    /*Quotr Modal JS */
    jQuery(".center-modal-view").on("show.bs.modal", function () {
        var scrolly = window.scrollY;
        jQuery("body").css("top", "-" + scrolly + "px");
        jQuery(this).attr("data-top", scrolly);
    });
    jQuery(".center-modal-view").on("hidden.bs.modal", function () {
        var scrolly = jQuery(this).attr("data-top");
        jQuery("body").css("top", "0px");
        window.scrollTo(0, scrolly);
    });

    /***
     *
     */

    var summary_datatable = $("#summary_datatable").DataTable({
        dom: 'r <"responsive-table-scroll" t> <"table_filter_bottombar"<"row align-items-center"<"col-sm-6"l><"col-sm-6"p>>>', //<"table_filter_topbar" <"row align-items-center"<"col-sm-6"f><"col-sm-6"<""> >>>
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Username...",
            processing: '<i class="fad fa-spinner-third fa-spin"></i>',
        },
        ordering: false,
        processing: true,
        serverSide: true,
        serverMethod: "post",
        ajax: {
            url: ajaxurl + "?action=summary_data",
            data: function (data) {},
        },
        columns: [
            { data: "date" },
            { data: "operation" },
            { data: "amount" },
            { data: "balance" },
            { data: "more-info" },
        ],
        createdRow: function(row, data, dataIndex, cells) {
            $(row).addClass("finance_status_" + data.operation.replace(" ", "_").toLowerCase());
            $('.my-summary-payment span').html(data.mySummaryBalance);
            setTimeout(function () {
                $('body [data-button-toggle="tooltip"]').tooltip({
                    trigger: "hover",
                    html: true,
                });
            }, 1500);
        },
        pageLength: 10,
    });
    $("#summary_datatable_filter input").addClass("form_input");

    //finance-players-operation popup
    $(document).on('click', '#proof_comment', function() {
        $('.attachment_items_comment').toggleClass('proof_comment_open');
    });
});
