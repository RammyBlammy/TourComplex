<?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs'], 'options' =>[
    'class' => 'breadcrumb bg-dark rounded-end p-1 bg-gradient']]) ?>
        <?php endif ?>