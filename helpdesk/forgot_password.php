<?php session_start();
	include('config/connect.php');

	$step = 1;
	$u_idcard = '';
	$user_name = '';
	$error = '';

	if (isset($_POST['btn_check_idcard'])) {
		$u_idcard = trim($_POST['u_idcard']);

		if (!preg_match('/^\d{13}$/', $u_idcard)) {
			$error = 'กรุณากรอกเลขบัตรประชาชนให้ครบ 13 หลัก';
		} else {
			$u_idcard_safe = mysqli_real_escape_string($conn, $u_idcard);
			$sql = "SELECT u_idcard, u_prefix, u_fname, u_lname, u_status
					FROM tb_user WHERE u_idcard = '$u_idcard_safe' LIMIT 1";
			$query  = mysqli_query($conn, $sql);
			$result = mysqli_fetch_array($query);

			if (!$result) {
				$error = 'ไม่พบเลขบัตรประชาชนนี้ในระบบ';
			} elseif ($result['u_status'] != '1') {
				$error = 'บัญชีนี้ถูกระงับการใช้งาน กรุณาติดต่อผู้ดูแลระบบ';
			} else {
				$step      = 2;
				$user_name = $result['u_prefix'] . ' ' . $result['u_fname'] . ' ' . $result['u_lname'];
			}
		}
	}
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
        padding: 30px 0;
      }
      .forgot-wrapper {
        display: flex;
        width: 900px;
        max-width: 96vw;
        min-height: 530px;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 24px 64px rgba(13,59,102,0.18);
      }
      .forgot-brand {
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
      .forgot-brand::before {
        content: '';
        position: absolute;
        width: 320px; height: 320px;
        border-radius: 50%;
        background: rgba(255,255,255,0.05);
        top: -90px; right: -90px;
      }
      .forgot-brand::after {
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
      .brand-icon-wrap img { width: 100%; height: 100%; object-fit: contain; padding: 6px; }
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

      .forgot-form-panel {
        flex: 1;
        background: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 48px 44px;
      }
      .form-header { text-align: center; margin-bottom: 28px; width: 100%; }
      .form-header h2 { font-size: 22px; font-weight: 600; color: #0d2137; margin-bottom: 6px; }
      .form-header p  { font-size: 13px; font-weight: 300; color: #94a3b8; }
      .form-divider {
        width: 44px; height: 3px;
        background: linear-gradient(90deg, #0d3b66, #00897b);
        border-radius: 2px;
        margin: 10px auto 0;
      }

      .step-indicator {
        display: flex; align-items: center; justify-content: center;
        gap: 8px;
        margin-bottom: 20px;
      }
      .step-dot {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #e2e8f0;
        color: #94a3b8;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 500;
      }
      .step-dot.active {
        background: linear-gradient(135deg, #0d3b66 0%, #00897b 100%);
        color: #fff;
        box-shadow: 0 4px 12px rgba(0,137,123,0.28);
      }
      .step-line {
        width: 40px; height: 2px;
        background: #e2e8f0;
      }
      .step-line.active { background: #00897b; }

      .field-group { position: relative; margin-bottom: 16px; width: 100%; }
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

      .btn-primary {
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
      .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(0,137,123,0.38); }
      .btn-primary:active { transform: translateY(0); }

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

      .alert {
        padding: 11px 14px;
        border-radius: 10px;
        font-size: 13px;
        margin-bottom: 16px;
        display: flex; align-items: center; gap: 8px;
      }
      .alert-error {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
      }
      .alert-success {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
      }

      .user-info {
        background: #f0f9ff;
        border: 1px solid #bae6fd;
        border-radius: 12px;
        padding: 14px 16px;
        margin-bottom: 18px;
        font-size: 13px;
        color: #0c4a6e;
      }
      .user-info .label { color: #64748b; font-weight: 300; margin-right: 6px; }
      .user-info .name { font-weight: 500; }

      .copyright {
        margin-top: 24px;
        font-size: 11px;
        color: #cbd5e1;
        text-align: center;
        font-weight: 300;
      }

      @media (max-width: 680px) {
        .forgot-brand { display: none; }
        .forgot-form-panel { padding: 40px 24px; }
        .forgot-wrapper { border-radius: 16px; }
      }
    </style>
  </head>
  <body>

    <div class="forgot-wrapper">

      <div class="forgot-brand">
        <div class="brand-icon-wrap">
          <img src="img-frontend/icon.webp" alt="โลโก้หน่วยงาน">
        </div>
        <div class="brand-title">ลืมรหัสผ่าน?<br>Reset Password</div>
        <div class="brand-subtitle">
          ยืนยันตัวตนด้วยเลขบัตรประชาชน<br>เพื่อตั้งรหัสผ่านใหม่
        </div>
        <div class="brand-badge">&#128274; Account Recovery</div>
      </div>

      <div class="forgot-form-panel">

        <div class="form-header">
          <h2><?php echo ($step == 1) ? 'ยืนยันตัวตน' : 'ตั้งรหัสผ่านใหม่'; ?></h2>
          <p>
            <?php echo ($step == 1)
                ? 'กรอกเลขบัตรประชาชนของคุณเพื่อยืนยันตัวตน'
                : 'กรุณากรอกรหัสผ่านใหม่ที่ต้องการใช้งาน'; ?>
          </p>
          <div class="form-divider"></div>
        </div>

        <div class="step-indicator">
          <div class="step-dot active">1</div>
          <div class="step-line <?php echo ($step == 2) ? 'active' : ''; ?>"></div>
          <div class="step-dot <?php echo ($step == 2) ? 'active' : ''; ?>">2</div>
        </div>

        <?php if ($error != '') { ?>
          <div class="alert alert-error">
            <i class="fa fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($error); ?></span>
          </div>
        <?php } ?>

        <?php if ($step == 1) { ?>

          <form method="post" action="forgot_password.php" onsubmit="return validateIdcard();">
            <div class="field-group">
              <i class="fa fa-id-card-o field-icon"></i>
              <input type="text" name="u_idcard" id="u_idcard"
                     placeholder="เลขบัตรประชาชน 13 หลัก"
                     maxlength="13"
                     inputmode="numeric"
                     value="<?php echo htmlspecialchars($u_idcard); ?>"
                     autocomplete="off">
            </div>

            <button type="submit" name="btn_check_idcard" class="btn-primary">
              <i class="fa fa-search" style="margin-right:8px;"></i> ยืนยันตัวตน
            </button>
          </form>

        <?php } else { ?>

          <div class="user-info">
            <i class="fa fa-user-circle-o" style="margin-right:6px;"></i>
            <span class="label">ผู้ใช้งาน:</span>
            <span class="name"><?php echo htmlspecialchars($user_name); ?></span>
          </div>

          <form method="post" action="forgot_password_action.php" onsubmit="return validatePassword();">
            <input type="hidden" name="u_idcard" value="<?php echo htmlspecialchars($u_idcard); ?>">

            <div class="field-group">
              <i class="fa fa-lock field-icon"></i>
              <input type="password" name="u_password_new" id="u_password_new"
                     placeholder="รหัสผ่านใหม่ (อย่างน้อย 4 ตัว)"
                     minlength="4"
                     autocomplete="new-password">
              <button type="button" class="eye-toggle" onclick="togglePassword('u_password_new', this)">
                <i class="fa fa-eye"></i>
              </button>
            </div>

            <div class="field-group">
              <i class="fa fa-lock field-icon"></i>
              <input type="password" name="u_password_confirm" id="u_password_confirm"
                     placeholder="ยืนยันรหัสผ่านใหม่"
                     minlength="4"
                     autocomplete="new-password">
              <button type="button" class="eye-toggle" onclick="togglePassword('u_password_confirm', this)">
                <i class="fa fa-eye"></i>
              </button>
            </div>

            <button type="submit" name="btn_reset_password" class="btn-primary">
              <i class="fa fa-check" style="margin-right:8px;"></i> เปลี่ยนรหัสผ่าน
            </button>
          </form>

        <?php } ?>

        <div class="form-footer">
          <a href="index.php"><i class="fa fa-arrow-left" style="margin-right:4px;"></i> กลับไปหน้าเข้าสู่ระบบ</a>
        </div>

        <div class="copyright">
          &copy; <?php echo date('Y'); ?> ระบบแจ้งซ่อมออนไลน์ &mdash; สงวนลิขสิทธิ์
        </div>

      </div>

    </div>

    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script>
      function validateIdcard() {
        var v = document.getElementById('u_idcard').value.trim();
        if (!/^\d{13}$/.test(v)) {
          alert('กรุณากรอกเลขบัตรประชาชนให้ครบ 13 หลัก');
          document.getElementById('u_idcard').focus();
          return false;
        }
        return true;
      }

      function validatePassword() {
        var p1 = document.getElementById('u_password_new').value;
        var p2 = document.getElementById('u_password_confirm').value;
        if (p1.length < 4) {
          alert('รหัสผ่านต้องมีอย่างน้อย 4 ตัวอักษร');
          document.getElementById('u_password_new').focus();
          return false;
        }
        if (p1 !== p2) {
          alert('รหัสผ่านทั้งสองช่องไม่ตรงกัน');
          document.getElementById('u_password_confirm').focus();
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

      var idcardInput = document.getElementById('u_idcard');
      if (idcardInput) {
        idcardInput.addEventListener('input', function() {
          this.value = this.value.replace(/\D/g, '').slice(0, 13);
        });
      }
    </script>

  </body>
</html>
<?php mysqli_close($conn); ?>
