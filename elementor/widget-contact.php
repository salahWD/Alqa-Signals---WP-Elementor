<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class ALQA_SIGNALS_Contact_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'alqa_signals_contact';
    }

    public function get_title()
    {
        return __('Contact Section', 'alqa-signals');
    }

    public function get_icon()
    {
        return 'eicon-mail';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_left_content',
            [
                'label' => __('Left Content', 'alqa-signals'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label'       => __('Subtitle', 'alqa-signals'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Let’s Connect', 'alqa-signals'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Main Title', 'alqa-signals'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Your Next Financial Step Starts Here', 'alqa-signals'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => __('Description', 'alqa-signals'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __('From investment planning and tax optimization to market insights backed by powerful analytics, our mission is to help you make informed, confident decisions about your money.', 'alqa-signals'),
                'rows'        => 4,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_form',
            [
                'label' => __('Contact Form', 'alqa-signals'),
            ]
        );

        $this->add_control(
            'form_title',
            [
                'label'       => __('Form Title', 'alqa-signals'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Send us a Message', 'alqa-signals'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'form_shortcode',
            [
                'label'       => __('Contact Form Shortcode', 'alqa-signals'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => __('[contact-form-7 id="a34f80f" html_class="form-msg" title="Contact Us Form"]', 'alqa-signals'),
                'description' => __('Paste your Contact Form 7 shortcode here.', 'alqa-signals'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section class="section_contact">
            <div class="container">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="cont-contact wow fadeInUp">
                            <div class="sec_head">
                                <?php if (! empty($settings['subtitle'])) : ?>
                                    <div class="augmented">
                                        <span><?php echo esc_html($settings['subtitle']); ?></span>
                                    </div>
                                <?php endif; ?>

                                <?php if (! empty($settings['title'])) : ?>
                                    <h2><?php echo esc_html($settings['title']); ?></h2>
                                <?php endif; ?>

                                <?php if (! empty($settings['description'])) : ?>
                                    <p><?php echo esc_html($settings['description']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="cont-msg wow fadeInUp">
                            <?php if (! empty($settings['form_title'])) : ?>
                                <h5><?php echo esc_html($settings['form_title']); ?></h5>
                            <?php endif; ?>

                            <?php if (! empty($settings['form_shortcode'])) : ?>
                                <?php echo do_shortcode(wp_kses_post($settings['form_shortcode'])); ?>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </section>
<?php
    }
}
