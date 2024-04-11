<?php
function get_hero_slider()
{ ?>
  <div class="hero-slider">
    <div data-glide-el="track" class="glide__track">
      <div class="glide__slides">

        <!-- Start of dynamic code part -->
        <?php
        $slide = new WP_Query(array(
          'posts_per_page' => 3,
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

          <div class="hero-slider__slide" style="background-image: url(<?php the_post_thumbnail_url('slideshowImage'); ?>);">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center"><?php echo $slide_title; ?></h2>
                <p class="t-center"><?php echo $slide_subtitle; ?></p>
                <?php if ($slide_button_text) { ?>
                  <p class="t-center no-margin">
                    <a href="<?php $slide_link_value; ?>" class="btn btn--blue"><?php the_field('slide_link_text'); ?></a>
                  </p>
                <?php } ?>
              </div>
            </div>
          </div>

        <?php }

        ?> <!-- end of dynamic code part -->

      </div>
      <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
    </div>
  </div>

  <!-- <div class="hero-slider">
  <div data-glide-el="track" class="glide__track">
    <div class="glide__slides">
      <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/slideshow-crop-still-life.jpg') ?>">
        <div class="hero-slider__interior container">
          <div class="hero-slider__overlay">
            <h2 class="headline headline--medium t-center">Observational Oil Painting</h2>
            <p class="t-center">Observational Oil Painting.</p>
            <p class="t-center no-margin"><a href="#" class="btn btn--blue">See more</a></p>
          </div>
        </div>
      </div>
      <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/slideshow-crop-chawton.jpg') ?>">
        <div class="hero-slider__interior container">
          <div class="hero-slider__overlay">
            <h2 class="headline headline--medium t-center">Chawton</h2>
            <p class="t-center">Plein Aire Landscape Painting.</p>
            <p class="t-center no-margin"><a href="#" class="btn btn--blue">See more</a></p>
          </div>
        </div>
      </div>
      <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/20240223_223012.jpg') ?>">
        <div class="hero-slider__interior container">
          <div class="hero-slider__overlay">
            <h2 class="headline headline--medium t-center">Abstraction</h2>
            <p class="t-center">Fictional Gallery offers lunch plans for those in need.</p>
            <p class="t-center no-margin"><a href="#" class="btn btn--blue">See more</a></p>
          </div>
        </div>
      </div>
    </div>
    <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
  </div>
</div> -->
<?php }
?>