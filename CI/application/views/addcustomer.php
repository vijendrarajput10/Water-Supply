<?php include("home_view.php"); ?>
        <div class="main-container">
            <div class="container">
                <div class="form-container">
                    <div class="form-title">
                        <h1 class="text-center">ADD Customer</h1>
                    </div>
                    <div class="error">
                    <?php echo validation_errors(); ?>
                    </div>  
                    <form action="<?php echo base_url(); ?>customer/addcustomerdata" method="post">
                    <table><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="name">Name</label></td><td>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $customer['c_name']; ?>" placeholder="Name" required="">
                        </div></td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="address">Address</label></td><td>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $customer['address']; ?>" placeholder="Address" required="">
                        </div></td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="contactno">Phone Number</label></td><td>
                            <input type="text" class="form-control" id="contactno" name="contactno" value="<?php echo $customer['contact_no']; ?>" placeholder="Contact no." required="">
                        </div></td></tr><tr><td>
                                  <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" id="submit" value="ADD">
                        </div>
                    </td></tr></table>
                    </form>                    
                </div>
            </div>
        </div>
    <?php include("footer.php"); ?>