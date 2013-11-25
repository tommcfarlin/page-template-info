<?php
/**
 * Page Template Info
 *
 * A plugin to get a quick glace for which template a page is viewing on
 * the 'All Pages' dashboard page.
 *
 * @package   PTL
 * @author    Tom McFarlin <tom@tommcfarlin.com?
 * @license   GPL-2.0+
 * @link      http://github.com/tommcfarlin/page-template-info/
 * @copyright 2013 Tom McFarlin / Pressware, LLC
 *
 * @wordpress-plugin
 * Plugin Name:       Page Template Info
 * Plugin URI:        http://github.com/tommcfarlin/page-template-info/
 * Description:       Get a quick glance of the templates your pages are using on the 'All Pages' dashboard page.
 * Version:           0.1.0
 * Author:            Tom McFarlin
 * Author URI:        http://tommcfarlin.com
 * Text Domain:       page-template-info
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/tommcfarlin/page-template-info/
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // end if

if ( is_admin() ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-page-template-info.php' );
	add_action( 'plugins_loaded', array( 'Page_Template_Info', 'get_instance' ) );

} // end if
