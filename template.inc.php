<?php
/**
 * Multisite Robots.txt Manager
 * @package Multisite Robots.txt Manager
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012, Chris Winters
 * @link http://technerdia.com/projects/robotstxt/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 0.2.0
 */

/**
 * MS Robots.txt Manager Admin Area Template
 */
?>
<!-- start here -->
<div class="wrap" style="width:98%;">
	<h2><?php _e('Multisite Robots.txt Manager - Network Settings', 'ms_robotstxt_manager');?></h2>
	<?php echo $this->robotstxt_tabs();?>
	<?php if ( $notice ) {?><div class="updated" id="message" onclick="this.parentNode.removeChild(this)"><p><strong><em><?php echo $notice;?></em></strong></p></div><?php }?>
		<div class="metabox-holder has-right-sidebar">
		<div id="post-body"><div id="post-body-content">
<?php if ( $_GET['tab'] == "robotstxt_presets" ) {?>
<!-- tab presets and examples -->
			<div class="postbox">
				<h3><span><?php _e('Making Life Easy', 'ms_robotstxt_manager');?></span></h3>
			<div class="inside">
				<p><?php _e('You can use the examples below to create your own unique robots.txt file.... or select Network or a Website from the dropdown, then locate the robots.txt file you like, then click "set as default" to publish that robots.txt file to the selected Website or the Networks default robots.txt file.', 'ms_robotstxt_manager');?></p>
				<p><strong><?php _e('Network', 'ms_robotstxt_manager');?></strong>: <?php _e('Publishing to the Network Robots.txt file, without a sitemap structure, will remove the default sitemap structure. It is recommended that you include the sitemap structure if you published to the Network robots.txt file.', 'ms_robotstxt_manager');?></p>
				<p><strong><?php _e('Websites', 'ms_robotstxt_manager');?></strong>: <?php _e('Publishing to a Website, without a sitemap structure, updates the robots.txt file only - no sitemap data is changed. However, including a sitemap structure, will update the sitemap data for the selected Website.', 'ms_robotstxt_manager');?></p>
	
				<hr />

				<h2><?php _e('Publish To', 'ms_robotstxt_manager');?>?</h2>
				<?php _e('Select the location to update.', 'ms_robotstxt_manager');?>..
				<form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] );?>" method="post">
				<?php wp_nonce_field( 'robotstxt_publish_action', 'robotstxt_publish_nonce' );?>
					<p><select name="selected_site"><option value="robotstxt_network_set"><?php _e('Network Robots.txt File', 'ms_robotstxt_manager');?></option><?php $this->robotstxt_select();?></select></p>

					<hr />

					<h2><?php _e('Sitemap Structure', 'ms_robotstxt_manager');?></h2>
					<?php _e('Define the Sitemap URL Structure to use.', 'ms_robotstxt_manager');?>
					<p><input type="checkbox" name="sitemap_show" value="yes" <?php echo $checked;?> /> <?php _e('Check To Add Sitemap URL To Robots.txt File', 'ms_robotstxt_manager');?><br />
					<input type="hidden" name="sitemap_hidden" value="1" />
					<p><?php _e('Sitemap URL Structure', 'ms_robotstxt_manager');?>: <input type="text" name="sitemap_structure" value="<?php echo $sitemap_structure;?>" size="70" /> [<a href="settings.php?tab=robotstxt_help&amp;page=ms_robotstxt.php#sitemap" target="_blank"><?php _e('help', 'ms_robotstxt_manager');?></a>]</p>

					<hr />

					<h2><?php _e('Select a Robots.txt File', 'ms_robotstxt_manager');?></h2>
					<?php _e('Click the "set as default" button to activate the selected robots.txt file.', 'ms_robotstxt_manager');?>

					<br /><br /><p><strong><?php _e('Default robots.txt File', 'ms_robotstxt_manager');?></strong>: <input type="submit" name="preset_default" value=" <?php _e('set as default', 'ms_robotstxt_manager');?> " /><br />
					<textarea name="value_default" cols="65" rows="12"><?php echo $default_robotstxt;?></textarea></p>

					<br /><p><strong><?php _e('Open 24/7', 'ms_robotstxt_manager');?></strong>: <input type="submit" name="preset_open" value=" <?php _e('set as default', 'ms_robotstxt_manager');?> " /><br />
					<textarea name="value_open" cols="65" rows="5"><?php echo $mini_robotstxt;?></textarea></p>

					<br /><p><strong><?php _e('Blogger Goes Crazy', 'ms_robotstxt_manager');?></strong>: <input type="submit" name="preset_blog" value=" <?php _e('set as default', 'ms_robotstxt_manager');?> " /><br />
					<textarea name="value_blog" cols="65" rows="15"><?php echo $blogger_robotstxt;?></textarea></p>

					<br /><p><strong><?php _e('Kill\'em All', 'ms_robotstxt_manager');?></strong>: <input type="submit" name="preset_kill" value=" <?php _e('set as default', 'ms_robotstxt_manager');?> " /><br />
					<textarea name="value_kill" cols="65" rows="5"><?php echo $blocked_robotstxt;?></textarea></p>
				</form>
			</div></div> <!-- end postbox and inside -->

