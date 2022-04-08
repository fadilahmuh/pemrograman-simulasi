$(document).on("click", ".edit", function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var route = $(this).data("url");
    var tkn = $('input[name=_token').val();
    $.ajax({
      type: 'GET',
      url: route,
      data: {
          id: id,
      },
      dataType: "json",
      success: function(response) {
        $('#EditKontak').html(response.modal);
        $('#EditKontak').modal('show');
      },
      error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  });
  
  $('.del').click(function(event) {
        var form =  $(this).closest("form");
        var judul = $(this).data("judul");
        var ket = $(this).data("ket");
        event.preventDefault();
        swal({
            title: `Hapus kontak ${judul} ${ket}? `,
            text: "Jika Kontak ini dihapus maka tidak dapat dikembalikan lagi.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
          }
        });
    });