<?php

namespace Elementor;


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Product_Categories_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'product_categories_widget';
    }

    public function get_title()
    {
        return 'Product Categories';
    }

    public function get_icon()
    {
        return 'eicon-product';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        // Layout Section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => __('Layout Options', 'plugin-name'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => __('Select Layout', 'plugin-name'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __('Default', 'plugin-name'),
                    'card_overlay' => __('Card Overlay', 'plugin-name'),
                    'list_view' => __('List View', 'plugin-name'),
                    'circular' => __('Circular Display', 'plugin-name'), // New circular layout option
                ],
                'default' => 'default',
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'plugin-name'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Padding Control
        $this->add_control(
            'card_padding',
            [
                'label' => __('Card Padding', 'plugin-name'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .category-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );




        //Add Text Stroke control for category title
        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'text_stroke',
                'selector' => '{{WRAPPER}} .category-title',
            ]
        );



        // Background Color Control
        $this->add_control(
            'card_background_color',
            [
                'label' => __('Background Color', 'plugin-name'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Space Between Text and Image
        $this->add_control(
            'space_text_image',
            [
                'label' => __('Space Between Text and Image', 'plugin-name'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 50, 'step' => 1],
                ],
                'selectors' => [
                    '{{WRAPPER}} .category-item h1' => 'margin-top: {{SIZE}}{{UNIT}};',
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
                'selector' => '{{WRAPPER}} .category-title', // Target the element you want to style
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $layout_type = $settings['layout_type'];

        // Get product categories
        $args = [
            'taxonomy' => 'product_cat',
            'orderby' => 'name',
            'hide_empty' => false,
        ];

        $product_categories = get_terms($args);

        if (empty($product_categories) || is_wp_error($product_categories)) {
            echo '<p>No product categories found.</p>';
            return;
        }

        echo '<div class="product-categories-widget">';

        foreach ($product_categories as $category) {
            $category_image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
            $category_image_url = wp_get_attachment_url($category_image_id);

            // Render based on layout type
            switch ($layout_type) {
                case 'card_overlay':
                    ?>
                    <div class="category-item category-overlay">
                        <?php if ($category_image_url): ?>
                            <div class="category-image" style="background-image: url('<?php echo esc_url($category_image_url); ?>');"></div>
                        <?php endif; ?>
                        <h1 class="category-title"><?php echo esc_html($category->name); ?></h1>
                    </div>
                    <?php
                    break;

                case 'list_view':
                    ?>
                    <div class="category-item category-list-view">
                        <?php if ($category_image_url): ?>
                            <img src="<?php echo esc_url($category_image_url); ?>" alt="<?php echo esc_attr($category->name); ?>"
                                class="category-image">
                        <?php endif; ?>
                        <h1 class="category-title"><?php echo esc_html($category->name); ?></h1>
                    </div>
                    <?php
                    break;
                case 'circular': // New circular layout
                    ?>
                    <div class="category-item category-circular">
                        <?php if ($category_image_url): ?>
                            <div class="category-image" style="background-image: url('<?php echo esc_url($category_image_url); ?>');"></div>
                        <?php endif; ?>
                        <h1 class="category-title"><?php echo esc_html($category->name); ?></h1>
                    </div>
                    <?php
                    break;


                default: // 'default'
                    ?>
                    <div class="category-item category-default">
                        <?php if ($category_image_url): ?>
                            <img src="<?php echo esc_url($category_image_url); ?>" alt="<?php echo esc_attr($category->name); ?>"
                                class="category-image">
                        <?php endif; ?>
                        <h1 class="category-title"><?php echo esc_html($category->name); ?></h1>
                    </div>
                    <?php
                    break;
            }
        }

        echo '</div>';
    }
}

Plugin::instance()->widgets_manager->register_widget_type(new Product_Categories_Widget());
