/**
 * Formulaire de souscription mailchimp.
 */

var $=jQuery;

function mailchimpSubscribeAjax(e) {
    if (!isEmail($(e.EMAIL).val())) {
        alert(msa_settings['msg_email_invalid']);
        return false;
    }

    $(e.SUBMIT).attr('disabled','disabled');
    mailchimpAjaxSubmit($("#msaForm"))
        .done(function (data) {
            console.log("mailchimp subscribe success", data);
            alert(msa_settings['msg_subscribe_ok']);
        })
        .fail(function (error) {
            console.log("mailchimp subscribe error", error);
            alert(msa_settings['msg_subscribe_error']+' '+error.msg);
        })
        .always(function(){
            $(e.SUBMIT).removeAttr('disabled');
        });

    return false; // prevent form default
}

function mailchimpAjaxSubmit($form) {
    var deferred = $.Deferred();
    if (msa_settings['form_url']) {
        $.ajax({
            type: "POST",
            url: msa_settings['form_url'],
            data: $form.serialize(),
            cache: false,
            dataType: "jsonp",
            jsonp: "c", // trigger MailChimp to return a JSONP response
            contentType: "application/json; charset=utf-8",
            error: function (error) {
                deferred.reject(error);
            },
            success: function (data) {
                if (data && data.result == "success") {
                    deferred.resolve(data);
                } else {
                    deferred.reject(data);
                }
            }
        });
    }
    else {
        // not configured
        deferred.reject({msg: "Plugin usage error: missing 'form_url' parameter"});
    }
    return deferred.promise();
}

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}
