<?php include("home_view.php"); ?>
        <div class="main-container">
            <div class="container">
                <div class="form-container">
                    <div class="form-title">
                    <div class="error">
                    <?php echo validation_errors(); ?>
                    </div>    
                        <h1 class="text-center">EDIT USER DETAILS</h1>
                    </div>
                     <?php foreach ($user as $key => $value) {  ?>
                    <form action="<?php echo base_url(); ?>User/updateUser/<?php echo $value['id']; ?>" method="post">
                    <table><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="username">User Name</label></td><td>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $value['username']; ?>" required="">
                        </div>
                        </td></tr><td>
                        <div class="form-group">
                            <label class="control-label" for="password">Password</label></td><td>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $value['password']; ?>" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="cnfpassword">Confirm Password</label></td><td>
                            <input type="password" class="form-control" id="cnfpassword" name="cnfpassword" value="<?php echo $value['password']; ?>" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="usertype">User Type</label></td><td>
                            <input type="text" id="usertype"  name="usertype" class="form-control" value="<?php echo $value['usertype']; ?>" >
    					</div>
                        </td></tr><tr><td>
                                    
                            <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" id="submit" value="Update">
                        </div>
                        </td></tr>
                    </table>
                    </form>
                    <?php
                }
                ?>                    
                </div>
            </div>
        </div>
    <?php include("footer.php"); ?>