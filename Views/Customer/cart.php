<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include '../Shares/header.layout.php' ?>
  <title>หน้าหลัก</title>
</head>

<body>
  <?php include 'navbar.layout.php' ?>
  <main class="container">
    <div class="row">
      <div class="col-xl-8">
        <a class="text-decoration-none" href="<?= $_SERVER['HTTP_REFERER'] ?>">กลับไปยังหน้าเดิม</a>
        <h1 class="mt-2 text-center">ตระกร้าสินค้า</h1>
        <div class="table-responsive">
          <table class="table table-striped table-light table-bordered text-center mt-2">
            <thead class="table-primary">
              <tr>
                <th scope="col">รูปอาหาร</th>
                <th scope="col">ชื่ออาหาร</th>
                <th scope="col">ราคา(1จาน)</th>
                <th scope="col">จำนวน</th>
                <th scope="col">รวม</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if (isset($_COOKIE['cart'])) {
                $DeCart = unserialize($_COOKIE['cart']);
              } else {
                $DeCart = [];
              }
              foreach ($DeCart as $FoodCart) {
                $FoodInfo = $service->SelectTable(null, "food", "Where IdFood = " . $FoodCart['IdFood'])->fetch_assoc();
              ?>
                <tr>
                  <th scope="row"><img src="<?= $FoodInfo['ImageFood'] ?>" class="img-fluid mt-auto" width="85"></th>
                  <td><?= $FoodInfo['NameFood'] ?></td>
                  <td><input class="form-control text-center" type="number" value="<?= $FoodInfo['PriceFood'] ?>" disabled></td>
                  <td><input class="form-control text-center" type="number" value="<?= $FoodCart['amount'] ?>"></td>
                  <td> </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-xl-4">
        <div class="card bg-light p-3">
          <h5 class="text-center">กรอกโค้ดส่วนลด</h5>
          <input class="form-control" type="text" id="Code_Promotion" placeholder="กรอกส่วนลดของคุณ">
          <button class="btn btn-primary w-100 mt-2" onclick="">ใช้ส่วนลด</button>
        </div>
        <div class="card bg-light p-3 mt-3">
          <h5 class="text-center">ยอดรวม</h5>
          <table class="table table-striped table-bordered text-center">
            <thead>
              <tr>
                <th scope="col">รายละเอียด</th>
                <th scope="col">จำนวน</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">ราคาเดิม</th>
                <td></td>
              </tr>
              <tr>
                <th scope="row">ส่วนลด()</th>
                <td></td>
              </tr>
              <tr>
                <th scope="row">ราคาที่ต้องจ่าย</th>
                <td></td>
              </tr>
            </tbody>
          </table>
          <?php
          $Address = $service->SelectTable(null, "users", "Where idAll = {$_SESSION['IdUser_Session']}")->fetch_assoc()['AddressCustomer'];
          if ($Address != null) { ?>
            <button class="btn btn-success w-100 mt-0">ยืนยันชำระเงิน</button>
          <?php } else { ?>
            <a href="../Shares/editaccount.php" class="btn btn-danger w-100 mt-0">โปรดเพิ่มที่อยู่จัดส่ง ก่อนสั่งซื้อ</a>
          <?php } ?>
        </div>
      </div>
  </main>
  <?php include '../Shares/footer.layout.php' ?>
  <script>
    function AutoCalc() {
      document.getElementById('amount').value;
    }
  </script>
</body>

</html>