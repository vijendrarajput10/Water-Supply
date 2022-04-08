<?php include("home_view.php"); ?>
 <div class="wrapper">
 <div class="main-container">
 <div class="users-container">
 <div class="form-title">
  <div class="gpdf">  
    <a href=<?php echo $pdf ?> ><img src="<?php echo base_url()?>image/1.jpg"></a> 
   </div>
 <h1 class="text-center">Users Details</h1>
 </div>
 <div class="icon-addon addon-lg">
    <form action ="<?php echo base_url(); ?>user/search" method="post" >
    						            <select name="user_id" >
                                <option value="" >User</option>
                            <?php
                              foreach ($search as $user){
                               $id = $user['id'];
                             ?>                 
                            <option value="<?php echo $user['id'] ?>" <?php echo set_select('user_id',  $user['id']); ?>><?php echo $user['username'] ?></option>
                            <?php } ?>
                            </select>                             
                            <label> From date</label><input type="date"  id="from_date" name="from_date" value = "<?php echo $fromdate ?>">
                            <label>To date</label> <input type="date"  id="to_date" name="to_date" value = "<?php echo $todate ?>" >
<input type="submit" class="btn btn-primary"  >
  </form>
  </div>
 <div class="table-data">
 <div class="table-responsive">
 <table class="table table-bordered table-hover" >
 <?php 
 if(!empty($users))
 {
 ?> 
 <thead>
 <tr>
 <th>S.No.</th>
 <th>Name</th>
 <th>Usertype</th>
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
} foreach ($users as $user){
   $id = $user['id'];
 ?>
 <tr>
 <td><?php echo $i ?></td>
 <td><?php echo $user['username'] ?></td>
 <td><?php echo $user['usertype'] ?></td>
 <td><?php echo $user['create_date'] ?></td>
 <td><?php echo $user['modify_date'] ?></td>
 <td>
 <a href="<?php echo base_url(); ?>user/getuser/<?php echo $user["id"]?>">
 <button type="button" class="btn btn-success">Edit</button>
 </a> 
 </td>
 <td>
 <button type="button" class="btn btn-danger"><?php 
 echo anchor('user/deleteuser/'.$id, 'Delete', array('onClick' => "return confirm('Are you sure you want to delete?')"));
 ?></button>
 </td>
 </tr>
 <?php
 $i++;
 }
 ?>
 
 </tbody>
 </table>
 <?php if (isset($users) && is_array($users)) echo $page_links; ?> 
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