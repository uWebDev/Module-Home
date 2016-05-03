<?php

namespace App\Module\Home\Controller;

use App\Module\Home\Core\ControllerModule;
use Dore\Core\Foundation\App;

/**
 * Class IndexController
 * @package App\Module\Home\Controller
 */
class IndexController extends ControllerModule
{

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->container['response']->setContent(
            $this->container['view']->render(
                'module::homepage',
                ['categories' => $this->container['category']->allList()]
            )
        );
    }

    /**
     * Captcha
     * @return string
     */
    public function actionCaptcha()
    {
        $captcha = $this->container['captcha'];

        $code = $captcha->generateCode();
        $this->container['session']->set(App::config()->get('captcha.default.name'), $code);

        return $this->container['response']->setContent(
            $captcha->generateImage($code)
        )->headers->set('Content-Type', 'image/png');
    }
}
