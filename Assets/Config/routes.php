<?php

use App\Module\Home\Controller\IndexController;
use App\Module\Home\Controller\CategoryController;
use App\Module\Home\Controller\ArticleController;

return [
    [
        'GET',
        '/',
        [
            'controller' => IndexController::class,
            'action' => 'Index',
        ],
        'home'
    ],
    [
        'GET',
        '/captcha/',
        [
            'controller' => IndexController::class,
            'action' => 'Captcha',
        ],
        'captcha'
    ],
    // Categories
    [
        'GET',
        '/category/[i:id]/',
        [
            'controller' => CategoryController::class,
            'action' => 'Index'
        ],
        'category'
    ],
    [
        'GET',
        '/category/[i:id]/[i:page]/',
        [
            'controller' => CategoryController::class,
            'action' => 'Index'
        ],
        'category_page'
    ],
    // Article
    [
        'GET',
        '/article/[i:id]/',
        [
            'controller' => ArticleController::class,
            'action' => 'Index'
        ],
        'article'
    ],
];
