<?php echo $header; ?>

<!-- Main content -->
<div class="container-fluid">

  <!-- Home Content -->
  <div class="main_contents">
    <!-- Statement of Originality -->
    <div class="card">
      <h5 class="card-header">Statement of Originality</h5>

      <div class="card-body">
        <p class="card-text">This website is submitted as part requirement for the degree of Web 3D Applications at the University of Sussex. It is the product of my own labour except where indicated in the text and this specific webpage.
        </p>
        <p class="card-text">The website may be freely copied and distributed provided the source is acknowledged.</p>
      </div>
    </div>

    <!-- References -->
    <div class="card">
      <h5 class="card-header">References</h5>

      <div class="card-body">
        <p class="card-text">Below you will find links to the original sources of all images that have been used.</p>

        <ul>
          <?php for ($i = 0; $i < count($references); $i++){ ?>
            <li>
				<p>
              <a href="<?php echo $references[$i]["link"] ?>" target='_blank'><?php echo $references[$i]["title"] ?></a>
				</p>
            </li>
          <?php } ?>
        </ul>


      </div>
    </div>

  </div>

</div>

<?php echo $footer; ?>
