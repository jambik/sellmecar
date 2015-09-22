$(document).ready(function() {

	// Применять плагин jquery.datatables к таблицам
	if ($('.table-items').length) $('.table-items').DataTable({
        "language": { "url": "/js/datatables.ru.json" }
	});

});