$(document).ready(function () {

    // Применять плагин jquery.datatables к таблицам
    var tableItems = $('#table_items').DataTable({
        language: { url: "/js/dataTables.ru.json" }
    });

    var orderDefault = $(tableItems.table().header()).find('tr .order-default').index();
    var orderDirection = $(tableItems.table().header()).find('tr .order-direction-desc').get(0) ? 'desc' : 'asc';

    if(orderDefault > -1) tableItems.order([orderDefault, orderDirection]);

    // Применять плагин к полям типа datetime
    if ($('.input-datetime').length) $('.input-datetime').datetimepicker({
        locale: "ru",
        format: "YYYY-MM-DD HH:mm:ss"
    });

    // Применять плагин flora editor к html полям
    if ($('.input-html').length) $('.input-html').summernote({
        lang: 'ru-RU',
        height: 250,
        codemirror: {theme: 'monokai'}
    });

});