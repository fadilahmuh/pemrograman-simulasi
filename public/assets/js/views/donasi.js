$(document).on("click", ".bayar", function (e) {
    e.preventDefault();
    const clientInfo = $("#form-wakaf").serialize();
    const searchParams = new URLSearchParams(clientInfo);
    data = Object.fromEntries(searchParams);
    var route = $(this).data("url");
    $.ajax({
        type: "GET",
        url: route,
        data: {
            data,
        },
        dataType: "json",
        success: function (response) {
            snap.pay(response.token),{
                onSuccess: function(result){
                    alert('simpan data')
                },
                // Optional
                onPending: function(result){
                    /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                // Optional
                onError: function(result){
                    alert('transaksi gagal')
                }
            }            
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(
                xhr.status + "\n" + xhr.responseText + "\n" + thrownError
            );
        },
    });
});
