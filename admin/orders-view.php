<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow">
    <div class="card-header">
        <h4 class="mb-0">Order View
        <a href="orders.php" class="btn btn-danger mx-2 btn-sm float-end" >Bact to Orders</a>
        </h4>
    </div>
    <div class="card-body">
        <?php alertMessage();?>
        <?php
           if(isset($_GET['track'])){
            $trackingNo=validate($_GET['track']);
            $query="SELECT o.*, c.* FROM orders o , customers c 
                  WHERE c.id=o.customer_id AND tracking_no='$trackingNo' ORDER BY o.id DESC"; 
            $orders =mysqli_query($conn,$query);
            if($orders){
                if(mysqli_num_rows($orders)>0){
                    $orderData = mysqli_fetch_assoc($orders);
                    $orderId = $orderData['id'];
                    ?>
                       <div class="card card-body shadow border-1 mb-4">
                         <div class="row">
                            <div class="col-md-6">
                            <h4>Order Details</h4>
                            <label class="mb-1">
							  Tracking No: 
                              <span class="fw-bold"><?= $orderData['tracking_no'];  ?></span>
							  </label>
                              <br/>
                              <label class="mb-1">
							  Order Date: 
                              <span ><?= $orderData['order_date'];  ?></span>
							  </label>
                              <br/>
                              <label class="mb-1">
							  Order Status: 
                              <span ><?= $orderData['order_status'];  ?></span>
							  </label>
                              <br/>
                              <label class="mb-1">
							  Payment Mode: 
                              <span ><?= $orderData['payment_mode'];  ?></span>
							  </label>
                              

                            </div>
                            <div class="col-md-6">
                            <h4>User Details</h4>
                            <label class="mb-1">
							  Full Name: 
                              <span ><?= $orderData['name'];  ?></span>
							  </label>
                              <br/>
                            <label class="mb-1">
							  Email Address: 
                              <span ><?= $orderData['email'];  ?></span>
							  </label>
                              <br/>
                            <label class="mb-1">
							  Phone Number : 
                              <span ><?= $orderData['phone'];  ?></span>
							  </label>
                              <br/>

                            </div>
                         </div>

                       </div>
                     <?php
                      $orderItemQuery= "SELECT oi.quantity as quantityorder, oi.price as orderprice, o.*, oi.* ,p.* 
                      FROM orders as o,order_items as oi,products as p 
                      WHERE oi.order_id =o.id AND p.id =oi.product_id AND o.tracking_no='$trackingNo'";
                      
                      $orderItemsRes=mysqli_query($conn,$orderItemQuery);
                      if($orderItemsRes){
                        if(mysqli_num_rows($orderItemsRes)>0){
                            ?>
                              <h4 class="my-3">Ordered Items Details</h4>
                              <table class="table table-bordered table-stripped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($orderItemsRes as $oItem): ?>
                                        <tr>
                                            <td>
                                                <img src="<?= $oItem['image']!='' ? '../'. $oItem['image']:'../assets/images/no-image.jpg'; ?>"
                                                style="width:50px;height:50px;"
                                                alt="Img" />
                                                <?= $oItem['name'];?>
                                            </td>
                                            <td width=15% class="fw-bold text-center" >
                                                <?= number_format($oItem['orderprice'],0); ?>
                                            </td>
                                            <td width=15% class="fw-bold text-center" >
                                                <?= $oItem['quantityorder']; ?>
                                            </td>
                                            <td width=15% class="fw-bold text-center" >
                                                <?= number_format($oItem['orderprice'] * $oItem['quantityorder'],0); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td  colspan="1" class="text-end fw-bold">Total price:</td>
                                        <td colspan="3" class="text-end fw-bold"> Rs:  <?= number_format($oItem['total_amount'],0); ?></td>

                                    </tr>
                                </tbody>

                              </table>
                            <?php

                        }else{
                            echo '<h5>Something Went Wrong1</h5>';
                            return false;
                        }

                      }else{
                        echo '<h5>Something Went Wrongw</h5>';
                        return false;
                      }
                     ?>   
                    <?php

                }else{
                    echo '<h5>No Data Found</h5>';
                    return false;
                }

            }else{
                echo '<h5>Something Went Wrong</h5>';
            }

           }else{
             ?>
             <div class="text-center py-5">
               <h5>NO Traking No Found</h5>
               <a href="orders.php" class="btn btn-primary mx-2 btn-sm float-center" >Bact to Orders</a>
             </div>
             <?php
           }
        ?>

    </div>
  </div>

</div>
                         
<?php include('assets/includes/footer.php');?>