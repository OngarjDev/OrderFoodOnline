<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../Shares/header.layout.php' ?>
    <title>ค้นหา อัจฉริยะ</title>
</head>

<body class="container">
    <?php include 'navbar.layout.php' ?>
    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <h6 class="border-bottom pb-2 mb-0">ค้นหาร้านค้า(<?=$_REQUEST['Keyword_Get']?>)</h6>
        <table class="table table-bordered mt-3 text-center">
            <thead>
                <tr>
                    <th scope="col">รูปภาพร้าน</th>
                    <th scope="col">ชื่อร้านค้า</th>
                    <th scope="col">รายละเอียดร้านค้า</th>
                    <th scope="col">เข้าชม</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "../../Includes/autoload.inc.php";
                $service = new connect_database();
                $result = $service->SelectTable(null, "users", "Where RoleAll = 'Shop' AND AccessStatusSCR = 1 AND NameAll LIKE '%{$_GET['Keyword_Get']}%'");
                foreach ($result as $row) { ?>
                    <tr>
                        <th scope="row"><img class="" src="<?=$row['ImageAll']?>" style="Width:50px;Height:50px"></th>
                        <td><?=$row['NameAll']?></td>
                        <td><?=$row['DescriptionShop']?></td>
                        <td><a class="btn btn-primary w-100" href="shop.php?IdShop=<?=$row['idAll']?>">เข้าชมร้านค้า</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</div>
<?php include '../Shares/footer.layout.php' ?>
</body>

</html>