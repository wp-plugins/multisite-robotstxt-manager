=== Multisite Robots.txt Manager ===
Plugin Name: Multisite Robots.txt Manager | MS Robots.txt
Contributors: tribalNerd, Chris Winters
Donate link: http://msrtm.technerdia.com/donate.html
Tags: robotstxt, robots.txt, robots, robot, spiders, virtual, search, google, seo, plugin, network, mu, multisite, technerdia, tribalnerd
Requires at least: 3.3
Tested up to: 3.5
Stable tag: 0.3.1


A Multisite Robots.txt Manager - Quickly and easily manage all robots.txt files on a Wordpress Multisite Website Network.


== Description ==

A Multisite Robots.txt Manager - Quickly and easily manage all robots.txt files on a Wordpress Multisite Website Network.

This Plugin Was Created For Multisite Networks > Network Activations Only!


### Features:

* Manage all Websites from Network Administration Area.
* Manage a single Website through the Website Settings Admins.
* Instantly add Sitemaps URL's to all robots.txt files.
* Mass update the all Websites on the Network in a single click.
* Create custom and unique robots.txt files for each Website.
* Quickly publish preset robots.txt files to the Network or a Website.

### Quick Info:

* The default "Network Wide" robots.txt file is NOT a live robots.txt file.
* If you deactivate the plugin, no options are removed but the plugins robots.txt file(s) are no longer displayed.
* If you delete this plugin, all options and settings will be removed from the database, for all Websites.

### Make It Work:

* To make the robots.txt live for a Website, either click the "publish to network" button or select the Website from the dropdown > then click the "change sites" buttons. Next, adjust the displayed robots.txt file, then click the "update this website" button. Both methods publish the robots.txt file to the Website(s), making it live. Click the [ view robots.txt ] link next to the Websites dropdown to view the changes within your browser.

### Download > Install > Network Activate > Settings > MS Robots.txt


[Submit Feedback For Improvements](http://msrtm.technerdia.com/feedback.html) | 
[Screenshots](http://msrtm.technerdia.com/help/docs/screenshots.html) | 
[Plugin Home](http://msrtm.technerdia.com/)






== Installation ==
[View the Install Guide](http://msrtm.technerdia.com/) | 
[Screenshots](http://msrtm.technerdia.com/help/docs/screenshots.html) | 
[Feedback](http://msrtm.technerdia.com/feedback.html)

### Install through the Wordpress Admin

* It is recommended that you use the built in Wordpress installer to install plugins.
	* Multisite Networks: Network Admin > Plugins Menu > Add New Button
* In the Search box, enter: robots.txt
* Find the Plugin "Multisite Robots.txt Manager"
* Click Install Now and proceed through the plugin setup process.
	* Activate / Network Activate the plugin when asked.
	* If you have returned to the Plugin Admin, locate the "Multisite Robots.txt Manager" Plugin and click the Activate link.

### Upload and Install

* If uploading, upload the /ms-robotstxt-manager/ folder to /wp-content/plugins/ folder for your Worpdress install.
* Then open the Wordpress Admin:
	* Multisite Networks: Network Admin > Plugins Menu
* Locate the "Multisite Robots.txt Manager" Plugin in your listing of plugins. (sort by Inactive)
* Click the Activate link to start the plugin.







== Frequently Asked Questions ==
[F.A.Q.](http://msrtm.technerdia.com/#faq) | 
[Screenshots](http://msrtm.technerdia.com/help/docs/screenshots.html) | 
[Feedback](http://msrtm.technerdia.com/feedback.html)

### Frequently Asked Questions:


= Q) Not all Websites are showing in the dropdown on the admin page, what's wrong? =

A) Your User is not a member of the other blogs. Login as the other users, or access the Network Admin > Sites Admin > Edit a Site > User Tab and set your User Name as an Administrator for each Website.


= Q) Can the plugin update all Websites at once? =

A) Yes.


= Q) Does this plugin work on Non-Multisite Installs? =

A) No, your install MUST be Multisite enabled.


= Q) Has the plugin been tested with WordPress MU Domain Mapping Plugin?

A) Yes, it was built on it.


= Q) Does this plugin work on Wordpress.COM (free hosted) Websites? =

