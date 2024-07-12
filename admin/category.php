<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">Product Catogeries
            <a href="category-create.php" class="btn btn-primary float-end">Add Catogary</a>
        </h4>
    </div>
    <div class="card-body">
    <?php alertMessage()?>
    <?php
    $categories=getAll('categories');
    if(!$categories)
    {
        echo"<h2>something went wrong</h2>";
        return false;
    }
    if(mysqli_num_rows($categories)>0)
    {

                    
    ?>
        <div class="table-responsive">
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>DESCRIPTION</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach($categories as $item): ?>
                    <tr>
                        <td><?= $item['id']?> </td>
                        <td><?= $item['name']?> </td>
                        <td><?= $item['description']?> </td>
                        <td>
                            <?php
                             if($item['status']!=1){
                                echo'<span class="badge bg-danger">Hidden</span>';
                             }
                             else{
                                echo'<span class="badge bg-primary">Visible</span>';
                             }
                            ?>
                        </td>
                        
                        <td>
                            <a href="category-edit.php?id=<?= $item['id'];?>" class="btn btn-success btn-sm">✎ Edit</a>
                            <a href="category-delete.php?id=<?= $item['id'];?>" class="btn btn-danger btn-sm"> Delete</a>
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