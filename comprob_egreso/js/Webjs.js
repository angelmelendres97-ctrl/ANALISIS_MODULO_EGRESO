$(function() {
    $("#search").autocomplete({
        source: "search.php",
        minLength: 2,
        select: function(event, ui) {
			event.preventDefault();
            $('#codigo').val(ui.item.search);
	     }
    });
});

shortcut.add("Ctrl+G", function() {
    guardar_facturacion();
});