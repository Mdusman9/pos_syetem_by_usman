<?php 
include('assets/includes/header.php');
if(!isset($_SESSION['productItems'])){
    echo '<script> window.location.href="orders-create.php"; </script>';
}
?>
<div class="modal fade" id="orderSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body">
        <div class="mb-3 p-4">
            <h4 id="orderPlaceSuccessMessage"> </h4>

        </div>
        <a href="orders.php" class="btn btn-secondary" >Close</a>
        <button type="button" class="btn btn-danger " onclick="printMyBillingArea()">Print</button>
    
      </div>
    </div>
  </div>
</div>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header">
                    <h4 class="mb-0">Order Summary
                        <a href="orders-create.php" class="btn btn-danger float-end">Back to Create Order</a>
                    </h4>
                </div>
                <div class="card-body">

                    <?php alertMessage()?>
                    <div id="myBillingArea">
                        <?php
                        if(isset($_SESSION['cphone']))
                        {
                            $phone = validate($_SESSION['cphone']);
                            $invoiceNo = validate($_SESSION['invoice_no']);
                            //$phone = validate($_SESSION['payment_mode']);
                            $customerQuery=mysqli_query($conn,"SELECT * FROM customers WHERE phone='$phone' LIMIT 1 ");
                            if($customerQuery){
                                if(mysqli_num_rows($customerQuery)>0){
                                    $cRowData=mysqli_fetch_assoc($customerQuery);
                                    ?>
                                    <table style="width: 100%; margin: bottom 20px;">
                                        <tbody>
                                            <!--Starts table--> 
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
                                                    <p style="font-size: 14px; line-height: 20px; margin:2px; padding:0;" >Customer Name:<?=$cRowData['name'] ?> </p>
                                                    <p style="font-size: 14px; line-height: 20px; margin:2px; padding:0;" >Customer Phone:<?=$cRowData['phone'] ?></p>
                                                    <p style="font-size: 14px; line-height: 20px; margin:2px; padding:0;" >Customer Email-ID:<?=$cRowData['email'] ?></p>
                                                </td>
                                                <td align="end">
                                                    <h4 style="font-size: 20px; line-height: 30px; margin:2px; padding:0;" >Invoice Details </h4>
                                                    <p style="font-size: 14px; line-height: 20px; margin:2px; padding:0;" >Invoice No:<?=$invoiceNo; ?> </p>
                                                    <p style="font-size: 14px; line-height: 20px; margin:2px; padding:0;" >Invoice Date:<?=date('d M Y')?></p>
                                                    <p style="font-size: 14px; line-height: 20px; margin:2px; padding:0;" >Invoice Address: #6#5, ,$th Block,HBR Layout,Bangalore</p>
                                                </td>
                                            </tr> 
                                                 
                                        </tbody>

                                    </table>

                                    <?php

                                }else{
                                    echo"<h5> No Customer Found</h5>";
                                    return;
                                }
                            }
                        }
                        ?>
                        <?php 
                        if(isset($_SESSION['productItems'])){
                            $sessionProducts=$_SESSION['productItems'];
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
                                    $totalAmount=0;
                                    foreach($sessionProducts as $key => $row):
                                    $totalAmount+= $row['price']*$row['quantity']    
                                    ?>
                                    <tr>
                                     <td style="border-bottom: 2px solid #ccc;" ><?= $i++?></td> 
                                     <td style="border-bottom: 2px solid #ccc;" ><?= $row['name']?></td>
                                     <td style="border-bottom: 2px solid #ccc;" ><?= number_format($row['price'],0)?></td>  
                                     <td style="border-bottom: 2px solid #ccc;" ><?= $row['quantity']?></td>
                                     <td style="border-bottom: 2px solid #ccc;" class="fw-bold">
                                        <?= number_format($row['price'] * $row['quantity'],0)?>
                                     </td>
                                    </tr>
                                    <?php endforeach;?>
                                    <tr>
                                        <td colspan="4" align="end" style="font-weight: bold;">Grand Total:</td>
                                        <td colspan="1" style="font-weight: bold;"><?= number_format($totalAmount,0) ?></td>
                                        
                                    </tr>
                                    <tr>
                                        <td colspan="5">Payment Method:<?= $_SESSION['payment_mode'];?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php

                        }else{
                            echo'<h4>No Record Found</h4>';
                        }
                        ?>

                    </div>
                    <?php if(isset($_SESSION['productItems'])): ?>
                    <div>
                       <div class="mt-4 text-end">
                        <button type="button" id="saveOrder" class="btn btn-primary px-4 mx-1">
                          Save
                        </button>
                        <button type="button" class="btn btn-danger " onclick="printMyBillingArea()">Print</button>
                     

                       </div>    
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include('assets/includes/footer.php');?>