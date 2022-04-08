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
    var form = $(this).parent().parent().parent();
    form.find('input[name=judul]').removeAttr('disabled');
    form.find('textarea[name=content]').removeAttr('disabled');
    form.find('input[name=attachment]').removeAttr('disabled');
    form.find('.dropify-wrapper').removeClass('disabled');
    form.find('.cancel').collapse('show');
    form.find('.save').collapse('show');
    $(this).collapse('hide')
    form.find('.del').collapse('hide');
  });

  $(document).on("click", ".cancel", function(e) {
    e.preventDefault();
    var form = $(this).parent().parent().parent();
    form.find('input[name=judul]').prop('disabled', true);
    form.find('textarea[name=content]').prop('disabled', true);
    form.find('input[name=attachment]').prop('disabled', true);
    form.find('.dropify-wrapper').addClass('disabled');
    $(this).collapse('hide')
    form.find('.save').collapse('hide');
    form.find('.edit').collapse('show');
    form.find('.del').collapse('show');
  });

  $('.del').click(function(event) {
      var form =  $(this).closest("form");
      event.preventDefault();
      swal({
          title: `Hapus brosur ?`,
          text: "Jika brosur ini dihapus maka tidak dapat dikembalikan lagi.",
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