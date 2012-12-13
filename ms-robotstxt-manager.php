<?php
/**
 * Plugin Name: Multisite Robots.txt Manager | MS Robots.txt
 * Plugin URI: http://msrtm.technerdia.com/
 * Description: A Multisite Network Robots.txt Manager. Quickly manage your Network Websites robots.txt files from a single administration area.
 * Tags: robotstxt, robots.txt, robots, robot, spiders, virtual, search, google, seo, plugin, network, wpmu, multisite, technerdia, tribalnerd
 * Version: 0.3
 * License: GPL
 * Author: tribalNerd
 * Author URI: http://techNerdia.com/
 *
 ***************************************************************************************
 * This program is free software; you can redistribute it and/or modify it under			*
 * the terms of the GNU General Public License as published by the Free Software			*
 * Foundation; either version 2 of the License, or (at your option) any later version.	*
 * 																												*
 * This program is distributed in the hope that it will be useful, but WITHOUT			*
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS			*
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.		*
 * 																												*
 * You should have received a copy of the GNU General Public License along with			*
 * this program; if not, please visit: http://www.gnu.org/licenses/gpl.html				*
 ***************************************************************************************
 * @author tribalNerd (tribalnerd@technerdia.com)													*
 * @copyright Copyright (c) 2012, Chris Winters														*
 * @link http://msrtm.technerdia.com/																	*
 * @license http://www.gnu.org/licenses/gpl.html													*
 * @version 0.3																								*
 ***************************************************************************************
 *
 */

/**
 * Table of Code
 * ** Class: display_robots
 *		* Function: __construct() Load proper robots.txt file
 *		* Function: Display robots.txt file
 * ** Class: robotstxt_msAdmin
 *		* Function: Add menu for proper users only
 *		* Function: Network Admin Post Settings
 *			* Update / Save default settings
 *			* Publish robots.txt to network
 *			* Dropdown menu site switch and per-site robots.txt file update
 *			* Reset website option to default network option
 *			* Delete option from this website
 *			* Reset the default network robots.txt file to the coded template
 *			* Presets and Example robots.txt files
 *			* Updating the Network or selected Website with a robots.txt Preset-Example
 *		* Else: Update website options
 *			* Build Sitemap Option
 *		* Template: The Template with ob_start
 *		* Function: Build Sitemap Option
 *		* Function: Gets Site ID's and Domain Name for Dropdown
 *		* Function: Tabs
 *		* Function: Tabs as text links
 *		* Function: Version check
 *		* Function: Network Admin Notice on Robots.txt Creation
 * ** Class: robotstxtFunction
 *		* Function: Used when Network Wide is selected in the dropdown.
 *		* Function: Define plugin textdomain for translations
 *		* Function: Settings Page Redirect
 *		* Function: Extra Links
 * ** Class: robotstxtmsDefaults
 *		* Function: Default Robots.txt Files
 * ** Class: ms_robotstxt_hooks
 *		* Function: Activation, Setup and Deactivation
 */

/*
 * Multisite Robots.txt Manager
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

/**
 * Call, Build and Display robots.txt file
 */
class display_robots {
    /*
     * Load proper robots.txt file
     */
	function __construct() {
		/* blog id and current path / loc of robots.txt */
		global $blog_id, $current_blog, $wp_query;
		$blog_path = $current_blog->path;
		$robots_path = $blog_path . 'robots.txt';
	
		/* if robots.txt file, continue */
		if ( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) == $robots_path ) {
		
			/* change to displayed blog */
			switch_to_blog($blog_id);

			/* required */
			$check_public_blog = get_option( "blog_public" );
			if ( !$check_public_blog == "1" ) { return; }
		
			/* check if robots.txt option set on this site */
			$check_robotstxt = get_option( "ms_robotstxt" );

			/* switch to root site to get options */	
			switch_to_blog(1);
		
			$ms_robotstxt_auto = get_option( "ms_robotstxt_auto" );

			/* get option data */
			if ( $ms_robotstxt_auto == "1" && !$check_robotstxt ) {
				$get_robotstxt_pro = maybe_unserialize( get_option( "ms_robotstxt_pro" ) );
				$sitemap_structure = $get_robotstxt_pro['sitemap'];
				$the_robotstxt = $get_robotstxt_pro['robotstxt'];

				/* if structure is set, sitemap url will show */
				if ( $sitemap_structure ) {
					$sitemap_show = "yes";
				}

				/* back to current blog */
				restore_current_blog();
	
				/* build robots.txt option for this website */
				add_option( "ms_robotstxt", $the_robotstxt, '', "no" );

				/* build sitemap option */
				if ( $blog_path == "/" && !$check_robotstxt ) {
					$get_sitemap_url = new robotstxt_msAdmin();
					$sitemap_array = $get_sitemap_url->build_sitemap_option( $sitemap_structure, $sitemap_show ); /* returns $sitemap_array */

					/* clean option if set */
					delete_option( "ms_robotstxt_sitemap" );

					/* build sitemap option */
					add_option( "ms_robotstxt_sitemap", maybe_serialize($sitemap_array), '', "no" );
				}
			}

			restore_current_blog();

			/* return if robots.txt option is set */
			$robotstxt_check = get_option( "ms_robotstxt" );
			if ( !$robotstxt_check ) { return; }

			/* display a robots.txt file for websites within a directory */
			if ( $blog_path != "/" ) {
				add_action( 'init', array( 'display_robots', 'do_robots_display' ) );
			}else{
			/* real robots.txt display for proper network websites */
				add_filter( 'robots_txt', array( 'display_robots', 'do_robots_display' ), 10000, 0 );
			}
		} /* end robots.txt check */
	} /* end function __construct() */

	/*
	 * Display robots.txt file
	 */
	static function do_robots_display() {
		/* blog id and current path of blog */
		global $blog_id, $current_blog;
		$blog_path = $current_blog->path;

		/* change to displayed blog */
		switch_to_blog($blog_id);

		/* get sitemap url */
		$get_sitemap_option = maybe_unserialize( get_option( "ms_robotstxt_sitemap" ) );

		/* build sitemap url */
		if ( $get_sitemap_option['sitemap_show'] == "yes" ) {
			$sitemap_url = "\r\rSitemap: " . $get_sitemap_option['sitemap_url'];
		}

		/*
		 * Display Robots.txt
		 */
		header( 'Status: 200 OK', true, 200 );
		header( 'Content-type: text/plain; charset='. get_bloginfo('charset') );
		do_action( 'do_robotstxt' );
			echo get_option( "ms_robotstxt" );
			if ( $blog_path == "/" && !empty( $sitemap_url ) ) { echo $sitemap_url . "\r\r"; }
			exit;
	} /* end do_robots_display() */
} /* end class display_robots */

