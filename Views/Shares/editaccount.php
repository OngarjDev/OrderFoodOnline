<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'header.layout.php' ?>
    <title>แก้ไขข้อมูลบัญชีผู้ใช้</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 mt-5">
                <main class="form-signin mt-3">
                    <?php
                    require '../../Includes/autoload.inc.php';
                    $dataInput = new data_input();
                    $connect = new connect_database();
                    session_start();
                    ?>

                    <form action="../../Controllers/login.ctr.php?action_Get=editaccount&IdUser_Get=<?= $_SESSION['IdUser_Session'] ?>" method="Post" class="form-control" enctype="multipart/form-data">
                        <h1 class="text-center mt-2">แก้ไขข้อมูลบัญชี</h1>

                        <?php foreach ($dataInput->formInputs as $accountType => $inputs) {
                            if ($accountType === $_SESSION['Role_Session']) :
                        ?>
                                <?php foreach ($inputs as $input) { ?>
                                    <label><?= $input->label ?></label> <br>

                                    <?php if ($input->type === 'textarea') { ?>
                                        <textarea class="form-control w-100" name="<?= $input->name ?>" placeholder="<?= $input->placeholder ?>"></textarea>
                                    <?php } elseif ($input->type === 'text' || $input->type === 'password') { ?>
                                        <input class="w-100 form-control" type="<?= $input->type ?>" name="<?= $input->name; ?>" placeholder="<?= $input->placeholder; ?>">
                                    <?php } elseif ($input->type === 'file') { ?>
                                        <img id="imagePreview" src="#" alt="Preview Image" hidden />
                                        <input class="form-control" type="file" name="<?= $input->name ?>" accept="image/png, image/jpeg">
                                    <?php } elseif ($input->type === 'select') { ?>
                                        <select class="form-select" name="IdTypeShop_Post" required>
                                            <option value="" selected>เลือกประเภทร้านอาหารของคุณ</option>
                                            <?php
                                            require '../../Includes/autoload.inc.php';
                                            $service = new connect_database();
                                            $result = $service->SelectTable(null, "typeshop");
                                            foreach ($result as $row) { ?>
                                                <option value="<?= $row['IdTypeShop'] ?>"><?= $row['NameTypeShop'] ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                    <br>
                                <?php } ?>

                        <?php endif;
                        } ?>

                        <button type="submit" class="w-100 btn btn-primary mt-2 mb-2">แก้ไขข้อมูล</button>
                    </form>
                        <div class="text-center"><a  href="<?=$_SERVER['HTTP_REFERER']?>">กลับไปยังหน้าเดิม</a></div>
                </main>
            </div>
            <div class="col-4"></div>
</body>

</html>