class SpotlightSlider {
  constructor() {
    this.slides = document.querySelectorAll('.spotlight-slide')
    this.btnLeft = document.querySelector('.spotlight-slider__btn--left')
    this.btnRight = document.querySelector('.spotlight-slider__btn--right')
    this.dotContainer = document.querySelector('.dots')
    let curSlide = 0
    const maxSlide = slides.length

    this.slider()
    // if (document.querySelector('.spotlight-slider')) {
    //   // count how many slides there are
    //   const dotCount = document.querySelectorAll(
    //     '.spotlight-slider__slide'
    //   ).length
    //   // Generate the HTML for the navigation dots
    //   let dotHTML = ''
    //   for (let i = 0; i < dotCount; i++) {
    //     dotHTML += `<button class="slider__bullet glide__bullet" data-glide-dir="=${i}"></button>`
    //   }
    //   // Add the dots HTML to the DOM
    //   document
    //     .querySelector('.glide__bullets')
    //     .insertAdjacentHTML('beforeend', dotHTML)
  }

  ///////////////////////////////////////
  // Slider
  slider() {
    // Functions
    const createDots = function () {
      slides.forEach(function (_, i) {
        dotContainer.insertAdjacentHTML(
          'beforeend',
          `<button class="dots__dot" data-slide="${i}"></button>`
        )
      })
    }

    const activateDot = function (slide) {
      document
        .querySelectorAll('.dots__dot')
        .forEach((dot) => dot.classList.remove('dots__dot--active'))

      document
        .querySelector(`.dots__dot[data-slide="${slide}"]`)
        .classList.add('dots__dot--active')
    }

    const goToSlide = function (slide) {
      slides.forEach(
        (s, i) => (s.style.transform = `translateX(${100 * (i - slide)}%)`)
      )
    }

    // Next slide
    const nextSlide = function () {
      if (curSlide === maxSlide - 1) {
        curSlide = 0
      } else {
        curSlide++
      }

      goToSlide(curSlide)
      activateDot(curSlide)
    }

    const prevSlide = function () {
      if (curSlide === 0) {
        curSlide = maxSlide - 1
      } else {
        curSlide--
      }
      goToSlide(curSlide)
      activateDot(curSlide)
    }

    const init = function () {
      goToSlide(0)
      createDots()

      activateDot(0)
    }
    init()

    // Event handlers
    btnRight.addEventListener('click', nextSlide)
    btnLeft.addEventListener('click', prevSlide)

    document.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft') prevSlide()
      e.key === 'ArrowRight' && nextSlide()
    })

    dotContainer.addEventListener('click', function (e) {
      if (e.target.classList.contains('dots__dot')) {
        const { slide } = e.target.dataset
        goToSlide(slide)
        activateDot(slide)
      }
    })
  }

  // Actually initialize the glide / slider script
  // var glide = new Glide('.spotlight-slider', {
  //   type: 'carousel',
  //   startAt: 0,
  //   autoplay: 3000,
  //   hoverpause: true,
  //   gap: 20,
  //   // animationTimingFunc: ease,
  //   perView: 3,
  //   breakpoints: {
  //     800: {
  //       perView: 3,
  //     },
  //     600: {
  //       perView: 1,
  //     },
  //   },
  // type: 'carousel',
  // startAt: 0,
  // perView: 3,
  // autoplay: 3000,
  // breakpoints: {
  //   960: {
  //     perView: 2,
  //   },
  //   750: {
  //     perView: 1,
  //   },
  //   620: {
  //     perView: 1,
  //   },
  // },
  // focusAt: center,
  // hoverpause: true,
  //     })

  //     glide.mount()
  //   }
  // }
}

export default SpotlightSlider
