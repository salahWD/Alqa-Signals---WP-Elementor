<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

class ALQA_SIGNALS_Research_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'alqa_signals_research';
    }

    public function get_title()
    {
        return __('Research Section', 'alqa_signals');
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        // === Research Section Content ===
        $this->start_controls_section(
            'section_research_content',
            [
                'label' => __('Research Content', 'alqa_signals'),
            ]
        );

        // Title
        $this->add_control(
            'research_title',
            [
                'label' => __('Title', 'alqa_signals'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Market Intelligence & Research', 'alqa_signals'),
            ]
        );

        // Description
        $this->add_control(
            'research_description',
            [
                'label' => __('Description', 'alqa_signals'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Comprehensive mix of real-time analytics and in-depth research. Designed for clarity, backed by data and quantitative models.', 'alqa_signals'),
            ]
        );

        // Enable CTA
        $this->add_control(
            'research_enable_cta',
            [
                'label' => __('Enable CTA Button', 'alqa_signals'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'alqa_signals'),
                'label_off' => __('Hide', 'alqa_signals'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // CTA Label
        $this->add_control(
            'research_cta_label',
            [
                'label' => __('CTA Label', 'alqa_signals'),
                'type' => Controls_Manager::TEXT,
                'default' => __('View All Reports', 'alqa_signals'),
                'condition' => [
                    'research_enable_cta' => 'yes',
                ],
            ]
        );

        // CTA Link
        $this->add_control(
            'research_cta_link',
            [
                'label' => __('CTA Link', 'alqa_signals'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'alqa_signals'),
                'default' => [
                    'url' => '#',
                ],
                'condition' => [
                    'research_enable_cta' => 'yes',
                ],
            ]
        );

        // CTA Style Toggle
        $this->add_control(
            'research_cta_special',
            [
                'label' => __('Special CTA Style', 'alqa_signals'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Special', 'alqa_signals'),
                'label_off' => esc_html__('Default', 'alqa_signals'),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'research_enable_cta' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <section class="section_research">
            <div class="container">
                <div class="txt-research wow fadeInUp">
                    <h2><?php echo esc_html($settings['research_title']); ?></h2>
                    <p><?php echo esc_html($settings['research_description']); ?></p>

                    <?php if ('yes' === $settings['research_enable_cta']) :
                        $cta_class = $settings['research_cta_special'] === 'yes' ? 'btn-special' : 'btn-site'; ?>
                        <a href="<?php echo esc_url($settings['research_cta_link']['url']); ?>"
                            class="<?php echo esc_attr($cta_class); ?>">
                            <?php echo esc_html($settings['research_cta_label']); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

<?php
    }
}
