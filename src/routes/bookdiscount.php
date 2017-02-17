<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add an BookDiscount
	$app->post('/bookdiscount/add', 'addBookDiscount');

	function addBooksDiscount(Request $request, Response $response){

		$bookid				= $request->getParam('bookid');
		$discountamount 	= $request->getParam('discountamount');
		$validfrom 			= $request->getParam('validfrom');
		$validto 			= $request->getParam('validto');
		$createdby 			= $request->getParam('createdby');

		$sql = "INSERT INTO bookdiscount (bookid, discountamount, validfrom, validto, createdby) VALUES (:bookid, :discountamount, :validfrom, :validto, :createdby)";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':bookid', 			$bookid);
			$stmt->bindParam(':discountamount', 	$discountamount);
			$stmt->bindParam(':validfrom', 			$validfrom);
			$stmt->bindParam(':validto', 			$validto);
			$stmt->bindParam(':createdby', 			$createdby);

			$stmt->execute();

			echo '{"notice": {"text": "Book Discount Added!"}';						

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Book Discount.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All BookDiscount
	$app->get('/bookdiscount', 'getBookDiscount');

	function getBooksDiscount(Request $request, Response $response){

		$sql = "SELECT bookdiscountid, bookid, discountamount, validfrom, validto FROM bookdiscount";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$bookdiscount = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($bookdiscount);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Book Discount.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get Single BookDiscount
	$app->get('/bookdiscount/{id}', 'getSingleBookDiscount');

	function getSingleBookDiscount(Request $request, Response $response, $discountamount){

		$id = $request->getAttribute('id');

		$sql = "SELECT bookdiscountid, bookid, discountamount, validfrom, validto FROM bookdiscount WHERE bookdiscountid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$bookdiscount = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($bookdiscount);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Book Discount.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update a BookDiscount
	$app->put('/bookdiscount/update/{id}', 'updateBookDiscount');

	function updateBookDiscount(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$bookid				= $request->getParam('bookid');
		$discountamount 	= $request->getParam('discountamount');
		$validfrom 			= $request->getParam('validfrom');
		$validto 			= $request->getParam('validto');
		$modifiedby 		= $request->getParam('modifiedby');

		$sql = "UPDATE bookdiscount SET
					bookid			= :bookid,
					discountamount	= :discountamount,
					validfrom		= :validfrom,
					modifiedby		= :modifiedby,
					validto			= :validto
				WHERE bookdiscountid = $id";


		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':bookid', 			$bookid);
			$stmt->bindParam(':discountamount', 	$discountamount);
			$stmt->bindParam(':validfrom', 			$validfrom);
			$stmt->bindParam(':modifiedby', 		$modifiedby);
			$stmt->bindParam(':validto', 			$validto);

			$stmt->execute();

			echo '{"notice": {"text": "Book Discount Updated!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Update Book Discount.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete a BookDiscount
	$app->delete('/bookdiscount/delete/{id}', 'deleteBookDiscount');

	function deleteBookDiscount(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "DELETE FROM bookdiscount WHERE bookdiscountid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			echo '{"notice": {"text": "Book Discount Deleted!"}';

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Book Discount.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};
	