A) No.


= Q) Can I activate this plugin within a Websites wp-admin? =

A) No, only within the Network Admin.


= Q) Do I have to access each Website to manage the robots.txt file? =

A) No, the Main Admin Area for the MS Robots.txt Manager is located within the Network Admin.


= Q) Can I add my own robots.txt file? =

A) Yes.


= Q) Can every Website have a different robots.txt file? =

A) Yes.


= Q) Does this plugin add Sitemap links to the robots.txt file? =

A) Yes.


= Q) Does the Sitemap url automatically get added to the robots.txt file? =

A) Once the feature is activated, yes.


= Q) Can Websites have a Custom Sitemap URL? =

A) Yes.


= Q) Does the robots.txt file render for non-root domains / Websites with a path? =

A) Yes, however.... Search Engine Spiders do not read robots.txt files within a directory, robots.txt files for non-mapped domains are for for error checking purposes only.


= Q) I run a real Multisite Network, all Sites are in a Path, don't they need a robots.txt file? =

A) From what I understand, no.... The root / network Website will contain the only robots.txt file.


= Q) The Sitemap URL isn't working when viewing a robots.txt file from a directory, what's wrong? =

A) Nothing.... this solves a rendering issue with sitemap urls. If the sitemap url is rendered it will include the /path/, which will cause issues with a domain is mapped to the path, thus the simplest solution is to exclude the sitemap url if within a directory.


= Q) Can I use other robots.txt file plugins with the MS Robots.txt Manager Plugin? =

A) Yes... but you must disable the robots.txt file for the Website you want to use the other plugin on. To do this, access the MS Robots.txt Settings, select the Website, and click the "disable this website" button to turn the manager for that Website.


= Q) Can I use other Sitemap Plugins to add more Sitemap URL's to the robots.txt files? =

A) Yes, they should work without issue.


= Q) I've installed the plugin, and do not want to use it, but now Wordpress will not delete it, what's up? =

A) Wordpress handles the removal of all plugins. This plugin does not create files or modify file permissions. When a plugin fails to delete, the issue has to do with file permissions; normally the username that added the plugin is not the username trying to remove the plugin. If this isn't the issue, Wordpress and/or Server/Host/Admin modified the file permissions or file ownerships of the plugin. Log into your Wordpress install via FTP; visually 'compare' the file permissions, user and group that owns the Plugin against other plugins. Typically, if this information does not match you'll have to ask your Host for assistance.


= Q) Does the plugin remove the settings when it is disabled or deleted? =

A) When the plugin is disabled, no settings are deleted, however the robots.txt file created by the plugin will no longer display. When the plugin is deleted, all settings the plugin created are removed from the database.



