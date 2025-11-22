<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

class ALQA_SIGNALS_About_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'alqa_signals_about';
    }

    public function get_title()
    {
        return __('About Section', 'alqa_signals');
    }

    public function get_icon()
    {
        return 'eicon-info-circle';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        // === Section: About Content ===
        $this->start_controls_section(
            'section_about_content',
            [
                'label' => __('About Section Content', 'alqa_signals'),
            ]
        );

        // Logo Text
        $this->add_control(
            'about_logo_text',
            [
                'label' => __('Logo Text', 'alqa_signals'),
                'type' => Controls_Manager::TEXT,
                'default' => __('About ALQA-Signals', 'alqa_signals'),
            ]
        );

        // Logo Image
        $this->add_control(
            'about_logo_image',
            [
                'label' => __('Logo Image', 'alqa_signals'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // About Text
        $this->add_control(
            'about_text',
            [
                'label' => __('About Text', 'alqa_signals'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __(
                    'Our philosophy is rooted in bridging the gap between sophisticated analytics and practical know-how. By combining rigorous quantitative techniques with user-friendly awareness resources, we empower investors and learners to navigate complex markets with clarity and confidence. Every insight demystifies financial decision-making and fosters a culture where data speaks louder than speculation.',
                    'alqa_signals'
                ),
            ]
        );

        // Link Label
        $this->add_control(
            'about_link_label',
            [
                'label' => __('Link Label', 'alqa_signals'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Download Company Profile', 'alqa_signals'),
            ]
        );

        // Link URL
        $this->add_control(
            'about_link_url',
            [
                'label' => __('Link URL', 'alqa_signals'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'alqa_signals'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <section class="section_about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="thumb-about wow fadeInUp">
                            <?php if (!empty($settings['about_logo_text'])) : ?>
                                <p><?php echo esc_html($settings['about_logo_text']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($settings['about_logo_image']['url'])) : ?>
                                <figure>
                                    <img src="<?php echo esc_url($settings['about_logo_image']['url']); ?>" alt="<?php echo esc_attr($settings['about_logo_text']); ?>" />
                                </figure>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="txt-about wow fadeInUp">
                            <?php if (!empty($settings['about_text'])) : ?>
                                <p><?php echo esc_html($settings['about_text']); ?></p>
                            <?php endif; ?>
                            <?php if (!empty($settings['about_link_label'])) : ?>
                                <a href="<?php echo esc_url($settings['about_link_url']['url']); ?>" class="btn-site">
                                    <?php echo esc_html($settings['about_link_label']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    }
}
