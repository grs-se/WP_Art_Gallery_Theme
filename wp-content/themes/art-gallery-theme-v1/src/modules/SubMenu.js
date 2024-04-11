class SubMenu {
  constructor() {
    this.addSubmenuDropdownHtml()
    this.submenuItemsDiv = document.querySelector('#submenu__menu-items')
    this.parentMenuItem = document.querySelector('.gallery-submenu')
    this.closeSubmenuTrigger = document.querySelector('.gallery-submenu__close')
    this.submenuDropdown = document.querySelector('.submenu-dropdown')
    // this.searchField = document.querySelector('#search-term')
    this.isDropdownOpen = false
    // this.isSpinnerVisible = false
    // this.previousValue
    // this.typingTimer
    this.events()
  }

  // 2. events
  events() {
    if (this.parentMenuItem) {
      this.parentMenuItem.addEventListener('mouseover', () => {
        // e.preventDefault()
        this.openSubmenu()
      })

      this.closeSubmenuTrigger.addEventListener('click', () =>
        this.closeSubmenu()
      )
    }
    // document.addEventListener('keydown', (e) => this.keyPressDispatcher(e))
    // this.searchField.addEventListener('keyup', () => this.typingLogic())
  }

  openSubmenu() {
    this.submenuDropdown.classList.add('submenu-dropdown--active')
    // setTimeout(() => this.searchField.focus(), 301)
    console.log('dropdown is open')
    this.isDropdownOpen = true
    return false
  }

  closeSubmenu() {
    console.log('close submenu')
  }

  addSubmenuDropdownHtml() {
    document.body.insertAdjacentHTML(
      'beforeend',
      `
       <div class="submenu-dropdown">
        <div class="submenu-dropdown__top">
          <div class="container">
            <h1>Something goes here</h1>
          </div>
        </div>
        
        <div class="container">
          <div id="submenu-dropdown__results"></div>
        </div>

      </div>`
    )
  }
}

export default SubMenu
