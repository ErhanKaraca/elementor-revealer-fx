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
 * @package    Elementor_Revealer_Fx
 * @subpackage Elementor_Revealer_Fx/includes
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
                'label' => __('RevealFx Settings', 'elementor-revealer-fx'),
                'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            ]
        );

        $element->add_control(
            'reveal_fx_enable',
            [
                'label' => __('Activate RevealFx', 'elementor-revealer-fx'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Evet', 'elementor-revealer-fx'),
                'label_off' => __('Hayır', 'elementor-revealer-fx'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $element->add_control(
            'reveal_fx_duration',
            [
                'label' => __('Duration (ms)', 'elementor-revealer-fx'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 500,
            ]
        );

        $element->add_control(
            'reveal_fx_easing',
            [
                'label' => __('Easing', 'elementor-revealer-fx'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'easeInSine' => __('easeInSine', 'elementor-revealer-fx'),
                    'easeOutSine' => __('easeOutSine', 'elementor-revealer-fx'),
                    'easeInOutSine' => __('easeInOutSine', 'elementor-revealer-fx'),
                    'easeInQuad' => __('easeInQuad', 'elementor-revealer-fx'),
                    'easeOutQuad' => __('easeOutQuad', 'elementor-revealer-fx'),
                    'easeInOutQuad' => __('easeInOutQuad', 'elementor-revealer-fx'),
                    'easeOutCubic' => __('easeOutCubic', 'elementor-revealer-fx'),
                    'easeInOutCubic' => __('easeInOutCubic', 'elementor-revealer-fx'),
                    'easeInQuart' => __('easeInQuart', 'elementor-revealer-fx'),
                    'easeOutQuart' => __('easeOutQuart', 'elementor-revealer-fx'),
                    'easeInOutQuart' => __('easeInOutQuart', 'elementor-revealer-fx'),
                    'easeInQuint' => __('easeInQuint', 'elementor-revealer-fx'),
                    'easeOutQuint' => __('easeOutQuint', 'elementor-revealer-fx'),
                    'easeInOutQuint' => __('easeInOutQuint', 'elementor-revealer-fx'),
                    'easeInExpo' => __('easeInExpo', 'elementor-revealer-fx'),
                    'easeOutExpo' => __('easeOutExpo', 'elementor-revealer-fx'),
                    'easeInOutExpo' => __('easeInOutExpo', 'elementor-revealer-fx'),
                    'easeInCirc' => __('easeInCirc', 'elementor-revealer-fx'),
                    'easeOutCirc' => __('easeOutCirc', 'elementor-revealer-fx'),
                    'easeInOutCirc' => __('easeInOutCirc', 'elementor-revealer-fx'),
                    'easeInBack' => __('easeInBack', 'elementor-revealer-fx'),
                    'easeOutBack' => __('easeOutBack', 'elementor-revealer-fx'),
                    'easeInOutBack' => __('easeInOutBack', 'elementor-revealer-fx'),
                    'easeInElastic' => __('easeInElastic', 'elementor-revealer-fx'),
                    'easeOutElastic' => __('easeOutElastic', 'elementor-revealer-fx'),
                    'easeInOutElastic' => __('easeInOutElastic', 'elementor-revealer-fx'),
                    'easeInBounce' => __('easeInBounce', 'elementor-revealer-fx'),
                    'easeOutBounce' => __('easeOutBounce', 'elementor-revealer-fx'),
                    'easeInOutBounce' => __('easeInOutBounce', 'elementor-revealer-fx'),
                ],
                'default' => 'easeInOutQuint',
            ]
        );

        $element->add_control(
            'reveal_fx_delay',
            [
                'label' => __('Delay (ms)', 'elementor-revealer-fx'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
            ]
        );

        $element->add_control(
            'reveal_fx_bgcolor',
            [
                'label' => __('Background Color', 'elementor-revealer-fx'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#f2f6f7',
            ]
        );

        $element->add_control(
            'reveal_fx_direction',
            [
                'label' => __('Direction', 'elementor-revealer-fx'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'lr' => __('Left -> Right', 'elementor-revealer-fx'),
                    'rl' => __('Right -> Let', 'elementor-revealer-fx'),
                    'tb' => __('Top -> Down', 'elementor-revealer-fx'),
                    'bt' => __('Down -> Top', 'elementor-revealer-fx'),
                ],
                'default' => 'lr',
            ]
        );

        $element->add_control(
            'reveal_fx_coverarea',
            [
                'label' => __('Cover Area Width (%)', 'elementor-revealer-fx'),
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