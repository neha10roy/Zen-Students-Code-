<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add an Area
	$app->post('/area/add', 'addArea');

	function addArea(Request $request, Response $response){

		$areaname		= $request->getParam('areaname');
		$city 			= $request->getParam('city');
		$state 			= $request->getParam('state');
		$createdby 		= $request->getParam('createdby');

		$sql = "INSERT INTO area (areaname, city, state, createdby) VALUES (:areaname, :city, :state, :createdby)";

		try{

			// Get Database Instance
			$db = db::getInstance();
			
			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':areaname', 	$areaname);
			$stmt->bindParam(':city', 		$city);
			$stmt->bindParam(':state', 		$state);
			$stmt->bindParam(':createdby', 	$createdby);

			$stmt->execute();

			echo '{"notice": {"text": "Area Added!"}';						

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Area.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All Area
	$app->get('/area', 'getArea');

	function getArea(Request $request, Response $response){

		$sql = "SELECT areaname, city, state FROM area";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$area = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($area);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Area.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get Single Area
	$app->get('/area/{id}', 'getSingleArea');

	function getSingleArea(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT areaname, city, state FROM area WHERE areaid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$area = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($area);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Area.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update an Area
	$app->put('/area/update/{id}', 'updateArea');

	function updateArea(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$areaname	= $request->getParam('areaname');
		$city 		= $request->getParam('city');
		$state 		= $request->getParam('state');
		$modifiedby 	= $request->getParam('modifiedby');

		$sql = "UPDATE area SET
					areaname	= :areaname,
					city		= :city,
					state		= :state,
					modifiedby	= :modifiedby
				WHERE areaid = $id";


		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':areaname', 	$areaname);
			$stmt->bindParam(':city', 		$city);
			$stmt->bindParam(':state', 		$state);
			$stmt->bindParam(':modifiedby', $modifiedby);

			$stmt->execute();

			echo '{"notice": {"text": "Area Updated!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Area.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete an Area
	$app->delete('/area/delete/{id}', 'deleteArea');

	function deleteArea(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "DELETE FROM area WHERE areaid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			echo '{"notice": {"text": "Area Deleted!"}';

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Area.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};
	