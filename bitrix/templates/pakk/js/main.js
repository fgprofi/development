$(document).ready(function () {
    $(".input_box.checkbox.disabled_check").click(function (e) {
        e.preventDefault();
    });
    $(".webform-field-upload span").click(function () {
        $(this).parent().find("input").click();
    });
    $(".logout_href").click(function (e) {
        e.preventDefault();
        $.fancybox.open({
            src: '#logout-popup',
        });
    });

    function checkValidGroup(target) {
        var parent = target.parents('.groop_field_box');
        var groupValid = true;
        var groupNum = $('.groop_field_box').index(parent);
        parent.find("select, input, textarea").each(function () {
            if(!$(this).hasClass("noCheckGroup")){
                if (/HIDDEN_VIEW/g.test($(this).attr("name")) !== true) {
                    var propName = $(this).attr("name").replace('PROPERTY_', '').replace('[]', '');

                    if (this.nodeName == "SELECT" && $(this).data("multi") > 0) {
                        var patentSelect = $(this).parents("#PROPERTY_" + $(this).attr("name"));
                        //console.log(propName);
                        //console.log("select_"+$(this).val()+"-"+patentSelect.find("."+$(this).attr("name")+"_variants input[type=text]").length+"-"+patentSelect.find("."+$(this).attr("name")+"_variants input[type=hidden]").length);
                        if ($(this).val() == "" && patentSelect.find("." + $(this).attr("name") + "_variants input").length == 0) {
                            //console.log(patentSelect);
                            groupValid = false;
                        }
                        if (patentSelect.find("." + $(this).attr("name") + "_variants input[type=hidden]").length == 1 && $(this).val() == "") {
                            //console.log("2input_" + $(this).attr("name") + "_" + patentSelect.find("." + $(this).attr("name") + "_variants input[type=hidden]").val());
                            groupValid = false;
                        }
                        //console.log("2input_" + $(this).attr("name") + "_" + $(this).val());
                    } else {
                        //console.log(this.nodeName+"_" + $(this).attr("name") + "_" + $(this).val() + "_" + $(this).parent().parent().hasClass("multi_field_text_input") + "_" + $(this).parent().parent().parent().hasClass("multi_field_text"));
                        if ($(this).attr("type") != "hidden" && typeof $(this).data("opt-val") == "undefined") {
                            if ($(this).parent().parent().parent().hasClass("multi_field_text")) {
                                groupValid = false;
                                $(this).parent().parent().parent().find("input").each(function () {
                                    if ($(this).val() != "") {
                                        groupValid = true;
                                        //console.log($(this).attr("name")+"_"+$(this).val());
                                    }
                                });
                            } else {
                                if ($(this).val() == "" && !$(this).parent().parent().hasClass("multi_field_text_input")) {
                                    groupValid = false;
                                }
                                if ($(this).val() == "" && $(this).parent().parent().hasClass("valid_minus") && $(this).parent().parent().hasClass("multi_field_text_input")) {
                                    groupValid = false;
                                }
                            }

                            //console.log("1input_" + $(this).attr("name") + "_" + $(this).val() + "_" + $(this).parent().parent().hasClass("multi_field_text_input") + "_" + $(this).parent().parent().parent().hasClass("multi_field_text"));
                        }
                    }
                }
            }
        });
        //console.log(groupValid);
        if (groupValid) {
            $(".required_fields_check li:eq(" + groupNum + ")").removeClass('sidebar__item_error').addClass('sidebar__item_valid');
        } else {
            $(".required_fields_check li:eq(" + groupNum + ")").removeClass('sidebar__item_valid').addClass('sidebar__item_error');
        }
    }


    $(".section__top").click(function () {
        $(this + '.section__content').slideToggle();
    });

    var windowWidth = window.innerWidth;

    $('.drop-login__menu-item_feedback').fancybox({
        src: '#form-modal',
        beforeShow : function( instance, current ) {
            if ($('.header-block div').is('.header-hidden-phone')) {
                let phone = $('.header-hidden-phone').text();
                $('input[name="phone"]').val(phone);
            }
        }
    });
                                
    $('html body').on('click', '.modal-wrap-close', function () {
        $.fancybox.close();
    });
    $('html body').on('click', '.form-modal-save-account__submit', function () {
        $.fancybox.close();
    });

    $(function () {
        var windowWidth = $(window).width();
        var emailChangeButton = $(".email-setting__button_changed");

        if ($(document).ready() && windowWidth < 769) {
            emailChangeButton.html('Изменить');
        } else {
            emailChangeButton.html('Изменить электронную почту');
        }
    });

    $(".header-login.authorized a.show-header-min-box").click(function (e) {
        e.preventDefault();
        if (e.target || !$('.header-login__drop')) {

            $(".header-login__drop").slideToggle();
        }
    })

    $(".filter__body").on('change', '.filter__left .filter__input', function () {
        if ($(this).prop("checked")) {
            $(this).parents('.filter__item').css('background', 'rgba(17, 155, 236, 0.03)');
        } else {
            $(this).parents('.filter__item').css('background', 'unset');
        }
    });
    $("#PROPERTY_PHONE input").inputmask("+7 (999)-999-99-99", {
        //"placeholder": ""
    });
    $("#PROPERTY_OGRN input").inputmask("9999999999999", {
        "placeholder": "",
        clearIncompvare: false,
        greedy: false,
        regex: "[0-9]{13}",
    });
    $(".maskogrn").inputmask("9999999999999", {
        "placeholder": "",
        clearIncompvare: false,
        greedy: false,
        regex: "[0-9]{13}",
    });
    var isValid = Inputmask.isValid
    $("#PROPERTY_KPP input").inputmask("999999999", {
        "placeholder": "",
        clearIncompvare: true,
        greedy: false,
        regex: "[0-9]{9}"
    });
    $("#PROPERTY_INN input").inputmask("9999999999", {
        "placeholder": "",
        clearIncompvare: false,
        greedy: false,
        regex: "[0-9]{10}"
    });
    $('.sign_in_button.active').parent(".sign_in_option-item").css('border-color', '#1EB795');

    $(".login .sign_in_option .sign_in_option-item").click(function () {
        $(this).parents(".sign_in_option").find(".sign_in_option-item").css('border-color', '#e3e4e4');
        $(this).parents(".sign_in_option").find(".sign_in_button").removeClass("active");
        $(this).css('border-color', '#1EB795').find(".sign_in_button").addClass("active");
        if ($(this).hasClass("sign_in_option-item_entity")) {
            $(".bx-system-auth-form .form_input.email > div").html('ОГРН организации (13 цифр)');
            $(".bx-system-auth-form .form_input.email > input").attr('placeholder', 'ОГРН организации (13 цифр)').attr('data-min', '13').inputmask("9999999999999", {
                "placeholder": ""
            });
            $(".bx-auth-reg .form_input.email input").attr('placeholder', 'ОГРН организации (13 цифр)').attr('data-min', '13').inputmask("9999999999999", {
                "placeholder": ""
            });

        } else {
            $(".bx-system-auth-form .form_input.email > div").html('E-mail')
            $(".bx-system-auth-form .form_input.email > input").attr('placeholder', 'E-mail').inputmask("remove");
            $(".bx-auth-reg .form_input.email input").attr('placeholder', 'Адрес электронной почты').attr('data-min', '').inputmask("remove");
        }
        $(".sign_in_alert").toggleClass("active");
        if (typeof $(this).parents(".sign_in_option").data("radio-name") != "undefined") {
            $("input[name=" + $(this).parents(".sign_in_option").data("radio-name") + "][value=" + $(this).find(".sign_in_button").data("radio-val") + "]").trigger("click");
        }
    });

    function checkReq(input) {
        input.removeClass("error");
        var valInput = input.val();
        if (input.length > 0) {
            if (input[0].type == 'checkbox') {
                if (!input[0].checked) {
                    $(input).next().addClass("error_red");
                    valInput = '';
                } else {
                    $(input).next().removeClass("error_red");
                    valInput = input[0].checked;
                }
            }
            if (input[0].type == 'password') {
                if (input.val().length < 6) {
                    input.addClass("error");
                    return false;
                }
            }
            if (input[0].name == 'REGISTER[EMAIL]' && typeof input.data("min") == "undefined") {
                if (input.val().indexOf('@') < 0) {
                    input.addClass("error");
                    return false;
                }
            }
            if (input[0].name == 'ID_USER_PR') {
                var data = {};
                data.id = input.val();
                if (data.id === 1) {
                    $.fancybox.open({
                        src: '#no_user',
                    });
                    input.addClass("error");
                    return false;
                }
                if (data.id > 0) {
                    // $.ajax({
                    //     type: "POST",
                    //     url: "/ajax/check_uz_id.php",
                    //     data: data,
                    //     dataType: "html",
                    //     success: function (responseData) {
                    //     }
                    // }).done(function (data) {
                    //     if (data === 'false') {
                    //         console.log(data);
                    //         $("#password").addClass("error");
                    //         $.fancybox.open({
                    //             src: '#no_user',
                    //         });
                    //         input.addClass("error");
                    //         console.log (data);
                    //         return false;
                    //     }
                    //
                    // });
                }else{
                    $.fancybox.open({
                        src: '#no_user',
                    });
                    input.addClass("error");
                    return false;
                }
            }else{
                if (typeof input.data("min") != "undefined") {
                    inputDataMin = input.data("min");
                    //console.log (inputDataMin);
                    valInputLength = valInput.length;
                    //console.log (valInputLength);

                    if (valInputLength < inputDataMin) {
                        input.addClass("error");
                        return false;
                    } else {
                        return true;
                    }
                }
                console.log (valInput);
                if (valInput == "") {
                    input.addClass("error");
                    return false;
                } else {
                    return true;
                }
            }
        }

    }

    $(".bx-system-auth-form .form_button button").click(function (e) {
        e.preventDefault();
        $(".error_box").detach();
        var form = $(this).parents("form");
        var er = false;
        form.find(".required input").each(function () {
            var dataEr = checkReq($(this));
            if (!dataEr && er === false) {
                er = true;
            }
        });
        console.log(er);
        if (!er) {
            $(this).parents("form").find("input[type=submit]").click();
        }
    });
    $(".bx-auth-reg .form_button button").click(function (e) {
        e.preventDefault();
        $(".error_box").detach();
        var form = $(this).parents("form");
        var er = false;
        $("#password").removeClass("error");
        var successForm = false;
        if (!$("#pwdMeter").hasClass("verystrong")) {
            er = true;
        }else{
            successForm = true;
        }
        if (!successForm) {
            if ($("#pwdMeter").hasClass("strong")) {
                er = false;
                successForm = true;
            }
        }
        if (!successForm) {
            $("#password").addClass("error");
            $.fancybox.open({
                src: '#password_reg_description',
            });
        }
        $("#password").removeAttr("disabled");
        var pass = $('input[name="REGISTER[PASSWORD]"]').val();
        var confirmPass = $('input[name="REGISTER[CONFIRM_PASSWORD]"]').val();
        $('input[name="REGISTER[CONFIRM_PASSWORD]"]').removeClass("error");
        if (confirmPass != pass) {
            $('input[name="REGISTER[CONFIRM_PASSWORD]"]').addClass("error");
            er = true;
            $("#password").addClass("error");
            $.fancybox.open({
                src: '#password_different',
            });
        }
        if ($(this).find("input").hasClass("maskogrn")) {
            //checkReq($(this).find("input"));
        }
        form.find(".required").each(function () {
            if (!$(this).hasClass("hidden_field") && !$(this).parent("div").hasClass("hidden_field")) {
                var dataEr = checkReq($(this).find("input"));
                if (dataEr === false && er === false) {
                    er = true;
                }
            }
        });
        console.log ("er_"+er);
        console.log ("successForm_"+successForm);
        if (!er && successForm) {
            $(this).parents("form").find("input[type=submit]").click();
        }

        //отправляем на регистрацию если нет ошибок

    });
    $('.jsFilterSelect').on("change", function (data) {


        if (data.target.getAttribute('data-multi') > 0) {
            var repID = $(data.target)[0].selectedOptions[0].getAttribute('value');
            var containHTML = $('.' + data.target.getAttribute('data-code') + '_variants')[0].innerHTML;
            var repVal = $(data.target)[0].selectedOptions[0].getAttribute('data-name');
            if (repID) {
                //console.log("." + data.target.getAttribute('data-code') + "_empty_"+repID);

                $(this).parents(".input_box").find('.' + data.target.getAttribute('data-code') + '_variants')[0].innerHTML = containHTML + "<div class='multi_field_text_input valid_minus'><div class=\"field-row\"><input name='PROPERTY_" + data.target.getAttribute('data-code') + "[" + repID + "]' type='text' data-opt-val='" + repID + "' value='" + repVal + "'><span class=\"remove-field\"></span></div></div>";
                //удаляем выбранный селект
                $(data.target).find('option:selected').remove();
                $("." + data.target.getAttribute('data-code') + "_empty").detach();
            }
        } else {
            $(this).parents(".input_box").find('.' + data.target.getAttribute('data-code') + '_variants').html("");
            $(this).parents(".input_box").find('.' + data.target.getAttribute('data-code') + '_variants').html("<input type='hidden' name='PROPERTY_" + data.target.getAttribute('data-code') + "' data-opt-val='" + $(this).val() + "' value='" + $(this).val() + "'>");
        }
    });

    function autoTextInput(input, face) {
        var form = input.parents("form");
        var data = form.serializeArray();
        var inputName = [];
        inputName["name"] = "input";
        inputName["value"] = input.attr("name");
        data.push(inputName);
        var faceName = [];
        faceName["name"] = "face";
        faceName["value"] = face;
        data.push(faceName);
        //console.log(data);
        $.ajax({
            type: "POST",
            url: "/ajax/auto_text.php",
            data: data,
            dataType: "html",
            success: function (responseData) {
                $(".selector-input").detach();
                input.parents(".input_box").append(responseData);
                //console.log(responseData);
            }
        });
    }

    function filterPersonAjax(data, append) {
        $.ajax({
            type: "POST",
            url: "/ajax/filter_profile.php",
            data: data,
            dataType: "html",
            success: function (responseData) {
                //console.log(responseData)
                var countNext = $(responseData).find(".NavRecordCount").text();
                var res = $(responseData).find(".res");
                if (countNext == 0) {
                    $(".filter__bottom .filter__button").hide();
                } else {
                    $(".filter__bottom .filter__button").show();
                    $(".filter__bottom .filter__button span").text(countNext);
                }

                if (append) {
                    $(".filter__body").append($(responseData).find(".filter__item"));
                } else {
                    $(".filter__body").html("");
                    $(".filter__body").html($(responseData).find(".filter__item"));
                }
            }
        });
    }

    function filterReportAjax(data) {
        // console.log("11");
        $.ajax({
            type: "POST",
            url: "/ajax/filter_report_new.php",
            data: data,
            dataType: "html",
            success: function (responseData) {
                $("#create_feed .ajax_data").text(responseData);
                var ajaxDataParse = $.parseJSON(responseData);
                if(typeof(ajaxDataParse['id']) != "undefined" && ajaxDataParse['id'] !== null) {
                    $('.total-user-val').text(ajaxDataParse['id'].length);
                }else{
                    $('.total-user-val').text(0);
                }
            }
        });
    }

    function startFilter(form, face, append = false) {
        var data = form.serializeArray();
        var dataAllUser = $(".all_user").serializeArray();
        data = data.concat(dataAllUser);
        var countItems = [];
        countItems["name"] = "countItems";
        countItems["value"] = $(".filter__body").data("count-items");

        data.push(countItems);
        countNumPage = $(".filter__body").data("num-page");
        if (append) {
            countNumPage++;
            $(".filter__body").data("num-page", countNumPage);
        } else {
            $(".filter__body").data("num-page", 1);
            countNumPage = 1;
        }
        var numPage = [];
        numPage["name"] = "numPage";
        numPage["value"] = countNumPage;
        $("label.select_all input").prop('checked', false);
        data.push(numPage);
        $(".filter .filter__head .filter__right input").prop('checked', false);
        if (form.hasClass("report_filter")) {
            filterReportAjax(data);
        } else {
            filterPersonAjax(data, append);
        }

        //console.log(data);
        // $.ajax({
        //     type: "POST",
        //     url: "/ajax/filter_profile.php",
        //     data: data,
        //     dataType: "html",
        //     success: function (responseData) {
        //         var countNext = $(responseData).find(".NavRecordCount").text();
        //         //console.log($(responseData).find(".NavRecordCount"));
        //         var res = $(responseData).find(".res");
        //         if (countNext == 0) {
        //             $(".filter__bottom .filter__button").hide();
        //         } else {
        //             $(".filter__bottom .filter__button").show();
        //             $(".filter__bottom .filter__button span").text(countNext);
        //         }

        //         if (append) {
        //             $(".filter__body").append($(responseData).find(".filter__item"));
        //         } else {
        //             $(".filter__body").html("");
        //             $(".filter__body").html($(responseData).find(".filter__item"));
        //         }

        //         //console.log(responseData);
        //     }
        // });
    }

    $(".startFilter").click(function () {
        var form = $("form.active");
        var face = $("input[name=FACE]:checked").val();
        startFilter(form, face);
    });
    $(".all_user .check input").change(function () {
        var form = $(this).parents("form.all_user").next(".full_filter_box").find("form.active");
        var face = $("input[name=FACE]:checked").val();
        startFilter(form, face);
    });
    $(".all_user .sign_in_option .sign_in_option-item").click(function () {
        $(this).parents(".sign_in_option").find(".sign_in_button").removeClass("active");
        $(this).find(".sign_in_button").addClass("active");
        if (typeof $(this).parents(".sign_in_option").data("radio-name") != "undefined") {
            $("input[name=" + $(this).parents(".sign_in_option").data("radio-name") + "][value=" + $(this).find(".sign_in_button").data("radio-val") + "]").trigger("click");
        }
        if ($(this).find(".sign_in_button").data("radio-val") == "TYPE_U") {
            $(".sign_in_option[data-radio-name=PERSONAL_DATA]").hide();
        } else {
            $(".sign_in_option[data-radio-name=PERSONAL_DATA]").show();
        }
        var form = $(this).parents("form.all_user").next(".full_filter_box").find("form.active");
        var face = $("input[name=FACE]:checked").val();
        startFilter(form, face);
        $('.jsFilterSelect').select2('destroy');

        function select2Init() {
            $('.jsFilterSelect').select2({
                placeholder: {
                    id: 0,
                    text: 'Выбрать'
                },
                language: {
                    noResults: function (params) {
                        return "Ничего не найдено";
                    }
                }
            });
            $('b[role="presentation"]').hide();
        }

        setTimeout(select2Init, 500);
    });
    $(".form_filter input, .form_filter select").on('input', function () {
        var form = $(this).parents(".form_filter");
        var face = $("input[name=FACE]:checked").val();
        startFilter(form, face);
    });
    $('.input_box').on('click', '.selector-value', function () {
        if (!$(this).hasClass("disabled")) {
            var face = $("input[name=FACE]:checked").val();
            var form = $(this).parents(".form_filter");
            var value = $(this).data("value");
            $(this).parents(".input_box").find("input").val(value);
            startFilter(form, face);
        }
        $(".selector-input").detach();
    });
    $(".filter__bottom .filter__button").click(function () {
        var form = $("form.form_filter.active");
        var face = $("input[name=FACE]:checked").val();
        startFilter(form, face, true);
    });
    $('.auto_text').on('input', function () {
        var face = $("input[name=FACE]:checked").val();
        autoTextInput($(this), face);
    });
    $(".multi_field_text .multi_field_text_plus").click(function () {
        var inputBox = $(this).parent();
        inputBox.addClass("margin-bottom");
        var inputBlock = $(this).parents(".multi_field_text");
        var inputVal = inputBox.find("input").val();
        if (inputVal != "") {
            var inputBoxClone = inputBox.clone();
            var nameInput = $(this).parents(".multi_field_text").attr("id");
            //console.log(inputBoxClone);
            inputBox.find("input").attr("name", nameInput + "[]");
            inputBoxClone.find(".multi_field_text_plus").remove();
            inputBoxClone.addClass("margin-bottom").addClass('valid_minus');
            inputBoxClone.insertBefore(inputBlock.find('.multi_field_text_input')[0]);
            inputBoxClone.find('.field-row').append("<span class=\"remove-field\"></span>");
            inputBox.find("input").val("");
        }
    });

    $("form").on("click", ".remove-field", function () {
        var inputBox = $(this).parent().parent();
        //console.log($(this).parents(".cabinet-block-form").find(".input_box").is(".multi_field_text"));
        if (inputBox.parent().find('.multi_field_text_input').length >= 1) {
            var codeField = inputBox.parent().parent().find("select").data("code");
            if (inputBox.parent().find('.multi_field_text_input').length == 1) {
                inputBox.parent().parent().find("." + codeField + "_variants").append("<input type='hidden' class='" + codeField + "_empty' name='PROPERTY_" + codeField + "' value='false'>");
            }
            var cab = 0;
            if ($(this).parents(".cabinet-block-form").length == 1) {

                /*if($(this).parents(".cabinet-block-form").find(".input_box").is(".multi_field_text")){
                    cab = $(this).parents("#PROPERTY_" + codeField).find(".input_box.multi_field_text");
                }else{*/
                cab = $(this).parents("#PROPERTY_" + codeField).find("." + codeField + "_variants");
                //}
                //console.log($(this).parents(".cabinet-block-form").find(".input_box").is(".multi_field_text"));
            }
        }
        var newStateText = $(this).parents(".multi_field_text_input").find("input").val();
        var newStateVal = $(this).parents(".multi_field_text_input").find("input").data("opt-val");
        var newState = new Option(newStateText, newStateVal, false, false);
        newState.setAttribute("data-name", newStateText);
        inputBox.parent().parent().find("select").append(newState);
        inputBox.detach();
        if (cab != 0) {
            //console.log(cab);
            checkValidGroup(cab);
        }
        if ($("form").hasClass("form_filter")) {
            var form = $("form.active");
            var face = $("input[name=FACE]:checked").val();
            startFilter(form, face);
        }
    });
    $(".input_box.multi_field_text").on("click", ".remove-field", function () {
        //console.log("1");
        var inputBox = $(this).parent().parent();
        var box = $(this).parent().parent().parent();
        inputBox.detach();
        if (box.parents(".cabinet-block-form").length == 1) {
            // console.log("2");
            // console.log(box);
            checkValidGroup(box);
        }
    });
    $('.jsFilterSelect').select2({
        placeholder: {
            id: 0,
            text: 'Выбрать'
        },
        language: {
            noResults: function (params) {
                return "Ничего не найдено";
            }
        }
    });
    $('b[role="presentation"]').hide();

    $(".checkbox").click(function () {
        if (!$(this).hasClass("disabled_check")) {
            var checkId = $(this).find("label").attr("for");
            if ($("#" + checkId).is(':checked')) {
                $("#" + checkId).prop('checked', false);
                if (!$(this).find("input").is(".empty_val")) {
                    $(this).append("<input value='' class='empty_val' type='hidden' name='" + checkId + "'>");
                }

            } else {
                $("#" + checkId).prop('checked', true);
                $(this).find(".empty_val").detach();
            }
        }
        //console.log();
    });
    $("#accordion").accordion();
    //$('.multi_select').multiSelect();
    $(".check_select .check_select_title").click(function () {
        var checkSelect = $(this).parent(".check_select");
        var dataId = checkSelect.data("id");
        var dataValue = checkSelect.data("value");
        var inputBox = checkSelect.parents(".multi_check");
        var inputBoxName = inputBox.data("name");
        if (checkSelect.hasClass("check")) {
            inputBox.find("input[data-id='" + dataId + "']").detach();
        } else {
            inputBox.prepend("<input type='hidden' name='" + inputBoxName + "' data-id='" + dataId + "' value='" + dataValue + "'>");
        }
        if (dataValue == 10) {
            checkSelect.find(".check_select_content").slideToggle();
        }
        checkSelect.toggleClass("check");
    });
    $(".btn_send").click(function () {
        alert("Форма еще не звязана с mysql!");
    });

    //отправка формы обратной связи
    $('.form-modal__submit').on('click', function (e) {
        e.preventDefault();
        var form = $(e.target).parents("form");
        var data = form.serializeArray();
        var er = false;
        var modalMessage = $(".modal__message").fancybox();

        form.find(".required input").each(function () {
            var dataEr = checkReq($(this));
            if (!dataEr && er === false) {
                er = true;
            }
        });
        //console.log(er);
        if (!er && !form.hasClass('wait-send')) {
            // console.log (data);
            $.ajax({
                type: "POST",
                url: "/ajax/send_feedback.php",
                data: data,
                dataType: "html",
                beforeSend: function () {
                    form.addClass('wait-send');
                },
                success: function (responseData) {
                    $('.form-modal__input').val('');
                    $('.modal-wrap-close').click();
                    form.removeClass('wait-send');
                    modalMessage.show();
                    //console.log(123123);
                    setTimeout(
                        function () {
                            modalMessage.hide();
                        },
                        2000
                    );
                }
            });
        }

    });

    //зачищаем поле выбранного селектара для множественного поля
    $('.jsFilterSelect').on('change', function () {
        //console.log($('.jsFilterSelect').data('multi'));
    })

    var strGET = window.location.search.replace('?', '');
    var arGET = strGET.split('&');
    for (var aGet of arGET) {
        var sGet = aGet.split('=');
        if (sGet[0] == 'error') {
            $.fancybox.open({
                src: '#form-modal-save-account',
                opts: {
                    beforeShow: function () {
                        $(this).find('.form-modal__name').html(sGet[1]);
                    }
                }
            });
        }
    }
    // $('.form-modal-save-account__submit').on('click', function(){
    //     location.href = '/personal/';
    // })

    $('.required_fields_check').on('click', function (e) {
        var block = $(e.target).data('block');
        var top = $('.' + block).offset().top - 100;
        // console.log ($('.'+block));
        $('html, body').animate({
            scrollTop: top
        }, 2000);
    })

    //разрешаем ввод только латинских букв в поле email
    var inputEmail = $('.email input');

    inputEmail.on('keypress', (e) => {
        var keyCode = e.keyCode || e.which; // Код символа
        if (!/[a-zA-Z0-9 @ \- _ .]/.test(String.fromCharCode(keyCode)) // Проверка на разрешённые символы
            ||
            (/[ ]/.test(String.fromCharCode(keyCode)) && keyCode === 32)) // Проверка на количество пробелов
            e.preventDefault(); // Если условие выполнилось, то запрещаем ввод символа
    });
    var NAME_TYPE_F = $('*[name=NAME_TYPE_F]');
    NAME_TYPE_F.on('keypress', (e) => {
        console.log($('#no_user'));
        var keyCode = e.keyCode || e.which; // Код символа
        if (!/[а-яА-Я]/.test(String.fromCharCode(keyCode)) // Проверка на разрешённые символы
            ||
            (/[ ]/.test(String.fromCharCode(keyCode)) && keyCode === 32)) // Проверка на количество пробелов
        {
            e.preventDefault();
            $('#no_user').html("Разрешен ввод только русских букв");
            $.fancybox.open({
                src: '#no_user'
            });
        } // Если условие выполнилось, то запрещаем ввод символа
    });
    var SURNAME = $('*[name=SURNAME]');
    SURNAME.on('keypress', (e) => {
        var keyCode = e.keyCode || e.which; // Код символа
        if (!/[а-яА-Я,]/.test(String.fromCharCode(keyCode)) // Проверка на разрешённые символы
            ||
            (/[ ]/.test(String.fromCharCode(keyCode)) && keyCode === 32)) // Проверка на количество пробелов
        {
            e.preventDefault();
            $('#no_user').html("Разрешен ввод только русских букв");
            $.fancybox.open({
                src: '#no_user'
            });
        } // Если условие выполнилось, то запрещаем ввод символа
    });
    var SURNAME = $('*[name=PROPERTY_SURNAME]');
    SURNAME.on('keypress', (e) => {
        console.log($('#no_user'));
        var keyCode = e.keyCode || e.which; // Код символа
        if (!/[а-яА-Я]/.test(String.fromCharCode(keyCode)) // Проверка на разрешённые символы
            ||
            (/[ ]/.test(String.fromCharCode(keyCode)) && keyCode === 32)) // Проверка на количество пробелов
        {
            e.preventDefault();
            $('#no_user').html("Разрешен ввод только русских букв");
            $.fancybox.open({
                src: '#no_user'
            });
        } // Если условие выполнилось, то запрещаем ввод символа
    });
    var FIRST_NAME = $('*[name=PROPERTY_FIRST_NAME]');
    var IB_ID = $('*[name=PROFILE_IB]');
    FIRST_NAME.on('keypress', (e) => {
        var keyCode = e.keyCode || e.which; // Код символа
        if(IB_ID.val() !== '8'){
            if (!/[а-яА-Я]/.test(String.fromCharCode(keyCode)) // Проверка на разрешённые символы
                ||
                (/[ ]/.test(String.fromCharCode(keyCode)) && keyCode === 32)) // Проверка на количество пробелов
            {
                e.preventDefault();

                $('#no_user').html("Разрешен ввод только русских букв");
                $.fancybox.open({
                    src: '#no_user'
                });
            } // Если условие выполнилось, то запрещаем ввод символа
        }
    });
    var MIDDLENAME = $('*[name=PROPERTY_MIDDLENAME]');
    MIDDLENAME.on('keypress', (e) => {
        var keyCode = e.keyCode || e.which; // Код символа
        if (!/[а-яА-Я]/.test(String.fromCharCode(keyCode)) // Проверка на разрешённые символы
            ||
            (/[ ]/.test(String.fromCharCode(keyCode)) && keyCode === 32)) // Проверка на количество пробелов
        {
            e.preventDefault();
            $('#no_user').html("Разрешен ввод только русских букв");
            $.fancybox.open({
                src: '#no_user'
            });
        } // Если условие выполнилось, то запрещаем ввод символа
    });
    //открываем пароль при необходимости
    $('.form_input').find('.eye').on('click', function (e) {
        if ($(e.target).prev().attr('type') == 'password') {
            $(e.target).prev().attr('type', '');
            $(e.target).parent().css('background-image', 'url("/bitrix/templates/pakk/img/eye.svg")')
        } else {
            $(e.target).prev().attr('type', 'password')
            $(e.target).parent().css('background-image', 'url("/bitrix/templates/pakk/img/input-pass.svg")')
        }
    });

    //сообщение при успешной регистрации
    window.onload = function () {
        var strGET = window.location.search.replace('?', '');
        var pathName = window.location.pathname;
        var arGET = strGET.split('&');
        if (pathName == '/auth/') {

            for (var aGet of arGET) {
                var sGet = aGet.split('=');
                var mGet = arGET[1].split('=');
                if (sGet[0] == 'success' && sGet[1] == 'Y') {
                    $('#form-modal-save-account').find('.form-modal__name').html("Спасибо за регистрацию!<br> <span style='font-size:14px; font-weight:100'>Вам на почту <b style='color:#1db795'>" + mGet[1] +
                        "</b> отправлено письмо с ссылкой для подтверждения почтового адреса.<br>Перейдите по указанной ссылке" +
                        " и введите логин и пароль<br>Убедитесь, что письмо не попало в спам.</span>");
                    $.fancybox.open({
                        src: '#form-modal-save-account'
                    });
                }
            }
        }


    }

    //Прогресс бар в модеравция/очтёт
    var progress = $('.construction-houses__content__item__village__readiness__procent'),
        progressValue = [];
    for (var i = 0; i < progress.length; i++) {
        progressValue.push(progress[i].getAttribute('data-progress'));
        $(progress).eq(i).addClass(function () {
            return 'progress-' + progressValue[i];
        });
        $('body').append('<style>.progress-' + progressValue[i] + ':before {width: ' + progressValue[i] + '%;}</style>');
    }


    //АККАРДЕОН в редактировании лк

    $('.block_1 .groop_field_title').addClass('active')
    var acc = $(".groop_field .groop_field_title"),
        i, panel;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {

            panel = this.parentElement.parentElement.querySelector('.groop_field_box');
            if (this.classList.contains('active')) {
                $(panel).fadeOut();
                this.classList.toggle("active");
            } else {
                $(".groop_field .groop_field_title").removeClass('active');
                $('.groop_field_box').hide();
                $('html, body').stop().animate({
                    scrollTop: $(this).offset().top - 100
                }, 300);
                $(panel).fadeIn();
                this.classList.toggle("active");

            }
        });
    }


    $('.modern-version__close').on('click', function () {
        $('.modern-version').hide();
    })


    $(function () {
        $("select.form__input-multi").multipleSelect({
            selectAll: false,
            filter: true,
            onClick: function (view) {
                var form = $("form.active");
                var face = $("input[name=FACE]:checked").val();
                startFilter(form, face);
            }
        });
    });

    $('.cabinet-block-form .groop_field_box').on('input', function (event) {
        checkValidGroup($(event.target));
    });

    $('.cabinet-block-form input.phone').on('change', function (event) {
        checkValidGroup($(event.target));
    });

    $(".multi_field_text input[type=text]").on('input', function (event) {
        var nameInput = $(this).parents(".multi_field_text").attr("id");
        var valueInput = $(this).val();
        var newName = nameInput + "[" + valueInput + "]";
        $(this).attr("name", newName);
    });
    // $(".cabinet-block-form .input_box").on("click", ".remove-field", function(){
    //     checkValidGroup($(this));
    //     console.log("21214");
    // });
});