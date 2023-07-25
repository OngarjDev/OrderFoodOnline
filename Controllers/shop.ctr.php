<?php
require_once '../Includes/autoload.inc.php';

class Shop_Controller
{
    protected $shop;
    protected $manageimage;
    public function __construct()
    {
        $this->shop = new shop();
        $this->manageimage = new manageimage();
    }

    public function handleRequest()
    {
        switch ($_REQUEST['action_Get']) {
            case 'AddTypeFood':
                $this->shop->AddTypeFood($_REQUEST);
                break;
            case 'AddFood':
                $this->handleAddFood();
                break;
            case 'DeleteFood':
                $this->shop->DeleteFood($_REQUEST);
                break;
            case 'EditFood':
                $this->handleEditFood();
                break;
            case 'AddDiscount':
                $this->shop->AddDiscount($_REQUEST);
                break;
            case 'DeleteDiscount':
                $this->shop->DeleteDiscount($_REQUEST);
                break;
            default:
                header("location: " . $_SERVER['HTTP_REFERER'] . "?Info=" . urlencode("ขออภัยเราไม่พบ Actionในระบบของคุณ"));
        }
    }
    private function handleAddFood()
    {
        if (!empty($_FILES['ImageFood_Post']['tmp_name'])) {
            $file = $_FILES['ImageFood_Post'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $pathImage = $this->manageimage->MoveFile($fileName, $fileTmpName);
            $_REQUEST['ImagePath_Post'] = $pathImage ?? null;
        }
        $this->shop->AddFood($_REQUEST);
    }
    private function handleEditFood()
    {
        if (!empty($_FILES['ImageFood_Post']['tmp_name'])) {
            $file = $_FILES['ImageFood_Post'];
            $fileName = $file['name'];
            $fileTmpName = $file['tmp_name'];
            $pathImage = $this->manageimage->MoveFile($fileName, $fileTmpName);
            $_REQUEST['ImagePath_Post'] = $pathImage ?? null;
        }
        $this->shop->EditFood($_REQUEST);
    }
}

$controller = new Shop_Controller();
$controller->handleRequest();
