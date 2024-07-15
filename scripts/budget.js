document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('create_new').addEventListener('click', () => handleButtonClick('btn_add'));
    document.getElementById('btn_edit').addEventListener('click', () => handleButtonClick('btn_edit'));
    document.getElementById('btn_delete').addEventListener('click', () => handleButtonClick('btn_delete'));
});



document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.btn_edit').forEach(function(button) {
        button.addEventListener('click', function() {
            var budItemId = this.getAttribute('data-id');
            console.log('Edit button clicked for bud_item_id:', budItemId);
            // Add your edit logic here
        });
    });

    document.querySelectorAll('.btn_delete').forEach(function(button) {
        button.addEventListener('click', function() {
            var budItemId = this.getAttribute('data-id');
            console.log('Delete button clicked for bud_item_id:', budItemId);
            // Add your delete logic here
        });
    });
});


