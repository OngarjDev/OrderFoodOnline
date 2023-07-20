<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include '../Shares/header.layout.php' ?>
  <title>หน้าหลัก</title>
</head>

<body>
  <?php include 'navbar.layout.php' ?>
  <main class="container">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="..." class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="..." class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="..." class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <h3 class="text-center">หมวดหมู่อาหาร</h3>
    <div class="text-center">
      <?php
      require_once '../../Includes/autoload.inc.php';
      $service = new connect_database();
      $result = $service->SelectTable(null, "typefood")->fetch_assoc();
      foreach ($result as $row) {
      ?>
        <a class="badge rounded-pill bg-secondary text-decoration-none" href=""></a>
      <?php } ?>
    </div>

    <h3 class="text-center">ร้านค้า</h3>
        <?php
        $resultshop = $service->SelectTable(null,"users","Where RoleAll = 'Shop'")->fetch_assoc();
        foreach($resultshop as $rowshop){?>
          
        <?php } ?>
  </main>
  <?php include '../Shares/footer.layout.php' ?>
</body>

</html>