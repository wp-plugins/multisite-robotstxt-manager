<?php
/**
 * Multisite Robots.txt Manager
 * @package Multisite Robots.txt Manager
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012, Chris Winters
 * @link http://technerdia.com/projects/robotstxt/plugin.html
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 0.1
 */

/**
 * MS Robots.txt Manager Admin Area Template
 */
?>
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
	
				<h2><?php _e('Publish To', 'ms_robotstxt_manager');?>?</h2>
				<form action="" method="post">
				<?php wp_nonce_field( 'robotstxt_publish_action', 'robotstxt_publish_nonce' );?>
					<select name="selected_site"><option value="robotstxt_network_set">Network Robots.txt File</option><?php $this->robotstxt_select();?></select>

					<br /><hr />

					<br /><p><strong><?php _e('Default robots.txt File', 'ms_robotstxt_manager');?></strong>: <input type="submit" name="preset_default" value=" <?php _e('set as default', 'ms_robotstxt_manager');?> " /><br />
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
				
				<h2><?php _e('How It Works', 'ms_robotstxt_manager');?></h2>
				<p><?php _e('When you first enter the MS Robots.txt Settings page, the shown robots.txt file is the default "network only" or "network wide" working copy. Modify the default robots.txt file, save the default file, and when ready click the publish to network to duplicate the robots.txt file to all Network Websites.', 'ms_robotstxt_manager');?></p>

				<h2><?php _e('New Website Added to Network', 'ms_robotstxt_manager');?></h2>
				<p><?php _e('If every Website uses the Networks default robots.txt file, simply click the "publish to network" button to copy the default robots.txt file over to any new Websites you have.', 'ms_robotstxt_manager');?></p>

				<p><strong><?php _e('Per Site');?>:</strong> <?php _e('Change to the Website in the dropdown. Then click the "reset this website" button to copy the default robots.txt file to this Website. If needed, modify the robots.txt file and click the "update this website" button once done.', 'ms_robotstxt_manager');?></p>

				<h2><?php _e('Manage a Websites Robots.txt File', 'ms_robotstxt_manager');?></h2>
				<p><?php _e('To manage a Website directly, select the Website from the dropdown, then click the "change sites" button. This will display the robots.txt file for the selected Website. Change the robots.txt file how you like, once done click the "update this website" button to publish the modification.', 'ms_robotstxt_manager');?></p>

				<h2><?php _e('Disable a Website', 'ms_robotstxt_manager');?></h2>
				<p><?php _e('To disable the MS Robots.txt Manager on a Website, click the "disable this website" button. This will clear the option settings for this Website, making the Wordpress default robots.txt file display.', 'ms_robotstxt_manager');?></p>

				<h2><?php _e('Reseting', 'ms_robotstxt_manager');?></h2>
				<p><strong><?php _e('Reset Default');?>:</strong> <?php _e('Something wrong? No worries! When viewing the Networks robots.txt file, click the "reset to default" button to replace the displayed robots.txt file with the core "coded in" default robots.txt file.', 'ms_robotstxt_manager');?></p>

				<p><strong><?php _e('Reset Website');?>:</strong> <?php _e('To reset a Websites robots.txt file, change to the Website within the dropdown, then click the "reset this website" button to pull in the "Networks Default Robots.txt file" (not the coded in default file).', 'ms_robotstxt_manager');?></p>

				<h2><?php _e('Presets / Examples Tab', 'ms_robotstxt_manager');?></h2>
				<p><?php _e('Use the provided examples to create your own robots.txt file.... or within the dropdown, select either the Networks Robots.txt file or a Websites Robots.txt file, then click the "set as default" button to copy the example over, to the selected file.', 'ms_robotstxt_manager');?></p>
				
				<h2><?php _e('Sitemaps and Sitemap Plugins', 'ms_robotstxt_manager');?></h2>
				<p><?php _e('In a future release I will add an auto sitemap detector..... for now, it is best to use one of the more popular sitemap plugins, which adds the sitemap URL to the robots.txt file for you.', 'ms_robotstxt_manager');?></p>
				<p><?php _e('I recommend', 'ms_robotstxt_manager');?>: <a href="http://wordpress.org/extend/plugins/google-xml-sitemaps-with-multisite-support/" target="_blank"><?php _e('Google XML Sitemaps with Multisite support', 'ms_robotstxt_manager');?></a></p>
				<p><strong><?php _e('Note', 'ms_robotstxt_manager');?></strong> <?php _e('The robots.txt files are cached by php. If you are having issues with getting the sitemap url to display, update / refresh that Websites robots.txt file within the manager. ', 'ms_robotstxt_manager');?></p>

				<p><strong>~<?php _e('Done', 'ms_robotstxt_manager');?>~</strong></p>
			</div></div> <!-- end postbox and inside -->

