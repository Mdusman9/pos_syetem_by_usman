<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">Admins/Staff
            <a href="admin-create.php" class="btn btn-primary float-end">Add Admin</a>
        </h4>
    </div>
    <div class="card-body">
    <?php alertMessage()?>
    <?php
    $admin=getAll('admins');
    if(!$admin)
    {
        echo"<h2>something went wrong</h2>";
        return false;
    }
    if(mysqli_num_rows($admin)>0)
    {

                    
    ?>
        <div class="table-responsive">
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>Phone NO</th>
                        <th>Access</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach($admin as $adminItem): ?>
                    <tr>
                        <td><?= $adminItem['id']?> </td>
                        <td><?= $adminItem['name']?> </td>
                        <td><?= $adminItem['email']?> </td>
                        <td><?= $adminItem['phone']?> </td>
                        <td>
                            <?php
                             if($adminItem['is_ban']!=1){
                                echo'<span class="badge bg-danger">Banned</span>';
                             }
                             else{
                                echo'<span class="badge bg-primary">Active</span>';
                             }
                            ?>
                        </td>
                        
                        <td>
                            <a href="admins-edit.php?id=<?= $adminItem['id'];?>" class="btn btn-success btn-sm">✎ Edit</a>
                            <a href="admins-delete.php?id=<?= $adminItem['id'];?>" class="btn btn-danger btn-sm"> Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                   
                </tbody>

            </table>
        </div>
        <?php
                    }
                    else{
                        ?>
                         <tr>
                        <h4>No Record Found</h4>
                    </tr>
                    <?php

                    }
                    ?>
    </div>
  </div>

</div>
                         
<?php include('assets/includes/footer.php');?>