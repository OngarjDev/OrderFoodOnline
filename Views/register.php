<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Src/Bootstrap/Css/Bootstrap.min.css">
    <title>ลงทะเบียนเข้าใช้งาน</title>
</head>
<body>
<div class="container">
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4 mt-5">
        <main class="form-signin mt-5">
          <form action="../Controllers/login.ctr.php?action_Get=register" method="POST">
            <h1 class="h3 mb-3 fw-normal text-center">ลงทะเบียนเข้าใช้งาน</h1>
            <div class="form-floating">
              <input type="text" class="form-control mb-2" id="floatingInput" name="UserName_Post">
              <label for="floatingInput">อีเมล</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control mb-2" id="floatingPassword" name="Password_Post">
              <label for="floatingPassword">รหัสผ่าน</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control mb-2" id="floatingPassword" name="Password_Post">
              <label for="floatingPassword">รหัสผ่าน</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">เข้าสู่ระบบ</button>
            <p class="mt-2 text-center">สำหรับ ผู้ใช้/ร้านค้า/ผู้ส่ง/ผู้ดูแลระบบ</p>
          </form>
          <a class="text-center" href="login.php">เข้าสู่ระบบ</a>
          <a class="text-center" href="index.php">กลับไปยังหน้าแรก</a>
        </main>
      </div>
      <div class="col-4"></div>
<script>
    
</script>
</body>
</html>