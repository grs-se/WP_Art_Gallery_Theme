<?php get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background: linear-gradient(90deg, rgba(0,0,0,0.90) 0%, rgba(0,0,0,0.10) 100%), url(<?php echo get_theme_file_uri('/images/slideshow-crop-chawton.jpg') ?>) center center/cover no-repeat;"></div>
  <div class="page-banner__content container c-white">
    <!-- <h1 class="headline headline--large">Welcome!</h1> -->
    <h2 class="headline headline--medium">Welcome to my new website</h2>
    <h3 class="headline headline--small">Please do feel free to contact me if you enjoy looking at my work</h3>
    <a href="<?php echo get_post_type_archive_link('artwork'); ?>" class="btn btn--large btn--blue">View Gallery</a>
  </div>
</div>

<div class="full-width-split group">
  <div class="full-width-split__one">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">Upcoming Exhibitions</h2>

      <?php
      $today = date('Ymd');
      $homepageEvents = new WP_QUERY(array(
        'posts_per_page' => 2,
        'post_type' => 'exhibition',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array(
            'key' => 'event_date',
            'compare' => '>=',
            'value' => $today,
            'type' => 'numeric'
          )
        )
      ));

      while ($homepageEvents->have_posts()) {
        $homepageEvents->the_post();
        get_template_part('template-parts/content', 'exhibition');
        // get_template_part('template-parts/content', get_post_type());
      }
      ?>

      <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('exhibition'); ?>" class="btn btn--blue">View All Exhibitions</a></p>

    </div>
  </div>
  <div class="full-width-split__two">
    <div class="full-width-split__inner">
      <h2 class="headline headline--small-plus t-center">Recent Posts</h2>

      <?php
      $homepagePosts = new WP_Query(array(
        'posts_per_page' => 2,
        // 'post_type' => 'page'
        // 'category_name' => 'awards'
      ));

      while ($homepagePosts->have_posts()) {
        $homepagePosts->the_post();
        $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

        // print_r($homepagePosts->the_post());

      ?>

        <div class="recent-work-summary">

          <img class="recent-work-summary__image" src="<?php echo $url; ?>" />

          <!-- <a class="recent-work-summary__image t-center" href="<?php the_permalink(); ?>" style="background-image: url(<?php echo "'" . $url . "'"; ?>);">
            <span class="recent-work-summary__month"><?php the_time('M'); ?></span>
            <span class="recent-work-summary__day"><?php the_time('d'); ?></span>
          </a> -->
          <div class="recent-work-summary__content">
            <h5 class="recent-work-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p><?php if (has_excerpt()) {
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 18);
                }; ?><a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
          </div>
        </div>

        <!-- reset global wordpress data cleans up -->
      <?php }
      wp_reset_postdata();
      ?>


      <p class="t-center no-margin"><a href="<?php echo site_url('/artworks'); ?>" class="btn btn--yellow">See more recent work</a></p>
    </div>
  </div>
</div>


<?php
get_spotlight_slider();
// get_hero_slider();
get_footer();
?>