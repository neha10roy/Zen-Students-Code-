<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add a CustomerType
	$app->post('/customertype/add', 'addNewCustomerType');

	function addNewCustomerType(Request $request, Response $response){

		$customertypename	= $request->getParam('customertypename');
		$isactive			= $request->getParam('isactive');
		$createdby 			= $request->getParam('createdby');

		$sql = "INSERT INTO customertype (customertypename, isactive, createdby) VALUES (:customertypename, :isactive, :createdby)";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':customertypename', 	$customertypename);
			$stmt->bindParam(':isactive', 			$isactive);
			$stmt->bindParam(':createdby', 			$createdby);

			$stmt->execute();

			echo '{"notice": {"text": "Customer Type Added!"}';						

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Customer Type.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All CustomerType
	$app->get('/customertype', 'getCustomerType');

	function getCustomerType(Request $request, Response $response){

		$sql = "SELECT customertypename, isactive FROM customertype";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$customertype = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$db = null;

			echo json_encode($customertype);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Customer Type.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};


	// Get All CustomerTypeId
	$app->get('/customertypeid', 'getCustomerTypeId');

	function getCustomerTypeId(Request $request, Response $response){

		$sql = "SELECT customertypeid,isactive FROM customertype";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$customertype = $stmt->fetchAll(PDO::FETCH_ASSOC);

			$db = null;

			echo json_encode($customertype);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Customer Type.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};



	// Get Single CustomerType
	$app->get('/customertype/{id}', 'getSingleCustomerType');

	function getSingleCustomerType(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT customertypeid, customertypename, isactive FROM customertype WHERE customertypeid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$customertype = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($customertype);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Customer Type.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update a CustomerType
	$app->put('/customertype/update/{id}', 'updateCustomerType');

	function updateCustomerType(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$customertypename	= $request->getParam('customertypename');
		$isactive			= $request->getParam('isactive');
		$modifiedby 		= $request->getParam('modifiedby');

		$sql = "UPDATE customertype SET
					customertypename	= :customertypename,
					isactive			= :isactive,
					modifiedby			= :modifiedby
				WHERE customertypeid = $id";


		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':customertypename', 	$customertypename);
			$stmt->bindParam(':isactive', 			$isactive);
			$stmt->bindParam(':modifiedby', 		$modifiedby);

			$stmt->execute();

			echo '{"notice": {"text": "Customer Type Updated!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Update Customer Type.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete a CustomerType
	$app->put('/customertype/delete/{id}', 'deleteCustomerType');

	function deleteCustomerType(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$isactive	= $request->getParam('isactive');

		$sql = "UPDATE customertype SET 

				isactive = 0

		 		WHERE customertypeid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			echo '{"notice": {"text": "Customer Type Deleted!"}';

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Customer Type.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};
	