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
                $this->handleAddTypeShop();
                break;
            case 'AddFood':
                $this->handleAddFood();
                break;
            case 'DeleteFood':
                $this->handleDeleteFood();
                break;
            default:
                header("location: " . $_SERVER['HTTP_REFERER'] . "?Info=" . urlencode("ขออภัยเราไม่พบ Actionในระบบของคุณ"));
        }
    }
    private function handleAddTypeShop()
    {
        $this->shop->AddTypeFood($_REQUEST);
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
    private function handleDeleteFood(){
        $this->shop->DeleteFood($_REQUEST);
    }
}

$controller = new Shop_Controller();
$controller->handleRequest();
