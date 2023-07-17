<?php
require_once '../../Includes/autoload.inc.php';
$auth = new login();
$service = new connect_database();
$auth->CheckAuthorization();
?>
<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 link-secondary h-1">ShopThinkpad</a></li>
          <li><a href="index.php" class="nav-link px-2 link-dark">รายการอาหาร</a></li>
          <li><a href="categoryfood.php" class="nav-link px-2 link-dark">หมวดหมู่อาหาร</a></li>
          <li><a href="index.php" class="nav-link px-2 link-dark">จัดการร้านอาหาร</a></li>
          <li><a href="index.php" class="nav-link px-2 link-dark">ตรวจสอบคำสั่งซื้อ</a></li>
        </ul>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <?php
              $image_path = $service->SelectTable("ImageAll","users","Where idAll = {$_SESSION['IdUser_Session']}")->fetch_assoc()['ImageAll'];
            ?>
          <img src="<?= $image_path ?>" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="../Shares/editaccount.php">ตั้งค่าบัญชี</a></li>
            <li><a class="dropdown-item" href="../../Controllers/login.ctr.php?action_Get=logout">ออกจากระบบ</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>