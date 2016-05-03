<?php

namespace App\Module\Home;

use Dore\Core\Foundation\Module;

/**
 * Class HomeModule
 * @package App\Module\Home
 */
class HomeModule extends Module
{

    /**
     * HomeModule constructor.
     */
    public function __construct()
    {
        $this->setRoutes(__DIR__ . DS . 'Assets' . DS . 'Config' . DS . 'routes.php');
    }
}
