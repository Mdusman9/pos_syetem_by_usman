<?php
  require '../config/function.php';
  $paraResult=checkParamId('id');
 if(is_numeric($paraResult)){
    $categoryId=validate($paraResult);
    $category =getById('categories',$categoryId);
    if($category['status']==200)
    {
        $categoryData=delete('categories',$categoryId);
        if($categoryData){
            redirect('category.php','Category Deleted Succesfully');
           
        }else{
            redirect('category.php','Something went wrong');
        }
    }else{
        redirect('category.php',$category['message']); 
    }
    //echo $adminId;


 }else{
    redirect('category.php','Something went wrong');
 }            
?>