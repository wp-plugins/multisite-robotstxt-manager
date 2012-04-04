<?php
/**
 * Plugin Name: Multisite Robots.txt Manager | MS Robots.txt
 * Plugin URI: http://technerdia.com/projects/robotstxt/plugin.html
 * Description: A Multisite Network Robots.txt Manager. Quickly manage your Network Websites robots.txt files from a single administration area.
 * Tags: robotstxt, robots.txt, robots, robot, spiders, virtual, search, google, seo, plugin, network, wpmu, multisite, technerdia, tribalnerd
 * Version: 0.1.1
 * License: GPL
 * Author: tribalNerd
 * Author URI: http://techNerdia.com/
 *
 ****************************************************************************************
 * This program is free software; you can redistribute it and/or modify it under		*
 * the terms of the GNU General Public License as published by the Free Software		*
 * Foundation; either version 2 of the License, or (at your option) any later version.	*
 * 																						*
 * This program is distributed in the hope that it will be useful, but WITHOUT			*
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS		*
 * FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.		*
 * 																						*
 * You should have received a copy of the GNU General Public License along with			*
 * this program; if not, please visit: http://www.gnu.org/licenses/gpl.html				*
 ****************************************************************************************
 * @author tribalNerd (tribalnerd@technerdia.com)										*
 * @copyright Copyright (c) 2012, Chris Winters											*
 * @link http://technerdia.com/projects/adminbar/plugin.html							*
 * @license http://www.gnu.org/licenses/gpl.html										*
 * @version 0.1																			*
 ****************************************************************************************
 *
 */

/**
 * Multisite Robots.txt Manager
 */

if ( !defined( 'ABSPATH' ) ) { exit; } /* Wordpress check */

/**
 * Used when Network Wide is selected in the dropdown.
 */
if ( $_POST['show_site'] == "robotstxt_redirect" ) {
	add_action( 'init', 'robotstxt_redirect' );

	function robotstxt_redirect(){
		wp_safe_redirect( network_admin_url( '/settings.php?page=ms_robotstxt.php' ) ); 
	}
}
	
/* Define plugin textdomain for translations */
function ms_robotstxt_init() {
	$plugin_dir = basename( dirname( __FILE__ ) );
		load_plugin_textdomain( 'ms_robotstxt_manager', false, $plugin_dir );
}
add_action('init', 'ms_robotstxt_init');



/**
 * Activation, Setup and Deactivation
 */
class robotstxtHooks {
	function __construct() {
		register_activation_hook( __FILE__, array( &$this, 'robotstxt_ms_activate' ) );
		register_deactivation_hook( __FILE__, array( &$this, 'robotstxt_ms_deactivate' ) );
	}

	function robotstxt_ms_activate() {
		if ( !is_user_logged_in() ) { return; }
		global $wp_version;

		if ( !is_network_admin() ) {
			wp_die( __('This plugin can only be activated and accessed through the Newtork Admin.', 'ms_robotstxt_manager') );
		}

		if ( version_compare( $wp_version, "3.3", "<" ) ) {
			wp_die( __('This plugin requires WordPress 3.3 or higher. Please Upgrade Wordpress, then try activating this plugin again. Press the browser back button to return to the previous page.', 'ms_robotstxt_manager') );
		}

		$get_robotstxt_ms = new robotstxtmsDefaults();
		$default_robotstxt_ms = $get_robotstxt_ms->default_robotstxt();

		if ( !get_option( "ms_robotstxt_default" ) ) {
			add_option( "ms_robotstxt_default", $default_robotstxt_ms, "no" );
		}
	}

	function robotstxt_ms_deactivate() {
		if ( !is_user_logged_in() ) { return; }

		remove_action( 'do_robots', 'do_robots_display' );
		delete_site_transient( 'robotstxt_siteids' );
	}
} /* end class robotstxtHooks */

/* Call robotstxtHooks class */
if ( is_network_admin() || is_admin() ) {
	$robotstxt_hooks = new robotstxtHooks();
}



/**
 * Displays robots.txt file
 */