[Frequently Asked Questions](http://msrtm.technerdia.com/#faq)







== Arbitrary section ==

[View the Install Guide](http://msrtm.technerdia.com/help/docs/getting-started.html) | 
[Screenshots](http://msrtm.technerdia.com/help/docs/screenshots.html) | 
[Feedback](http://msrtm.technerdia.com/feedback.html)

### Understanding the Default Settings

* When you first enter the MS Robots.txt Settings page, the shown robots.txt file is the default "network only" or "network wide" working copy. Modify the default robots.txt file, save the default file, and when ready click the "publish to network" button to duplicate the robots.txt file to all Network Websites.


### Create / Manage

* The Create / Manage tab contains an inactive, "network only" or "network wide" working copy of the robots.txt file. Modify the default robots.txt file, save the default file, and when ready click the "publish to network" button to duplicate the robots.txt file to all Network Websites.


### Sitemap URLs and Structure

* Most Wordpress Sitemap Plugins can automatically add the Sitemap URL's to the robots.txt file for you. Be sure to disable this feature within other Plugins if you use the feature within this plugin, otherwise more than one sitemap url will be listed in the robots.txt file.

* To add a Sitemap URL to a Robots.txt file, simply select the check box to add the sitemap url, then enter the Sitemap URL Structure to use.

* Almost all Wordpress Installs will use: http://[WEBSITE_URL]/sitemap.xml

* The [brackets] within the Sitemap URL's automatically get replaced by the plugin (You Will Use Them). Network Wide Sitemap Updates "must" use the [bracket] structure to ensure Websites have the proper Sitemap URL. Unique Website updates can use the brackets OR take the full sitemap url directly.


### Sitemap URL Structure

* Wordpress Sitemap URLs: http://[WEBSITE_URL]/sitemap.xml
* GoDaddy Sitemap URLs: http://[WEBSITE_URL]/sitemaps/[DOMAIN]-[EXT].xml
* Random Example: http://[WEBSITE_URL]/[DOMAIN]-[EXT]-sitemap.xml.gz
* Structure Meaning:
* [WEBSITE_URL] = domain.com
* [DOMAIN] = domain
* [EXT] = .com/net, etc.

* Always include the http:// with the Sitemap URL Structure.
* If the sitemaps are within a directory, /include-the-path/ within the sitemap url.


### Robots.txt Files within Directories and Non-Mapped Domains

* Search Engine Spiders only read robots.txt files found within the root directory of a Website. Spiders do not read robots.txt files within directories, such as: domain.com/PATH-or-FOLDER/robots.txt is NOT a valid location. Because of this, the sitemap urls are not rendered on robots.txt files that are being displayed within a directory.
* From Google: "The robots.txt file must be in the top-level directory of the host.....Crawlers will not check for robots.txt files in sub-directories." [ source ]

* ~ For Testing Purposes: Non-mapped Network Websites will have a robots.txt file rendered for the Website. This is NOT the robots.txt file to submit to Google. Only submit robots.txt files found on a domains root, such as: domain.com/robots.txt

* Sitemap URLs: For "real" Multisite HOST Networks, use the Wordpress plugin: BWP Google XML Sitemaps - This plugin will list each Websites Sitemap URL's in the Root Network Website's robots.txt file.


### Testing Robots.txt Files

* Use Google's Webmaster Tools to Validate your Robots.txt Files.... with Google at least.:
* Log into your Google Account and access the Log into your Webmaster Tools feature. Select a Website or Add a Website....

* On the Webmaster Tools Home page, click the site you want.
* Under Health, click Blocked URLs.
* If it is not already selected, click the Test robots.txt tab.
* Copy the content of your robots.txt file, and paste it into the first box.
* In the URLs box, list the site to test against.
* In the User-agents list, select the user-agents you want.
* https://developers.google.com/webmasters/control-crawl-index/docs/robots_txt


### New Website Added to Network

* If all Websites use the saved Network default robots.txt file, click the "publish to network" button to copy the default robots.txt file over to any new Websites you have.
* Per Site: Change to the Website in the dropdown. Then click the "reset this website" button to copy the default robots.txt file to this Website. If needed, modify the robots.txt file and click the "update this website" button once done.


### Manage a Websites Robots.txt File

* To manage a Website directly, select the Website from the dropdown, then click the "change sites" button. This will display the robots.txt file for the selected Website. Change the robots.txt file how you like, once done click the "update this website" button to publish the modification.


### Disabling

* Disable a Website: To disable the MS Robots.txt Manager on a Website, select the Website from the dropdown menu, then click the "change sites" button. With the Website's robots.txt file open, click the "disable this website" button. This will clear the robots.txt file and sitemap structure settings for this Website only, making the Wordpress default robots.txt file display.
* Disable across the Network: Select the default robots.txt file within the Text Area, click the delete on your keyboard, then click the "publish to network" button. You can not save a blank default robots.txt file, but you can publish a blank robots.txt file, which will disable the robots.txt file option for each Website within the Network.


### Resetting

* Reset Default: Something wrong? No worries! When viewing the Networks robots.txt file, click the "reset to default" button to replace the displayed robots.txt file with the core "coded in" default robots.txt file.
* Reset Website: To reset a Websites robots.txt file, change to the Website within the dropdown, then click the "reset this website" button to pull in the "Networks Default Robots.txt file" (not the coded in default file).


### Presets / Examples Tab

* This feature allows you to quickly duplicate premade robots.txt files and a sitemap structure url, to either the default network wide robots.txt file or a selected Websites robots.txt file.
* To use: Select the Network or a Website from the dropdown. Check the box to add a sitemap structure, modify/enter a Sitemap Structure (not required). Finally, click the "set as default" button above the robots.txt file example you want to use.

* Presets can also use the Sitemap URL Structure setting. Read above on how to use this feature.


### Sitemap Plugins

* The Multisite Robots.txt Manager plugin has been tested with:
* Google XML Sitemaps with Multisite support and BWP Google XML Sitemaps







== Changelog ==
Alpha Release
= 0.3.1 =
* Created website admin areas.
* Added is_user_member_of_blog function for super admins.

= 0.3.0 =
* Modified add_submenu_page calls.
* Modified DB prepare() statements.
* Structure change to make room for automation feature.
* Cleaned undefined index errors.
* Ran PHP Debug and WP Debug and removed related errors.

= 0.2.2 =
* Modified add_submenu_page calls.
* Modified DB prepare() statements.
* Structure change to make room for automation feature.

= 0.2.1 =
* Made robots.txt file display when a Website within a directory (domain.com/domain-path) is called.
* Added is_network_admin() and $_SERVER script checks around extra links function.
* Cleaned up activation & deactivation hook calls to only be called when executed.
* Added do_action( 'do_robotstxt' ); call after header call of robots.txt display.
* Adjusted robots.txt display to use public/private blog feature correctly.
* Removed is_user_member_of_blog() check around add_submenu_page() calls.
* Added $_GET['page'] == "ms_robotstxt.php" wrap around tab display call.
* Improved sitemap structure url output with various domain structures.
* Added current_user_can() && is_super_admin() check to uninstall.php
* Added / adjusted wp_nonce_field and check_admin_referer calls.
* Created second set of tab links at the bottom of plugin admin.
* Cleaned up robots.txt display class - add_filter call.
* Setup better error handling on all form submits.
* Added in version check and file check calls.
* Improved sitemap structure function.
* More comments.

= 0.2.0 =
* Made the site dropdown list populate in a new way, and list site names insted of domains.
* Added sitemap option, url, and structure to default robots.txt, per site, and pre-sets.
* Adjusted all post types and preset values, and option arrays to use sitemap structure.
* Adjusted default option for websites robots.txt to store data within an array.
* Created a new sitemap option to store sitemap data at the Website level.
* Adusted, cleaned html and corrected typos within admin area template.
* Adjusted default robots.txt option to store data within an array.
* Created instructions for the Sitemap URL Structure feature.
* Adjusted robots.txt display to include sitemap urls.
* Adjusted uninstall.php to use new option names.
* Removed transient cache and related db calls.
* New screenshot file and readme.txt updated.
* Updated Wordpress Function References.
* Added non-network check on install.
* Serialize proper option data.

= 0.1.1 =
* Replaced action do_robots with filter robots_txt at call.
* Removed ob_gzhandler

= 0.1 =
* Created March 08, 2012



== Upgrade Notice ==
No Upgrades At This Time







== Screenshots ==

- More Screenshots --> http://msrtm.technerdia.com/help/docs/screenshots.html

1. Collage of the Multisite Robots.txt Manager Features.
