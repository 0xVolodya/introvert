window.myWidget.init.push(function (self) { // Прячем кнопку "Обратиться за поддержкой", а вместо нее показываем наш логотип
    var status_id=9585810;
    var colonka = $('.pipeline_cell-'+status_id);

    var color = $('.pipeline_cell-head-'+9585810).find('.pipeline_status__head_line').css('color');

    var fourth = colonka.find('.pipeline_leads__item:eq(4)');

    fourth.find(".pipeline_leads__item_title").css("color", color);



    return true;
});

