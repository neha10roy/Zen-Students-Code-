<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add an Order
	$app->post('/order/add', 'addOrder');

	function addOrder(Request $request, Response $response){

		$ordernumber 		= $request->getParam('ordernumber');
		$customerid 		= $request->getParam('customerid');
		$orderstatusid 		= $request->getParam('orderstatusid');
		$paymentmode 		= $request->getParam('paymentmode');
		$ordertotalprice 	= $request->getParam('ordertotalprice');
		$totaldiscount 		= $request->getParam('totaldiscount');
		$paymentfulfilled 	= $request->getParam('paymentfulfilled');
		$streetno 			= $request->getParam('streetno');
		$addressline1 		= $request->getParam('addressline1');
		$addressline2 		= $request->getParam('addressline2');
		$city 				= $request->getParam('city');
		$state 				= $request->getParam('state');
		$country 			= $request->getParam('country');
		$phoneno 			= $request->getParam('phoneno');
		$createdby 			= $request->getParam('createdby');
		$subscriberid 		= $request->getParam('subscriberid');

		$sql = "INSERT INTO `order` (ordernumber, customerid, orderstatusid, paymentmode, ordertotalprice, totaldiscount, paymentfulfilled, streetno, addressline1, addressline2, city, state, country, phoneno, createdby, subscriberid) VALUES (:ordernumber, :customerid, :orderstatusid, :paymentmode, :ordertotalprice, :totaldiscount, :paymentfulfilled, :streetno, :addressline1, :addressline2, :city, :state, :country, :phoneno, :createdby, :subscriberid)";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':ordernumber', 		$ordernumber);
			$stmt->bindParam(':customerid', 		$customerid);
			$stmt->bindParam(':orderstatusid', 		$orderstatusid);
			$stmt->bindParam(':paymentmode', 		$paymentmode);
			$stmt->bindParam(':ordertotalprice', 	$ordertotalprice);
			$stmt->bindParam(':totaldiscount', 	  	$totaldiscount);
			$stmt->bindParam(':paymentfulfilled', 	$paymentfulfilled);
			$stmt->bindParam(':streetno', 			$streetno);
			$stmt->bindParam(':addressline1', 		$addressline1);
			$stmt->bindParam(':addressline2', 		$addressline2);
			$stmt->bindParam(':city', 				$city);
			$stmt->bindParam(':state', 				$state);
			$stmt->bindParam(':country', 			$country);
			$stmt->bindParam(':phoneno', 			$phoneno);
			$stmt->bindParam(':createdby', 			$createdby);
			$stmt->bindParam(':subscriberid', 		$subscriberid);

			$stmt->execute();

			echo '{"notice": {"text": "Order Added!"}';	
			// echo "<scrip t>alert('Costumer Added Successfully!');</script>";		
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Order.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All Orders
	$app->get('/order', 'getAllOrder');

	function getAllOrder(Request $request, Response $response){

		$sql = "SELECT orderid, ordernumber, customerid, orderstatusid, paymentmode, ordertotalprice, totaldiscount, paymentfulfilled, streetno, addressline1, addressline2, city, state, country FROM `order`;";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$order = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($order);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Order.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};


	// Get All Orders
	$app->get('/ordercustomer/{id}', 'getOrderForCustomer');

	function getOrderForCustomer(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT orderid, ordernumber, customerid, orderstatusid, paymentmode, ordertotalprice, totaldiscount FROM `order` WHERE customerid = $id;";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$order = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($order);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Order.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};



	// Get Single Order
	$app->get('/order/{id}', 'getSingleOrder');

	function getSingleOrder(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT orderid, ordernumber, customerid, orderstatusid, paymentmode, ordertotalprice, totaldiscount, paymentfulfilled, streetno, addressline1, addressline2, city, state, country  FROM `order` WHERE orderid = $id;";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$order = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($order);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Order.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update a Order
	$app->put('/order/update/{id}', 'updateOrder');

	function updateOrder(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$ordernumber 		= $request->getParam('ordernumber');
		$customerid 		= $request->getParam('customerid');
		$orderstatusid 		= $request->getParam('orderstatusid');
		$paymentmode 		= $request->getParam('paymentmode');
		$ordertotalprice 	= $request->getParam('ordertotalprice');
		$totaldiscount 		= $request->getParam('totaldiscount');
		$paymentfulfilled 	= $request->getParam('paymentfulfilled');
		$streetno 			= $request->getParam('streetno');
		$addressline1 		= $request->getParam('addressline1');
		$addressline2 		= $request->getParam('addressline2');
		$city 				= $request->getParam('city');
		$state 				= $request->getParam('state');
		$country 			= $request->getParam('country');
		$phoneno 			= $request->getParam('phoneno');
		$modifiedby 		= $request->getParam('modifiedby');
		$subscriberid 		= $request->getParam('subscriberid');

		$sql = "UPDATE `order` SET
					ordernumber			= :ordernumber,
					customerid			= :customerid,
					orderstatusid		= :orderstatusid,
					paymentmode			= :paymentmode,
					ordertotalprice		= :ordertotalprice,
					totaldiscount		= :totaldiscount,
					paymentfulfilled	= :paymentfulfilled,
					streetno			= :streetno,
					addressline1		= :addressline1,
					addressline2		= :addressline2,
					city				= :city,
					state				= :state,
					country				= :country,
					phoneno				= :phoneno,
					modifiedby			= :modifiedby,
					subscriberid		= :subscriberid
				WHERE orderid = $id;";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':ordernumber', 		$ordernumber);
			$stmt->bindParam(':customerid', 		$customerid);
			$stmt->bindParam(':orderstatusid', 		$orderstatusid);
			$stmt->bindParam(':paymentmode', 		$paymentmode);
			$stmt->bindParam(':ordertotalprice', 	$ordertotalprice);
			$stmt->bindParam(':totaldiscount', 		$totaldiscount);
			$stmt->bindParam(':paymentfulfilled', 	$paymentfulfilled);
			$stmt->bindParam(':streetno', 			$streetno);
			$stmt->bindParam(':addressline1', 		$addressline1);
			$stmt->bindParam(':addressline2', 		$addressline2);
			$stmt->bindParam(':city', 				$city);
			$stmt->bindParam(':state', 				$state);
			$stmt->bindParam(':country', 			$country);
			$stmt->bindParam(':phoneno', 			$phoneno);
			$stmt->bindParam(':modifiedby', 		$modifiedby);
			$stmt->bindParam(':subscriberid', 		$subscriberid);

			$stmt->execute();

			echo '{"notice": {"text": "Order Updated!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Update Order.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete an Order
/*	$app->delete('/order/delete/{id}', 'deleteOrder');

	function deleteOrder(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "DELETE FROM `order` WHERE orderid = $id;";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			echo '{"notice": {"text": "Order Deleted!"}';

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Order.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	}; 

	*/
	