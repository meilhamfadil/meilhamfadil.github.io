<?php
    $FC = $this->formcreator;
?>
<div class="modal fade" id="m-confirm" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true">
    <div class="modal-dialog modal-confirm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="label-confirm"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="message-confirm"></div>
            <?= $FC->input("hidden", "", "url", "", "")->show(); ?>
            <?= $FC->input("hidden", "", "cid", "", "")->show(); ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="confirm" class="btn">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>