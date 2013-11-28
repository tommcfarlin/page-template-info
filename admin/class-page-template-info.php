<?php
/**
 * Page Template Info
 *
 * @package   Page_Template_Info
 * @author    Tom McFarlin <tom@tommcfarlin.com>
 * @license   GPL-2.0+
 * @link      http://tommcfarlin.com
 * @copyright 2013 Tom McFarlin / Pressware, LLC
 */

/**
 * @package PTL
 * @package Page_Template_Info
 * @author  Tom McFarlin <tom@tommcfarlin.com>
 */
class Page_Template_Info {

	/**
	 * The version of this class.
	 *
	 * @since    0.1.0
	 *
	 * @var      string
	 */
	const VERSION = '0.2.0';

	/**
	 * Instance of this class.
	 *
	 * @since    0.1.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     0.1.0
	 */
	private function __construct() {

		$this->plugin_slug = 'ptl';

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
		add_action( 'wp_ajax_get_page_template', array( $this, 'get_page_template' ) );

	} // end constructor

	/**
	 * Return an instance of this class.
	 *
	 * @since     0.1.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		} // end if

		return self::$instance;

	} // end get_instance'

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     0.1.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( 'edit-page' === get_current_screen()->id ) {

			wp_enqueue_script(
				$this->plugin_slug . '-admin-script',
				plugins_url( 'assets/js/admin.js', __FILE__ ),
				array( 'jquery' ),
				Page_Template_Info::VERSION
			);

		} // end if

	} // end enqueue_admin_scripts

	/**
	 * Echos the name of the template file back to the client.
	 *
	 * @since    0.1.0
	 */
	public function get_page_template() {

		// If the page ID is found in the $_GET collection and it's part of the expected array
		if ( isset( $_GET['page_id'] ) && is_array( $_GET['page_id'] ) ) {
			echo $this->get_template_name( $this->get_template( $_GET['page_id'][0] ) );
		} // end if

		die();

	} // end get_page_template

	/**
	 * Retrieves teh path to the page's template as identified by the incoming ID.
	 *
	 * @param    number    $page_id    The ID of the page for which we're retrieving the template.
	 * @return   string                The path to the page's template.
	 * @since    0.1.0
	 */
	private function get_template( $page_id ) {

		$template_file = get_post_meta( $page_id, '_wp_page_template', true );

		return trailingslashit( get_stylesheet_directory() ) . $template_file;

	} // end get_template

	/**
	 * Retrieves the name of the template based on the path of the incoming file.
	 *
	 * @param    string    $template_file    The path to the template file.
	 * @return   string    $template_name    The name of the template.
	 * @since    0.1.0
	 */
	private function get_template_name( $template_file ) {

		$template_name = '';

		// Now get the name of the template;
		$template_file = @file_get_contents( $template_file );
		if ( 0 !== ( preg_match( '|Template Name:(.*)$|mi', $template_file, $matches ) ) ) {
			$template_name = trim( $matches[1] );
		} // end if

		return $template_name;

	} // end get_template_name

} // end class
