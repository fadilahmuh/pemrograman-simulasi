$('.del').click(function(event) {
    var form =  $(this).closest("form");
    // console.log(form);
    var judul = $(this).data("judul");
    event.preventDefault();
    swal({
        title: `Hapus postingan "${judul}?"`,
        text: "Jika postingan ini dihapus maka tidak dapat dikembalikan lagi.",
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

$('.del2').click(function(event) {
    var form =  $(this).closest("form");
    var nama = $(this).data("nama");
    event.preventDefault();
    swal({
        title: `Hapus Tag "${nama}?"`,
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
