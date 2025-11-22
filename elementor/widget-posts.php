<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_Query;

class ALQA_SIGNALS_Posts_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'alqa_signals_posts';
    }

    public function get_title()
    {
        return __('Posts Section', 'alqa-signals');
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

        // === SECTION HEAD ===
        $this->start_controls_section(
            'section_header',
            [
                'label' => __('Section Header', 'alqa-signals'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Section Title', 'alqa-signals'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Latest Insights', 'alqa-signals'),
            ]
        );

        $this->add_control(
            'is_special',
            [
                'label' => __('Special CTA Style', 'alqa-signals'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'alqa-signals'),
                'label_off' => __('No', 'alqa-signals'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'cta_label',
            [
                'label' => __('CTA Label', 'alqa-signals'),
                'type' => Controls_Manager::TEXT,
                'default' => __('View All Posts', 'alqa-signals'),
            ]
        );

        $this->add_control(
            'cta_link',
            [
                'label' => __('CTA Link', 'alqa-signals'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'alqa-signals'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->end_controls_section();


        // === QUERY SETTINGS ===
        $this->start_controls_section(
            'section_query',
            [
                'label' => __('Query Settings', 'alqa-signals'),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Number of Posts', 'alqa-signals'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'max' => 12,
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', 'alqa-signals'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'DESC' => __('Descending', 'alqa-signals'),
                    'ASC' => __('Ascending', 'alqa-signals'),
                ],
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'alqa-signals'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'date' => __('Date', 'alqa-signals'),
                    'title' => __('Title', 'alqa-signals'),
                    'rand' => __('Random', 'alqa-signals'),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'category_filter',
            [
                'label' => __('Category Slug (Optional)', 'alqa-signals'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('example: news, research', 'alqa-signals'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $cta_class = (isset($settings['is_special']) && $settings['is_special'] === 'yes') ? 'btn-special' : '';

        // WP Query Setup
        $args = [
            'post_type' => 'post',
            'posts_per_page' => !empty($settings['posts_per_page']) ? (int)$settings['posts_per_page'] : 3,
            'order' => $settings['order'],
            'orderby' => $settings['orderby'],
        ];

        if (!empty($settings['category_filter'])) {
            $args['category_name'] = sanitize_text_field($settings['category_filter']);
        }

        $query = new WP_Query($args);
?>

        <section class="section_blogs">
            <div class="container">
                <div class="sec_head wow fadeInUp">
                    <?php if (!empty($settings['title'])) : ?>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($settings['cta_label']) && !empty($settings['cta_link']['url'])) :
                        $cta_url = esc_url($settings['cta_link']['url']);
                        $cta_target = (!empty($settings['cta_link']['is_external'])) ? ' target="_blank"' : '';
                        $cta_rel = (!empty($settings['cta_link']['nofollow'])) ? ' rel="nofollow"' : '';
                    ?>
                        <a href="<?php echo $cta_url; ?>" class="<?php echo esc_attr($cta_class); ?>" <?php echo $cta_target . $cta_rel; ?>>
                            <?php echo esc_html($settings['cta_label']); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <?php if ($query->have_posts()) : ?>
                    <div class="row">
                        <?php while ($query->have_posts()) : $query->the_post();
                            $post_id = get_the_ID();
                            $title = get_the_title();
                            $link = get_permalink();
                            $category_obj = get_the_category($post_id);
                            $category = !empty($category_obj) ? $category_obj[0]->name : '';
                            $image_url = get_the_post_thumbnail_url($post_id, 'large');
                        ?>
                            <div class="col-lg-4">
                                <div class="item-blog wow fadeInUp">
                                    <?php if ($image_url) : ?>
                                        <figure>
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" />
                                        </figure>
                                    <?php endif; ?>

                                    <div class="txt-blog">
                                        <?php if ($category) : ?>
                                            <span><?php echo esc_html($category); ?></span>
                                        <?php endif; ?>

                                        <?php if ($title) : ?>
                                            <h5><?php echo esc_html($title); ?></h5>
                                        <?php endif; ?>

                                        <?php if ($link) : ?>
                                            <a href="<?php echo esc_url($link); ?>" class="btn-view-blog">
                                                <i class="fa-solid fa-arrow-up"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    </div>
                <?php else : ?>
                    <p><?php esc_html_e('No posts found.', 'alqa-signals'); ?></p>
                <?php endif; ?>
            </div>
        </section>

<?php
    }
}
