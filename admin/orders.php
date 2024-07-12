<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow">
    <div class="card-header">
        
          <div class="row">
            <div class="col-md-4">
            <h4 class="mb-0">Orders</h4><br>

            </div>
            <hr>
            <div class="col-md-8">
              <form action="" method="GET">
                 <div class="row">

                 

                  <div class="col-md-4">
                    <input type="date" 
                    class="form-control"
                    name="date" value="<?=isset($_GET['date']) == true ? $_GET['date']:'' ?>";
                    />
                  </div>
                  <div class="col-md-4">
                    <select name="payment_status" class="form-control">
                      <option value=""
                      
                      >--Select Payment--</option>
                      <option value="Cash Payment"
                      <?= isset($_GET['payment_status'])==true? 
                      ($_GET['payment_status']=='Cash Payment'? 'selected':'') 
                      :'';
                      ?>

                      >Cash Payment</option>
                      <option value="UPI"
                      <?= isset($_GET['payment_status'])==true? 
                      ($_GET['payment_status']=='UPI'? 'selected':'') 
                      :'';
                      ?>
                      >UPI</option>
                      <option value="Online Payement"
                      <?= isset($_GET['payment_status'])==true? 
                      ($_GET['payment_status']=='Online payement'? 'selected':'') 
                      :'';
                      ?>
                      >Online Payment</option>
                      

                    </select>
                  </div>
                  <div class="col-md-4">
                    <button class="btn btn-primary">Filter</button>
                    <a href="orders.php" class="btn btn-danger">Reset</a>
                  </div>
                 </div>

              </form>
            </div>
          </div>
        
          <div class="row">
           
            <div class="col-md-8">
              
            </div>
          </div>
       
    </div>
    <div class="card-body">
        <?php
      
        
        if(isset($_GET['date'])||isset($_GET['payment_status'])){
          $orderDate =validate($_GET['date']);
          $payment_status =validate($_GET['payment_status']);
        
     
          if($orderDate!=''&& $payment_status=='' ){
            $query=" SELECT o.*, c.* FROM orders o , customers c 
             WHERE c.id=o.customer_id AND o.order_date='$orderDate'  ORDER BY o.id DESC";
          }elseif($orderDate == ''&& $payment_status!=''){
            $query=" SELECT o.*, c.* FROM orders o , customers c 
             WHERE c.id=o.customer_id AND o.payment_mode='$payment_status' ORDER BY o.id DESC"; 
          }elseif($orderDate != ''&& $payment_status!=''){
            $query=" SELECT o.*, c.* FROM orders o , customers c 
             WHERE c.id=o.customer_id AND o.order_date='$orderDate' AND o.payment_mode='$payment_status' ORDER BY o.id DESC";
          }else{
            $query=" SELECT o.*, c.* FROM orders o , customers c 
          WHERE c.id=o.customer_id ORDER BY o.id DESC";
          }

        }else{

          $query=" SELECT o.*, c.* FROM orders o , customers c 
          WHERE c.id=o.customer_id ORDER BY o.id DESC";
          
        }
      
        $total=0;
        // $query=" SELECT o.*, c.* FROM orders o , customers c WHERE c.id=o.customer_id ORDER BY o.id DESC"; 
         $orders=mysqli_query($conn,$query);
         if($orders){
            if(mysqli_num_rows($orders)>0)
              { 
                ?>
                <table class="table table-stripped table-bordered align-items-center justify-content-center">
                    <thead>
                        <tr>
                            <th>Tracking No</th>
                            <th>C Name</th>
                            <th>C phone</th>
                            <th>Order data</th>
                            <th>Order Status</th>
                            <th>Payment Mode</th>
                            <th>Order Amount</th>
                            
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $item): ?>
                            <tr>
                                <td class="fw-bold"> <?= $item['tracking_no']; ?></td>
                                <td > <?= $item['name']; ?></td>
                                <td > <?= $item['phone']; ?></td>
                                <td > <?= date('d M,Y',strtotime($item['order_date'])) ;?></td>
                                <td > <?= $item['order_status'];?></td>
                                <td > <?= $item['payment_mode'];?></td>
                                <td  class="fw-bold" > Rs:<?= $item['total_amount']; number_format($total+=$item['total_amount'],0);?>.00₹</td>
                                <td > 
                                    <a href="orders-view.php?track=<?= $item['tracking_no']; ?>" class="btn btn-info mb-0 px-2 btn-sm">View</a>
                                    <a href="orders-view-print.php?track=<?= $item['tracking_no'];  ?>" class="btn btn-primary mb-0 px-2 btn-sm">Print</a>
                                </td>
                            </tr>
                            
                               
                        <?php   endforeach; ?>
                       
                    </tbody>
                    

                </table>
                <div class="col-md-4">
            <h4 class="mb-0 fw-bold">Total Sales : Rs <?= $_SESSION['total']=$total;?>.00₹</h4>
           

            </div>
            
                <?php
                

              }else{
                echo '<h5>No orders Found</h5>';
              }
         }else{
            echo '<h5>Something Went Wrong</h5>';
         }
        ?>

 


    </div>
  </div>

</div>
                         
<?php include('assets/includes/footer.php');?>