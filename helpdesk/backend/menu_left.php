<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">

      <!-- หน้าหลัก -->
      <li>
        <a href="dashboard.php">
          <i class="fa fa-home"></i>
          <span>หน้าหลัก</span>
        </a>
      </li>

      <?php if($_SESSION['level_id'] == '01'): ?>
      <!-- จัดการผู้ใช้งาน (Admin) -->
      <li>
        <a href="list_user.php">
          <i class="fa fa-users"></i>
          <span>จัดการข้อมูลผู้ใช้งาน</span>
        </a>
      </li>
      <?php endif; ?>

      <?php if($_SESSION['level_id'] == '01' || $_SESSION['level_id'] == '02'): ?>
    

      <!-- ข้อมูลการแจ้งซ่อม -->
      <li>
        <a href="list_repair.php">
          <i class="fa fa-list-alt"></i>
          <span>ข้อมูลการแจ้งซ่อม</span>
        </a>
      </li>
      <?php endif; ?>

      <?php if($_SESSION['level_id'] == '01' || $_SESSION['level_id'] == '02' || $_SESSION['level_id'] == '04'): ?>
      <!-- งานซ่อม -->
      <li>
        <a href="work_repair.php">
          <i class="fa fa-wrench"></i>
          <span>งานซ่อมที่ได้รับมอบหมาย</span>
        </a>
      </li>
      <?php endif; ?>

      <?php if($_SESSION['level_id'] == '01'): ?>
      <!-- ตั้งค่าระบบ -->
      <li class="header">ตั้งค่าระบบ</li>

      <li>
        <a href="list_position.php">
          <i class="fa fa-id-badge"></i>
          <span>จัดการข้อมูลตำแหน่ง</span>
        </a>
      </li>

      <li>
        <a href="list_department.php">
          <i class="fa fa-sitemap"></i>
          <span>จัดการข้อมูลแผนก</span>
        </a>
      </li>

      <li>
        <a href="list_equipment.php">
          <i class="fa fa-desktop"></i>
          <span>จัดการข้อมูลอุปกรณ์</span>
        </a>
      </li>

      <li>
        <a href="list_building.php">
          <i class="fa fa-building"></i>
          <span>จัดการข้อมูลอาคาร / ตึก</span>
        </a>
      </li>
      <?php endif; ?>

      <?php if($_SESSION['level_id'] == '01' || $_SESSION['level_id'] == '02'): ?>
      <!-- รายงาน -->
      <li class="header">รายงาน</li>
      <li>
        <a href="export_report.php">
          <i class="fa fa-file-excel-o"></i>
          <span>Export รายงาน</span>
        </a>
      </li>
      <?php endif; ?>

      <?php if($_SESSION['level_id'] == '03'): ?>
      <!-- แจ้งซ่อม (ผู้ใช้ทั่วไป) -->
      <li>
        <a href="add_repair.php">
          <i class="fa fa-plus-circle"></i>
          <span>แจ้งซ่อม</span>
        </a>
      </li>
      <li>
        <a href="repair.php">
          <i class="fa fa-clock-o"></i>
          <span>รายการแจ้งซ่อมของฉัน</span>
        </a>
      </li>
      <?php endif; ?>

    </ul>
  </section>
</aside>