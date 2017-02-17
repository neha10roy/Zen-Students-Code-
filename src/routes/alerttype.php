<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add a Alerttype
	$app->post('/alerttype/add', 'addNewAlertType');

	function addNewAlertType(Request $request, Response $response){

		$alerttypedescription 	= $request->getParam('alerttypedescription');
		$createdby 				= $request->getParam('createdby');

		$sql = "INSERT INTO alerttype (alerttypedescription, createdby) VALUES ('test alert, 'manjeet')";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':alerttypedescription', 	$alerttypedescription);
			$stmt->bindParam(':createdby', 				$createdby);

			$stmt->execute();

			echo '{"notice": {"text": "Alerttype Added!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Alerttype.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All Alerttypes
	$app->get('/alerttype', 'getAlertType');

	function getAlertType(Request $request, Response $response){

		$sql = "SELECT alerttypeid, alerttypedescription FROM alerttype";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$alerttype = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($alerttype);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Alerttypes.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get Single alerttype
	$app->get('/alerttype/{id}', 'getSingleAlertType');

	function getSingleAlertType(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT alerttypeid, alerttypedescription FROM alerttype WHERE alerttypeid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$alerttype = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($alerttype);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Alerttype.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update an Alerttype
	$app->put('/alerttype/update/{id}', 'updateAlertType');

	function updateAlertType(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$alerttypedescription 	= $request->getParam('alerttypedescription');
		$modifiedby 			= $request->getParam('modifiedby');

		$sql = "UPDATE alerttype SET
					alerttypedescription	= :alerttypedescription,
					modifiedby				= :modifiedby
				WHERE alerttypeid = $id";


		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':alerttypedescription', 	$alerttypedescription);
			$stmt->bindParam(':modifiedby', 			$modifiedby);

			$stmt->execute();

			echo '{"notice": {"text": "Alerttype Updated!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Update Alerttype.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete an Alerttype
	// $app->delete('/alerttype/delete/{id}', 'deleteAlertType');

	// function deleteAlertType(Request $request, Response $response){

	// 	$id = $request->getAttribute('id');

	// 	$sql = "DELETE FROM alerttype WHERE alerttypeid = $id";

	// 	try{

	// 		// Get Database Instance
	// 		$db = db::getInstance();

	// 		// Connect to Database
	// 		$db = $db->connect();

	// 		$stmt = $db->prepare($sql);

	// 		$stmt->execute();

	// 		$db = null;

	// 		echo '{"notice": {"text": "Alerttype Deleted!"}';

	// 	} catch(PDOException $e){

	// 		echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Alerttype.", 0).'}';

	// 	}

	// 	$close = new db();
	// 	// this will close connection
	// 	$close->disconnect();
	// };
	