<?php include("home_view.php"); ?>
        <div class="main-container">
            <div class="container">
                <div class="form-container">
                    <div class="form-title">
                        <h1 class="text-center">EDIT CUSTOMER DETAILS</h1>
                    </div>
                    <div class="error">
                    <?php echo validation_errors(); ?>
                    </div>  
                    <?php foreach ($customer as $key => $value) {  ?>
                    <form action="<?php echo base_url(); ?>customer/updatedetails/<?php echo $value['id']; ?>" method="post">
                        <table><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="name">Name</label></td><td>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $value['c_name']; ?>" required="">
                        </div></td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="address">Address</label></td><td>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $value['address']; ?>" required="">
                        </div></td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="contactno">Phone Number</label></td><td>
                            <input type="text" class="form-control" id="contactno" name="contactno" value="<?php echo $value['contact_no']; ?>" required="">
                        </div></td></tr><tr><td>
                                  <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" id="submit" value="Update">
                        </div>
                    </td></tr></table>
                    </form>
                    <?php
                }
                ?>                    
                </div>
            </div>
        </div>
<?php include("footer.php"); ?>