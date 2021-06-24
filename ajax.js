$(function(){
  $('input[type=submit]').on('click', function(e){
    e.preventDefault();
    var json = {
      name: $('input[name=name]').val() + $('input[name=secondName]'),
      email: $('input[name=email]'),
      phone:$('input[name=phoneNumber]'),
      type: $('input[name=message]')
    }
    $.ajax({
      url: 'ajax_answer.php',
      method: 'POST',
      data: 'json' + JSON.stringify(json)
    })
    .done(function(msg){
        alert("Спасибо за заказ, ваше письмо отправлено!");
    });
  });
});
