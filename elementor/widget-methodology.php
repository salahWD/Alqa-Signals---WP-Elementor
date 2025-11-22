<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

class ALQA_SIGNALS_Methodology_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'alqa_signals_methodology';
    }

    public function get_title()
    {
        return __('Methodology Section', 'alqa_signals');
    }

    public function get_icon()
    {
        return 'eicon-cog';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        // === Section: Content ===
        $this->start_controls_section(
            'section_methodology_content',
            [
                'label' => __('Section Content', 'alqa_signals'),
            ]
        );

        // Title
        $this->add_control(
            'methodology_title',
            [
                'label' => __('Title', 'alqa_signals'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Methodology', 'alqa_signals'),
            ]
        );

        // Description
        $this->add_control(
            'methodology_description',
            [
                'label' => __('Description', 'alqa_signals'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Our methodology is based on clarity, reproducibility, and real-world relevance.', 'alqa_signals'),
            ]
        );

        // Subtitle
        $this->add_control(
            'methodology_subtitle',
            [
                'label' => __('Subtitle', 'alqa_signals'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Pillars', 'alqa_signals'),
            ]
        );

        // List (Repeater)
        $this->add_control(
            'methodology_list',
            [
                'label' => __('Pillars List', 'alqa_signals'),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => [
                    [
                        'name' => 'list_item',
                        'label' => __('List Item', 'alqa_signals'),
                        'type' => Controls_Manager::TEXT,
                        'default' => __('Reliable data sources', 'alqa_signals'),
                    ],
                ],
                'default' => [
                    ['list_item' => 'Reliable data sources'],
                    ['list_item' => 'Structured data splitting (train/validate/test)'],
                    ['list_item' => 'Robustness checks: sensitivity, slippage, costs, volatility'],
                    ['list_item' => 'Clear hypotheses, precise indicators, ethical controls'],
                ],
                'title_field' => '{{{ list_item }}}',
            ]
        );

        // Bottom text
        $this->add_control(
            'methodology_bottom_text',
            [
                'label' => __('Bottom Text', 'alqa_signals'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Why? We build frameworks for understanding, not predictions.', 'alqa_signals'),
            ]
        );

        $this->end_controls_section();

        // === Section: Images ===
        $this->start_controls_section(
            'section_methodology_images',
            [
                'label' => __('Images', 'alqa_signals'),
            ]
        );

        // Big Image
        $this->add_control(
            'methodology_image_big',
            [
                'label' => __('Main Image', 'alqa_signals'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // 3 Small Images
        $this->add_control(
            'methodology_image_1',
            [
                'label' => __('Small Image 1', 'alqa_signals'),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => Utils::get_placeholder_image_src()],
            ]
        );

        $this->add_control(
            'methodology_image_2',
            [
                'label' => __('Small Image 2', 'alqa_signals'),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => Utils::get_placeholder_image_src()],
            ]
        );

        $this->add_control(
            'methodology_image_3',
            [
                'label' => __('Small Image 3', 'alqa_signals'),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => Utils::get_placeholder_image_src()],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="section_methodology">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Left Column -->
                    <div class="col-lg-6">
                        <div class="thumb-methodology wow fadeInUp">
                            <div class="shape-methodology"></div>

                            <?php if (!empty($settings['methodology_image_big']['url'])) : ?>
                                <figure>
                                    <img src="<?php echo esc_url($settings['methodology_image_big']['url']); ?>" alt="Methodology Image" />
                                </figure>
                            <?php endif; ?>

                            <div class="avt-methodology">
                                <?php if (!empty($settings['methodology_image_1']['url'])) : ?>
                                    <figure><img src="<?php echo esc_url($settings['methodology_image_1']['url']); ?>" alt="Image 1" /></figure>
                                <?php endif; ?>
                                <?php if (!empty($settings['methodology_image_2']['url'])) : ?>
                                    <figure><img src="<?php echo esc_url($settings['methodology_image_2']['url']); ?>" alt="Image 2" /></figure>
                                <?php endif; ?>
                                <?php if (!empty($settings['methodology_image_3']['url'])) : ?>
                                    <figure><img src="<?php echo esc_url($settings['methodology_image_3']['url']); ?>" alt="Image 3" /></figure>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-6">
                        <div class="sec_head wow fadeInUp">
                            <h2><span><?php echo esc_html($settings['methodology_title']); ?></span></h2>
                            <p><?php echo esc_html($settings['methodology_description']); ?></p>
                        </div>

                        <div class="dta-projects wow fadeInUp">
                            <p><?php echo esc_html($settings['methodology_subtitle']); ?></p>

                            <?php if (!empty($settings['methodology_list'])) : ?>
                                <ul>
                                    <?php foreach ($settings['methodology_list'] as $item) : ?>
                                        <li><strong><?php echo esc_html($item['list_item']); ?></strong></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <?php if (!empty($settings['methodology_bottom_text'])) : ?>
                                <div class="explore-awareness">
                                    <p><?php echo esc_html($settings['methodology_bottom_text']); ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </section>
<?php
    }
}
