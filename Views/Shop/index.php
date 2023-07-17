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
            <form class="bg-light mt-2 form-control pb-3">
                <div class="row g-2  mt-1">
                    <div class="col-6">
                        <label class="form-label">ชื่ออาหาร*</label>
                        <input class="form-control w-100" type="text" name="" id="">
                    </div>
                    <div class="col-6">
                        <label class="form-label">ราคาอาหาร*</label><br>
                        <input class="form-control w-100" type="number" name="" id="">
                    </div>
                </div>
                <div class="row g-2 mt-2">
                    <div class="col-6">
                        <label class="form-label">หมวดหมู่อาหาร*</label>
                        <input class="form-control w-100" type="text" name="" id="">
                    </div>
                    <div class="col-6">
                        <label class="form-label">รูปภาพอาหาร*</label><br>
                        <input class="form-control w-100" type="number" name="" id="">
                    </div>
                </div>
                <div class="input-group mt-3">
                    <a href="index.php" class="btn btn-danger w-50">ยกเลิกเพิ่มเมนูอาหาร</a>
                    <input class="btn btn-success w-50" type="submit" value="เพิ่มเมนูอาหาร">
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
                            <th scope="row"><?= $row['idAll'] ?></th>
                            <td><img src="<?= $row['ImageAll'] ?>" class="img-fluid " width="55"></td>
                            <td><?= $row['NameAll'] ?></td>
                            <td><?= $row['RoleAll'] ?></td>
                            <td><?php echo $service->SelectTable(null, "typeshop", "WHERE IdTypeShop = " . ($row['IdTypeShop'] ?? 0))->fetch_assoc()['NameTypeShop'] ?? "-"; ?></td>
                            <td>
                                <div class="input-group w-100">
                                    <a class="btn btn-primary w-50" href="">แก้ไขเมนูอาหาร</a>
                                    <a class="btn btn-danger w-50" href="">ลบรายการอาหาร</a>
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