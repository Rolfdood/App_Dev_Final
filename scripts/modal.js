document.getElementById('btn_new').addEventListener('click', function() {
    document.querySelector('.modal-bg').style.display = 'flex';
});

document.querySelector('.btn_c1').addEventListener('click', function(){
    document.querySelector('.modal-bg').style.display = 'none';
});

// FOR EDIT
document.getElementById('btn_edit_main').addEventListener('click', function() {
    document.querySelector('.modal_bg_edit').style.display = 'flex';
});

document.querySelector('.btn_c2').addEventListener('click', function(){
    document.querySelector('.modal_bg_edit').style.display = 'none';
});

document.getElementById('create_new').addEventListener('click', function() {
    document.querySelector('.modal-bg').style.display = 'flex';
});

document.querySelector('.btn_cancel').addEventListener('click', function(){
    document.querySelector('.modal-bg').style.display = 'none';
});

// FOR DELETE
document.getElementById('btn_del').addEventListener('click', function() {
    document.querySelector('.mod_confirm').style.display = 'flex';
});

document.getElementById('btn_cancel2').addEventListener('click', function(){
    document.querySelector('.mod_confirm').style.display = 'none';
});