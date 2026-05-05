<!-- Modal ตำแหน่งงาน -->
<div class="modal fade" id="editPositionModal<?php echo $rows['p_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4><span class="fa fa-edit"></span> <b>แก้ไขข้อมูลตำแหน่ง</b></h4>
      </div>
      <form name="frm_edit_position" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <label style="color:#000;"><b>ชื่อตำแหน่งงาน</b></label>
            <input type="text" name="p_position" value="<?php echo $rows['p_position'];?>" class="form-control" required="">
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="p_id" value="<?php echo $rows['p_id'];?>">
        <button type="submit" name="btnEditPosition" id="btnEditPosition" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal แผนก -->
<div class="modal fade" id="editDepartmentModal<?php echo $rows['dep_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4><span class="fa fa-edit"></span> <b>แก้ไขข้อมูลแผนก</b></h4>
      </div>
      <form name="frm_edit_department" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <label style="color:#000;"><b>ชื่อแผนก</b></label>
            <input type="text" name="dep_name" value="<?php echo $rows['dep_name'];?>" class="form-control" required="">
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="dep_id" value="<?php echo $rows['dep_id'];?>">
        <button type="submit" name="btnEditDepartment" id="btnEditDepartment" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal อุปกรณ์ -->
<div class="modal fade" id="editEquipmentModal<?php echo $rows['eq_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4><span class="fa fa-edit"></span> <b>แก้ไขข้อมูลอุปกรณ์</b></h4>
      </div>
      <form name="frm_edit_equipment" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
             <label style="color:#000;"><b>อุปกรณ์</b></label>
            <input type="text" name="eq_name" value="<?php echo $rows['eq_name'];?>" class="form-control" required="">
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="eq_id" value="<?php echo $rows['eq_id'];?>">
        <button type="submit" name="btnEditEquipment" id="btnEditEquipment" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal อาคาร -->
<div class="modal fade" id="editBuildingModal<?php echo $rows['build_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4><span class="fa fa-edit"></span> <b>แก้ไขข้อมูลอาคาร / ตึก</b></h4>
      </div>
      <form name="frm_edit_building" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <label style="color:#000;"><b>อาคาร / ตึก</b></label>
            <input type="text" name="build_name" value="<?php echo $rows['build_name'];?>" class="form-control" required="">
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="build_id" value="<?php echo $rows['build_id'];?>">
        <button type="submit" name="btnEditBuilding" id="btnEditBuilding" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal มอบหมายงาน -->
<div class="modal fade" id="approveRepairModal<?php echo $rows['r_no'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4><span class="fa fa-edit"></span> <b>มอบหมายงานซ่อม</b></h4>
      </div>
      <form name="frm_edit_building" method="post" enctype="multipart/form-data">
      <div class="modal-body">
         <div class="form-group">
            <h4 style="color:blue;"><b><?php echo $rows['eq_name'];?> <?php echo $rows['r_name'];?></b></h4>
            <h6 style="color:blue;">
            <hr>หมายเลขเครื่อง : <?php echo $rows['r_serialnumber'];?>
            <hr>แผนก : <?php echo $rows['dep_name'];?>
            <hr><?php echo $rows['build_name'];?> ชั้น <?php echo $rows['floor'];?> ห้อง <?php echo $rows['room'];?></hr>
			</h6>
          </div>
          <div class="form-group">
            <label style="color:blue;"><b>มอบหมายงานซ่อม</b></label>
			<select name="technician_id" class="form-control" required="" style="background-color:#1d1d2c; color:#FFF;">
				<option value="">เลือกผู้ดำเนินการซ่อม</option>
				<?php
					$sql2 = "SELECT * FROM tb_user WHERE level_id = '04' AND u_status = '1' ORDER BY u_fname ASC";
					$query2 = mysqli_query($conn, $sql2);
					while($row2 = mysqli_fetch_array($query2)) {
				?>
				<option value="<?php echo $row2['u_idcard'];?>"><?php echo $row2['u_prefix'];?><?php echo $row2['u_fname'];?> <?php echo $row2['u_lname'];?></option>
				<?php } ?>
			</select>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="r_no" value="<?php echo $rows['r_no'];?>">
        <input type="hidden" name="head_id" value="<?php echo $record['u_idcard'];?>">
        <button type="submit" name="btnApprove" id="btnApprove" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal ส่งงาน -->
