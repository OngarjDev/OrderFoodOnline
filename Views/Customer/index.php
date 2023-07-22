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
          <img src="../../Src/Images/BillBoard2.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../../Src/Images/BillBoard1.jpg" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="../../Src/Images/BillBoard3.jpg" class="d-block w-100" alt="...">
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

    <h2 class="text-center mt-3">ร้านค้า</h2>
    <div class="container">
      <div class="row">
        <?php
        $resultshop = $service->SelectTable(null, "users", "Where RoleAll = 'Shop' AND AccessStatusSCR = 1");
        foreach ($resultshop as $rowshop) { ?>
          <div class="col-xl-3">
            <div class="card" style="width: 18rem;">
              <div class="text-center mt-3">
                <img src="<?= $rowshop['ImageAll'] ?>" class="card-img-top rounded-circle mb-3" style="width: 115px;Height: 115px">
              </div>
              <div class="card-header">
                <h5 class="card-title text-center"><?= $rowshop['NameAll'] ?></h5>
                <p class="card-text text-center d-inline-block text-truncate" style="max-width: 250px;"><?= $rowshop['DescriptionShop'] ?></p>
                <a href="shop.php?IdShop_Get=<?= $rowshop['idAll']?>" class="btn btn-primary w-100">เยี่ยมชมร้านค้า</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </main>
  <?php include '../Shares/footer.layout.php' ?>
</body>
</html>