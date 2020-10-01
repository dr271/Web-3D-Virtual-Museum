<?php
// The Data Abstraction Layer (DAL), responsible for interactions with the SQL database.
class Model {
	// A handle to the database.
	public $db_handle;

	// Constructor for this class creates a database connection (using PHP PDO) to the local SQLite database.
	public function __construct() {
		// initialise the dsn (database source name).
		$dsn = 'sqlite:./assets/db/GoT_props_data.db';

		try {
			$this->db_handle = new PDO($dsn, 'user', 'password', array(
    													PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    													PDO::ATTR_EMULATE_PREPARES => false,
														));
		} catch (PDOEXception $e) {
			echo 'The following error occured while connecting to the database:<br />';
    	print new Exception($e->getMessage());
  	}
	}

  // Database initialisation function
  // Only called once
  // - If they exist, ArtefactName and ArtefactData tables are deleted.
  // - Two empty tables created.
  // - Tables filled with data.
	public function dbInitialiseDatabases() {
		try {
      // Delete the existing tables (if they exist).
      $this->db_handle->exec("DROP TABLE IF EXISTS ArtefactName");
      $this->db_handle->exec("DROP TABLE IF EXISTS ArtefactData");

      // Create the new ArtefactName table.
			$this->db_handle->exec("CREATE TABLE ArtefactName (
        artefactId INTEGER PRIMARY KEY,
        artefactName TEXT
      );");

      // Create the new ArtefactData table.
			$this->db_handle->exec("CREATE TABLE ArtefactData (
        artefactId INTEGER PRIMARY KEY,
        artefactDescription TEXT,
        url TEXT,
        resourceName TEXT,
        landingPageImageName TEXT,
        FOREIGN KEY (artefactId) REFERENCES ArtefactName(artefactId)
      );");

      $this->db_handle->exec(
  			"INSERT INTO ArtefactName (artefactId, artefactName)
  				VALUES
          (0, 'Ice'),
          (1, 'Stark Shield'),
          (2, 'Unsullied Helmet'),
          (3, 'House Banners'),
        "
      );

      $this->db_handle->exec(
  			"INSERT INTO ArtefactData (artefactId, artefactDescription, url, resourceName, landingPageImageName)
  				VALUES
          (0, 'Ice was a Valyrian steel greatsword and an heirloom of House Stark. It was used both in war and on ceremonial occasions by the Lord of Winterfell. Ice had been in the possession of House Stark for generations and was kept in a special scabbard crafted from the pelt of a wolf. After it changed hands to the Lannisters, it was melted down and reforged. The two swords that resulted were named Widow's Wail and Oathkeeper; while the former remains with House Lannister, the latter has returned to House Stark's service as the weapon of Brienne of Tarth.', 'https://gameofthrones.fandom.com/wiki/Ice', 'ice', 'ice.jpg'),

          (1, 'House Stark of Winterfell is a Great House of Westeros, ruling over the vast region known as the North from their seat in Winterfell. Their sigil is a grey direwolf, and so that’s what you see decorating the face of the shield that would have been issued to their soldiers. ', 'https://gameofthrones.fandom.com/wiki/House_Stark', 'shield', 'shield.jpg'),

          (2, 'The Unsullied are slave-eunuchs who have been trained from birth to fight, they are renowned for their utter discipline on the battlefield, both in their usage of incredibly coordinated large unit phalanx formations, and because they will never break in the face of overwhelming odds. The training regimen is so brutal that only one out of every four boys survives to become a soldier. ', 'https://gameofthrones.fandom.com/wiki/Unsullied', 'helmet', 'helmet.jpg'),

          (3, 'House Targaryen of Dragonstone is a Great House of Westeros and was the ruling royal House of the Seven Kingdoms for three centuries since it conquered and unified the realm before it was deposed during Robert's Rebellion and House Baratheon replaced it as the new royal House. House Targaryen's sigil is a three-headed red dragon on a black background, and so this is what you see decorating their banner.', 'https://gameofthrones.fandom.com/wiki/House_Targaryen', 'saturn', 'saturn.jpg'),
        "
      );
		} catch (PD0EXception $e){
      echo 'The following error occured while creating the table:<br />';
			print new Exception($e->getMessage());
		}
	}

