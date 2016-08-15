<?php
/**
 * Created by PhpStorm.
 * User: YOBA
 * Date: 14.08.2016
 * Time: 19:02
 */

namespace console\controllers;


use common\rbac\AuthorRule;
use yii\console\Controller;

class RbacController extends Controller
{
    public function init()
    {
        $auth = \Yii::$app->authManager;
        $auth->removeAll();

        $authorRule = new AuthorRule();
        $auth->add($authorRule);

        $createNews = $auth->createPermission('createNews');
        $createNews->description = 'Создание новости';
        $auth->add($createNews);

        $updateOwnNews = $auth->createPermission('updateOwnNews');
        $updateOwnNews->description = 'Обноволение собственной новости';
        $updateOwnNews->ruleName = $authorRule->name;
        $auth->add($updateOwnNews);

        $updateNews = $auth->createPermission('updateNews');
        $updateNews->description = 'Обновление новости';
        $auth->add($updateNews);

        $deleteNews = $auth->createPermission('deleteNews');
        $deleteNews->description = 'Удаление новости';
        $auth->add($deleteNews);

        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $createNews);
        $auth->addChild($user, $updateOwnNews);

        $editor = $auth->createRole('editor');
        $auth->add($editor);
        $auth->addChild($editor, $user);
        $auth->addChild($editor, $updateNews);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $editor);
        $auth->addChild($admin, $deleteNews);

        $auth->assign($admin, 1);
    }

}