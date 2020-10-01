<?php echo $header; ?>

<!-- Model Content -->
<div class="main_contents">
  <div class="row">

    <!-- Viewer Window Column -->
    <div class="col-sm-7">
      <div class="card text-left">

        <!-- Card Header -->
        <div class="card-header">
          <h4><?php echo $artefact_data['artefactName']; ?></h4>
        </div>

        <!-- Card Body -->
        <div class="card-body">

          <!-- 3D Model -->
          <div class="model3D">
            <x3d id="model">
              <scene>
                <inline nameSpaceName="model" mapDEFToID="true" url="assets/x3d/<?php echo $artefact_data['x3dFilename']; ?>" onload="javascript:swapTextureIfAppropriate('<?php echo $artefact_data['resourceName']; ?>')"></inline>
              </scene>
            </x3d>
          </div>

          <div class="camera-btns">
            <div class="btn-group">
              <a href="javascript:cameraFront()" class="btn btn-secondary btn-responsive camera-font">Front</a>

              <a href="javascript:cameraSide()" class="btn btn-secondary btn-responsive camera-font">Side</a>

              <a href="javascript:cameraBottom()" class="btn btn-secondary btn-responsive camera-font">Bottom</a>
            </div>

            <div class="btn-group ">
              <a href="javascript:toggleHeadlight()" class="btn btn-primary btn-responsive camera-font" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Toggle headlight">Headlight</a>

              <a href="javascript:toggleWireframeMode()" class="btn btn-primary btn-responsive camera-font" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Toggle vertex/wireframe mode">Wireframe</a>

              <a href="javascript:toggleModelSpinning()" class="btn btn-primary btn-responsive camera-font" data-toggle="popover" data-trigger="hover" data-placement="top" data-content="Toggle spinning the 3D model">Spin</a>
            </div>
          </div>
        </div>

        <div class="card-footer text-muted">
			<p>
          X3D model created using Autodesk 3ds Max.
			</p>
        </div>
      </div>
    </div>

    <!-- Model Info -->
    <div class="col-sm-5">

      <div class="card">
        <div class="card-header">
          <!-- Header -->
          <div class="gallery-header">Prop Information</div>
          <br />

          <ul class="nav nav-tabs card-header-tabs">
            <!-- Description -->
            <li class="nav-item">
              <a class="nav-link active" id="description_model_info_button" href="javascript:swapModelInfoTab('description')">About</a>
            </li>

            <!-- Media Gallery -->
            <li class="nav-item">
              <a class="nav-link" id="gallery_model_info_button" href="javascript:swapModelInfoTab('gallery')">Gallery</a>
            </li>

          </ul>
        </div>
        <div class="card-body" id="body_model_info_card">
          <!-- Description content -->
          <div id="description_content">
            <p><?php echo $artefact_data['artefactDescription']; ?></p>
            <a href="<?php echo $artefact_data['url']; ?>" class="btn btn-info" target='_blank'>More Info</a>
          </div>

          <!-- Media Gallery content -->
          <div id="gallery_content" style="display:none">
            <?php for ($i = 0; $i < count($artefact_data['galleryImagePaths']); $i++){ ?>
              <img src="<?php echo $artefact_data['galleryImagePaths'][$i] ?>" style="width:100px; height:100px;"/>
            <?php } ?>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

<?php echo $footer; ?>
