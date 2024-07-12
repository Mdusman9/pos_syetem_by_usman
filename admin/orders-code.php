<?php

include('../config/function.php');

if(!isset($_SESSION['productItems'])){
	$_SESSION['productItems'] = [];
}
if(!isset($_SESSION['productItemIds'])){
	$_SESSION['productItemIds'] = [];
}

if(isset($_POST['addItem']))
{
      $productId = validate($_POST['product_id']);
       $quantity = validate($_POST['quantity']);

	$checkProduct = mysqli_query($conn, "SELECT * FROM products WHERE id='$productId' LIMIT 1");
	if($checkProduct){

		if(mysqli_num_rows($checkProduct) > 0){

			$row = mysqli_fetch_assoc($checkProduct);
			if($row['quantity'] < $quantity){
			redirect('orders-create.php','Only ' .$row['quantity']. ' quantity available!');
			}
			
			$productData = [
				'product_id' => $row['id'],
				'name' => $row['name'],
				'image' => $row['image'],
				'price' => $row['price'],
				'quantity' => $quantity
			];

			if(!in_array($row['id'], $_SESSION['productItemIds'])){

				array_push($_SESSION['productItemIds'],$row['id']);
				array_push($_SESSION['productItems'],$productData);

		   }else{

			foreach($_SESSION['productItems'] as $key => $prodSessionItem){
				if($prodSessionItem['product_id'] == $row['id']){

					$newquantity = $prodSessionItem['quantity'] + $quantity;

			$productData = [
				'product_id' => $row['id'],
				'name' => $row['name'],
				'image' => $row['image'],
				'price' => $row['price'],
				'quantity' => $newquantity,
         		];
			$_SESSION['productItems'][$key] = $productData;

				}

			}

		}

		redirect('orders-create.php','Item Added '.$row['name']);

	}else{

		redirect('orders-create.php','No such product found!');
	}

	}else{
		redirect('orders-create.php','Something Went Wrong!');
	}
}
if(isset($_POST['productInDec'])){
  $productId=validate(($_POST['product_id']));
  $quantity=validate(($_POST['quantity']));
  $flag=false;
  foreach($_SESSION['productItems'] as $key => $item){
	if($item['product_id']==$productId){
		$flag=true;
		$_SESSION['productItems'][$key]['quantity']=$quantity;

	}
  }
  if($flag){
	jsonResponce(200,'success','Quantity Updated');


  }else{
	jsonResponce(200,'error','Something went wrong refresh the page');
  }
}

if(isset($_POST['proceedToPlaceBtn']))
{   
	
	$phone = validate($_POST['cphone']);
	$payment_mode = validate($_POST['payment_mode']);

	// checking for customer 
	$checkCustomer = mysqli_query($conn, "SELECT * FROM customers WHERE phone='$phone' LIMIT 1");
	if($checkCustomer){
		if(mysqli_num_rows($checkCustomer) > 0)
		{
			$_SESSION['invoice_no'] = "INV-".rand(11111111,999999);
			$_SESSION['cphone'] = $phone;
			$_SESSION['payment_mode'] = $payment_mode;
			jsonResponce(200,'success','Customer Founded');
		}
		else
		{
			$_SESSION['cphone'] = $phone;
			jsonResponce(404,'warning','Customer not found');
		}
	}else{
		jsonResponce(500,'error','Something went wrong');
	}
}
if(isset($_POST['saveCustomerBtn'])){ 
      
	$name =validate($_POST['name']);
	$email =validate($_POST['email']);
	$phone =validate($_POST['phone']);
	if($name != ''&& $phone!='')
	{
        $data=[
           'name' => $name,
		   'phone' => $phone,
		   'email' => $email,

		];
		$result=insert('customers',$data);
		if($result){
			jsonResponce(200,'success','Customer Added Succesfully');
		}else{
            jsonResponce(500,'error','Something went Wrong');
		}
	}else{
		jsonResponce(422,'warning','Fill all Required Field');
	}
}
if(isset($_POST['saveOrder'])){
	$phone = validate($_SESSION['cphone']);
	$invoice_no = validate($_SESSION['invoice_no']);
	$payment_mode = validate($_SESSION['payment_mode']);
	$order_placed_by_id=$_SESSION['loggedInUser']['user_id'];
	$checkCustomer = mysqli_query($conn,"SELECT * FROM customers WHERE phone='$phone' LIMIT 1");
	if(!$checkCustomer){
		jsonResponce(500,'error','Something went wrong!');

	}
    if( mysqli_num_rows($checkCustomer)>0) {
	 	$customerData=mysqli_fetch_assoc($checkCustomer);
		if(!isset($_SESSION['productItems'])){
            jsonResponce(404,'warning','No items are there to place order');
		}
         $sessionProducts=$_SESSION['productItems'];
         $totalAmount=0;
		 foreach($sessionProducts as $item){
			$totalAmount+= $item['price']*$item['quantity'];
		 }
         

		$data=[
			'customer_id' => $customerData['id'],
			'tracking_no' => rand(111111,999999),
			'invoice_no' => $invoice_no ,
			'total_amount'=> $totalAmount,
			'order_date' => date('Y-m-d'),
			'order_status' => 'booked',
			'payment_mode' => $payment_mode,
			'order_placed_by_id' => $order_placed_by_id

		]; 
		$result =insert('orders',$data);
		$lastOrderId =mysqli_insert_id($conn);
		foreach($sessionProducts as $prodItem){
			$productId=$prodItem['product_id'];
			$price=$prodItem['price'];
			$quantity=$prodItem['quantity'];
			// inserting order item
			$dataOrderItem=[
				'order_id' => $lastOrderId,
				'product_id'=> $productId,
				'price'=> $price,
				'quantity'=> $quantity

			];
			$orderItemInsert = insert('order_items',$dataOrderItem);
			//Checking decreasing quantiy and ,making changer in tital iewls
			$checkProductQQ=mysqli_query($conn,"SELECT * FROM products WHERE id='$productId'");
			$productQtyData = mysqli_fetch_assoc($checkProductQQ);
			$totalProductQuantity = $productQtyData['quantity'] - $quantity;
			$dataUpdate=[
				'quantity'=>$totalProductQuantity,

			];
			$updateProductQty= update('products',$productId,$dataUpdate);
			
			
		 }
		 unset($_SESSION['productItems']);
		 unset($_SESSION['productItemIds']);
		 unset($_SESSION['cphone']);
		 unset($_SESSION['payment_mode']);
		 unset($_SESSION['invoice_no']);
		 jsonResponce(200,"success","Order PLaced Successfully");




	}else{
		jsonResponce(404,'warning','No customer found');
	}
	
}
?>