<div class="modal fade" id="sentRepairModal<?php echo $rows['r_no'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4><span class="fa fa-send (alias)"></span> <b>ส่งงานรายการแจ้งซ่อม</b></h4>
      </div>
      <form name="frm_edit_building" method="post" enctype="multipart/form-data">
      <div class="modal-body">
         <div class="form-group">
            <h4 style="color:blue;"><b><?php echo $rows['eq_name'];?> <?php echo $rows['r_name'];?></b></h4>
            <h6 style="color:blue;">
            <hr>หมายเลขเครื่อง : <?php echo $rows['r_serialnumber'];?>
            <hr>แผนก : <?php echo $rows['dep_name'];?>
            <hr><?php echo $rows['build_name'];?> ชั้น <?php echo $rows['floor'];?> ห้อง <?php echo $rows['room'];?></hr>
			</h6>
          </div>
          <div class="form-group">
            <label style="color:blue;"><b>สถานะการซ่อม</b></label>
			<select name="s_id" class="form-control" required="" style="background-color:#1d1d2c; color:#FFF;">
				<option value="<?php echo $rows['s_id'];?>"><?php echo $rows['s_status'];?></option>
				<?php
					$sql2 = "SELECT * FROM tb_status WHERE s_id in('3','4') ORDER BY s_id ASC";
					$query2 = mysqli_query($conn, $sql2);
					while($row2 = mysqli_fetch_array($query2)) {
				?>
                <?php if($rows['s_id'] == $row2['s_id']) { ?>
                <?php } else { ?>
				<option value="<?php echo $row2['s_id'];?>"><?php echo $row2['s_status'];?></option>
                <?php } ?>
				<?php } ?>
			</select>
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="r_no" value="<?php echo $rows['r_no'];?>">
        <button type="submit" name="btnSent" id="btnSent" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal แก้ไขโปรไฟล์ -->
<div class="modal fade" id="editProfileModal<?php echo $record['u_idcard'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4><span class="fa fa-user"></span> <b>แก้ไขข้อมูลส่วนตัว</b></h4>
      </div>
      <form name="frm_edit_profile" method="post" enctype="multipart/form-data">
      <div class="modal-body">
      <div class="row">
          <div class="form-group col-md-6">
            <label style="color:#000;"><b>คำนำหน้า</b></label>
            <input type="text" name="u_prefix" value="<?php echo $record['u_prefix'];?>" class="form-control" required="">
          </div>
          <div class="form-group col-md-6"></div>
          <div class="form-group col-md-6">
            <label style="color:#000;"><b>ชื่อ</b></label>
            <input type="text" name="u_fname" value="<?php echo $record['u_fname'];?>" class="form-control" required="">
          </div>
          <div class="form-group col-md-6">
            <label style="color:#000;"><b>นามสกุล</b></label>
            <input type="text" name="u_lname" value="<?php echo $record['u_lname'];?>" class="form-control" required="">
          </div>
          <div class="form-group col-md-6">
            <label style="color:#000;"><b>เบอร์โทรศัพท์มือถือ</b></label>
            <input type="text" name="u_mobile" value="<?php echo $record['u_mobile'];?>" class="form-control" required="">
          </div>
           <div class="form-group col-md-6">
            <label style="color:#000;"><b>Email</b></label>
            <input type="text" name="u_email" value="<?php echo $record['u_email'];?>" class="form-control" required="">
          </div>
      </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="u_idcard" value="<?php echo $record['u_idcard'];?>">
        <button type="submit" name="btnEditProfile" id="btnEditProfile" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal reset Password -->
<div class="modal fade" id="resetPasswordModal<?php echo $record['u_idcard'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4><span class="fa fa-user"></span> <b>เปลี่ยนรหัสผ่านใหม่</b></h4>
      </div>
      <form name="frm_reset_password" method="post" enctype="multipart/form-data">
      <div class="modal-body">
          <div class="form-group">
            <label style="color:#000;"><b>รหัสผ่านใหม่</b></label>
            <input type="password" name="u_password1" class="form-control" required="" maxlength="50">
          </div>
          <div class="form-group">
            <label style="color:#000;"><b>ยืนยันรหัสผ่านใหม่อีกครั้ง</b></label>
            <input type="password" name="u_password2" class="form-control" required="" maxlength="50">
          </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="u_idcard" value="<?php echo $record['u_idcard'];?>">
        <button type="submit" name="btnResetPassword" id="btnResetPassword" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
      </div>
      </form>
    </div>
  </div>
</div>
