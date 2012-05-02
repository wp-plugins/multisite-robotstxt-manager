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
 * ==================================== Uninstall Function
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

function uninstall_ms_robotstxt() {
	if ( !is_user_logged_in() ) { return; }
	global $wpdb;

	$robotstxt_remove_list = $wpdb->get_results( $wpdb->prepare( 'SELECT blog_id FROM '. $wpdb->blogs .'  ORDER BY blog_id' ) );

		foreach ( $robotstxt_remove_list as $siteids ) {
			switch_to_blog( $siteids->blog_id );
				remove_filter( 'robots_txt', array( 'robotstxt_ms', 'do_robots_display' ) );
				delete_option( "ms_robotstxt_sitemap" );
				delete_option( "ms_robotstxt_default" );
				delete_option( "ms_robotstxt" );
		}

		switch_to_blog(1);
			remove_filter( 'robots_txt', array( 'robotstxt_ms', 'do_robots_display' ) );
			delete_option( "ms_robotstxt_sitemap" );
			delete_option( "ms_robotstxt_default" );
			delete_option( "ms_robotstxt" );
		restore_current_blog();

	return;
}

/* Call Uninstall */
uninstall_ms_robotstxt();
?>