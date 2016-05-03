<?php $this->layout('page') ?>

<!--HEADER-->

<?php $this->start('header') ?>
<div class="logo">
    <img src="/<?= $this->e($template) ?>/img/logo.png" alt=""> MBrowser
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
<h2>Выберите платформу</h2>
<div class="list-group">
    <?php foreach ($categories as $cell): ?>
        <a href="<?= $this->route('category', ['id' => $cell['id']]) ?>" class="list-group-item">
            <span class="badge"><?= $cell['count'] ?></span>
            <span class="icon icon-folder"></span><?= $cell['title'] ?>
        </a>
    <?php endforeach ?>
</div>
<?php $this->stop() ?>

<!--FOOTER-->

<?php $this->start('footer') ?>
<?php $this->stop() ?>