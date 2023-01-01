<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Mp_Core
 * @subpackage Mp_Core/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Mp_Core
 * @subpackage Mp_Core/admin
 * @author     Your Name <email@example.com>
 */
class Mp_Core_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $mp_core    The ID of this plugin.
	 */
	private $mp_core;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $mp_core       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($mp_core, $version)
	{

		$this->mp_core = $mp_core;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mp_Core_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mp_Core_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->mp_core, plugin_dir_url(__FILE__) . 'css/mp-core-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Mp_Core_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Mp_Core_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->mp_core, plugin_dir_url(__FILE__) . 'js/mp-core-admin.js', array('jquery'), $this->version, false);
	}
}
