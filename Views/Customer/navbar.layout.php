<header class="p-3 mb-3 border-bottom">
<div class="container">
<div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
<ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
  <li><a href="index.php" class="nav-link px-2 link-secondary h-1">CustomerThinkpad</a></li>
  <li><a href="index.php" class="nav-link px-2 link-dark">หน้าหลัก</a></li>
  <li><a href="food.php" class="nav-link px-2 link-dark">อาหาร</a></li>
</ul>
<div class="input-group w-25">
<input Id="InputSearch" class="form-control w-25" type="search" placeholder="ค้นหา: ร้านค้า">
<button class="btn btn-primary me-3" onclick="search()">ค้นหา</button>
</div>
<?php
session_start();
if (isset($_SESSION['IdUser_Session'])) {
  require_once "../../Includes/autoload.inc.php";
  $service = new connect_database();
  $image_path = $service->SelectTable("ImageAll", "users", "Where idAll = {$_SESSION['IdUser_Session']}")->fetch_assoc()['ImageAll'];
?>
<a href="cart.php">
  <img class="me-3 w-75" src="../../Src/Images/basket.svg"/>
</a>
  <div class="dropdown text-end">
    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
      <img src="<?= $image_path ?>" alt="mdo" width="32" height="32" class="rounded-circle">
    </a>
    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
    <li><a class="dropdown-item" href="order.php">ประวัติการสั่งซื้อ</a></li>
      <li><a class="dropdown-item" href="../Shares/editaccount.php">ตั้งค่าบัญชี</a></li>
      <hr>
      <li><a class="dropdown-item" href="../../Controllers/login.ctr.php?action_Get=logout">ออกจากระบบ</a></li>
    </ul>
  </div>
<?php } else { ?>
  <a class="btn btn-primary" href="../Shares/login.php">เข้าสู่ระบบ</a>
  <a class="ms-2 btn btn-success" href="../Shares/register.php">สมัครเข้าใช้งาน</a>
<?php } ?>
</div>
</div>
</header>
<script>
function search() {
var searchTerm = document.getElementById('InputSearch').value;
window.location.href = "search.php?Keyword_Get=" + searchTerm;
}
</script>