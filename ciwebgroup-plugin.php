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
		add_filter('the_content', array($this, 'ifWrap'));
	}

	function ifWrap($content) {
		if((is_main_query() AND is_single()) AND 
		(
			get_option('wcp_wordcount', '1') OR 
			get_option('wcp_charactercount', '1') OR 
			get_option('wcp_readtime', '1')
		)) {
			return $this->createHTML($content);
		}
		return $content;
	}

	function createHTML($content) {
		return $content. ' Anupam';
	}

	function settings()
	{
		add_settings_section('ciwg_first_section', null, null, 'ci-web-group-settings-page');

		add_settings_field('ciwg_fbpage', 'Facebook Page exist?', array($this, 'fbPageExistHTML'), 'ci-web-group-settings-page', 'ciwg_first_section');
		register_setting('ciwebgroupplugin', 'ciwg_fbpage', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

		add_settings_field('ciwg_tweetpage', 'Twitter Page exist?', array($this, 'twitterPageExistHTML'), 'ci-web-group-settings-page', 'ciwg_first_section');
		register_setting('ciwebgroupplugin', 'ciwg_tweetpage', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

		add_settings_field('ciwg_linkedinpage', 'Linkedin Page exist?', array($this, 'linkedinPageExistHTML'), 'ci-web-group-settings-page', 'ciwg_first_section');
		register_setting('ciwebgroupplugin', 'ciwg_linkedinpage', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

		add_settings_field('ciwg_fburl', 'Facebook Page URL', array($this, 'fburlHTML'), 'ci-web-group-settings-page', 'ciwg_first_section');
		register_setting('ciwebgroupplugin', 'ciwg_fburl', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'https://www.facebook.com/'));

		add_settings_field('ciwg_tweeturl', 'Twitter Page URL', array($this, 'tweeturlHTML'), 'ci-web-group-settings-page', 'ciwg_first_section');
		register_setting('ciwebgroupplugin', 'ciwg_tweeturl', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'https://twitter.com/'));

		add_settings_field('ciwg_linkedinurl', 'Linkedin Page URL', array($this, 'linkedinurlHTML'), 'ci-web-group-settings-page', 'ciwg_first_section');
		register_setting('ciwebgroupplugin', 'ciwg_linkedinurl', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'https://www.linkedin.com/'));

		add_settings_field('ciwg_location', 'Output Position', array($this, 'locationHTML'), 'ci-web-group-settings-page', 'ciwg_first_section');
		register_setting('ciwebgroupplugin', 'ciwg_location', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));
	}

	function locationHTML()
	{ ?>
		<select name="ciwg_location">
			<option value="0" <?php selected(get_option('ciwg_location'), '0') ?>>At starting position</option>
			<option value="1" <?php selected(get_option('ciwg_location'), '1') ?>>At ending position</option>
		</select>
	<?php }

	function fburlHTML()
	{ ?>
		<input type="url" name="ciwg_fburl" id="fb_url" value="<?php echo esc_attr(get_option('ciwg_fburl')) ?>">
	<?php }

	function tweeturlHTML()
	{ ?>
		<input type="url" name="ciwg_tweeturl" id="tweet_url" value="<?php echo esc_attr(get_option('ciwg_tweeturl')) ?>">
	<?php }

	function linkedinurlHTML()
	{ ?>
		<input type="url" name="ciwg_linkedinurl" id="linkedin_url" value="<?php echo esc_attr(get_option('ciwg_linkedinurl')) ?>">
	<?php }

	function fbPageExistHTML()
	{ ?>
		<input type="radio" name="ciwg_fbpage" value="1" <?php checked(get_option('ciwg_fbpage'), '1') ?> id="fbYes" onchange="fburlYes();">
		<label>Yes</label>
		<input type="radio" name="ciwg_fbpage" value="0" <?php checked(get_option('ciwg_fbpage'), '0') ?> id="fbNo" onchange="fburlNo();">
		<label>No</label>
	<?php }

	function twitterPageExistHTML()
	{ ?>
		<input type="radio" name="ciwg_tweetpage" value="1" <?php checked(get_option('ciwg_tweetpage'), '1') ?> id="tweetYes" onchange="tweeturlYes();">
		<label>Yes</label>
		<input type="radio" name="ciwg_tweetpage" value="0" <?php checked(get_option('ciwg_tweetpage'), '0') ?> id="tweetNo" onchange="tweeturlNo();">
		<label>No</label>
	<?php }

	function linkedinPageExistHTML()
	{ ?>
		<input type="radio" name="ciwg_linkedinpage" value="1" <?php checked(get_option('ciwg_linkedinpage'), '1') ?> id="linkedinYes" onchange="linkedinurlYes();">
		<label>Yes</label>
		<input type="radio" name="ciwg_linkedinpage" value="0" <?php checked(get_option('ciwg_linkedinpage'), '0') ?> id="linkedinNo" onchange="linkedinurlNo();">
		<label>No</label>
	<?php }

	function adminPage()
	{
		add_options_page('CI Web Group Settings', 'CI Web Group', 'manage_options', 'ci-web-group-settings-page', array($this, 'settingsHTML'));
	}

	function settingsHTML()
	{
		wp_enqueue_style('style',  plugin_dir_url(__FILE__) . 'admin/css/style-sheet.css');
		wp_enqueue_script('script',  plugin_dir_url(__FILE__) . 'admin/js/script-file.js');
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
