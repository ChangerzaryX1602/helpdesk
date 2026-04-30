<!-- Modal Delete Position -->
<div class="modal fade" id="deletePositionModal<?php echo $rows['p_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <form name="frm_delete_admin" method="post">
      <div class="modal-body" id="txtModal">
      	  <img src="../icon/warning.png">
          <h3 id="txtDel"><b>คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลที่เลือก ?</b></h3>
          <h5 id="txtDel2"><b><?php echo $rows['p_position'];?></b></h5>
          <input type="hidden" name="p_id" value="<?php echo $rows['p_id'];?>">
          <button type="submit" class="btn btn bg-green" name="btnDeletePosition" id="btnDeletePosition">ใช่ต้องการลบ Yes</button>
		  <button type="button" class="btn btn bg-red" data-dismiss="modal">ไม่ต้องการลบ No</button>
      </div> <!-- ./modal body -->
      </form>
    </div>
  </div>
</div>

<!-- Modal Delete Department -->
<div class="modal fade" id="deleteDepartmentModal<?php echo $rows['dep_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <form name="frm_delete_department" method="post">
      <div class="modal-body" id="txtModal">
      	  <img src="../icon/warning.png">
          <h3 id="txtDel"><b>คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลที่เลือก ?</b></h3>
          <h5 id="txtDel2"><b><?php echo $rows['dep_name'];?></b></h5>
          <input type="hidden" name="dep_id" value="<?php echo $rows['dep_id'];?>">
          <button type="submit" class="btn btn bg-green" name="btnDeleteDepartment" id="btnDeleteDepartment">ใช่ต้องการลบ Yes</button>
		  <button type="button" class="btn btn bg-red" data-dismiss="modal">ไม่ต้องการลบ No</button>
      </div> <!-- ./modal body -->
      </form>
    </div>
  </div>
</div>

<!-- Modal Delete Equipment -->
<div class="modal fade" id="deleteEquipmentModal<?php echo $rows['eq_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <form name="frm_delete_equipment" method="post">
      <div class="modal-body" id="txtModal">
      	  <img src="../icon/warning.png">
          <h3 id="txtDel"><b>คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลที่เลือก ?</b></h3>
          <h5 id="txtDel2"><b><?php echo $rows['eq_name'];?></b></h5>
          <input type="hidden" name="eq_id" value="<?php echo $rows['eq_id'];?>">
          <button type="submit" class="btn btn bg-green" name="btnDeleteEquipment" id="btnDeleteEquipment">ใช่ต้องการลบ Yes</button>
		  <button type="button" class="btn btn bg-red" data-dismiss="modal">ไม่ต้องการลบ No</button>
      </div> <!-- ./modal body -->
      </form>
    </div>
  </div>
</div>

<!-- Modal Delete Building -->
<div class="modal fade" id="deleteBuildingModal<?php echo $rows['build_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <form name="frm_delete_equipment" method="post">
      <div class="modal-body" id="txtModal">
      	  <img src="../icon/warning.png">
          <h3 id="txtDel"><b>คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลที่เลือก ?</b></h3>
          <h5 id="txtDel2"><b><?php echo $rows['build_name'];?></b></h5>
          <input type="hidden" name="build_id" value="<?php echo $rows['build_id'];?>">
          <button type="submit" class="btn btn bg-green" name="btnDeleteBuilding" id="btnDeleteBuilding">ใช่ต้องการลบ Yes</button>
		  <button type="button" class="btn btn bg-red" data-dismiss="modal">ไม่ต้องการลบ No</button>
      </div> <!-- ./modal body -->
      </form>
    </div>
  </div>
</div>

<!-- Modal Cancel User -->
<div class="modal fade" id="cancelUserModal<?php echo $rows['u_idcard'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <form name="frm_cancel_user" method="post">
      <div class="modal-body" id="txtModal">
      	  <img src="../icon/warning.png">
          <h3 id="txtDel"><b>คุณแน่ใจหรือไม่ว่าต้องการปิดการใช้งาน ?</b></h3>
          <h5 id="txtDel2"><b><?php echo $rows['u_fname'];?> <?php echo $rows['u_lname'];?></b></h5>
          <input type="hidden" name="u_idcard" value="<?php echo $rows['u_idcard'];?>">
          <button type="submit" class="btn btn bg-green" name="btnCancelUser" id="btnCancelUser">ใช่ Yes</button>
		  <button type="button" class="btn btn bg-red" data-dismiss="modal">ไม่ใช่ No</button>
      </div> <!-- ./modal body -->
      </form>
    </div>
  </div>
</div>

<!-- Modal Cancel User On -->
<div class="modal fade" id="cancelUserOnModal<?php echo $rows['u_idcard'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <form name="frm_cancel_user" method="post">
      <div class="modal-body" id="txtModal">
      	  <img src="../icon/warning.png">
          <h3 id="txtDel"><b>คุณแน่ใจหรือไม่ว่าต้องการเปิดการใช้งาน ?</b></h3>
          <h5 id="txtDel2"><b><?php echo $rows['u_fname'];?> <?php echo $rows['u_lname'];?></b></h5>
          <input type="hidden" name="u_idcard" value="<?php echo $rows['u_idcard'];?>">
          <button type="submit" class="btn btn bg-green" name="btnCancelUserOn" id="btnCancelUserOn">ใช่ Yes</button>
		  <button type="button" class="btn btn bg-red" data-dismiss="modal">ไม่ใช่ No</button>
      </div> <!-- ./modal body -->
      </form>
    </div>
  </div>
</div>

<!-- Modal Cancel cancelRepairModal -->
<div class="modal fade" id="cancelRepairModal<?php echo $rows['r_no'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 10px;">
      <form name="frm_cancel_user" method="post">
      <div class="modal-body" id="txtModal">
      	  <img src="../icon/warning.png">
          <h3 id="txtDel"><b>คุณแน่ใจหรือไม่ว่าต้องการยกเลิกรายการซ่อม ?</b></h3>
          <input type="hidden" name="r_no" value="<?php echo $rows['r_no'];?>">
          <button type="submit" class="btn btn bg-green" name="btnCancelRepair" id="btnCancelRepair">ใช่ Yes</button>
		  <button type="button" class="btn btn bg-red" data-dismiss="modal">ไม่ใช่ No</button>
      </div> <!-- ./modal body -->
      </form>
    </div>
  </div>
</div>











