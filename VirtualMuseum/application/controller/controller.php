<?php
// This is the Controller in the MVC design pattern. It facilitates the interaction between the view and the model layers.
class Controller {
	// Declare public variables for use by the controller class.
	public $load;
	public $model;

	// The constructor function for the Controller class.
	function __construct() {
		// Initialise the load and model variables as these will be used to display and retrieve data respectively.
		$this->load = new Load();
		$this->model = new Model();
	}

  // This function is called in order to instruct the view to navigate to a particular screen (e.g. home).
  public function render($page = null) {
    switch ($page) {
      case "home":
        $this->home();
        break;
      case "artefacts":
        $this->artefacts();
        break;
      case "references":
        $this->references();
        break;
      default:
        // Show an error message to the user.
        $this->error('Unknown Destination', 'Unable to navigate to page: ' . $page . '.');
    }
  }

  // Render the home screen.
	public function home() {
    $data['artefacts'] = $this->model->dbLandingPageArtefacts();

    $data['header'] = $this->generateHeader(0);
    $data['footer'] = $this->generateFooter();

		$this->load->display('home', $data);
	}

  // Render the error screen.
	public function error($error_title, $error_description) {
    $data['header'] = $this->generateHeader(-1);
    $data['footer'] = $this->generateFooter();

    $data['err_card_title'] = $error_title;
    $data['err_card_description'] = $error_description;

		$this->load->display('error', $data);
	}

  // Render the artefacts screen.
  public function artefacts() {
    // Extract the requested artefact_id from the URL.
    if (isset($_GET['artefact_id']) == false) {
      // No artefact_id was specified, so display an error message.
      $this->error('No Artefact Specified', 'When visiting the artefacts page, an artefact_id (0, 1, 2, or 3) must be specified.');
    } else {
      // Otherwise, a artefact_id was specified, so extract it.
      $artefact_id = $_GET['artefact_id'];

      // Fetch the artefact's data from the app model.
      $data['artefact_data'] = $this->model->dbGetArtefactWithID($artefact_id);

      // Make sure data was retrieved for this artefact_id, otherwise display error.
      if (strlen($data['artefact_data']['artefactName']) <= 0) {
        $this->error('Artefact Not Found', 'A model with an artefact_id value of ' . $artefact_id . ' was not found in the database.');
        return;
      }

      $data['header'] = $this->generateHeader(1);
      $data['footer'] = $this->generateFooter();

      $this->load->display('artefacts', $data);
    }
  }

  // Render the contact screen.
	public function references() {
    $data['header'] = $this->generateHeader(2);
    $data['footer'] = $this->generateFooter();

    $data['references'] = $this->model->dbGetReferences();

		$this->load->display('references', $data);
	}

  public function generateHeader($active_index) {
    ob_start();
    // Used to highlight the selected page in the nav bar.
    $data['active_index'] = $active_index;

    // Load the names of the models (for use in the dropdown menu).
    $data['artefact_names'] = $this->model->dbGetArtefactNames();

    $this->load->display('header', $data);
    return ob_get_clean();
  }

  public function generateFooter() {
    ob_start();
    $this->load->display('footer');
    return ob_get_clean();
  }

}
?>