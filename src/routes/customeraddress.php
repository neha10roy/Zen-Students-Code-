<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add a CustomerAddress
	$app->post('/customeraddress/add', 'addCustomerAddress');

	function addCustomerAddress(Request $request, Response $response){

		$houseno		= $request->getParam('houseno');
		$addressline1	= $request->getParam('addressline1');
		$addressline2	= $request->getParam('addressline2');
		$city 			= $request->getParam('city');
		$state 			= $request->getParam('state');
		$country 		= $request->getParam('country');
		$zipcode 		= $request->getParam('zipcode');
		$createdby 		= $request->getParam('createdby');

		$sql = "INSERT INTO customeraddress (houseno, addressline1, addressline2, city, state, country, zipcode, createdby) VALUES (:houseno, :addressline1, :addressline2, :city, :state, :country, :zipcode, :createdby)";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':houseno', 		$houseno);
			$stmt->bindParam(':addressline1', 	$addressline1);
			$stmt->bindParam(':addressline2', 	$addressline2);
			$stmt->bindParam(':city', 			$city);
			$stmt->bindParam(':state', 			$state);
			$stmt->bindParam(':country', 		$country);
			$stmt->bindParam(':zipcode', 		$zipcode);
			$stmt->bindParam(':createdby', 		$createdby);

			$stmt->execute();

			echo '{"notice": {"text": "Customer Address Added!"}';						

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Customer Address.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All CustomerAddress
	$app->get('/customeraddress', 'getCustomerAddress');

	function getCustomerAddress(Request $request, Response $response){

		$sql = "SELECT houseno, addressline1, addressline2, city, state, country, zipcode FROM customeraddress";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$customeraddress = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($customeraddress);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Customer Address.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get Single CustomerAddress
	$app->get('/customeraddress/{id}', 'getSingleCustomerAddress');

	function getSingleCustomerAddress(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT houseno, addressline1, addressline2, city, state, country, zipcode FROM customeraddress WHERE customerid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$customeraddress = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($customeraddress);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Customer Address.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update a CustomerAddress
	$app->put('/customeraddress/update/{id}', 'updateCustomerAddress');

	function updateCustomerAddress(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$houseno		= $request->getParam('houseno');
		$addressline1	= $request->getParam('addressline1');
		$addressline2	= $request->getParam('addressline2');
		$city 			= $request->getParam('city');
		$state 			= $request->getParam('state');
		$country 		= $request->getParam('country');
		$zipcode 		= $request->getParam('zipcode');
		$modifiedby 	= $request->getParam('modifiedby');

		$sql = "UPDATE customeraddress SET
					houseno			= :houseno,
					addressline1	= :addressline1,
					addressline2	= :addressline2,
					state			= :state,
					city			= :city,
					country			= :country,
					zipcode			= :zipcode,
					modifiedby		= :modifiedby
				WHERE customerid = $id";


		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':houseno', 		$houseno);
			$stmt->bindParam(':addressline1', 	$addressline1);
			$stmt->bindParam(':addressline2', 	$addressline2);
			$stmt->bindParam(':city', 			$city);
			$stmt->bindParam(':state', 			$state);
			$stmt->bindParam(':country', 		$country);
			$stmt->bindParam(':zipcode', 		$zipcode);
			$stmt->bindParam(':modifiedby', 	$modifiedby);

			$stmt->execute();

			echo '{"notice": {"text": "Customer Address Updated!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Update Customer Address.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete a CustomerAddress
	$app->delete('/customeraddress/delete/{id}', 'deleteCustomerAddress');

	function deleteCustomerAddress(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "DELETE FROM customeraddress WHERE customeraddressid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			echo '{"notice": {"text": "Customer Address Deleted!"}';

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Customer Address.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};
	