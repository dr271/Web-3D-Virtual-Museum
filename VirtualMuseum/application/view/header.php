<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>GoT Museum</title>

  <!-- Stylesheet imports -->
  <link rel='stylesheet' href='https://www.x3dom.org/x3dom/release/x3dom.css'>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
  <link rel="stylesheet" href="./assets/css/custom.css">

  <!-- JS script imports (run before page is rendered) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src='https://www.x3dom.org/x3dom/release/x3dom.js'></script>
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/content_swapping.js"></script>
  <script src="assets/js/gallery_generator.js"></script>
  <script src="assets/js/x3d_manipulation.js"></script>
</head>

<body>
  <!-- Header -->
  <nav class="navbar sticky-top navbar-expand-sm navbar_GoT_museum">

    <!-- Brand -->
    <div class="brand">
      <a href="index.php">
        <div class="GoT_logo"></div>
      </a>
      <div class="logo">
        <a class="navbar-brand" href="index.php">
          <h1>GoT Museum</h1>
          <p>Your virtual look behind the scenes.</p>
        </a>
      </div>
    </div>

    <!-- Burger Menu -->
    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsable menu -->
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <!-- Home (selected by default) -->
        <li class="nav-item">
          <a class="nav-link <?php echo ($active_index == 0 ? 'active' : '') ?>" href="index.php">Home</a>
        </li>

        <!-- Models -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?php echo ($active_index == 1 ? 'active' : '') ?>" href="#" data-toggle="dropdown">Props</a>

          <!-- Models dropdown list -->
          <div class="dropdown-menu">
            <?php for ($i = 0; $i < count($artefact_names); $i++){ ?>
              <a class="dropdown-item" href="index.php?page=artefacts&artefact_id=<?php echo $i ?>"><?php echo $artefact_names[$i] ?></a>
            <?php } ?>
          </div>
        </li>

        <!-- References -->
        <li class="nav-item">
          <a class="nav-link <?php echo ($active_index == 2 ? 'active' : '') ?>" href="index.php?page=references">References</a>
        </li>
      </ul>
    </div>
  </nav>
