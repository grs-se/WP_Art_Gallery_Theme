class GalleryFiltersMenu {
  // this.addGalleryFiltersMenuHTML()
  // this.filtersMenu = document.querySelector('.gallery-filters-menu')
  filtersMenuToggle = document.querySelectorAll('.js-filters-toggle')
  filtersTrigger = document.querySelectorAll('.js-filters-trigger')
  openButton = document.querySelectorAll('.js-search-trigger')
  closeButton = document.querySelector('.filters-overlay__close')
  galleryFiltersMenuDiv = document.querySelector('#submenu__menu-items')
  filterField = document.querySelector('#filter-box')
  parentMenuItem = document.querySelector('.gallery-submenu')
  closeSubmenuTrigger = document.querySelector('.gallery-submenu__close')
  filtersMenuOverlay = document.querySelector('.gallery-filters-menu-overlay')
  submenuDropdown = document.querySelector('.submenu-dropdown')
  // this.searchField = document.querySelector('#search-term')
  isFiltersMenuOpen = false
  // this.isSpinnerVisible = false
  // this.previousValue
  // this.typingTimer
  constructor() {
    this.events()
  }

  events() {
    if (this.filtersMenuToggle) {
      this.filtersMenuToggle.forEach((el) =>
        el.addEventListener('click', (e) => {
          e.preventDefault()
          this.toggleOverlay()
        })
      )
    }

    if (this.closeButton)
      this.closeButton.addEventListener('click', () => this.closeOverlay())

    this.filtersTrigger.forEach((el) =>
      el.addEventListener('click', (e) => {
        // e.preventDefault()
        this.filterLogic()
      })
    )
    // document.addEventListener('keydown', (e) => this.keyPressDispatcher(e))
    // this.searchField.addEventListener('keyup', () => this.typingLogic())
  }

  filterLogic() {
    // if (this.filterField.value != this.previousValue) {
    //   clearTimeout(this.typingTimer)
    //   if (this.filterField.value) {
    //     if (!this.isSpinnerVisible) {
    //       this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>'
    //       this.isSpinnerVisible = true
    //     }
    //     this.typingTimer = setTimeout(this.getResults.bind(this), 750)
    //   } else {
    //     this.resultsDiv.innerHTML = ''
    //     this.isSpinnerVisible = false
    //   }
    // }
    // this.previousValue = this.filterField.value
  }

  async getResults() {
    try {
      // ReactDOM.render(
      //   <GalleryCards data={data} />,
      //   document.getElementById('.gallery__gallery-cards')
      // )
      // const response = await axios.get(
      //   galleryData.root_url +
      //     '/wp-json/gallery/v1/search?term=' +
      //     this.searchField.value
      // )
    } catch (e) {
      console.log(e)
    }
  }

  toggleOverlay() {
    if (!this.isFiltersMenuOpen) {
      this.openOverlay()
    } else if (this.isFiltersMenuOpen) {
      this.closeOverlay()
    }
  }

  openOverlay() {
    if (this.filtersMenuOverlay)
      this.filtersMenuOverlay.classList.add(
        'gallery-filters-menu-overlay--active'
      )
    // setTimeout(() => this.searchField.focus(), 301)
    console.log('filters menu is open')
    this.isFiltersMenuOpen = true
    // event.preventDefault()
    return false
  }

  closeOverlay() {
    if (this.filtersMenuOverlay)
      this.filtersMenuOverlay.classList.remove(
        'gallery-filters-menu-overlay--active'
      )
    // document.body.classList.remove('body-no-scroll')
    console.log('filters menu is closed')
    this.isFiltersMenuOpen = false
    // comment out if desired behaviour is to keep last search results available when search is re-opened
    // this.resultsDiv.innerHTML = ''
  }

  addGalleryFiltersMenuHTML() {
    document.body.insertAdjacentHTML(
      'beforeend',
      `
      <div class="gallery-filters-menu-overlay">
        <div class="gallery-filters-overlay__top">
          <div class="container">
            <i class="fa fa-window-close filters-overlay__close" aria-hidden="true"></i>
          </div>
        </div>
        
        <div class="container">
          <div id="gallery-filters-overlay__results">
          <h1>Filters</h1>
          </div>
        </div>

      </div>
    `
    )
  }
}

export default GalleryFiltersMenu
