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
        <div class="row d-flex justify-content-center align-items-center h-100">
            <?php
            require_once "../../Includes/autoload.inc.php";
            $service = new connect_database();
            $result = $service->SelectTable(null, "food");
            foreach ($result as $row) { ?>
                <div class="col col-md-9 col-lg-7 col-xl-4 g-2">
                    <div class="card rounded">
                        <div class="card-body p-4">
                            <div class="d-flex text-black">
                                <div class="flex-shrink-0 me-2 ">
                                    <img src="<?= $row['ImageFood'] ?>" alt="Generic placeholder image" class="img-fluid img-fluid" style="width: 140px;Height: 105px; border-radius: 10px;">
                                </div>
                                <div class="flex-grow-1 ms-1">
                                    <h5 class="mb-1"><?= $row['NameFood'] ?></h5>
                                    <?php
                                    $NameShop = $service->SelectTable(null, "users", "Where idAll = " . $row['IdShop'])->fetch_assoc()['NameAll'];
                                    ?>
                                    <p class="mb-0">ชื่อร้านค้า: <?= $NameShop ?></p>
                                    <div class="d-flex justify-content-start rounded-3 px-4  " style="background-color: #efefef;">
                                        <div>
                                            <p class="small text-muted mb-1">ส่วนลด</p>
                                            <?php
                                            $promotion = $service->SelectTable(null, "promotion", "Where IdShop = " . $row['IdShop'])->fetch_assoc()['PersenPromotion'] ?? 0 ?>
                                            <p class="mb-0"><?= $promotion ?>%</p>
                                        </div>
                                        <div class="px-4">
                                            <p class="small text-muted mb-1">ราคา</p>
                                            <p class="mb-0"><?= $row['PriceFood'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 pb-4 input-group">
                            <a href="fooddetail.php?IdFood_Get=<?= $row['IdFood'] ?>" type="button" class="btn btn-primary w-50">รายละเอียด</a>
                            <?php $customer = new customer();
                            if (isset($_SESSION['IdUser_Session'])) { ?>
                                <?php if ($customer->CheckShop($row['IdShop'])) { ?>
                                    <?php if ($customer->CheckItem($row['IdFood'])) {
                                    ?>
                                        <a class="btn btn-danger w-50" disabled>ถูกเพิ่มลงในตะกร้าแล้ว</a>
                                    <?php } else {
                                    ?>
                                        <a href="../../Controllers/customer.ctr.php?action_Get=AddCartFood&IdFood_Get=<?= $row['IdFood'] ?>" class="btn btn-success w-50">หยิบใส่ตะกร้า</a>
                                    <?php } ?>
                                <?php } else { ?>
                                    <a href="" class="btn btn-danger w-50" disabled>สินค้าต้องร้านเดียวกัน</a>
                                <?php } ?>
                            <?php } else { ?>
                                <a href="../Shares/login.php" class="btn btn-danger w-50">โปรดเข้าสู่ระบบ</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>
    <?php include '../Shares/footer.layout.php' ?>
</body>

</html>