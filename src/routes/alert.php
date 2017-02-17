<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add an Alert
	$app->post('/alert/add', 'addAlert'); 

	function addAlert(Request $request, Response $response){

		$customerid		= $request->getParam('customerid');
		$alerttypeid 	= $request->getParam('alerttypeid');
		$createdby 		= $request->getParam('createdby');
		$sentdate		= $request->getParam('sentdate');
		$subscriberid 	= $request->getParam('subscriberid');

		$sql = "INSERT INTO alert (customerid, alerttypeid, createdby, sentdate, subscriberid) VALUES (:customerid, :alerttypeid, :createdby, :sentdate, :subscriberid)";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':customerid', 	$customerid);
			$stmt->bindParam(':alerttypeid', 	$alerttypeid);
			$stmt->bindParam(':createdby', 		$createdby);
			$stmt->bindParam(':sentdate', 		$sentdate);
			$stmt->bindParam(':subscriberid', 	$subscriberid);

			$stmt->execute();

			echo '{"notice": {"text": "Alert Added!"}';						

		} catch(PDOException $e){

			error_log("Somthing is wrong. Can't Add Alert.", 0);

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All Alert
	$app->get('/alert', 'getAllAlert'); 

	function getAllAlert(Request $request, Response $response){

		$sql = "SELECT customerid, alerttypeid, sentdate, subscriberid FROM alert";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$alert = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($alert);

		} catch(PDOException $e){

			error_log("Somthing is wrong. Can't Load Alerts.", 0);

		}

		$close = db::getInstance();
		// this will close connection
		$close->disconnect();
	};




	// Get Single Alert
	$app->get('/alert/{id}', 'getSingleAlert');

	function getSingleAlert(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT customerid, alerttypeid, sentdate, subscriberid FROM alert WHERE alertid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$alert = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($alert);

		} catch(PDOException $e){

			error_log("Somthing is wrong. Can't Load Alert.", 0);

		}

		$close = db::getInstance();
		// this will close connection
		$close->disconnect();
	};




	// Update an Alert
	$app->put('/alert/update/{id}', 'updateAlert');

	function updateAlert(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$customerid		= $request->getParam('customerid');
		$alerttypeid 	= $request->getParam('alerttypeid');
		$modifiedby 	= $request->getParam('modifiedby');
		$subscriberid 	= $request->getParam('subscriberid');

		$sql = "UPDATE alert SET
					customerid		= :customerid,
					alerttypeid		= :alerttypeid,
					subscriberid	= :subscriberid,
					modifiedby		= :modifiedby
				WHERE alertid = $id";


		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':customerid', 	$customerid);
			$stmt->bindParam(':alerttypeid', 	$alerttypeid);
			$stmt->bindParam(':subscriberid', 	$subscriberid);
			$stmt->bindParam(':modifiedby', 	$modifiedby);

			$stmt->execute();

			echo '{"notice": {"text": "Alert Updated!"}';			
			

		} catch(PDOException $e){

			error_log("Somthing is wrong. Can't Update Alert.", 0);

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete an Alert
	$app->delete('/alert/delete/{id}', 'deleteAlert');

	function deleteAlert(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "DELETE FROM alert WHERE alertid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			echo '{"notice": {"text": "Alert Deleted!"}';

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Alert.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};
	