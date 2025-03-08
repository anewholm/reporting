<div class="report-interface report-interface-<?= $templatePath ?>">
    <?php if (isset($inGroup)): ?>
        <!-- TODO: Remove this groups message -->
        <br/>
        <div class="layout-row min-size">
            <div class="callout callout-warning">
                <div class="header">
                    <i class="icon-warning"></i>
                    <h3><?= e(trans('Groups functionality not complete')) ?></h3>
                    <p>
                        <?= e(trans('sz is busy with other shit man 😴')) ?>
                    </p>
                </div>
            </div>
        </div>            
    <?php endif ?>

     <!-- This is the container DIV for the AJAX partial updating -->    
    <div id="report-<?= $templatePath ?>"
        websocket-listen="messaging"
        websocket-onmessaging-message-<?= $templatePath ?>-update="'report': '#report-<?= $templatePath ?>'"
        websocket-onmessaging-message-<?= $templatePath ?>-sound="/plugins/acorn/messaging/assets/sounds/message-arrived.mp3"
    >
       <?= $this->makePartial('report', array(
            'templatePath' => $templatePath,
            'messages'     => $messages,
        )); ?>
    </div>

    <?= $form ? $this->makePartial('report_form', array(
        'form'          => $form,
        'authUser'      => $authUser,
        'withUser'      => $withUser,
        'templateType'  => $templateType,
        'templateSubType'  => $templateSubType,
        'templatePath'  => $templatePath,
        'templateTheme' => $templateTheme,
    )) : NULL ?>
</div>
