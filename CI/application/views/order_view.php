<?php include("home_view.php"); ?>
 <div class="wrapper">
 <div class="main-container">
 <div class="orders-container">
 <div class="form-title">
  <div class="gpdf">
    <a href=<?php echo $pdf ?> ><img src="<?php echo base_url()?>image/1.jpg"></a>      
  </div>
 <h1 class="text-center">Order Details</h1>
  </div>
 <div class="seabtn" >
    <form action ="<?php echo base_url(); ?>order/search" method="post" >
                              <select name="customer_id">      
                                <option value="" >Customer</option>
                            <?php
                              foreach ($customers as $customer){
                               //$id = $customer['id'];
                             ?>  
                                  <option value="<?php echo $customer['id']; ?>"<?php echo set_select('customer_id',  $customer['id']); ?>><?php echo $customer['c_name']; ?></option>
                            
                            <?php } ?>
                            </select>                        
                            <select name="deliveryboy_id" >
                                <option value="" >DeliveryBoy</option>
                            <?php
                              foreach ($deliveryboys as $deliveryboy){
                               //$id = $deliveryboy['id'];
                             ?>   
                                  <option value="<?php echo $deliveryboy['id']; ?>"<?php echo set_select('deliveryboy_id',  $deliveryboy['id']); ?>><?php echo $deliveryboy['d_name']; ?></option>              
                            <!--<option value="<?php echo $deliveryboy['id'] ?>"><?php echo $deliveryboy['d_name'] ?></option> -->
                            <?php } ?>
                            </select>  
                            <label>From Date</label> <input type="date"  id="from_date" name="from_date" value = "<?php echo $fromdate ?>">
                            <label>To Date</label> <input type="date"  id="to_date" name="to_date" value = "<?php echo $todate ?>">
                        
<input type="submit" class="btn btn-primary"  >
</div>   
  </form>
  </div>
 <div class="table-data">
 <div class="table-responsive">
 <table class="table table-bordered table-hover" >
 <?php 
 if(!empty($orders))
 {
 ?> 
 <thead>
 <tr>
 <th>S.No.</th>
 <th>Customer Name</th>
 <th>DeliveryBoy Name</th>
 <th>Number Of Container</th>
 <th>Amount</th>
 <th>Payment Status</th>
 <th>Create Date</th>
 <th>Modify Date</th>
 <th>Edit</th>
 <th>Delete</th>
 </tr>
 </thead> 
 <tbody>
 <?php
if ($page == 0) {
  $i = 1;
} else {
  $i =(1+ ($items_per_page*($page-1)));
}
 foreach ($orders as $order){
   $id = $order['id'];
 ?>
 <tr>
 <td><?php echo $i ?></td>
 <td><?php echo $order['c_name'] ?></td>
 <td><?php echo $order['d_name'] ?></td>
 <td><?php echo $order['number_of_container'] ?></td>
 <td><?php echo $order['amount'] ?></td>
   <td><?php 
   if($order['payment_status']==0)
   { 
    echo "Incomplete";
   } else
   {
    echo "Complete";
   } ?></td>
   <td><?php echo $order['create_date'] ?></td>
   <td><?php echo $order['modify_date'] ?></td>

 <td>
 <a href="<?php echo base_url(); ?>order/getorder/<?php echo $order["id"]?>">
 <button type="button" class="btn btn-success">Edit</button>
 </a> 
 </td>
 <td>
 <button type="button" class="btn btn-danger"><?php 
 echo anchor('order/deleteorder/'.$id, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
 ?></button>
 </td>
 </tr>
 <?php
 $i++;
 }
 ?> 
 </tbody>
 </table>
 <?php if (isset($orders) && is_array($orders)) echo $page_links; ?>  
 <?php 
 }
 else
 {
 ?> 
 <p class="alert alert-danger text-center">No Records Found</p>
 <?php 
 } 
 ?>
 </div>
 </div>
 </div>
 </div>
 </div> 
<?php include("footer.php"); ?>