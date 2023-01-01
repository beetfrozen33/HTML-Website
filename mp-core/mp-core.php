<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           mp_Core
 *
 * @wordpress-plugin
 * Plugin Name:       My Portfolio Core
 * Plugin URI:        https://www.alkalidesigns.com
 * Description:       This plugin enables the core functionality of the NetworkChuck portfolio template
 * Version:           1.0.0
 * Author:            Alkali
 * Author URI:        https://www.alkalidesigns.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mp-core
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('MP_CORE_VERSION', '1.0.0');
define('MP_PLUG_DIR', plugin_dir_url(__FILE__));
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mp-core-activator.php
 */
function activate_mp_core()
{

	require_once plugin_dir_path(__FILE__) . 'includes/class-mp-core-activator.php';
	Mp_Core_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mp-core-deactivator.php
 */
function deactivate_mp_core()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-mp-core-deactivator.php';
	Mp_Core_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_mp_core');
register_deactivation_hook(__FILE__, 'deactivate_mp_core');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-mp-core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mp_core()
{

	$plugin = new Mp_Core();
	$plugin->run();
}
run_mp_core();

// Custom notice on plugin instalation
register_activation_hook(__FILE__, 'mp_admin_notice_activation_hook');

function mp_admin_notice_activation_hook()
{
	set_transient('mp-admin-notice-example', true, 5);
}

add_action('admin_notices', 'mp_admin_notice_notice');

function mp_admin_notice_notice()
{

	/* Check transient, if available display notice */
	if (get_transient('mp-admin-notice-example')) {
?>
		<div class="updated error is-dismissible">
			<p>Before continuing with the theme please save your permalinks as Post Name </p>
		</div>
<?php
		/* Delete transient, only display this notice once. */
		delete_transient('mp-admin-notice-example');
	}
}



/**
 * Register MP theme custom pages.
 *
 * @since    1.0.0
 */
register_activation_hook(__FILE__, 'register_custom_pages');

function register_custom_pages()
{
	$about = get_page_by_title('About');

	if (!$about) {
		// Register custom page
		$my_post = array(
			'post_title'    => wp_strip_all_tags('About'),
			'post_content'  => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi voluptas veniam quas molestiae, dolorem soluta nihil aliquid perspiciatis nisi temporibus debitis delectus, voluptatibus eos qui sit quasi velit quo minima? Veniam fugiat similique ea odio sequi nulla non nesciunt dolore vitae! Assumenda nam repudiandae voluptatibus. Veritatis consectetur illo nam eveniet!',
			'post_status'   => 'publish',
			'post_author'   => 1,
			'post_type'     => 'page',
			'meta_input'	=> [
				'_wp_page_template' => 'template-about.php'
			]
		);

		// Insert the post into the database
		wp_insert_post($my_post);
	}
}
