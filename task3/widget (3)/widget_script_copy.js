// window.myWidget.init.push(function (self) { // Прячем кнопку "Обратиться за поддержкой", а вместо нее показываем наш логотип
//     $('.project_info-body-support a').remove();
//     $('.project_info-body-support').append($("Доработки и внедрение от"));
//     return true;
// });

window.myWidget.init.push(function (self) { // Прячем кнопку "Обратиться за поддержкой", а вместо нее показываем наш логотип
    var status_id=9585810;
    var colonka = $('.pipeline_cell-'+status_id);

    var color = $('.pipeline_cell-head-'+9585810).find('.pipeline_status__head_line').css('color');

    var fourth = colonka.find('.pipeline_leads__item:eq(4)');

    fourth.find(".pipeline_leads__item_title").css("color", color);

    // var classList = document.getElementById('divId').className.split(/\s+/);
    // for (var i = 0; i < classList.length; i++) {
    //     if (classList[i] === 'someClass') {
    //         //do something
    //     }
    // }

    return true;
});

