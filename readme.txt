=== Berri Personalized Care ===
Contributors: Artberri
Donate link: http://www.berriart.com/donate/
Tags: plugin, message, social, customized, personalized, care, google
Requires at least: 2.0
Tested up to: 2.3
Stable tag: trunk

This plugin for WordPress will give up to four personalized messages depending on the origin of the visitors of your blog. 

== Description ==

This plugin for WordPress will give up to four personalized messages depending on the origin of the visitors of your blog. It’s originally based on [the rthanks plugin by Alamsyah Rasyid](http://www.rasyid.net/plugin/ "rthanks plugin").

If you are thinking about increasing your feed subscribers, if you only want to show publicity to some of your visitors, if you want to say thanks to your visitor from search engines or socialbookmark,… If you want to show diferents messages to your visitants depending on their origin, this is your plugin.

Comments, questions and bug reports are welcome: [http://www.berriart.com/personalizedcare/](http://www.berriart.com/personalizedcare/ "Berri Personalized Care")

== Installation ==

1. Extract and upload to the `/wp-content/plugins/` directory
1. Activate plugin
1. Configure the messages in admin panel (Options->PersonalizedCare)
1. Edit your templates and add `<?php if (function_exists('berri_personalized_message')) berri_personalized_message(); ?>`. Preferably upside `if (have_posts()) : while (have_posts()) : the_post();` in `index.php`, `page.php` and `single.php`.
1. Save templates and upload to server
1. That's all

CONFIGURATION

* HTML code is allowed in the messages, so for example you can link to your feed or you can show AdSense of Google and earn money.
* If you want to show the name of the referer in the message write `{hostname}` in it. For example with a visitor from google will see *Welcome google visitor* if you write *Welcome `{hostname}` visitor*.

== Frequently Asked Questions ==

= Why doesn't it show anything? =

Make sure that you have activated the plugin and that you have added the function on the template.

== Screenshots ==

1. The plugin panel

