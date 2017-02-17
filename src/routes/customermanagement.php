<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;

	require 'customer.php';

	$app->post('/registercustomer', 'registerCustomer');

	function registerCustomer(Request $request, Response $response)
	{

		$db = db::getInstance();

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

		$sql1 = "INSERT INTO customer (customername, customertypeid, dateofbirth, lastlogindate, userid, password, secretquestion, secretanswer, mobileno, emailaddress, createdby) VALUES (:customername, :customertypeid, :dateofbirth, :lastlogindate, :userid, :password, :secretquestion, :secretanswer, :mobileno, :emailaddress, :createdby)";

		$houseno		= $request->getParam('houseno');
		$addressline1	= $request->getParam('addressline1');
		$addressline2	= $request->getParam('addressline2');
		$city 			= $request->getParam('city');
		$state 			= $request->getParam('state');
		$country 		= $request->getParam('country');
		$zipcode 		= $request->getParam('zipcode');

		$sql2 = "INSERT INTO customeraddress (customeraddressid, houseno, addressline1, addressline2, city, state, country, zipcode, createdby) VALUES (:customeraddressid, :houseno, :addressline1, :addressline2, :city, :state, :country, :zipcode, :createdby)";

		try {

			$db = $db->connect();

			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$db->beginTransaction();

			$stmt = $db->prepare($sql1);

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

			$customeraddressid = $db->lastInsertId();

			$stmt = $db->prepare($sql2);

			$stmt->bindParam(':customeraddressid', 	$customeraddressid);
			$stmt->bindParam(':houseno', 			$houseno);
			$stmt->bindParam(':addressline1', 		$addressline1);
			$stmt->bindParam(':addressline2', 		$addressline2);
			$stmt->bindParam(':city', 				$city);
			$stmt->bindParam(':state', 				$state);
			$stmt->bindParam(':country', 			$country);
			$stmt->bindParam(':zipcode', 			$zipcode);
			$stmt->bindParam(':createdby', 			$createdby);

			$stmt->execute();

			$db->commit();

			echo "Customer Registered Successfully!";

		} catch(PDOException $e) {

			$db->rollBack();

			echo "An error occured!";

		}


	}




