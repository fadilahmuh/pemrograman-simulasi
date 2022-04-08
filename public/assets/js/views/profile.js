$('.save').click(function(event) {
    var form =  $(this).closest("form");
    var bagian = $(this).data("bagian");
    event.preventDefault();
    swal({
        title: `Simpan hasil edit ${bagian} ?`,          
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

$(document).on("click", ".edit", function(e) {
    e.preventDefault();
    var form = $(this).parent().parent().parent();
    form.find('.summernote-simple').summernote('enable');
    form.find('.save').collapse('show');
    form.find('.cancel').collapse('show');
    form.find('.edit').collapse('hide');
  });

  $(document).on("click", ".cancel", function(e) {
    e.preventDefault();
    var form = $(this).parent().parent().parent();
    form.find('.summernote-simple').summernote('disable');
    form.find('.save').collapse('hide');
    form.find('.cancel').collapse('hide');
    form.find('.edit').collapse('show');
  });