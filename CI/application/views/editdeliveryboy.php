<?php include("home_view.php"); ?>
        <div class="main-container">
            <div class="container">
                <div class="form-container">
                    <div class="form-title">
                        <h1 class="text-center">EDIT Delivery Boy Details</h1>
                    </div>
                   <div class="error">
                    <?php echo validation_errors(); ?>
                    </div>  
                <?php foreach ($deliveryboy as $key => $value) {  ?>
                    <form action="<?php echo base_url(); ?>deliveryboy/updatedetails/<?php echo $value['id']; ?>" method="post">
                    <table><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="name">Name</label></td><td>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $value['d_name']; ?>" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="address">Address</label></td><td>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $value['address']; ?>" required="">
                        </div>
                        </div></td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="date of birth">Date of Birth</label></td><td>
                            <input type="date" class="form-control" id="dateofbirth" name="dateofbirth" value="<?php echo $value['date_of_birth']; ?>" required="">
                        </div>
                        </div></td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="phoneno">Phone Number</label></td><td>
                            <input type="text" class="form-control" id="phoneno" name="phoneno" value="<?php echo $value['phone_no']; ?>" required="">
                        </div>
                        </div></td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="workingtime">Working Time</label></td><td>
                            <input type="text" class="form-control" id="workingtime" name="workingtime" value="<?php echo $value['working_time']; ?>" required="">
                        </div>
                        </div></td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="joiningdate">Joining Date</label></td><td>
                            <input type="date" class="form-control" id="joiningdate" name="joiningdate" value="<?php echo $value['joining_date']; ?>" required="">
                        </div>
                        </div></td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="relivingdate">Reliving Date</label></td><td>
                            <input type="date" class="form-control" id="relivingdate" name="relivingdate" value="<?php echo $value['reliving_date']; ?>" required="">
                        </div>
                        </div></td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="Salary">Salary</label></td><td>
                            <input type="text" class="form-control" id="salary" name="salary" value="<?php echo $value['salary']; ?>" required="">
                        </div>
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