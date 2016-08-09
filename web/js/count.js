/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

setTimeout(function () {

// Hilang sidebar
    $('body').removeClass('nav-md').addClass('nav-sm');
    $('.left_col').removeClass('scroll-view').removeAttr('style');
    $('.sidebar-footer').hide();

    if ($('#sidebar-menu li').hasClass('active')) {
        $('#sidebar-menu li.active').addClass('active-sm').removeClass('active');
    }
//End hilang

}, 2000);
