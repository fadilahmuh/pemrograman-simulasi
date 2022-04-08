$(".dropify").dropify({
    messages: {
        default: "Tarik dan lepaskan file atau klik disini",
        replace: "Tarik dan lepaskan file atau klik disini untuk mengganti",
        remove: "Remove",
        error: "Ooops, kesalahan terjadi.",
    },
    error: {
        fileSize: "Ukuran file terlalu besar ({{ value }} max).",
        fileExtension: "Format file tidak didukung (Hanya {{ value }} ).",
    },
});

$(document).on("click", ".edit", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    var route = $(this).data("url");
    $.ajax({
        type: "GET",
        url: route,
        data: {
            id: id,
        },
        dataType: "json",
        success: function (response) {
          // console.log(response.modal);
            $("#EditFile").html(response.modal);
            $("#EditFile").modal("show");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(
                xhr.status + "\n" + xhr.responseText + "\n" + thrownError
            );
        },
    });
});

$(".del").click(function (event) {
    var form = $(this).closest("form");
    event.preventDefault();
    swal({
        title: `Hapus File yang dipilih?`,
        text: "Jika File ini dihapus maka tidak dapat dikembalikan lagi.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});
