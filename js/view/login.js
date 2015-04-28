/**
 * Description:
 *
 * @module
 */
document.onkeydown=function(){if(event.altKey||event.ctrlKey||event.shiftKey){switch(event.keyCode){case 27:case 65:case 70:case 75:case 78:case 79:case 80:case 81:case 84:case 87:case 116:event.keyCode=0;event.returnValue=false;event.cancelBubble=true;return false;break}}};document.oncontextmenu=function(){return false};