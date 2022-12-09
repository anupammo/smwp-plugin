<?php

/**
 * Plugin Name: CIwebGroup-Plugin
 * Plugin URI: https://www.ciwebgroup.com/ciwebgroup-plugin/
 * Description: Extendify the blocks and template features of Elementor. Also can get lots of new template designes for pages and blocks for Elementor.
 * Version: 1.1.0
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Anupam Mondal
 * Author URI: https://anupammondal.in/
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI: https://www.ciwebgroup.com/update-ciwebgroup-plugin/
 * Text Domain: ciwebgroup-plugin
 * Domain Path: /languages
 */


/**
 * Register the "book" custom post type
 */
function pluginprefix_setup_post_type()
{
	register_post_type('book', ['public' => true]);
}
add_action('init', 'pluginprefix_setup_post_type');


/**
 * Activate the plugin.
 */
function pluginprefix_activate()
{
	// Trigger our function that registers the custom post type plugin.
	pluginprefix_setup_post_type();
	// Clear the permalinks after the post type has been registered.
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'pluginprefix_activate');


/**
 * Deactivation hook.
 */
function pluginprefix_deactivate()
{
	// Unregister the post type, so the rules are no longer in memory.
	unregister_post_type('book');
	// Clear the permalinks to remove our post type's rules from the database.
	flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'pluginprefix_deactivate');


/**
 * Generate a Delete link based on the homepage url.
 *
 * @param string $content   Existing content.
 *
 * @return string|null
 */
function wporg_generate_delete_link($content)
{
	// Run only for single post page.
	if (is_single() && in_the_loop() && is_main_query()) {
		// Add query arguments: action, post.
		$url = add_query_arg(
			[
				'action' => 'wporg_frontend_delete',
				'post'   => get_the_ID(),
			],
			home_url()
		);
		return $content . ' <a style="background-color: #b01b1b;color: #ffffff;text-decoration: none;padding: 8px 16px;border-radius: 5px;margin: 50px auto;width: fit-content;display: block;" href="' . esc_url($url) . '">' . esc_html__('✘ Delete Post', 'wporg') . '</a>';
	}

	return null;
}


/**
 * Request handler
 */
function wporg_delete_post()
{
	if (isset($_GET['action']) && 'wporg_frontend_delete' === $_GET['action']) {

		// Verify we have a post id.
		$post_id = (isset($_GET['post'])) ? ($_GET['post']) : (null);

		// Verify there is a post with such a number.
		$post = get_post((int) $post_id);
		if (empty($post)) {
			return;
		}

		// Delete the post.
		wp_trash_post($post_id);

		// Redirect to admin page.
		$redirect = admin_url('edit.php');
		wp_safe_redirect($redirect);

		// We are done.
		die;
	}
}


/**
 * Add the delete link to the end of the post content.
 */
add_filter('the_content', 'wporg_generate_delete_link');

/**
 * Register our request handler with the init hook.
 */
add_action('init', 'wporg_delete_post');
