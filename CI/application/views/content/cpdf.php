<h2>CUSTOMER DETAILS</h2>
<table class="table table-bordered table-hover">
 <thead>
 <tr>
 <th>S.No.</th>
 <th>Name</th>
 <th>Address</th>
 <th>Contact Detail</th>
 <th>Create Date</th>
  <th>Modify Date</th>
 </tr>
 </thead> 
 <tbody>
 <?php
 $i = 1;
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
 </tr>
 <?php
 $i++;
 }
 ?>
 </tbody>
 </table>  
 