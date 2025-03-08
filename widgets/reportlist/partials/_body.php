<?= $this->makePartial('toolbar') ?>

<div class="layout-row">
    <div class="layout-cell">
        <div class="layout-relative">
            <?= $this->makePartial('reports', [
                'authUser'      => $authUser,
                'reports' => $reports,
            ]) ?>
        </div>
    </div>
</div>
