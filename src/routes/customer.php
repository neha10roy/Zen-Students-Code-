<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add a Customer
	$app->post('/customer/add', 'addNewCustomer');

	function addNewCustomer(Request $request, Response $response){

		$customername 		= $request->getParam('customername');
		$customertypeid 	= $request->getParam('customertypeid');
		$dateofbirth 		= $request->getParam('dateofbirth');
		$lastlogindate 		= $request->getParam('lastlogindate');
		$userid 			= $request->getParam('userid');
		$password 			= $request->getParam('password');
		$secretquestion 	= $request->getParam('secretquestion');
		$secretanswer 		= $request->getParam('secretanswer');
		$mobileno 			= $request->getParam('mobileno');
		$emailaddress 		= $request->getParam('emailaddress');
		$createdby 			= $request->getParam('createdby');

		$sql = "INSERT INTO customer (customername, customertypeid, dateofbirth, lastlogindate, userid, password, secretquestion, secretanswer, mobileno, emailaddress, createdby) VALUES (:customername, :customertypeid, :dateofbirth, :lastlogindate, :userid, :password, :secretquestion, :secretanswer, :mobileno, :emailaddress, :createdby)";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':customername', 		$customername);
			$stmt->bindParam(':customertypeid', 	$customertypeid);
			$stmt->bindParam(':dateofbirth', 		$dateofbirth);
			$stmt->bindParam(':lastlogindate', 		$lastlogindate);
			$stmt->bindParam(':userid', 			$userid);
			$stmt->bindParam(':password', 			$password);
			$stmt->bindParam(':secretquestion', 	$secretquestion);
			$stmt->bindParam(':secretanswer', 		$secretanswer);
			$stmt->bindParam(':mobileno', 			$mobileno);
			$stmt->bindParam(':emailaddress', 		$emailaddress);
			$stmt->bindParam(':createdby', 			$createdby);

			$stmt->execute();

			

			echo '{"notice": {"text": "Customer Added!"}';	
			// echo "<scrip t>alert('Costumer Added Successfully!');</script>";	

			// return $response->withHeader(
			// 	'Content-Type',
			// 	'application/json'
			// 	);	
			

		} catch(PDOException $e){

			error_log("Somthing is wrong. Can't Add Customer.", 0);

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All Customers
	$app->get('/customer', 'getCustomer');

	function getCustomer(Request $request, Response $response){

		$sql = "SELECT customername, customertypeid, dateofbirth, userid, mobileno, emailaddress FROM customer;";

		// Get Database Instance
		$db = db::getInstance();

		try{

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$customer = $stmt->fetchAll(PDO::FETCH_OBJ);

			echo json_encode($customer);

		} catch(PDOException $e){

			error_log("Somthing is wrong. Can't Load Customers.", 0);

		}

		$db->disconnect();


	};




	// Get Single Customer
	$app->get('/customer/{id}', 'getSingleCustomerId');

	function getSingleCustomerId(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT customername, customertypeid, dateofbirth, userid, mobileno, emailaddress FROM customer WHERE customerid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$customer = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($customer);

		} catch(PDOException $e){

			error_log("Somthing is wrong. Can't Load Customer.", 0);

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update a Customer
	$app->put('/customer/update/{id}', 'updateCustomer');

	function updateCustomer(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$customername 		= $request->getParam('customername');
		$customertypeid 	= $request->getParam('customertypeid');
		$dateofbirth 		= $request->getParam('dateofbirth');
		$lastlogindate 		= $request->getParam('lastlogindate');
		$userid 			= $request->getParam('userid');
		$password 			= $request->getParam('password');
		$secretquestion 	= $request->getParam('secretquestion');
		$secretanswer 		= $request->getParam('secretanswer');
		$mobileno 			= $request->getParam('mobileno');
		$emailaddress 		= $request->getParam('emailaddress');
		$modifiedby 		= $request->getParam('modifiedby');

		$sql = "UPDATE customer SET
					customername		= :customername,
					customertypeid		= :customertypeid,
					dateofbirth			= :dateofbirth,
					lastlogindate		= :lastlogindate,
					userid				= :userid,
					password			= :password,
					secretquestion		= :secretquestion,
					secretanswer		= :secretanswer,
					mobileno			= :mobileno,
					emailaddress		= :emailaddress,
					modifiedby			= :modifiedby
				WHERE customerid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':customername', 		$customername);
			$stmt->bindParam(':customertypeid', 	$customertypeid);
			$stmt->bindParam(':dateofbirth', 		$dateofbirth);
			$stmt->bindParam(':lastlogindate', 		$lastlogindate);
			$stmt->bindParam(':userid', 			$userid);
			$stmt->bindParam(':password', 			$password);
			$stmt->bindParam(':secretquestion', 	$secretquestion);
			$stmt->bindParam(':secretanswer', 		$secretanswer);
			$stmt->bindParam(':mobileno', 			$mobileno);
			$stmt->bindParam(':emailaddress', 		$emailaddress);
			$stmt->bindParam(':modifiedby', 		$modifiedby);

			$stmt->execute();

			echo '{"notice": {"text": "Customer Updated!"}';			
			

		} catch(PDOException $e){

			error_log("Somthing is wrong. Can't Update Customer.", 0);

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete a Customer
	// $app->delete('/customer/delete/{id}', 'deleteCustomer');

	// function deleteCustomer(Request $request, Response $response){

	// 	$id = $request->getAttribute('id');

	// 	$sql = "DELETE FROM customer WHERE customerid = $id";

	// 	try{

	// 		// Get Database Instance
	// 		$db = db::getInstance();

	// 		// Connect to Database
	// 		$db = $db->connect();

	// 		$stmt = $db->prepare($sql);

	// 		$stmt->execute();

	// 		$close->disconnect();

	// 		echo '{"notice": {"text": "Customer Deleted!"}';

	// 	} catch(PDOException $e){

	// 		error_log("Somthing is wrong. Can't Delete Customer.", 0);

	// 	}
	// };
	