<?php }elseif ( $_GET['tab'] == "robotstxt_help" ) {?>
<!-- how to use -->
			<div class="postbox">
					<h3><span><?php _e('How To Use the Multisite Robots.txt Manager', 'ms_robotstxt_manager');?></span></h3>
				<div class="inside">
				<p><?php _e('Feature Overview and How to use the Multisite Robots.txt Manager', 'ms_robotstxt_manager');?></p><br />

				<hr />

				<h2><?php _e('How It Works', 'ms_robotstxt_manager');?></h2>
				<?php _e('When you first enter the MS Robots.txt Settings page, the shown robots.txt file is the default "network only" or "network wide" working copy. Modify the default robots.txt file, save the default file, and when ready click the "publish to network" button to duplicate the robots.txt file to all Network Websites.', 'ms_robotstxt_manager');?><br />

				<hr />

				<h2><?php _e('Sitemap URLs and Structure', 'ms_robotstxt_manager');?></h2>
				<?php _e('Most Wordpress Sitemap Plugins can automatically add the Sitemap URL\'s to the robots.txt file for you. Be sure to disable this feature within other Plugins if you use the feature within this plugin, otherwise more than one sitemap url will be listed in the robots.txt file.', 'ms_robotstxt_manager');?><br />
				<p><?php _e('To add a Sitemap URL to a Robots.txt file, simply select the checkbox to add the sitemap url, then enter the Sitemap URL Structure to use.', 'ms_robotstxt_manager');?></p>
				<p><?php _e('Almost all Wordpress Installs will use', 'ms_robotstxt_manager');?>: http://[WEBSITE_URL]/sitemap.xml</p>
				<p><?php _e('The [brackets] within the Sitemap URL\'s automatically get replaced by the plugin (You Will Use Them). Network Wide Sitemap Updates "must" use the [bracket] structure to ensure Websites have the proper Sitemap URL. Unique Website updates can use the brackets OR take the full sitemap url directly.', 'ms_robotstxt_manager');?></p>

				<hr id="sitemap" />

				<h2><?php _e('Sitemap URL Structure', 'ms_robotstxt_manager');?></h2>
				<?php _e('Wordpress Sitemap URLs', 'ms_robotstxt_manager');?>: http://[WEBSITE_URL]/sitemap.xml<br />
				<?php _e('GoDaddy Sitemap URLs', 'ms_robotstxt_manager');?>: http://[WEBSITE_URL]/sitemaps/[DOMAIN]-[EXT].xml<br />
				<?php _e('Random Example', 'ms_robotstxt_manager');?>: http://[WEBSITE_URL]/[DOMAIN]-[EXT]-sitemap.xml.gz<br />

				<p><strong><?php _e('Structure Meaning', 'ms_robotstxt_manager');?></strong>:<br />
				[WEBSITE_URL] = domain.com<br />
				[DOMAIN] = domain<br />
				[EXT] = .com/net, etc.</p>

				<p>&bull; <?php _e('Always include the http:// with the Sitemap URL Structure.', 'ms_robotstxt_manager');?><br />
				&bull; <?php _e('If the sitemaps are within a directory, /include-the-path/ within the sitemap url.', 'ms_robotstxt_manager');?></p>

				<hr />

				<h2><?php _e('New Website Added to Network', 'ms_robotstxt_manager');?></h2>
				<?php _e('If every Website uses the Networks default robots.txt file, click the "publish to network" button to copy the default robots.txt file over to any new Websites you have.', 'ms_robotstxt_manager');?><br />
				<p><strong><?php _e('Per Site', 'ms_robotstxt_manager');?></strong>: <?php _e('Change to the Website in the dropdown. Then click the "reset this website" button to copy the default robots.txt file to this Website. If needed, modify the robots.txt file and click the "update this website" button once done.', 'ms_robotstxt_manager');?></p>

				<hr />

				<h2><?php _e('Manage a Websites Robots.txt File', 'ms_robotstxt_manager');?></h2>
				<?php _e('To manage a Website directly, select the Website from the dropdown, then click the "change sites" button. This will display the robots.txt file for the selected Website. Change the robots.txt file how you like, once done click the "update this website" button to publish the modification.', 'ms_robotstxt_manager');?>

				<hr />

				<h2><?php _e('Disable a Website', 'ms_robotstxt_manager');?></h2>
				<?php _e('To disable the MS Robots.txt Manager on a Website, click the "disable this website" button. This will clear the option settings for this Website, making the Wordpress default robots.txt file display.', 'ms_robotstxt_manager');?>

				<hr />

				<h2><?php _e('Resetting', 'ms_robotstxt_manager');?></h2>
				<strong><?php _e('Reset Default', 'ms_robotstxt_manager');?></strong>: <?php _e('Something wrong? No worries! When viewing the Networks robots.txt file, click the "reset to default" button to replace the displayed robots.txt file with the core "coded in" default robots.txt file.', 'ms_robotstxt_manager');?><br />
				<p><strong><?php _e('Reset Website', 'ms_robotstxt_manager');?></strong>: <?php _e('To reset a Websites robots.txt file, change to the Website within the dropdown, then click the "reset this website" button to pull in the "Networks Default Robots.txt file" (not the coded in default file).', 'ms_robotstxt_manager');?></p>

				<hr />

				<h2><?php _e('Presets / Examples Tab', 'ms_robotstxt_manager');?></h2>
				<?php _e('Use the provided examples to create your own robots.txt file.... or within the dropdown, select either the Networks Robots.txt file or a Websites Robots.txt file, then click the "set as default" button to copy the example over, to the selected file.', 'ms_robotstxt_manager');?><br />
				<p><em>* <?php _e('Presets can also use the Sitemap URL Structure setting. Read above on how to use this feature.', 'ms_robotstxt_manager');?></em></p>

				<hr />

				<h2><?php _e('Sitemap Plugins', 'ms_robotstxt_manager');?></h2>
				<?php _e('The Multisite Robots.txt Manager plugin has been tested with', 'ms_robotstxt_manager');?>:<br />
				<p><a href="http://wordpress.org/extend/plugins/google-xml-sitemaps-with-multisite-support/" target="_blank"><?php _e('Google XML Sitemaps with Multisite support', 'ms_robotstxt_manager');?></a>: <?php _e('One of the best, works well together. (recommend) ', 'ms_robotstxt_manager');?></p>
				<p><a href="http://wordpress.org/extend/plugins/bwp-google-xml-sitemaps/" target="_blank"><?php _e('BWP Google XML Sitemaps', 'ms_robotstxt_manager');?></a>: <?php _e('This is for "real" Multisite HOST Networks. If you use this plugin, use the Sitemap URL Structure feature to add sitemap URL\'s to unique Websites within the Network.', 'ms_robotstxt_manager');?></p>

				<hr />

				<p><strong>~<?php _e('Done', 'ms_robotstxt_manager');?>~</strong></p>
			</div></div> <!-- end postbox and inside -->

<?php }else{?>
<!-- front page of settings -->
			<div class="postbox">
				<?php if ( !$_POST['show_site'] ) {?>
					<h3><span><?php _e('Default / Network Wide Settings', 'ms_robotstxt_manager');?></span></h3>
				<?php }
				if ( $_POST['show_site'] ) {?>
					<h3><span><?php _e('Settings For This Website', 'ms_robotstxt_manager');?></span></h3>
				<?php }?>
			<div class="inside">
				<?php if ( !$_POST['show_site'] ) {?>
					<p><?php _e('The settings below are defaults to be published and used on Network Websites. Publishing the default settings to the network, duplicates the default settings to all Websites within the Network.', 'ms_robotstxt_manager');?></p>
					<p><strong><?php _e('What To Do', 'ms_robotstxt_manager');?></strong>: <?php _e('Modify the default or "Network Wide" robots.txt file and sitemap structure below, once done click the "save default settings" button to view the changes, then click the "publish to network" button to commit the changes to all Websites within the Network.', 'ms_robotstxt_manager');?></p>
				<?php }
				if ( $_POST['show_site'] ) {?>
					<?php if ( !get_option( "ms_robotstxt" ) ) { echo '<p>'. __('The MS Robots.txt Manager is DISABLED on this Website.') .'</p>'; }?>
					<?php if ( get_option( "ms_robotstxt" ) ) { echo '<p>'. __('The MS Robots.txt Manager is ACTIVE on this Website.') .'</p>'; }?>
				<?php }?>
	
				<hr />

				<h2><?php _e('Unique Robots.txt Files');?>:</h2>
				<?php if ( !$_POST['show_site'] ) {?><?php _e('To modify a Websites robots.txt file and sitemap structure directly, select the Website from the dropdown, then click the "change sites" button, to change to the selected Website.', 'ms_robotstxt_manager');?><br /><br /><?php }?>
				<form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] );?>" method="post">
				<?php wp_nonce_field( 'robotstxt_site_action', 'robotstxt_site_nonce' );?>
					<select name="show_site"><option value="robotstxt_redirect"><?php _e('Network Wide');?></option><?php $this->robotstxt_select();?></select>
					<input type="submit" name="submit" value=" change sites " /><?php if ( $_POST['show_site'] ) {?> [ <a href="<?php echo get_site_url( $_POST['show_site'], '/robots.txt' );?>" target="_blank"><?php _e('view');?> robots.txt</a> ]<?php }?><?php if ( $_GET['open'] ) {?> [ <a href="<?php echo get_site_url( $_GET['open'], '/wp-admin/index.php' );?>"><?php _e('Return to Site');?></a> ]<?php }?>
				</form>

				<br />

				<h2><?php if ( !$_POST['show_site'] ) {?><?php _e('Default', 'ms_robotstxt_manager');?> <?php }?><?php _e('Robots.txt File', 'ms_robotstxt_manager');?>:</h2>
				<?php _e('Modify, Save, then Publish.', 'ms_robotstxt_manager');?>..
				<form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] );?>" method="post">
				<?php wp_nonce_field( 'robotstxt_display_action', 'robotstxt_display_nonce' ); ?>
					<?php if ( $_POST['show_site'] ) {?><input type="hidden" name="show_site" value="<?php echo $_POST['show_site'];?>" /><?php }?>

						<?php if ( $_POST['reset_this_default'] ) {?>
							<p><textarea name="robotstxt_option" cols="85" rows="20"><?php echo $robotstxt_default;?></textarea></p>

						<?php }elseif ( $_POST['publish_ms_robotstxt'] ) { switch_to_blog(1);?>
							<p><textarea name="robotstxt_option" cols="85" rows="20"><?php if ( $_POST['robotstxt_option'] ) { echo $_POST['robotstxt_option']; }else{ echo $robotstxt_default; }?></textarea></p>

						<?php }elseif ( $_POST['disable_this_website'] ) {?>
							<p><textarea name="robotstxt_option" cols="85" rows="20">/* <?php _e('Robots.txt Disabled', 'ms_robotstxt_manager');?> */</textarea></p>

						<?php }elseif ( $_POST['reset_this_website'] ) {?>
							<p><textarea name="robotstxt_option" cols="85" rows="20"><?php echo $robotstxt_default;?></textarea></p>

						<?php }elseif ( $_POST['show_site'] ) {?>
							<p><textarea name="robotstxt_option" cols="85" rows="20"><?php if ( $_POST['robotstxt_option'] ) { echo $_POST['robotstxt_option']; }else{ echo $get_robotstxt_option; }?></textarea></p>

						<?php }else{?>
							<p><textarea name="robotstxt_option" cols="85" rows="20"><?php if ( $_POST['robotstxt_option'] ) { echo $_POST['robotstxt_option']; }else{ echo $robotstxt_default; }?></textarea></p>
						<?php }?>

						<?php if ( $_POST['show_site'] ) {?>
							<p><strong><?php _e('Add Sitemap URL To This Websites Robots.txt Files', 'ms_robotstxt_manager');?></strong><br />
						<?php }else{?>
							<p><strong><?php _e('Add Sitemap URL Structure To ALL Robots.txt Files', 'ms_robotstxt_manager');?></strong><br />
						<?php }?>

						<input type="checkbox" name="sitemap_show" value="yes" <?php echo $checked;?> /> <?php _e('Check To Add Sitemap URL To Robots.txt File', 'ms_robotstxt_manager');?></p>
						<input type="hidden" name="sitemap_hidden" value="1" />
						<p><strong><?php _e('Sitemap URL Structure', 'ms_robotstxt_manager');?><?php if ( $_POST['show_site'] ) {?> (<?php _e('or direct URL', 'ms_robotstxt_manager');?>)<?php }?></strong>: <input type="text" name="sitemap_structure" value="<?php echo $sitemap_structure;?>" size="80" /></p>

						<?php if ( $_POST['show_site'] && $sitemap_url ) {?>
							<p><strong><?php _e('Current Sitemap URL', 'ms_robotstxt_manager');?></strong>: <?php echo $sitemap_url;?></p>
						<?php }?>

						<?php if ( $_POST['show_site'] ) {?>
							<p><input type="submit" name="update_ms_robotstxt" value=" <?php _e('update this website', 'ms_robotstxt_manager');?> " /></p>
							<br />
							<p><input type="submit" name="reset_this_website" value=" <?php _e('reset this website', 'ms_robotstxt_manager');?> " /> <input type="submit" name="disable_this_website" value=" <?php _e('disable this website', 'ms_robotstxt_manager');?> " /></p>
							<p><small>* <?php _e('Resetting this website will copy the default network wide robots.txt file to this Website.', 'ms_robotstxt_manager');?></small><br />
							<small>* <?php _e('Disabling this Website clears the Website level robots.txt file and sitemap settings, then restores the default Wordpress robots.txt file.', 'ms_robotstxt_manager');?></small></p>
						<?php }else{?>
							<p><input type="submit" name="default_ms_robotstxt" value=" <?php _e('save default settings', 'ms_robotstxt_manager');?> " /> <input type="submit" name="publish_ms_robotstxt" value=" <?php _e('publish to network', 'ms_robotstxt_manager');?> " /></p>
							<br />
							<p><input type="submit" name="reset_this_default" value="<?php _e(' reset to default', 'ms_robotstxt_manager');?> " /></p>
							<p><small>* <?php _e('Resetting restores the default (network wide) robots.txt file (not websites) with the original coded-in version, while clearing the Sitemap structure and setting.', 'ms_robotstxt_manager');?></small></p>
						<?php }?>
				</form>
			</div></div> <!-- end postbox and inside -->

			<div class="postbox">
				<h3><span><?php _e('Example Sitemap URL Structure', 'ms_robotstxt_manager');?></span></h3>
			<div class="inside">
				<p><?php _e('The [brackets] within the Sitemap URL\'s automatically get replaced by the plugin (You Will Use Them). Network Wide Sitemap Updates "must" use the [bracket] structure to ensure Websites have the proper Sitemap URL. Unique Website updates can use the brackets OR take the full sitemap url directly.', 'ms_robotstxt_manager');?></p>

				<p><strong><?php _e('Sitemap URL Structure', 'ms_robotstxt_manager');?></strong><br />
				<strong><?php _e('Wordpress Sitemap URLs', 'ms_robotstxt_manager');?>:</strong> http://[WEBSITE_URL]/sitemap.xml<br />
				<strong><?php _e('GoDaddy Sitemap URLs', 'ms_robotstxt_manager');?>:</strong> http://[WEBSITE_URL]/sitemaps/[DOMAIN]-[EXT].xml<br />
				<strong><?php _e('Random Example', 'ms_robotstxt_manager');?>:</strong> http://[WEBSITE_URL]/[DOMAIN]-[EXT]-sitemap.xml.gz</p>

				<p><strong><?php _e('Structure Meaning', 'ms_robotstxt_manager');?>:</strong></p>
				<ol>
					<li>[WEBSITE_URL] = domain.com</li>
					<li>[DOMAIN] = domain</li>
					<li>[EXT] = .com/net, etc.</li>
				</ol>

				<hr />
				<p>&bull; <strong><em><?php _e('Always include the http:// with the Sitemap URL Structure.', 'ms_robotstxt_manager');?></em></strong><br />
				&bull; <strong><em><?php _e('If the sitemaps are within a directory, /include-the-path/ within the sitemap url.', 'ms_robotstxt_manager');?></em></strong></p>
			</div></div> <!-- end postbox and inside -->
