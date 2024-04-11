///////////////////////////////////////
// Slider
class Slider {
  constructor() {
    this.slides = document.querySelectorAll('.slide')
    this.btnLeft = document.querySelector('.slider__btn--left')
    this.btnRight = document.querySelector('.slider__btn--right')
    this.dotContainer = document.querySelector('.dots')

    this.curSlide = 0
    this.maxSlide = this.slides.length
    this.init()
    this.events()
  }

  // Event handlers
  events() {
    this.btnRight.addEventListener('click', this.nextSlide)
    this.btnLeft.addEventListener('click', this.prevSlide)

    document.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft') this.prevSlide()
      e.key === 'ArrowRight' && this.nextSlide()
    })

    this.dotContainer.addEventListener('click', function (e) {
      if (e.target.classList.contains('dots__dot')) {
        const { slide } = e.target.dataset
        this.goToSlide(slide)
        this.activateDot(slide)
      }
    })
  }

  // Functions
  createDots() {
    this.slides.forEach((_, i) => {
      this.dotContainer.insertAdjacentHTML(
        'beforeend',
        `<button class="dots__dot" data-slide="${i}"></button>`
      )
    })
  }

  activateDot(slide) {
    document
      .querySelectorAll('.dots__dot')
      .forEach((dot) => dot.classList.remove('dots__dot--active'))

    document
      .querySelector(`.dots__dot[data-slide="${slide}"]`)
      .classList.add('dots__dot--active')
  }

  goToSlide(slide) {
    this.slides.forEach(
      (s, i) => (s.style.transform = `translateX(${100 * (i - slide)}%)`)
    )
  }

  // Next slide
  nextSlide() {
    if (this.curSlide === this.maxSlide - 1) {
      this.curSlide = 0
    } else {
      this.curSlide++
    }

    this.goToSlide(this.curSlide)
    this.activateDot(this.curSlide)
  }

  prevSlide() {
    if (this.curSlide === 0) {
      this.curSlide = this.maxSlide - 1
    } else {
      this.curSlide--
    }
    this.goToSlide(this.curSlide)
    this.activateDot(this.curSlide)
  }

  init() {
    this.goToSlide(0)
    this.createDots()

    this.activateDot(0)
  }
}
// slider()
export default Slider
