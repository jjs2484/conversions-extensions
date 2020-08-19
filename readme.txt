=== Conversions Extensions ===
Contributors: uniquelylost
Stable tag: 1.0.6
Tags: theme, extensions, homepage, social, nav
Tested up to: 5.5
Requires at least: 4.7
Requires PHP: 5.6
License: GPL-2.0-or-later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds homepage sections and other features to Conversions theme for WordPress.

== Description ==

Adds homepage sections and other features to <a href="https://wordpress.org/themes/conversions/">Conversions theme</a> for WordPress.

You can view the <a href="https://conversionswp.com/docs/documentation/">documentation</a> here.

= Extensions List: =

* Homepage sections
    * Hero
    * Clients
    * Counter
    * Icon features
    * Image features
    * Pricing
    * Team
    * Testimonials
    * Text
    * News
    * Blank

* Navbar variants
    * Menu right
    * Menu below

* Footer social icons

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

= 1.0.0 =
* Initial release

= 1.0.1 =
* New: Add navbar variants.
* New: Add conversions_navbar_below_extras filter.
* Update: NPM Dependencies.
* Update: Composer Dependencies.
* Update: Minor code refactoring.

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

= 1.0.3 =
* New: Add Team homepage section.
* New: Add PHP class autoloader.
* Update: Rename namespaces.
* Update: Separate homepage sections into PHP traits.

= 1.0.4 =
* Fix: Check pricing table button text or link exist before displaying.
* Update: NPM Dependencies.

= 1.0.5 =
* New: Add Text homepage section.
* Update: NPM Dependencies.

= 1.0.6 =
* New: Add Counter homepage section.
* Update: NPM Dependencies.