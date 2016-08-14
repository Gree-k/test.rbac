<?php
/**
 * Created by PhpStorm.
 * User: YOBA
 * Date: 14.08.2016
 * Time: 19:12
 */

namespace common\rbac;

use yii\rbac\Rule;

class AuthorRule extends Rule
{
    public $name = 'isAuthor';

    public function execute($user, $item, $params)
    {
        return isset($params['news']) ? $params['news']->createdBy == $user : false;    }
}