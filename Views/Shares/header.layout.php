<link rel="stylesheet" href="../../Src/Bootstrap/Css/bootstrap.min.css">
<?php
if(isset($_GET['Info_Get'])){?>
    <div class="alert alert-info" role="alert">
        <?php echo $_GET['Info_Get']?>
  </div>
<?php }?>