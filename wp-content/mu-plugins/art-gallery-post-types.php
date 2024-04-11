<?php
function university_post_types()
{
  // Artwork Post Type
  register_post_type('artwork', array(
    'supports' => array('title', 'editor', 'excerpt', 'custom-fields', 'thumbnail'),
    'rewrite' => array('slug' => 'artworks'),
    'has_archive' => true,
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Artworks',
      'add_new_item' => 'Add New Artwork',
      'add_new' => 'Add New Artwork',
      'edit_item' => 'Edit Artwork',
      'all_items' => 'All Artworks',
      'singular_name' => 'Artwork'
    ),
    'menu_icon' => 'dashicons-art',
    'taxonomies' => array('post_tag', 'category'),
  ));

  // Category Post Type
  register_post_type('category', array(
    'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
    'rewrite' => array('slug' => 'categories'),
    'has_archive' => true,
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Categories',
      'add_new_item' => 'Add New Category',
      'add_new' => 'Add New Category',
      'edit_item' => 'Edit Category',
      'all_items' => 'All Categories',
      'singular_name' => 'Category'
    ),
    'menu_icon' => 'dashicons-category'
  ));

  // Medium Post Type
  register_post_type('medium', array(
    'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
    'rewrite' => array('slug' => 'mediums'),
    'has_archive' => true,
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Mediums',
      'add_new_item' => 'Add New Medium',
      'add_new' => 'Add New Medium',
      'edit_item' => 'Edit Medium',
      'all_items' => 'All Mediums',
      'singular_name' => 'Medium'
    ),
    'menu_icon' => 'dashicons-edit-large'
  ));

  // Location Post Type
  register_post_type('location', array(
    'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
    'rewrite' => array('slug' => 'locations'),
    'has_archive' => true,
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Locations',
      'add_new_item' => 'Add New Location',
      'add_new' => 'Add New Location',
      'edit_item' => 'Edit Location',
      'all_items' => 'All Locations',
      'singular_name' => 'Location'
    ),
    'menu_icon' => 'dashicons-location-alt'
  ));

  // Exhibition Post Type
  register_post_type('exhibition', array(
    'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
    'rewrite' => array('slug' => 'exhibitions'),
    'has_archive' => true,
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Exhibitions',
      'add_new_item' => 'Add New Exhibition',
      'add_new' => 'Add New Exhibition',
      'edit_item' => 'Edit Exhibition',
      'all_items' => 'All Exhibitions',
      'singular_name' => 'Exhibition'
    ),
    'menu_icon' => 'dashicons-calendar-alt'
  ));

  // Event Post Type
  register_post_type('event', array(
    'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
    'rewrite' => array('slug' => 'events'),
    'has_archive' => true,
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Events',
      'add_new_item' => 'Add New Event',
      'add_new' => 'Add New Event',
      'edit_item' => 'Edit Event',
      'all_items' => 'All Events',
      'singular_name' => 'Event'
    ),
    'menu_icon' => 'dashicons-calendar'
  ));

  // Program Post Type
  register_post_type('program', array(
    // remove default content field, replaced with ACF main_body_content (WYSIWYG) 
    'supports' => array('title'),
    'rewrite' => array('slug' => 'programs'),
    'has_archive' => true,
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Programs',
      'add_new_item' => 'Add New Program',
      'add_new' => 'Add New Program',
      'edit_item' => 'Edit Program',
      'all_items' => 'All Programs',
      'singular_name' => 'Program'
    ),
    'menu_icon' => 'dashicons-awards'
  ));

  // Artist Post Type
  register_post_type('artist', array(
    'show_in_rest' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'public' => true,
    'show_in_rest' => true,
    'labels' => array(
      'name' => 'Artists',
      'add_new_item' => 'Add New Artist',
      'add_new' => 'Add New Artist',
      'edit_item' => 'Edit Artist',
      'all_items' => 'All Artists',
      'singular_name' => 'Artist'
    ),
    'menu_icon' => 'dashicons-id'
  ));

  // Homepage Slideshow Post Type
  register_post_type('slideshow', array(
    'supports' => array('custom fields', 'thumbnail'),
    // 'capability_type' => 'slideshow',
    // 'map_meta_cap' => true,
    'public' => true, // not publicly visible
    'show_ui' => true, // to be visible in the admin panel
    'labels' => array(
      'name' => 'Homepage Slideshow',
      'add_new_item' => 'Add New Slide',
      'add_new' => 'Add New Slide',
      'edit_item' => 'Edit Slide',
      'all_items' => 'All Slides',
      'singular_name' => 'Slide'
    ),
    'menu_icon' => 'dashicons-images-alt'
  ));
}

add_action('init', 'university_post_types');
