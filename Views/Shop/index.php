<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../Shares/header.layout.php' ?>
    <title>ร้านค้า</title>
</head>

<body>
    <?php include 'navbar.layout.php' ?>
    <main class="container">
        <?php if (!isset($_REQUEST['Inaction_Get'])) { ?>
            <a href="?Inaction_Get=createmenu" class="btn btn-primary">สร้างรายการอาหาร</a>
        <?php } ?>
        <?php if (isset($_REQUEST['Inaction_Get']) && $_REQUEST['Inaction_Get'] == "createmenu") { ?>
            <form action="../../Controllers/shop.ctr.php?action_Get=AddFood" method="post" enctype="multipart/form-data" class="bg-light mt-2 form-control pb-3">
                <div class="row g-2  mt-1">
                    <div class="col-6">
                        <label class="form-label">ชื่ออาหาร*</label>
                        <input class="form-control w-100" type="text" name="NameFood_Post" id="" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">ราคาอาหาร*</label><br>
                        <input class="form-control w-100" type="number" name="PriceFood_Post" id="" required>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-6">
                        <label class="form-label">หมวดหมู่อาหาร*</label>
                        <select class="form-select" name="IdTypeFood_Post" required>
                            <option value="" selected>เลือกหมวดหมู่อาหาร</option>
                            <?php
                            require '../../Includes/autoload.inc.php';
                            $service = new connect_database();
                            $result = $service->SelectTable(null, "typefood");
                            foreach ($result as $row) { ?>
                                <option value="<?= $row['IdTypeFood'] ?>"><?= $row['NameTypeFood'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">รูปภาพอาหาร*</label><br>
                        <input class="form-control w-100" type="file" name="ImageFood_Post" id="" required>
                    </div>
                </div>
                <div class="input-group mt-3">
                    <a href="index.php" class="btn btn-danger w-50">ยกเลิกเพิ่มเมนูอาหาร</a>
                    <input class="btn btn-success w-50" type="submit" value="เพิ่มเมนูอาหาร">
                </div>
            </form>
        <?php } ?>




        <?php if (isset($_REQUEST['Inaction_Get']) && $_REQUEST['Inaction_Get'] == "editmenu") { 
            $result = $service->SelectTable(null,"food","Where IdFood = ".$_REQUEST['IdFood_Get'])->fetch_assoc();
            ?>
            <form action="../../Controllers/shop.ctr.php?action_Get=EditFood&IdFood_Get=<?= $_REQUEST['IdFood_Get']?>" method="Post" enctype="multipart/form-data" class="bg-light mt-2 form-control pb-3">
                <div class="row g-2  mt-1">
                    <div class="col-6">
                        <label class="form-label">ชื่ออาหาร*</label>
                        <input class="form-control w-100" type="text" name="NameFood_Post" value="<?= $result['NameFood']?>" id="" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">ราคาอาหาร*</label><br>
                        <input class="form-control w-100" type="number" name="PriceFood_Post" value="<?= $result['PriceFood']?>" id="" required>
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-6">
                        <label class="form-label">หมวดหมู่อาหาร*</label>
                        <select class="form-select" name="IdTypeFood_Post" required>
                            <?php
                            require '../../Includes/autoload.inc.php';
                            $service = new connect_database();
                            $resulttype = $service->SelectTable(null, "typefood");
                            foreach ($resulttype as $row) { 
                                if($result['IdTypeFood'] == $row['IdTypeFood']){?>
                                <option value="<?= $row['IdTypeFood'] ?>" selected><?= $row['NameTypeFood'] ?></option>
                                <?php }else{?>
                                    <option value="<?= $row['IdTypeFood'] ?>"><?= $row['NameTypeFood'] ?></option>
                                <?php }?>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">รูปภาพอาหาร</label><br>
                        <input class="form-control w-100" type="file" name="ImageFood_Post">
                    </div>
                </div>
                <div class="input-group mt-3">
                    <a href="index.php" class="btn btn-danger w-50">ยกเลิกแก้ไขเมนูอาหาร</a>
                    <input class="btn btn-success w-50" type="submit" value="แก้ไขเมนูอาหาร">
                </div>
            </form>
        <?php } ?>

        
        <div class="table-responsive">
            <table class="table text-center table-bordered table-striped table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">ไอดี</th>
                        <th scope="col">รูปอาหาร</th>
                        <th scope="col">ชื่ออาหาร</th>
                        <th scope="col">ราคาอาหาร</th>
                        <th scope="col">หมวดหมู่อาหาร</th>
                        <th scope="col">จัดการรายการอาหาร</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../Includes/autoload.inc.php';
                    $service = new connect_database();
                    $result = $service->SelectTable(null, "food");
                    foreach ($result as $row) :
                    ?>
                        <tr>
                            <th scope="row"><?= $row['IdFood'] ?></th>
                            <td><img src="<?= $row['ImageFood'] ?>" class="img-fluid " width="100"></td>
                            <td><?= $row['NameFood'] ?></td>
                            <td><?= $row['PriceFood'] ?></td>
                            <td><?php echo $service->SelectTable(null, "typefood", "WHERE IdTypeFood = " . ($row['IdTypeFood'] ?? 0))->fetch_assoc()['NameTypeFood'] ?? "-"; ?></td>
                            <td>
                                <div class="input-group w-100">
                                    <a class="btn btn-primary w-50" href="?Inaction_Get=editmenu&IdFood_Get=<?=$row['IdFood']?>">แก้ไขเมนูอาหาร</a>
                                    <a class="btn btn-danger w-50" href="../../Controllers/shop.ctr.php?action_Get=DeleteFood&IdFood_Get=<?=$row['IdFood']?>">ลบรายการอาหาร</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include '../Shares/footer.layout.php' ?>
</body>

</html>