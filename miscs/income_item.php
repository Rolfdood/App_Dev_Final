<form method="post">
    <div class="edit_fields">
        <label for="inc_type">Title: <b class="req_field">*</b></label>
        <input type="text" name="inc_type" id="inc_type" required>
    </div>

    <div class="edit_fields">
        <label for="inc_date">Date: <b class="req_field">*</b></label>
        <input type="date" name="inc_date" id="inc_date" required>
    </div>

    <div class="edit_fields">
        <label for="inc_origin">Origin: <b class="req_field">*</b></label>
        <input type="text" name="inc_origin" id="inc_origin" required>
    </div>

    <div class="edit_fields">
        <label for="inc_mot">Mode of Transaction:</label>
        <select name="inc_mot" id="inc_mot">
            <option value="CASH">CASH</option>
            <option value="GCASH">GCASH</option>
            <option value="PAYMAYA">PAYMAYA</option>
            <option value="BDO">BDO</option>
            <option value="BPI">BPI</option>
        </select>
    </div>

    <div class="edit_fields">
        <label for="inc_amount">Amount: <b class="req_field">*</b></label>
        <input type="number" name="inc_amount" id="inc_amount" min="0" step="0.01" required>
    </div>

    <div class="edit_fields">
        <label for="inc_remarks">Remarks:</label>
        <textarea name="inc_remarks" id="inc_remarks"></textarea>
    </div>

    <div class="edit_fields">
        <?php if ($action == 'upd') echo
            '<input type="submit" value="UPDATE ITEM" name="btn_update" class="btn_update" id="btn_update">';
        if ($action == 'del') {
            echo 
            '<input type="submit" value="DELETE ITEM" name="btn_del" class="btn_delete" id="btn_del">'; 
            echo '<span class="delete_note"><b>NOTE :</b> The item will be deleted. You can\'t undo this once deleted.</span>';}
        ?>
    </div>
</form>