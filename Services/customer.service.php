<?php 
require_once dirname(__DIR__) .'/Includes/autoload.inc.php';
class customer{
    protected $service;
    public function __construct()
    {
        $this->service = new connect_database();
    }
}
?>