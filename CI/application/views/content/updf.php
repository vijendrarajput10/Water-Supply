<h2>USER DETAILS</h2>
<table class="table table-bordered table-hover" >
 <thead>
 <tr>
 <th>S.No.</th>
 <th>Name</th>
 <th>Usertype</th> 
 <th>Create Date</th>
 <th>Modify Date</th>
 </tr>
 </thead> 
 <tbody>
 <?php
 $i = 1;
 foreach ($users as $user){
   $id = $user['id'];
 ?>
 <tr>
 <td><?php echo $i ?></td>
 <td><?php echo $user['username'] ?></td>
 <td><?php echo $user['usertype'] ?></td> 
 <td><?php echo $user['create_date'] ?></td>
 <td><?php echo $user['modify_date'] ?></td>
 </tr>
 <?php
 $i++;
 }
 ?> 
 </tbody>
 </table>