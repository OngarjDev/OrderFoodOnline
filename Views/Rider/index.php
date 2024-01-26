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
    <div class="row text-center">
      <?php if (!isset($_GET['IdShop_Get'])) { ?>
        <?php
        require_once "../../Includes/autoload.inc.php";
        $service = new connect_database();
        $resultshop = $service->SelectTable(null, "users", "Where RoleAll = 'Shop' AND AccessStatusSCR = 1");
        foreach ($resultshop as $rowshop) { ?>
          <div class="col-xl-4">
            <div class="card" style="width: 18rem;">
              <div class="text-center mt-3">
                <img src="<?= $rowshop['ImageAll'] ?>" class="card-img-top rounded-circle mb-3 w-50">
              </div>
              <div class="card-header">
                <h5 class="card-title text-center"><?= $rowshop['NameAll'] ?></h5>
                <p class="card-text text-center d-inline-block text-truncate" style="max-width: 250px;"><?= $rowshop['DescriptionShop'] ?></p>
                <a href="?IdShop_Get=<?= $rowshop['idAll'] ?>" class="btn btn-primary w-100">เลือกร้านค้า</a>
              </div>
            </div>
          </div>
        <?php } ?>
    </div>
    <?php } else {
        $OrderList = $service->SelectTable(null, "Orders", "where IdShop = {$_GET['IdShop_Get']} AND IdRider IS null AND StatusOrder = 1");
        foreach ($OrderList as $row) { ?>
      <div class="mt-2">
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                รหัสคำสั่งซื้อ: <?= $row['IdOrder'] ?> ,ราคา: <?= $row['PriceOrder'] ?> บาท,สั่งเมื่อ: <?= $row['DateOrder'] ?>
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                  <table class="table table-striped table-bordered">
                    <thead>
                      <tr class="table-info">
                        <th scope="col">ลำดับ</th>
                        <th scope="col">ชื่ออาหาร</th>
                        <th scope="col">ราคาที่จ่าย</th>
                        <th scope="col">จำนวน</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 1;
                      $Foodjson = json_decode($row['FoodOrder'], true);
                      foreach ($Foodjson as $Food) {
                      ?>
                        <tr>
                          <th scope="row"><?= $i ?></th>
                          <td><?= $Food['NameFood'] ?></td>
                          <td><?= $Food['PriceFood'] ?></td>
                          <td><?= $Food['amount'] ?></td>
                        </tr>
                      <?php $i += 1;
                      } ?>
                    </tbody>
                  </table>
                  <a href="../../Controllers/rider.ctr.php?action_Get=ReceiveOrder&IdOrder_Get=<?= $row['IdOrder']?>" class="btn btn-primary w-100 mt-0">รับรายการสั่งซื้อ</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  <?php } ?>
  </div>
  </main>
  <?php include '../Shares/footer.layout.php' ?>
</body>

</html>