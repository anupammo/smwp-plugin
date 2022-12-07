<?php 
/**
* Plugin Name: CIwebGroup-Plugin
* Plugin URI: https://www.ciwebgroup.com/ciwebgroup-plugin/
* Description: Extendify the blocks and template features of Elementor. Also can get lots of new template designes for pages and blocks for Elementor.
* Version: 1.1.0
* Requires at least: 5.2
* Requires PHP: 7.2
* Author: CIwebGroup
* Author URI: https://www.ciwebgroup.com/
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Update URI: https://www.ciwebgroup.com/update-ciwebgroup-plugin/
* Text Domain: ciwebgroup-plugin
* Domain Path: /languages
*/


/**
 * Register the "book" custom post type
 */
function pluginprefix_setup_post_type() {
	register_post_type( 'book', ['public' => true ] ); 
} 
add_action( 'init', 'pluginprefix_setup_post_type' );


/**
 * Activate the plugin.
 */
function pluginprefix_activate() { 
	// Trigger our function that registers the custom post type plugin.
	pluginprefix_setup_post_type(); 
	// Clear the permalinks after the post type has been registered.
	flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'pluginprefix_activate' );


/**
 * Deactivation hook.
 */
function pluginprefix_deactivate() {
	// Unregister the post type, so the rules are no longer in memory.
	unregister_post_type( 'book' );
	// Clear the permalinks to remove our post type's rules from the database.
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivate' );