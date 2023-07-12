<?php
require_once '../Includes/autoload.inc.php';

class Login_Controller
{
    protected $admin;
    public function __construct()
    {
        $this->admin = new admin();
    }

    public function handleRequest()
    {
        switch ($_REQUEST['action_Get']) {
            case 'AddTypeShop':
                $this->handleAddTypeShop();
                break;
            case 'DeleteTypeShop':
                // $this->handleRegister();
                break;
            default:
                header("location: " . $_SERVER['HTTP_REFERER'] . "?Info=" . urlencode("ขออภัยเราไม่พบ Actionในระบบของคุณ"));
                exit;
        }
    }
    private function handleAddTypeShop()
    {
        $this->admin->AddTypeShop($_REQUEST);
    }
}

// สร้างอ็อบเจกต์ของคลาส Controller และเรียกใช้เมธอด index()
$controller = new Login_Controller();
$controller->handleRequest();
