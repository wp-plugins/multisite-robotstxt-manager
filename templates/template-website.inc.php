<?php
/**
 * Multisite Robots.txt Manager
 * @package Multisite Robots.txt Manager
 * @author tribalNerd (tribalnerd@technerdia.com)
 * @copyright Copyright (c) 2012-2013, techNerdia LLC.
 * @link http://msrtm.technerdia.com/
 * @license http://www.gnu.org/licenses/gpl.html
 * @version 0.3.1
 */

/**
 * ==================================== Website Admin Area Template
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */ ?>

<div class="wrap">
	<h2><?php _e('Multisite Robots.txt Manager - Website Settings', 'ms_robotstxt_manager');?></h2>
<?php /* page tabs */ echo $this->robotstxt_tabs();?>
<?php /* notices */ if ( isset( $notice ) ) {?><div class="updated" id="message" onclick="this.parentNode.removeChild(this)"><p><strong><em><?php echo $notice;?></em></strong></p></div><?php }?>
	<div class="metabox-holder has-right-sidebar">
	<div id="post-body"><div id="post-body-content">
<?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == "robotstxt_presets" ) {?>
<!-- tab presets and examples -->
		<div class="postbox">
			<h3><span><?php _e('Making Life Easy', 'ms_robotstxt_manager');?></span></h3>
		<div class="inside">
			<p><?php _e('The feature below allows you to quickly duplicate a premade robots.txt files to this Websites robots.txt file.', 'ms_robotstxt_manager');?></p>
			<p><strong><?php _e('To use', 'ms_robotstxt_manager');?></strong>: <?php _e('Check the box to add a sitemap structure, then click the "set as default" button above a robots.txt file example you want to use.', 'ms_robotstxt_manager');?></p>

			<hr />

				<form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] );?>" method="post">
				<?php wp_nonce_field( 'robotstxt_action', 'robotstxt_nonce' );?>

					<h2><?php _e('Sitemap Structure', 'ms_robotstxt_manager');?></h2>
					<?php _e('The Sitemap Structure below is based on the default Sitemap Structure defined under the Create/Manage tab.', 'ms_robotstxt_manager');?>
					<p><input type="checkbox" name="sitemap_show" value="yes" <?php echo $checked;?> /> <?php _e('Check To Add Sitemap URL To The Robots.txt File', 'ms_robotstxt_manager');?><br />
					<input type="hidden" name="sitemap_hidden" value="1" />
					<p><?php _e('Sitemap URL Structure', 'ms_robotstxt_manager');?>: <input type="text" name="sitemap_structure" value="<?php if ( isset( $sitemap_structure ) ) { echo $sitemap_structure; }?>" size="70" placeholder="click help for instructions" /> [<a href="options-general.php?tab=robotstxt_help&amp;page=ms_robotstxt.php#sitemap" target="_blank"><?php _e('help', 'ms_robotstxt_manager');?></a>]</p>

					<hr />

					<h2><?php _e('Select a Robots.txt File', 'ms_robotstxt_manager');?></h2>
					<?php _e('Click the "set as default" button to update the selected Website/Network robots.txt file.', 'ms_robotstxt_manager');?>
					<br /><br /><p><strong><?php _e('Default robots.txt File', 'ms_robotstxt_manager');?></strong>: <input type="submit" name="preset_default" value=" <?php _e('set as default', 'ms_robotstxt_manager');?> " /><br />
					<textarea name="value_default" cols="65" rows="12"><?php echo $default_robotstxt;?></textarea></p>

					<br /><p><strong><?php _e('Open 24/7', 'ms_robotstxt_manager');?></strong>: <input type="submit" name="preset_open" value=" <?php _e('set as default', 'ms_robotstxt_manager');?> " /><br />
					<textarea name="value_open" cols="65" rows="5"><?php echo $mini_robotstxt;?></textarea></p>

					<br /><p><strong><?php _e('Blogger Goes Crazy', 'ms_robotstxt_manager');?></strong>: <input type="submit" name="preset_blog" value=" <?php _e('set as default', 'ms_robotstxt_manager');?> " /><br />
					<textarea name="value_blog" cols="65" rows="15"><?php echo $blogger_robotstxt;?></textarea></p>

					<br /><p><strong><?php _e('Kill\'em All', 'ms_robotstxt_manager');?></strong>: <input type="submit" name="preset_kill" value=" <?php _e('set as default', 'ms_robotstxt_manager');?> " /><br />
					<textarea name="value_kill" cols="65" rows="5"><?php echo $blocked_robotstxt;?></textarea></p>
				</form>
		</div> <!-- end postbox -->
			<?php /* page tabs */ echo $this->robotstxt_tab_links();?>
		</div> <!-- end inside -->