<?php }else{?>
<!-- front page of settings -->
			<div class="postbox">
				<?php if ( !$_POST['show_site'] ) {?>
					<h3><span><?php _e('Viewing the Default Network Robots.txt File', 'ms_robotstxt_manager');?></span></h3>
				<?php }
				if ( $_POST['show_site'] ) {?>
					<h3><span><?php _e('Viewing a Websites Robots.txt File', 'ms_robotstxt_manager');?></span></h3>
				<?php }?>
			<div class="inside">
				<?php if ( !$_POST['show_site'] ) {?>
					<p><?php _e('The "Network Wide" robots.txt file is NOT a live robots.txt file!');?></p>
					<?php if ( !get_option( "ms_robotstxt" ) ) { echo '<p>'. __('Click "publish to network" to quickly populate and set active all websites robots.txt files.') .'</p>'; }?>
				<?php }
				if ( $_POST['show_site'] ) {?>
					<?php if ( !get_option( "ms_robotstxt" ) ) { echo '<p>'. __('The MS Robots.txt Manager is DISABLED on this Website.') .'</p>'; }?>
					<?php if ( get_option( "ms_robotstxt" ) ) { echo '<p>'. __('The MS Robots.txt Manager is ACTIVE on this Website.') .'</p>'; }?>
				<?php }?>
	
				<hr />

				<h2><?php _e('Unique Robot.txt Files');?>:</h2>
				<form action="" method="post">
				<?php wp_nonce_field( 'robotstxt_site_action', 'robotstxt_site_nonce' );?>
					<select name="show_site"><option value="robotstxt_redirect"><?php _e('Network Wide');?></option><?php $this->robotstxt_select();?></select>
					<input type="submit" name="submit" value=" change sites " /><?php if ( $_POST['show_site'] ) {?> [ <a href="<?php echo get_site_url( $_POST['show_site'], '/robots.txt' );?>" target="_blank"><?php _e('view');?> robots.txt</a> ]<?php }?><?php if ( $_GET['open'] ) {?> [ <a href="<?php echo get_site_url( $_GET['open'], '/wp-admin/index.php' );?>"><?php _e('Return to Site');?></a> ]<?php }?>
				</form>

				<br />
				<h2><?php _e('Robot.txt File Display', 'ms_robotstxt_manager');?>:</h2>
				<form action="" method="post">
				<?php wp_nonce_field( 'robotstxt_display_action', 'robotstxt_display_nonce' ); ?>
					<?php if ( $_POST['show_site'] ) {?><input type="hidden" name="show_site" value="<?php echo $_POST['show_site'];?>" /><?php }?>

						<?php if ( $_POST['reset_this_default'] ) {?>
							<p><textarea name="robotstxt_option" cols="85" rows="20"><?php echo get_option( "ms_robotstxt_default" );?></textarea></p>

						<?php }elseif ( $_POST['publish_ms_robotstxt'] ) { switch_to_blog(1);?>
							<p><textarea name="robotstxt_option" cols="85" rows="20"><?php echo get_option( "ms_robotstxt_default" );?></textarea></p>

						<?php }elseif ( $_POST['show_site'] ) {?>
							<p><textarea name="robotstxt_option" cols="85" rows="20"><?php echo get_option( "ms_robotstxt" );?></textarea></p>

						<?php }else{?>
							<p><textarea name="robotstxt_option" cols="85" rows="20"><?php echo get_option( "ms_robotstxt_default" );?></textarea></p>

						<?php }?>

						<?php if ( $_POST['show_site'] ) {?>
							<p><input type="submit" name="update_ms_robotstxt" value=" <?php _e('update this website', 'ms_robotstxt_manager');?> " /></p>
							<br />
							<p><input type="submit" name="reset_this_website" value=" <?php _e('reset this website', 'ms_robotstxt_manager');?> " /> <input type="submit" name="disable_this_website" value=" <?php _e('disable this website', 'ms_robotstxt_manager');?> " /></p>
							<p><small>* <?php _e('Resetting this website will copy the default network wide robots.txt file to this Website.', 'ms_robotstxt_manager');?></small></p>
						<?php }else{?>
							<p><input type="submit" name="default_ms_robotstxt" value=" <?php _e('save default file', 'ms_robotstxt_manager');?> " /> <input type="submit" name="publish_ms_robotstxt" value=" <?php _e('publish to network', 'ms_robotstxt_manager');?> " /></p>
							<br />
							<p><input type="submit" name="reset_this_default" value="<?php _e(' reset to default', 'ms_robotstxt_manager');?> " /></p>
							<p><small>* <?php _e('Resetting the Network Wide robots.txt file restores the robots.txt data that is coded into the plugin.', 'ms_robotstxt_manager');?></small></p>
						<?php }?>
				</form>
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
					<li>&bull; <a href="http://wordpress.org/extend/plugins/ms-robotstxt-manager/" target="_blank"><?php _e('Plugin at Wordpress.org', 'ms_robotstxt_manager');?></a> : MS Robots.txt</li>
					<li>&bull; <a href="http://wordpress.org/tags/ms-robotstxt-manager" target="_blank"><?php _e('Support Forum', 'ms_robotstxt_manager');?></a> : <?php _e('Problems, Questions', 'ms_robotstxt_manager');?>?</li>
					<li>&bull; <a href="http://technerdia.com/feedback.html" target="_blank"><?php _e('Submit Feedback', 'ms_robotstxt_manager');?></a> : <?php _e('I\'m Listening', 'ms_robotstxt_manager');?>!</li>
					<li>&bull; <a href="http://technerdia.com/projects.html" target="_blank"><?php _e('techNerdia Projects', 'ms_robotstxt_manager');?></a> : <?php _e('More Goodies!', 'ms_robotstxt_manager');?>!</a></li>
				</ul>
			</div> <!-- end inside -->
		</div> <!-- end postbox -->

		<div class="postbox">
			<h3><span><?php _e('Show Some Love', 'ms_robotstxt_manager');?>!</span></h3>
			<div class="inside">
				<ul>
					<li><strong>&raquo; <a href="http://wordpress.org/extend/plugins/ms-robotstxt-manager/" target="_blank"><?php _e('Please Rate This Plugin', 'ms_robotstxt_manager');?>!</a></strong><br />
					<?php _e('It only takes a few seconds to', 'ms_robotstxt_manager');?> <a href="http://wordpress.org/extend/plugins/ms-robotstxt-manager/" target="_blank"><?php _e('rate this plugin', 'ms_robotstxt_manager');?></a>! <?php _e('Your rating helps create motivation for future developments', 'ms_robotstxt_manager');?>!</li>
					<li style="text-align:center;"><p><strong><?php _e('Thank You For Your Support', 'ms_robotstxt_manager');?>!</strong></p>
					<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="hosted_button_id" value="ZC85KWHZDA9DQ">
						<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="Donate">
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
					<a href="http://codex.wordpress.org/Function_Reference/register_activation_hook" target="_blank">register_activation_hook</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/get_bloginfo" target="_blank">get_bloginfo</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/register_deactivation_hook" target="_blank">register_deactivation_hook</a>, 
					<a href="http://codex.wordpress.org/Class_Reference/wpdb" target="_blank">wpdb</a>, 
					<a href="http://codex.wordpress.org/I18n_for_WordPress_Developers" target="_blank">I18n</a>, 
					<a href="http://codex.wordpress.org/WPMU_Functions/switch_to_blog" target="_blank">switch_to_blog</a>, 
					<a href="http://codex.wordpress.org/WPMU_Functions/restore_current_blog" target="_blank">restore_current_blog</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/get_transient" target="_blank">get_transient</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/delete_transient" target="_blank">delete_transient</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/set_transient" target="_blank">set_transient</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/add_action" target="_blank">add_action</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/delete_option" target="_blank">delete_option</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/add_option" target="_blank">add_option</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/get_option" target="_blank">get_option</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/plugin_basename" target="_blank">plugin_basename</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/network_admin_url" target="_blank">network_admin_url</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/is_user_logged_in" target="_blank">is_user_logged_in</a>, 
					<a href="http://codex.wordpress.org/Function_Reference/add_submenu_page" target="_blank">add_submenu_page</a>, 
					<a href="http://codex.wordpress.org/Function_Reference" target="_blank">all functions</a>, 
					<a href="http://codex.wordpress.org/Template_Tags" target="_blank">all template tags</a>, 
					<a href="http://codex.wordpress.org/Option_Reference" target="_blank">option reference</a>, 
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
					<li>&bull; <a href="settings.php?tab=robotstxt_help&page=ms_robotstxt.php"><?php _e('How To Use This Plugin', 'ms_robotstxt_manager');?></a></li>
				</ul>
			</div> <!-- end inside -->
		</div> <!-- end postbox -->

	</div> <!-- end inner-sidebar -->
<!-- end sidebar -->
		</div> <!-- end metabox-holder has-right-sidebar -->

		<br style="clear:both;" /><br /><hr />
		<p align="right"><small><b><?php _e('Created by', 'ms_robotstxt_manager');?></b>: <a href="http://technerdia.com/" target="_blank">techNerdia</a></small></p>
</div> <!-- end wrap -->