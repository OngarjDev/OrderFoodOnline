<?php
require_once '../Includes/autoload.inc.php';

class Controller {
    protected $service;

    public function __construct() {
        $this->service = new login();
    }

    public function index() {
        $this->service->Login($_REQUEST);
    }
}

// สร้างอ็อบเจกต์ของคลาส Controller และเรียกใช้เมธอด index()
$controller = new Controller();
$controller->index();

?>