<?php 	/*
	 * Tab - How to Use
	 */
	}elseif ( isset( $_GET['tab'] ) && $_GET['tab'] == "robotstxt_help" ) {
			require_once( dirname( __FILE__ ) . '/template-help.inc.php' );
	} else {?>
<!-- front page of settings -->
		<div class="postbox">
			<h3><span><?php _e('Settings For This Website', 'ms_robotstxt_manager');?></span></h3>
		<div class="inside">
			<p><?php _e('Modify the robots.txt file and sitemap structure below, once done click the "update this website" button to save your changes.', 'ms_robotstxt_manager');?></p>

		<hr />

		<br /><h2><?php _e('This Websites Robots.txt File', 'ms_robotstxt_manager');?>:</h2>
			<form action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] );?>" method="post">
			<?php wp_nonce_field( 'robotstxt_action', 'robotstxt_nonce' ); ?>

				<?php if ( isset( $_POST['reset_this_default'] ) ) {?>
					<p><textarea name="robotstxt_option" cols="85" rows="20"><?php echo $robotstxt_default;?></textarea></p>
				<?php }elseif ( isset( $_POST['publish_ms_robotstxt'] ) ) { switch_to_blog(1);?>
					<p><textarea name="robotstxt_option" cols="85" rows="20"><?php if ( isset( $_POST['robotstxt_option'] ) ) { echo $_POST['robotstxt_option']; }else{ echo $robotstxt_default; }?></textarea></p>
				<?php }elseif ( isset( $_POST['disable_this_website'] ) ) {?>
					<p><textarea name="robotstxt_option" cols="85" rows="20">/* <?php _e('Robots.txt Disabled', 'ms_robotstxt_manager');?> */</textarea></p>
				<?php }elseif ( isset( $_POST['reset_this_website'] ) ) {?>
					<p><textarea name="robotstxt_option" cols="85" rows="20"><?php echo $robotstxt_default;?></textarea></p>
				<?php }else{?>
					<p><textarea name="robotstxt_option" cols="85" rows="20"><?php if ( isset( $_POST['robotstxt_option'] ) ) { echo $_POST['robotstxt_option']; }else{ echo $robotstxt_default; }?></textarea></p>
				<?php }?>

					<p><strong><?php _e('Add Sitemap URL To This Websites Robots.txt File', 'ms_robotstxt_manager');?></strong>:<br />
					<input type="checkbox" name="sitemap_show" value="yes" <?php if ( isset( $checked ) ) { echo $checked; }?> <?php if ( isset( $readonly ) ) { echo $readonly; }?> /> <?php _e('Check To Add Sitemap URL To Robots.txt File', 'ms_robotstxt_manager');?></p>
					<input type="hidden" name="sitemap_hidden" value="1" />
				<p><strong><?php _e('Sitemap URL Structure', 'ms_robotstxt_manager');?></strong>: <input type="text" name="sitemap_structure" value="<?php if ( isset( $sitemap_structure ) ) { echo $sitemap_structure; }?>" size="80" placeholder="instructions below" <?php if ( isset( $readonly ) ) { echo $readonly; }?> /></p>

				<?php if ( isset( $readonly ) ) {?>
					<p><strong>* <?php _e('This Website Has Not Been Mapped.', 'ms_robotstxt_manager');?></strong> <?php _e('Non-mapped Websites with a /path/ defined will not have the sitemap url rendered.', 'ms_robotstxt_manager');?>  [<a href="settings.php?tab=robotstxt_help&amp;page=ms_robotstxt.php#sitemap_why" target="_blank"><?php _e('more info', 'ms_robotstxt_manager');?></a>]</p>
				<?php }?>


					<p><input type="submit" name="update_ms_robotstxt" value=" <?php _e('update this website', 'ms_robotstxt_manager');?> " /></p>
					<br />
					<p><input type="submit" name="reset_this_website" value=" <?php _e('reset this website', 'ms_robotstxt_manager');?> " /> <input type="submit" name="disable_this_website" value=" <?php _e('disable this website', 'ms_robotstxt_manager');?> " /></p>
					<p>* <small><?php _e('Resetting this website duplicates the default network wide robots.txt file and sitemap structure to this website.', 'ms_robotstxt_manager');?></small><br />
					* <small><?php _e('Disabling this website restores the default Wordpress robots.txt file.', 'ms_robotstxt_manager');?></small></p>

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
		</div> <!-- end postbox -->
			<?php /* page tabs */ echo $this->robotstxt_tab_links();?>
		</div> <!-- end inside -->
<?php } /* end if */?>
		</div></div> <!-- end post-body and post-body-content -->
<?php
	/**
	 *	Sidebar Menu
	 */
	require_once( dirname( __FILE__ ) . '/template-sidebar.inc.php' );?>
		</div> <!-- end metabox-holder has-right-sidebar -->
		<br style="clear:both;" /><br /><hr />
		<p style="text-align:right;"><small><b><?php _e('Created by', 'ms_robotstxt_manager');?></b>: <a href="http://technerdia.com/" target="_blank">techNerdia</a></small></p>
</div> <!-- end wrap -->

<script type="text/javascript">
if ( typeof tb_pathToImage != 'string' ) {
    var tb_pathToImage = "<?php echo get_bloginfo('url').'/wp-includes/js/thickbox'; ?>/loadingAnimation.gif";
}
if ( typeof tb_closeImage != 'string' ) {
    var tb_closeImage = "<?php echo get_bloginfo('url').'/wp-includes/js/thickbox'; ?>/tb-close.png";
}
</script>