<h2>DELIVERY BOY DETAILS</h2>
<table class="table table-bordered table-hover" > 
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
 </tr>
 </thead> 
 <tbody>
 <?php
 $i = 1;
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
 </tr>
 <?php
 $i++;
 }
 ?> 
 </tbody>
 </table>