<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;



	// Add a Book
	$app->post('/book/add', 'addBook');

	function addBook(Request $request, Response $response){

		$bookname 		= $request->getParam('bookname');
		$categoryid 	= $request->getParam('categoryid');
		$authorname 	= $request->getParam('authorname');
		$isbn 			= $request->getParam('isbn');
		$publishdate 	= $request->getParam('publishdate');
		$isupdate 		= $request->getParam('isupdate');
		$isdvdavailable = $request->getParam('isdvdavailable');
		$issearchable 	= $request->getParam('issearchable');
		$bookprice 		= $request->getParam('bookprice');
		$currentstock 	= $request->getParam('currentstock');
		$createdby 		= $request->getParam('createdby');

		$sql = "INSERT INTO book (bookname, categoryid, authorname, isbn, publishdate, isupdate, isdvdavailable, issearchable, bookprice, currentstock, createdby) VALUES (:bookname, :categoryid, :authorname, :isbn, :publishdate, :isupdate, :isdvdavailable, :issearchable, :bookprice, :currentstock, :createdby)";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':bookname', 		$bookname);
			$stmt->bindParam(':categoryid', 	$categoryid);
			$stmt->bindParam(':authorname', 	$authorname);
			$stmt->bindParam(':isbn', 			$isbn);
			$stmt->bindParam(':publishdate', 	$publishdate);
			$stmt->bindParam(':isupdate', 		$isupdate);
			$stmt->bindParam(':isdvdavailable', $isdvdavailable);
			$stmt->bindParam(':issearchable', 	$issearchable);
			$stmt->bindParam(':bookprice', 		$bookprice);
			$stmt->bindParam(':currentstock', 	$currentstock);
			$stmt->bindParam(':createdby', 		$createdby);

			$stmt->execute();

			echo '{"notice": {"text": "Book Added!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Add Book.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get All Books
	$app->get('/book', 'getAllBooks');

	function getAllBooks(Request $request, Response $response){

		$sql = "SELECT bookid, bookname, categoryid, isbn, authorname, bookprice, isdvdavailable, currentstock, publishdate FROM book WHERE issearchable = 1 AND isupdate = 1";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$book = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($book);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Book.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};



	// Get Books Based on Category
	$app->get('/categorybook/{id}', 'getBooksBasedOnCategory');

	function getBooksBasedOnCategory(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT bookid, bookname, categoryid, isbn, authorname, bookprice, isdvdavailable, currentstock, publishdate FROM book WHERE categoryid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$book = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($book);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Book.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get Books Based on Category
	$app->get('/searchbook/{a}', 'getBooksBasedOnSearch');

	function getBooksBasedOnSearch(Request $request, Response $response){

		$a = $request->getAttribute('a');

		$sql = "SELECT bookid, bookname, categoryid, isbn, authorname, bookprice, isdvdavailable, currentstock, publishdate FROM book WHERE 
			bookname LIKE '%".$a."%' OR 
			authorname LIKE '%".$a."%' OR 
			isbn LIKE '%".$a."%' OR 
			publishdate LIKE '%".$a."%' OR 
			bookprice LIKE '%".$a."%' ";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$book = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($book);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Book.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Get Single Book
	$app->get('/book/{id}', 'getSingleBook');

	function getSingleBook(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$sql = "SELECT bookid, bookname, categoryid, isbn, authorname, bookprice, isdvdavailable, currentstock, publishdate FROM book WHERE bookid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->query($sql);

			$book = $stmt->fetchAll(PDO::FETCH_OBJ);

			$db = null;

			echo json_encode($book);

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Load Book.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Update a Book
	$app->put('/book/update/{id}', 'updateBook');

	function updateBook(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$bookname 		= $request->getParam('bookname');
		$categoryid 	= $request->getParam('categoryid');
		$authorname 	= $request->getParam('authorname');
		$isbn 			= $request->getParam('isbn');
		$publishdate 	= $request->getParam('publishdate');
		$isupdate 		= $request->getParam('isupdate');
		$isdvdavailable = $request->getParam('isdvdavailable');
		$issearchable 	= $request->getParam('issearchable');
		$bookprice 		= $request->getParam('bookprice');
		$currentstock 	= $request->getParam('currentstock');
		$modifiedby 	= $request->getParam('modifiedby');

		$sql = "UPDATE book SET
					bookname		= :bookname,
					categoryid		= :categoryid,
					authorname		= :authorname,
					isbn			= :isbn,
					publishdate		= :publishdate,
					isupdate		= :isupdate,
					isdvdavailable	= :isdvdavailable,
					issearchable	= :issearchable,
					bookprice		= :bookprice,
					currentstock	= :currentstock,
					modifiedby		= :modifiedby
				WHERE bookid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->bindParam(':bookname', 		$bookname);
			$stmt->bindParam(':categoryid', 	$categoryid);
			$stmt->bindParam(':authorname', 	$authorname);
			$stmt->bindParam(':isbn', 			$isbn);
			$stmt->bindParam(':publishdate', 	$publishdate);
			$stmt->bindParam(':isupdate', 		$isupdate);
			$stmt->bindParam(':isdvdavailable', $isdvdavailable);
			$stmt->bindParam(':issearchable', 	$issearchable);
			$stmt->bindParam(':bookprice', 		$bookprice);
			$stmt->bindParam(':currentstock', 	$currentstock);
			$stmt->bindParam(':modifiedby', 	$modifiedby);

			$stmt->execute();

			echo '{"notice": {"text": "Book Updated!"}';			
			

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Update Book.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};




	// Delete a Book
	$app->put('/book/delete/{id}', 'deleteBook');

	function deleteBook(Request $request, Response $response){

		$id = $request->getAttribute('id');

		$issearchable 	= $request->getParam('issearchable');

		$sql = "UPDATE book SET

				issearchable = 0

				WHERE bookid = $id";

		try{

			// Get Database Instance
			$db = db::getInstance();

			// Connect to Database
			$db = $db->connect();

			$stmt = $db->prepare($sql);

			$stmt->execute();

			$db = null;

			echo '{"notice": {"text": "Book Deleted!"}';

		} catch(PDOException $e){

			echo '{"error": {"text": '.$e->error_log("Somthing is wrong. Can't Delete Book.", 0).'}';

		}

		$close = new db();
		// this will close connection
		$close->disconnect();
	};
	
