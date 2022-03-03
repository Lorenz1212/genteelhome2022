<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
<?php
echo '<table id="customers">
			<thead>
				<th>ITEM</th>
				<th>STOCKS</th>
				<th>ACTUAL</th>
			</thead>';
$query = $this->db->select('*')->from('tbl_materials')->get();
foreach($query->result() as $row){
	echo'<tr>
		<td>'.$row->item.'</td>
		<td>'.$row->stocks.'</td>
		<td></td>
	</tr>';
}
echo'</table>';
?>
 <script type="text/javascript">
         window.onafterprint = window.close;
         window.print();
      </script>
