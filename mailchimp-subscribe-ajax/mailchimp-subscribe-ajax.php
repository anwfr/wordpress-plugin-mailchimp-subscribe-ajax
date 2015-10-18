<?php
/*
 Plugin Name: Mailchimp Subscribe Ajax
 Description: Mailchimp subscribe ajax form. Usage in templates: [MailchimpSubscribeAjax form_url='//xxxxxx.list-manage.com/subscribe/post-json?u=xxxxx&id=xxxxx']
 Version: 1.0
 Author: anw
 Author URI: http://www.anw.fr/
*/

defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );

    class MailchimpSubscribeAjax
    {
        private $tag = 'MailchimpSubscribeAjax';
        protected $name = 'MailchimpSubscribeAjax';
        protected $version = '1.0';

        public function __construct()
        {
            add_shortcode( $this->tag, array( &$this, 'shortcode' ) );
        }

        public function shortcode( $atts, $content = null )
        {
            extract( shortcode_atts( array(
                'form_url' => null,
                'placeholder' => 'E-mail?',
                'submit' => 'ok',
                'msg_email_invalid' => 'Please enter a valid e-mail',
                'msg_subscribe_ok' => 'Thanks for subscribing, you will receive a confirmation e-mail shortly',
                'msg_subscribe_error' => 'Sorry, an error occured.'
            ), $atts ) );

            $html = file_get_contents(dirname(__FILE__).'/subscribe.html');
            $html = str_replace('__form_url__', esc_attr($form_url), $html);
            $html = str_replace('__placeholder__', esc_attr($placeholder), $html);
            $html = str_replace('__submit__', $submit, $html);
            $html = str_replace('__msg_email_invalid__', esc_attr($msg_email_invalid), $html);
            $html = str_replace('__msg_subscribe_ok__', esc_attr($msg_subscribe_ok), $html);
            $html = str_replace('__msg_subscribe_error__', esc_attr($msg_subscribe_error), $html);
            return $html;
        }
    }
    new MailchimpSubscribeAjax();

