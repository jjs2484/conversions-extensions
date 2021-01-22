=== Conversions Extensions ===
Contributors: uniquelylost
Stable tag: 1.7.1
Tags: extensions, homepage, shortcodes, social icons, theme demos
Tested up to: 5.6
Requires at least: 4.7
Requires PHP: 5.6
License: GPL-2.0-or-later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

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

= 1.7.1 =
* New: Action hook conversions_homepage_bottom_hero.
* Update: Font Awesome icons.json metadata to v5.15.2
* Update: Add customizer option to add an alternative Hero title.
* Update: Add auto/manual breakpoints for icon features, img features, and team items.
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

= 1.1.0 =
* New: Add Single Feature homepage section.
* Update: Customizer Font Awesome icon picker now includes all icons in popover with search filter.
* Update: Customizer Font Awesome icon picker styles.
* Update: Reorder homepage customizer sections alphabetically.
* Update: Rename "Blank" homepage customizer section to "HTML or Shortcode".
* Update: Rename some homepage icon features files, functions, and variables.
* Update: NPM Dependencies.
* Update: Add Homepage Hero YouTube video modal script from Conversions theme.
* Fix: Correct some customizer controls capabilities.
* Fix: Prevent FAQ styles from leaking to other Bootstrap collapse elements.

= 1.0.9 =
* Fix: Navbar Variants namespace paths.

= 1.0.8 =
* Update: Style refinements for FAQ section
* Update: NPM Dependencies.

= 1.0.7 =
* New: Add FAQ homepage section.
* Update: Reorg scripts and styles to sections folders.
* Update: NPM Dependencies.

= 1.0.6 =
* New: Add Counter homepage section.
* New: Add Shortcodes.
* Update: NPM Dependencies.
* Fix: Refresh repeater color control on more input actions: change, paste.

= 1.0.5 =
* New: Add Text homepage section.
* Update: NPM Dependencies.

= 1.0.4 =
* Fix: Check pricing table button text or link exist before displaying.
* Update: NPM Dependencies.

= 1.0.3 =
* New: Add Team homepage section.
* New: Add PHP class autoloader.
* Update: Rename namespaces.
* Update: Separate homepage sections into PHP traits.

= 1.0.2 =
* New: Add image features homepage section.
* New: Add blank homepage section.
* Update: rename "features" homepage section in customizer to "icon features".
* Update: NPM Dependencies.
* Update: Composer Dependencies.
* New: do_action hooks:
    * conversions_before_img_features
    * conversions_after_img_features
    * conversions_homepage_before_blank
    * conversions_homepage_after_blank
* Update: rename do_action hooks:
    * conversions_homepage_before_features -> conversions_before_icon_features
    * conversions_homepage_after_features -> conversions_after_icon_features
* Update: Change Homepage Sorting section display order in the customizer.

= 1.0.1 =
* New: Add navbar variants.
* New: Add conversions_navbar_below_extras filter.
* Update: NPM Dependencies.
* Update: Composer Dependencies.
* Update: Minor code refactoring.

= 1.0.0 =
* Initial release
