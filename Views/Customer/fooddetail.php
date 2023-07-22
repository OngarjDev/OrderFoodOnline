<?php
require_once "../../Includes/autoload.inc.php";
$service = new connect_database();
$foodinfo = $service->SelectTable(null, "food", "Where IdFood = {$_REQUEST['IdFood_Get']}")->fetch_assoc(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../Shares/header.layout.php' ?>
    <title><?= $foodinfo['NameFood'] ?></title>
</head>

<body>
    <?php include 'navbar.layout.php' ?>
    <main class="container">
        <div class="p-5 rounded-3 bg-light">
            <div class="d-flex text-black ">
                <div class="flex-shrink-0 me-4">
                    <img src="<?= $foodinfo['ImageFood'] ?>" alt="Generic placeholder image" class="img-fluid img-fluid" style="width: 180px;Height: 120px; border-radius: 10px;">
                </div>
                <div class="flex-grow-1">
                    <h2 class="mb-1 mt-3"><?= $foodinfo['NameFood'] ?></h2>
                    <h5 class="mb-1 mt-0">ราคา <?= $foodinfo['PriceFood']?>฿</h5>
                    <?php
                    require_once '../../Includes/autoload.inc.php';
                    $service = new connect_database();
                    $result = $service->SelectTable(null, "typefood", "Where IdTypeFood = " . $foodinfo['IdTypeFood']);
                    foreach ($result as $row) { ?>
                        หมวดหมู่: <a class="badge rounded-pill bg-primary text-decoration-none g-2"><?= $row['NameTypeFood'] ?></a>
                    <?php } ?>
                </div>
            </div>
            <a class="btn btn-success mt-3 w-50">เพิ่มลงในตะกร้าสินค้า</a>
        </div>

    </main>
    <?php include '../Shares/footer.layout.php' ?>
</body>

</html>