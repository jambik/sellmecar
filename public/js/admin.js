$(document).ready(function () {

    // Применять плагин tablesorter к таблицам
    $.tablesorter.themes.bootstrap = {
        // these classes are added to the table. To see other table classes available
        table        : 'table table-bordered table-striped',
        caption      : 'caption',
        // header class names
        header       : 'bootstrap-header', // give the header a gradient background (theme.bootstrap_2.css)
        sortNone     : '',
        sortAsc      : '',
        sortDesc     : '',
        active       : '', // applied when column is sorted
        hover        : '', // custom css required - a defined bootstrap style may not override other classes
        // icon class names
        icons        : '', // add "icon-white" to make them white; this icon class is added to the <i> in the header
        iconSortNone : 'bootstrap-icon-unsorted', // class name added to icon when column is not sorted
        iconSortAsc  : 'glyphicon glyphicon-chevron-up', // class name added to icon when column has ascending sort
        iconSortDesc : 'glyphicon glyphicon-chevron-down', // class name added to icon when column has descending sort
        filterRow    : '', // filter row class; use widgetOptions.filter_cssFilter for the input/select element
        footerRow    : '',
        footerCells  : '',
        even         : '', // even row zebra striping
        odd          : ''  // odd row zebra striping
    };

    $('#table_items').tablesorter({
        theme          : "bootstrap",
        sortReset      : true,
        sortRestart    : true,
        widthFixed     : true,
        headerTemplate : '{content} {icon}',
        widgets        : [ "uitheme", "filter", "pager", "zebra", "stickyHeaders" ],
        widgetOptions: {
            // filter
            filter_cssFilter   : 'form-control input-sm',
            filter_searchDelay : 0,

            // zebra
            zebra : ["even", "odd"]
        }
    }).tablesorterPager({
        container: $(".pager"),
        output: '{startRow} - {endRow} / {filteredRows} ({totalRows})'
    });

    $('.tablesorter-childRow td').hide();
    $('#table_items').delegate('.toggle', 'click' ,function(){
        $(this).closest('tr').nextUntil('tr:not(.tablesorter-childRow)').find('td').toggle();
        return false;
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