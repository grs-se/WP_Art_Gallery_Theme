import Glide from '@glidejs/glide'

class SpotlightSlider {
  private slider = document.querySelector('.spotlight-slider')
  private slides = document.querySelectorAll('.spotlight-slider__slide')
  private dots = document.querySelector('.glide__bullets')
  // glide: Glide;

  constructor() {
    if (this.slider) {
      // count how many slides there are
      const dotCount = this.slides.length
      // Generate the HTML for the navigation dots
      let dotHTML = ''
      for (let i = 0; i < dotCount; i++) {
        dotHTML += `<button class="slider__bullet glide__bullet" data-glide-dir="=${i}"></button>`
      }
      // Add the dots HTML to the DOM
      if (this.dots) this.dots.insertAdjacentHTML('beforeend', dotHTML)

      // Actually initialize the glide / slider script
      const glide = new (Glide as any)(this.slider, {
        type: 'carousel',
        startAt: 0,
        perView: 3,
        autoplay: 3000,
        breakpoints: {
          960: {
            perView: 2,
          },
          750: {
            perView: 1,
          },
          620: {
            perView: 1,
          },
        },
        // focusAt: center,
        hoverpause: true,
      })

      glide.mount()
    }
  }
}

export default SpotlightSlider
