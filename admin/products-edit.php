<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow">
    <div class="card-header">
        <h4 class="mb-0">Edit Product
            <a href="products.php" class="btn btn-primary float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">
        <form action="code.php" method="POST" enctype="multipart/form-data">
            <?php alertMessage()?>
            <?php
             $paramValue=checkParamId('id');
             if(!is_numeric($paramValue)){
                echo'id is not a number';
                return false;

             }
             $products=getById('products',$paramValue);
             if($products){
                if($products['status']==200)
                {

             
                         
             ?>
             <input type="hidden" name="products_id" required value="<?=$products['data']['id'] ?>">
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
                                    ?>
                                     <option value="<?= $cateItem['name']?>"
                                     <?=$products['data']['category_id']==$cateItem['id']?'selected':''; ?>
                                     >
                                      <?= $cateItem['name'];?>
                                    </option>
                                    <?php
                                    


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
                    <input type="text" name="name" required value="<?=$products['data']['name'] ?>" class="form-control"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Brand*</label>
                    <input type="text" name="brand" required value="<?=$products['data']['brand'] ?>" class="form-control"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea type="text" name="description" required  class="form-control"><?=$products['data']['description'] ?></textarea>
                </div>
                
                <div class="col-md-4 mb-3">
                    <label for="">Price*</label>
                    <input type="number" name="price" required value="<?=$products['data']['price'] ?>" class="form-control"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Quantity*</label>
                    <input type="number" name="quantity" required value="<?=$products['data']['quantity'] ?>" class="form-control"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Product Image</label>
                    <input type="file" name="image" value="<?=$products['data']['image'] ?>" class="form-control">
                    <img src="../<?=$products['data']['image'] ?>" style="width: 40px;hieght:40px" alt="Image">
                </div>
                <div class="col-md-6">
                    <lable>Status (UnChecked=Visible,Checked=Hidden)</lable>
                   </br>
                    <input  type="checkbox" name="status" <?=$products['data']['status']==true ? 'checked':'' ?> style="width: 30px;height: 30px; "/>
                </div>
                <div class="col-md-6 mb-3 ml-10 text-end">
</br></br></br>
                    <input style="margin-right: 1900px;" type="submit" name="updateProducts" value="Update">
                </div>
            </div>
            <?php
        }else{
                    echo'<h3>'.$products['message'].'</h3>';
                    return false;
                }
              
             }else{
              echo'<h3>Something Went wrong</h3>';
              return false;
             }          
             ?>
        </form>
        
        
    </div>
  </div>

</div>
                         
<?php include('assets/includes/footer.php');?>