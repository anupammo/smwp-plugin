<?php

/**
 * Plugin Name: CIwebGroup-Plugin
 * Plugin URI: https://www.ciwebgroup.com/ciwebgroup-plugin/
 * Description: Extendify the blocks and template features of Elementor. Also can get lots of new template designes for pages and blocks for Elementor.
 * Version: 1.2.0
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


class CIWebGroupPlugin
{
	function __construct()
	{
		add_action('admin_menu', array($this, 'adminPage'));
		add_action('admin_init', array($this, 'settings'));
	}

	function settings()
	{
		add_settings_section('ciwg_first_section', null, null, 'ci-web-group-settings-page');
		add_settings_field('ciwg_location', 'Output Position', array($this, 'locationHTML'), 'ci-web-group-settings-page', 'ciwg_first_section');
		register_setting('ciwebgroupplugin', 'ciwg_location', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));
	}

	function locationHTML()
	{ ?>
		<select name="ciwg_location">
			<option value="0">At starting position</option>
			<option value="1">At ending position</option>
		</select>
	<?php }

	function adminPage()
	{
		add_options_page('CI Web Group Settings', 'CI Web Group', 'manage_options', 'ci-web-group-settings-page', array($this, 'settingsHTML'));
	}

	function settingsHTML()
	{
	?>
		<h1>Settings of CI Web Group</h1>
		<form action="options.php" method="POST">
			<?php 
			settings_fields('ciwebgroupplugin');
			do_settings_sections('ci-web-group-settings-page');
			submit_button();
			?>
		</form>
	<?php
	}
}

$cIWebGroupPlugin = new CIWebGroupPlugin();
