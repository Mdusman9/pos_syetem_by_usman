<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow">
    <div class="card-header">
        <h4 class="mb-0">Print Order
        <a href="orders.php" class="btn btn-primary float-end btn-sm ">Back</a>
        </h4>
    </div>
    <div class="card-body">
        <div id=myBillingArea style="padding: 30px;">
   <?php
     if(isset($_GET['track'])){
        $trackingNo = validate($_GET['track']);
        if($trackingNo == ''){
            ?>
         <div class="text-center py-5">
               <h5>NO Traking No Found</h5>
               <a href="orders.php" class="btn btn-primary mx-2 btn-sm float-center" >Bact to Orders</a>
             </div>
        <?php

        }
        $orderQuery= "SELECT o.*,c.* FROM orders o ,customers c 
        WHERE c.id=o.customer_id AND tracking_no='$trackingNo' LIMIT 1";
        $queryRes=mysqli_query($conn,$orderQuery);
        if(!$queryRes){
            echo "<h5> Somethingwent wrong </h5>";
            return false;

        }
        if(mysqli_num_rows($queryRes)> 0){
            $orderDataRow=mysqli_fetch_assoc($queryRes);
           // print_r($orderDataRow);
            ?>
               <table style="width: 100%; margin: bottom 20px;">
                                        <tbody>
                                           
                                            <tr >
                                                <td style="text-align: center;" colspan="2">
                                                    <h4 style="font-size: 23px; line-height: 30px; margin:2px; padding:0;" >Osmani Holdings </h4>
                                                    <p style="font-size: 23px; line-height: 30px; margin:2px; padding:0;" >#6#5, ,$th Block,HBR Layout,Bangalore </p>
                                                    <p style="font-size: 23px; line-height: 30px; margin:2px; padding:0;" >Osman holdings pvt LTD</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td >
                                                    <h4 style="font-size: 20px; line-height: 30px; margin:2px; padding:0;" >Customer Details </h4>
                                                    <p style="font-size: 14px; line-height: 20px; margin:2px; padding:0;" >Customer Name:<?=$orderDataRow['name'] ?> </p>
                                                    <p style="font-size: 14px; line-height: 20px; margin:2px; padding:0;" >Customer Phone:<?=$orderDataRow['phone'] ?></p>
                                                    <p style="font-size: 14px; line-height: 20px; margin:2px; padding:0;" >Customer Email-ID:<?=$orderDataRow['email'] ?></p>
                                                </td>
                                                <td align="end">
                                                    <h4 style="font-size: 20px; line-height: 30px; margin:2px; padding:0;" >Invoice Details </h4>
                                                    <p style="font-size: 14px; line-height: 20px; margin:2px; padding:0;" >Invoice No:<?=$orderDataRow['invoice_no'] ?></p>
                                                    <p style="font-size: 14px; line-height: 20px; margin:2px; padding:0;" >Invoice Date:<?=$orderDataRow['order_date'] ?></p>
                                                    <p style="font-size: 14px; line-height: 20px; margin:2px; padding:0;" >Invoice Address: #6#5, ,$th Block,HBR Layout,Bangalore</p>
                                                </td>
                                            </tr> 
                                                 
                                        </tbody>

                                    </table>
            <?php

        }else{
            echo "<h5> Somethingwent wrong </h5>";
            return false;

        }
        $orderItemQuery = "SELECT oi.quantity as quantityorder , oi.price as orderprice,o.*, oi.* ,p.* 
                      FROM orders as o,order_items as oi,products as p 
                      WHERE oi.order_id =o.id AND p.id =oi.product_id AND o.tracking_no='$trackingNo'"; 
        $orderItemsRes=mysqli_query($conn,$orderItemQuery);
        if($orderItemsRes){
            if( mysqli_num_rows($orderItemsRes)> 0){
                 ?>
                  <table style="width: 100%;" cellpadding="5">
                                <thead>
                                    <tr>
                                        <th align="start" style="border-bottom: 2px solid #ccc;" width="5%">ID</th>
                                        <th align="start" style="border-bottom: 2px solid #ccc;" >Product Name</th>
                                        <th align="start" style="border-bottom: 2px solid #ccc;" width="10%">Price</th>
                                        <th align="start" style="border-bottom: 2px solid #ccc;" width="10%">Quantity</th>
                                        <th align="start" style="border-bottom: 2px solid #ccc;" width="15%">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i =1;
                                   
                                    foreach($orderItemsRes as $key => $row):
                                   
                                    ?>
                                    <tr>
                                     <td style="border-bottom: 2px solid #ccc;" ><?= $i++?></td> 
                                     <td style="border-bottom: 2px solid #ccc;" ><?= $row['name']?></td>
                                     <td style="border-bottom: 2px solid #ccc;" ><?= number_format($row['orderprice'],0)?></td>  
                                     <td style="border-bottom: 2px solid #ccc;" ><?= $row['quantityorder']?></td>
                                     <td style="border-bottom: 2px solid #ccc;" class="fw-bold">
                                        <?= number_format($row['orderprice'] * $row['quantityorder'],0)?>
                                     </td>
                                    </tr>
                                    <?php endforeach;?>
                                    <tr>
                                        <td colspan="4" align="end" style="font-weight: bold;">Grand Total:</td>
                                        <td colspan="1" style="font-weight: bold;"><?= number_format($row['total_amount'],0) ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="5">Payment Method:<?= $row['payment_mode'];?></td>
                                    </tr>
                                </tbody>
                            </table>
                 <?php

            }else{
                echo "<h5> No ORder Found </h5>";
               return false;
            }

        }else{
            echo "<h5> Somethingwent wrong </h5>";
            return false;

        }



     }else{
        ?>
         <div class="text-center py-5">
               <h5>NO Traking provide Found</h5>
               <a href="orders.php" class="btn btn-primary mx-2 btn-sm float-center" >Bact to Orders</a>
             </div>
        <?php
     }
   ?>
      </div>
      <div>
        <button class="btn btn-danger px-4 mx-1" onclick="printMyBillingArea()">Print</button>
        <button class="btn btn-primary px-4 mx-1" id="download">DOWNLOAD</button>
      </div>
    </div>
  </div>

</div>
                         
<?php include('assets/includes/footer.php');?>    