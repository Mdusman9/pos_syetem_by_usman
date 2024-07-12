<?php
 include('../config/function.php');


 if(isset($_POST["saveAdmin"]))
 {  
    $name=validate($_POST['name']);
    $email=validate($_POST['email']);
    $password=validate($_POST['password']);
    $phone=validate($_POST['phoneno']);
    $is_ban=isset($_POST['is_ban'])==true ? 1:0;
   

    if($name!=''&& $password!=''&& $email!='')
    {
        $emailCheck=mysqli_query($conn,"SELECT * FROM admins WHERE email='$email' ");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck)>0)
            {
                redirect('admin-create.php','Email is already used.');
            }
        }
        $bcrypt_password =password_hash($password,PASSWORD_BCRYPT);

        $data=[
            'name'=>$name,
            'password'=>$bcrypt_password,
            'email'=>$email,
            'phone'=>$phone,
            'is_ban'=>$is_ban

        ];
        $result=insert('admins',$data);
        if($result)
        {
            redirect('admins.php','Admin added successfully.'); 
        }
        else
        {
            redirect('admin-create.php','Something went wrong'); 
        }

    }else{
        $bool=isset($_POST["saveAdmin"]);
        
        redirect('admin-create.php','please fill all required field .');
        
        
    }

 }
 if(isset($_POST["updateAdmin"]))
 {
    $name=validate($_POST['name']);
    $adminId=validate($_POST['adminId']);
    $adminData=getById('admins',$adminId);
    if($adminData['status'!=200])
    {
        redirect('admin-edit.php?id='.$adminId,'please fill all required field .');
    }
    $email=validate($_POST['email']);
    $password=validate($_POST['password']);
    $phone=validate($_POST['phoneno']);
    $is_ban=isset($_POST['is_ban'])==true ? 1:0;
    if($password !=''){
      $hashedPassword=password_hash($password,PASSWORD_BCRYPT);
    }else{
        $hashedPassword=$adminData['data']['password'];

    }
   

    if($name!='' &&  $email!='')
    {
        $data=[
            'name'=>$name,
            'password'=>$hashedPassword,
            'email'=>$email,
            'phone'=>$phone,
            'is_ban'=>$is_ban

        ];
        $result=update('admins',$adminId,$data);
        if($result)
        {
            redirect('admins-edit.php?id='.$adminId,'Admin updated successfully.'); 
        }
        else
        {
            redirect('admins-edit.php?id='.$adminId,'Something went wrong.'); 
        }

    }else{
         redirect('admin-create.php','please fill all required field .');
        
        
    }
 }
 if(isset($_POST["saveCategory"]))
 {  
    $name=validate($_POST['name']);
    $description=validate($_POST['description']);
    $status=isset($_POST['status'])==true ? 1:0;
   
      $data=[
            'name'=>$name,
            'description'=>$description,
            'status'=>$status

        ];
        $result=insert('categories',$data);
        if($result)
        {
            redirect('category.php','category added successfully.'); 
        }
        else
        {
            redirect('category-create.php','Something went wrong'); 
        }
}

