<?php
class test extends CI_controller
{
    function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $pages = 'test';
        $data = 'huhu';
        $this->template->layout($pages, $data);
    }
}