class robotstxt_ms {
	function __construct() {
			//remove_action( 'do_robots', 'do_robots' ); /* remove default */
			//add_action( 'do_robots', array( &$this, 'do_robots_display' ) ); /* add ours */
			add_filter( 'robots_txt', array( &$this, 'do_robots_display' ), 10, 2 ); /* Added 0.1.1 */
	}
	
	/* display it */
	function do_robots_display() {
		if ( is_robots() ) { /* display if this is the robots.txt file */
			header( 'Status: 200 OK', true, 200 );
			header( 'Content-type: text/plain; charset='. get_bloginfo('charset') );
			ob_start(); /* why not? */
				echo get_option( "ms_robotstxt" );
			ob_end_flush();
		}
	}
}

/* Call robotstxt_ms class */
if ( get_option( "blog_public" ) && get_option( "ms_robotstxt" ) ) {
	$display_robotstxt_ms = new robotstxt_ms();
}



/**
 * Settings Page Redirect
 */
class robotstxt_msSettings {
	function __construct() {
		add_action( 'admin_menu', array( &$this, 'ms_robotstxt_submenu' ) );
	}

	function ms_robotstxt_submenu() {
		if ( !is_user_logged_in() ) { return; }
		
		if ( current_user_can('manage_options') && is_user_member_of_blog() && is_super_admin() ) { /* Proper users only */
			add_submenu_page( 'options-general.php', 'MS Robots.txt', 'MS Robots.txt', 9, 'ms_robotstxt.php', array( &$this, 'robotstxt_ms_settings' ) );
		}
		
	}

	/* Redirect */
	function robotstxt_ms_settings() {
		global $blog_id;?>

		<script type="text/javascript">
			function delay(){  
			window.location.href = "<?php echo network_admin_url( "/settings.php?page=ms_robotstxt.php&open=$blog_id" );?>";
		}  
		</script>  
		<body onLoad="setTimeout('delay()', 1000)">
		<?php echo "<br /><p><strong>Please Wait</strong>: Loading network admin...</p>";
	}
}


/* Display Admin */
if ( is_admin() ) {
	$display_settings = new robotstxt_msSettings();
}



/**
 * Network Settings Page
 */
class robotstxt_msAdmin {
	function __construct() {
		add_action( 'network_admin_menu', array( &$this, 'ms_robotstxt_submenu' ) );
	}

	function ms_robotstxt_submenu() {
		if ( !is_user_logged_in() ) { return; }

		if ( current_user_can('manage_options') && is_user_member_of_blog() && is_super_admin() ) { /* Proper users only */
			add_submenu_page( 'settings.php', 'MS Robots.txt', 'MS Robots.txt', 9, 'ms_robotstxt.php', array( &$this, 'robotstxt_ms_admin' ) );
		}
	}


