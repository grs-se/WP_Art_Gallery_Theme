<?php
get_header();

while (have_posts()) {
  the_post();
  // pageBanner(
  //   array(
  //     'show_banner' => false,
  //     'background_image' => get_the_post_thumbnail_url('page_banner_background_image'),
  //   )
  // );
?>

  <div class="container container--narrow page-section">

    <div class="generic-content">
      <div class="row group">
        <div class="one-third">
          <?php the_post_thumbnail('medium_large'); ?>
        </div>
        <div class="two-thirds">
          <?php the_content(); ?>
        </div>
      </div>
    </div>

    <?php
    $relatedPrograms = get_field('related_programs');

    if ($relatedPrograms) {
      echo '<hr class="section-break">';
      echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
      echo '<ul class="link-list min-list">';
      foreach ($relatedPrograms as $program) { ?>
        <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?></a></li>
    <?php }
      echo '</ul>';
    } ?>


    <?php
    $post_tags = get_the_tags();

    if ($post_tags) {
      foreach ($post_tags as $tag) {
        // print_r($tag->name);
    ?>
        <div class="post-tags__container">
          <ul class="post-tags__list">
            <li>
              <span>
                <?php echo $tag->name; ?>
              </span>
            </li>
            ?>
          </ul>
        </div>

      <?php }
      ?>
  </div>


<?php
    }
  }

  get_footer();
?>