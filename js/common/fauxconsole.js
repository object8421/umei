/* Faux Console by Chris Heilmann http://wait-till-i.com */

var old_console = window.console;

var f = function(){};
window.console = {
	log:f,info:f,warn:f,debug:f,error:f
};
	
var console_disable = true;

if (console_disable){
	
}
else{
	if (!window.console || true) {
		
	}
}

function open_window_console()
{
	if (old_console){
		window.console = old_console;
	}
}

function open_my_console()
{
	var console = {
		init: function() {
			console.d = document.createElement('div');
			document.body.appendChild(console.d);
			var a = document.createElement('a');
			a.href = 'javascript:console.hide()';
			a.innerHTML = 'close';
			console.d.appendChild(a);
			var a = document.createElement('a');
			a.href = 'javascript:console.clear();';
			a.innerHTML = 'clear';
			console.d.appendChild(a);
			var id = 'fauxconsole';
			if (!document.getElementById(id)) {
				console.d.id = id;
			}
			console.hide();
		},
		hide: function() {
			console.d.style.display = 'none';
		},
		show: function() {
			console.d.style.display = 'block';
		},
		log: function(o) {
			console.d.innerHTML += '<br/>' + o;
			console.show();
		},
		clear: function() {
			console.d.parentNode.removeChild(console.d);
			console.init();
			console.show();
		},
		/*Simon Willison rules*/ addLoadEvent: function(func) {
			var oldonload = window.onload;
			if (typeof window.onload != 'function') {
				window.onload = func;
			} else {
				window.onload = function() {
					if (oldonload) {
						oldonload();
					}
					func();
				}
			};
		}
	};
	//console.addLoadEvent(console.init);
	$(document).ready(function() {
		console.init();
		window.console = console;
	});
}