	/* Network Admin Post Settings */
	function robotstxt_ms_admin() {
		/* update default robots.txt file */
		if ( $_POST['default_ms_robotstxt'] && check_admin_referer( 'robotstxt_display_action', 'robotstxt_display_nonce' ) ) {
			$new_option_value = $_POST['robotstxt_option'];
				if ( $new_option_value == "" ) { wp_die( __('Sorry, you can not save a blank default robots.txt file. You can however, clear the textarea (do not save) and publish to network a blank robots.txt file that all Websites will use. Press your browsers back button to try again.', 'ms_robotstxt_manager') ); }
			
			delete_option( "ms_robotstxt_default" );
			add_option( "ms_robotstxt_default", $new_option_value, "no" );

			$notice = __('Default Robots.txt File Saved.');
		}

		/* publish robots.txt to network */
		if ( $_POST['publish_ms_robotstxt'] && check_admin_referer( 'robotstxt_display_action', 'robotstxt_display_nonce' ) ) {
			$new_option_value = $_POST['robotstxt_option'];
			/* query blog ids */
			$queryids = new robotstxtmsDefaults();
			$network_blogids = $queryids->run_query();

				foreach ( $network_blogids as $robotstxt_blogid ) {
					switch_to_blog( $robotstxt_blogid->blog_id );

					$get_the_option = get_option( "ms_robotstxt" );

					if ( get_option( "ms_robotstxt" ) || $get_the_option == "" ) {
						delete_option( "ms_robotstxt" );
					}

					add_option( "ms_robotstxt", $new_option_value, "no" );
				}

			$notice = __('Robots.txt File Published To All Network Websites.');
		}

		/* Dropdown menu site switch and per-site robots.txt file update */
		if ( $_POST['show_site'] ) {
			switch_to_blog( $_POST['show_site'] );
				if ( $_POST['update_ms_robotstxt'] && check_admin_referer( 'robotstxt_display_action', 'robotstxt_display_nonce' ) ) {
					$new_option_value = $_POST['robotstxt_option'];
					delete_option( "ms_robotstxt" );
					add_option( "ms_robotstxt", $new_option_value, "no" );
					
					$notice = __('Robots.txt File Updated.') . ' [ <a href="'. get_site_url( $siteid, '/robots.txt' ) .'" target="_blank">'. __('view') .' changes</a> ]';
				}
		}else{ /* On return, switch back to network, blog_id 1 */
			restore_current_blog();
		}

		/* reset website option to default network option */
		if ( $_POST['reset_this_website'] && check_admin_referer( 'robotstxt_display_action', 'robotstxt_display_nonce' ) ) {
			switch_to_blog(1);

				$new_option_value = get_option( "ms_robotstxt_default" );

			switch_to_blog( $_POST['show_site'] );
				delete_option( "ms_robotstxt" );
				add_option( "ms_robotstxt", $new_option_value, "no" );
			
			restore_current_blog();
			
			$notice = __('Robots.txt File Updated To Default Version.') . ' [ <a href="'. get_site_url( $siteid, '/robots.txt' ) .'" target="_blank">'. __('view') .' changes</a> ]';
		}

		/* delete option from this website */
		if ( $_POST['disable_this_website'] && check_admin_referer( 'robotstxt_display_action', 'robotstxt_display_nonce' ) ) {
				switch_to_blog( $_POST['show_site'] );
				delete_option( "ms_robotstxt" );

			$notice = __('The Multisite Robots.txt Manager Is No Longer Active On This Website.');
		}

		/* reset the default network robots.txt file to the coded template */
		if ( $_POST['reset_this_default'] && check_admin_referer( 'robotstxt_display_action', 'robotstxt_display_nonce' ) ) {
			$get_robotstxt_ms = new robotstxtmsDefaults();
			$default_option_value = $get_robotstxt_ms->default_robotstxt();

				delete_option( "ms_robotstxt_default" );
				add_option( "ms_robotstxt_default", $default_option_value, "no" );

			$notice = __('The Default Robots.txt File Has Been Updated To Coded In Default Version.');
		}

		/* Presets and Example robots.txt files */
			$robotstxt_examples = new robotstxtmsDefaults();
			$default_robotstxt 	= $robotstxt_examples->default_robotstxt();
			$mini_robotstxt 	= $robotstxt_examples->mini_robotstxt();
			$blogger_robotstxt 	= $robotstxt_examples->blogger_robotstxt();
			$blocked_robotstxt 	= $robotstxt_examples->blocked_robotstxt();
		
		/* Dealing with those Examples */
		if ( $_POST['selected_site'] && check_admin_referer( 'robotstxt_publish_action', 'robotstxt_publish_nonce' ) ) {
			if ( $_POST['preset_default'] ) { $new_option = $_POST['value_default']; }
			if ( $_POST['preset_open'] ) { $new_option = $_POST['value_open']; }
			if ( $_POST['preset_blog'] ) { $new_option = $_POST['value_blog']; }
			if ( $_POST['preset_kill'] ) { $new_option = $_POST['value_kill']; }

			if ( $_POST['selected_site'] == "robotstxt_network_set" ) {
				switch_to_blog(1);
					delete_option( "ms_robotstxt_default" );
					add_option( "ms_robotstxt_default", $new_option, "no" );
			}else{
				switch_to_blog( $_POST['selected_site'] );
					delete_option( "ms_robotstxt" );
					add_option( "ms_robotstxt", $new_option, "no" );
			}
			
			$siteid = $_POST['selected_site'];
			if ( $siteid == "robotstxt_network_set" ) { $siteid = "1"; }
			$notice = __('The Selected Robots.txt File Has Been Published.') . ' [ <a href="'. get_site_url( $siteid, '/robots.txt' ) .'" target="_blank">'. __('view') .' changes</a> ]';
		}


		/* The Template with ob_start */
		//if ( substr_count( $_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip' ) ) { ob_start("ob_gzhandler"); }else{ ob_start(); } /* removed 0.1.1 */
		ob_start();
			require_once( dirname( __FILE__ ) . '/template.inc.php' );
		ob_end_flush();
	} /* end function robotstxt_ms_admin() */

/**
 * Gets Site ID's and Domain Name for Dropdown
 */
	function robotstxt_select() {
		$query_ids = new robotstxtmsDefaults();
		$network_blog_ids = $query_ids->run_query();

			foreach( $network_blog_ids as $results ) {
				$selected = "";
				if ( $results->blog_id == $_POST['show_site'] ) { $selected = "selected"; }
				if ( $results->blog_id == $_POST['selected_site'] ) { $selected = "selected"; }
				if ( $results->blog_id == $_GET['open'] ) { $selected = "selected"; }
				echo '<option value="'. $results->blog_id .'" '. $selected .'>'. $results->domain .'</option>';
			}
	}
/**
 * Tabs
 */
	function robotstxt_tabs() {
		if ( isset ( $_GET['tab'] ) ){ $current = $_GET['tab']; }else{ $current = "robotstxt_settings"; }
		$tabs = array( 'robotstxt_settings' => __('Create / Manage'), 'robotstxt_presets' => __('Presets / Examples'), 'robotstxt_help' => __('How to Use') );

		$tab_menu = '<div id="icon-themes" class="icon32"><br></div>';
		$tab_menu .= '<h2 class="nav-tab-wrapper">';
			foreach( $tabs as $tab => $name ){
				$class = ( $tab == $current ) ? ' nav-tab-active' : '';
				$tab_menu .= "<a class='nav-tab$class' href='?tab=$tab&amp;page=ms_robotstxt.php'>$name</a>";
			}
		$tab_menu .= '</h2><br />';

		return $tab_menu;
	}

} /* end class robotstxt_msAdmin */

