<header class="p-3 mb-3 border-bottom">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 link-secondary h-1">FoodThinkpad</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">อาหาร</a></li>
          <li><a href="#" class="nav-link px-2 link-dark">ร้านค้า</a></li>
        </ul>

        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control" placeholder="ค้นหา: อาหาร ร้านค้า หมวดหมู่ ประเภทร้านค้า" aria-label="Search">
        </form>
<?php //if():?>
        <div class="dropdown text-end">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
            <li><a class="dropdown-item" href="#">รายการคำสั่งซื้อ</a></li>
            <li><a class="dropdown-item" href="#">ตั้งค่าบัญชี</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">ออกจากระบบ</a></li>
          </ul>
        </div>
      </div>
<?php //endif ?>
    </div>
  </header>