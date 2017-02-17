<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add a BookSubscriber
	$app->post('/booksubscriber/add', 'addBookSubscriber');

	function addBookSubscriber(Request $request, Response $response){

		$name			= $request->getParam('name');
		$areaid 		= $request->getParam('areaid');
		$city 			= $request->getParam('city');
		$state 			= $request->getParam('state');
		$isactive 		= $request->getParam('isactive');
		$createdby 		= $request->getParam('createdby');

		$sql = "INSERT INTO booksubscriber (name, areaid, city, state, isactive, createdby) VALUES (:name, :areaid, :city, :state, :isactive, :createdby)";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':name', 		$name);
			$stmt->bindParam(':areaid', 	$areaid);
			$stmt->bindParam(':city', 		$city);
			$stmt->bindParam(':state', 		$state);
			$stmt->bindParam(':isactive', 	$isactive);
			$stmt->bindParam(':createdby', 	$createdby);

			$stmt->execute();

			echo '{"notice": {"text": "Subscriber Added!"}';						

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Subscriber.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All BookSubscriber
	$app->get('/booksubscriber', 'getBookSubscriber');

	function getBookSubscriber(Request $request, Response $response){

		$sql = "SELECT name, areaid, city, state, isactive FROM booksubscriber";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$subscriber = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($subscriber);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Subscriber.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get Single BookSubscriber
	$app->get('/booksubscriber/{id}', 'getSingleBookSubscriber');

	function getSingleBookSubscriber(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT name, areaid, city, state, isactive FROM booksubscriber WHERE subscriberid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$subscriber = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($subscriber);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Subscriber.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update a BookSubscriber
	$app->put('/booksubscriber/update/{id}', 'updateBookSubscriber');

	function updateBookSubscriber(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$name		= $request->getParam('name');
		$areaid 	= $request->getParam('areaid');
		$city 		= $request->getParam('city');
		$state 		= $request->getParam('state');
		$isactive 	= $request->getParam('isactive');
		$modifiedby = $request->getParam('modifiedby');

		$sql = "UPDATE booksubscriber SET
					name		= :name,
					areaid		= :areaid,
					state		= :state,
					city		= :city,
					isactive	= :isactive,
					modifiedby	= :modifiedby
				WHERE subscriberid = $id";


		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':name', 		$name);
			$stmt->bindParam(':areaid', 	$areaid);
			$stmt->bindParam(':city', 		$city);
			$stmt->bindParam(':state', 		$state);
			$stmt->bindParam(':isactive', 	$isactive);
			$stmt->bindParam(':modifiedby', $modifiedby);

			$stmt->execute();

			echo '{"notice": {"text": "Subscriber Updated!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Update Subscriber.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete a BookSubscriber
	$app->put('/booksubscriber/delete/{id}', 'deleteBookSubscriber');

	function deleteBookSubscriber(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$isactive = $request->getParam('isactive');

		$sql = "UPDATE booksubscriber SET 

				isactive = 0

				WHERE subscriberid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			echo '{"notice": {"text": "Subscriber Deleted!"}';

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Subscriber.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};
	