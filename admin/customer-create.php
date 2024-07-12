<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow">
    <div class="card-header">
        <h4 class="mb-0">Add Customer
            <a href="customer.php" class="btn btn-primary float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">
        <form action="code.php" method="POST">
            <?php alertMessage()?>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="">Name*</label>
                    <input type="text" name="name" required class="form-control"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Email Id*</label>
                    <input type="email" name="email" class="form-control"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Phone*</label>
                    <input type="number" name="phone" required class="form-control"/>
                </div>
                <div class="col-md-6">
                    <lable>Status (UnChecked=Visible,Checked=Hidden)</lable>
                   </br>
                    <input  type="checkbox" name="status" style="width: 30px;height: 30px; "/>
                </div>
                <div class="col-md-6 mb-3 ml-10 text-end">
</br></br></br>
                    <input style="margin-right: 1900px;" type="submit" name="saveCustomers" value="Save">
                </div>
            </div>
        </form>
        
    </div>
  </div>

</div>
                         
<?php include('assets/includes/footer.php');?>