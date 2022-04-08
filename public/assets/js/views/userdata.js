
$(document).on("click", ".edit", function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var route = $(this).data("url");
    var tkn = $('input[name=_token').val();
    // alert(route + '\n' + id);
    $.ajax({
      type: 'GET',
      url: route,
      data: {
          id: id,
      },
      dataType: "json",
      success: function(response) {
        $('#editUser').html(response.modal);
        $('#editUser').modal('show');
        // console.log(response);
      },
      error: function(xhr, ajaxOptions, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
    });
  });

$('.del').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `Hapus ${name}?`,
        text: "Jika Admin ini dihapus maka tidak dapat dikembalikan lagi.",
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