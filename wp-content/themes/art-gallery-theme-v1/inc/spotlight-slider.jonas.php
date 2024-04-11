<?php
function get_spotlight_slider()
{ ?>
  <section class="section" id="section--3">
    <div class="section__title section__title--testimonials">
      <h2 class="section__description">Not sure yet?</h2>
      <h3 class="section__header">
        Millions of Bankists are already making their lifes simpler.
      </h3>
    </div>

    <div class="slider">
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

        <div class="slide">
          <div class="slide__card">
            <!-- <address class="testimonial__author"> -->
            <img src="<?php the_post_thumbnail_url() ?>" alt="" class="slide__card__photo" />
            <h6 class="slide__card__name"><?php echo $slide_title; ?></h6>
            <p class="slide__card__location"><?php echo $slide_subtitle; ?></p>
            <!-- </address> -->
          </div>
        </div>

        <button class="slider__btn slider__btn--left">&larr;</button>
        <button class="slider__btn slider__btn--right">&rarr;</button>
        <div class="dots"></div>
    </div>
  </section>
<?php }
    }
