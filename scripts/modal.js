document.getElementById('btn_new').addEventListener('click', function() {
    document.getElementById('.modal-bg').style.display = 'flex';
});

document.querySelector('.btn_cancel').addEventListener('click', function(){
    document.getElementById('.modal-bg').style.display = 'none';
});

// FOR EDIT
document.getElementById('btn_edit').addEventListener('click', function() {
    document.querySelector('.modal-bg').style.display = 'flex';
});

document.querySelector('.btn_cancel').addEventListener('click', function(){
    document.querySelector('.modal-bg').style.display = 'none';
});

document.getElementById('create_new').addEventListener('click', function() {
    document.querySelector('.modal-bg').style.display = 'flex';
});

document.querySelector('.btn_cancel').addEventListener('click', function(){
    document.querySelector('.modal-bg').style.display = 'none';
});

document.querySelector('.btn_delete').addEventListener('click', function() {
    document.querySelector('.mod_confirm').style.display = 'flex';
    document.querySelector('.confirm_delete_modal').style.display = 'block';
});

document.querySelector('.btn_cancel2').addEventListener('click', function(){
    document.querySelector('.mod_confirm').style.display = 'none';
    document.querySelector('.confirm_delete_modal').style.display = 'none';

});