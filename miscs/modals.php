<?php 

?>

<div class="mod_confirm">
    <div class="modal-content confirm-content">
        <div class="confirm_delete_modal">
            <div class="title">
                <h2>Confirm Delete</h2>
            </div>

            <div class="modal_field confirm-cnt">
                <span>Are you sure you want to delete this item? You can't undo this after deleting.</span>
            </div>

            <div class="modal_field_rows modal_btns">
                <button class="btn_delete confirm_del" id="delete">DELETE</button>
                <button class="btn_cancel2">CANCEL</button>
            </div>
        </div>

        <div class="success_del_modal">
            <div class="title">
            <h2>Successfully Deleted</h2>
            <i class='bx bx-x btn_cancel3'></i>
            </div>

            <div class="modal_field confirm-cnt">
                <span>The item has been deleted successfully.</span>
            </div>
        </div>
        
        <div class="success_upd_modal">
            <div class="title">
            <h2>Successfully Updated</h2>
            <i class='bx bx-x btn_cancel4'></i>
            </div>

            <div class="modal_field confirm-cnt">
                <span>The changes has been updated successfully.</span>
            </div>
        </div>
        
    </div>
</div>