if(isset($_POST['updateCategory']))
{ 
    $name=validate($_POST['name']);
    $categoryId=validate($_POST['categoryId']);

    $description=validate($_POST['description']);
    $status=isset($_POST['status'])==true ? 1:0;
   
      $data=[
            'name'=>$name,
            'description'=>$description,
            'status'=>$status

        ];
        $result=update('categories',$categoryId,$data);
        if($result)
        {
            redirect('category-edit.php?id='.$categoryId,'category Updated successfully.'); 
        }
        else
        {
            redirect('category-edit.php?id='.$categoryId,'Something went wrong'); 
        }

}
if(isset($_POST['saveProducts'])){
    $category_id=validate($_POST['category_id']);
    $name=validate($_POST['name']);
    $brand=validate($_POST['brand']);
    $description=validate($_POST['description']);
    $price=validate($_POST['price']);
    $quantity=validate($_POST['quantity']);
    $image=validate($_POST['image']);
    $status=isset($_POST['status'])==true ? 1:0;
    if($_FILES['image']['size']>0)
    {
          $path='../assets/uploads/products';
          $image_ext=pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);

          $filename =time().'.'.$image_ext;
          move_uploaded_file($_FILES['image']['tmp_name'],$path."/".$filename);
          $finalImage="assets/uploads/products/".$filename;
    }
    else{
        $finalImage="";
    }
   
      $data=[
            'category_id'=>$category_id,
            'name'=>$name,
            'brand'=>$brand,
            'description'=>$description,
            'price'=>$price,
            'quantity'=>$quantity,
            'image'=>$finalImage,
            'status'=>$status
        ];
        $result=insert('products',$data);
        if($result)
        {
            redirect('products.php','Product added successfully.'); 
        }
        else
        {
            redirect('products-create.php','Something went wrong'); 
        }

}
if(isset($_POST["updateProducts"]))
{
    $products_id=validate($_POST['products_id']);
    $productsData =getById('products',$products_id);
    if(!$productsData){
        redirect('products.php','No such product found');
    }
    $category_id=validate($_POST['category_id']);
    $name=validate($_POST['name']);
    $brand=validate($_POST['brand']);
    $description=validate($_POST['description']);
    $price=validate($_POST['price']);
    $quantity=validate($_POST['quantity']);
    $image=validate($_POST['image']);
    $status=isset($_POST['status'])==true ? 1:0;
    if($_FILES['image']['size']>0)
    {
          $path='../assets/uploads/products';
          $image_ext=pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);

          $filename =time().'.'.$image_ext;
          move_uploaded_file($_FILES['image']['tmp_name'],$path."/".$filename);
          $finalImage="assets/uploads/products/".$filename;
          $deleteImage="../".$productsData['data']['image'];
          if(file_exists($deleteImage)){
             unlink($deleteImage);
         
           }
    else{
        $finalImage=$productsData['data']['image'];
    }
   
      $data=[
            'category_id'=>$category_id,
            'name'=>$name,
            'brand'=>$brand,
            'description'=>$description,
            'price'=>$price,
            'quantity'=>$quantity,
            'image'=>$finalImage,
            'status'=>$status
        ];
        $result=update('products',$products_id,$data);
        if($result)
        {
            redirect('products-edit.php?id='.$products_id,'Product updated successfully.'); 
        }
        else
        {
            redirect('products-edit.php?id='.$products_id,'Something went wrong'); 
        }
    }
    echo'hi';
    if(isset($_POST["saveCustomers"]))
    {
        $name = validate($_POST['name']);
        $email = validate($_POST['email']);
        $phone = validate($_POST['phone']);
        $status = isset($_POST['status']) ? 1:0;
    
        if($name != '')
        {
            $emailCheck = mysqli_query($conn, "SELECT * FROM customers WHERE email='$email'");
            if($emailCheck){
                if(mysqli_num_rows($emailCheck)>0){
                    redirect('customer.php','Email is alra=eady used by another customer');   
                }

            }
            $data=[
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone,
            'status'=>$status

            ];
            $result=insert('customers',$data);
        if($result)
        {
            redirect('customer.php','Customer added successfully.'); 
        }
        else
        {
            redirect('customer-create.php','Something went wrong'); 
        }
    
        }
        else
        {
            redirect('customer.php','please required fields');
        }
    }    

}
if(isset($_POST["saveCustomers"]))
    {
        $name = validate($_POST['name']);
        $email = validate($_POST['email']);
        $phone = validate($_POST['phone']);
        $status = isset($_POST['status']) ? 1:0;
    
        if($name != '')
        {
            $emailCheck = mysqli_query($conn, "SELECT * FROM customers WHERE email='$email'");
            if($emailCheck){
                if(mysqli_num_rows($emailCheck)>0){
                    redirect('customer.php','Email is alra=eady used by another customer');   
                }

            }
            $data=[
            'name'=>$name,
            'email'=>$email,
            'phone'=>$phone,
            'status'=>$status

            ];
            $result=insert('customers',$data);
        if($result)
        {
            redirect('customer.php','Customer added successfully.'); 
        }
        else
        {
            redirect('customer-create.php','Something went wrong'); 
        }
    
        }
        else
        {
            redirect('customer.php','please required fields');
        }
    }
if(isset($_POST['updateCustomers']))
{
    $name = validate($_POST['name']);
    $customersId = validate($_POST['customersId']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $status = isset($_POST['status']) ? 1:0;

    if($name != '')
    {
        $emailCheck = mysqli_query($conn, "SELECT * FROM customers WHERE email='$email' AND id!='$customersId'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck)>0){
                redirect('customer-edit.php?id='.$customersId,'Email is alra=eady used by another customer');   
            }

        }
        $data=[
        'name'=>$name,
        'email'=>$email,
        'phone'=>$phone,
        'status'=>$status

        ];
        $result=update('customers',$customersId,$data);
    if($result)
    {
        redirect('customer-edit.php?id='.$customersId,'Customer Updated successfully.'); 
    }
    else
    {
        redirect('customer-edit.php?id='.$customersId,'Something went wrong'); 
    }

    }
    else
    {
        redirect('customer-edit.php?id='.$customersId,'please required fields');
    }
}    
   
   
?>