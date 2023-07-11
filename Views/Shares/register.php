<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include'header.layout.php'?>  
  <title>ลงทะเบียนเข้าใช้งาน</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4 mt-5">
        <main class="form-signin mt-5">
          <?php if (isset($_REQUEST['TypeAccount_Get'])) {
            require '../../Includes/autoload.inc.php';
            $dataInput = new data_input();
          ?>

            <form action="../Controllers/login.ctr.php?action_Get=register" method="Post" class="form-control" enctype="multipart/form-data">
              <h1 class="text-center">สมัครสมาชิก</h1>

              <?php foreach ($dataInput->formInputs as $accountType => $inputs) {
                if ($accountType === $_REQUEST['TypeAccount_Get']) :
              ?>

                  <p class="text-center">ประเภทบัญชีที่คุณจะสมัคร : <?= $accountType ?> <a href="register.php">เปลี่ยน</a></p>

                  <?php foreach ($inputs as $input) { ?>
                    <label><?= $input->label ?></label> <br>

                    <?php if ($input->type === 'textarea') { ?>
                      <textarea class="form-control w-100" name="<?= $input->name ?>" placeholder="<?= $input->placeholder ?>"></textarea>
                    <?php } elseif ($input->type === 'text' || $input->type === 'password') { ?>
                      <input class="w-100 form-control" type="<?= $input->type ?>" name="<?= $input->name; ?>" placeholder="<?= $input->placeholder; ?>">
                    <?php } elseif ($input->type === 'file') { ?>
                      <img id="imagePreview" src="#" alt="Preview Image" hidden/>
                      <input class="form-control" type="file" name="<?= $input->name ?>" accept="image/png, image/jpeg">
                    <?php } ?>
                    <br>
                  <?php } ?>

              <?php endif;
              } ?>

              <button type="submit" class="w-100 btn btn-primary mt-2 mb-2">สมัครเข้าใช้งาน</button>
            </form>

          <?php } else { ?>
            <form action="register.php" method="Get" class="form-control">
              <h3 class="text-center">สมัครบัญชีของคุณ</h3>
              <label>ประเภทบัญชี</label>
              <select class="form-select" name="TypeAccount_Get" required>
                <option value="" selected>เลือกประเภทบัญชีของคุณ</option>
                <option value="Customer">ลูกค้า</option>
                <option value="Shop">ร้านอาหาร</option>
                <option value="Rider">ผู้ส่งสินค้า</option>
              </select>
              <button type="submit" class="w-100 btn btn-primary mt-2">เลือกประเภทบัญชี</button>
            </form>
          <?php } ?>
          <div class="row">
            <div class="col">
              <a href="index.php" class=" w-100">กลับไปยังหน้าหลัก</a>
            </div>
            <div class="col">
              <a href="login.php" class=" w-100">เข้าสู่ระบบ</a>
            </div>
          </div>
        </main>
      </div>
      <div class="col-4"></div>
</body>

</html>