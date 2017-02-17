<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add a OrderStatus
	$app->post('/orderstatus/add', 'addNewOrderStatus');

	function addNewOrderStatus(Request $request, Response $response){

		$orderdescription 	= $request->getParam('orderdescription');
		$createdby 			= $request->getParam('createdby');

		$sql = "INSERT INTO orderstatus (orderdescription, createdby) VALUES (:orderdescription, :createdby)";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':orderdescription', 	$orderdescription);
			$stmt->bindParam(':createdby', 			$createdby);

			$stmt->execute();

			echo '{"notice": {"text": "Order Status Added!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Order Status.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All OrderStatus
	$app->get('/orderstatus', 'getOrderStatus');

	function getOrderStatus(Request $request, Response $response){

		$sql = "SELECT orderstatusid, orderdescription, createddate FROM orderstatus";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

				$orderstatusid = $data['orderstatusid'];
				$orderdescription = $data['orderdescription'];

			// $db = null;

			echo json_encode($data);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Order Status.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};



	// Get Single OrderStatus
	$app->get('/orderstatus/{id}', 'getSingleOrderStatus');

	function getSingleOrderStatus(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT orderstatusid, orderdescription, createddate FROM orderstatus WHERE orderstatusid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$orderstatus = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($orderstatus);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Order Status.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update an OrderStatus
	$app->put('/orderstatus/update/{id}', 'updateOrderStatus');

	function updateOrderStatus(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$orderdescription 	= $request->getParam('orderdescription');
		$modifiedby 		= $request->getParam('modifiedby');

		$sql = "UPDATE orderstatus SET
					orderdescription	= :orderdescription,
					modifiedby			= :modifiedby
				WHERE orderstatusid = $id";


		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':orderdescription', 	$orderdescription);
			$stmt->bindParam(':modifiedby', 		$modifiedby);

			$stmt->execute();

			echo '{"notice": {"text": "Order Status Updated!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Update Order Status.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete an OrderStatus
	$app->delete('/orderstatus/delete/{id}', 'deleteOrderStatus');

	function deleteOrderStatus(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "DELETE FROM orderstatus WHERE orderstatusid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			echo '{"notice": {"text": "Order Status Deleted!"}';

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Order Status.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};
	