<form action="" method="post">
    <div class="edit_fields">
        <label for="rbud_item_desc">Item: <b class="req_field">*</b></label>
        <input type="text" name="edit_item" id="edit_item"
            <?php if ($err_bud_items[1] == True) echo 'class="err_field"';
                echo 'value="' . $data['bud_item_name'] . '" ';
                if ($action == 'del') echo 'readonly'; ?>>
        <?php if ($err_bud_items[1] == True) echo '<span class="err_message">Please enter an item name.</span>'; ?>
    </div>

    <div class="edit_fields">
        <label for="rbud_item_desc">Purpose: <b class="req_field">*</b></label>
        <input type="text" name="edit_purp" id="edit_purp"
            <?php if ($err_bud_items[2] == True) echo 'class="err_field"';
                echo 'value="' . $data['bud_item_purp'] . '"'; 
                if ($action == 'del') echo 'readonly';?>>
        <?php if ($err_bud_items[2] == True) echo '<span class="err_message">Please enter its purpose.</span>'; ?>
    </div>

    <div class="edit_fields">
        <label for="rbud_item_desc">Amount: <b class="req_field">*</b></label>
        <input type="text" name="edit_amnt" id="edit_amnt" 
            <?php if ($err_bud_items[3] == True) echo 'class="err_field"';
                echo 'value="' . $data['bud_item_amount'] . '"';
                if ($action == 'del') echo 'readonly';?>>
        <?php if ($err_bud_items[3] == True) echo '<span class="err_message">Please enter its amount.</span>'; ?>
    </div>

    <div class="edit_fields">
        <label for="rbud_item_desc">Note:</label>
        <input type="text" name="edit_desc" id="edit_desc" class="edit_desc" <?php echo 'value="' . $data['bud_item_desc'] . '"'; 
            if ($action == 'del') echo 'readonly'; ?>>
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