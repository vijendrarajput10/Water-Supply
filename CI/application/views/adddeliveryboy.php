<?php include("home_view.php"); ?>
       <div class="main-container">
            <div class="container">
                <div class="form-container">
                    <div class="form-title">
                        <h1 class="text-center">ADD Delivery Boy Details</h1>
                    </div>
                    <div class="error">
                    <?php echo validation_errors(); ?>
                    </div>  
                    <form action="<?php echo base_url(); ?>deliveryboy/adddeliveryboydata" method="post">
                    <table><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="name">Name</label></td><td>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $deliveryboy['d_name']; ?>" placeholder="Deliveryboy Name" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="address">Address</label></td><td>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $deliveryboy['address']; ?>" placeholder="Address" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="date of birth">Date of Birth</label></td><td>
                            <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" value="<?php echo $deliveryboy['date_of_birth']; ?>" placeholder="Date of birth" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="phoneno">Phone Number</label></td><td>
                            <input type="text" class="form-control" id="phoneno" name="phoneno" value="<?php echo $deliveryboy['phone_no']; ?>" placeholder="Phone Number" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="workingtime">Working Time</label></td><td>
                            <input type="text" class="form-control" id="workingtime" name="workingtime" value="<?php echo $deliveryboy['working_time']; ?>" placeholder="Working time" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="joiningdate">Joining Date</label></td><td>
                            <input type="date" class="form-control" id="joiningdate" name="joiningdate" value="<?php echo $deliveryboy['joining_date']; ?>" placeholder="Joining Date" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="relivingdate">Reliving Date</label></td><td>
                            <input type="date" class="form-control" id="relivingdate" name="relivingdate" value="<?php echo $deliveryboy['reliving_date']; ?>" placeholder="Reliving Date" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="Salary">Salary</label></td><td>
                            <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $deliveryboy['salary']; ?>" placeholder="Salary" required="">
                        </div> 
                        </td></tr><tr><td>             
                            <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" id="submit" value="Submit">
                        </div>
                    </td></tr></table>
                    </form>                    
                </div>
            </div>
        </div>
<?php include("footer.php"); ?>