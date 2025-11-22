<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

class ALQA_SIGNALS_Blogs_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'alqa_signals_blogs';
    }

    public function get_title()
    {
        return __('Home Blogs Section', 'alqa-signals');
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

        // Section: Heading + CTA
        $this->start_controls_section(
            'section_heading',
            [
                'label' => __('Section Heading', 'alqa-signals'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Title', 'alqa-signals'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Our Blogs', 'alqa-signals'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'cta_label',
            [
                'label'       => __('CTA Label', 'alqa-signals'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Read All Blogs', 'alqa-signals'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'cta_link',
            [
                'label'       => __('CTA Link', 'alqa-signals'),
                'type'        => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'alqa-signals'),
                'show_external' => true,
                'default'     => [
                    'url'         => '#',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $this->add_control(
            'is_special',
            [
                'label'        => __('Special CTA Style', 'alqa-signals'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'alqa-signals'),
                'label_off'    => __('No', 'alqa-signals'),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );

        $this->end_controls_section();

        // Section: Blog Items (repeater)
        $this->start_controls_section(
            'section_blogs',
            [
                'label' => __('Blog Items', 'alqa-signals'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'wp_posts',
            [
                'label'        => __('Display Wordpress Posts', 'alqa-signals'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('posts', 'alqa-signals'),
                'label_off'    => __('Static', 'alqa-signals'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'blog_image',
            [
                'label'   => __('Image', 'alqa-signals'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'blog_category',
            [
                'label'       => __('Category Title', 'alqa-signals'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Category', 'alqa-signals'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'blog_title',
            [
                'label'       => __('Blog Title', 'alqa-signals'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Blog Title Here', 'alqa-signals'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'blog_link',
            [
                'label'       => __('Blog Link', 'alqa-signals'),
                'type'        => Controls_Manager::URL,
                'placeholder' => __('https://your-blog-link.com', 'alqa-signals'),
                'show_external' => true,
                'default'     => [
                    'url'         => '#',
                    'is_external' => false,
                    'nofollow'    => false,
                ],
            ]
        );

        $this->add_control(
            'blogs_list',
            [
                'label'       => __('Blogs', 'alqa-signals'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ blog_title }}}',
                'default'     => [
                    [
                        'blog_category' => __('Investing', 'alqa-signals'),
                        'blog_title'    => __('5 Key Financial Metrics Every Investor Should Know', 'alqa-signals'),
                        'blog_link'     => ['url' => '#'],
                    ],
                    [
                        'blog_category' => __('Finance', 'alqa-signals'),
                        'blog_title'    => __('A Beginner’s Guide to Risk Management in Investing', 'alqa-signals'),
                        'blog_link'     => ['url' => '#'],
                    ],
                    [
                        'blog_category' => __('Tax', 'alqa-signals'),
                        'blog_title'    => __('How to Build a Tax-Efficient Investment Portfolio', 'alqa-signals'),
                        'blog_link'     => ['url' => '#'],
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $cta_class = (isset($settings['is_special']) && $settings['is_special'] === 'yes') ? 'btn-special' : '';

        $query = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 6,
            'orderby' => "date",
        ])
?>
        <section class="section_blogs">
            <div class="container">
                <div class="sec_head wow fadeInUp">
                    <?php if (! empty($settings['title'])): ?>
                        <h2><?php echo esc_html($settings['title']); ?></h2>
                    <?php endif; ?>

                    <?php
                    if (! empty($settings['cta_label']) && ! empty($settings['cta_link']['url'])):
                        $cta_url = esc_url($settings['cta_link']['url']);
                        $cta_target = (! empty($settings['cta_link']['is_external'])) ? ' target="_blank"' : '';
                        $cta_rel = (! empty($settings['cta_link']['nofollow'])) ? ' rel="nofollow"' : '';
                    ?>
                        <a href="<?php echo $cta_url; ?>" class="<?php echo esc_attr($cta_class); ?>" <?php echo $cta_target . $cta_rel; ?>>
                            <?php echo esc_html($settings['cta_label']); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <?php if (isset($settings["wp_posts"]) && !empty($settings["wp_posts"]) && $settings["wp_posts"] = "yes"): ?>

                    <?php if ($query->have_posts()): ?>
                        <div class="row" style="position: relative;z-index: 10;">
                            <?php while ($query->have_posts()): $query->the_post();
                                $post_id = get_the_ID();
                                $title = get_the_title();
                                $link = get_permalink();
                                $category_obj = get_the_category($post_id);
                                $category = !empty($category_obj) ? $category_obj[0]->name : '';
                                $image_url = get_the_post_thumbnail_url($post_id, 'large');
                            ?>
                                <div class="col-lg-4">
                                    <div class="item-blog wow fadeInUp">
                                        <?php if ($image_url): ?>
                                            <figure>
                                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" />
                                            </figure>
                                        <?php endif; ?>

                                        <div class="txt-blog">
                                            <?php if ($category): ?>
                                                <span><?php echo esc_html($category); ?></span>
                                            <?php endif; ?>

                                            <?php if ($title): ?>
                                                <h5><?php echo esc_html($title); ?></h5>
                                            <?php endif; ?>

                                            <?php if ($link): ?>
                                                <a href="<?php echo esc_url($link); ?>" target="_blank" rel="nofollow" class="btn-view-blog">
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
                <?php else: ?>
                    <?php if (!empty($settings['blogs_list']) && is_array($settings['blogs_list'])): ?>
                        <div class="row" style="position: relative;z-index: 10;">
                            <?php foreach ($settings['blogs_list'] as $item):

                                $image_url = (! empty($item['blog_image']) && ! empty($item['blog_image']['url'])) ? $item['blog_image']['url'] : '';
                                $category  = (! empty($item['blog_category'])) ? $item['blog_category'] : '';
                                $title     = (! empty($item['blog_title'])) ? $item['blog_title'] : '';
                                $link      = (! empty($item['blog_link']) && ! empty($item['blog_link']['url'])) ? $item['blog_link']['url'] : '';
                                $is_ext    = (! empty($item['blog_link']['is_external']));
                                $nofollow  = (! empty($item['blog_link']['nofollow']));
                            ?>
                                <div class="col-lg-4">
                                    <div class="item-blog wow fadeInUp">
                                        <?php if ($image_url): ?>
                                            <figure>
                                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" />
                                            </figure>
                                        <?php endif; ?>

                                        <div class="txt-blog">
                                            <?php if ($category): ?>
                                                <span><?php echo esc_html($category); ?></span>
                                            <?php endif; ?>

                                            <?php if ($title): ?>
                                                <h5><?php echo esc_html($title); ?></h5>
                                            <?php endif; ?>

                                            <?php if ($link):
                                                $link_target = $is_ext ? ' target="_blank"' : '';
                                                $link_rel    = $nofollow ? ' rel="nofollow"' : '';
                                            ?>
                                                <a href="<?php echo esc_url($link); ?>" class="btn-view-blog" <?php echo $link_target . $link_rel; ?>>
                                                    <i class="fa-solid fa-arrow-up"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </section>
<?php
    }
}
