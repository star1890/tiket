/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// Hilang sidebar
$('body').removeClass('nav-md').addClass('nav-sm');
$('.left_col').removeClass('scroll-view').removeAttr('style');
$('.sidebar-footer').hide();

if ($('#sidebar-menu li').hasClass('active')) {
    $('#sidebar-menu li.active').addClass('active-sm').removeClass('active');
}
//End hilang

$(".tiket").change(function () {
    $.ajax({
        url: $(this).attr('data-url'),
        data: {
            tiket: this.value.toUpperCase(),
            workstation: $(this).attr('data-workstation'),
            wisata: $(this).attr('data-wisata'),
        },
        method: 'POST',
        beforeSend: function () {
            $("#info").empty();
        },
        success: function (result) {
            $(".tiket").val('');
            $("#info").html(result);
            console.log(result);
        },
        error: function () {
            $(".tiket").val('');
            alert('Reload ulang halaman ini');
            location.reload();
        },
    });

//    setTimeout(function () {
//        $(".alert").alert('close');
//    }, 10000);
});

