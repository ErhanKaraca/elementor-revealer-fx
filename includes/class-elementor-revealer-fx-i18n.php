<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://turuncuweb.net
 * @since      1.0.0
 *
 * @package    Elementor_Revealer_Fx
 * @subpackage Elementor_Revealer_Fx/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Elementor_Revealer_Fx
 * @subpackage Elementor_Revealer_Fx/includes
 * @author     Turuncu Internet Solutions <ping@turuncuweb.net>
 */
class Elementor_Revealer_Fx_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'elementor-revealer-fx',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
