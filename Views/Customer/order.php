<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include '../Shares/header.layout.php' ?>
  <title>ประวัติการสั่งอาหาร</title>
</head>

<body>
  <?php include 'navbar.layout.php' ?>
  <main class="container">
    <?php
    $service = new connect_database();
    $result = $service->SelectTable(null, "orders", "Where IdCustomer = {$_SESSION['IdUser_Session']}");
    foreach ($result as $row) { ?>
      <div class="card mt-2">
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                รหัสคำสั่งซื้อ: <?= $row['IdOrder'] ?> ,ราคา: <?= $row['PriceOrder'] ?> บาท,สั่งเมื่อ: <?= $row['DateOrder'] ?>
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table-info">
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
                          $Foodjson = json_decode($row['FoodOrder'],true);
                          foreach($Foodjson as $Food){
                      ?>
                      <tr>
                        <th scope="row"><?=$i?></th>
                        <td><?=$Food['NameFood']?></td>
                        <td><?=$Food['PriceFood']?></td>
                        <td><?=$Food['amount']?></td>
                      </tr>
                      <?php $i += 1; }?>
                    </tbody>
                  </table>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
  </main>
  <?php include '../Shares/footer.layout.php' ?>
</body>

</html>