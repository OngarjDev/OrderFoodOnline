<?php
// require_once '../../Includes/autoload.inc.php';
// $auth = new login();
// $auth->SyncSession();
// $auth->CheckAuthorization();
?>
<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 link-secondary h-1">AdminThinkpad</a></li>
          <li><a href="index.php" class="nav-link px-2 link-dark">จัดการบัญชี</a></li>
          <li><a href="typeshop.php" class="nav-link px-2 link-dark">จัดการประเภทร้านอาหาร</a></li>
        </ul>

<?php //if():?>
        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="../Shares/editaccount.php">ตั้งค่าบัญชี</a></li>
            <li><a class="dropdown-item" href="../../Controllers/login.ctr.php?action_Get=logout">ออกจากระบบ</a></li>
          </ul>
        </div>
      </div>
<?php //endif ?>
    </div>
  </header>