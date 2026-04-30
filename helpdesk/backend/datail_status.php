<?php
	$sql = "SELECT s.s_status, COUNT(r.r_no) AS count_status
	FROM tb_repair AS r
	INNER JOIN tb_status AS s ON r.s_id = s.s_id
	GROUP BY s.s_id, s.s_status
	ORDER BY count_status DESC, s.s_status ASC";
	$query = mysqli_query($conn, $sql);
?>
<table id="table2" width="100%" class="table table-hover">
                                	<thead>
                                    	<tr class="bg-green">
                                        	<th width="5%" class="text-center">ลำดับ</th>
                                            <th width="85%">สถานะการซ่อม</th>
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
                                       		<td><?php echo $rows['s_status'];?></td>
                                            <td><span class="badge badge bg-red"><?php echo $rows['count_status'];?></span></td>
                                        </tr>
                                    <?php $i++; } ?>
                                    </tbody>
</table>
