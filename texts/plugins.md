# 10 Useful WordPress Plugins
<summary>
Descriptions and whys-hows of plugins I personally use
</summary>

Plugins are to me both the best and the worst of WordPress. Some plugins are indispensable becauce they add functionality that either is missing "as of yet" or is unlikely to be put into core for one reason or another. It's also a fact that if you have several different plugins you risk slowing the site down through HTTP-requests, and if you're unlucky there will be backdoors or just slow code. As I said, the best and worst.

Here's my own list of which plugins I at this point would not like to be without, and why.

## Advanced Custom Fields
Custom fields is a great idea, but needing to remember what you named the "mood" field or whatever you're using is a touch annoying. Enter [Advanced Custom Fields](http://www.advancedcustomfields.com/), which allows you to create fields with different datatypes, that show up on different types of posts, depending on how you set it. If you're working with selling themes, their [Options Page](http://www.advancedcustomfields.com/add-ons/options-page/) (which unfortunately is a premium add-on) is really, really useful.

## Better WP Security
Though you should never think that just because you have a plugin installed, your site is secured, I do feel that [Better WP Security](http://wordpress.org/plugins/better-wp-security/) is a good start. Install it in a test environment first, and explore the various options to make sure you understand why (if not how) it protects, since then you will be better yourself at hardening the installation. It's also a good idea to read up on security overall, obviously.

## Contact Form 7
Obviously you want people to keep in touch with you (right?), and though I know that [Gravity Forms](http://www.gravityforms.com/) are probably the best if you need more advanced forms, it's also quite expensive. For more standard use, [Contact Form 7](http://contactform7.com/) fits the bill perfectly. There's even an [add-on for ACF](http://www.advancedcustomfields.com/add-ons/contact-form-7-field/) to attach to it. I'd also like to recommend using the [Honeypot](http://wordpress.org/plugins/contact-form-7-honeypot/) plugin rather than any ugly captchas.

Two large tweaks have been made: The style sheet is baked into the site stylesheet, and the contact-form-7 script is deregistered **unless** it's on the contact page.

    wp_deregister_style( 'contact-form-7' ); //These styles are baked into the stylesheet

    if ( !is_page('contact')) {
        wp_deregister_script( 'contact-form-7' );
    }

As I only use it on that page, there is little reason to concat the contact-form-7 scripts into my built script, but if I would use it more, I probably would.

## Log Deprecated Notices
Mostly useful when developing, [Log Deprecated Notices](http://wordpress.org/plugins/log-deprecated-notices/) by Andrew Nacin does pretty much what it says on the label. It also logs if any functions are used incorrectly, allowing for you to fix things quicker.

## W3 Total Cache
Not exactly a surprising plugin (it's touted on the plugin page as being trusted by countless companies, including mattcutts.com), it [does the job](http://www.dashboardjunkie.com/test-of-wp-caching-plugins-w3-total-cache-vs-wp-super-cache-vs-quick-cache) very nicely. Why use a caching plugin? For performance. By using a caching plugin such as [W3 Total Cache](http://wordpress.org/extend/plugins/w3-total-cache/) you can serve pages and posts as static files rather than dynamic, and with the right setup you can also minify and concatenate scripts and CSS that isn't already concatenated/minified.

## Widget Logic
If the theme is handcrafted to fit a particular content, you might not need [Widget Logic](http://wordpress.org/plugins/widget-logic/), since at that point you can set different widget areas in the code itself. However, if you for whatever reason can't/don't want to code the logic into the theme itself, Widget Logic is the next best thing. You do need to understand PHP logic and code, but that's part of the fun!

## Wordpress SEO
Unless you're a big fan of coding in page titles, I strongly recommend [Wordpress SEO](http://yoast.com/wordpress/seo/). Oh, I know that it's for SEO, and if that's what you're needing there's plenty of people singing its' praise elsewhere. Personally I use it to clean up the head some, deal with breadcrumbs and set titles.

## WP-Markdown
One of my "must have" plugins. I am allergic to WYSIWYG, and writing in pure HTML is... tedious. [WP-Markdown](http://wordpress.org/plugins/wp-markdown/) is based on the [PHP port Markdown Extra](http://michelf.ca/projects/php-markdown/extra/), and includes such lovely features such as code highlighting using [Google Code Prettify](https://code.google.com/p/google-code-prettify/), and previewing as you write. The one downside is that you'll need to use the `[embed]` shortcode to embed YouTube videos and such.

WP-Markdown is probably the one plugin I have tweaked the most, mainly since it uses a lot of styles and scripts, in a combination of the Prettify and the Editor.

### Prettify
The default theme for Prettify is light, and I wanted to use closer to the setup I have on my personal computer, so dark background and white font, with some pretty, reasonably bright colours for touching up. These styles were, obviously, baked into my stylesheet, as seen in the [_code.scss file](https://github.com/Melindrea/mariehogebrandt-se/blob/master/app/styles/components/_code.scss).

The `prettify.js` file loads in the head, so it is concatenated together with Modernizr and Selectivzr into the file `head.min.js` in the build step.

### Markdown
The styles for Markdown haven't been changed much from the original code in the plugin, but were copied over to it's own [file under components](https://github.com/Melindrea/mariehogebrandt-se/blob/master/app/styles/components/_markdown.scss), so that changes could be done.

There where quite a few scripts that I feel should be loaded in the footer, so they ended up being concatenated into `main.min.js` which is loaded in the footer. One of the biggest advantages to handcrafting a theme with specific plugins in mind.

### Code
And here's the actual code to clean up markdown, to be dropped into your `functions.php` file, or something similar. I am planning on breaking out that and the above code for Contact Form 7 into a file called `plugins.php`, so that I can deal with plugins as I add or remove them.

    function mh_remove_markdown()
    {
        if ( !is_admin()) {
            wp_deregister_style('wp-markdown-prettify');
            wp_deregister_style('wp-markdown-editor');

            wp_deregister_script('md_convert');
            wp_deregister_script('md_sanit');
            wp_deregister_script('md_edit');
            wp_deregister_script('wp-markdown-prettify');
            wp_deregister_script('wp-markdown-editor');
        }
    }
    add_action('wp_enqueue_scripts', 'mh_remove_markdown', 15);


## WP-PageNavi
Not much really needed to say about [this one](http://wordpress.org/plugins/wp-pagenavi/). It provides fancier pagination, and the CSS is default, but baked into the site CSS.

##wp-Typography
Through various means and ways, I eventually landed on [wp-Typography](http://wordpress.org/support/plugin/wp-typography) as a plugin that I'd like to use. However, as can be clearly seen, it hasn't been updated for two years. I have updated it some (mainly to remove deprecated calls), and the version I use [can be found on Github](https://github.com/Melindrea/wp-typography)

*[SEO]: Search Engine Optimization
