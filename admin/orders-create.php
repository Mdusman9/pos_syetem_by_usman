<?php include('assets/includes/header.php');?>

<!-- Modal -->
<div class="modal fade" id="addCustomerModel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Customer</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label>Enter Customer Name*</label>
            <input type="text" class="form-control" id="c_name" /> 
        </div>
        <div class="mb-3">
            <label>Enter Customer Phone Number*</label>
            <input type="text" class="form-control" id="c_phone" /> 
        </div>
        <div class="mb-3">
            <label>Enter Customer Email</label>
            <input type="text" class="form-control" id="c_email" /> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary saveCustomer">Save changes</button>
      </div>
    </div>
  </div>
</div>





<div class="container-fluid px-4">
  <div class="card mt-4 shadow">
    <div class="card-header">
        <h4 class="mb-0">Create Orders
            <a href="#" class="btn btn-primary float-end">Back</a>
        </h4>
    </div>
    <div class="card-body" >
        <form action="orders-code.php" method="POST">
            <?php alertMessage()?>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="">Select Products</label>
                    <select name="product_id" class="form-select mySelect2" >
                        <option value="">Select Products</option>
                        <?php
                         $products =getAll('products');
                         if($products){
                            if(mysqli_num_rows($products)>0){
                                foreach($products as $prodItem){
                                    if($prodItem['status']==0)
                                    {
                                    ?>
                                    <option value="<?=$prodItem['id']?>"><?=$prodItem['name']?></option>
                                    <?php 
                                    }

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
                <div class="col-md-2 mb-3">
                    <label for="">Quantity</label>
                    <input type="number" name="quantity" required class="form-control" value="1">
                </div>
                <input   type="submit" name="addItem"  value="Submit">
                </div>
            </div>
        </form>
        
    </div>
  </div>
  <div class="card mt-3">
      <div class="card-header">
        <h4 class="mb-0">Products</h4>
      </div>
      <div class="card-body" id="productArea">
        <?php
        if(isset($_SESSION['productItems']))
        {
            $sessionProducts=$_SESSION['productItems'];
           if(!empty($sessionProduct)){
                unset($_SESSION['productItemIds']);
                unset($_SESSION['productItems']);

            } 
            ?>
            <div class="table-responsive mb-3" id="productContent">
               <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Toatl Price</th>
                        <th>Remove</th>

                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i=1;
                    foreach($sessionProducts as $key => $item) :
                    ?>
                    <tr>
                         <td><?=$i++ ?></td>
                         <td><?=$item['name'] ?></td>
                         <td><?=$item['price'] ?></td>
                         <td>
                            <div class="input-group qtyBox">
                                <input type="hidden" value="<?=$item['product_id'];  ?>" class="prodId">
                                <button class="input-group-text decrement" >-</button>
                                <input type="" value="<?=$item['quantity']; ?>" class="qty quantityinput" style=" width: 50px !important;
  padding: 6px 3px;
  text-align: center;
  border: 1px solid #cfb1b1;
  outline: 0;
  margin-right: 1px;" >
                                <button class="input-group-text increment">+</button>
                            </div>
                         </td>
                         <td><?=number_format($item['price']*$item['quantity'],0);?></td>
                         <td>
                            <a href="order-item-delete.php?index=<?=$key;?>" class="btn btn-danger">Remove</a>
                         </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
               </table>
               <form>
               <div class="mt-2">
                <hr>
                <form>
                <div class="row">
                
                    <div class="col-md-4">
                        <label>Select Payment Mode</label>
                        <select id="payment_mode"  class="form-select">
                            <option value="">--Select Payment Method--</option>
                              <option value="Cash Payment">Cash Payment</option>
                              <option value="UPI">UPI Payment</option>
                              <option value="Online Payement">Online Payment</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Enter Customer Phone Number </label>
                        <input type="number" id="cphone" class="form-control" value="">
                    </div>
                   
                    <div class="col-md-4">
                        <br>
                        <button type="button" class="btn btn-warning w-100 proceedToPlace" >Proceed To Place</button>
                    </div>
                
                </div>
               
                <br>
            </div>
            </div>
            
            <?php
        }else{
            echo '<h5> NO item added</h5>';
        }
        ?>
      </div>
  </div>
  
  </div>
  
  
 
</div>
<?php include('assets/includes/footer.php');?>






                         
