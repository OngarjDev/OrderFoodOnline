<?php
require_once '../Includes/autoload.inc.php';

class Login_Controller
{
    protected $service;
    protected $manageimage;

    public function __construct()
    {
        $this->service = new login();
        $this->manageimage = new manageimage();
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
            case 'editaccount':
                $this->headerEditAccount();
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
        if (!empty($_FILES['Image']['tmp_name'])) {
        $file = $_FILES['Image_Post'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $pathImage = $this->manageimage->MoveFile($fileName, $fileTmpName);
        $_REQUEST['ImagePath_Post'] = $pathImage ?? null;
        }

        $this->service->Register($_REQUEST);
    }
    private function handleLogout()
    {
        $this->service->Logout();
    }
    private function headerEditAccount(){
        if (!empty($_FILES['Image']['tmp_name'])) {
        $file = $_FILES['Image_Post'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $pathImage = $this->manageimage->MoveFile($fileName, $fileTmpName);
        $_REQUEST['ImagePath_Post'] = $pathImage ?? null;
        }
        $this->service->EditAccount($_REQUEST);
        switch ($_SESSION['Role_Session']) {
            case "Admin":
                $path = "Admin";
                break;
            case "Customer":
                $path = "Customer";
                break;
            case "Shop":
                $path = "Shop";
                break;
            case "Rider":
                $path = "Rider";
                break;
        }
        header("location: ../Views/$path/");
    }
}

$controller = new Login_Controller();
$controller->handleRequest();
