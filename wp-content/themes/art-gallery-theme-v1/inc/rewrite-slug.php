<?php
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
