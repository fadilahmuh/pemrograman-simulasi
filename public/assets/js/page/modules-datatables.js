"use strict";

$("[data-checkboxes]").each(function () {
    var me = $(this),
        group = me.data("checkboxes"),
        role = me.data("checkbox-role");

    me.change(function () {
        var all = $(
                '[data-checkboxes="' +
                    group +
                    '"]:not([data-checkbox-role="dad"])'
            ),
            checked = $(
                '[data-checkboxes="' +
                    group +
                    '"]:not([data-checkbox-role="dad"]):checked'
            ),
            dad = $(
                '[data-checkboxes="' + group + '"][data-checkbox-role="dad"]'
            ),
            total = all.length,
            checked_length = checked.length;

        if (role == "dad") {
            if (me.is(":checked")) {
                all.prop("checked", true);
            } else {
                all.prop("checked", false);
            }
        } else {
            if (checked_length >= total) {
                dad.prop("checked", true);
            } else {
                dad.prop("checked", false);
            }
        }
    });
});

$("#table-1").dataTable({
    language: {
        searchPanes: {
            emptyPanes: "There are no panes to display. :/",
        },
    },
});
$("#table-2").dataTable({
    columnDefs: [{ sortable: false, targets: [0, 2, 3] }],
});

$("#table-blog").dataTable({
    language: {
        searchPanes: {
            emptyPanes: "There are no panes to display. :/",
        },
    },
    "columnDefs": [
        { "width": "25%", "targets": 0 }
    ],
    "order": [[ 3, "desc" ]]
});

$("#table-file").dataTable({
    language: {
        searchPanes: {
            emptyPanes: "There are no panes to display. :/",
        },
    },
    "order": [[ 1, "desc" ]]
});

var table = $('.table').DataTable();
$(document).on("click", ".badge", function(e) {
    e.preventDefault();
    var search = $(this).text();
    table.search(search).draw();  
});

$("#table-galeri").dataTable({
    language: {
        searchPanes: {
            emptyPanes: "There are no panes to display. :/",
        },
    },
});