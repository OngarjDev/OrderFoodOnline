<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../Shares/header.layout.php' ?>
    <title>ร้านค้า</title>
</head>
<body>
    <?php include'navbar.layout.php'?>
    <main class="container">
        <a href="?Inaction_Get=createmenu" class="btn btn-primary">สร้างรายการอาหาร</a>
        <div class="table-responsive">
        <table class="table text-center table-bordered table-striped table-hover mt-3">
        <thead>
          <tr>
            <th scope="col">ไอดี</th>
            <th scope="col">ชื่ออาหาร</th>
            <th scope="col">รายละเอียด(ร้านค้า)</th>
            <th scope="col">ที่อยู่(ร้านค้า,ลูกค้า)</th>
            <th scope="col">สถานะบัญชี</th>
            <th scope="col">ประเภทบัญชี</th>
            <th scope="col">ประเภทร้านอาหาร(ร้านอาหาร)</th>
            <th scope="col">จัดการบัญชี</th>
          </tr>
        </thead>
        <tbody>
          <?php
          require_once '../../Includes/autoload.inc.php';
          $service = new connect_database();
          $result = $service->SelectTable(null, "users");
          foreach ($result as $row) :
          ?>
            <tr>
              <th scope="row"><?= $row['idAll'] ?></th>
              <td><?= $row['NameAll'] ?></td>
              <td><?= $row['DescriptionShop'] ?? "-"?></td>
              <td><?= $row['AddressCustomer'] ?? "-"?></td>
              <td><?php if($row['AccessStatusSCR'] == 1 || $row['RoleAll'] == "Admin"){echo "ใช้งานได้ปกติ";}else{echo "ยังไม่ได้รับอนุญาต หรือ ถูกระงับการใช้งาน";}?></td>
              <td><?= $row['RoleAll']?></td>
              <td><?php echo $service->SelectTable(null, "typeshop", "WHERE IdTypeShop = " . ($row['IdTypeShop'] ?? 0))->fetch_assoc()['NameTypeShop'] ?? "-"; ?></td>
              <td>
                <div class="input-group w-100">
                  <?php if($row['AccessStatusSCR'] == 1 || $row['RoleAll'] == "Admin"){?>
                    <a href="../../Controllers/admin.ctr.php?action_Get=PermisionUser&IdUser_Get=<?= $row['idAll']?>" class="btn btn-danger w-100">ระงับการใช้งาน</a>
                  <?php } else{?>
                    <a href="../../Controllers/admin.ctr.php?action_Get=PermisionUser&IdUser_Get=<?= $row['idAll']?>" class="btn btn-primary w-100">อนุญาตการใช้งาน</a>
                  <?php } ?>
                </div>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
        </div>
    </main>
    <?php include'../Shares/footer.layout.php'?>
</body>
</html>