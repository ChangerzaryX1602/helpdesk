<?php session_start();
	include('config/connect.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <title><?php echo $title;?></title>
    <?php include('meta_tag.php');?>
  </head>
  <body>
    
  <body>
    
    <div class="container">
        <div class="register-box bg-light p-5 rounded mt-3">

            <h1>ลงทะเบียน</h1>
 <!-- Register Content -->
            <form method="post" action="register_action.php">
                <div class="mb-3">
                    <label for="u_fullname" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="u_fullname" name="u_fullname" placeholder="ชื่อ - สกุล" required>
                </div>
                <div class="mb-3">
                    <label for="u_lastname" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="u_lastname" name="u_lastname" placeholder="นามสกุล" required>
                </div>
                <div class="mb-3">
                    <label for="u_username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="u_username" name="u_username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <label for="u_password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="u_password" name="u_password" placeholder="Password" required>
                </div>
                <div class="mb-3">
                    <label for="u_tel" class="form-label">เบอร์ติดต่อ</label>
                    <input type="text" class="form-control" id="u_tel" name="u_tel" placeholder="เบอร์ติดต่อ" required>
                </div>
                <div class="mb-3">
                    <label for="u_email" class="form-label">อีเมลล์</label>
                    <input type="text" class="form-control" id="u_email" name="u_email" placeholder="อีเมลล์" required>
                </div>
                <div class="mb-3">
                    <label for="u_address" class="form-label">ที่อยู่</label>
                    <input type="text" class="form-control" id="u_address" name="u_address" placeholder="ที่อยู่" required>
                </div>
                <div class="mb-3">
                    <label for="u_province" class="form-label">จังหวัด</label>
                    <input type="text" class="form-control" id="u_province" name="u_province" placeholder="จังหวัด" required>
                </div>
                <div class="form-group">
                      <div class="form-group">
												<label for="exampleFormControlFile1">File Picture</label>
												<input type="file" class="form-control-file" id="exampleFormControlFile1">
											</div>
                    </div>
                <div class="mb-3">
                    <label for="u_level" class="form-label">Level</label>
                    <select id="u_level" name="u_level" class="form-select">
                        <option value="user">ผู้ใช้ทั่วไป</option>
                    </select>
                </div>
                <div class="form-group" style="padding-top: 10px;">
                          <button type="submit" name="btn_login" class="btn btn-primary ">ลงทะเบียน</button>
                          <a href="index.php"   class="btn btn-danger">ยกเลิก</a>
                </div>

            </form>

</div>
</body>
    
    <?php include('script_js.php');?>
    <script src="js/script_login.js"></script>
  </body>
</html>