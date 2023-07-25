<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include '../Shares/header.layout.php' ?>
  <title>จัดการร้านค้า</title>
</head>

<body>
  <?php include 'navbar.layout.php' ?>
  <main class="container">
    <div class="p-3 rounded-3 bg-light">
      <a class="btn btn-primary w-100" href="../Shares/sales_report.pdf.php">สรุปยอดขายวันนี้</a>
    </div>
    <?php
    $service = new connect_database();
    $result = $service->SelectTable(null, "promotion")->fetch_assoc()['PersenPromotion']??null;
    if (!isset($result)) { ?>
      <form class="form-control mt-2" action="../../Controllers/shop.ctr.php?action_Get=AddDiscount" method="Post">
        <label class="label-control">เปอร์เซนต์ที่จะลดราคา</label>
        <input class="form-control" type="number" name="Persent_Post" min="2" max="100" id="">
        <input class="btn btn-primary w-100 mt-2" type="submit" value="สร้างโค้ดส่วนลด">
      </form>
    <?php } else { ?>
      <div class="p-3 rounded-3 bg-light mt-2">
      <h2 class="text-center">ส่วนลดร้านค้า</h2>
        ส่วนลดราคาอาหาร: <?= $result ?>% ของราคาอาหาร <a class="text-danger" href="../../Controllers/shop.ctr.php?action_Get=DeleteDiscount&IdShop_Get=<?= $_SESSION['IdUser_Session']?>">ลบส่วนลด</a>
      </div>
    <?php } ?>
  </main>
  <?php include '../Shares/footer.layout.php' ?>
</body>

</html>