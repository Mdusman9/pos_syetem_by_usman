<?php include('assets/includes/header.php');?>
<div class="container-fluid px-4">
  <div class="card mt-4 shadow">
    <div class="card-header">
        <h4 class="mb-0">Add Category
            <a href="category.php" class="btn btn-primary float-end">Back</a>
        </h4>
    </div>
    <div class="card-body">
    <?php alertMessage()?>
        <form action="code.php" method="POST">
            <?php
            $paramValue=checkParamId('id');
            if(!is_numeric($paramValue)){
                echo'<h5>'.$paramValue.'</h5>';
                return false;
            }
            //echo $paramValue;
            $category=getById('categories',$paramValue);
            if($category['status']==200)
            {
               ?>
            
            <div class="row">
            <input type="text" name="categoryId" required value="<?= $category['data']['id'];?>" class="form-control"/>
                <div class="col-md-6 mb-3">
                    <label for="">Name*</label>
                    <input type="text" name="name" value="<?=$category['data']['name']?>" required class="form-control"/>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    
                    <textarea type="text" name="description" value="" required class="form-control"><?=$category['data']['description']?></textarea>
                </div>
                <div class="col-md-6">
                <?php //echo $category['data']['status'];?>
                    <lable>Status (UnChecked=Visible,Checked=Hidden)</lable>
                   </br>
                    <input  type="checkbox" name="status"  <?=$category['data']['status']== true ? 'checked':'';?>  style="width: 30px;height: 30px; "/>
                </div>
                <div class="col-md-6 mb-3 ml-10 text-end">
                 </br></br></br>
                    <input style="margin-right: 1900px;" type="submit" name="updateCategory" value="Update">
                </div>
            </div>
            <?php
            }else{
                echo'<h3>'.$category['message'].'</h3>';
            }
            ?>
        </form>
        
    </div>
  </div>

</div>
                         
<?php include('assets/includes/footer.php');?>