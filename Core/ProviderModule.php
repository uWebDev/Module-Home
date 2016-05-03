<?php

namespace App\Module\Home\Core;

use App\Module\Home\Model\Article;
use App\Module\Home\Model\Category;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class ProviderModule
 * @package App\Module\Home\Core
 */
class ProviderModule implements ServiceProviderInterface
{

    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['article'] = function ($c) {
            return new Article($c['db'], $c['validate']);
        };

        $container['category'] = function ($c) {
            return new Category($c['db'], $c['validate']);
        };
    }

}
