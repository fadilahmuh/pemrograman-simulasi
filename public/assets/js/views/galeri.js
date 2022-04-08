$(".dropify").dropify({
    messages: {
        default: "Tarik dan lepaskan file atau klik disini",
        replace: "Tarik dan lepaskan file atau klik disini untuk mengganti",
        remove: "Remove",
        error: "Ooops, kesalahan terjadi.",
    },
});

$("input[type='number']").inputSpinner();
$(".btn-increment").prop("disabled", true);
$(".btn-decrement").prop("disabled", true);

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
            $("#EditGaleri").html(response.modal);
            $("#EditGaleri").modal("show");
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
        title: `Hapus Foto yang dipilih?`,
        text: "Jika Foto ini dihapus maka tidak dapat dikembalikan lagi.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});

$(document).on("click", ".edit2", function (e) {
    e.preventDefault();
    var form = $(this).parent().parent().parent();
    form.find("input[type=text]").prop("disabled", false);
    form.find(".save").collapse("show");
    form.find(".cancel").collapse("show");
    form.find(".edit2").collapse("hide");
    form.find(".btn-increment").prop("disabled", false);
    form.find(".btn-decrement").prop("disabled", false);
});

$(document).on("click", ".cancel", function (e) {
    e.preventDefault();
    var form = $(this).parent().parent().parent();
    form.find("input[type=text]").prop("disabled", true);
    form.find(".save").collapse("hide");
    form.find(".cancel").collapse("hide");
    form.find(".edit2").collapse("show");
    form.find(".btn-increment").prop("disabled", true);
    form.find(".btn-decrement").prop("disabled", true);
});

$(".save").click(function (event) {
    var form = $(this).closest("form");
    var bagian = $(this).data("bagian");
    event.preventDefault();
    swal({
        title: `Simpan hasil edit ${bagian} ?`,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
    });
});
