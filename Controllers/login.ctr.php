<?php
require_once '../Includes/autoload.inc.php';

class Login_Controller {
    protected $service;

    public function __construct() {
        $this->service = new login();
    }

    public function handleRequest() {
        switch ($_REQUEST['action_Get']) {
            case 'login': $this->handleLogin();break;
            case 'logout': $this->handleLogout();break;
            case 'register': $this->handleRegister();break;
            default: header('location: ../Views/login.php?Info=ขออภัยเราไม่พบ Actionในระบบของคุณ');
        }
    }
    private function handleLogin(){
        $this->service->Login($_REQUEST);
    }
    private function handleRegister(){
        $this->service->Register($_REQUEST);
    }
    private function handleLogout(){
        $this->service->Logout();
    }
}

// สร้างอ็อบเจกต์ของคลาส Controller และเรียกใช้เมธอด index()
$controller = new Login_Controller();
$controller->handleRequest();
