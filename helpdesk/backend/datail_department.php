<?php
	$sql = "SELECT d.dep_name, COUNT(r.r_no) AS count_dep
	FROM tb_repair AS r
	INNER JOIN tb_user AS u ON r.u_idcard = u.u_idcard
	INNER JOIN tb_department AS d ON u.dep_id = d.dep_id
	GROUP BY d.dep_id, d.dep_name
	ORDER BY count_dep DESC, d.dep_name ASC";
	$query = mysqli_query($conn, $sql);
?>
<table id="table2" width="100%" class="table table-hover">
                                	<thead>
                                    	<tr class="bg-green">
                                        	<th width="5%" class="text-center">ลำดับ</th>
                                            <th width="85%">แผนก</th>
                                            <th width="10%" class="text-center">จำนวน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
										$i = 1;
										while($rows = mysqli_fetch_array($query)) {
									?>
                                    	<tr>
                                        	<td><?php echo $i;?></td>
                                       		<td><?php echo $rows['dep_name'];?></td>
                                            <td><span class="badge badge bg-red"><?php echo $rows['count_dep'];?></span></td>
                                        </tr>
                                    <?php $i++; } ?>
                                    </tbody>
</table>