/* call robots.txt display */
if ( !is_admin() && !is_network_admin() ) { $display_robots = new display_robots(); }



/**
 * Network Settings Page
 */
class robotstxt_msAdmin {
	function __construct() {
		add_action( 'network_admin_menu', array( &$this, 'ms_robotstxt_submenu' ) );
	}

	/*
	 * Add menu for proper users only
	 */
	function ms_robotstxt_submenu() {
		/* proper users only */
		if ( !is_user_logged_in() && !current_user_can('manage_options') && !is_super_admin() ) { return; }
		
		/* load admin area */
		add_submenu_page( 'settings.php', 'MS Robots.txt', 'MS Robots.txt', 'manage_options', 'ms_robotstxt.php', array( &$this, 'robotstxt_ms_admin' ) );
		//define( 'IFRAME_REQUEST', true );

		/* version check */
		if ( !$this->robotstxt_ms_version( $check = true ) ) { return; }
			if (  isset( $_GET['id'] ) && "/wp-admin/network/site-new.php" == str_replace( '?update=added&id='. $_GET['id'] .'', '', $_SERVER['REQUEST_URI'] ) && $_GET['update'] == "added" ) {
				//if ( is_file( WP_CONTENT_DIR . '/ms-robotstxt.php' ) ) { include( WP_CONTENT_DIR . '/ms-robotstxt.php' ); }
				//if ( is_file( WP_PLUGIN_DIR . '/ms-robotstxt.php' ) ) { include( WP_PLUGIN_DIR . '/ms-robotstxt.php' ); }
				$ms_robotstxt_version = true;
				include( WP_PLUGIN_DIR . '/multisite-robotstxt-manager/ms-robotstxt.php' );
				if ( function_exists( 'ms_robotstxt_version' ) ) { ms_robotstxt_version(); }
			}
	}

