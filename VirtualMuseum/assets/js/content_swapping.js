// Content swapping functions

function displayElement (id, shouldDisplay) {
  document.getElementById(id).style.display = shouldDisplay ? 'block' : 'none'
}

function makeElementActive (elementID, active) {
  if (active) {
    // Make sure the class doesn't already have the active tag.
    if (document.getElementById(elementID).classList.contains('active') === false) {
      document.getElementById(elementID).classList.add('active')
    }
  } else {
    document.getElementById(elementID).classList.remove('active')
  }
}

function swapModelInfoTab (newTab) {
  switch (newTab) {
    case 'description':
      makeElementActive('description_model_info_button', true)
      makeElementActive('gallery_model_info_button', false)
      displayElement('description_content', true)
      displayElement('gallery_content', false)
      break
    case 'gallery':
      makeElementActive('description_model_info_button', false)
      makeElementActive('gallery_model_info_button', true)
      displayElement('description_content', false)
      displayElement('gallery_content', true)
      break
    default:
      break
  }
}
