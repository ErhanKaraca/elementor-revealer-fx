<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://turuncuweb.net
 * @since      1.0.0
 *
 * @package    Elementor_Revealer_Fx
 * @subpackage Elementor_Revealer_Fx/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Elementor_Revealer_Fx
 * @subpackage Elementor_Revealer_Fx/public
 * @author     Turuncu Internet Solutions <ping@turuncuweb.net>
 */
class Elementor_Revealer_Fx_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, ELEMENTOR_REVEALER_FX_PLUGIN_URL . '/assets/css/elementor-revealer-fx.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( "anime-js", ELEMENTOR_REVEALER_FX_PLUGIN_URL . '/assets/js/anime.min.js', null, $this->version, true );
		wp_enqueue_script( "scroll-monitor", ELEMENTOR_REVEALER_FX_PLUGIN_URL . '/assets/js/scrollMonitor.js', null, $this->version, true );
		wp_enqueue_script( "reveal-fx", ELEMENTOR_REVEALER_FX_PLUGIN_URL . '/assets/js/revealfx.js', null, $this->version, true );
		wp_enqueue_script( $this->plugin_name, ELEMENTOR_REVEALER_FX_PLUGIN_URL . '/assets/js/elementor-revealer-fx.js', null, $this->version, true );
	}
	
	/**
	 * Register Extensions
	 *
	 * @since    1.0.0
	 */
	public function register_extensions($widgets_manager) {
		$extensions_files = glob( plugin_dir_path( dirname( __FILE__ )) . 'extensions/*.php' );

		foreach ( $extensions_files as $file ) {
			require_once( $file );
			$class_name = basename( $file, '.php' );
			$class_name = 'Elementor_' . ucfirst( $class_name ) . '_Extension';
			if ( class_exists( $class_name ) ) {
				new $class_name();
			}
		}
	}

	/**
	 * Register Widgets
	 *
	 * @since    1.0.0
	 */
	public function register_widgets($widgets_manager) {
		$widget_files = glob( plugin_dir_path( dirname( __FILE__ ))  . 'widgets/*.php' );

		foreach ( $widget_files as $file ) {
			require_once( $file );
			$class_name = basename( $file, '.php' );
			$class_name = 'Elementor_' . ucfirst( $class_name ) . '_Widget';
			if ( class_exists( $class_name ) ) {
				$widgets_manager->register( new $class_name() );
			}
		}
	}
}
