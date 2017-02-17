<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add a Category
	$app->post('/category/add', 'addCategory');

	function addCategory(Request $request, Response $response){

		$categoryname = $request->getParam('categoryname');
		$isactive = $request->getParam('isactive');
		$createdby = $request->getParam('createdby');

		$sql = "INSERT INTO category (categoryname, isactive, createdby) VALUES (:categoryname, :isactive, :createdby)";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':categoryname', 	$categoryname);
			$stmt->bindParam(':isactive', 		$isactive);
			$stmt->bindParam(':createdby', 		$createdby);

			$stmt->execute();

			echo '{"notice": {"text": "Category Added!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Category.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All Categories
	$app->get('/category', 'getCategory');

	function getCategory(Request $request, Response $response){

		$sql = "SELECT categoryid, categoryname, isactive FROM category";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$category = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($category);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Category.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get Single Category
	$app->get('/category/{id}', 'getSingleCategory');

	function getSingleCategory(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT categoryid, categoryname, isactive FROM category WHERE categoryid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$category = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($category);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Category.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update a Category
	$app->put('/category/update/{id}', 'updateCategory');

	function updateCategory(Request $request, Response $response){

		$id 		= $request->getAttribute('id');

		$categoryname 	= $request->getParam('categoryname');
		$isactive 		= $request->getParam('isactive');
		$modifiedby 	= $request->getParam('modifiedby');

		$sql = "UPDATE category SET
					categoryname	= :categoryname,
					isactive		= :isactive,
					modifiedby		= :modifiedby
				WHERE categoryid = $id";


		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':categoryname', 	$categoryname);
			$stmt->bindParam(':isactive', 		$isactive);
			$stmt->bindParam(':modifiedby', 	$modifiedby);

			$stmt->execute();

			echo '{"notice": {"text": "Category Updated!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Update Category.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete a Category
	$app->put('/category/delete/{id}', 'deleteCategory');

	function deleteCategory(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$isactive = $request->getParam('isactive');

		$sql = "UPDATE category SET 

				isactive = 0

				WHERE categoryid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();
			
			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			echo '{"notice": {"text": "Category Deleted!"}';

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Category.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};
	
