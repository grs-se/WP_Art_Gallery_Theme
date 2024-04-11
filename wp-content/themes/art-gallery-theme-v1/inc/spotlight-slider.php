<?php
function get_spotlight_slider()
{ ?>
  <div class="spotlight-slider">
    <div data-glide-el="track" class="glide__track">
      <div class="glide__slides">

        <!-- Start of dynamic code part -->
        <?php
        $slide = new WP_Query(array(
          'posts_per_page' => -1,
          'post_type' => 'slideshow'
        ));

        while ($slide->have_posts()) {
          $slide->the_post();
          $slide_image = get_field('slide_image');
          $slide_title = get_field('slide_title');
          $slide_subtitle = get_field('slide_subtitle');
          $slide_button_text = get_field('slide_button_text');
          $slide_url = get_field('slide_url');
          $slide_link_value = get_field('slide_link_value');
        ?>

          <div class="spotlight-slider__slide">
            <li class="artwork-card__list-item">
              <a class="artwork-card" href="<?php the_permalink(); ?>">
                <div class="artwork-card__image-container">
                  <div class="artwork-card__image-wrapper">
                    <img class="artwork-card__image" src="<?php the_post_thumbnail_url() ?>">
                  </div>
                </div>
                <div class="artwork-card__info">
                  <span class="artwork-card__name"><?php echo $slide_title; ?></span>
                </div>
              </a>
            </li>
          </div>

          <!-- <div class="spotlight-slider__slide" style="background-image: url(<?php the_post_thumbnail_url('slideshowImage'); ?>);">
            <div class="spotlight-slider__interior container">
              <div class="spotlight-slider__overlay">
                <h2 class="headline headline--medium t-center"><?php echo $slide_title; ?></h2>
                <p class="t-center"><?php echo $slide_subtitle; ?></p>
                <?php if ($slide_button_text) { ?>
                  <p class="t-center no-margin">
                    <a href="<?php $slide_link_value; ?>" class="btn btn--blue"><?php the_field('slide_link_text'); ?></a>
                  </p>
                <?php } ?>
              </div>
            </div>
          </div> -->

        <?php }

        ?> <!-- end of dynamic code part -->

      </div>
      <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
  </div>
<?php }
?>

<?php

// while (have_posts()) {
//   the_post();
//   get_template_part('template-parts/content', 'artwork');
// }
// echo paginate_links();
?>