$.uploadPreview({
    input_field: "#image-upload",   // Default: .image-upload
    preview_box: "#image-preview",  // Default: .image-preview
    label_field: "#image-label",    // Default: .image-label
    label_default: "Pilih File",   // Default: Choose File
    label_selected: "Ganti File",  // Default: Change File
    no_label: false,                // Default: false
    success_callback: null          // Default: null
    });
  
    $(document).on("click", ".edit", function(e) {
      e.preventDefault();
      var inputs = $(this).parent().parent().parent().find(":input:not(:button)");
      console.log(inputs);
      inputs.removeAttr('disabled');
      $('#sambutan').summernote('enable');
    });
  
    $(document).on("click", ".cancel", function(e) {
      e.preventDefault();
      var inputs = $(this).parent().parent().parent().find(":input:not(:button)");
      console.log(inputs);
      inputs.prop('disabled', true);
      $('#sambutan').summernote('disable');
    });
  
    $('.save').click(function(event) {
        var form =  $(this).closest("form");
        event.preventDefault();
        swal({
            title: `Simpan hasil edit sambutan ?`,          
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