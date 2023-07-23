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
        <div class="row">
            <div class="col-xl-8">
                <div class="p-5 rounded-3 bg-light">
                    <div class="d-flex text-black ">
                        <div class="flex-shrink-0 me-4">
                            <img src="<?= $foodinfo['ImageFood'] ?>" alt="Generic placeholder image" class="img-fluid img-fluid" style="width: 180px;Height: 120px; border-radius: 10px;">
                        </div>
                        <div class="flex-grow-1">
                            <h2 class="mb-1 mt-3"><?= $foodinfo['NameFood'] ?></h2>
                            <h5 class="mb-1 mt-0">ราคา <?= $foodinfo['PriceFood'] ?>฿</h5>
                            <?php
                            require_once '../../Includes/autoload.inc.php';
                            $service = new connect_database();
                            $result = $service->SelectTable(null, "typefood", "Where IdTypeFood = " . $foodinfo['IdTypeFood']);
                            foreach ($result as $row) { ?>
                                หมวดหมู่: <a class="badge rounded-pill bg-primary text-decoration-none g-2"><?= $row['NameTypeFood'] ?></a>
                            <?php } ?>
                        </div>
                    </div>
                    <a class="btn btn-success mt-3 w-100">เพิ่มลงในตะกร้าสินค้า</a>
                </div>
                <h3 class="mt-3">เมนูจากร้าน</h3>
                <?php $shopinfo = $service->SelectTable(null, "users", "Where idAll = " . $foodinfo['IdShop'])->fetch_assoc(); ?>
                <p>ชื่อร้านค้า: <?= $shopinfo['NameAll'] ?></p>
                <?php
                $result = $service->SelectTable(null, "typefood", "Where IdShop = " . $shopinfo['idAll']);
                foreach ($result as $row) { ?>
                    <a class="badge rounded-pill bg-secondary text-decoration-none g-1 mt-0" href="shop.php?IdTypeFood_Get=<?=$row['IdTypeFood']?>&IdShop_Get=<?=$row['IdShop']?>"><?= $row['NameTypeFood'] ?></a>
                <?php } ?>

            </div>
            <div class="col-xl-3">
                <div class="bg-light">
                    <form class="form-control" action="../../Controllers/customer.ctr.php?action_Get=Comment&IdFood_Get=<?=$_REQUEST['IdFood_Get'] ?>" method="Post">
                        <label class="label-control">บอกความรู้สึกของคุณ</label>
                        <input class="form-control" type="text" name="Comment_Post" id="">
                        <input class="btn btn-primary w-100 mt-2" type="submit" value="แสดงความคิดเห็น">
                    </form>
                </div>
                <h2 class="text-center mt-3">ความคิดเห็น</h2>
                <?php
                $resultComment = $service->InnerJoin("review","users","review.IdUser = users.idAll","Where review.IdFood = {$foodinfo['IdFood']}");
                foreach ($resultComment as $rowComment) { ?>
                    <div class="mt-2 bg-light p-3 border rounded-3">
                        ชื่อผู้ใช้: <?=$rowComment['NameAll']?><br>
                        ความคิดเห็น: <?=$rowComment['Comment']?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </main>
    <?php include '../Shares/footer.layout.php' ?>
</body>

</html>