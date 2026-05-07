<?php session_start();
	include('config/connect.php');
?>
<!doctype html>
<html lang="th">
  <head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="backend/assets/font-awesome/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
      *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
      body {
        font-family: 'Kanit', sans-serif;
        background: #eef2f7;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 0;
      }
      .register-wrapper {
        background: #fff;
        width: 760px;
        max-width: 96vw;
        border-radius: 22px;
        box-shadow: 0 24px 64px rgba(13,59,102,0.18);
        overflow: hidden;
      }
      .register-header {
        background: linear-gradient(160deg, #0d3b66 0%, #135e72 55%, #00897b 100%);
        padding: 32px 40px;
        text-align: center;
        color: #fff;
        position: relative;
      }
      .register-header h2 {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 4px;
      }
      .register-header p {
        font-size: 13px;
        font-weight: 300;
        opacity: 0.85;
      }
      .register-body { padding: 36px 44px; }

      .row { display: flex; flex-wrap: wrap; gap: 0 18px; }
      .col-6 { flex: 1 1 calc(50% - 9px); min-width: 240px; }
      .col-12 { flex: 1 1 100%; }

      .field-group { margin-bottom: 18px; position: relative; }
      .field-group label {
        display: block;
        font-size: 13px;
        font-weight: 400;
        color: #334155;
        margin-bottom: 6px;
      }
      .field-group label .req { color: #e53935; margin-left: 2px; }

      .field-group input,
      .field-group select {
        width: 100%;
        padding: 12px 14px;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
        font-weight: 300;
        color: #1e293b;
        background: #f8fafc;
        transition: border-color 0.25s, background 0.25s, box-shadow 0.25s;
        outline: none;
      }
      .field-group input:focus,
      .field-group select:focus {
        border-color: #00897b;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(0,137,123,0.12);
      }
      .field-group input::placeholder { color: #c4cdd6; font-weight: 300; }

      .password-wrap { position: relative; }
      .password-wrap input { padding-right: 44px; }
      .eye-toggle {
        position: absolute;
        right: 12px; top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #b0bec5;
        font-size: 15px;
        background: none; border: none; padding: 4px;
        transition: color 0.25s;
        z-index: 2;
        line-height: 1;
      }
      .eye-toggle:hover { color: #00897b; }

      .prefix-radio {
        display: flex; flex-wrap: wrap; gap: 10px 22px;
        padding: 8px 2px 0;
      }
      .prefix-radio label {
        display: inline-flex; align-items: center;
        font-weight: 300; font-size: 14px; color: #334155;
        cursor: pointer; margin: 0;
      }
      .prefix-radio input[type="radio"] {
        margin: 0 6px 0 0;
        accent-color: #00897b;
      }

      .actions {
        display: flex; gap: 12px;
        margin-top: 14px;
      }
      .btn {
        flex: 1;
        padding: 13px 18px;
        border-radius: 12px;
        font-family: 'Kanit', sans-serif;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        border: none;
        transition: transform 0.2s, box-shadow 0.2s;
        text-decoration: none;
        text-align: center;
        display: inline-flex; align-items: center; justify-content: center;
        gap: 8px;
      }
      .btn-submit {
        background: linear-gradient(135deg, #0d3b66 0%, #00897b 100%);
        color: #fff;
        box-shadow: 0 6px 20px rgba(0,137,123,0.28);
      }
      .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,137,123,0.38); }
      .btn-cancel {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
      }
      .btn-cancel:hover { background: #e2e8f0; }

      .helper {
        font-size: 12px; font-weight: 300;
        color: #94a3b8; margin-top: 4px;
      }

      @media (max-width: 600px) {
        .register-body { padding: 28px 22px; }
        .col-6 { flex: 1 1 100%; }
      }
    </style>
  </head>
  <body>

    <div class="register-wrapper">
      <div class="register-header">
        <h2><i class="fa fa-user-plus" style="margin-right:8px;"></i>ลงทะเบียนผู้ใช้งาน</h2>
        <p>กรอกข้อมูลให้ครบถ้วนเพื่อเปิดบัญชีผู้ใช้ทั่วไป</p>
      </div>

      <div class="register-body">
        <form name="form_register" method="post" action="register_action.php" onsubmit="return validateRegister();">

          <div class="field-group">
            <label>คำนำหน้า <span class="req">*</span></label>
            <div class="prefix-radio">
              <label><input type="radio" name="u_prefix" value="นาย" required> นาย</label>
              <label><input type="radio" name="u_prefix" value="นาง"> นาง</label>
              <label><input type="radio" name="u_prefix" value="นางสาว"> นางสาว</label>
              <label><input type="radio" name="u_prefix" value="Mr."> Mr.</label>
              <label><input type="radio" name="u_prefix" value="Mrs."> Mrs.</label>
              <label><input type="radio" name="u_prefix" value="Miss"> Miss</label>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="field-group">
                <label>ชื่อ <span class="req">*</span></label>
                <input type="text" name="u_fname" placeholder="ชื่อจริง" required>
              </div>
            </div>
            <div class="col-6">
              <div class="field-group">
                <label>นามสกุล <span class="req">*</span></label>
                <input type="text" name="u_lname" placeholder="นามสกุล" required>
              </div>
            </div>
          </div>

          <div class="field-group">
            <label>เลขบัตรประชาชน <span class="req">*</span></label>
            <input type="text" name="u_idcard" id="u_idcard" placeholder="13 หลัก" maxlength="13" pattern="\d{13}" required>
            <div class="helper">กรอกเลขบัตรประชาชน 13 หลัก (ใช้ระบุตัวตน)</div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="field-group">
                <label>เบอร์โทรศัพท์มือถือ <span class="req">*</span></label>
                <input type="text" name="u_mobile" placeholder="08x-xxx-xxxx" required>
              </div>
            </div>
            <div class="col-6">
              <div class="field-group">
                <label>เบอร์ภายใน</label>
                <input type="text" name="u_tel" placeholder="เช่น 1234">
              </div>
            </div>
          </div>

          <div class="field-group">
            <label>อีเมล <span class="req">*</span></label>
            <input type="email" name="u_email" placeholder="example@email.com" required>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="field-group">
                <label>หน่วยงาน / แผนก <span class="req">*</span></label>
                <select name="dep_id" required>
                  <option value="">เลือกหน่วยงาน</option>
                  <?php
                  $depQuery = mysqli_query($conn, "SELECT * FROM tb_department ORDER BY dep_id ASC");
                  while ($dep = mysqli_fetch_array($depQuery)) {
                  ?>
                    <option value="<?php echo $dep['dep_id']; ?>"><?php echo htmlspecialchars($dep['dep_name']); ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="field-group">
                <label>ตำแหน่ง <span class="req">*</span></label>
                <select name="p_id" required>
                  <option value="">เลือกตำแหน่ง</option>
                  <?php
                  $posQuery = mysqli_query($conn, "SELECT * FROM tb_position ORDER BY p_id ASC");
                  while ($pos = mysqli_fetch_array($posQuery)) {
                  ?>
                    <option value="<?php echo $pos['p_id']; ?>"><?php echo htmlspecialchars($pos['p_position']); ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-6">
              <div class="field-group">
                <label>Username <span class="req">*</span></label>
                <input type="text" name="u_username" id="u_username" placeholder="ชื่อผู้ใช้" required>
              </div>
            </div>
            <div class="col-6">
              <div class="field-group">
                <label>Password <span class="req">*</span></label>
                <div class="password-wrap">
                  <input type="password" name="u_password" id="u_password" placeholder="รหัสผ่าน" minlength="4" required>
                  <button type="button" class="eye-toggle" onclick="togglePassword('u_password', this)" aria-label="แสดง/ซ่อนรหัสผ่าน">
                    <i class="fa fa-eye"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="actions">
            <a href="index.php" class="btn btn-cancel"><i class="fa fa-times"></i> ยกเลิก</a>
            <button type="submit" name="btn_register" class="btn btn-submit"><i class="fa fa-user-plus"></i> ลงทะเบียน</button>
          </div>
        </form>
      </div>
    </div>

    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script>
      function validateRegister() {
        var idcard = document.getElementById('u_idcard').value.trim();
        if (!/^\d{13}$/.test(idcard)) {
          alert('กรุณากรอกเลขบัตรประชาชนให้ครบ 13 หลัก');
          return false;
        }
        var username = document.getElementById('u_username').value.trim();
        if (username.length < 3) {
          alert('Username ต้องมีอย่างน้อย 3 ตัวอักษร');
          return false;
        }
        var password = document.getElementById('u_password').value;
        if (password.length < 4) {
          alert('Password ต้องมีอย่างน้อย 4 ตัวอักษร');
          return false;
        }
        return true;
      }

      function togglePassword(id, btn) {
        var input = document.getElementById(id);
        var icon  = btn.querySelector('i');
        if (input.type === 'password') {
          input.type = 'text';
          icon.className = 'fa fa-eye-slash';
        } else {
          input.type = 'password';
          icon.className = 'fa fa-eye';
        }
      }
    </script>

  </body>
</html>
<?php mysqli_close($conn); ?>
