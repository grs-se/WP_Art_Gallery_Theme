<?php

function gallery_files()
{
	wp_enqueue_script('main-gallery-javascript', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
	wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('gallery_main_styles', get_theme_file_uri('/build/style-index.css'));
	wp_enqueue_style('gallery_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_action('wp_enqueue_scripts', 'gallery_files');

function gallery_features()
{
	// register_nav_menu('headerMenuLocation', 'Header Menu Location');
	// register_nav_menu('footerLocation1', 'Footer Location 1');
	// register_nav_menu('footerLocation2', 'Footer Location 2');
	add_theme_support('title-tag');
}

add_action('after_setup_theme', 'gallery_features');

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

function gallery_adjust_queries($query)
{
	if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
		$today = date('Ymd');

		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array(
			array(
				'key' => 'event_date',
				'compare' => '>=',
				'value' => $today,
				'type' => 'numeric'
			)
		));
	}
}

add_action('pre_get_posts', 'gallery_adjust_queries');