	/*
	 * Network Admin Post Settings
	 */
	function robotstxt_ms_admin() {
		/* load proper version */
		if ( !$_GET['page'] == "ms_robotstxt.php" ) { return; }
		if ( isset( $_GET['tab'] ) && $_GET['tab'] == "robotstxt_auto" && $this->robotstxt_ms_version( $check = true ) ) {
			//if ( is_file( WP_CONTENT_DIR . '/ms-robotstxt.php' ) ) { include( WP_CONTENT_DIR . '/ms-robotstxt.php' ); }
			//if ( is_file( WP_PLUGIN_DIR . '/ms-robotstxt.php' ) ) { include( WP_PLUGIN_DIR . '/ms-robotstxt.php' ); }
			$ms_robotstxt_display = true;
			$ms_robotstxt_backup = false;
			include( WP_PLUGIN_DIR . '/multisite-robotstxt-manager/ms-robotstxt.php' );
		}

		/* ========================================================================= presets */

		/* select dropdown and switch to site */
		if ( isset( $_POST['show_site'] ) && $_POST['show_site'] ) {
			$show_site = $_POST['show_site'];
			switch_to_blog($show_site);
		}elseif( isset( $_GET['open'] ) && $_GET['open'] ) {
			$show_site = $_GET['open'];
			switch_to_blog($show_site);
		}else{
			switch_to_blog(1);
		}

		/* get options and define vars */
		$get_robotstxt_option = get_option( "ms_robotstxt" );

		if ( isset( $show_site ) ) {
			$get_sitemap_option = maybe_unserialize( get_option( "ms_robotstxt_sitemap" ) );
			$sitemap_url = $get_sitemap_option['sitemap_url'];
			$sitemap_show = $get_sitemap_option['sitemap_show'];
			$sitemap_structure = $get_sitemap_option['sitemap_structure'];
		}else{
			$get_default_option = maybe_unserialize( get_option( "ms_robotstxt_default" ) );
			$robotstxt_default = $get_default_option['default_robotstxt'];
			if ( isset( $get_default_option['sitemap_url'] ) ) { $sitemap_url = $get_default_option['sitemap_url']; }
			if ( isset( $get_default_option['sitemap_show'] ) ) { $sitemap_show = $get_default_option['sitemap_show']; }
		}

		/* preset for sitemap structure url */
		if ( !isset( $show_site ) ) { $sitemap_structure = ""; }															/* reset structure url */
		if ( !isset( $_POST['sitemap_show'] ) && !isset( $_POST['sitemap_structure'] ) && !isset( $show_site ) ) {				/* default structure */
			if ( isset( $get_default_option['sitemap_structure'] ) ) { $sitemap_structure = $get_default_option['sitemap_structure']; }
		}
		if ( !isset( $_POST['sitemap_show'] ) && isset( $_POST['default_ms_robotstxt'] ) ) { $sitemap_structure = ""; }		/* default structure */
		if ( isset( $_POST['sitemap_structure'] ) ) { $sitemap_structure = $_POST['sitemap_structure']; }						/* post carry over */
		if ( !isset( $_POST['sitemap_show'] ) && isset( $_POST['sitemap_structure'] ) ) {										/* set structure url */
			if ( isset( $get_default_option['sitemap_structure'] ) ) { $sitemap_structure = $_POST['sitemap_structure']; }
		}
		if ( !isset( $sitemap_structure ) ) { $sitemap_structure = ""; }													/* clear structure url */

		/* check sitemap option if active */
		$checked = "";
		if ( isset( $_POST['sitemap_show'] ) && $_POST['sitemap_show'] == "yes" ) {
			$checked = "checked";
		}elseif ( !isset( $_POST['sitemap_show'] ) && isset( $_POST['sitemap_hidden'] ) && $_POST['sitemap_hidden'] == "1" ) {
			$checked = "";
		}else{
			if ( isset( $sitemap_show ) && $sitemap_show == "yes" ) {
				$checked = "checked";
			}
		}
	
		/* ========================================================================= form posts */

		/*
		 * Update / Save default settings
		 */
		if ( isset( $_POST['default_ms_robotstxt'] ) ) {
			if ( !check_admin_referer( 'robotstxt_action', 'robotstxt_nonce' ) ) { return; }

			/* get robots.txt data */
			$robotstxt_option = $_POST['robotstxt_option'];
			
			/* if blank, error */
			if ( $robotstxt_option == "" ) { wp_die( __('Sorry, you can not save a blank default robots.txt file. You can however, clear the textarea (do not save) and publish to network a blank robots.txt file that all Websites will use. Press your browsers back button to try again.', 'ms_robotstxt_manager') ); }

			/* clean option */
			delete_option( "ms_robotstxt_default" );

			/* option array to include sitemap url */
			if ( $_POST['sitemap_show'] == "yes" || $_POST['sitemap_structure'] ) {
				$sitemap_structure = $_POST['sitemap_structure'];

				/* display sitemap checkbox */
				if ( $_POST['sitemap_show'] == "yes" ) {
					$sitemap_show = "yes";
				}else{
					$sitemap_show = "no";
				}

				/* error checks */
				if ( !$sitemap_structure ) { wp_die( __('To use the Sitemap Feature you must enter a Sitemap URL.', 'ms_robotstxt_manager') ); }
				if ( !preg_match( "/http/i", $sitemap_structure ) ) { wp_die( __('Error: You must include http:// or https:// with the sitemap structure url.', 'ms_robotstxt_manager') ); }
				
				$sitemap_array = $this->build_sitemap_option( $sitemap_structure, $sitemap_show ); /* returns $sitemap_array */

				$new_default_array = array(
					'default_robotstxt' => $robotstxt_option
				);

				/* build full option array */
				$new_default_array = array_merge( $sitemap_array, $new_default_array );
			}else{
				/* build robots.txt data array only */
				$new_default_array = array(
					'default_robotstxt' => $robotstxt_option
				);
			}

			/* build option */
			add_option( "ms_robotstxt_default", maybe_serialize($new_default_array), '', "no" );

			$notice = __('Default Robots.txt Data Saved. Click the "publish to network" button to commit the update to all Websites within the Network.', 'ms_robotstxt_manager');
		}

		/*
		 * Publish robots.txt to network
		 */
		if ( isset( $_POST['publish_ms_robotstxt'] ) ) {
			if ( !check_admin_referer( 'robotstxt_action', 'robotstxt_nonce' ) ) { return; }
			$new_option_value = $_POST['robotstxt_option'];

			/* error check */
			if ( $_POST['sitemap_show'] == "yes" ) {
				$sitemap_structure = $_POST['sitemap_structure'];
				if ( !$sitemap_structure ) { wp_die( __('To use the Sitemap Feature you must enter a Sitemap URL.', 'ms_robotstxt_manager') ); }
				if ( !preg_match( "/http/i", $sitemap_structure ) ) { wp_die( __('Error: You must include http:// or https:// with the sitemap structure url.', 'ms_robotstxt_manage' ) ); }
			}

			/* get blog ids for blog switch and path */
			global $wpdb;
			$get_blog_data = $wpdb->get_results( $wpdb->prepare( "SELECT blog_id FROM $wpdb->blogs WHERE site_id = %d AND public = '1' AND archived = '0' AND spam = '0' AND deleted = '0' ORDER BY blog_id", $wpdb->siteid ) );


			/* for each allowed blog */
			foreach ( $get_blog_data AS $blog_data ) {
				/* switch to each blog */
				switch_to_blog( $blog_data->blog_id );

				/* clean option */
				delete_option( "ms_robotstxt" );

				/* build option */
				add_option( "ms_robotstxt", $new_option_value, '', "no" );

				/*
				 * Build Sitemap Option
				 */
				if ( $blog_data->path == "/" && $_POST['sitemap_show'] == "yes" ) {	
					$sitemap_array = $this->build_sitemap_option( $sitemap_structure, $sitemap_show = "yes" ); /* returns $sitemap_array */

					/* build option */
					add_option( "ms_robotstxt_sitemap", maybe_serialize($sitemap_array), '', "no" );
				}else{
					/* clear option */
					delete_option( "ms_robotstxt_sitemap" );
				}
			} /* end foreach */

			$notice = __('Robots.txt File Published To All Network Websites.', 'ms_robotstxt_manager');
			restore_current_blog();
		} /* end if $_POST['publish_ms_robotstxt'] */

		/*
		 * Dropdown menu site switch and per-site robots.txt file update
		 */
		if ( isset( $show_site ) ) {
			if ( isset( $_POST['show_site'] ) && !check_admin_referer( 'robotstxt_action', 'robotstxt_nonce' ) ) { return; }
			/* switch to blog */
			switch_to_blog($show_site);

			/* get blog path */
			global $wpdb;
			$get_blog_path = $wpdb->get_var( $wpdb->prepare( "SELECT path FROM {$wpdb->blogs} WHERE blog_id = {$show_site} AND site_id = %d AND public = '1' AND archived = '0' AND spam = '0' AND deleted = '0' ORDER BY blog_id", $wpdb->siteid ) );
			if ( $get_blog_path != "/" ) { $readonly = 'readonly="readonly"'; }

			/* update a single robots.txt file */
			if ( isset( $_POST['update_ms_robotstxt'] ) ) {
				/* get post data */
				$new_option_value = $_POST['robotstxt_option'];

				/* presets */
				if ( $_POST['sitemap_structure'] == "" ) { $sitemap_structure = ""; }
				if ( $_POST['sitemap_show'] == "yes" ) {
					$sitemap_show = "yes";
				}else{
					$sitemap_show = "no";
				}

				/* clean option */
				delete_option( "ms_robotstxt" );

				/* build option */
				add_option( "ms_robotstxt", $new_option_value, '', "no" );

					/*
					 * Build Sitemap Option
					 */
					if ( $get_blog_path == "/" && $_POST['sitemap_structure'] ) {
					
						$sitemap_structure = $_POST['sitemap_structure'];
						$sitemap_array = $this->build_sitemap_option( $sitemap_structure, $sitemap_show ); /* returns $sitemap_array */

						/* build option */
						add_option( "ms_robotstxt_sitemap", maybe_serialize($sitemap_array), '', "no" );
					}else{
						delete_option( "ms_robotstxt_sitemap" );
					}

				$notice = __('Robots.txt File Updated.', 'ms_robotstxt_manager') . ' [ <a href="'. get_site_url( $show_site, '/robots.txt' ) .'" target="_blank">'. __('view', 'ms_robotstxt_manager') .' changes</a> ]';
			} /* end if $_POST['update_ms_robotstxt'] */
		}else{ /* On return, switch back to network, blog_id 1 */
			restore_current_blog();
		}

		/*
		 * Reset website option to default network option
		 */
		if ( isset( $_POST['reset_this_website'] ) ) {
			if ( !check_admin_referer( 'robotstxt_action', 'robotstxt_nonce' ) ) { return; }

			switch_to_blog(1);

				$get_default_option = maybe_unserialize( get_option( "ms_robotstxt_default" ) );
				$robotstxt_default = $get_default_option['default_robotstxt'];
				$sitemap_structure = $get_default_option['sitemap_structure'];
				$sitemap_show = $get_default_option['sitemap_show'];

			switch_to_blog($show_site);
				/* clear options */
				delete_option( "ms_robotstxt" );
				delete_option( "ms_robotstxt_sitemap" );
				
				add_option( "ms_robotstxt", $robotstxt_default, '', "no" );

				/* get blog path */
				global $wpdb;
				$get_blog_path = $wpdb->get_var( $wpdb->prepare( "SELECT path FROM {$wpdb->blogs} WHERE blog_id = {$show_site} AND site_id = %d AND public = '1' AND archived = '0' AND spam = '0' AND deleted = '0' ORDER BY blog_id", $wpdb->siteid ) );

				if ( $sitemap_show == "yes" && $get_blog_path == "/" ) {
					/* reset to defaults */
					$sitemap_array = $this->build_sitemap_option( $sitemap_structure, $sitemap_show = "yes" ); /* returns $sitemap_array */

					/* build options */
					add_option( "ms_robotstxt_sitemap", maybe_serialize($sitemap_array), '', "no" );
				}
				
			$get_sitemap_option = maybe_unserialize( get_option( "ms_robotstxt_sitemap" ) );
			$sitemap_show = $get_sitemap_option['sitemap_show'];
			$sitemap_structure = $get_sitemap_option['sitemap_structure'];
			if ( $sitemap_show == "yes" ) { $checked = "checked"; }else{ $checked = ""; }

			restore_current_blog();

			$notice = __('Robots.txt File Updated To The Default Version.', 'ms_robotstxt_manager') . ' [ <a href="'. get_site_url( $show_site, '/robots.txt' ) .'" target="_blank">'. __('view', 'ms_robotstxt_manager') .' changes</a> ]';
		}

		/* 
		 * Delete option from this website
		 */
		if ( isset( $_POST['disable_this_website'] ) ) {
			if ( !check_admin_referer( 'robotstxt_action', 'robotstxt_nonce' ) ) { return; }

			switch_to_blog($show_site);

			/* clear options */
			delete_option( "ms_robotstxt" );
			delete_option( "ms_robotstxt_sitemap" );
			$sitemap_structure = "";
			$checked = "";

			$notice = __('The Multisite Robots.txt Manager Is No Longer Active On This Website.', 'ms_robotstxt_manager');
		}

		/*
		 * Reset the default network robots.txt file to the coded template
		 */
		if ( isset( $_POST['reset_this_default'] ) ) {
			if ( !check_admin_referer( 'robotstxt_action', 'robotstxt_nonce' ) ) { return; }

			$get_robotstxt_ms = new robotstxtmsDefaults();
			$default_option_value = $get_robotstxt_ms->default_robotstxt();

			$robotstxt_default = $default_option_value;
			$sitemap_structure = "";
			$checked = "";

			/* clear option */
			delete_option( "ms_robotstxt_default" );

			/* build robots.txt data array only */
			$new_default_array = array(
				'default_robotstxt' => $default_option_value
			);

			/* build option */
			add_option( "ms_robotstxt_default", maybe_serialize($new_default_array), '', "no" );

			$notice = __('Default Settings Have Been Restored.', 'ms_robotstxt_manager');
		}

		/*
		 * Presets and Example robots.txt files
		 */
			$robotstxt_examples = new robotstxtmsDefaults();
			$default_robotstxt 	= $robotstxt_examples->default_robotstxt();
			$mini_robotstxt 	= $robotstxt_examples->mini_robotstxt();
			$blogger_robotstxt 	= $robotstxt_examples->blogger_robotstxt();
			$blocked_robotstxt 	= $robotstxt_examples->blocked_robotstxt();

		/*
		 * Updating the Network or selected Website with a robots.txt Preset-Example
		 */
		if ( isset( $_POST['selected_site'] ) && $_POST['selected_site'] ) {
			if ( !check_admin_referer( 'robotstxt_action', 'robotstxt_nonce' ) ) { return; }
			if ( $_POST['preset_default'] ) { $new_robotstxt_option = $_POST['value_default']; }
			if ( $_POST['preset_open'] ) { $new_robotstxt_option = $_POST['value_open']; }
			if ( $_POST['preset_blog'] ) { $new_robotstxt_option = $_POST['value_blog']; }
			if ( $_POST['preset_kill'] ) { $new_robotstxt_option = $_POST['value_kill']; }

			/*
			 * Update default network option
			 */
			if ( isset( $_POST['selected_site'] ) && $_POST['selected_site'] == "robotstxt_network_set" ) {
				switch_to_blog(1);

				/* clear option */
				delete_option( "ms_robotstxt_default" );

				/* option array to include sitemap url */
				if ( $_POST['sitemap_show'] == "yes" ) {
					$sitemap_structure = $_POST['sitemap_structure'];
					/* error checks */
					if ( !$sitemap_structure ) { wp_die( __('To use the Sitemap Feature you must enter a Sitemap URL.', 'ms_robotstxt_manager') ); }
					if ( !preg_match( "/http/i", $sitemap_structure ) ) { wp_die( __('Error: You must include http:// or https:// with the sitemap structure url.', 'ms_robotstxt_manager') ); }

					$sitemap_array = $this->build_sitemap_option( $sitemap_structure, $sitemap_show = "yes" ); /* returns $sitemap_array */

					$new_default_array = array(
						'default_robotstxt' => $new_robotstxt_option
					);

					/* build full option array */
					$new_default_array = array_merge( $sitemap_array, $new_default_array );
				}else{
					/* build robots.txt data array only */
					$new_default_array = array(
						'default_robotstxt' => $new_robotstxt_option
					);
					
					$sitemap_structure = "";
				}

				/* build option */
				add_option( "ms_robotstxt_default", maybe_serialize($new_default_array), '', "no" );
			}else{
			/*
			 * Update website options
			 */
				$selected_site = $_POST['selected_site'];
				switch_to_blog($selected_site);

				/* clean option */
				delete_option( "ms_robotstxt" );

				/* build option */
				add_option( "ms_robotstxt", $new_robotstxt_option, '', "no" );

				/*
				* Build Sitemap Option
				*/
				if ( $_POST['sitemap_show'] == "yes" ) {
					$sitemap_structure = $_POST['sitemap_structure'];
					$sitemap_array = $this->build_sitemap_option( $sitemap_structure, $sitemap_show = "yes" ); /* returns $sitemap_array */

					/* build option */
					add_option( "ms_robotstxt_sitemap", maybe_serialize($sitemap_array), '', "no" );
				}

				restore_current_blog();
			} /* end if $_POST['selected_site'] == "robotstxt_network_set" */

			/* correct url for network display */
			$siteid = $_POST['selected_site'];
			if ( $siteid == "robotstxt_network_set" ) { $siteid = "1"; }

			if ( $_GET['tab'] == "robotstxt_presets" ) {
				$notice = __('Done...', 'ms_robotstxt_manager');
			}else{
				$notice = __('The Selected Robots.txt File Has Been Published.', 'ms_robotstxt_manager') . ' [ <a href="'. get_site_url( $siteid, '/robots.txt' ) .'" target="_blank">'. __('view changes', 'ms_robotstxt_manager') .'</a> ]';
			}
		} /* end if  $_POST['selected_site'] - Dealing with those Examples */

		/*
		 * The Template with ob_start
		 */
		ob_start();			
			require_once( dirname( __FILE__ ) . '/template.inc.php' );
		ob_end_flush();
	} /* end function robotstxt_ms_admin() */


