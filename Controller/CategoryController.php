<?php

namespace App\Module\Home\Controller;

use App\Module\Home\Core\ControllerModule;

/**
 * Class CategoryController
 * @package App\Module\Home\Controller
 */
class CategoryController extends ControllerModule
{

    /**
     * @param $params
     *
     * @return mixed
     */
    public function actionIndex($params)
    {
        $id = (int)$params['id'];
        $page = (isset($params['page']) && (int)$params['page'] > 0) ? (int)$params['page'] : 1;

        //TODO
        $limit = 2; //10
        $start = $page * $limit - $limit;

        $data = $this->container['category']->data($id);
        $list = $this->container['article']->listInCategory($id, $start, $limit);
        $total = $this->container['article']->countInCategory($id);

        $pagination = [
            'data' => $this->container['paginator']
                ->setCurrentPage($page)
                ->setRecordsCount($total)
                ->setPerPageLimit($limit)
                ->setMaxPageCount(5)
                ->getPages(),
            'route' => 'category_page',
            'id' => $data['id']
        ];
        return $this->container['response']->setContent(
            $this->container['view']->render('module::category', compact('data', 'list', 'pagination'))
        );
    }

}
