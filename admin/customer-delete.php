<?php
  require '../config/function.php';
  $paraResult=checkParamId('id');
 if(is_numeric($paraResult)){
    $customersId=validate($paraResult);
    $customers =getById('customers',$customersId);
    if($customers['status']==200)
    {
        $response=delete('customers',$customersId);
        if($response){
            redirect('customer.php','Category Deleted Succesfully');
           
        }else{
            redirect('customer.php','Something went wrong');
        }
    }else{
        redirect('customer.php',$customers['message']); 
    }
    //echo $adminId;


 }else{
    redirect('customer.php','Something went wrong');
 }            
?>