	/**
	 * Build Sitemap Option
	 * Needs work detecting sub-domains.
	 * Find efficient way to match dom ext, top-level dom and co codes to split domain up for sub-domain detection.
	 */
	function build_sitemap_option( $sitemap_structure, $sitemap_show ) {
		if ( !$sitemap_structure ) { return; }
		if ( is_null( $sitemap_show ) ) { $sitemap_show = "yes"; }

		/* clean option */
		delete_option( "ms_robotstxt_sitemap" );

			/* get domain and path */
			$domain_array = parse_url( site_url('/') );
			$domain_host = $domain_array['host'];
			$domain_path = $domain_array['path'];

			/* explode domain parts */
			$the_domain_parts = explode( ".", $domain_host );

			/* domain parts for domain.com */
			if ( sizeof( $the_domain_parts ) == 2 ) {
					$domain_name = $the_domain_parts[0];
					$domain_ext = $the_domain_parts[1];
			}

			/* domain parts for www.domain.com */
			if ( sizeof( $the_domain_parts ) == 3 ) {
				if ( $the_domain_parts[0] == "www" ) {
					$domain_name = $the_domain_parts[1];
					$domain_ext = $the_domain_parts[2];
				}else{
					$domain_name = $the_domain_parts[0];
					$domain_ext = $the_domain_parts[2];
				}
			}

			/* domain parts for www.domain.co.ext */
			if ( sizeof( $the_domain_parts ) >= 4 ) {
				if ( $the_domain_parts[0] == "www" ) {
					$domain_name = $the_domain_parts[1];
					$domain_ext = $the_domain_parts[3];
				}else{
					$domain_name = $the_domain_parts[0];
					$domain_ext = $the_domain_parts[2];
				}
			}

			/* replace sitemap structure with a proper sitemap url */
			$sitemap_string = str_replace("[WEBSITE_URL]", $domain_host, $sitemap_structure ); 	/* add domain.com to url */
			$sitemap_string = str_replace("[DOMAIN]", $domain_name, $sitemap_string );			/* add domain, when needed */
			$sitemap_url = str_replace("[EXT]", $domain_ext, $sitemap_string );					/* add domain extension, when needed */

		/* build array for option */
		return $sitemap_array = array(
			'sitemap_show' => $sitemap_show, 'sitemap_url' => $sitemap_url, 'sitemap_structure' => $sitemap_structure,
		);

		/* add_option is built when function is called */
	} /* end function build_sitemap_option() */


