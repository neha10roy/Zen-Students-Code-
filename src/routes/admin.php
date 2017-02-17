<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	$app = new \Slim\App;

	require 'category.php';
	require 'book.php';
	require 'bookdiscount.php';
	require 'alerttype.php';
	require 'alert.php';
	require 'paymentmode.php';
	require 'customertype.php';
	require 'orderstatus.php';
	require 'booksubscriber.php';
	require 'area.php';
	require 'customer.php';
	require 'order.php';


	// Add a New Category
	$app->post('/addcategory', 'addCategoryDetails');

	function addCategoryDetails(Request $request, Response $response)
	{
		echo addCategory($request, $response);
	};


	// Get All Ctegories
	$app->get('/getcategory', 'getCategoryDetails');

	function getCategoryDetails(Request $request, Response $response)
	{
		echo getCategory($request, $response);
	};


	// Edit a Category
	$app->put('/editcategory/{id}', 'editCategoryDetails');

	function editCategoryDetails(Request $request, Response $response)
	{
		echo updateCategory($request, $response);
	};


	// Add a Book
	$app->post('/addbook', 'addBookDetails');

	function addBookDetails(Request $request, Response $response)
	{
		echo addBook($request, $response);
	};

	// Get All Books
	$app->get('/getallbook', 'getBookDetails');

	function getBookDetails(Request $request, Response $response)
	{
		echo getAllBooks($request, $response);
	};

	// Edit a Book
	$app->put('/editbook/{id}', 'editBook');

	function editBook(Request $request, Response $response)
	{
		echo updateBook($request, $response);
	};
	

	// Add Customer
	$app->post('/addcustomer', 'addCustomer');

	function addCustomer(Request $request, Response $response)
	{
		echo addNewCustomer($request, $response);
	}

	// Get Customer
	$app->get('/getcustomer', 'getAllCustomer');

	function getAllCustomer(Request $request, Response $response)
	{
		echo getCustomer($request, $response);
	}

	// Get Single Customer
	$app->get('/getcustomer/{id}', 'getSingleCustomer');

	function getSingleCustomer(Request $request, Response $response)
	{
		echo getSingleCustomerId($request, $response);
	}

	// Edit Customer
	$app->get('/editcustomer/{id}', 'editCustomer');

	function editCustomer(Request $request, Response $response)
	{
		echo updateCustomer($request, $response);
	}


	// Get Order
	$app->get('/getorder', 'getOrder');

	function getOrder(Request $request, Response $response)
	{
		echo getAllOrder($request, $response);
	}

	// Get Single Order
	$app->get('/getorder/{id}', 'getParticularOrder');

	function getParticularOrder(Request $request, Response $response)
	{
		echo getSingleOrder($request, $response);
	}


	// Add Book Discount
	$app->post('/addbookdiscount', 'addBookDiscount');

	function addBookDiscount(Request $request, Response $response, $bookdiscount)
	{
		echo addBooksDiscount($request, $response);
		return $bookdiscount;	
	};

	// Get Book Discount
	$app->get('/getbookdiscount', 'getAllBookDiscount');

	function getAllBookDiscount(Request $request, Response $response, $discountamount)
	{
		echo getBooksDiscount($request, $response);	
		return $discountamount;
	};

	// Edit Book Discount
	$app->put('/editbookdiscount/{id}', 'editBookDiscount');

	function editBookDiscount(Request $request, Response $response)
	{
		echo updateBookDiscount($request, $response);	
	};


	// Add Alert Type
	$app->post('/addalerttype', 'addAlertType');

	function addAlertType(Request $request, Response $response)
	{
		echo addNewAlertType($request, $response);	
	};

	// Get Alert Type
	$app->get('/getalerttype', 'getAllAlertType');

	function getAllAlertType(Request $request, Response $response)
	{
		echo getAlertType($request, $response);	
	};

	// Edit Alert Type
	$app->put('/editalerttype/{id}', 'editAlertType');

	function editAlertType(Request $request, Response $response)
	{
		echo updateAlertType($request, $response);	
	};


	// Get Alert
	$app->get('/getalert', 'getAlert');

	function getAlert(Request $request, Response $response, $alertid)
	{
		echo getAllAlert($request, $response);
		return $alertid;
	};


	// Add New Payment Option
	$app->post('/addpaymentmode', 'addPaymentOption');

	function addPaymentOption(Request $request, Response $response)
	{
		echo addPaymentMode($request, $response);
	};

	// Get Payment Options
	$app->get('/getpaymentmode', 'getAllPaymentOptions');

	function getAllPaymentOptions(Request $request, Response $response)
	{
		echo getpaymentMode($request, $response);

	};

	// Get Payment Options by ID
	$app->get('/getpaymentmode/{id}', 'getPaymentOptionsId');

	function getPaymentOptionsId(Request $request, Response $response, $paymentmodeid)
	{
		echo getSinglePaymentMode($request, $response);
		return $paymentmodeid;

	};

	// Edit Payment Mode
	$app->put('/editpaymentmode/{id}', 'editPaymentOption');

	function editPaymentOption(Request $request, Response $response)
	{
		echo updatePaymentMode($request, $response);
	};


	// Add Customer Type
	$app->post('/addcustomertype', 'addCustomerType');

	function addCustomerType(Request $request, Response $response)
	{
		echo addNewCustomerType($request, $response);
	}

	// Get Customer Type
	$app->get('/getcustomertype', 'getAllCustomerType');

	function getAllCustomerType(Request $request, Response $response)
	{
		echo getCustomerType($request, $response);
	}

	// Get Customer Type Id
	$app->get('/getcustomertypeid', 'getAllCustomerTypeId');

	function getAllCustomerTypeId(Request $request, Response $response)
	{
		echo getCustomerTypeId($request, $response);
	}

	// Edit Customer Type
	$app->get('/editcustomertype', 'editCustomerType');

	function editCustomerType(Request $request, Response $response)
	{
		echo updateCustomerType($request, $response);
	}


	// Add Order Status
	$app->post('/addorderstatus', 'addOrderStatus');

	function addOrderStatus(Request $request, Response $response)
	{
		echo addNewOrderStatus($request, $response);
	}
	
	// Get Order Status
	$app->get('/getorderstatus', 'getAllOrderStatus');

	function getAllOrderStatus(Request $request, Response $response)
	{
		echo getOrderStatus($request, $response);
	}

	// Edit Order Status
	$app->put('/editorderstatus', 'editOrderStatus');

	function editOrderStatus(Request $request, Response $response)
	{
		echo updateOrderStatus($request, $response);
	}


	// Add Book Store Subscriber
	$app->post('/addbooksubscriber', 'addBookStoreSubscriber');

	function addBookStoreSubscriber(Request $request, Response $response)
	{
		echo addBookSubscriber($request, $response);
	}

	// Get Book Store Subscriber
	$app->get('/getbooksubscriber', 'getBookStoreSubscriber');

	function getBookStoreSubscriber(Request $request, Response $response)
	{
		echo getBookSubscriber($request, $response);
	}

	// Edit Book Store Subscriber
	$app->put('/editbooksubscriber/{id}', 'editBookStoreSubscriber');

	function editBookStoreSubscriber(Request $request, Response $response)
	{
		echo updateBookSubscriber($request, $response);
	}

	// Delete Book Subscriber
	$app->put('/deletebooksubscriber/{id}', 'deleteSubscriber');

	function deleteSubscriber(Request $request, Response $response)
	{
		echo deleteBookSubscriber($request, $response);
	}


	// Add Delivery Area
	$app->post('/adddeliveryarea', 'addDeliveryArea');

	function addDeliveryArea(Request $request, Response $response)
	{
		echo addArea($request, $response);
	}

	// Get Delivery Area
	$app->get('/getdeliveryarea', 'getAllDeliveryArea');

	function getAllDeliveryArea(Request $request, Response $response)
	{
		echo getArea($request, $response);
	}

	// Edit Delivery Area
	$app->put('/editdeliveryarea', 'editDeliveryArea');

	function editDeliveryArea(Request $request, Response $response)
	{
		echo updateArea($request, $response);
	}



// User Login
