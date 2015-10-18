Light Wordpress plugin providing a shortcode to display an AJAX subscribe form to Mailchimp.

Usage:

Put anywhere in your template:
    [MailchimpSubscribeAjax  form_url='//xxxxxx.list-manage.com/subscribe/post-json?u=xxxxx&id=xxxxx']

    Replace the URL with your Mailchimp subscribe URL.
    This URL can be found on Mailchimp website -> lists -> signup forms -> embedded forms (html) -> the subscribe URL is the form action in the generated HTML code


Optional:
    You can customize labels and messages with the following options:

        [MailchimpSubscribeAjax  form_url='http://xxxxxx.list-manage.com/subscribe/post-json?u=xxxxx&id=xxxxx'
            placeholder='Votre adresse e-mail'
            submit='S\'inscrire à la newsletter'
            msg_email_invalid='Veuillez saisir une adresse email valide'
            msg_subscribe_ok='Merci, vous allez recevoir un mail de confirmation'
            msg_subscribe_error='Une erreur s\'est produite']