	/**
 	 * Gets Site ID's and Domain Name for Dropdown
	 */
	function robotstxt_select() {
		/* get the current user id of the current user */
		global $current_user;
		get_currentuserinfo();
		$this_admin_user = $current_user->ID;

		/* get blog id's allowed by this user user id */
		$users_blogs = get_blogs_of_user( $this_admin_user );

		/* create dropdown option list */
		foreach( $users_blogs AS $user_data ) {
			$selected = "";
			if ( isset( $_POST['show_site'] ) && $user_data->userblog_id == $_POST['show_site'] ) { $selected = "selected"; }
			if ( isset( $_POST['selected_site'] ) && $user_data->userblog_id == $_POST['selected_site'] ) { $selected = "selected"; }
			if ( isset( $_GET['open'] ) && $user_data->userblog_id == $_GET['open'] ) { $selected = "selected"; }
			
			if ( $user_data->blogname ) { $blog_name = $user_data->blogname; }else{ $blog_name = $user_data->domain; }
			echo '<option value="'. $user_data->userblog_id .'" '. $selected .'>('. $user_data->userblog_id .') '. $blog_name .'</option>';
		}
	}


	/**
	 * Tabs
	 */
	function robotstxt_tabs() {
		/* default */
		if ( isset ( $_GET['tab'] ) ){ $current = $_GET['tab']; }else{ $current = "robotstxt_settings"; }

		/* shown tabs */
		if ( $this->robotstxt_ms_version( $check = true ) ) {
			$tabs = array( 'robotstxt_settings' => __('Create / Manage', 'ms_robotstxt_manager'), 'robotstxt_auto' => __('Automate', 'ms_robotstxt_manager'), 'robotstxt_presets' => __('Presets / Examples', 'ms_robotstxt_manager'), 'robotstxt_help' => __('How to Use', 'ms_robotstxt_manager') );
		}else{
			$tabs = array( 'robotstxt_settings' => __('Create / Manage', 'ms_robotstxt_manager'), 'robotstxt_presets' => __('Presets / Examples', 'ms_robotstxt_manager'), 'robotstxt_help' => __('How to Use', 'ms_robotstxt_manager') );
		}

		/* tab wrap and link */
		$tab_menu = '<div id="icon-themes" class="icon32"><br></div>';
		$tab_menu .= '<h2 class="nav-tab-wrapper">';
			foreach( $tabs as $tab => $name ){
				$class = ( $tab == $current ) ? ' nav-tab-active' : '';
				$tab_menu .= "<a class='nav-tab$class' href='?tab=$tab&amp;page=ms_robotstxt.php'>$name</a>";
			}
		$tab_menu .= '</h2><br />';

		return $tab_menu;
	}


