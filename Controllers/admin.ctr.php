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
            case 'PermisionUser':
                $this->handlePermisionUser();
                break;
            default:
                header("location: " . $_SERVER['HTTP_REFERER'] . "?Info=" . urlencode("ขออภัยเราไม่พบ Actionในระบบของคุณ"));
        }
    }
    private function handleAddTypeShop()
    {
        $this->admin->AddTypeShop($_REQUEST);
    }
    private function handlePermisionUser(){
        $this->admin->PermisionUser($_REQUEST);
    }
}

$controller = new Login_Controller();
$controller->handleRequest();
