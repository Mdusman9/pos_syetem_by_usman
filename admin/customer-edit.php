<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow">
    <div class="card-header">
        <h4 class="mb-0">Edit Customer
            <a href="customer.php" class="btn btn-primary float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">
    <?php alertMessage()?>
        <form action="code.php" method="POST">
            <?php 
              $paramValue=checkParamId('id');
              if(!is_numeric($paramValue)){
                echo'id is not a number';
                return false;

             }
             $customers=getById('customers',$paramValue);
             
                if($customers['status']==200)
                {
                     ?>
                     <input type="text" name="customersId" value="<?=$customers['data']['id']?>">
                <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="">Name*</label>
                    <input type="text" name="name" required value="<?=$customers['data']['name']?>" class="form-control"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Email Id*</label>
                    <input type="email" name="email" value="<?=$customers['data']['email']?>" class="form-control"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Phone*</label>
                    <input type="number" name="phone" required value="<?=$customers['data']['phone']?>" class="form-control"/>
                </div>
                <div class="col-md-6">
                    <lable>Status (UnChecked=Visible,Checked=Hidden)</lable>
                   </br>
                    <input  type="checkbox" name="status" <?=$customers['data']['status']==true?'checked':'';?> style="width: 30px;height: 30px; "/>
                </div>
                <div class="col-md-6 mb-3 ml-10 text-end">
                 </br></br></br>
                    <input style="margin-right: 1900px;" type="submit" name="updateCustomers" value="update">
                </div>
            </div>
        </form>
        <?php
                }else{
                    echo'<h5>'.$customers['messsage'].'</h5>';
                    return false;
                }

            ?>
           
        
    </div>
  </div>

</div>
                         
<?php include('assets/includes/footer.php');?>