/* Display Admin */
if ( is_network_admin() ) {
	$display_network = new robotstxt_msAdmin();
	add_filter( 'plugin_row_meta', 'robotstxt_links', 10, 2 );
}

		
	



/**
 * Repeat Settings
 */
class robotstxtmsDefaults {

/* Default Robots.txt File Build */
	public function default_robotstxt() {
		$robotstxt_mu = "# robots.txt\n";
		$robotstxt_mu .= "User-agent: *\n";
		$robotstxt_mu .= "Disallow: /*?\n";
		$robotstxt_mu .= "Disallow: /wp-\n";
		$robotstxt_mu .= "Disallow: /feed/\n";
		$robotstxt_mu .= "Disallow: */feed/\n";
		$robotstxt_mu .= "Disallow: /cgi-bin/\n";
		$robotstxt_mu .= "Disallow: /comments/\n";
		$robotstxt_mu .= "Disallow: */comments/\n";
		$robotstxt_mu .= "Disallow: /trackback/\n";
		$robotstxt_mu .= "Disallow: */trackback/\n";
		$robotstxt_mu .= "Disallow: /wp-admin/\n";
		$robotstxt_mu .= "Disallow: /wp-content/\n";
		$robotstxt_mu .= "Disallow: /wp-includes/\n";
		$robotstxt_mu .= "Disallow: /wp-login.php\n";
		$robotstxt_mu .= "Disallow: /wp-content/cache/\n";
		$robotstxt_mu .= "Disallow: /wp-content/themes/\n";
		$robotstxt_mu .= "Disallow: /wp-content/plugins/\n";
		$robotstxt_mu .= "Allow: /\n";
		return $robotstxt_mu;
	}

