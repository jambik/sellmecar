$(document).ready(function () {

    // Применять плагин jquery.datatables к таблицам
    if ($('.table-items').length) $('.table-items').DataTable({
        //"language": { "url": "/js/datatables.ru.json" }
    });

    // Применять плагин  к полям типа datetime
    if ($('.input-datetime').length) $('.input-datetime').datetimepicker({
        locale: "ru",
        format: "YYYY-MM-DD HH:mm:ss"
    });

});