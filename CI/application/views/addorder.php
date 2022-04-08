<?php include("home_view.php"); ?>
        <div class="main-container">
            <div class="container">
                <div class="form-container">
                    <div class="form-title">
                        <h1 class="text-center">ADD Order</h1>
                    </div>
                    <div class="error">
                    <?php echo validation_errors(); ?>
                    </div>  
                    <form action="<?php echo base_url(); ?>order/addorder" method="post">
                    <table><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="customer_id">Customer Name</label></td><td>
                            <select name="customer_id" required="" >  
                                <option value="" >Select</option>
                            <?php
                              foreach ($customers as $customer){
                               $id = $customer['id'];
                             ?>                 
                            <option value="<?php echo $customer['id'] ?>"><?php echo $customer['c_name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        </td></tr><td>
                        <div class="form-group">
                            <label class="control-label" for="deliveryboy_id">DeliveryBoy Name</label></td><td>
                            <select name="deliveryboy_id" required="">
                                <option value="" >Select</option>
                            <?php
                              foreach ($deliveryboys as $deliveryboy){
                               $id = $deliveryboy['id'];
                             ?>                 
                            <option value="<?php echo $deliveryboy['id'] ?>"><?php echo $deliveryboy['d_name'] ?></option>
                            <?php } ?>
                            </select>                            
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="number_of_container">Number Of Container</label></td><td>
                            <input type="text" class="form-control" id="number_of_container" name="number_of_container" value="<?php echo $order['number_of_container']; ?>" placeholder="Number Of Container" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="amount">Amount</label></td><td>
                            <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $order['amount']; ?>" placeholder="Amount " required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="payment_status">Payment Status</label></td><td>
                            <select name="payment_status" required="" >  
                            <option value="" >Select</option>
                            <option value="0">Complete</option>
                            <option value="1" >Incomplete</option>                            
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