	/**
	 * Tabs as text links - used at bottom of admin pages
	 */
	function robotstxt_tab_links() {
		/* default */
		if ( isset ( $_GET['tab'] ) ){ $current = $_GET['tab']; }else{ $current = "robotstxt_settings"; }

		/* shown tabs */
		if ( $this->robotstxt_ms_version( $check = true ) ) {
			$tabs = array( 'robotstxt_settings' => __('Create and Manage', 'ms_robotstxt_manager'), 'robotstxt_auto' => __('Automate', 'ms_robotstxt_manager'), 'robotstxt_presets' => __('Presets and Examples', 'ms_robotstxt_manager'), 'robotstxt_help' => __('How to Use', 'ms_robotstxt_manager') );
		}else{
			$tabs = array( 'robotstxt_settings' => __('Create and Manage', 'ms_robotstxt_manager'), 'robotstxt_presets' => __('Presets and Examples', 'ms_robotstxt_manager'), 'robotstxt_help' => __('How to Use', 'ms_robotstxt_manager') );
		}

		/* tab wrap and link */
		if ( !empty( $tab_links ) ) {
			$tab_links .= '<p align="right" style="font-size:10px;font-weight:bold;margin:45px 25px 10px 0;">&bull; <a href="settings.php?page=ms_robotstxt.php">Home</a> | ';
			foreach( $tabs as $tab => $name ){
				$class = ( $tab == $current ) ? 'text-decoration:none;' : 'font-weight:bold;';
				$tab_links .= "<a style='$class' href='?tab=$tab&amp;page=ms_robotstxt.php'>$name</a> | ";
			}
			$tab_links .= '<a href="'. esc_attr( $_SERVER['REQUEST_URI'] ) .'#top" style="color:#cc0000">Top</a> ^</p>';

			return $tab_links;
		}
	}


	/*
	 * Version check
	 */
	function robotstxt_ms_version( $check ) {
		/* proper users only */
		if ( !is_user_member_of_blog() && !is_user_logged_in() && !current_user_can('manage_options') && !is_super_admin() ) { return; }

		if ( is_file( ABSPATH. '/wp-content/ms-robotstxt.php' ) ) {
			return true;
		}elseif( is_file( ABSPATH. '/wp-content/plugins/ms-robotstxt.php' ) ) {
			return true;
		}elseif( is_file( ABSPATH. '/wp-content/plugins/multisite-robotstxt-manager/ms-robotstxt.php' ) ) {
			return true;
		}else{
			if ( get_option( "ms_robotstxt_pro" ) ) { delete_option( "ms_robotstxt_pro" ); }
			if ( get_option( "ms_robotstxt_auto" ) ) { delete_option( "ms_robotstxt_auto" ); }
			return false;
		}
	}

	/*
	 * Network Admin Notice on Robots.txt Creation
	 */
	function network_notices() {
		echo '<div class="updated" id="message" onclick="this.parentNode.removeChild(this)"><p style="margin:1px 0;padding:0;"><small><em>Robots.txt Created...</em></small></p></div>';
		remove_action( 'network_admin_notices', array( 'robotstxt_msAdmin', 'network_notices' ) );
	}

} /* end class robotstxt_msAdmin */

