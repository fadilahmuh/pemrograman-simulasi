$('.dropify').dropify({
  messages: {
      'default': 'Tarik dan lepaskan file atau klik disini',
      'replace': 'Tarik dan lepaskan file atau klik disini untuk mengganti',
      'remove':  'Remove',
      'error':   'Ooops, kesalahan terjadi.'
  }
}); 

$(document).on("click", ".edit", function(e) {
  e.preventDefault();
  var inputs = $(this).parent().parent().parent().find(":input:not(:button)");
  var drop = $(this).parent().parent().parent().find(".dropify-wrapper");
  console.log(inputs);
  inputs.removeAttr('disabled');
  drop.removeClass('disabled');
  $('#desc').summernote('enable');
});

$(document).on("click", ".cancel", function(e) {
  e.preventDefault();
  var inputs = $(this).parent().parent().parent().find(":input:not(:button)");
  var drop = $(this).parent().parent().parent().find(".dropify-wrapper");
  console.log(inputs);
  inputs.prop('disabled', true);
  drop.addClass('disabled');
  $('#desc').summernote('disable');
});

$('.save').click(function(event) {
    var form =  $(this).closest("form");
    event.preventDefault();
    swal({
        title: `Simpan hasil edit deskripsi ?`,          
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