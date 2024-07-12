<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow">
    <div class="card-header">
        <h4 class="mb-0">Admins/Staff
            <a href="admins.php" class="btn btn-primary float-end">Back</a>
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
                <div class="col-md-6 mb-3">
                    <label for="">Email*</label>
                    <input type="email" name="email" required class="form-control"/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Password*</label>
                    <input type="password" name="password" required class="form-control"/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Phone No*</label>
                    <input type="number" name="phoneno" required class="form-control"/>
                </div>
                <div class="col-md-6 mb-3 ">
                    <label for="">Access*</label>
                    <input  type="checkbox" name="is_ban" style="width: 30px;height: 30px; margin-top: 25px;"/>
                </div>
                <div class="col-md-6 mb-3 text-end">
                    <input type="submit" name="saveAdmin" value="Submit">
                </div>
            </div>
        </form>
        
    </div>
  </div>

</div>
                         
<?php include('assets/includes/footer.php');?>