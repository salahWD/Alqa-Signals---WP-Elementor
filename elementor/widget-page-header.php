<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

class ALQA_SIGNALS_Header_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'alqa_signals_page_header';
    }

    public function get_title()
    {
        return __('Page Header', 'alqa_signals');
    }

    public function get_icon()
    {
        return 'eicon-header';
    }

    public function get_categories()
    {
        return ['general'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_hero',
            [
                'label' => __('Hero Section Content', 'alqa_signals'),
            ]
        );

        // Background Image Control
        $this->add_control(
            'hero_background_image',
            [
                'label' => __('Background Image', 'alqa_signals'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'hero_heading',
            [
                'label' => __('Hero Title', 'alqa_signals'),
                'type' => Controls_Manager::TEXT,
                "placeholder" => __('Type your title here', 'alqa_signals'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        global $post;
        $settings = $this->get_settings_for_display();

        $base_url = preg_replace('|/en/?$|', '', site_url()); // Ensure base URL without "/en"
        $current_url = home_url($_SERVER['REQUEST_URI']);

        $is_english = strpos($current_url, '/en/') !== false || substr($current_url, -3) === '/en';

        if (isset($_GET['debug'])) {
            echo "\n\n";
            echo 'Base URL: ' . $base_url;
            echo "\n\n";
            echo 'Current URL: ' . $current_url;
            echo "\n\n";
            echo 'Is English: ' . ($is_english ? 'Yes' : 'No');
            echo "\n\n";
            exit;
        }

        $switch_url = $is_english ? $base_url . '/?lang=ar' : $base_url . '/?lang=en';
        $switch_label = $is_english ? 'العربية' : 'English';

?>


        <section class="section_home section_hero_page" style="background: url(<?php echo esc_url($settings['hero_background_image']['url']); ?>)">
            <div class="container">
                <div class="home_txt wow fadeInUp">
                    <h1><?php echo esc_html($settings['hero_heading']); ?></h1>
                </div>
            </div>
        </section>

<?php
    }
}
