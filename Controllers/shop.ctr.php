<?php
require_once '../Includes/autoload.inc.php';

class Shop_Controller
{
    protected $shop;
    public function __construct()
    {
        $this->shop = new shop();
    }

    public function handleRequest()
    {
        switch ($_REQUEST['action_Get']) {
            case 'AddTypeFood':
                $this->handleAddTypeShop();
                break;
            default:
                header("location: " . $_SERVER['HTTP_REFERER'] . "?Info=" . urlencode("ขออภัยเราไม่พบ Actionในระบบของคุณ"));
        }
    }
    private function handleAddTypeShop()
    {
        $this->shop->AddTypeFood($_REQUEST);
    }

}

$controller = new Shop_Controller();
$controller->handleRequest();
