=== Conversions Extensions ===
Contributors: uniquelylost
Stable tag: 1.9.2
Tags: extensions, homepage, shortcodes, social icons, theme demos
Tested up to: 6.0
Requires at least: 4.7
Requires PHP: 5.6
License: GPL-2.0-or-later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The code in the main repo branch is undergoing a big shakeup to bring it up to date with bootstrap 5. Please use the v1.8.3 tag for stable version while this process happens. https://github.com/jjs2484/conversions-extensions/releases/tag/1.8.3

Adds homepage sections, one click demo imports, social icons, and other features to Conversions theme for WordPress.

== Description ==

Adds homepage sections, one click demo imports, social icons, and other features to <a href="https://wordpress.org/themes/conversions/">Conversions theme</a> for WordPress.

You can view the <a href="https://conversionswp.com/docs/documentation/">documentation</a> here.

= Extensions List: =

* Homepage Sections
    * Homepage Sorting
    * Clients
    * Counter
    * Easy Digital Downloads
    * FAQ
    * Gallery
    * Google Map
    * Hero
    * Icon features
    * Image features
    * Single feature
    * News
    * Pricing
    * Team
    * Testimonials
    * Text
    * WooCommerce
    * HTML or Shortcode

* One Click Demo Imports
    * Business demo
    * Blog demo

* Navbar Variants
    * Menu right
    * Menu below

* Social Icons
    * Navbar
    * Footer
    * Shortcode

= Shortcodes =

Many of the homepage sections can also be output outside the homepage using shortcodes.

[conversions_clients]
[conversions_counter]
[conversions_faq]
[conversions_gallery]
[conversions_google_map]
[conversions_icon_features]
[conversions_img_features]
[conversions_single_feature]
[conversions_social]
[conversions_pricing]
[conversions_team]
[conversions_testimonials]

= Resources =

* Slick v1.8.1 | MIT License
* Counter-Up2 v1.0.4 | MIT License
* lightbox2 v2.11.3 | MIT License

== Installation ==

= Automatic Installation =

1. Login to your Dashboard as admin.
2. Once logged in select Plugins -> Add New.
3. Upload Conversions Extensions and activate.

= Manual Install =
1. Extract the contents of conversions-extensions.zip and upload to the wp-content/plugins folder.
2. Login to your Dashboard as admin.
3. Activate the plugin through the 'Plugins' menu in WordPress.

== Changelog ==

= 1.8.4 =
* Update: Bootstrap to 5.1.1
* Update: NPM Dependencies.

= 1.8.3 =
* Update: NPM Dependencies.
* New: Action hook conversions_before_icon_features_section.
* New: Action hook conversions_after_icon_features_section.
* New: Filter conversions_single_feature_media.

= 1.8.2 =
* New: Action hook conversions_hero_full_after_content.
* New: Filter conversions_hero_description.
* New: Add shuffle option to testimonials.
* Update: Increase line-height for testimonial text.
* Update: Make default client logo width 8.5rem.
* Update: Pricing table check for additional fields to show output earlier.
* Update: Better auto responsive calculation for clients section.
* Update: Add conversions_counter_xs for counter section manual responsive breakpoints.
* Update: Move action hooks for homepage sections so they also apply to shortcodes.
* Update: Wrap c-hero__description in a div rather than p tag.
* Update: FAQ section allow HTML in answers.and fullwidth shortcode.
* Update: FAQ section shortcode should be 100% width.
* Update: Move homepage hero section higher in the customizer.
* Update: NPM Dependencies.
* Update: Composer Dependencies.
* Update: Make scroll listeners passive.
* Fix: add a default background color to testimonial quotes.
* Fix: Social media icons footer column should be set as variable width content - col-md-auto.
* Fix: New clients image repeater field was outputting the previous image until a new one was uploaded.

= 1.8.1 =
* New: Add Gallery homepage section.
* New: Add lightbox2.
* Update: Fontawesome to v5.15.3
* Update: Reorder customizer sections.
* Update: NPM Dependencies.

= 1.8.0 =
* Update: Lazy load more images.
* Update: NPM Dependencies.

= 1.7.4 =
* Update: bump WordPress tested to v5.7
* Update: WooCommerce homepage section only show products if a product type is set.
* Update: EDD homepage section only show products if a product type is set.
* Update: NPM Dependencies.

= 1.7.3 =
* New: Split Hero with masks.
* New: Hero bg color.
* Update: Remove Hero image parallax.
* Update: Remove action hook conversions_homepage_bottom_hero.
* Update: Refactor Hero, more modular elements.
* Update: Business demo import files.
* Update: NPM Dependencies.
* Update: Composer Dependencies.

= 1.7.2 =
* New: Add auto/manual breakpoints for counter items.
* Update: Navbar below variant: hide extras in base nav on desktop.
* Update: Navbar below variant: vertically align extras on desktop.
* Update: Navbar below variant: use customizer social icon size on desktop.
* Update: Navbar below variant: desktop dropdown styles.
* Update: NPM Dependencies.

= 1.7.1 =
* New: Add auto/manual breakpoints for icon features, img features, and team items.
* New: Add customizer option to add an alternative Hero title.
* New: Add CONVERSIONS_EXTENSIONS_VERSION constant.
* New: Action hook conversions_homepage_bottom_hero.
* Update: Font Awesome icons.json metadata to v5.15.2
* Update: Blog demo import.
* Update: Add jquery dep to all wp_enqueue_script calls.
* Update: Switch fixed header anchor link offset to use scroll-padding-top.
* Fix: Social icons in navbar vertical-align: middle.
* Update: NPM Dependencies.

= 1.7.0 =
* Update: Move OCDI files and demos into /ocdi folder and namespace.
* Update: Versioning to match theme major version points.
* Update: NPM Dependencies.
* Update: Composer Dependencies.

= 1.2.0 =
* New: Add One Click Demo Import.
* New: Business demo for import.
* New: Blog demo for import.
* New: Social Icons top level customizer menu.
* New: Option to add social icons to navbar.
* New: Social icon shortcode [conversions_social].
* New: Refactor and move social icon functions and styles from /footer/... to /social/...
* New: Filter conversions_footer_social_icons.
* New: Add navbar_menu_filter function.
* Update: Refactor functions in /navbar/Navbar_Variants.
* Update: Let homepage sections show with only a title or description.
* Update: Change repeater image field to use image IDs instead of URLs.
* Update: Switch single feature image customizer control to WP_Customize_Media_Control. Save IDs instead of URLs. Not backwards compatible, any previous image needs to be readded.  
* Update: NPM Dependencies.
* Update: Composer Dependencies.
* Fix: repeater/customizer-icons - reorder search term parameters for PHP 7.4.
* Fix: Switch some customizer sanitization callbacks from wp_filter_nohtml_kses to sanitize_text_field.
* Fix: Get homepage news post content from get_the_excerpt.
* Fix: Check homepage client logo URL exists before outputting any HTML.

= 1.1.2 =
* New: Add Google map homepage section.
* Update: Font Awesome JSON file to v5.15.1 for customizer icon picker.
* Update: Add Vimeo to single feature customizer media type description.
* Update: NPM Dependencies.
* Update: Composer Dependencies.
* Fix: Homepage sorting check on and off sections.

= 1.1.1 =
* Fix: Change homepage sorting drag and drop HTML structure.
