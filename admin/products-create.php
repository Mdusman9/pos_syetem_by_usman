<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow">
    <div class="card-header">
        <h4 class="mb-0">Add Product
            <a href="products.php" class="btn btn-primary float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">
        <form action="code.php" method="POST" enctype="multipart/form-data">
            <?php alertMessage()?>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label>Select Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">Select categories</option>
                        <?php
                         $categories =getAll('categories');
                         if($categories){
                            if(mysqli_num_rows($categories)>0){
                                foreach($categories as $cateItem){
                                    echo'<option value="'.$cateItem['id'].'">'.$cateItem['name'].'</option>';


                                }

                            }else{
                                echo'<option value="">No products Found</option>'; 
                            }

                         }else{
                             echo'<option value="">Some thing went wrong</option>';
                         }
                        ?>
                    </select>

                    </div>
                <div class="col-md-12 mb-3">
                    <label for="">Product Name*</label>
                    <input type="text" name="name" required class="form-control"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Brand*</label>
                    <input type="text" name="brand" required class="form-control"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea type="text" name="description" required class="form-control"></textarea>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="">Price*</label>
                    <input type="number" name="price" required class="form-control"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Quantity*</label>
                    <input type="number" name="quantity" required class="form-control"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Product Image</label>
                    <input type="file" name="image"  class="form-control">
                </div>
                <div class="col-md-6">
                    <lable>Status (UnChecked=Visible,Checked=Hidden)</lable>
                   </br>
                    <input  type="checkbox" name="status" style="width: 30px;height: 30px; "/>
                </div>
                <div class="col-md-6 mb-3 ml-10 text-end">
</br></br></br>
                    <input style="margin-right: 1900px;" type="submit" name="saveProducts" value="Submit">
                </div>
            </div>
        </form>
        
        
    </div>
  </div>

</div>
                         
<?php include('assets/includes/footer.php');?>