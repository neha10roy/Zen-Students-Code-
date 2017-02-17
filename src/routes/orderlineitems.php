<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add a OrderLineItems
	$app->post('/orderlineitems/add', 'addOrderlineItem');

	function addOrderlineItem(Request $request, Response $response){

		$orderid			= $request->getParam('orderid');
		$bookid 			= $request->getParam('bookid');
		$quantity 			= $request->getParam('quantity');
		$bookprice 			= $request->getParam('bookprice');
		$bookdiscount 		= $request->getParam('bookdiscount');
		$actualprice 		= $request->getParam('actualprice');
		$createdby 			= $request->getParam('createdby');

		$sql = "INSERT INTO orderlineitems (orderid, bookid, quantity, bookprice, bookdiscount, actualprice, createdby) VALUES (:orderid, :bookid, :quantity, :bookprice, :bookdiscount, :actualprice, :createdby)";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':orderid', 		$orderid);
			$stmt->bindParam(':bookid', 		$bookid);
			$stmt->bindParam(':quantity', 		$quantity);
			$stmt->bindParam(':bookprice', 		$bookprice);
			$stmt->bindParam(':bookdiscount', 	$bookdiscount);
			$stmt->bindParam(':actualprice', 	$actualprice);
			$stmt->bindParam(':createdby', 		$createdby);

			$stmt->execute();

			echo '{"notice": {"text": "Order Item Added!"}';						

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Order Items.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All OrderLineItems
	$app->get('/orderlineitems', 'getOrderlineItem');

	function getOrderlineItem(Request $request, Response $response){

		$sql = "SELECT orderid, bookid, quantity, bookprice, bookdiscount, actualprice FROM orderlineitems";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$orderlineitems = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($orderlineitems);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Order Items.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get Single OrderLineItems
	$app->get('/orderlineitems/{id}', 'getSingleOrderlineItem');

	function getSingleOrderlineItem(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT orderid, bookid, quantity, bookprice, bookdiscount, actualprice FROM orderlineitems WHERE orderlineitemid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$orderlineitems = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($orderlineitems);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Order Items.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update a OrderLineItems
	$app->put('/orderlineitems/update/{id}', 'updateOrderlineItem');

	function updateOrderlineItem(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$orderid			= $request->getParam('orderid');
		$bookid 			= $request->getParam('bookid');
		$quantity 			= $request->getParam('quantity');
		$bookprice 			= $request->getParam('bookprice');
		$bookdiscount 		= $request->getParam('bookdiscount');
		$actualprice 		= $request->getParam('actualprice');
		$modifiedby 		= $request->getParam('modifiedby');

		$sql = "UPDATE orderlineitems SET
					orderid			= :orderid,
					bookid			= :bookid,
					quantity		= :quantity,
					bookprice		= :bookprice,
					bookdiscount	= :bookdiscount,
					actualprice		= :actualprice,
					modifiedby		= :modifiedby
				WHERE orderlineitemid = $id";


		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':orderid', 		$orderid);
			$stmt->bindParam(':bookid', 		$bookid);
			$stmt->bindParam(':quantity', 		$quantity);
			$stmt->bindParam(':bookprice', 		$bookprice);
			$stmt->bindParam(':bookdiscount', 	$bookdiscount);
			$stmt->bindParam(':actualprice', 	$actualprice);
			$stmt->bindParam(':modifiedby', 	$modifiedby);

			$stmt->execute();

			echo '{"notice": {"text": "Order Item Updated!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Update Order Items.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete a OrderLineItem
	$app->delete('/orderlineitems/delete/{id}', 'deleteOrderlineItem');

	function deleteOrderlineItem(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "DELETE FROM orderlineitems WHERE orderlineitemid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			echo '{"notice": {"text": "Order Line Item Deleted!"}';

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Order Items.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};
	