<?php include("home_view.php"); ?>
        <div class="main-container">
            <div class="container">
                <div class="form-container">
                    <div class="form-title">
                        <h1 class="text-center">ADD User</h1>
                    </div>
                    <div class="error">
                    <?php echo validation_errors(); ?>
                    </div>    
                    <form action="<?php echo base_url(); ?>User/register" method="post">
                    <table><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="username">User Name</label></td><td>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" placeholder="UserName" required="">
                        </div>
                        </td></tr><td>
                        <div class="form-group">
                            <label class="control-label" for="password">Password</label></td><td>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="cnfpassword">Confirm Password</label></td><td>
                            <input type="password" class="form-control" id="cnfpassword" name="cnfpassword" placeholder="Confirm Password " required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="usertype">User Type</label></td><td>
                            <input list="usertype" name="usertype" class="form-control" placeholder=" select " required="">
                            <datalist id="usertype">
                            <option value="Admin">
    						<option value="Super User">
                        </div>
                        </td></tr><tr><td>
                                    
                            <div class="form-group">
                            <input type="submit" class="form-control btn btn-primary" id="submit" value="Submit">
                        </div>
                        </td></tr>
                    </table>
                    </form>                    
                </div>
            </div>
        </div>
    <?php include("footer.php"); ?>