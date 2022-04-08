<h2>ORDER DETAILS</h2>

<table class="table table-bordered table-hover" >
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
 </tr>
 </thead> 
 <tbody>
 <?php
 $i = 1;
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
 </tr>
 <?php
 $i++;
 }
 ?>
 </tbody>
 </table>