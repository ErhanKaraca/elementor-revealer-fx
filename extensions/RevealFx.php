<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://turuncuweb.net
 * @since      1.0.0
 *
 * @package    Revealer_Fx_For_Elementor
 * @subpackage Revealer_Fx_For_Elementor/includes
 */

if (!defined('ABSPATH')) {
    exit;
}

class Elementor_RevealFx_Extension {
    
    public function __construct() {

        if (!did_action('elementor/loaded')) {
            return;
        }

        add_action('elementor/controls/register', [$this, 'register_controls']);
        add_action('elementor/frontend/widget/before_render', [$this, 'add_revealfx_attributes']);
    }
    
    public function register_controls($controls_manager) {
        add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'add_revealfx_controls'], 10, 2);
        add_action('elementor/element/column/section_advanced/after_section_end', [$this, 'add_revealfx_controls'], 10, 2);
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'add_revealfx_controls'], 10, 2);
    }

    public function add_revealfx_controls($element, $args) {
        $element->start_controls_section(
            'reveal_fx_section',
            [
                'label' => __('RevealFx Settings', 'revealer-fx-for-elementor'),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'reveal_fx_enable',
            [
                'label' => __('Activate RevealFx', 'revealer-fx-for-elementor'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Evet', 'revealer-fx-for-elementor'),
                'label_off' => __('Hayır', 'revealer-fx-for-elementor'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $element->add_control(
            'reveal_fx_duration',
            [
                'label' => __('Duration (ms)', 'revealer-fx-for-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 500,
            ]
        );

        $element->add_control(
            'reveal_fx_easing',
            [
                'label' => __('Easing', 'revealer-fx-for-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'easeInSine' => __('easeInSine', 'revealer-fx-for-elementor'),
                    'easeOutSine' => __('easeOutSine', 'revealer-fx-for-elementor'),
                    'easeInOutSine' => __('easeInOutSine', 'revealer-fx-for-elementor'),
                    'easeInQuad' => __('easeInQuad', 'revealer-fx-for-elementor'),
                    'easeOutQuad' => __('easeOutQuad', 'revealer-fx-for-elementor'),
                    'easeInOutQuad' => __('easeInOutQuad', 'revealer-fx-for-elementor'),
                    'easeOutCubic' => __('easeOutCubic', 'revealer-fx-for-elementor'),
                    'easeInOutCubic' => __('easeInOutCubic', 'revealer-fx-for-elementor'),
                    'easeInQuart' => __('easeInQuart', 'revealer-fx-for-elementor'),
                    'easeOutQuart' => __('easeOutQuart', 'revealer-fx-for-elementor'),
                    'easeInOutQuart' => __('easeInOutQuart', 'revealer-fx-for-elementor'),
                    'easeInQuint' => __('easeInQuint', 'revealer-fx-for-elementor'),
                    'easeOutQuint' => __('easeOutQuint', 'revealer-fx-for-elementor'),
                    'easeInOutQuint' => __('easeInOutQuint', 'revealer-fx-for-elementor'),
                    'easeInExpo' => __('easeInExpo', 'revealer-fx-for-elementor'),
                    'easeOutExpo' => __('easeOutExpo', 'revealer-fx-for-elementor'),
                    'easeInOutExpo' => __('easeInOutExpo', 'revealer-fx-for-elementor'),
                    'easeInCirc' => __('easeInCirc', 'revealer-fx-for-elementor'),
                    'easeOutCirc' => __('easeOutCirc', 'revealer-fx-for-elementor'),
                    'easeInOutCirc' => __('easeInOutCirc', 'revealer-fx-for-elementor'),
                    'easeInBack' => __('easeInBack', 'revealer-fx-for-elementor'),
                    'easeOutBack' => __('easeOutBack', 'revealer-fx-for-elementor'),
                    'easeInOutBack' => __('easeInOutBack', 'revealer-fx-for-elementor'),
                    'easeInElastic' => __('easeInElastic', 'revealer-fx-for-elementor'),
                    'easeOutElastic' => __('easeOutElastic', 'revealer-fx-for-elementor'),
                    'easeInOutElastic' => __('easeInOutElastic', 'revealer-fx-for-elementor'),
                    'easeInBounce' => __('easeInBounce', 'revealer-fx-for-elementor'),
                    'easeOutBounce' => __('easeOutBounce', 'revealer-fx-for-elementor'),
                    'easeInOutBounce' => __('easeInOutBounce', 'revealer-fx-for-elementor'),
                ],
                'default' => 'easeInOutQuint',
            ]
        );

        $element->add_control(
            'reveal_fx_delay',
            [
                'label' => __('Delay (ms)', 'revealer-fx-for-elementor'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
            ]
        );

        $element->add_control(
            'reveal_fx_bgcolor',
            [
                'label' => __('Background Color', 'revealer-fx-for-elementor'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f2f6f7',
            ]
        );

        $element->add_control(
            'reveal_fx_direction',
            [
                'label' => __('Direction', 'revealer-fx-for-elementor'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'lr' => __('Left -> Right', 'revealer-fx-for-elementor'),
                    'rl' => __('Right -> Let', 'revealer-fx-for-elementor'),
                    'tb' => __('Top -> Down', 'revealer-fx-for-elementor'),
                    'bt' => __('Down -> Top', 'revealer-fx-for-elementor'),
                ],
                'default' => 'lr',
            ]
        );

        $element->add_control(
            'reveal_fx_coverarea',
            [
                'label' => __('Cover Area Width (%)', 'revealer-fx-for-elementor'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
            ]
        );

        $element->end_controls_section();
    }

    public function add_revealfx_attributes($element) {
        $settings = $element->get_settings_for_display();

        if (!empty($settings['reveal_fx_enable']) && $settings['reveal_fx_enable'] === 'yes') {
            $element->add_render_attribute('_wrapper', [
                'class'         => 'elementor-reveal-fx',
                'data-duration' => esc_attr(isset($settings['reveal_fx_duration']) ? $settings['reveal_fx_duration'] : 500),
                'data-easing'   => esc_attr(isset($settings['reveal_fx_easing']) ? $settings['reveal_fx_easing'] : 'easeInOutQuint'),
                'data-delay'    => esc_attr(isset($settings['reveal_fx_delay']) ? $settings['reveal_fx_delay'] : 0),
                'data-bgcolor'  => esc_attr(isset($settings['reveal_fx_bgcolor']) ? $settings['reveal_fx_bgcolor'] : '#f2f6f7'),
                'data-direction'=> esc_attr(isset($settings['reveal_fx_direction']) ? $settings['reveal_fx_direction'] : 'lr'),
                'data-coverarea'=> esc_attr(isset($settings['reveal_fx_coverarea']['size']) ? $settings['reveal_fx_coverarea']['size'] : 0),
            ]);
        }
    }

}