<?php } /* end if */?>
		</div></div> <!-- end post-body and post-body-conten -->

<!-- start sidebar -->
	<div class="inner-sidebar">
		<div class="postbox">
			<h3><span><?php _e('The MS Robots.txt Manager', 'ms_robotstxt_manager');?></span></h3>
			<div class="inside">
				<ul>
					<li>&bull; <a href="http://technerdia.com/projects/robotstxt/plugin.html" target="_blank"><?php _e('Plugin Home Page', 'ms_robotstxt_manager');?></a> : <?php _e('Project Details', 'ms_robotstxt_manager');?></li>
					<li>&bull; <a href="http://wordpress.org/extend/plugins/multisite-robotstxt-manager/" target="_blank"><?php _e('Plugin at Wordpress.org', 'ms_robotstxt_manager');?></a> : MS Robots.txt</li>
					<li>&bull; <a href="http://wordpress.org/tags/ms-robotstxt-manager" target="_blank"><?php _e('Support Forum', 'ms_robotstxt_manager');?></a> : <?php _e('Problems, Questions', 'ms_robotstxt_manager');?>?</li>
					<li>&bull; <a href="http://technerdia.com/feedback.html" target="_blank"><?php _e('Submit Feedback', 'ms_robotstxt_manager');?></a> : <?php _e('I\'m Listening', 'ms_robotstxt_manager');?>!</li>
					<li>&bull; <a href="http://technerdia.com/projects.html" target="_blank"><?php _e('techNerdia Projects', 'ms_robotstxt_manager');?></a> : <?php _e('More Goodies!', 'ms_robotstxt_manager');?>!</li>
				</ul>
			</div> <!-- end inside -->
		</div> <!-- end postbox -->

		<div class="postbox">
			<h3><span><?php _e('Show Some Love', 'ms_robotstxt_manager');?>!</span></h3>
			<div class="inside">
				<ul>
					<li><strong>&raquo; <a href="http://wordpress.org/extend/plugins/multisite-robotstxt-manager/" target="_blank"><?php _e('Please Rate This Plugin', 'ms_robotstxt_manager');?>!</a></strong><br />
					<?php _e('It only takes a few seconds to', 'ms_robotstxt_manager');?> <a href="http://wordpress.org/extend/plugins/multisite-robotstxt-manager/" target="_blank"><?php _e('rate this plugin', 'ms_robotstxt_manager');?></a>! <?php _e('Your rating helps create motivation for future developments', 'ms_robotstxt_manager');?>!</li>
					<li style="text-align:center;"><p><strong><?php _e('Thank You For Your Support', 'ms_robotstxt_manager');?>!</strong></p>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="ZC85KWHZDA9DQ">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" name="submit" alt="Donate" style="border:0;">
					</form>
					<p><small><?php _e('Donate To The MS Robots.txt Project Directly', 'ms_robotstxt_manager');?>!</small></p>
					<p><strong><a href="http://www.amazon.com/registry/wishlist/3BXFUHL7NWQU1/" target="_blank"><?php _e('Amazon Wish List', 'ms_robotstxt_manager');?></a></strong></p></li>
				</ul>
			</div> <!-- end inside -->
		</div> <!-- end postbox -->

