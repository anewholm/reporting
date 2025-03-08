<?php if ($reports): ?>
    <ul>
        <?php foreach ($reports as $report): ?>
            <li
                class="item report-<?= $report->itemType ?>"
                data-item-path="<?= $report->id ?>"
                data-item-theme="<?= e($this->theme->getDirName()) ?>"
                data-item-type="<?= $report->itemType ?>"
                data-id="report-<?= "$report->itemType-" . $this->theme->getDirName() . "-$report->id" ?>"
            >
                <a href="javascript:;">
                    <span class="title"><?= e($report->title) ?></span>
                    <span class="description" title="<?= e($report->description) ?>">
                        <?= e($report->description) ?>
                        <?php foreach ($report->descriptions as $name => $description): ?>
                            <?php if (is_iterable($description)): ?>
                                <?php foreach ($description as $idescription): ?>
                                    <span class="<?= e($name) ?>" title="<?= e($name) ?>"><?= e($idescription->name) ?></span>
                                <?php endforeach ?>
                            <?php else: ?>
                                <span class="<?= e($name) ?>" title="<?= e($name) ?>"><?= e($description) ?></span>
                            <?php endif ?>
                        <?php endforeach ?>
                    </span>
                    <span class="borders"></span>
                </a>

                <input type="hidden" name="message-[<?= e($report->id) ?>]" value="0" />
                <!-- div class="checkbox custom-checkbox nolabel">
                    <?php $cbId = 'cb' . md5($this->itemType . '/' . $report->id) ?>
                    <input
                        id="<?= $cbId ?>"
                        type="checkbox"
                        name="message-[<?= e($report->id) ?>]"
                        <?= $this->isItemSelected($report->id) ? 'checked' : null ?>
                        data-request="<?= $this->getEventHandler('onSelect') ?>"
                        value="1">
                    <label for="<?= $cbId ?>">Select</label>
                </div -->
            </li>
        <?php endforeach ?>
    </ul>
<?php else: ?>
    <p class="no-data"><?= e(trans($this->noRecordsMessage)) ?></p>
<?php endif ?>

<?php if (!isset($nested)): ?>
    <input type="hidden" name="theme" value="<?= e($this->theme->getDirName()) ?>">
<?php endif ?>
