<?php include("home_view.php"); ?>
        <div class="main-container">
            <div class="container">
                <div class="form-container">
                    <div class="form-title">
                        <h1 class="text-center">Edit Order</h1>
                    </div>
                    <div class="error">
                    <?php echo validation_errors(); ?>
                    </div>  
                   <?php foreach ($order as $key => $value) {  ?>

                    <form action="<?php echo base_url(); ?>order/updateorder/<?php echo $value['id']; ?>" method="post">
                    <table><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="customer_id">Customer Name</label></td><td>
                            <input type="hidden" id="customer_id" name="customer_id" value="<?php echo $value['customer_id']; ?>" >
                        </div>
                            <input type="text" disabled class="form-control" id="customer_id" name="customer_id" value="<?php echo $value['c_name']; ?>" >
                        </div>
                        </td></tr><td>
                        <div class="form-group">
                            <label class="control-label" for="deliveryboy_id">DeliveryBoy Name</label></td><td>
                            <input type="hidden" id="deliveryboy_" name="deliveryboy_id" value="<?php echo $value['deliveryboy_id']; ?>" > 
                            <input type="text" disabled class="form-control" id="deliveryboy_" name="deliveryboy_id" value="<?php echo $value['d_name']; ?>">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="number_of_container">Number Of Container</label></td><td>
                            <input type="text" class="form-control" id="number_of_container" name="number_of_container" value="<?php echo $value['number_of_container']; ?>" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="amount">Amount</label></td><td>
                            <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $value['amount']; ?>" required="">
                        </div>
                        </td></tr><tr><td>
                        <div class="form-group">
                            <label class="control-label" for="payment_status">Payment Status</label></td><td>                            
                            <select class="form-control" id="payment_status" name="payment_status">
                                <option <?php if ($value['payment_status'] == '0') echo ' selected="selected"'; ?> value="0" >Incomplete</option>
                                <option <?php if ($value['payment_status'] == '1') echo ' selected="selected"'; ?> value="1" >Complete</option>

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