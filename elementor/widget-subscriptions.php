<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class ALQA_SIGNALS_Plans_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'alqa_signals_plans';
    }

    public function get_title()
    {
        return __('Subscription Plans Section', 'alqa_signals');
    }

    public function get_icon()
    {
        return 'eicon-price-table';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {
        // === Section Title ===
        $this->start_controls_section(
            'section_plans_header',
            [
                'label' => __('Section Header', 'alqa_signals'),
            ]
        );

        $this->add_control(
            'plans_section_title',
            [
                'label' => __('Section Title', 'alqa_signals'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Subscription <span>Plans</span>', 'alqa_signals'),
            ]
        );

        $this->end_controls_section();

        // === Plans Content ===
        $this->start_controls_section(
            'section_plans_content',
            [
                'label' => __('Plans', 'alqa_signals'),
            ]
        );

        $this->add_control(
            'plans',
            [
                'label' => __('Plans', 'alqa_signals'),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => [
                    [
                        'name' => 'is_special_plan',
                        'label' => __('Most Popular', 'alqa_signals'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('Yes', 'alqa_signals'),
                        'label_off' => __('No', 'alqa_signals'),
                        'return_value' => 'yes',
                        'default' => 'no',
                    ],
                    [
                        'name' => 'plan_title',
                        'label' => __('Plan Title', 'alqa_signals'),
                        'type' => Controls_Manager::TEXT,
                        'default' => __('Awareness & Development', 'alqa_signals'),
                    ],
                    [
                        'name' => 'plan_features',
                        'label' => __('Plan Features', 'alqa_signals'),
                        'type' => Controls_Manager::REPEATER,
                        'prevent_empty' => false,
                        'fields' => [
                            [
                                'name' => 'feature_text',
                                'label' => __('Feature', 'alqa_signals'),
                                'type' => Controls_Manager::TEXT,
                                'default' => __('Feature description', 'alqa_signals'),
                            ],
                        ],
                        'default' => [
                            ['feature_text' => 'Feature 1'],
                            ['feature_text' => 'Feature 2'],
                        ],
                        'title_field' => '{{{ feature_text }}}',
                    ],
                    [
                        'name' => 'is_special_cta',
                        'label' => __('Special CTA Button Style', 'alqa_signals'),
                        'type' => Controls_Manager::SWITCHER,
                        'label_on' => __('Special', 'alqa_signals'),
                        'label_off' => __('Default', 'alqa_signals'),
                        'return_value' => 'yes',
                        'default' => 'no',
                    ],
                    [
                        'name' => 'cta_label',
                        'label' => __('CTA Label', 'alqa_signals'),
                        'type' => Controls_Manager::TEXT,
                        'default' => __('Start Learning', 'alqa_signals'),
                    ],
                    [
                        'name' => 'cta_link',
                        'label' => __('CTA Link', 'alqa_signals'),
                        'type' => Controls_Manager::URL,
                        'placeholder' => __('https://your-link.com', 'alqa_signals'),
                        'default' => [
                            'url' => '#',
                        ],
                    ],
                ],
                'default' => [
                    [
                        'plan_title' => 'Awareness & Development',
                        'plan_features' => [
                            ['feature_text' => 'Visual learning (motion graphics)'],
                            ['feature_text' => 'No exclusive reports'],
                        ],
                        'cta_label' => 'Start Learning',
                        'cta_link' => ['url' => '#'],
                    ],
                    [
                        'is_special_plan' => 'yes',
                        'plan_title' => 'Market Studies & Awareness',
                        'plan_features' => [
                            ['feature_text' => 'Includes Plan 1 content'],
                            ['feature_text' => 'Market reports, scenarios, data insights'],
                            ['feature_text' => 'Monthly sector/strategy reports.'],
                        ],
                        'cta_label' => 'Unlock Full Access',
                        'cta_link' => ['url' => '#'],
                        'is_special_cta' => 'no',
                    ],
                    [
                        'plan_title' => 'Institutional Plan',
                        'plan_features' => [
                            ['feature_text' => 'For firms, funds, strategic offices.'],
                            ['feature_text' => 'Custom access, integration, account management'],
                        ],
                        'cta_label' => 'Contact Us',
                        'cta_link' => ['url' => '#'],
                    ],
                ],
                'title_field' => '{{{ plan_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>

        <section class="section_plans">
            <div class="container">
                <div class="sec_head text-center wow fadeInUp">
                    <h2><?php echo wp_kses_post($settings['plans_section_title']); ?></h2>
                </div>
                <div class="row justify-content-center">
                    <?php foreach ($settings['plans'] as $plan) : ?>
                        <?php
                        $is_special = ($plan['is_special_plan'] === 'yes');
                        $cta_class = ($plan['is_special_cta'] === 'yes') ? 'btn-special' : 'btn-site';
                        ?>
                        <div class="col-lg-3">
                            <div class="item-plan wow fadeInUp <?php echo $is_special ? 'plan-awareness' : ''; ?>">
                                <div class="name-plan">
                                    <h4><?php echo esc_html($plan['plan_title']); ?></h4>
                                    <?php if ($is_special) : ?>
                                        <span><?php echo esc_html__('MOST POPULAR', 'alqa_signals'); ?></span>
                                    <?php endif; ?>
                                </div>

                                <ul class="feat-plan">
                                    <?php foreach ($plan['plan_features'] as $feature) : ?>
                                        <li>
                                            <p><?php echo esc_html($feature['feature_text']); ?></p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                                <div class="btn-plan">
                                    <a href="<?php echo esc_url($plan['cta_link']['url']); ?>"
                                        class="<?php echo esc_attr($cta_class); ?>">
                                        <?php echo esc_html($plan['cta_label']); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

<?php
    }
}
