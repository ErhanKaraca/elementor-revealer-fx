<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://turuncuweb.net
 * @since             1.0.0
 * @package           Elementor_Revealer_Fx
 *
 * @wordpress-plugin
 * Plugin Name:       Revealer FX for Elementor
 * Plugin URI:        https://github.com/ErhanKaraca/elementor-revealer-fx
 * Description:       Extends your Elementor widgets with revealer effects
 * Version:           1.0.0
 * Author:            Turuncu Internet Solutions
 * Author URI:        https://turuncuweb.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       revealer-fx-for-elementor
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ELEMENTOR_REVEALER_FX_VERSION', '1.0.0' );
define( 'ELEMENTOR_REVEALER_FX_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ELEMENTOR_REVEALER_FX_PLUGIN_URL', plugin_dir_url( __FILE__ ) );



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-elementor-revealer-fx-activator.php
 */
function activate_elementor_revealer_fx() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-elementor-revealer-fx-activator.php';
	Elementor_Revealer_Fx_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-elementor-revealer-fx-deactivator.php
 */
function deactivate_elementor_revealer_fx() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-elementor-revealer-fx-deactivator.php';
	Elementor_Revealer_Fx_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_elementor_revealer_fx' );
register_deactivation_hook( __FILE__, 'deactivate_elementor_revealer_fx' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-elementor-revealer-fx.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_elementor_revealer_fx() {

	$plugin = new Elementor_Revealer_Fx();
	$plugin->run();

}
run_elementor_revealer_fx();
