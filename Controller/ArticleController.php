<?php

namespace App\Module\Home\Controller;

use App\Module\Home\Core\ControllerModule;

/**
 * Class ArticleController
 * @package App\Module\Home\Controller
 */
class ArticleController extends ControllerModule
{

    /**
     * @param $params
     *
     * @return mixed
     */
    public function actionIndex($params)
    {
        $data       = $this->container['article']->data(intval($params['id']));
        $page       = ceil(($data['pagination'] + 1) / 10);
        $pagination = [
            'route' => 'article',
            'data'  => $data
        ];
        return $this->container['response']->setContent(
                        $this->container['view']->render('module::article', compact('data', 'page', 'pagination'))
        );
    }

}