	public function mini_robotstxt() {
		$robotstxt_mu = "# robots.txt\n";
		$robotstxt_mu .= "User-agent: *\n";
		$robotstxt_mu .= "Allow: /\n";
		return $robotstxt_mu;
	}

	public function blogger_robotstxt() {
		$robotstxt_mu = "# robots.txt\n";
		$robotstxt_mu .= "User-agent: *\n";
		$robotstxt_mu .= "Disallow: /wp-\n";
		$robotstxt_mu .= "Disallow: /wp-*\n";
		$robotstxt_mu .= "Disallow: /*.js$\n";
		$robotstxt_mu .= "Disallow: /*.inc$\n";
		$robotstxt_mu .= "Disallow: /*.css$\n";
		$robotstxt_mu .= "Disallow: /*.php$\n";
		$robotstxt_mu .= "Disallow: /feed/\n";
		$robotstxt_mu .= "Disallow: /author\n";
		$robotstxt_mu .= "Disallow: /cgi-bin/\n";
		$robotstxt_mu .= "Disallow: /archive/\n";
		$robotstxt_mu .= "Disallow: /wp-admin/\n";
		$robotstxt_mu .= "Disallow: /trackback/\n";
		$robotstxt_mu .= "Disallow: /wp-content/\n";
		$robotstxt_mu .= "Disallow: /wp-includes/\n";
		$robotstxt_mu .= "Disallow: /wp-login.php\n";
		$robotstxt_mu .= "Disallow: /wp-content/cache/\n";
		$robotstxt_mu .= "Disallow: /wp-content/themes/\n";
		$robotstxt_mu .= "Disallow: /wp-content/plugins/\n";
		$robotstxt_mu .= "Disallow: */trackback/\n";
		$robotstxt_mu .= "Disallow: */comments/\n";
		$robotstxt_mu .= "Disallow: /*/feed\n";
		$robotstxt_mu .= "Disallow: */feed/\n";
		$robotstxt_mu .= "Disallow: /*?\n";
		$robotstxt_mu .= "Allow: /\n";
		return $robotstxt_mu;
	}

	public function blocked_robotstxt() {
		$robotstxt_mu .= "User-agent: *\n";
		$robotstxt_mu .= "Disallow: /\n";
		return $robotstxt_mu;
	}

/* db query and transient */
	public function run_query() {
			if ( false === ( $robotstxt_site_list = get_transient( 'robotstxt_siteids' ) ) ) {
				global $wpdb;
				
				if ( get_transient( 'robotstxt_siteids' ) ) { /* just to be safe */
					delete_transient( 'robotstxt_siteids' );
				}

				$robotstxt_site_list = $wpdb->get_results( $wpdb->prepare( 'SELECT blog_id, domain FROM '. $wpdb->blogs .'  ORDER BY blog_id' ) );
				set_transient( 'robotstxt_siteids', $robotstxt_site_list, 300 );
			}
		return $robotstxt_site_list;
	}
} /* end class robotstxtmsDefaults */





/**
 * Functions 4 Life
 */
function robotstxt_links( $links, $file ) {
	$plugin = plugin_basename( __FILE__ );
	if ( $file == $plugin ) {
			$links[] = '<a href="settings.php?page=ms_robotstxt.php">'. __('Settings', 'ms_robotstxt_manager') .'</a>';
			$links[] = '<a href="http://technerdia.com/projects/robotstxt/faq.html">'. __('F.A.Q.', 'ms_robotstxt_manager') .'</a>';
			$links[] = '<a href="http://technerdia.com/projects/robotstxt/plugin.html">'. __('Support', 'ms_robotstxt_manager') .'</a>';
			$links[] = '<a href="http://technerdia.com/feedback.html">'. __('Feedback', 'ms_robotstxt_manager') .'</a>';
			$links[] = '<a href="http://technerdia.com/projects/contribute.html">'. __('Donations', 'ms_robotstxt_manager') .'</a>';
	}
	return $links;
}

?>