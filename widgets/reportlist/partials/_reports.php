<div id="report-list" class="layout-absolute">
    <div class="control-scrollbar" data-control="scrollbar">
        <!-- 
            #ReportList-reportList-messages
            winter.css CSS styles this .control-filelist
        -->
        <div
            class="control-filelist <?= $this->controlClass ?>"
            data-control="filelist"
            data-template-type="report"
            data-group-status-handler="<?= $this->getEventHandler('onSetCollapseStatus') ?>"
            id="<?= $this->getId('messages') ?>"
            websocket-listen="messaging"
            websocket-onmessaging-message-<?= $authUser->id ?>-update="'report_list': '#<?= $this->getId('messages') ?>'"
            websocket-onmessaging-message-<?= $authUser->id ?>-request="reportList::onUpdate"
            websocket-onmessaging-message-<?= $authUser->id ?>-sound="/plugins/acorn/messaging/assets/sounds/report-arrived.mp3"
        >
            <?= $reports
                ? $this->makePartial('report_list', [
                    'reports' => $reports
                  ])
                : $this->makePartial('hint_no_friends')
            ?>
        </div>
    </div>
</div>
