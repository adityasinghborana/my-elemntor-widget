<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Logo_Navigation_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'logo_navigation_widget';
    }

    public function get_title()
    {
        return 'Logo and Navigation';
    }

    public function get_icon()
    {
        return 'eicon-site-logo'; // You can change this to any other Elementor icon
    }

    public function get_categories()
    {
        return ['basic']; // You can assign it to different categories like 'basic' or 'general'
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'plugin-name'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Background Color
        $this->add_control(
            'background_color',
            [
                'label' => __('Background Color', 'plugin-name'),
                'type' => Controls_Manager::COLOR,
                'default' => '#f5f5f5',
                'selectors' => [
                    '{{WRAPPER}} .logo-nav' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Padding
        $this->add_control(
            'header_padding',
            [
                'label' => __('Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => '20',
                    'right' => '20',
                    'bottom' => '20',
                    'left' => '20',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .logo-nav' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border Radius
        $this->add_control(
            'header_roundness',
            [
                'label' => __('Roundness', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem'],
                'default' => [
                    'top' => '10',
                    'right' => '10',
                    'bottom' => '10',
                    'left' => '10',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .logo-nav' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Link Color
        $this->add_control(
            'link_color',
            [
                'label' => __('Link Color', 'plugin-name'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .nav-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Link Hover Color
        $this->add_control(
            'link_hover_color',
            [
                'label' => __('Link Hover Color', 'plugin-name'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ff6600',
                'selectors' => [
                    '{{WRAPPER}} .nav-link:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'display_style',
            [
                'label' => __('Display Style', 'plugin-name'),
                'type' => Controls_Manager::SELECT,
                'default' => 'flex',
                'options' => [
                    'flex' => __('Flex', 'plugin-name'),
                    'block' => __('Block', 'plugin-name'),
                ],
                'selectors' => [
                    '{{WRAPPER}} nav' => 'display: {{VALUE}};',  // Color & display styles
                ],
            ]
        );
        $this->add_control(
            'justify_content',
            [
                'label' => __('Justify Content', 'plugin-name'),
                'type' => Controls_Manager::SELECT,
                'default' => 'flex-start',
                'options' => [
                    'flex-start' => __('Start', 'plugin-name'),
                    'center' => __('Center', 'plugin-name'),
                    'flex-end' => __('End', 'plugin-name'),
                    'space-between' => __('Space Between', 'plugin-name'),
                    'space-around' => __('Space Around', 'plugin-name'),
                ],
                'selectors' => [
                    '{{WRAPPER}} nav' => 'justify-content: {{VALUE}};',  // Control content position in flexbox
                ],
            ]
        );
        $this->add_control(
            'align_items',
            [
                'label' => __('Vertical Alignment', 'plugin-name'),
                'type' => Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'flex-start' => __('Start', 'plugin-name'),
                    'center' => __('Center', 'plugin-name'),
                    'flex-end' => __('End', 'plugin-name'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .logo-nav' => 'align-items: {{VALUE}};',  // Vertical alignment
                ],
            ]
        );

        // Width
        $this->add_control(
            'width_header',
            [
                'label' => __('Header Width', 'plugin-name'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => '%',
                    'size' => 100,
                ],
                'range' => [
                    '%' => ['min' => 10, 'max' => 100, 'step' => 1],
                    'px' => ['min' => 100, 'max' => 1200, 'step' => 1],
                ],
                'selectors' => [
                    '{{WRAPPER}} .logo-nav' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'link_spacing',
            [
                'label' => __('Space Between Links', 'plugin-name'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 100, 'step' => 1],
                    'em' => ['min' => 0, 'max' => 10, 'step' => 0.1],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16, // Default space between links
                ],
                'selectors' => [
                    '{{WRAPPER}} .nav-link' => 'margin-right: {{SIZE}}{{UNIT}};',  // Space between links
                ],
            ]
        );
        $this->add_control(
            'menu_select',
            [
                'label' => __('Select Menu', 'plugin-name'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_menus(), // Fetch available menus
                'default' => '', // Default to no menu selected
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sticky_header',
            [
                'label' => __('Enable Sticky Header', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'No' => __('No', 'plugin-name'),
                    'yes' => __('Yes', 'plugin-name'),
                ],
                'default' => 'No', // Default to 'No'
                'label_block' => true,
            ]
        );

        $this->add_control(
            'height_header',
            [
                'label' => __('Header Height', 'plugin-name'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'default' => [
                    'unit' => '%',
                    'size' => 60,
                ],
                'range' => [
                    '%' => ['min' => 10, 'max' => 100, 'step' => 1],
                    'px' => ['min' => 60, 'max' => 1200, 'step' => 1],
                ],
                'selectors' => [
                    '{{WRAPPER}} nav' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(), // Use the type directly
            [
                'name' => 'typography', // Unique name for this control
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY, // Set global default typography
                ],
                'selector' => '{{WRAPPER}} .navigation-links', // Target the element you want to style
            ]
        );

        $this->end_controls_section();
    }
    public function get_menus()
    {
        $menus = wp_get_nav_menus();
        $menu_options = [];

        foreach ($menus as $menu) {
            $menu_options[$menu->term_id] = $menu->name;
        }

        return $menu_options;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $menu_id = $settings['menu_select'];
        $sticky_header = $settings['sticky_header']; // Get sticky header option

        // Check if sticky header is enabled
        $class = 'logo-nav'; // Default class
        if ('yes' === $sticky_header) {
            $class .= ' sticky-header'; // Add sticky-header class if enabled
        }

        if ($menu_id) {
            $menu_items = wp_get_nav_menu_items($menu_id);
            ?>
            <nav class="<?php echo esc_attr($class); ?>"> <!-- Apply dynamic class here -->
                <div class="logo-container">
                    <?php if (has_custom_logo()): ?>
                        <div class="custom-logo">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else: ?>
                        <h1 class="site-title">My Site</h1>
                    <?php endif; ?>
                </div>

                <div class="navigation-links">
                    <?php foreach ($menu_items as $item): ?>
                        <a href="<?php echo esc_url($item->url); ?>" class="nav-link">
                            <?php echo esc_html($item->title); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </nav>
            <?php
        } else {
            ?>
            <nav class="<?php echo esc_attr($class); ?>"> <!-- Apply dynamic class here -->
                <div class="logo-container">
                    <?php if (has_custom_logo()): ?>
                        <div class="custom-logo">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else: ?>
                        <h1 class="site-title">My Site</h1>
                    <?php endif; ?>
                </div>

                <div class="navigation-links">
                    <a href="#" class="nav-link">Home</a>
                    <a href="#" class="nav-link">About</a>
                    <a href="#" class="nav-link">Shop</a>
                    <a href="#" class="nav-link">Contact Us</a>
                </div>
            </nav>
            <?php
        }
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Logo_Navigation_Widget());
