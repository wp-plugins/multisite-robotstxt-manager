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
 *  ==================================== Sidebar Menu Template
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */ ?>

<!-- start sidebar -->
	<div class="inner-sidebar">
<?php if ( $this->robotstxt_ms_version( $check = true ) ) {?>
		<div class="postbox">
			<h3><span><?php _e('Pro Extension Updates', 'ms_robotstxt_manager');?></span></h3>
		<div class="inside">
			<ul>
				<li><div class="action-links">&bull; <strong><a href="http://msrtm.technerdia.com/updates.html?v=0.1&amp;loc=en_US&amp;KeepThis=true&amp;height=400&amp;width=400&amp;TB_iframe=true" class="thickbox" style="color:#cc0000;font-size:16px;"><?php _e('Check For Pro Updates', 'ms_robotstxt_manager');?></a></strong></div></li>
			</ul>
		</div></div> <!-- end inside & postbox -->
<?php }?>

<?php if ( $this->robotstxt_ms_version( $check = true ) ) {?>
		<div class="postbox">
			<h3><span><?php _e('Get Update Notices', 'ms_robotstxt_manager');?></span></h3>
		<div class="inside">
			<ul>
				<li><p><strong><?php _e('Pro Extension Update Notices!', 'ms_robotstxt_manager');?></strong><br />
					<small>Update Notices Only - No Spam - No Marketing!</small></p>
				 <form method="post" class="af-form-wrapper" action="http://www.aweber.com/scripts/addlead.pl">
					<input type="hidden" name="redirect" value="http://msrtm.technerdia.com/news/thanks.html" id="redirect_c2c307da65256869547b283e71d1095e" />
					<input type="hidden" name="meta_web_form_id" value="1626843326" />
					<input type="hidden" name="meta_adtracking" value="Main_Form" />
					<input type="hidden" name="meta_required" value="email,name" />
					<input type="hidden" name="listname" value="msrtm-pro" />
					<input type="hidden" name="meta_message" value="1" />
					<input type="hidden" name="meta_split_id" value="" />
					<input type="hidden" name="meta_tooltip" value="" />
						<p><input type="text" name="email" value="" tabindex="500" placeholder="First Name" size="40" /><br />
						<input type="text" name="name" value="" tabindex="501" placeholder="Email Address" size="40" /></p>
						<p class="center"><input name="submit" type="submit" value=" Subscribe Today " tabindex="502" class="button button-primary" /><br style="clear:both;" /></p>
				 </form>				
				</li>
			</ul>
		</div></div> <!-- end inside & postbox -->
<?php }?>

		<div class="postbox">
			<h3><span><?php _e('The MS Robots.txt Manager', 'ms_robotstxt_manager');?></span></h3>
		<div class="inside">
			<ul>
				<li>&bull; <a href="http://msrtm.technerdia.com/" target="_blank"><?php _e('Plugin Home Page', 'ms_robotstxt_manager');?></a> : <?php _e('Project Details', 'ms_robotstxt_manager');?></li>
				<li>&bull; <a href="http://wordpress.org/extend/plugins/multisite-robotstxt-manager/" target="_blank"><?php _e('Plugin at Wordpress.org', 'ms_robotstxt_manager');?></a> : MS Robots.txt</li>
				<li>&bull; <a href="http://wordpress.org/support/plugin/multisite-robotstxt-manager" target="_blank"><?php _e('Support Forum', 'ms_robotstxt_manager');?></a> : <?php _e('Problems, Questions', 'ms_robotstxt_manager');?>?</li>
				<li>&bull; <a href="http://msrtm.technerdia.com/feedback.html" target="_blank"><?php _e('Submit Feedback', 'ms_robotstxt_manager');?></a> : <?php _e('I\'m Listening', 'ms_robotstxt_manager');?>!</li>
				<li>&bull; <a href="http://technerdia.com/projects.html" target="_blank"><?php _e('techNerdia Projects', 'ms_robotstxt_manager');?></a> : <?php _e('More Goodies!', 'ms_robotstxt_manager');?>!</li>
			</ul>
		</div></div> <!-- end inside & postbox -->

		<div class="postbox">
			<h3><span><?php _e('Helpful Goodies', 'ms_robotstxt_manager');?>!</span></h3>
		<div class="inside">
			<ul>
				<?php if ( !$this->robotstxt_ms_version( $check = true ) ) {?><li><strong><span style="color:#cc0000;font-size:16px;">Pro Automation Extension</span></strong> [<a href="http://msrtm.technerdia.com/" target="_blank"><?php _e('details', 'ms_robotstxt_manager');?></a>]<br />
				<?php _e('Fully automate the creation of all robots.txt files', 'ms_robotstxt_manager');?>!</li><?php } ?>
				<li><strong>&raquo; <a href="http://wordpress.org/extend/plugins/multisite-robotstxt-manager/" target="_blank"><?php _e('Please Rate This Plugin', 'ms_robotstxt_manager');?>!</a></strong><br />
				<?php _e('It only takes a few seconds to', 'ms_robotstxt_manager');?> <a href="http://wordpress.org/extend/plugins/multisite-robotstxt-manager/" target="_blank"><?php _e('rate this plugin', 'ms_robotstxt_manager');?></a>! <?php _e('Your rating helps create motivation for future developments', 'ms_robotstxt_manager');?>!</li>
			</ul>
		</div></div> <!-- end inside & postbox -->


