<?php

namespace ozerich\shop\modules\admin\controllers;

use ozerich\shop\models\Category;
use ozerich\shop\modules\admin\forms\CategoryForm;
use ozerich\shop\modules\admin\forms\CategoryFormConvertor;
use ozerich\admin\actions\CreateOrUpdateAction;
use ozerich\admin\actions\DeleteAction;
use ozerich\admin\actions\ListAction;
use ozerich\admin\controllers\base\AdminController;
use ozerich\shop\traits\ServicesTrait;

class CategoriesController extends AdminController
{
    use ServicesTrait;

    public function actions()
    {
        return [
            'index' => [
                'class' => ListAction::class,
                'models' => $this->categoriesService()->getTreeAsArray(),
                'pageSize' => -1,
                'view' => 'index'
            ],
            'create' => [
                'class' => CreateOrUpdateAction::class,
                'modelClass' => Category::class,
                'isCreate' => true,
                'view' => 'create',
                'redirectUrl' => '/admin/categories'
            ],
            'update' => [
                'class' => CreateOrUpdateAction::class,
                'modelClass' => Category::class,
                'isCreate' => false,
                'view' => 'update',
                'redirectUrl' => '/admin/categories'
            ],
            'delete' => [
                'class' => DeleteAction::class,
                'modelClass' => Category::class
            ]
        ];
    }
}