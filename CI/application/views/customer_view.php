<?php include("home_view.php"); ?>     
 <div class="wrapper">
 <div class="main-container">
 <div class="customer-container">
 <div class="form-title">
  <div class="gpdf">  
   <a href=<?php echo $pdf ?> ><img src="<?php echo base_url()?>image/1.jpg"></a>    
   </div>
  <h1 class="text-center">Customers Details</h1>
 </div>
  <div class="icon-addon addon-lg">
    <form action ="<?php echo base_url(); ?>customer/search" method="post" >
                            <select name="customer_id" >      
                                <option value = "" >Customer</option>
                            <?php
                              foreach ($search as $customer){
                               $id = $customer['id'];
                             ?>  
                                  <option value="<?php echo $customer['id']; ?>"<?php echo set_select('customer_id',  $customer['id']); ?>><?php echo $customer['c_name']; ?></option>               
                            
                            <?php } ?>
                            </select> 
                            <label>From date</label> <input type="date"  id="from_date" name="from_date" value = "<?php echo $fromdate ?>">
                            <label>To date</label> <input type="date"  id="to_date" name="to_date"  value = "<?php echo $todate ?>">      
<input type="submit" class="btn btn-primary">
  </form>
  </div>
 <div class="table-data">
 <div class="table-responsive">
 <table class="table table-bordered table-hover">
 <?php 
 if(!empty($customers))
 {
 ?> 
 <thead>
 <tr>
 <th>S.No.</th> 
 <th>Name</th>
 <th>Address</th>
 <th>Contact Detail</th>
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
  foreach ($customers as $customer){
   $id = $customer['id'];
 ?>
 <tr>
 <td><?php echo $i ?></td> 
 <td><?php echo $customer['c_name'] ?></td>
 <td><?php echo $customer['address'] ?></td>
 <td><?php echo $customer['contact_no'] ?></td>
 <td><?php echo $customer['create_date'] ?></td>
 <td><?php echo $customer['modify_date'] ?></td>
 <td>
 <a href="<?php echo base_url(); ?>customer/getcustomer/<?php echo $customer["id"]?>">
 <button type="button" class="btn btn-success">Edit</button>
 </a> 
 </td>
 <td>
 <button type="button" class="btn btn-danger"><?php 
 echo anchor('customer/deletedetails/'.$id, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
 ?></button>
 </td>
 </tr>
 <?php
 $i++;
 }
 ?> 
 </tbody>
 </table> 
 <?php if (isset($customers) && is_array($customers)) echo $page_links; ?>  
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