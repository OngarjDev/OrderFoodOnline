<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Src/Bootstrap/css/Bootstrap.min.css">
  <title>เข้าสู่ระบบ</title>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4 mt-5">
        <main class="form-signin">
          <form action="../Services/Login.Class.php" method="POST">
          <img class="mb-43 rounded-circle mx-auto d-block" src="../Src/Images/Login.jpg"width="120" height="120">
            <h1 class="h3 mb-3 fw-normal text-center">เข้าสู่ระบบ</h1>
            <div class="form-floating">
              <input type="text" class="form-control mb-2" id="floatingInput" name="UserName">
              <label for="floatingInput">อีเมล</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control mb-2" id="floatingPassword" name="Password">
              <label for="floatingPassword">รหัสผ่าน</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">เข้าสู่ระบบ</button>
            <p class="mt-2 text-center">สำหรับ ผู้ใช้/ร้านค้า/ผู้ส่ง/ผู้ดูแลระบบ</p>
          </form>
        </main>
      </div>
      <div class="col-4"></div>
</body>

</html>