/* display admin area */
if ( is_network_admin() ) {
	$display_network = new robotstxt_msAdmin();
}

/**
 * Functions Class
 */
class robotstxtFunction {
	/**
	 * Used when Network Wide is selected in the dropdown.
	 */
	function robotstxt_redirect() {
		if ( !check_admin_referer( 'robotstxt_action', 'robotstxt_nonce' ) ) { return; }
		wp_safe_redirect( network_admin_url( '/settings.php?page=ms_robotstxt.php' ) ); 
	}


	/**
	 * Define plugin textdomain for translations
	 */
	function ms_robotstxt_lang() {
		load_plugin_textdomain( 'ms_robotstxt_manager', false, dirname( plugin_basename( __FILE__ ) ) . '/langs' );

		$locale_lang = get_locale();
			if ( !empty( $locale_lang ) && ( dirname( plugin_basename( __FILE__ ) ) . '/langs/'. $locale_lang .'.mo' ) ) {
				load_textdomain( 'ms_robotstxt_manager', dirname( plugin_basename( __FILE__ ) ) . '/langs/'. $locale_lang .'.mo' );
			}
	}


	/**
	 * Settings Page Redirect
	 */
	function ms_robotstxt_submenu() {
		/* proper users only */
		if ( !is_user_member_of_blog() && !is_user_logged_in() && !current_user_can('manage_options') && !is_super_admin() ) { return; }
		/* settings link */
		add_submenu_page( 'options-general.php', 'MS Robots.txt', 'MS Robots.txt', 'manage_options', 'ms_robotstxt.php', array( 'robotstxtFunction', 'robotstxt_ms_settings' ) );
	}

	/* redirect users to network admin based on blog id */
	function robotstxt_ms_settings() {
		if ( $_GET['page'] == "ms_robotstxt.php" ) {
		global $blog_id;?>
			<script type="text/javascript">
			function delay() {  
				window.location.href = "<?php echo network_admin_url( "/settings.php?page=ms_robotstxt.php&open=$blog_id" );?>";
			}
			</script>  
			<body onLoad="setTimeout('delay()', 1000)">
			<?php echo "<br /><p><strong>Please Wait</strong>: Loading network admin...</p>";
		}
	}


	/**
	 * Thickbox Scripts
	 */
	function display_thickbox() {
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'thickbox', null, array( 'jquery' ) );
		wp_enqueue_style( 'thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0' );
	}


	/**
	 * Extra Links
	 */
	function robotstxt_links( $links, $file ) {
		$plugin = plugin_basename( __FILE__ );
		if ( $file == $plugin ) {
			$links[] = '<a href="settings.php?page=ms_robotstxt.php">'. __('Settings', 'ms_robotstxt_manager') .'</a>';
			$links[] = '<a href="http://msrtm.technerdia.com/#faq">'. __('F.A.Q.', 'ms_robotstxt_manager') .'</a>';
			$links[] = '<a href="http://msrtm.technerdia.com/help.html">'. __('Support', 'ms_robotstxt_manager') .'</a>';
			$links[] = '<a href="http://technerdia.com/feedback.html">'. __('Feedback', 'ms_robotstxt_manager') .'</a>';
			$links[] = '<a href="http://technerdia.com/projects/contribute.html">'. __('Donations', 'ms_robotstxt_manager') .'</a>';
			$links[] = '<a href="http://msrtm.technerdia.com/plugins/msrtm/index.php?page=about&amp;loc=en_US&amp;KeepThis=true&amp;height=450&amp;width=600&amp;TB_iframe=true" class="thickbox">'. __('PRO Details', 'ms_robotstxt_manager') .'</a>';
		}
		return $links;
	}
} /* end class robotstxtFunction */

/* Network Wide redirect */
if ( isset( $_POST['show_site'] ) && $_POST['show_site'] == "robotstxt_redirect" ) {
	add_action( 'init', array( 'robotstxtFunction', 'robotstxt_redirect' ) );
}

/* Load textdomain */
if ( isset( $_GET['page'] ) && $_GET['page'] == "ms_robotstxt.php" ) {
	add_action( 'init', array( 'robotstxtFunction', 'ms_robotstxt_lang' ) );
}

/* Display settings link and redirect page */
if ( is_admin() ) {
	add_action( 'admin_menu', array( 'robotstxtFunction', 'ms_robotstxt_submenu' ) );
}

/* Display extra links within plugins section */
if ( is_network_admin() ) {
	if ( $_SERVER['PHP_SELF'] == "/wp-admin/network/plugins.php" || $_SERVER['SCRIPT_NAME'] == "/wp-admin/network/plugins.php" || parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) == "/wp-admin/network/plugins.php" ) {
		add_filter( 'plugin_row_meta', array( 'robotstxtFunction', 'robotstxt_links' ), 10, 2 );
	}
}

/* Add thickbox scripts when plugin is loaded */
if ( is_network_admin() && isset( $_GET['page'] ) && $_GET['page'] == "ms_robotstxt.php" ) {
	add_action( 'init', array( 'robotstxtFunction', 'display_thickbox' ) );
}



/**
 * Default Robots.txt Files
 */
class robotstxtmsDefaults {
/* Default Robots.txt File Build */
	public function default_robotstxt() {
		$site_url = parse_url( site_url() );
		$path = ( !empty( $site_url['path'] ) ) ? $site_url['path'] : '';
		$robotstxt_mu = "# robots.txt\n";
		$robotstxt_mu .= "User-agent: *\n";
		$robotstxt_mu .= "Disallow: $path/*?\n";
		$robotstxt_mu .= "Disallow: $path/wp-\n";
		$robotstxt_mu .= "Disallow: $path/feed/\n";
		$robotstxt_mu .= "Disallow: */feed/\n";
		$robotstxt_mu .= "Disallow: $path/cgi-bin/\n";
		$robotstxt_mu .= "Disallow: $path/comments/\n";
		$robotstxt_mu .= "Disallow: */comments/\n";
		$robotstxt_mu .= "Disallow: $path/trackback/\n";
		$robotstxt_mu .= "Disallow: */trackback/\n";
		$robotstxt_mu .= "Disallow: $path/wp-admin/\n";
		$robotstxt_mu .= "Disallow: $path/wp-content/\n";
		$robotstxt_mu .= "Disallow: $path/wp-includes/\n";
		$robotstxt_mu .= "Disallow: $path/wp-login.php\n";
		$robotstxt_mu .= "Disallow: $path/wp-content/cache/\n";
		$robotstxt_mu .= "Disallow: $path/wp-content/themes/\n";
		$robotstxt_mu .= "Disallow: $path/wp-content/plugins/\n";
		$robotstxt_mu .= "Allow: /\n";
		return $robotstxt_mu;
	}

