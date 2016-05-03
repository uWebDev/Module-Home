<?php

namespace App\Module\Home\Core;

use App\Core\Controller;

/**
 * Class ControllerModule
 * @package App\Module\Home\Core
 */
class ControllerModule extends Controller
{
    public function before()
    {
        parent::before();
        $this->container->register(new ProviderModule());
    }
}
