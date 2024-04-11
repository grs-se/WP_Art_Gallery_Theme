<?php
get_header();
pageBanner(array(
  'show_banner' => true,
  'show_breadcrumbs' => true,
  'title' => 'All Artworks',
  'subtitle' => 'Archive 2012-2024'
));
?>

<!-- <div class="container container--narrow page-section">
  <div class="breadcrumb"><?php get_breadcrumb(); ?></div>
</div> -->
<!-- gallery-cards__container -->
<div class="container-wide page-section">
  <div class="gallery__toolbar">
    <a href="<?php echo esc_url(site_url('/search')); ?>" class="js-filters-toggle">
      <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg" class="">
        <path d="M0.4 3.67992H7V5.73992C7 5.95992 7.18 6.13992 7.4 6.13992C7.62 6.13992 7.8 5.95992 7.8 5.73992V3.67992H18.4C18.62 3.67992 18.8 3.49992 18.8 3.27992C18.8 3.05992 18.62 2.87992 18.4 2.87992H7.8V0.819922C7.8 0.599922 7.62 0.419922 7.4 0.419922C7.18 0.419922 7 0.599922 7 0.819922V2.87992H0.4C0.18 2.87992 0 3.05992 0 3.27992C0 3.49992 0.18 3.67992 0.4 3.67992Z" fill="#202020"></path>
        <path d="M18.4 8.59965H13.8V6.53965C13.8 6.31965 13.62 6.13965 13.4 6.13965C13.18 6.13965 13 6.31965 13 6.53965V8.59965H0.4C0.18 8.59965 0 8.77965 0 8.99965C0 9.21965 0.18 9.39965 0.4 9.39965H13V11.4596C13 11.6796 13.18 11.8596 13.4 11.8596C13.62 11.8596 13.8 11.6796 13.8 11.4596V9.39965H18.4C18.62 9.39965 18.8 9.21965 18.8 8.99965C18.8 8.77965 18.62 8.59965 18.4 8.59965Z" fill="#202020"></path>
        <path d="M18.4 14.3204H5.8V12.2604C5.8 12.0404 5.62 11.8604 5.4 11.8604C5.18 11.8604 5 12.0404 5 12.2604V14.3204H0.4C0.18 14.3204 0 14.5004 0 14.7204C0 14.9404 0.18 15.1204 0.4 15.1204H5V17.1804C5 17.4004 5.18 17.5804 5.4 17.5804C5.62 17.5804 5.8 17.4004 5.8 17.1804V15.1204H18.4C18.62 15.1204 18.8 14.9404 18.8 14.7204C18.8 14.5004 18.62 14.3204 18.4 14.3204Z" fill="#202020"></path>
      </svg>
      Filters
    </a>
  </div>

  <!-- Gallery Filters Menu -->
  <div class="gallery-filters-menu-overlay">
    <div class="gallery-filters-overlay__top">
      <div class="container">
        <i class="fa fa-window-close filters-overlay__close" aria-hidden="true"></i>
      </div>
    </div>

    <div class="container">
      <div id="gallery-filters-overlay__results">
        <h1>Filters</h1>
        <?php
        $relatedCategories = new WP_Query(array(
          'posts_per_page' => -1,
          'post_type' => 'category',
          'orderby' => 'title',
          'order' => 'ASC',
          // 'meta_query' => array(
          //   array(
          //     'key' => 'related_category',
          //     'compare' => 'LIKE',
          //     'value' => '"' . get_the_ID() . '"'
          //   )
          // )
        ));

        if ($relatedCategories->have_posts()) {
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">Categories</h2>';

          echo '<ul class="min-list link-list">';
          while ($relatedCategories->have_posts()) {
            $relatedCategories->the_post(); ?>
            <li>
              <!-- <input type="checkbox" /> -->
              <!-- <label><?php the_title(); ?></label> -->
              <a href="<?php the_permalink(); ?>" class="js-filters-trigger"><?php the_title(); ?>
              </a>
            </li>
        <?php }
          echo '</ul>';
        }

        wp_reset_postdata();

        ?>
      </div>
    </div>
  </div>
  <!-- End of Gallery Filters Menu -->

  <div class="gallery__gallery-cards">

    <?php
    while (have_posts()) {
      $today = date('Ymd');
      $pastEvents = new WP_QUERY(array(
        'paged' => get_query_var('paged', 1),
        'post_type' => 'artwork',
        'meta_key' => 'category',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array(
            'key' => 'category',
            'compare' => '=',
            'value' => 'drawing',
            'type' => 'string'
          )
        )
      ));

      the_post();
      get_template_part('template-parts/content', 'artwork');
    }
    echo paginate_links();
    ?>
  </div>
  <!-- <button class="btn btn--blue btn__see-more">See more
  </button> -->

  <button class="btn btn--blue btn__see-more">See more <svg xmlns="http://www.w3.org/2000/svg" class="grs-icon drawer-item-expand" width="24" height="24" fill="#fff" viewBox="0 0 16 16">
      <title>Expand Icon</title>
      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"></path>
    </svg>
  </button>

</div>
<div class="container container--narrow page-section">


  <hr class="section-break">

  <p>Looking for an archive of past work? <a href="https://grsart.co.uk/">View past work archive.</a></p>

</div>

<?php get_footer();
?>