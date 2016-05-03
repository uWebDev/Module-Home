<?php $this->layout('page') ?>

<!--HEADER-->

<?php $this->start('header') ?>
<div class="button text-center">
    <a href="<?= $this->route('home') ?>">
        <i class="icon-direction-left"></i>
    </a>
</div>
<div class="separator"></div>
<div>
    <h2><?= $this->e($data['title']) ?></h2>
</div>
<div class="separator"></div>
<div class="button text-center">
    <?php if ($isGuest) : ?>
        <a href="<?= $this->route('login') ?>">
            <i class="icon-login"></i>
        </a>
    <?php else : ?>
        <a href="<?= $this->route('user') ?>">
            <i class="icon-menu"></i>
        </a>
    <?php endif ?>
</div>
<?php $this->stop() ?>

<!--MAIN-->

<?php $this->start('main') ?>
<h2>Список игр:</h2>
<div class="list-group">
    <?php foreach ($list as $cell): ?>
        <a href="<?= $this->route('article', ['id' => $cell['id']]) ?>" class="list-group-item">
            <span class="icon icon-folder"></span><?= $this->e($cell['title']) ?>
            <span class="icon-direction-right pull-right"></span>
        </a>
    <?php endforeach ?>
</div>
<?php $this->insert('pagination', $pagination) ?>
<?php //$this->insert('ad_bottom') ?>
<?php $this->stop() ?>