var RedirectURL = "http://shamar.org";
var Value = 'bypass page next time';
var DaysToLive = "365";
var CookieName = "HasVisited";
var DaysToLive = parseInt(DaysToLive);

function GetCookie() {
var cookiecontent = '';
if(document.cookie.length > 0) {
   var cookiename = CookieName + '=';
   var cookiebegin = document.cookie.indexOf(cookiename);
   var cookieend = 0;
   if(cookiebegin > -1) {
      cookiebegin += cookiename.length;
      cookieend = document.cookie.indexOf(";",cookiebegin);
      if(cookieend < cookiebegin) { cookieend = document.cookie.length; }
      cookiecontent = document.cookie.substring(cookiebegin,cookieend);
      }
   }
if(cookiecontent.length > 0) { return true; }
return false;
}

function SetCookie() {
var exp = '';
if(DaysToLive > 0) {
   var now = new Date();
   then = now.getTime() + (DaysToLive * 24 * 60 * 60 * 1000);
   now.setTime(then);
   exp = '; expires=' + now.toGMTString();
   }
document.cookie = CookieName + '=' + Value + exp;
return true;
}

function getCookie( name ) {
  var start = document.cookie.indexOf( name + "=" );
  var len = start + name.length + 1;
  if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) ) {
    return null;
  }
  if ( start == -1 ) return null;
  var end = document.cookie.indexOf( ";", len );
  if ( end == -1 ) end = document.cookie.length;
  return unescape( document.cookie.substring( len, end ) );
}

function setCookie( name, value, expires, path, domain, secure ) {
  var today = new Date();
  today.setTime( today.getTime() );
  if ( expires ) {
    expires = expires * 1000 * 60 * 60 * 24;
  } 
  var expires_date = new Date( today.getTime() + (expires) );
  document.cookie = name+"="+escape( value ) +
    ( ( expires ) ? ";expires="+expires_date.toGMTString() : "" ) + //expires.toGMTString()
    ( ( path ) ? ";path=" + path : "" ) +
    ( ( domain ) ? ";domain=" + domain : "" ) +
    ( ( secure ) ? ";secure" : "" );
}

function deleteCookie( name, path, domain ) {
  if ( getCookie( name ) ) document.cookie = name + "=" +
    ( ( path ) ? ";path=" + path : "") +
    ( ( domain ) ? ";domain=" + domain : "" ) +
    ";expires=Thu, 01-Jan-1970 00:00:01 GMT";
}

function Action() {
location.href = RedirectURL;
}






/* This script and many more are available free online at
The JavaScript Source!! http://javascript.internet.com
Created by: William Bontrager | http://www.bontragerconnection.com/ */
// Copyright 2006 Bontrager Connection, LLC
// This version of the script redirects automatically.
// The Web site has a few other methods for directing also:
// http://www.bontragerconnection.com/library/redirect_with_a_cookie.shtml

// Three items can be customized (values between quotation marks):
//
// 1. What URL shall the browser be redirected 
//    to if a cookie was previously set?



// 2. How many days shall the cookie live in 
//    the visitor's browser (0 means remove 
//    cookie whenever browser closes)?


// 3. What name shall the cookie have (any 
//    sequence of alphabetical characters 
//    is okay, so long as the name doesn't 
//    conflict with any other cookies that 
//    this web page might be setting.)?


// No other customization is required.
