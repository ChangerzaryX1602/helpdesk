<?php session_start();
	include('config/connect.php');
?>
<!doctype html>
<html lang="th">
  <head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="backend/bower_components/font-awesome/css/font-awesome.min.css">
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
      }

      /* ---- Wrapper ---- */
      .login-wrapper {
        display: flex;
        width: 900px;
        max-width: 96vw;
        min-height: 530px;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 24px 64px rgba(13,59,102,0.18);
      }

      /* ---- Left Brand Panel ---- */
      .login-brand {
        flex: 0 0 42%;
        background: linear-gradient(160deg, #0d3b66 0%, #135e72 55%, #00897b 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 48px 32px;
        position: relative;
        overflow: hidden;
      }
      .login-brand::before {
        content: '';
        position: absolute;
        width: 320px; height: 320px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        top: -90px; right: -90px;
      }
      .login-brand::after {
        content: '';
        position: absolute;
        width: 220px; height: 220px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        bottom: -70px; left: -70px;
      }

      .brand-icon-wrap {
        width: 116px; height: 116px;
        background: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 26px;
        border: 3px solid rgba(255,255,255,0.35);
        box-shadow: 0 6px 20px rgba(0,0,0,0.18);
        position: relative; z-index: 1;
        overflow: hidden;
      }
      .brand-icon-wrap .fa { font-size: 44px; color: #fff; }
      .brand-icon-wrap img {
        width: 100%; height: 100%;
        object-fit: contain;
        padding: 6px;
      }

      .brand-title {
        color: #fff;
        font-size: 20px;
        font-weight: 600;
        text-align: center;
        line-height: 1.5;
        margin-bottom: 12px;
        position: relative; z-index: 1;
      }
      .brand-subtitle {
        color: rgba(255,255,255,0.72);
        font-size: 13px;
        font-weight: 300;
        text-align: center;
        line-height: 1.7;
        position: relative; z-index: 1;
      }
      .brand-badge {
        margin-top: 32px;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 20px;
        padding: 6px 18px;
        color: rgba(255,255,255,0.85);
        font-size: 11px;
        font-weight: 400;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        position: relative; z-index: 1;
      }

      /* ---- Right Form Panel ---- */
      .login-form-panel {
        flex: 1;
        background: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 52px 44px;
      }

      .form-header {
        text-align: center;
        margin-bottom: 34px;
        width: 100%;
      }
      .form-header h2 {
        font-size: 22px;
        font-weight: 600;
        color: #0d2137;
        margin-bottom: 6px;
      }
      .form-header p {
        font-size: 13px;
        font-weight: 300;
        color: #94a3b8;
      }
      .form-divider {
        width: 44px; height: 3px;
        background: linear-gradient(90deg, #0d3b66, #00897b);
        border-radius: 2px;
        margin: 10px auto 0;
      }

      /* ---- Inputs ---- */
      .field-group {
        position: relative;
        margin-bottom: 18px;
        width: 100%;
      }
      .field-group .field-icon {
        position: absolute;
        left: 15px; top: 50%;
        transform: translateY(-50%);
        color: #b0bec5;
        font-size: 15px;
        transition: color 0.25s;
        pointer-events: none;
        z-index: 2;
      }
      .field-group input {
        width: 100%;
        padding: 13px 44px 13px 44px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-family: 'Kanit', sans-serif;
        font-size: 14px;
        font-weight: 300;
        color: #1e293b;
        background: #f8fafc;
        transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
        outline: none;
      }
      .field-group input:focus {
        border-color: #00897b;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(0,137,123,0.12);
      }
      .field-group input:focus ~ .field-icon,
      .field-group:focus-within .field-icon { color: #00897b; }
      .field-group input::placeholder { color: #c4cdd6; font-weight: 300; }

      .eye-toggle {
        position: absolute;
        right: 14px; top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #b0bec5;
        font-size: 15px;
        background: none; border: none; padding: 0;
        transition: color 0.25s;
        z-index: 2;
      }
      .eye-toggle:hover { color: #00897b; }

      /* ---- Login Button ---- */
      .btn-login {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, #0d3b66 0%, #00897b 100%);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-family: 'Kanit', sans-serif;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 6px 20px rgba(0,137,123,0.28);
        margin-top: 6px;
        letter-spacing: 0.4px;
      }
      .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 28px rgba(0,137,123,0.38);
      }
      .btn-login:active { transform: translateY(0); }

      /* ---- Footer ---- */
      .form-footer {
        text-align: center;
        margin-top: 22px;
        font-size: 13px;
        color: #94a3b8;
        font-weight: 300;
        width: 100%;
      }
      .form-footer a {
        color: #00897b;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s;
      }
      .form-footer a:hover { color: #0d3b66; text-decoration: underline; }

      .copyright {
        margin-top: 30px;
        font-size: 11px;
        color: #cbd5e1;
        text-align: center;
        font-weight: 300;
      }

      /* ---- Responsive ---- */
      @media (max-width: 680px) {
        .login-brand { display: none; }
        .login-form-panel { padding: 40px 24px; }
        .login-wrapper { border-radius: 16px; }
      }
    </style>
  </head>
  <body>

    <div class="login-wrapper">

      <!-- Left Brand Panel -->
      <div class="login-brand">
        <div class="brand-icon-wrap">
          <img src="img-frontend/icon.webp" alt="โลโก้หน่วยงาน">
        </div>
        <div class="brand-title">ระบบแจ้งซ่อมออนไลน์<br>Maintenance Request</div>
        <div class="brand-subtitle">
          บริหารจัดการการแจ้งซ่อม<br>ภายในองค์กรอย่างมีประสิทธิภาพ
        </div>
        <div class="brand-badge">&#9881; Internal Support System</div>
      </div>

      <!-- Right Form Panel -->
      <div class="login-form-panel">

        <div class="form-header">
          <h2>เข้าสู่ระบบ</h2>
          <p>กรุณากรอกข้อมูลเพื่อเข้าใช้งาน</p>
          <div class="form-divider"></div>
        </div>

        <form name="form_login" style="width:100%;" action="check_login.php" method="post" onsubmit="return check_login();">

          <div class="field-group">
            <i class="fa fa-user-o field-icon"></i>
            <input type="text" name="u_username" id="u_username"
              placeholder="ชื่อผู้ใช้ (Username)"
              autocomplete="username">
          </div>

          <div class="field-group">
            <i class="fa fa-lock field-icon"></i>
            <input type="password" name="u_password" id="u_password"
              placeholder="รหัสผ่าน (Password)"
              autocomplete="current-password">
            <button type="button" class="eye-toggle" onclick="togglePassword(this)">
              <i class="fa fa-eye" id="eye-icon"></i>
            </button>
          </div>

          <button type="submit" name="btn_login" class="btn-login">
            <i class="fa fa-sign-in" style="margin-right:8px;"></i> เข้าสู่ระบบ
          </button>

        </form>

        <div class="form-footer" style="margin-top:14px;">
          <a href="forgot_password.php"><i class="fa fa-key" style="margin-right:4px;"></i> ลืมรหัสผ่าน?</a>
        </div>

        <div class="form-footer">
          ยังไม่มีบัญชี? <a href="register.php">ลงทะเบียนที่นี่</a>
        </div>

        <div class="copyright">
          &copy; <?php echo date('Y'); ?> ระบบแจ้งซ่อมออนไลน์ &mdash; สงวนลิขสิทธิ์
        </div>

      </div><!-- /.login-form-panel -->

    </div><!-- /.login-wrapper -->

    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script>
      function check_login() {
        var u = document.getElementById('u_username').value.trim();
        var p = document.getElementById('u_password').value.trim();
        if (u === '') {
          alert('กรุณากรอกชื่อผู้ใช้ (Username)');
          document.getElementById('u_username').focus();
          return false;
        }
        if (p === '') {
          alert('กรุณากรอกรหัสผ่าน (Password)');
          document.getElementById('u_password').focus();
          return false;
        }
        return true;
      }

      function togglePassword(btn) {
        var input = document.getElementById('u_password');
        var icon  = document.getElementById('eye-icon');
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