<?php if ( $_GET['tab'] != "" ) { /* Wordpress References */
	if ( $_GET['tab'] != "robotstxt_settings" ) {?>
		<div class="postbox">
			<h3><span><?php _e('Wordpress References', 'ms_robotstxt_manager');?></span></h3>
			<div class="inside">
				<ul><li><a href="http://codex.wordpress.org/Function_Reference/wp_safe_redirect" target="_blank">wp_safe_redirect</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/load_plugin_textdomain" target="_blank">load_plugin_textdomain</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/wp_die" target="_blank">wp_die</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/get_bloginfo" target="_blank">get_bloginfo</a>, 
					<a href="http://codex.wordpress.org/Class_Reference/wpdb" target="_blank">wpdb</a>, 
					<a href="http://codex.wordpress.org/I18n_for_WordPress_Developers" target="_blank">I18n</a>, 
					<a href="http://codex.wordpress.org/WPMU_Functions/switch_to_blog" target="_blank">switch_to_blog</a>, 
					<a href="http://codex.wordpress.org/WPMU_Functions/restore_current_blog" target="_blank">restore_current_blog</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/add_action" target="_blank">add_action</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/delete_option" target="_blank">delete_option</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/add_option" target="_blank">add_option</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/get_option" target="_blank">get_option</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/plugin_basename" target="_blank">plugin_basename</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/network_admin_url" target="_blank">network_admin_url</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/is_user_logged_in" target="_blank">is_user_logged_in</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/add_submenu_page" target="_blank">add_submenu_page</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/maybe_unserialize" target="_blank">maybe_unserialize</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/maybe_serialize" target="_blank">maybe_serialize</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/get_currentuserinfo" target="_blank">get_currentuserinfo</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/add_filter" target="_blank">add_filter</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/remove_filter" target="_blank">remove_filter</a>, 
					<a href="http://codex.wordpress.org/Function_Reference" target="_blank">all functions</a>, 
					<a href="http://codex.wordpress.org/Template_Tags" target="_blank">all template tags</a>, 
					<a href="http://codex.wordpress.org/Option_Reference" target="_blank">option reference</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/register_activation_hook" target="_blank">register_activation_hook</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/register_deactivation_hook" target="_blank">register_deactivation_hook</a>, 
					<a href="http://codex.wordpress.org/Database_Description#Table:_wp_options" target="_blank">database reference</a>.</li>
				</ul>
			</div> <!-- end inside -->
		</div> <!-- end postbox -->
<?php }
}?>

		<div class="postbox">
			<h3><span><?php _e('Robots.txt Documentation', 'ms_robotstxt_manager');?></span></h3>
			<div class="inside">
				<ul>
					<li>&bull; <a href="http://codex.wordpress.org/Search_Engine_Optimization_for_WordPress#Robots.txt_Optimization" target="_blank"><?php _e('Robots.txt Optimization Tips', 'ms_robotstxt_manager');?></a></li>
					<li>&bull; <a href="http://www.askapache.com/seo/updated-robotstxt-for-wordpress.html" target="_blank"><?php _e('AskAapche Robots.txt Example', 'ms_robotstxt_manager');?></a></li>
					<li>&bull; <a href="https://developers.google.com/webmasters/control-crawl-index/docs/faq" target="_blank"><?php _e('Google Robots.txt F.A.Q.', 'ms_robotstxt_manager');?></a></li>
					<li>&bull; <a href="settings.php?tab=robotstxt_help&amp;page=ms_robotstxt.php"><?php _e('How To Use This Plugin', 'ms_robotstxt_manager');?></a></li>
				</ul>
			</div> <!-- end inside -->
		</div> <!-- end postbox -->

	</div> <!-- end inner-sidebar -->
<!-- end sidebar -->
		</div> <!-- end metabox-holder has-right-sidebar -->

		<br style="clear:both;" /><br /><hr />
		<p style="text-align:right;"><small><b><?php _e('Created by', 'ms_robotstxt_manager');?></b>: <a href="http://technerdia.com/" target="_blank">techNerdia</a></small></p>
</div> <!-- end wrap -->
<!-- end here -->