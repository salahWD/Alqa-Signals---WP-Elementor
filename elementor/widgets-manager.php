<?php
function register_new_widgets($widgets_manager)
{

    // Require the widget files
    require_once(__DIR__ . '/widget-header.php');
    require_once(__DIR__ . '/widget-about.php');
    require_once(__DIR__ . '/widget-home-hero.php');
    require_once(__DIR__ . '/widget-awareness.php');
    require_once(__DIR__ . '/widget-methodology.php');
    require_once(__DIR__ . '/widget-systematic.php');
    require_once(__DIR__ . '/widget-research.php');
    require_once(__DIR__ . '/widget-subscriptions.php');
    require_once(__DIR__ . '/widget-blogs.php');
    require_once(__DIR__ . '/widget-contact.php');
    require_once(__DIR__ . '/widget-posts.php');
    require_once(__DIR__ . '/widget-footer.php');

    // Register the widgets
    $widgets_manager->register(new \ALQA_SIGNALS_Header_Widget());
    $widgets_manager->register(new \ALQA_SIGNALS_Home_Hero_Widget());
    $widgets_manager->register(new \ALQA_SIGNALS_About_Widget());
    $widgets_manager->register(new \ALQA_SIGNALS_Awareness_Widget());
    $widgets_manager->register(new \ALQA_SIGNALS_Methodology_Widget());
    $widgets_manager->register(new \ALQA_SIGNALS_Systematic_Widget());
    $widgets_manager->register(new \ALQA_SIGNALS_Research_Widget());
    $widgets_manager->register(new \ALQA_SIGNALS_Plans_Widget());
    $widgets_manager->register(new \ALQA_SIGNALS_Blogs_Widget());
    $widgets_manager->register(new \ALQA_SIGNALS_Contact_Widget());
    $widgets_manager->register(new \ALQA_SIGNALS_Footer_Widget());
    $widgets_manager->register(new \ALQA_SIGNALS_Posts_Widget());
}
add_action('elementor/widgets/register', 'register_new_widgets');
