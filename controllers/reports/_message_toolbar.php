<div class="form-buttons loading-indicator-container">
    <?php
    if ($templatePath): ?>
        <a
            href="javascript:;"
            class="btn btn-primary wn-icon-check reply"
            data-request="reportList::onReply"
            data-load-indicator="<?= e(trans('backend::lang.form.saving')) ?>"
            data-hotkey="ctrl+s, cmd+s">
            <?= e('Reply') ?>
        </a>
    <?php else: ?>
        <!-- TODO: data-request-update="'reports': '.report-list'" -->
        <a
            href="javascript:;"
            class="btn btn-primary wn-icon-check send"
            data-request="onSend"
            data-load-indicator="<?= e(trans('backend::lang.form.saving')) ?>"
            data-hotkey="ctrl+s, cmd+s">
            <?= e('Send') ?>
        </a>
    <?php endif ?>

    <!-- a
        href="javascript:;"
        class="btn btn-primary wn-icon-crosshairs save-draft"
        data-request="onSaveDraft"
        data-load-indicator="<?= e(trans('backend::lang.form.saving')) ?>"
        data-hotkey="ctrl+s, cmd+s">
        <?= e('Save draft') ?>
    </a -->
</div>
