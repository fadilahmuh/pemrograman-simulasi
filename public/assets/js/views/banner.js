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
    var form = $(this).parent().parent().parent().find('form');
    form.find('input[name=judul]').removeAttr('disabled');
    form.find('textarea[name=content]').removeAttr('disabled');
    form.find('input[name=attachment]').removeAttr('disabled');
    form.find('.dropify-wrapper').removeClass('disabled');
    $(this).parent().find('.save').collapse('show');
    $(this).parent().find('.cancel').collapse('show');
    $(this).parent().find('.edit').collapse('hide');
    $(this).parent().find('.del').collapse('hide');
  });

  $(document).on("click", ".cancel", function(e) {
    e.preventDefault();
    var form = $(this).parent().parent().parent().find('form');
    form.find('input[name=judul]').prop('disabled', true);
    form.find('textarea[name=content]').prop('disabled', true);
    form.find('input[name=attachment]').prop('disabled', true);
    form.find('.dropify-wrapper').addClass('disabled');
    $(this).parent().find('.save').collapse('hide');
    $(this).parent().find('.cancel').collapse('hide');
    $(this).parent().find('.edit').collapse('show');
    $(this).parent().find('.del').collapse('show');
  });

  $('.del').click(function(event) {
      var form =  $(this).closest("form");
      event.preventDefault();
      swal({
          title: `Hapus banner ?`,
          text: "Jika banner ini dihapus maka tidak dapat dikembalikan lagi.",
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