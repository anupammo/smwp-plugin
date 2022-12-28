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


function ourPluginSettingsLink()
{
	add_options_page('CI Web Group Settings', 'CI Web Group', 'manage_options', 'ci-web-group-settings-page', 'ourSettingsPageHTML');
}

function ourSettingsPageHTML()
{
	wp_enqueue_style('style',  plugin_dir_url(__FILE__) . 'public/css/style.css');
	wp_enqueue_script('script',  plugin_dir_url(__FILE__) . 'public/js/admin-setting.js');
?>

	<h1>Settings of CI Web Group</h1>
	<hr />
	<form class="plugin-form" action="">
		<p id="demo"></p>
		<ol class="ol-style">
			<li>
				<p class="mb-5">Do you have Facebook account?</p>
				<input type="radio" id="fbYes" name="fb_ac" value="Yes" onchange="fburlYes()">
				<label>Yes</label>
				<input type="radio" id="fbNo" name="fb_ac" value="No" onchange="fburlNo()">
				<label>No</label>
				<br />
				<div id="fburlyes">
					<label class="my-10">URL of your Facebook account / page</label>
					<input type="url" id="fb_url" disabled>
				</div>
			</li>
			<li>
				<p class="mb-5">Do you have Linkedin account?</p>
				<input type="radio" id="liYes" name="li_ac" value="Yes" onchange="liurlYes()">
				<label>Yes</label>
				<input type="radio" id="liNo" name="li_ac" value="No" onchange="liurlNo()">
				<label>No</label>
				<br />
				<div id="liurlyes">
					<label class="my-10">URL of your Linkedin account / page</label>
					<input type="url" id="li_url" disabled>
				</div>
			</li>
			<li>
				<p class="mb-5">Do you have Instagram account?</p>
				<input type="radio" id="instaYes" name="insta_ac" value="Yes" onchange="instaurlYes()">
				<label>Yes</label>
				<input type="radio" id="instaNo" name="insta_ac" value="No" onchange="instaurlNo()">
				<label>No</label>
				<br />
				<div id="instaurlYes">
					<label class="my-10">URL of your Instagram account / page</label>
					<input type="url" id="insta_url" disabled>
				</div>
			</li>
			<li>
				<p class="mb-5">Do you have Twitter account?</p>
				<input type="radio" id="tweetYes" name="tweet_ac" value="Yes" onchange="tweeturlYes()">
				<label>Yes</label>
				<input type="radio" id="tweetNo" name="tweet_ac" value="No" onchange="tweeturlNo()">
				<label>No</label>
				<br />
				<div id="tweeturlyes">
					<label class="my-10">URL of your Twitter account / page</label>
					<input type="url" id="tweet_url" disabled>
				</div>
			</li>
		</ol>
	</form>

<?php }

add_action('admin_menu', 'ourPluginSettingsLink');
