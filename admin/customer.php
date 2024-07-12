<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">Customers
            <a href="customer-create.php" class="btn btn-primary float-end">Add Customers</a>
        </h4>
    </div>
    <div class="card-body">
    <?php alertMessage()?>
    <?php
    $customers=getAll('customers');
    if(!$customers)
    {
        echo"<h2>something went wrong</h2>";
        return false;
    }
    if(mysqli_num_rows($customers)>0)
    {

                    
    ?>
        <div class="table-responsive">
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>PHONE</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach($customers as $item): ?>
                    <tr>
                        <td><?= $item['id']?> </td>
                        <td><?= $item['name']?> </td>
                        <td><?= $item['email']?> </td>
                        <td><?= $item['phone']?> </td>
                        
                        <td>
                            <?php
                             if($item['status']!=1){
                                echo'<span class="badge bg-primary">Visible</span>';
                             }
                             else{
                                echo'<span class="badge bg-danger">Hidden</span>';
                             }
                            ?>
                        </td>
                        
                        <td>
                            <a href="customer-edit.php?id=<?= $item['id'];?>" class="btn btn-success btn-sm">✎ Edit</a>
                            <a 
                            href="customer-delete.php?id=<?= $item['id'];?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Are your sure to delete this Customer ')"
                            > Delete
                            
                            </a>
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