	public function mini_robotstxt() {
		$site_url = parse_url( site_url() );
		$path = ( !empty( $site_url['path'] ) ) ? $site_url['path'] : '';
		$robotstxt_mu = "# robots.txt\n";
		$robotstxt_mu .= "User-agent: *\n";
		$robotstxt_mu .= "Allow: $path/\n";
		return $robotstxt_mu;
	}

	public function blogger_robotstxt() {
		$site_url = parse_url( site_url() );
		$path = ( !empty( $site_url['path'] ) ) ? $site_url['path'] : '';
		$robotstxt_mu = "# robots.txt\n";
		$robotstxt_mu .= "User-agent: *\n";
		$robotstxt_mu .= "Disallow: $path/wp-\n";
		$robotstxt_mu .= "Disallow: $path/wp-*\n";
		$robotstxt_mu .= "Disallow: $path/*.js$\n";
		$robotstxt_mu .= "Disallow: $path/*.inc$\n";
		$robotstxt_mu .= "Disallow: $path/*.css$\n";
		$robotstxt_mu .= "Disallow: $path/*.php$\n";
		$robotstxt_mu .= "Disallow: $path/feed/\n";
		$robotstxt_mu .= "Disallow: $path/author\n";
		$robotstxt_mu .= "Disallow: $path/cgi-bin/\n";
		$robotstxt_mu .= "Disallow: $path/archive/\n";
		$robotstxt_mu .= "Disallow: $path/wp-admin/\n";
		$robotstxt_mu .= "Disallow: $path/trackback/\n";
		$robotstxt_mu .= "Disallow: $path/wp-content/\n";
		$robotstxt_mu .= "Disallow: $path/wp-includes/\n";
		$robotstxt_mu .= "Disallow: $path/wp-login.php\n";
		$robotstxt_mu .= "Disallow: $path/wp-content/cache/\n";
		$robotstxt_mu .= "Disallow: $path/wp-content/themes/\n";
		$robotstxt_mu .= "Disallow: $path/wp-content/plugins/\n";
		$robotstxt_mu .= "Disallow: */trackback/\n";
		$robotstxt_mu .= "Disallow: */comments/\n";
		$robotstxt_mu .= "Disallow: $path/*/feed\n";
		$robotstxt_mu .= "Disallow: */feed/\n";
		$robotstxt_mu .= "Disallow: $path/*?\n";
		$robotstxt_mu .= "Allow: /\n";
		return $robotstxt_mu;
	}

	public function blocked_robotstxt() {
		$site_url = parse_url( site_url() );
		$path = ( !empty( $site_url['path'] ) ) ? $site_url['path'] : '';
		$robotstxt_mu = "# robots.txt\n";
		$robotstxt_mu .= "User-agent: *\n";
		$robotstxt_mu .= "Disallow: $path/\n";
		return $robotstxt_mu;
	}
} /* end class robotstxtmsDefaults */



/**
 * Activation, Setup and Deactivation
 */
class ms_robotstxt_hooks {
	static function activate() {
		/* proper users only */
		if ( !is_user_logged_in() && !current_user_can('manage_options') && !is_super_admin() ) { return; }

		/* multisite activations only */
		if ( !is_network_admin() ) {
			wp_die( __('This plugin can only be activated and accessed through the Newtork Admin.', 'ms_robotstxt_manager') );
		}

		/* current wordpress only */
		global $wp_version;
		if ( version_compare( $wp_version, "3.3", "<" ) ) {
			wp_die( __('This plugin requires WordPress 3.3 or higher. Please Upgrade Wordpress, then try activating this plugin again. Press the browser back button to return to the previous page.', 'ms_robotstxt_manager') );
		}

		/* get the plugins default robots.txt file */
		$get_robotstxt_ms = new robotstxtmsDefaults();
		$default_robotstxt_ms = $get_robotstxt_ms->default_robotstxt();

			/* clean option */
			delete_option( "ms_robotstxt_default" );

			/* build array for default option */
			$new_default_array = array(
				'default_robotstxt' => $default_robotstxt_ms
			);

			/* build default robots.txt option */
			add_option( "ms_robotstxt_default", maybe_serialize($new_default_array), '', "no" );
	}

	/* remove robots.txt display filter */
	static function deactivate() {
		/* proper users only */
		if ( !is_user_logged_in() && !current_user_can('manage_options') && !is_super_admin() ) { return; }

		/* restore wordpress robots.txt file */
		remove_filter( 'robots_txt', array( 'robotstxt_ms', 'do_robots_display' ) );
	}
} /* end class robotstxtHooks */

/* calls add_action, activate_, plugin, activate() */
if ( isset( $_GET['action'] ) && $_GET['action'] == "activate" ) {
	if ( is_network_admin() || is_admin() ) {
		register_activation_hook( __FILE__, array( 'ms_robotstxt_hooks', 'activate' ) );
	}
}

/* calls add_action, deactivate_, plugin, deactivate() */
if ( isset( $_GET['action'] ) && $_GET['action'] == "deactivate" ) {
	if ( is_network_admin() ) {
		register_deactivation_hook( __FILE__, array( 'ms_robotstxt_hooks', 'deactivate' ) );
	}
}
?>