  // Returns the artefact name associated with this artefact_id.
  public function getArtefactNameWithID($artefact_id) {
    try {
			// Prepare an SQL statement.
			$sql = "SELECT artefactName FROM ArtefactName WHERE artefactId='$artefact_id'";

			// Use PDO query() to query the database with the prepared SQL statement.
			$stmt = $this->db_handle->query($sql);

      // Fetch the result and store it in the model_data variable.
      $artefact_name = $stmt->fetch();
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

		// Send the response (JSON encoded) back to the controller.
		return $artefact_name[0];
  }

  // This method is responsible for retrieving (in JSON) format, the artefact (data) with the specified ID.
  public function dbGetArtefactWithID($artefact_id) {
    try {
			// Prepare an SQL statement.
			$sql = "SELECT * FROM ArtefactData WHERE artefactId='$artefact_id'";

			// Use PDO query() to query the database with the prepared SQL statement.
			$stmt = $this->db_handle->query($sql);

      // Fetch the result and store it in the model_data variable.
      $result = $stmt->fetch();

      // Fetch the name of this artefact.
      $artefact_name = $this->getArtefactNameWithID($artefact_id);

      $artefact_data['artefactName'] = $artefact_name;
      $artefact_data['artefactDescription'] = $result['artefactDescription'];
      $artefact_data['url'] = $result['url'];
      $artefact_data['resourceName'] = $result['resourceName'];
      $artefact_data['x3dFilename'] = $artefact_data['resourceName'] . '.x3d';

      if ($artefact_name === 'Moon' || $artefact_name === 'Mars' || $artefact_name === 'Earth' || $artefact_name === 'Jupiter' || $artefact_name === 'Sun') {
        $artefact_data['x3dFilename'] = 'generic_planet.x3d';
      }

      $artefact_data['landingPageImageName'] = $result['landingPageImageName'];
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

    // Get the paths for the images in this artefact's gallery.
    $image_paths = $this->dbGetGalleryImagePathsForResourceName($artefact_data['resourceName']);
    $artefact_data['galleryImagePaths'] = $image_paths;

		// Send the response (JSON encoded) back to the controller.
		return $artefact_data;
  }

  // This function returns the names of the artefacts (used to populate the dropdown list in the header).
	public function dbGetArtefactNames() {
    try {
			// Prepare an SQL statement.
			$sql = "SELECT artefactName FROM ArtefactName";

			// Use PDO query() to query the database with the prepared SQL statement.
			$stmt = $this->db_handle->query($sql);

      $artefact_names = null;

      // Counter for each of the returned rows.
      $i = 0;

      while ($data = $stmt->fetch()) {
        $artefact_names[$i] = $data['artefactName'];
        $i++;
      }
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

		// Send the response (JSON encoded) back to the controller.
		return $artefact_names;
	}

  // Fetch artefact information for the landing page.
  // This includes the artefact names and primary photo name.
  public function dbLandingPageArtefacts() {
    try {
			// Prepare an SQL statement.
			$sql = "SELECT (artefactId) FROM ArtefactName";

			// Use PDO query() to query the database with the prepared SQL statement.
			$stmt = $this->db_handle->query($sql);

      $artefacts = null;

      // Counter for each of the returned rows.
      $i = 0;

      while ($artefactId = $stmt->fetch()) {
        $artefactId = $artefactId[0];
        $artefacts[$artefactId]['artefactName'] = $this->dbGetArtefactWithID($artefactId)['artefactName'];
        $artefacts[$artefactId]['landingPageImageName'] = $this->dbGetArtefactWithID($artefactId)['landingPageImageName'];

        $i++;
      }
		} catch (PD0EXception $e) {
      echo 'The following error occured while retreiving data from the database:<br />';
			print new Exception($e->getMessage());
		}

		// Send the response back to the controller.
		return $artefacts;
  }

  public function dbGetGalleryImagePathsForResourceName($resource_name) {
    $directory = './assets/images/gallery_images/' . $resource_name;
    $allowed_extensions = array('png', 'jpg');
    $dir_handle = opendir($directory);

    $filepaths = null;

    $i = 0;

    while ($file = readdir($dir_handle)) {
        if (substr($file, 0, 1) != '.') {
            $file_components = explode('.', $file);
            $extension = strtolower(array_pop($file_components));
            if (in_array($extension, $allowed_extensions)) {
              $filepaths[$i] = $directory.'/'.$file;
            }
            $i++;
        }

    }

    closedir($dir_handle);
    return $filepaths;
  }

  public function dbGetReferences() {
    $references_string = file_get_contents("./application/model/references.js");
    $json = json_decode($references_string, true);
    return $references_json = $json['references'];
  }

}
?>