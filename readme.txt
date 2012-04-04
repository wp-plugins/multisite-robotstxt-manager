=== Multisite Robots.txt Manager ===
Plugin Name: Multisite Robots.txt Manager | MS Robots.txt
Contributors: tribalNerd, Chris Winters
Donate link: http://technerdia.com/projects/contribute.html
Tags: robotstxt, robots.txt, robots, robot, spiders, virtual, search, google, seo, plugin, network, multisite, technerdia, tribalnerd
Requires at least: 3.3
Tested up to: 3.3.1
Stable tag: 0.1.1


A Multisite Network Robots.txt Manager. Quickly manage your Network Websites robots.txt files from a single administration area.


== Description ==

A Multisite Network Robots.txt Manager. Quickly manage all Network Websites robots.txt files directly within the Network Admin.

This Plugin Was Created For Multisite Networks > Network Activations Only!

### Features:

* Manage all Network Websites from one Administration area.
* Mass update the entire Network or update a unique Website.
* Each Website within a Network can have a unique robots.txt file.
* Robots.txt file examples that can be published to Websites or stored as a default.

### Quick Info:

* When you first install the plugin, no robots.txt files are active.
* The default "Network Wide" robots.txt file is NOT a live robots.txt file.
* If you deactivate the plugin, no options are removed but the robots.txt file(s) are no longer displayed.
* If you delete this plugin, all options and settings will be removed from the database.

### Make It Work:

* To make the robots.txt live for a Website, either click the "publish to network" button or select the Website from the dropdown > then click the "change sites" buttons. Next, adjust the displayed robots.txt file, then click the "update this website" button. Both methods publish the robots.txt file to the Website(s), making it live. Click the [ view robots.txt ] link next to the Websites dropdown to view the changes within your browser.

### Download > Install > Network Activate > Settings > MS Robots.txt


[Submit Feedback For Improvements](http://technerdia.com/feedback.html) | 
[Screenshots](http://technerdia.com/projects/robotstxt/screenshots.html) | 
[Plugin Home](http://technerdia.com/projects/robotstxt/plugin.html)



== Installation ==
[View the Install Guide](http://technerdia.com/projects/robotstxt/plugin.html) | 
[Screenshots](http://technerdia.com/projects/robotstxt/screenshots.html) | 
[Feedback](http://technerdia.com/feedback.html)

### Install through the Wordpress Admin

* It is recommended that you use the built in Wordpress installer to install plugins.
	* Multisite Networks: Network Admin > Plugins Menu > Add New Button
	* Standalone Wordpress: Site Dashboard > Plugins Menu > Add New Button
* In the Search box, enter: MS Robots.txt
* Click Install Now and proceed through the plugin setup process.
	* Activate / Network Activate the plugin when asked.
	* If you have returned to the Plugin Admin, locate the "Multisite Robots.txt Manager" Plugin and click the Activate link.

### Upload and Install

* If uploading, upload the /ms_robotstxt_manager/ folder to /wp-content/plugins/ folder for your Worpdress install.
* Then open the Wordpress Admin:
	* Multisite Networks: Network Admin > Plugins Menu
	* Standalone Wordpress: Site Dashboard > Plugins Menu
* Locate the "Multisite Robots.txt Manager" Plugin in your listing of plugins. (sort by Inactive)
* Click the Activate link to start the plugin.



== Frequently Asked Questions ==
[F.A.Q.](http://technerdia.com/projects/robotstxt/faq.html) | 
[Screenshots](http://technerdia.com/projects/robotstxt/screenshots.html) | 
[Feedback](http://technerdia.com/feedback.html)

### Frequently Asked Questions:

= Q) Does this plugin work on Non-Multisite Installs? =

A) No, your install must be Multiste enabled.


= Q) Can I activate this plugin within a Network Website? =

A) No, only within the Network Admin.


= Q) Can I add my own robots.txt file? =

A) Yes


= Q) Does this plugin add Sitemap links to the robots.txt file? =

A) In the future, yes... however, not currently. Several Sitemap plugins will automatically add it for you, and all sites should be using a sitemap plugin!


= Q) Can I use other robots.txt file plugins with yours? =

A) Yes... but you must disable the robots.txt file for that Website you want to use the other plugin on. To do this, access the MS Robots.txt Settings, select the Website, and click the "disable this website" button to turn the manager for that Website.


[Frequently Asked Questions](http://technerdia.com/projects/robotstxt/faq.html)





== Arbitrary section ==

[View the Install Guide](http://technerdia.com/projects/robotstxt/projects.html) | 
[Screenshots](http://technerdia.com/projects/robotstxt/screenshots.html) | 
[Feedback](http://technerdia.com/feedback.html)

### Understanding the Default Settings

* When you first enter the MS Robots.txt Settings page, the shown robots.txt file is the default "network only" or "network wide" working copy. Modify the default robots.txt file, save the default file, and when ready click the "publish to network" button to duplicate the robots.txt file to all Websites within the Network.

### New Website Added to Network

* If every Website uses the Networks default robots.txt file, simply click the "publish to network" button to copy the default robots.txt file over to any new Websites you have.
* Per Site: Change to the Website in the dropdown. Then click the "reset this website" button to copy the default robots.txt file to this Website. If needed, modify the robots.txt file and click the "update this website" button once done.

### Manage a Websites Robots.txt File

* To manage a Website directly, select the Website from the dropdown, then click the "change sites" button. This will display the robots.txt file for the selected Website. Change the robots.txt file how you like, once done click the "update this website" button to publish the modification.

### Disable a Website

* To disable the MS Robots.txt Manager on a Website, click the "disable this website" button. This will clear the option settings for this Website, making the Wordpress default robots.txt file display.

### Reseting

* Reset Default: Something wrong? No worries! When viewing the Networks robots.txt file, click the "reset to default" button to replace the displayed robots.txt file with the core "coded in" default robots.txt file.
* Reset Website: To reset a Websites robots.txt file, change to the Website within the dropdown, then click the "reset this website" button to pull in the "Networks Default Robots.txt file" (not the coded in default file).

### Presets / Examples Tab

* Use the provided examples to create your own robots.txt file.... or within the dropdown, select either the Networks Robots.txt file or a Websites Robots.txt file, then click the "set as default" button to copy the example over, to the selected file.

### Sitemaps and Sitemap Plugins

* In a future release I will add an auto sitemap detector..... for now, it is best to use one of the more popular sitemap plugins, which adds the sitemap URL to the robots.txt file for you.





== Changelog ==
Alpha Release

= 0.1.1 =
* Removed ob_gzhandler
* Replaced action do_robots with filter robots_txt.

= 0.1 =
* Created March 08, 2012



== Upgrade Notice ==
No Upgrades At This Time



== Screenshots ==

- More Screenshots --> http://technerdia.com/projects/robotstxt/screenshots.html

1. Collage of Multisite Robots.txt Manager Features.