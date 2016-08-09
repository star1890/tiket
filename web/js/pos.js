/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var peringatan =    '<div role="alert" class="alert alert-danger alert-dismissible fade in">'+
                    '<button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>'+
                    '</button>'+
                    '<strong>{pesan}</strong>'+
                    '</div>';


$('body').removeClass('nav-md').addClass('nav-sm');
$('.left_col').removeClass('scroll-view').removeAttr('style');
$('.sidebar-footer').hide();

if ($('#sidebar-menu li').hasClass('active')) {
    $('#sidebar-menu li.active').addClass('active-sm').removeClass('active');
}

$('#modal-button').hide();
$('#modal-content').hide();

var wh = $(window).height(), total_dh = $('#totaldiv').height(), buttons_dh = $('#botbuttons').height();
var items_dh = wh - 190, list_table_dh = wh - 210 - total_dh - buttons_dh;

$('#list-table-div').perfectScrollbar({suppressScrollX: true});

$('#list-table-div').height(list_table_dh);
$('.items').height(410);
$('#list-table-div').perfectScrollbar('update');

$(document).on('click', '.posdel', function () {
   var row = $(this).closest('tr');
   row.remove();
   var total = 0;
    $('.list-table .harga').each(function(){
        total = parseInt(total) + parseInt($(this).attr('data-subtotal'));
    });
    $('.total_pembayaran').html(accounting.formatNumber(total));
    $('#dynamicmodel-total_pembelian').val(total);
    
    if (total == 0)
    {
        $('#modal-button').hide();
        $('#modal-content').hide();
        $('#modal-warning').show();
    }
});

$('#batal').on('click', function() {
    $('#posTable tr').not(function(){if ($(this).has('th').length){return true}}).remove();
    $('.total_pembayaran').html(accounting.formatNumber(0));
    $('#modal-button').hide();
    $('#modal-content').hide();
    $('#modal-warning').show();
});

//$('.pilih-item').on('click', function() {
//    if($('#dynamicmodel-'+$(this).attr('data-id')+'-jumlah').length > 0)
//    {
//        var jumlah = parseInt($('#dynamicmodel-'+$(this).attr('data-id')+'-jumlah').val()) + 1;
//        var subtotal = jumlah * parseInt($(this).attr('data-harga'));
//        
//        $('#dynamicmodel-'+$(this).attr('data-id')+'-jumlah').val(jumlah);
//        $('#subtotal_'+$(this).attr('data-id')).html(accounting.formatNumber(subtotal));
//        $('#subtotal_'+$(this).attr('data-id')).attr('data-subtotal', subtotal);
//    } else
//    {
//        var html = '<tr class="18 danger">'+
//            '<td>'+$(this).attr('data-tiket')+'</br>'+$(this).attr('data-wisata')+'</br>'+$(this).attr('data-perorangan')+'</td>'+
//            '<td class="text-right text-middle">'+accounting.formatNumber($(this).attr('data-harga'))+'</td>'+
//            '<td class="text-middle"><input id="dynamicmodel-'+$(this).attr('data-id')+'-jumlah" class="form-control input-qty text-center" type="text" value="1" autocomplete="off" name="DynamicModel['+$(this).attr('data-id')+'][jumlah]"></td>'+
//            '<td class="text-right text-middle"><span id="subtotal_'+$(this).attr('data-id')+'" class="harga" data-subtotal="'+$(this).attr('data-harga')+'">'+accounting.formatNumber($(this).attr('data-harga'))+'</span></td>'+
//            '<td class="text-center text-middle"><i id="1461811399595" class="fa fa-trash-o tip pointer posdel" title="Remove"></i></td>'+
//            '</tr>';
//        $('#posTable').append(html);
//    }
//    var total = 0;
//    $('.list-table .harga').each(function(){
//        total = parseInt(total) + parseInt($(this).attr('data-subtotal'));
//    });
//    $('.total_pembayaran').html(accounting.formatNumber(total));
//    $('#dynamicmodel-total_pembelian').val(total);
//    
//});

function aksi(ini)
{
    
    if($('#dynamicmodel-'+$(ini).data('id')+'-jumlah').length > 0)
    {
        var jumlah = parseInt($('#dynamicmodel-'+$(ini).data('id')+'-jumlah').val()) + 1;
        var subtotal = jumlah * parseInt($(ini).data('harga'));
        
        $('#dynamicmodel-'+$(ini).data('id')+'-jumlah').val(jumlah);
        $('#subtotal_'+$(ini).data('id')).html(accounting.formatNumber(subtotal));
        $('#subtotal_'+$(ini).data('id')).attr('data-subtotal', subtotal);
    } else
    {
        var html = '<tr class="18 danger">'+
            '<td>'+$(ini).data('tiket')+'</br>'+$(ini).data('wisata')+'</br>'+$(ini).data('perorangan')+'</td>'+
            '<td class="text-right text-middle">'+accounting.formatNumber($(ini).data('harga'))+'</td>'+
            '<td class="text-middle"><input id="dynamicmodel-'+$(ini).data('id')+'-jumlah" class="form-control input-qty text-center" type="text" value="1" autocomplete="off" name="DynamicModel['+$(ini).data('id')+'][jumlah]"></td>'+
            '<td class="text-right text-middle"><span id="subtotal_'+$(ini).data('id')+'" class="harga" data-subtotal="'+$(ini).data('harga')+'">'+accounting.formatNumber($(ini).data('harga'))+'</span></td>'+
            '<td class="text-center text-middle"><i id="1461811399595" class="fa fa-trash-o tip pointer posdel" title="Remove"></i></td>'+
            '</tr>';
        $('#posTable').append(html);
    }
    var total = 0;
    $('.list-table .harga').each(function(){
        total = parseInt(total) + parseInt($(this).attr('data-subtotal'));
    });
    $('.total_pembayaran').html(accounting.formatNumber(total));
    $('#dynamicmodel-total_pembelian').val(total);
    
    $('#modal-button').show();
    $('#modal-content').show();
    $('#modal-warning').hide();
}

$("#form-penjualan").submit(function(){
    $('#peringatan').empty();
    var pesan = peringatan.replace('{pesan}','Uang dibayar harus lebih besar dari Total Pembelian ');
    
    var pembayaran = accounting.unformat($('#dynamicmodel-uang_dibayar').val());
    var total = $('#dynamicmodel-total_pembelian').val();
    
    if (pembayaran == '' || pembayaran == 0 || pembayaran < total)
    {
        $('#peringatan').append(pesan);
        return false;
    } else
    {
        return true;
    }
});

$("#dynamicmodel-uang_dibayar").keyup(function(){
    $('#peringatan').empty();
    var pembayaran = accounting.unformat(this.value);
    var total = $('#dynamicmodel-total_pembelian').val();
    
    $('#dynamicmodel-kembalian').val(accounting.formatNumber(pembayaran-total));
});

$('#pembayaran').on('hide.bs.modal', function (e) {
    $('#dynamicmodel-kembalian').val('');
    $("#dynamicmodel-uang_dibayar").val('');
});