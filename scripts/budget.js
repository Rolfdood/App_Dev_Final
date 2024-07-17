// FOR DELETE
document.getElementById('btn_del').addEventListener('click', function() {
    document.querySelector('.mod_confirm').style.display = 'flex';
});

document.getElementById('btn_cancel2').addEventListener('click', function(){
    document.querySelector('.mod_confirm').style.display = 'none';
});