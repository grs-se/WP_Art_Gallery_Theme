<?php

require get_theme_file_path('/inc/search-route.php');
require get_theme_file_path('/inc/hero-slider.php');
require get_theme_file_path('/inc/spotlight-slider.php');
// require get_theme_file_path('/inc/rewrite-slug.php');

add_action('init', 'my_website_add_rewrite_tag');

function my_website_add_rewrite_tag()
{
	// defines the rewrite structure for 'chapters', needs to go first because the structure is longer
	// says that if the URL matches this rule, then it should display the 'chapters' post whose post name matches the last slug set
	add_rewrite_rule('^artworks/([^/]*)/([^/]*)/([^/]*)/?', 'index.php?category=$matches[3]', 'top');
	// defines the rewrite structure for 'books'
	// says that if the URL matches this rule, then it should display the 'books' post whose post name matches the last slug set
	add_rewrite_rule('^artworks/([^/]*)/([^/]*)/?', 'index.php?medium=$matches[2]', 'top');
}

// this filter runs whenever WordPress requests a post permalink, i.e. get_permalink(), etc.
// we will return our custom permalink for 'books' and 'chapters'. 'authors' is already good to go since we defined its rewrite slug in the CPT definition.
add_filter('post_type_link', 'my_website_filter_post_type_link', 1, 4);
function my_website_filter_post_type_link($post_link, $post, $leavename, $sample)
{
	switch ($post->post_type) {

		case 'medium':

			// I spoke with Dalton and he is using the CPT-onomies plugin to relate his custom post types so for this example, we are retrieving CPT-onomy information. this code can obviously be tweaked with whatever it takes to retrieve the desired information.
			// we need to find the author the book belongs to. using array_shift() makes sure only one author is allowed
			if ($artwork = array_shift(wp_get_object_terms($post->ID, 'artworks'))) {
				if (isset($artwork->slug)) {
					// create the new permalink
					$post_link = home_url(user_trailingslashit('artworks/' . $artwork->slug . '/' . $post->post_name));
				}
			}

			break;

		case 'category':

			// I spoke with Dalton and he is using the CPT-onomies plugin to relate his custom post types so for this example, we are retrieving CPT-onomy information. this code can obviously be tweaked with whatever it takes to retrieve the desired information.
			// we need to find the book it belongs to. using array_shift() makes sure only one book is allowed
			if ($book = array_shift(wp_get_object_terms($post->ID, 'category'))) {

				// now to find the author the book belongs to. using array_shift() makes sure only one author is allowed
				$artwork = array_shift(wp_get_object_terms($book->term_id, 'artworks'));

				if (isset($book->slug) && $artwork && isset($artwork->slug)) {
					// create the new permalink
					$post_link = home_url(user_trailingslashit('artworks/' . $artwork->slug . '/' . $book->slug . '/' . $post->post_name));
				}
			}

			break;
	}
	return $post_link;
}


function gallery_custom_rest()
{
	register_rest_field('post', 'authorName', array(
		'get_callback' => function () {
			return get_the_author();
		}
	));

	// register_rest_field('post', 'perfectlyCroppedImageUrl', array(
	//	'get_callback' => function() {return}
	// ));
}

add_action('rest_api_init', 'gallery_custom_rest');

function get_breadcrumb()
{
	echo '<a href="' . home_url() . '" rel="nofollow">Home</a>';

	if (is_archive()) {
		// echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
		the_archive_title();
	}
	if (is_category() || is_single()) {
		echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
		the_category(' &bull; ');
		if (is_single()) {
			echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
			the_title();
		}
	} elseif (is_page()) {
		echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
		echo the_title();
	} elseif (is_search()) {
		echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
		echo '"<em>';
		echo the_search_query();
		echo '</em>"';
	}
}

function pageBanner($args = NULL)
{
	// if (!$args['show_banner']) $args['show_banner'] = true;

	// if (isset($args['show_banner'])) {
	if (!isset($args['title'])) {
		$args['title'] = get_the_title();
	}

	if (!isset($args['show_breadcrumbs'])) {
		$args['show_breadcrumbs'] = false;
		print_r(get_breadcrumb());
	}

	if (!isset($args['subtitle'])) {
		$args['subtitle'] = get_field('page_banner_subtitle');
	}

	if (!isset($args['photo'])) {
		if (get_field('page_banner_background_image') and !is_archive() and !is_home()) {
			$args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
		} else {
			$args['photo'] = get_theme_file_uri('/images/slideshow-crop-still-life.jpg');
		}
	}

?>
	<div class="page-banner">
		<div class="page-banner__bg-image" style="background: linear-gradient(90deg, rgba(0,0,0,0.90) 0%, rgba(0,0,0,0.10) 100%), url(<?php echo $args['photo']; ?>) center center/cover no-repeat;">
			></div>
		<!-- <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>)"></div> -->
		<div class="page-banner__content container <?php if (!is_archive()) echo 'container--narrow'; ?>">
			<div class="page-banner__breadcrumbs">
				<?php if ($args['show_breadcrumbs']) { ?>
					<a href=""><?php echo get_breadcrumb(); ?>;</a>
				<?php } ?>
			</div>
			<h1 class="page-banner__title">
				<?php echo $args['title'] ?>
			</h1>
			<div class="page-banner__intro">
				<p><?php echo $args['subtitle']; ?></p>
			</div>
		</div>
	</div>
<?php

}

function gallery_files()
{
	wp_enqueue_script('google-map', '//maps.googleapis.com/maps/api/js?key=' . GOOGLE_MAPS_API, NULL, '1.0', true);
	wp_enqueue_script('main-gallery-javascript', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
	wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
	wp_enqueue_style('gallery_main_styles', get_theme_file_uri('/build/style-index.css'));
	wp_enqueue_style('gallery_extra_styles', get_theme_file_uri('/build/index.css'));

	wp_localize_script('main-gallery-javascript', 'galleryData', array(
		'root_url' => get_site_url(),
		'sky' => 'blue',
		'grass' => 'green'
	));
}

add_action('wp_enqueue_scripts', 'gallery_files');

function gallery_features()
{
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	// args: nickname, width, height, crop (default cropped to center)
	add_image_size('artworkGalleryCard', 250, 250, false);
	add_image_size('artworkLandscape', 400, 260, true);
	add_image_size('artworkPortrait', 480, 650, true);
	// add_image_size('singleItemPage', 900, 900, true);
	add_image_size('pageBanner', 1500, 350, true);
	add_image_size('slideshowImage', 1900, 525, true);
}

add_action('after_setup_theme', 'gallery_features');

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

function gallery_adjust_queries($query)
{
	if (!is_admin() and is_post_type_archive('artwork') and $query->is_main_query()) {
		$query->set('post_per_page', -1);
	}

	if (!is_admin() and is_post_type_archive('campus') and $query->is_main_query()) {
		$query->set('post_per_page', -1);
	}

	if (!is_admin() and is_post_type_archive('program') and $query->is_main_query()) {
		$query->set('orderby', 'title');
		$query->set('order', 'ASC');
		$query->set('post_per_page', -1);
	}

	if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
		$today = date('Ymd');

		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array(
			array(
				'name' => 'event_date',
				'compare' => '>=',
				'value' => $today,
				'type' => 'numeric'
			)
		));
	}
}

add_action('pre_get_posts', 'gallery_adjust_queries');

function galleryMapKey($api)
{
	$api['key'] = GOOGLE_MAPS_API;
	return $api;
}

add_filter('acf/fields/google_map/api', 'galleryMapKey');
