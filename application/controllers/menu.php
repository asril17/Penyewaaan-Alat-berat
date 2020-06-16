<?php
class menu extends CI_controller
{
    function __wakeup()
    {
        parent::__construct();
        is_logged_in();
    }
}
