<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add a PaymentMode
	$app->post('/paymentmode/add', 'addPaymentMode');

	function addPaymentMode(Request $request, Response $response){

		$modedescription 	= $request->getParam('modedescription');
		$createdby 			= $request->getParam('createdby');

		$sql = "INSERT INTO paymentmode (modedescription, createdby) VALUES (:modedescription, :createdby)";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':modedescription', 	$modedescription);
			$stmt->bindParam(':createdby', 			$createdby);

			$stmt->execute();

			echo '{"notice": {"text": "Payment Mode Added!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Payment Mode.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All PaymentMode
	$app->get('/paymentmode', 'getPaymentMode');

	function getPaymentMode(Request $request, Response $response){

		$id = $request->getParam('paymentmodeid');

		$sql = "SELECT paymentmodeid, modedescription FROM paymentmode";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$paymentmode = $stmt->fetchAll(PDO::FETCH_ASSOC);

			return $response->withJSON(
				['id' => $id]
			);	

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Payment Mode.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get Single PaymentMode
	$app->get('/paymentmode/{id}', 'getSinglePaymentMode');

	function getSinglePaymentMode(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT paymentmodeid, modedescription FROM paymentmode WHERE paymentmodeid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$paymentmode = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($paymentmode);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Payment Mode.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update an PaymentMode
	$app->put('/paymentmode/update/{id}', 'updatePaymentMode');

	function updatePaymentMode(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$modedescription 	= $request->getParam('modedescription');
		$modifiedby 		= $request->getParam('modifiedby');

		$sql = "UPDATE paymentmode SET
					modedescription	= :modedescription,
					modifiedby		= :modifiedby
				WHERE paymentmodeid = $id";


		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':modedescription', 	$modedescription);
			$stmt->bindParam(':modifiedby', 		$modifiedby);

			$stmt->execute();

			echo '{"notice": {"text": "Payment Mode Updated!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Update Payment Mode.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete an PaymentMode
	$app->delete('/paymentmode/delete/{id}', 'deletePaymentMode');

	function(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "DELETE FROM paymentmode WHERE paymentmodeid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			echo '{"notice": {"text": "Payment Mode Deleted!"}';

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Payment Mode.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};
	