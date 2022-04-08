/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";
function getServerTime() {
    return $.ajax({async: false}).getResponseHeader( 'Date' );
  }

function display_c(){
    var refresh=1000; // Refresh rate in milli seconds
    var mytime=setTimeout('display_ct()',refresh)
}
    
function display_ct() {
    var x = new Date()
    var x1=x.toLocaleString();// changing the display to UTC string
    $('#datetime').html(x1);
    var tt=display_c();
}
