
$(document).ready(function(){
    $('.beginBtn').click(function(){
		var clickBtnValue = $('.usernameInput').val();
        var ajaxurl = 'ajax.php',
        data =  {'action': clickBtnValue};
        $.post(ajaxurl, data, function (response) {
            alert("action performed successfully");
        });
    });
});


