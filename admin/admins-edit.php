<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow">
    <div class="card-header">
        <h4 class="mb-0">Edit Admin
            <a href="admins.php" class="btn btn-danger float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">
        <form action="code.php" method="POST">
            <?php
            $my=$_GET['id'];
            echo "<h4>".$my."</h4>"; 
              if(isset($_GET['id']))
              {
                 
                  if($_GET['id']!='')
                  {
                    $adminId=$_GET['id'];

                  }else{
                     echo'<h3>No Id Found</h3>';
                    
                     return false;
                  }
              }else{
                echo'<h3>No Id given in URL</h3>';
                return false;
             }
             $adminData=getById('admins',$adminId);
             if($adminData)
             {
                if($adminData['status']==200)
                {
                   ?>
                         <div class="row">
                         <input type="hidden" name="adminId" required value="<?= $adminData['data']['id'];?>" class="form-control"/>
                <div class="col-md-12 mb-3">
                    <label for="">Name*</label>
                    <input type="text" name="name" required value="<?= $adminData['data']['name'];?>" class="form-control"/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Email*</label>
                    <input type="email" name="email" required value="<?= $adminData['data']['email'];?>" class="form-control"/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Password*</label>
                    <input type="password" name="password" class="form-control"/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Phone No*</label>
                    <input type="number" name="phoneno" required value="<?= $adminData['data']['phone'];?>" class="form-control"/>
                </div>
                <div class="col-md-6 mb-3 ">
                    <label for="">Access*</label>
                    <input  type="checkbox" name="is_ban" <?=$adminData['data']['is_ban']==true?'checked':''; ?> style="width: 30px;height: 30px; margin-top: 25px;"/>
                </div>
                <div class="col-md-6 mb-3 text-end">
                    <input type="submit" name="updateAdmin" value="Update">
                </div>
            </div>
                   
                   <?php

                }else{
                  echo'<h3>'.$adminData['message'].'</h3>';
                }
             }else{
                echo'<h3>Error 404<br>Something went wrong</h3>';
                     return false;
             }
            ?>
            <?php alertMessage()?>
            
        </form>
        
    </div>
  </div>

</div>
                         
<?php include('assets/includes/footer.php');?>