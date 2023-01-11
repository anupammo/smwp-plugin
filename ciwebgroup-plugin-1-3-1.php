<?php

/**
 * Version: 1.3.0
 */


class CIWebGroupPlugin
{
	function __construct()
	{
		add_action('admin_menu', array($this, 'adminPage'));
		add_action('admin_init', array($this, 'settings'));
		add_action('wp_enqueue_scripts', array($this, 'mytheme_enqueue_style'));
		add_filter('the_content', array($this, 'ifWrap'));
	}

	function mytheme_enqueue_style()
	{
		wp_enqueue_style('mytheme-style', plugin_dir_url(__FILE__) . 'public/css/style.css');
	}

	function ifWrap($content)
	{
		if (
			(is_main_query() and is_single())
			and
			(get_option('wcp_wordcount', '1') or
				get_option('wcp_charactercount', '1') or
				get_option('wcp_readtime', '1')
			)
		) {
			return $this->createHTML($content);
		}
		return $content;
	}

	function createHTML($content)
	{
		$icoalign = get_option('ciwg_align', '0');
		$isize = get_option('ciwg_isize', '0');
		$flink = get_option('ciwg_fbpage', '1');
		$tlink = get_option('ciwg_tweetpage', '1');
		$llink = get_option('ciwg_linkedinpage', '1');
		// $fico = "f";
		// $tico = "t";
		// $lico = "l";
		$alignment = "na";
		if ($flink == "1") {
			$fico =
				'<a href=' . get_option('ciwg_fburl', 'https://www.facebook.com/') . '  target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
						<path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
					</svg>
				</a>';
		} else {
			$fico = '';
		}
		if ($tlink == "1") {
			$tico =
				'<a href=' . get_option('ciwg_tweeturl', 'https://twitter.com/') . '  target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
						<path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
					</svg>
				</a>';
		} else {
			$tico = '';
		}
		if ($llink == "1") {
			$lico =
				'<a href=' . get_option('ciwg_linkedinurl', 'https://www.linkedin.com/') . ' target="_blank">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
						<path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
					</svg>
				</a>';
		} else {
			$lico = '';
		}

		if ($icoalign == "0") {
			$alignment = "txt-center";
		} elseif ($icoalign == "2") {
			$alignment = "txt-right";
		} else {
			$alignment = "";
		}

		if ($isize == 1) {
			$icosize = "i-30";
		} elseif ($isize == 2) {
			$icosize = "i-36";
		} elseif ($isize == 3) {
			$icosize = "i-42";
		} elseif ($isize == 4) {
			$icosize = "i-48";
		} elseif ($isize == 5) {
			$icosize = "i-60";
		} else {
			$icosize = "i-24";
		}

		$html = '<p id="social-icon-links" class="' . $alignment . '">
			<span id="i-facebook" class="' . $icosize . '">' . $fico . '</span>
			<span id="i-twitter" class="' . $icosize . '">' . $tico . '</span>
			<span id="i-linkedin" class="' . $icosize . '">' . $lico . '</span>
		</p>';

		if (get_option('ciwg_location', '0') == '0') {
			return $html . $content;
		}
		return $content . $html;
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

		add_settings_field('ciwg_location', 'Display position', array($this, 'locationHTML'), 'ci-web-group-settings-page', 'ciwg_first_section');
		register_setting('ciwebgroupplugin', 'ciwg_location', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));

		add_settings_field('ciwg_align', 'Select alignment', array($this, 'alignICONS'), 'ci-web-group-settings-page', 'ciwg_first_section');
		register_setting('ciwebgroupplugin', 'ciwg_align', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

		add_settings_field('ciwg_isize', 'Social icons size', array($this, 'iSize'), 'ci-web-group-settings-page', 'ciwg_first_section');
		register_setting('ciwebgroupplugin', 'ciwg_isize', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));
	}

	function locationHTML()
	{ ?>
		<select name="ciwg_location">
			<option value="0" <?php selected(get_option('ciwg_location'), '0') ?>>Top</option>
			<option value="1" <?php selected(get_option('ciwg_location'), '1') ?>>Bottom</option>
		</select>
	<?php }

	function alignICONS()
	{ ?>
		<select name="ciwg_align">
			<option value="1" <?php selected(get_option('ciwg_align'), '1') ?>>Left</option>
			<option value="0" <?php selected(get_option('ciwg_align'), '0') ?>>Center</option>
			<option value="2" <?php selected(get_option('ciwg_align'), '2') ?>>Right</option>
		</select>
	<?php }

	function iSize()
	{ ?>
		<select name="ciwg_isize">
			<option value="0" <?php selected(get_option('ciwg_isize'), '0') ?>>24px</option>
			<option value="1" <?php selected(get_option('ciwg_isize'), '1') ?>>30px</option>
			<option value="2" <?php selected(get_option('ciwg_isize'), '2') ?>>36px</option>
			<option value="3" <?php selected(get_option('ciwg_isize'), '3') ?>>42px</option>
			<option value="4" <?php selected(get_option('ciwg_isize'), '4') ?>>48px</option>
			<option value="5" <?php selected(get_option('ciwg_isize'), '5') ?>>60px</option>
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
