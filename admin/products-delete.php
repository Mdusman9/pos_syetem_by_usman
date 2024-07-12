<?php
  require '../config/function.php';
  $paraResult=checkParamId('id');
 if(is_numeric($paraResult)){
    $productsId=validate($paraResult);
    $products =getById('products',$productsId);
    if($products['status']==200)
    {
        $productsData=delete('products',$productsId);
        if($productsData){
            $deleteImage="../".$products['data']['image'];
          if(file_exists($deleteImage)){
             unlink($deleteImage);
         
           }
            redirect('products.php','products Deleted Succesfully');
           
        }else{
            redirect('products.php','Something went wrong');
        }
    }else{
        redirect('products.php',$products['message']); 
    }
    //echo $adminId;


 }else{
    redirect('products.php','Something went wrong');
 }            
?>