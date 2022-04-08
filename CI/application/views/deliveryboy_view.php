<?php include("home_view.php"); ?>
 <div class="wrapper">
 <div class="main-container">
 <div class="deliveryboy-container">
 <div class="form-title">
  <div class="gpdf">  
    <a href=<?php echo $pdf ?>><img src="<?php echo base_url()?>image/1.jpg"></a>    
   </div>
 <h1 class="text-center">Delivery Boy Details</h1>
</div>
<div class="icon-addon addon-lg">
    <form action ="<?php echo base_url(); ?>deliveryboy/search" method="post" >
                              <select name="deliveryboy_id" >
                                <option value="" >DeliveryBoy</option>
                            <?php
                              foreach ($search as $deliveryboy){
                               $id = $deliveryboy['id'];
                             ?>                 
                            <option value="<?php echo $deliveryboy['id']; ?>"<?php echo set_select('deliveryboy_id',$deliveryboy['id']); ?>><?php echo $deliveryboy ['d_name'];?></option>  
                            <?php } ?>
                            </select> 
                            <label>From Date</label> <input type="date"  id="from_date" name="from_date" value = "<?php echo $fromdate ?>">
                            <label>To Date</label> <input type="date"  id="to_date" name="to_date" value = "<?php echo $todate ?>">     
                            <input type="submit" class="btn btn-primary"  >
  </form>
  </div>
 <div class="table-data">
 <div class="table-responsive">
 <table class="table table-bordered table-hover" >
 <?php 
 if(!empty($deliveryboys))
 {
 ?> 
 <thead>
 <tr>
 <th>S.No.</th>
 <th>Name</th>
 <th>Address</th>
 <th>Date of birth</th>
 <th>Contact Detail</th>
 <th>Working Time</th>
 <th>Joining Date</th>
 <th>Reliving Date</th>
 <th>Salary</th> 
 <th>create Date</th>
 <th>modify Date</th> 
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
 foreach ($deliveryboys as $deliveryboy){
   $id = $deliveryboy['id'];
 ?>
 <tr>
 <td><?php echo $i ?></td>
 <td><?php echo $deliveryboy['d_name'] ?></td>
 <td><?php echo $deliveryboy['address'] ?></td>
 <td><?php echo $deliveryboy['date_of_birth'] ?></td>
 <td><?php echo $deliveryboy['phone_no'] ?></td>
 <td><?php echo $deliveryboy['working_time'] ?></td>
 <td><?php echo $deliveryboy['joining_date'] ?></td>
 <td><?php echo $deliveryboy['reliving_date'] ?></td>
 <td><?php echo $deliveryboy['salary'] ?></td> 
 <td><?php echo $deliveryboy['create_date'] ?></td>
 <td><?php echo $deliveryboy['modify_date'] ?></td> 
 <td>
 <a href="<?php echo base_url(); ?>deliveryboy/getdeliveryboy/<?php echo $deliveryboy["id"]?>">
 <button type="button" class="btn btn-success">Edit</button>
 </a> 
 </td>
 <td>
 <button type="button" class="btn btn-danger"><?php 
 echo anchor('deliveryboy/deletedetails/'.$id, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
 ?></button>
 </td>
 </tr>
 <?php
 $i++;
 }
 ?>
 
 </tbody>
 </table>
  <?php if (isset($deliveryboys) && is_array($deliveryboys)) echo $page_links; ?> 
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
</div>
<?php include("footer.php"); ?>