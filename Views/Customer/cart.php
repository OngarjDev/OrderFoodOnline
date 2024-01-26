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
    <a class="text-decoration-none" href="<?= $_SERVER['HTTP_REFERER'] ?>">กลับไปยังหน้าเดิม</a>
    <h1 class="mt-2 text-center">ตระกร้าสินค้า</h1>
    <div class="table-responsive">
      <table class="table table-striped table-light table-bordered text-center mt-2">
        <thead class="table-primary">
          <tr>
            <th scope="col">รูปอาหาร</th>
            <th scope="col">ชื่ออาหาร</th>
            <th scope="col">ราคา(1จาน)</th>
            <th scope="col">ส่วนลด(%)</th>
            <th scope="col">จำนวน</th>
            <th scope="col">รวม</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sumprice = [];
          if (isset($_COOKIE['cart'])) {
            $DeCart = json_decode($_COOKIE['cart'], true);
          } else {
            $DeCart = [];
          }
          foreach ($DeCart as $FoodCart) {
            $FoodInfo = $service->SelectTable(null, "food", "Where IdFood = " . $FoodCart['IdFood'])->fetch_assoc();
          ?>
            <tr>
              <th scope="row"><img src="<?= $FoodInfo['ImageFood'] ?>" class="img-fluid mt-auto" width="85"></th>
              <td><?= $FoodInfo['NameFood'] ?></td>
              <td><?= $FoodInfo['PriceFood'] ?></td>
              <?php
              $promotion = $service->SelectTable(null, "promotion", "Where IdShop = {$FoodInfo['IdShop']}")->fetch_assoc()['PersenPromotion'] ?? 0;
              ?>
              <td><?= $promotion ?>%</td>
              <td><input class="form-control text-center" type="number" id="<?= $FoodInfo['IdFood'] ?>" min="1" value="<?= $FoodCart['amount'] ?>" onkeypress="updateamount(<?= $FoodInfo['IdFood'] ?>,this.value)"></td>
              <td><?php
                  $persen = $FoodInfo['PriceFood'] * $promotion / 100;
                  echo $priceorigin = ($FoodInfo['PriceFood'] - $persen) * $FoodCart['amount'];
                  array_push($sumprice, $priceorigin);
                  ?></td>
            </tr>
            <tr>
            <?php } ?>
            <td colspan="4">ราคารวม</td>
            <td colspan="2"><?= array_sum($sumprice) ?> บาท</td>
            </tr>
        </tbody>
      </table>
      <div class="input-group">
        <a class="btn btn-primary w-50" href="">คำนวณอีกครั้ง</a>
        <a class="btn btn-success w-50" href="../../Controllers/customer.ctr.php?action_Get=AddOrder">ยืนยันการสั่ง</a>
      </div>
      <p class="text-center mt-3">หากต้องการแก้ไข ใส่จำนวนสินค้าแล้วกดEnter</p>
    </div>
  </main>
  <?php include '../Shares/footer.layout.php' ?>
  <script src="../../Src/Js/ajax.js"></script>
  <script>
    function updateamount(IdFood, Amount) {
      ajax("GET", "../../Controllers/customer.ctr.php?action_Get=UpdateAmountCart&IdFood_Get=" + IdFood + "&Amount=" + Amount);
    }
  </script>
</body>

</html>