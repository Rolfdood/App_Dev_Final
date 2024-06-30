document.getElementById('create_new').addEventListener('click', function() {
    document.querySelector('.modal-bg').style.display = 'flex';
});

document.querySelector('.btn_cancel').addEventListener('click', function(){
    document.querySelector('.modal-bg').style.display = 'none';
});