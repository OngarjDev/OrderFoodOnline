<?php
require_once '../Includes/autoload.inc.php';

class Rider_Controller
{
    protected $rider;
    public function __construct()
    {
        $this->rider = new rider();
    }

    public function handleRequest()
    {
        switch ($_REQUEST['action_Get']) {
            case 'ReceiveOrder':
                $this->rider->ReceiveOrder($_REQUEST);
                break;
                case 'ConfrimOrder':
                    $this->rider->ConfrimOrder($_REQUEST);
                    break;
            default:
                header("location: " . $_SERVER['HTTP_REFERER'] . "?Info=" . urlencode("ขออภัยเราไม่พบ Actionในระบบของคุณ"));
        }
    }
}

$controller = new Rider_Controller();
$controller->handleRequest();
