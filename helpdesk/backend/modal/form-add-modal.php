<!-- Modal เพิ่มประเภทรถ -->
<div class="modal fade" id="add_position" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-plus"></span> เพิ่มข้อมูลตำแหน่ง</h4>
      </div>
      <div class="modal-body">
      
      <form name="frm_add_position" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>ตำแหน่ง</label>
            <input type="text" name="p_position" class="form-control" required="">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="btnAddPosition" id="btnAddPosition" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Modal Department -->
<div class="modal fade" id="add_department" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  <form name="frm_add_department" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header bg-green">
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-plus"></span> เพิ่มข้อมูลแผนก</h4>
        
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label>แผนก</label>
            <input type="text" name="dep_name" class="form-control" required="">
          </div>
      </div> <!-- ./modal body -->
      <div class="modal-footer">
        <button type="submit" name="btnAddDepartment" id="btnAddDepartment" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
        
      </div>
    </div>
  </form>
  </div>
</div>

<!-- Modal Equipment -->
<div class="modal fade" id="add_equipment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form name="frm_add_equipment" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header bg-green">
        
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-plus"></span> เพิ่มข้อมูลอุปกรณ์</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label>อุปกรณ์</label>
            <input type="text" name="eq_name" class="form-control" required="">
          </div>
      </div> <!-- ./modal body -->
      <div class="modal-footer">
        <button type="submit" name="btnAddEquipment" id="btnAddEquipment" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
        
      </div>
    </div>
  </form>
  </div>
</div>

<!-- Modal Building -->
<div class="modal fade" id="add_building" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form name="frm_add_building" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header bg-green">
        
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><font color="#FFFFFF">&times;</font></span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="fa fa-plus"></span> เพิ่มข้อมูลอาคาร / ตึก</h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label>อาคาร/ตึก</label>
            <input type="text" name="build_name" class="form-control" required="">
          </div>
      </div> <!-- ./modal body -->
      <div class="modal-footer">
        <button type="submit" name="btnAddBuilding" id="btnAddBuilding" class="btn btn bg-green btn-sm">บันทึกข้อมูล</button>
        <button type="button" class="btn btn bg-red btn-sm" data-dismiss="modal">ปิดหน้าต่างนี้</button>
        
      </div>
    </div>
  </form>
  </div>
</div>