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
 * ==================================== Plugin Uninstall Function
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) { exit; } /* Kill direct access */

/**
 * Core Function
 */
function uninstall_ms_robotstxt() {
	/* multisite function */
	if ( !function_exists('is_super_admin') ) {
		if ( !is_super_admin() ) { return; }
	}

	/* proper user levels only */
	if ( !is_user_logged_in() && !current_user_can( 'manage_options' ) ) { return; }

	/* query wp db */
	global $wpdb;
	$get_blog_ids = $wpdb->get_results( 'SELECT blog_id FROM '. $wpdb->blogs .'  ORDER BY blog_id' );

		/* remove options for each blog id */
		foreach ( $get_blog_ids AS $returned_id ) {
			$this_blog_id = $returned_id->blog_id;
			switch_to_blog($this_blog_id);
				remove_filter( 'robots_txt', array( 'robotstxt_ms', 'do_robots_display' ) );
				delete_option( 'ms_robotstxt_default' );
				delete_option( 'ms_robotstxt_sitemap' );
				delete_option( 'ms_robotstxt_auto' );
				delete_option( 'ms_robotstxt_pro' );
				delete_option( 'ms_robotstxt' );
		}

		/* make sure options are removed from root network site */
		switch_to_blog(1);
			remove_filter( 'robots_txt', array( 'robotstxt_ms', 'do_robots_display' ) );
			delete_option( 'ms_robotstxt_default' );
			delete_option( 'ms_robotstxt_sitemap' );
			delete_option( 'ms_robotstxt_auto' );
			delete_option( 'ms_robotstxt_pro' );
			delete_option( 'ms_robotstxt' );

		restore_current_blog();

	/* return to wordpress */
	return;
}

/* Run uninstall when called */
uninstall_ms_robotstxt();
?>