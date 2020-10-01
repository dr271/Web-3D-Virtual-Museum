// X3D model manipulation

function swapTextureIfAppropriate (resourceName) {
  switch (resourceName) {
    case 'mars':
    case 'moon':
    case 'earth':
    case 'jupiter':
    case 'sun':
      let textureURL = './textures/' + resourceName + '/surface_texture.jpg'
      document.getElementById('model__Texture').setAttribute('url', textureURL)
      break
    default:
      break
  }
}

var modelIsSpinning = false
function toggleModelSpinning () {
  modelIsSpinning = !modelIsSpinning
  document.getElementById('model__RotationTimer').setAttribute('enabled', modelIsSpinning.toString())
}

function toggleWireframeMode () {
  document.getElementById('model').runtime.togglePoints(true)
}

var headlightOn = false
function toggleHeadlight () {
  headlightOn = !headlightOn
  document.getElementById('model__Headlight').setAttribute('headlight', headlightOn.toString())
}

function cameraFront () {
  document.getElementById('model__CameraFront').setAttribute('bind', 'true')
}

function cameraSide () {
  document.getElementById('model__CameraSide').setAttribute('bind', 'true')
}

function cameraBottom () {
  document.getElementById('model__CameraBottom').setAttribute('bind', 'true')
}
