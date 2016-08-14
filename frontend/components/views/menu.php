<?php
//echo '<pre>' . print_r($tree, true) . '</pre>';
?>
<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <?php foreach ($tree as $item): ?>

            <?php if(preg_match('~site~', $item['key'])){
                continue;
            }?>
            <?php $isThis = $item['key'] == $route; ?>

            <li class="<?= $isThis ? 'active' : '' ?>">
                <a href="<?= \yii\helpers\Url::to([$item['key']]) ?>"><?= $item['name'] ?></a>

                <?php if ($isThis && !empty($item['children'])): ?>
                    <ul class="">
                        <?php foreach ($item['children'] as $child): ?>
                            <li><a href="<?= \yii\helpers\Url::to([$child['key']]) ?>"><?= $child['name'] ?></a></li>
                        <?php endforeach; ?>
                    </ul>

                <?php endif; ?>


            </li>
        <?php endforeach; ?>
    </ul>
</div>
