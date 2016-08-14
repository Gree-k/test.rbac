<?php
/**
 * Created by PhpStorm.
 * User: YOBA
 * Date: 13.08.2016
 * Time: 16:36
 */

namespace frontend\components;


use frontend\models\Page;
use yii\base\Widget;
use yii\data\Sort;
use yii\db\Expression;

class MenuWidget
    extends Widget
{
    protected $items;
    public $route;

    public function init()
    {
        parent::init();

        $this->items = Page::find()
            ->indexBy('id')
            ->asArray()
            ->where(['visible' => true])
            ->orderBy('sort')
            ->all();
    }

    public function run()
    {
        $tree = $this->getTree();

        return $this->render('menu', ['tree' => $tree, 'route' => $this->route]);
    }

    protected function getTree(){
        $tree = [];
        foreach ($this->items as $id=>&$item) {
            if (!$item['parent_id'])
                $tree[$id] = &$item;
            else
                $this->items[$item['parent_id']]['children'][$item['id']] = &$item;
        }
        return $tree;
    }


}