$(document).ready(function () {

    // Применять плагин jquery.datatables к таблицам
    var tableItems = $('#table_items').DataTable({
        language: { url: "/js/dataTables.ru.json" }
    });
    // Сортировка таблиц
    var orderDefault = $(tableItems.table().header()).find('tr .order-default').index();
    var orderDirection = $(tableItems.table().header()).find('tr .order-direction-desc').get(0) ? 'desc' : 'asc';
    if(orderDefault > -1) tableItems.order([orderDefault, orderDirection]);

    // Применять плагин tablesorter к таблицам
    $.tablesorter.themes.bootstrap = {
        table        : 'table table-striped',
        caption      : 'caption',
        header       : 'bootstrap-header',
        iconSortNone : 'bootstrap-icon-unsorted',
        iconSortAsc  : 'glyphicon glyphicon-chevron-up',
        iconSortDesc : 'glyphicon glyphicon-chevron-down',
    };

    $('#table_items2').tablesorter({
        /*debug          : true,*/
        theme          : "bootstrap",
        sortReset      : true,
        sortRestart    : true,
        widthFixed     : true,
        headerTemplate : '{content} {icon}',
        widgets        : [ "uitheme", "filter", "pager", "stickyHeaders" ],
        widgetOptions: {
            // pager
            pager_output     : '{startRow} - {endRow} / {filteredRows} ({totalRows})',
            pager_removeRows : false,

            // filter
            filter_cssFilter   : 'form-control input-sm',
            filter_searchDelay : 0
        }
    });

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