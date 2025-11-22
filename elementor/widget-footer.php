<?php

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;

class ALQA_SIGNALS_Footer_Widget extends Widget_Base
{

	public function get_name()
	{
		return 'alqa_signals_footer';
	}

	public function get_title()
	{
		return __('Footer Section', 'alqa-signals');
	}

	public function get_icon()
	{
		return 'eicon-footer';
	}

	public function get_categories()
	{
		return ['general'];
	}

	protected function _register_controls()
	{

		// === LOGO & COPYRIGHT ===
		$this->start_controls_section(
			'section_logo_copyright',
			[
				'label' => __('Logo & Copyright', 'alqa-signals'),
			]
		);

		$this->add_control(
			'footer_logo',
			[
				'label' => __('Footer Logo', 'alqa-signals'),
				'type'  => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'copyright_text',
			[
				'label'   => __('Copyright Text', 'alqa-signals'),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __('2025 ALQA-Signals. All rights reserved.', 'alqa-signals'),
			]
		);

		$this->add_control(
			'copyright_link',
			[
				'label'       => __('Brand Link', 'alqa-signals'),
				'type'        => Controls_Manager::URL,
				'placeholder' => __('https://your-link.com', 'alqa-signals'),
				'default'     => [
					'url' => '#',
					'is_external' => false,
					'nofollow' => false,
				],
			]
		);

		$this->end_controls_section();

		// === FOOTER MENUS ===
		$this->start_controls_section(
			'section_footer_menus',
			[
				'label' => __('Footer Menus', 'alqa-signals'),
			]
		);

		$menu_repeater = new Repeater();

		$menu_repeater->add_control(
			'menu_title',
			[
				'label' => __('Menu Title', 'alqa-signals'),
				'type'  => Controls_Manager::TEXT,
				'default' => __('Menu Title', 'alqa-signals'),
				'label_block' => true,
			]
		);

		$menu_repeater->add_control(
			'menu_items',
			[
				'label' => __('Menu Links', 'alqa-signals'),
				'type'  => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'item_label',
						'label' => __('Link Text', 'alqa-signals'),
						'type' => Controls_Manager::TEXT,
						'default' => __('Menu Item', 'alqa-signals'),
						'label_block' => true,
					],
					[
						'name' => 'item_url',
						'label' => __('Link URL', 'alqa-signals'),
						'type' => Controls_Manager::URL,
						'placeholder' => __('https://your-link.com', 'alqa-signals'),
						'default' => [
							'url' => '#',
						],
					],
				],
				'title_field' => '{{{ item_label }}}',
			]
		);

		$this->add_control(
			'footer_menus',
			[
				'label' => __('Footer Columns', 'alqa-signals'),
				'type'  => Controls_Manager::REPEATER,
				'fields' => $menu_repeater->get_controls(),
				'default' => [
					[
						'menu_title' => __('General Inquiry', 'alqa-signals'),
					],
					[
						'menu_title' => __('Institutional Access', 'alqa-signals'),
					],
					[
						'menu_title' => __('Media & Partnerships', 'alqa-signals'),
					],
				],
				'title_field' => '{{{ menu_title }}}',
			]
		);

		$this->end_controls_section();

		// === SOCIAL LINKS ===
		$this->start_controls_section(
			'section_social_links',
			[
				'label' => __('Social Media', 'alqa-signals'),
			]
		);

		$social_repeater = new Repeater();

		$social_repeater->add_control(
			'social_icon_class',
			[
				'label' => __('Icon Class (Font Awesome)', 'alqa-signals'),
				'type'  => Controls_Manager::TEXT,
				'default' => 'fa-brands fa-facebook',
			]
		);

		$social_repeater->add_control(
			'social_link',
			[
				'label' => __('Social Link', 'alqa-signals'),
				'type'  => Controls_Manager::URL,
				'placeholder' => __('https://facebook.com', 'alqa-signals'),
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'social_links',
			[
				'label' => __('Social Media Links', 'alqa-signals'),
				'type'  => Controls_Manager::REPEATER,
				'fields' => $social_repeater->get_controls(),
				'title_field' => '{{{ social_icon_class }}}',
				'default' => [
					['social_icon_class' => 'fa-brands fa-facebook'],
					['social_icon_class' => 'fa-brands fa-instagram'],
					['social_icon_class' => 'fa-brands fa-linkedin-in'],
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
?>
		<footer id="footer">
			<div class="container">
				<div class="row">

					<!-- Logo + Copyright -->
					<div class="col-lg-3">
						<div class="cont-ft wow fadeInUp">
							<?php if (! empty($settings['footer_logo']['url'])) : ?>
								<figure class="logo-ft wow fadeInUp">
									<img src="<?php echo esc_url($settings['footer_logo']['url']); ?>" alt="Footer Logo" class="img-fluid" />
								</figure>
							<?php endif; ?>

							<?php if (! empty($settings['copyright_text'])) : ?>
								<p class="copyRight">
									<?php echo esc_html(date('Y')); ?>
									<?php if (! empty($settings['copyright_link']['url'])) : ?>
										<a href="<?php echo esc_url($settings['copyright_link']['url']); ?>"
											<?php echo $settings['copyright_link']['is_external'] ? 'target="_blank"' : ''; ?>
											<?php echo $settings['copyright_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
											ALQA-Signals
										</a>.
									<?php endif; ?>
									<?php echo esc_html__('All rights reserved.', 'alqa-signals'); ?>
								</p>
							<?php endif; ?>
						</div>
					</div>

					<!-- Footer Menus -->
					<?php if (! empty($settings['footer_menus'])) : ?>
						<?php foreach ($settings['footer_menus'] as $menu) : ?>
							<div class="col-lg-3 col-6">
								<div class="menu-ft wow fadeInUp">
									<?php if (! empty($menu['menu_title'])) : ?>
										<h5><?php echo esc_html($menu['menu_title']); ?></h5>
									<?php endif; ?>

									<?php if (! empty($menu['menu_items'])) : ?>
										<ul class="li-ft">
											<?php foreach ($menu['menu_items'] as $item) : ?>
												<li>
													<a href="<?php echo esc_url($item['item_url']['url']); ?>">
														<?php echo esc_html($item['item_label']); ?>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>

									<?php if ($menu === end($settings['footer_menus']) && ! empty($settings['social_links'])) : ?>
										<ul class="social-media">
											<?php foreach ($settings['social_links'] as $social) : ?>
												<li>
													<a href="<?php echo esc_url($social['social_link']['url']); ?>" target="_blank">
														<i class="<?php echo esc_attr($social['social_icon_class']); ?>"></i>
													</a>
												</li>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>

				</div>
			</div>
		</footer>
<?php
	}
}
