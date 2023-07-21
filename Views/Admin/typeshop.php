<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../Shares/header.layout.php' ?>
    <title>จัดการประเภทร้านอาหาร</title>
</head>

<body>
    <?php include 'navbar.layout.php' ?>
    <main class="container">
        <form action="../../Controllers/admin.ctr.php?action_Get=AddTypeShop" method="Post">
            <div class="input-group w-50">
                <input class="form-control" placeholder="เพิ่มประเภทร้านอาหาร เช่น ร้านอาหารข้างทาง ร้านอาหารญี่ปุ่น ร้านแนวผสมผสาน" type="text" name="NameTypeShop_Post" required>
                <button class="btn btn-primary" type="submit">เพิ่มประเภทอาหาร</button>
            </div>
        </form>
        <div class="table-responsive mt-2">
            <table class="table text-center table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ไอดี</th>
                        <th scope="col">ชื่อประเภทร้านอาหาร</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../Includes/autoload.inc.php';
                    $service = new connect_database();
                    $result = $service->SelectTable(null,"typeshop");
                    foreach($result as $row):
                    ?>
                    <tr>
                        <th scope="row"><?=$row['IdTypeShop']?></th>
                        <td><?=$row['NameTypeShop']?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </main>
    <?php include '../Shares/footer.layout.php'?>
</body>
</html>