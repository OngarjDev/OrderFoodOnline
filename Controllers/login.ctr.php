<?php
require_once '../Includes/autoload.inc.php';

class Login_Controller
{
    protected $service;
    protected $manageimage;

    public function __construct()
    {
        $this->service = new login();
        // $this->manageimage = new manageimage();
    }

    public function handleRequest()
    {
        switch ($_REQUEST['action_Get']) {
            case 'login':
                $this->handleLogin();
                break;
            case 'logout':
                $this->handleLogout();
                break;
            case 'register':
                $this->handleRegister();
                break;
            default:
                header('location: ../Views/Shares/login.php?Info=ขออภัยเราไม่พบ Actionในระบบของคุณ');
        }
    }
    private function handleLogin()
    {
        $this->service->Login($_REQUEST);
    }
    private function handleRegister()
    {
        $file = $_FILES['Image_Post'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];

        $this->service->Register($_REQUEST);
    }
    private function handleLogout()
    {
        $this->service->Logout();
    }
}

// สร้างอ็อบเจกต์ของคลาส Controller และเรียกใช้เมธอด index()
$controller = new Login_Controller();
$controller->handleRequest();
