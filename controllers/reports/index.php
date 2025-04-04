<?= Block::put('sidepanel') ?>
    <?php if (!$this->fatalError): ?>
        <?= $this->makePartial('sidepanel') ?>
    <?php endif ?>
<?= Block::endPut() ?>

<?= Block::put('body') ?>
    <?php if (!$this->fatalError): ?>
        <div
            data-control="tab"
            data-closable
            data-close-confirmation="<?= e(trans('backend::lang.form.confirm_tab_close')) ?>"
            data-pane-classes="layout-cell"
            data-max-title-symbols="15"
            data-title-as-file-names="true"
            class="layout control-tabs master-tabs fancy-layout wn-logo-transparent"
            id="messaging-master-tabs">

            <div class="layout-row min-size">
                <div class="tabs-container">
                    <ul class="nav nav-tabs"></ul>
                </div>
            </div>
            <div class="tab-content layout-row">
            </div>

        </div>
        <?= $this->makePartial('xavier') ?>
    <?php else: ?>
        <p class="flash-message static error"><?= e(trans($this->fatalError)) ?></p>
    <?php endif ?>
<?= Block::endPut() ?>
