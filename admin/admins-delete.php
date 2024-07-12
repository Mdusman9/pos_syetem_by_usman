<?php
  require '../config/function.php';
  $paraResult=checkParamId('id');
 if(is_numeric($paraResult)){
    $adminId=validate($paraResult);
    $admin =getById('admins',$adminId);
    if($admin['status']==200)
    {
        $adminData=delete('admins',$adminId);
        if($adminData){
            redirect('admins.php','Admin Deleted Succesfully');
           
        }else{
            redirect('admins.php','Something went wrong');
        }
    }else{
        redirect('admins.php',$admin['message']); 
    }
    //echo $adminId;


 }else{
    redirect('admins.php','Something went wrong');
 }            
?>