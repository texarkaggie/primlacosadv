/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    //get the click for the contact button
    $('#modalButton').click(function(){
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));
    });
});

$(window).load(function() { 
    //if ($('html').hasClass('desktop')) {
        $('#stuck_container').TMStickUp({
        });
    //}  
  });
  
new WOW().init();