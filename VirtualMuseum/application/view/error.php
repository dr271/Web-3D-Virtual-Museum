<?php echo $header; ?>

<!-- Main content -->
<div class="container-fluid">

  <!-- Home Content -->
  <div class="main_contents">
    <div class="card bg-warning text-center text-dark">
      <div class="card-header">
        Oops, Something Went Wrong...
      </div>
      <div class="card-body">
        <h5 class="card-title"><?php echo $err_card_title; ?></h5>
        <p class="card-text"><?php echo $err_card_description; ?></p>
        <a href="index.php" class="btn btn-info">Return to Home</a>
      </div>
    </div>
  </div>

</div>

<?php echo $footer; ?>
