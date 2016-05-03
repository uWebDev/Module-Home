<?php $this->layout('page') ?>

    <!--HEADER-->

<?php $this->start('header') ?>
    <div class="button text-center">
        <a href="<?=
        $this->route('category_page', [
            'id' => $data['id_category'],
            'page' => $page
        ])
        ?>">
            <i class="icon-direction-left"></i>
        </a>
    </div>
    <div class="separator"></div>
    <div>
        <h2><?= $this->e($data['name']) ?></h2>
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
    <article>
        <h2><?= $this->e($data['title']) ?></h2>
        <div class="well well-sm">
            <?= $data['description'] ?>
        </div>
    </article>
<?php $this->insert('pagination_article', $pagination) ?>
<?php $this->stop() ?>