<?php if ( !$this->robotstxt_ms_version( $check = true ) ) {?>
		<div class="postbox">
			<h3><span><?php _e('Newsletter', 'ms_robotstxt_manager');?></span></h3>
		<div class="inside">
			<ul>
				<li><p><strong><?php _e('Subscribe to the MS Robots.txt Manager Wordpress Plugin Newsletter', 'ms_robotstxt_manager');?></strong><br />
					<small>Product News, Updates, Bug Fixes, Specials &amp; More...</small></p>
				 <form method="post" class="af-form-wrapper" action="http://www.aweber.com/scripts/addlead.pl">
					<input type="hidden" name="redirect" value="http://msrtm.technerdia.com/news/thanks.html" id="redirect_d9a087264565f2c613fd5ce16d490c53" />
					<input type="hidden" name="meta_web_form_id" value="674163288" />
					<input type="hidden" name="meta_adtracking" value="Main_Form" />
					<input type="hidden" name="meta_required" value="email,name" />
					<input type="hidden" name="listname" value="msrtm-leads" />
					<input type="hidden" name="meta_message" value="1" />
					<input type="hidden" name="meta_split_id" value="" />
					<input type="hidden" name="meta_tooltip" value="" />
						<p><input type="text" name="email" value="" tabindex="500" placeholder="First Name" size="40" /><br />
						<input type="text" name="name" value="" tabindex="501" placeholder="Email Address" size="40" /></p>
						<p class="center"><input name="submit" type="submit" value=" Subscribe Today " tabindex="502" class="button button-primary" /><br style="clear:both;" /></p>
				 </form>				
				</li>
			</ul>
		</div></div> <!-- end inside & postbox -->
<?php }?>


		<div class="postbox">
			<h3><span><?php _e('Robots.txt Documentation', 'ms_robotstxt_manager');?></span></h3>
		<div class="inside">
			<ul>
				<li>&bull; <a href="http://codex.wordpress.org/Search_Engine_Optimization_for_WordPress#Robots.txt_Optimization" target="_blank"><?php _e('Robots.txt Optimization Tips', 'ms_robotstxt_manager');?></a></li>
				<li>&bull; <a href="http://www.askapache.com/seo/updated-robotstxt-for-wordpress.html" target="_blank"><?php _e('AskAapche Robots.txt Example', 'ms_robotstxt_manager');?></a></li>
				<li>&bull; <a href="https://developers.google.com/webmasters/control-crawl-index/docs/faq" target="_blank"><?php _e('Google Robots.txt F.A.Q.', 'ms_robotstxt_manager');?></a></li>
				<li>&bull; <a href="https://developers.google.com/webmasters/control-crawl-index/docs/robots_txt" target="_blank"><?php _e('Robots.txt Specifications', 'ms_robotstxt_manager');?></a></li>
				<li>&bull; <a href="http://www.robotstxt.org/db.html" target="_blank"><?php _e('Web Robots Database', 'ms_robotstxt_manager');?></a></li>
<?php if ( is_network_admin() ) {?>
				<li>&bull; <a href="settings.php?tab=robotstxt_help&amp;page=ms_robotstxt.php"><?php _e('How To Use This Plugin', 'ms_robotstxt_manager');?></a></li>
<?php } else {?>
				<li>&bull; <a href="options-general.php?tab=robotstxt_help&amp;page=ms_robotstxt.php"><?php _e('How To Use This Plugin', 'ms_robotstxt_manager');?></a></li>
<?php }?>
			</ul>
		</div></div> <!-- end inside & postbox -->
	</div> <!-- end inner-sidebar -->
<!-- end sidebar -->