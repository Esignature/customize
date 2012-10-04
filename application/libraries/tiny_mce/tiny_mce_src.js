var tinymce = {
	majorVersion : '3',
	minorVersion : '2.3.1',
	releaseDate : '2009-05-05',

	_init : function() {
		var t = this, d = document, w = window, na = navigator, ua = na.userAgent, i, nl, n, base, p, v;

		// Browser checks
		t.isOpera = w.opera && opera.buildNumber;
		t.isWebKit = /WebKit/.test(ua);
		t.isIE = !t.isWebKit && !t.isOpera && (/MSIE/gi).test(ua) && (/Explorer/gi).test(na.appName);
		t.isIE6 = t.isIE && /MSIE [56]/.test(ua);
		t.isGecko = !t.isWebKit && /Gecko/.test(ua);
		t.isMac = ua.indexOf('Mac') != -1;
		t.isAir = /adobeair/i.test(ua);

		// TinyMCE .NET webcontrol might be setting the values for TinyMCE
		if (w.tinyMCEPreInit) {
			t.suffix = tinyMCEPreInit.suffix;
			t.baseURL = tinyMCEPreInit.base;
			t.query = tinyMCEPreInit.query;
			return;
		}

		// Get suffix and base
		t.suffix = '';

		// If base element found, add that infront of baseURL
		nl = d.getElementsByTagName('base');
		for (i=0; i<nl.length; i++) {
			if (v = nl[i].href) {
				// Host only value like http://site.com or http://site.com:8008
				if (/^https?:\/\/[^\/]+$/.test(v))
					v += '/';

				base = v ? v.match(/.*\//)[0] : ''; // Get only directory
			}
		}

		function getBase(n) {
			if (n.src && /tiny_mce(|_dev|_src|_gzip|_jquery|_prototype).js/.test(n.src)) {
				if (/_(src|dev)\.js/g.test(n.src))
					t.suffix = '_src';

				if ((p = n.src.indexOf('?')) != -1)
					t.query = n.src.substring(p + 1);

				t.baseURL = n.src.substring(0, n.src.lastIndexOf('/'));

				// If path to script is relative and a base href was found add that one infront
				if (base && t.baseURL.indexOf('://') == -1)
					t.baseURL = base + t.baseURL;

				return t.baseURL;
			}

			return null;
		};

		// Check document
		nl = d.getElementsByTagName('script');
		for (i=0; i<nl.length; i++) {
			if (getBase(nl[i]))
				return;
		}

		// Check head
		n = d.getElementsByTagName('head')[0];
		if (n) {
			nl = n.getElementsByTagName('script');
			for (i=0; i<nl.length; i++) {
				if (getBase(nl[i]))
					return;
			}
		}

		return;
	},

	is : function(o, t) {
		var n = typeof(o);

		if (!t)
			return n != 'undefined';

		if (t == 'array' && (o.hasOwnProperty && o instanceof Array))
			return true;

		return n == t;
	},


	each : function(o, cb, s) {
		var n, l;

		if (!o)
			return 0;

		s = s || o;

		if (typeof(o.length) != 'undefined') {
			// Indexed arrays, needed for Safari
			for (n=0, l = o.length; n<l; n++) {
				if (cb.call(s, o[n], n, o) === false)
					return 0;
			}
		} else {
			// Hashtables
			for (n in o) {
				if (o.hasOwnProperty(n)) {
					if (cb.call(s, o[n], n, o) === false)
						return 0;
				}
			}
		}

		return 1;
	},

	map : function(a, f) {
		var o = [];

		tinymce.each(a, function(v) {
			o.push(f(v));
		});

		return o;
	},

	grep : function(a, f) {
		var o = [];

		tinymce.each(a, function(v) {
			if (!f || f(v))
				o.push(v);
		});

		return o;
	},

	inArray : function(a, v) {
		var i, l;

		if (a) {
			for (i = 0, l = a.length; i < l; i++) {
				if (a[i] === v)
					return i;
			}
		}

		return -1;
	},

	extend : function(o, e) {
		var i, a = arguments;

		for (i=1; i<a.length; i++) {
			e = a[i];

			tinymce.each(e, function(v, n) {
				if (typeof(v) !== 'undefined')
					o[n] = v;
			});
		}

		return o;
	},

	trim : function(s) {
		return (s ? '' + s : '').replace(/^\s*|\s*$/g, '');
	},


	create : function(s, p) {
		var t = this, sp, ns, cn, scn, c, de = 0;

		// Parse : <prefix> <class>:<super class>
		s = /^((static) )?([\w.]+)(:([\w.]+))?/.exec(s);
		cn = s[3].match(/(^|\.)(\w+)$/i)[2]; // Class name

		// Create namespace for new class
		ns = t.createNS(s[3].replace(/\.\w+$/, ''));

		// Class already exists
		if (ns[cn])
			return;

		// Make pure static class
		if (s[2] == 'static') {
			ns[cn] = p;

			if (this.onCreate)
				this.onCreate(s[2], s[3], ns[cn]);

			return;
		}

		// Create default constructor
		if (!p[cn]) {
			p[cn] = function() {};
			de = 1;
		}

		// Add constructor and methods
		ns[cn] = p[cn];
		t.extend(ns[cn].prototype, p);

		// Extend
		if (s[5]) {
			sp = t.resolve(s[5]).prototype;
			scn = s[5].match(/\.(\w+)$/i)[1]; // Class name

			// Extend constructor
			c = ns[cn];
			if (de) {
				// Add passthrough constructor
				ns[cn] = function() {
					return sp[scn].apply(this, arguments);
				};
			} else {
				// Add inherit constructor
				ns[cn] = function() {
					this.parent = sp[scn];
					return c.apply(this, arguments);
				};
			}
			ns[cn].prototype[cn] = ns[cn];

			// Add super methods
			t.each(sp, function(f, n) {
				ns[cn].prototype[n] = sp[n];
			});

			// Add overridden methods
			t.each(p, function(f, n) {
				// Extend methods if needed
				if (sp[n]) {
					ns[cn].prototype[n] = function() {
						this.parent = sp[n];
						return f.apply(this, arguments);
					};
				} else {
					if (n != cn)
						ns[cn].prototype[n] = f;
				}
			});
		}

		// Add static methods
		t.each(p['static'], function(f, n) {
			ns[cn][n] = f;
		});

		if (this.onCreate)
			this.onCreate(s[2], s[3], ns[cn].prototype);
	},

	walk : function(o, f, n, s) {
		s = s || this;

		if (o) {
			if (n)
				o = o[n];

			tinymce.each(o, function(o, i) {
				if (f.call(s, o, i, n) === false)
					return false;

				tinymce.walk(o, f, n, s);
			});
		}
	},

	createNS : function(n, o) {
		var i, v;

		o = o || window;

		n = n.split('.');
		for (i=0; i<n.length; i++) {
			v = n[i];

			if (!o[v])
				o[v] = {};

			o = o[v];
		}

		return o;
	},

	resolve : function(n, o) {
		var i, l;

		o = o || window;

		n = n.split('.');
		for (i=0, l = n.length; i<l; i++) {
			o = o[n[i]];

			if (!o)
				break;
		}

		return o;
	},

	addUnload : function(f, s) {
		var t = this, w = window;

		f = {func : f, scope : s || this};

		if (!t.unloads) {
			function unload() {
				var li = t.unloads, o, n;

				if (li) {
					// Call unload handlers
					for (n in li) {
						o = li[n];

						if (o && o.func)
							o.func.call(o.scope, 1); // Send in one arg to distinct unload and user destroy
					}

					// Detach unload function
					if (w.detachEvent) {
						w.detachEvent('onbeforeunload', fakeUnload);
						w.detachEvent('onunload', unload);
					} else if (w.removeEventListener)
						w.removeEventListener('unload', unload, false);

					// Destroy references
					t.unloads = o = li = w = unload = 0;

					// Run garbarge collector on IE
					if (window.CollectGarbage)
						window.CollectGarbage();
				}
			};

			function fakeUnload() {
				var d = document;

				// Is there things still loading, then do some magic
				if (d.readyState == 'interactive') {
					function stop() {
						// Prevent memory leak
						d.detachEvent('onstop', stop);

						// Call unload handler
						if (unload)
							unload();

						d = 0;
					};

					// Fire unload when the currently loading page is stopped
					if (d)
						d.attachEvent('onstop', stop);

					// Remove onstop listener after a while to prevent the unload function
					// to execute if the user presses cancel in an onbeforeunload
					// confirm dialog and then presses the browser stop button
					window.setTimeout(function() {
						if (d)
							d.detachEvent('onstop', stop);
					}, 0);
				}
			};

			// Attach unload handler
			if (w.attachEvent) {
				w.attachEvent('onunload', unload);
				w.attachEvent('onbeforeunload', fakeUnload);
			} else if (w.addEventListener)
				w.addEventListener('unload', unload, false);

			// Setup initial unload handler array
			t.unloads = [f];
		} else
			t.unloads.push(f);

		return f;
	},

	removeUnload : function(f) {
		var u = this.unloads, r = null;

		tinymce.each(u, function(o, i) {
			if (o && o.func == f) {
				u.splice(i, 1);
				r = f;
				return false;
			}
		});

		return r;
	},

	explode : function(s, d) {
		return s ? tinymce.map(s.split(d || ','), tinymce.trim) : s;
	},

	_addVer : function(u) {
		var v;

		if (!this.query)
			return u;

		v = (u.indexOf('?') == -1 ? '?' : '&') + this.query;

		if (u.indexOf('#') == -1)
			return u + v;

		return u.replace('#', v + '#');
	}

	};

// Required for GZip AJAX loading
window.tinymce = tinymce;

// Initialize the API
tinymce._init();
tinymce.create('tinymce.util.Dispatcher', {
	scope : null,
	listeners : null,

	Dispatcher : function(s) {
		this.scope = s || this;
		this.listeners = [];
	},

	add : function(cb, s) {
		this.listeners.push({cb : cb, scope : s || this.scope});

		return cb;
	},

	addToTop : function(cb, s) {
		this.listeners.unshift({cb : cb, scope : s || this.scope});

		return cb;
	},

	remove : function(cb) {
		var l = this.listeners, o = null;

		tinymce.each(l, function(c, i) {
			if (cb == c.cb) {
				o = cb;
				l.splice(i, 1);
				return false;
			}
		});

		return o;
	},

	dispatch : function() {
		var s, a = arguments, i, li = this.listeners, c;

		// Needs to be a real loop since the listener count might change while looping
		// And this is also more efficient
		for (i = 0; i<li.length; i++) {
			c = li[i];
			s = c.cb.apply(c.scope, a);

			if (s === false)
				break;
		}

		return s;
	}

	});
(function() {
	var each = tinymce.each;

	tinymce.create('tinymce.util.URI', {
		URI : function(u, s) {
			var t = this, o, a, b;

			// Default settings
			s = t.settings = s || {};

			// Strange app protocol or local anchor
			if (/^(mailto|tel|news|javascript|about):/i.test(u) || /^\s*#/.test(u)) {
				t.source = u;
				return;
			}

			// Absolute path with no host, fake host and protocol
			if (u.indexOf('/') === 0 && u.indexOf('//') !== 0)
				u = (s.base_uri ? s.base_uri.protocol || 'http' : 'http') + '://mce_host' + u;

			// Relative path
			if (u.indexOf(':/') === -1 && u.indexOf('//') !== 0)
				u = (s.base_uri.protocol || 'http') + '://mce_host' + t.toAbsPath(s.base_uri.path, u);

			// Parse URL (Credits goes to Steave, http://blog.stevenlevithan.com/archives/parseuri)
			u = u.replace(/@@/g, '(mce_at)'); // Zope 3 workaround, they use @@something
			u = /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*):?([^:@]*))?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/.exec(u);
			each(["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"], function(v, i) {
				var s = u[i];

				// Zope 3 workaround, they use @@something
				if (s)
					s = s.replace(/\(mce_at\)/g, '@@');

				t[v] = s;
			});

			if (b = s.base_uri) {
				if (!t.protocol)
					t.protocol = b.protocol;

				if (!t.userInfo)
					t.userInfo = b.userInfo;

				if (!t.port && t.host == 'mce_host')
					t.port = b.port;

				if (!t.host || t.host == 'mce_host')
					t.host = b.host;

				t.source = '';
			}

			//t.path = t.path || '/';
		},

		setPath : function(p) {
			var t = this;

			p = /^(.*?)\/?(\w+)?$/.exec(p);

			// Update path parts
			t.path = p[0];
			t.directory = p[1];
			t.file = p[2];

			// Rebuild source
			t.source = '';
			t.getURI();
		},

		toRelative : function(u) {
			var t = this, o;

			if (u === "./")
				return u;

			u = new tinymce.util.URI(u, {base_uri : t});

			// Not on same domain/port or protocol
			if ((u.host != 'mce_host' && t.host != u.host && u.host) || t.port != u.port || t.protocol != u.protocol)
				return u.getURI();

			o = t.toRelPath(t.path, u.path);

			// Add query
			if (u.query)
				o += '?' + u.query;

			// Add anchor
			if (u.anchor)
				o += '#' + u.anchor;

			return o;
		},
	
		toAbsolute : function(u, nh) {
			var u = new tinymce.util.URI(u, {base_uri : this});

			return u.getURI(this.host == u.host ? nh : 0);
		},

		toRelPath : function(base, path) {
			var items, bp = 0, out = '', i, l;

			// Split the paths
			base = base.substring(0, base.lastIndexOf('/'));
			base = base.split('/');
			items = path.split('/');

			if (base.length >= items.length) {
				for (i = 0, l = base.length; i < l; i++) {
					if (i >= items.length || base[i] != items[i]) {
						bp = i + 1;
						break;
					}
				}
			}

			if (base.length < items.length) {
				for (i = 0, l = items.length; i < l; i++) {
					if (i >= base.length || base[i] != items[i]) {
						bp = i + 1;
						break;
					}
				}
			}

			if (bp == 1)
				return path;

			for (i = 0, l = base.length - (bp - 1); i < l; i++)
				out += "../";

			for (i = bp - 1, l = items.length; i < l; i++) {
				if (i != bp - 1)
					out += "/" + items[i];
				else
					out += items[i];
			}

			return out;
		},

		toAbsPath : function(base, path) {
			var i, nb = 0, o = [], tr;

			// Split paths
			tr = /\/$/.test(path) ? '/' : '';
			base = base.split('/');
			path = path.split('/');

			// Remove empty chunks
			each(base, function(k) {
				if (k)
					o.push(k);
			});

			base = o;

			// Merge relURLParts chunks
			for (i = path.length - 1, o = []; i >= 0; i--) {
				// Ignore empty or .
				if (path[i].length == 0 || path[i] == ".")
					continue;

				// Is parent
				if (path[i] == '..') {
					nb++;
					continue;
				}

				// Move up
				if (nb > 0) {
					nb--;
					continue;
				}

				o.push(path[i]);
			}

			i = base.length - nb;

			// If /a/b/c or /
			if (i <= 0)
				return '/' + o.reverse().join('/') + tr;

			return '/' + base.slice(0, i).join('/') + '/' + o.reverse().join('/') + tr;
		},

		getURI : function(nh) {
			var s, t = this;

			// Rebuild source
			if (!t.source || nh) {
				s = '';

				if (!nh) {
					if (t.protocol)
						s += t.protocol + '://';

					if (t.userInfo)
						s += t.userInfo + '@';

					if (t.host)
						s += t.host;

					if (t.port)
						s += ':' + t.port;
				}

				if (t.path)
					s += t.path;

				if (t.query)
					s += '?' + t.query;

				if (t.anchor)
					s += '#' + t.anchor;

				t.source = s;
			}

			return t.source;
		}

		});
})();
(function() {
	var each = tinymce.each;

	tinymce.create('static tinymce.util.Cookie', {
		getHash : function(n) {
			var v = this.get(n), h;

			if (v) {
				each(v.split('&'), function(v) {
					v = v.split('=');
					h = h || {};
					h[unescape(v[0])] = unescape(v[1]);
				});
			}

			return h;
		},

		setHash : function(n, v, e, p, d, s) {
			var o = '';

			each(v, function(v, k) {
				o += (!o ? '' : '&') + escape(k) + '=' + escape(v);
			});

			this.set(n, o, e, p, d, s);
		},

		get : function(n) {
			var c = document.cookie, e, p = n + "=", b;

			// Strict mode
			if (!c)
				return;

			b = c.indexOf("; " + p);

			if (b == -1) {
				b = c.indexOf(p);

				if (b != 0)
					return null;
			} else
				b += 2;

			e = c.indexOf(";", b);

			if (e == -1)
				e = c.length;

			return unescape(c.substring(b + p.length, e));
		},

		set : function(n, v, e, p, d, s) {
			document.cookie = n + "=" + escape(v) +
				((e) ? "; expires=" + e.toGMTString() : "") +
				((p) ? "; path=" + escape(p) : "") +
				((d) ? "; domain=" + d : "") +
				((s) ? "; secure" : "");
		},

		remove : function(n, p) {
			var d = new Date();

			d.setTime(d.getTime() - 1000);

			this.set(n, '', d, p, d);
		}

		});
})();
tinymce.create('static tinymce.util.JSON', {
	serialize : function(o) {
		var i, v, s = tinymce.util.JSON.serialize, t;

		if (o == null)
			return 'null';

		t = typeof o;

		if (t == 'string') {
			v = '\bb\tt\nn\ff\rr\""\'\'\\\\';

			return '"' + o.replace(/([\u0080-\uFFFF\x00-\x1f\"])/g, function(a, b) {
				i = v.indexOf(b);

				if (i + 1)
					return '\\' + v.charAt(i + 1);

				a = b.charCodeAt().toString(16);

				return '\\u' + '0000'.substring(a.length) + a;
			}) + '"';
		}

		if (t == 'object') {
			if (o.hasOwnProperty && o instanceof Array) {
					for (i=0, v = '['; i<o.length; i++)
						v += (i > 0 ? ',' : '') + s(o[i]);

					return v + ']';
				}

				v = '{';

				for (i in o)
					v += typeof o[i] != 'function' ? (v.length > 1 ? ',"' : '"') + i + '":' + s(o[i]) : '';

				return v + '}';
		}

		return '' + o;
	},

	parse : function(s) {
		try {
			return eval('(' + s + ')');
		} catch (ex) {
			// Ignore
		}
	}

	});
tinymce.create('static tinymce.util.XHR', {
	send : function(o) {
		var x, t, w = window, c = 0;

		// Default settings
		o.scope = o.scope || this;
		o.success_scope = o.success_scope || o.scope;
		o.error_scope = o.error_scope || o.scope;
		o.async = o.async === false ? false : true;
		o.data = o.data || '';

		function get(s) {
			x = 0;

			try {
				x = new ActiveXObject(s);
			} catch (ex) {
			}

			return x;
		};

		x = w.XMLHttpRequest ? new XMLHttpRequest() : get('Microsoft.XMLHTTP') || get('Msxml2.XMLHTTP');

		if (x) {
			if (x.overrideMimeType)
				x.overrideMimeType(o.content_type);

			x.open(o.type || (o.data ? 'POST' : 'GET'), o.url, o.async);

			if (o.content_type)
				x.setRequestHeader('Content-Type', o.content_type);

			x.send(o.data);

			function ready() {
				if (!o.async || x.readyState == 4 || c++ > 10000) {
					if (o.success && c < 10000 && x.status == 200)
						o.success.call(o.success_scope, '' + x.responseText, x, o);
					else if (o.error)
						o.error.call(o.error_scope, c > 10000 ? 'TIMED_OUT' : 'GENERAL', x, o);

					x = null;
				} else
					w.setTimeout(ready, 10);
			};

			// Syncronous request
			if (!o.async)
				return ready();

			// Wait for response, onReadyStateChange can not be used since it leaks memory in IE
			t = w.setTimeout(ready, 10);
		}

		}
});
(function() {
	var extend = tinymce.extend, JSON = tinymce.util.JSON, XHR = tinymce.util.XHR;

	tinymce.create('tinymce.util.JSONRequest', {
		JSONRequest : function(s) {
			this.settings = extend({
			}, s);
			this.count = 0;
		},

		send : function(o) {
			var ecb = o.error, scb = o.success;

			o = extend(this.settings, o);

			o.success = function(c, x) {
				c = JSON.parse(c);

				if (typeof(c) == 'undefined') {
					c = {
						error : 'JSON Parse error.'
					};
				}

				if (c.error)
					ecb.call(o.error_scope || o.scope, c.error, x);
				else
					scb.call(o.success_scope || o.scope, c.result);
			};

			o.error = function(ty, x) {
				ecb.call(o.error_scope || o.scope, ty, x);
			};

			o.data = JSON.serialize({
				id : o.id || 'c' + (this.count++),
				method : o.method,
				params : o.params
			});

			// JSON content type for Ruby on rails. Bug: #1883287
			o.content_type = 'application/json';

			XHR.send(o);
		},

		'static' : {
			sendRPC : function(o) {
				return new tinymce.util.JSONRequest().send(o);
			}
		}

		});
}());(function(tinymce) {
	// Shorten names
	var each = tinymce.each, is = tinymce.is;
	var isWebKit = tinymce.isWebKit, isIE = tinymce.isIE;

	tinymce.create('tinymce.dom.DOMUtils', {
		doc : null,
		root : null,
		files : null,
		pixelStyles : /^(top|left|bottom|right|width|height|borderWidth)$/,
		props : {
			"for" : "htmlFor",
			"class" : "className",
			className : "className",
			checked : "checked",
			disabled : "disabled",
			maxlength : "maxLength",
			readonly : "readOnly",
			selected : "selected",
			value : "value",
			id : "id",
			name : "name",
			type : "type"
		},

		DOMUtils : function(d, s) {
			var t = this;

			t.doc = d;
			t.win = window;
			t.files = {};
			t.cssFlicker = false;
			t.counter = 0;
			t.boxModel = !tinymce.isIE || d.compatMode == "CSS1Compat"; 
			t.stdMode = d.documentMode === 8;

			this.settings = s = tinymce.extend({
				keep_values : false,
				hex_colors : 1,
				process_html : 1
			}, s);

			// Fix IE6SP2 flicker and check it failed for pre SP2
			if (tinymce.isIE6) {
				try {
					d.execCommand('BackgroundImageCache', false, true);
				} catch (e) {
					t.cssFlicker = true;
				}
			}

			tinymce.addUnload(t.destroy, t);
		},

		getRoot : function() {
			var t = this, s = t.settings;

			return (s && t.get(s.root_element)) || t.doc.body;
		},

		getViewPort : function(w) {
			var d, b;

			w = !w ? this.win : w;
			d = w.document;
			b = this.boxModel ? d.documentElement : d.body;

			// Returns viewport size excluding scrollbars
			return {
				x : w.pageXOffset || b.scrollLeft,
				y : w.pageYOffset || b.scrollTop,
				w : w.innerWidth || b.clientWidth,
				h : w.innerHeight || b.clientHeight
			};
		},

		getRect : function(e) {
			var p, t = this, sr;

			e = t.get(e);
			p = t.getPos(e);
			sr = t.getSize(e);

			return {
				x : p.x,
				y : p.y,
				w : sr.w,
				h : sr.h
			};
		},

		getSize : function(e) {
			var t = this, w, h;

			e = t.get(e);
			w = t.getStyle(e, 'width');
			h = t.getStyle(e, 'height');

			// Non pixel value, then force offset/clientWidth
			if (w.indexOf('px') === -1)
				w = 0;

			// Non pixel value, then force offset/clientWidth
			if (h.indexOf('px') === -1)
				h = 0;

			return {
				w : parseInt(w) || e.offsetWidth || e.clientWidth,
				h : parseInt(h) || e.offsetHeight || e.clientHeight
			};
		},

		is : function(n, patt) {
			return tinymce.dom.Sizzle.matches(patt, n.nodeType ? [n] : n).length > 0;
		},

		getParent : function(n, f, r) {
			return this.getParents(n, f, r, false);
		},

		getParents : function(n, f, r, c) {
			var t = this, na, se = t.settings, o = [];

			n = t.get(n);
			c = c === undefined;

			if (se.strict_root)
				r = r || t.getRoot();

			// Wrap node name as func
			if (is(f, 'string')) {
				na = f;

				if (f === '*') {
					f = function(n) {return n.nodeType == 1;};
				} else {
					f = function(n) {
						return t.is(n, na);
					};
				}
			}

			while (n) {
				if (n == r || !n.nodeType || n.nodeType === 9)
					break;

				if (!f || f(n)) {
					if (c)
						o.push(n);
					else
						return n;
				}

				n = n.parentNode;
			}

			return c ? o : null;
		},

		get : function(e) {
			var n;

			if (e && this.doc && typeof(e) == 'string') {
				n = e;
				e = this.doc.getElementById(e);

				// IE and Opera returns meta elements when they match the specified input ID, but getElementsByName seems to do the trick
				if (e && e.id !== n)
					return this.doc.getElementsByName(n)[1];
			}

			return e;
		},


		select : function(pa, s) {
			var t = this;

			return tinymce.dom.Sizzle(pa, t.get(s) || t.get(t.settings.root_element) || t.doc, []);
		},


		add : function(p, n, a, h, c) {
			var t = this;

			return this.run(p, function(p) {
				var e, k;

				e = is(n, 'string') ? t.doc.createElement(n) : n;
				t.setAttribs(e, a);

				if (h) {
					if (h.nodeType)
						e.appendChild(h);
					else
						t.setHTML(e, h);
				}

				return !c ? p.appendChild(e) : e;
			});
		},

		create : function(n, a, h) {
			return this.add(this.doc.createElement(n), n, a, h, 1);
		},

		createHTML : function(n, a, h) {
			var o = '', t = this, k;

			o += '<' + n;

			for (k in a) {
				if (a.hasOwnProperty(k))
					o += ' ' + k + '="' + t.encode(a[k]) + '"';
			}

			if (tinymce.is(h))
				return o + '>' + h + '</' + n + '>';

			return o + ' />';
		},

		remove : function(n, k) {
			var t = this;

			return this.run(n, function(n) {
				var p, g, i;

				p = n.parentNode;

				if (!p)
					return null;

				if (k) {
					for (i = n.childNodes.length - 1; i >= 0; i--)
						t.insertAfter(n.childNodes[i], n);

					//each(n.childNodes, function(c) {
					//	p.insertBefore(c.cloneNode(true), n);
					//});
				}

				// Fix IE psuedo leak
				if (t.fixPsuedoLeaks) {
					p = n.cloneNode(true);
					k = 'IELeakGarbageBin';
					g = t.get(k) || t.add(t.doc.body, 'div', {id : k, style : 'display:none'});
					g.appendChild(n);
					g.innerHTML = '';

					return p;
				}

				return p.removeChild(n);
			});
		},


		setStyle : function(n, na, v) {
			var t = this;

			return t.run(n, function(e) {
				var s, i;

				s = e.style;

				// Camelcase it, if needed
				na = na.replace(/-(\D)/g, function(a, b){
					return b.toUpperCase();
				});

				// Default px suffix on these
				if (t.pixelStyles.test(na) && (tinymce.is(v, 'number') || /^[\-0-9\.]+$/.test(v)))
					v += 'px';

				switch (na) {
					case 'opacity':
						// IE specific opacity
						if (isIE) {
							s.filter = v === '' ? '' : "alpha(opacity=" + (v * 100) + ")";

							if (!n.currentStyle || !n.currentStyle.hasLayout)
								s.display = 'inline-block';
						}

						// Fix for older browsers
						s[na] = s['-moz-opacity'] = s['-khtml-opacity'] = v || '';
						break;

					case 'float':
						isIE ? s.styleFloat = v : s.cssFloat = v;
						break;
					
					default:
						s[na] = v || '';
				}

				// Force update of the style data
				if (t.settings.update_styles)
					t.setAttrib(e, 'mce_style');
			});
		},

		getStyle : function(n, na, c) {
			n = this.get(n);

			if (!n)
				return false;

			// Gecko
			if (this.doc.defaultView && c) {
				// Remove camelcase
				na = na.replace(/[A-Z]/g, function(a){
					return '-' + a;
				});

				try {
					return this.doc.defaultView.getComputedStyle(n, null).getPropertyValue(na);
				} catch (ex) {
					// Old safari might fail
					return null;
				}
			}

			// Camelcase it, if needed
			na = na.replace(/-(\D)/g, function(a, b){
				return b.toUpperCase();
			});

			if (na == 'float')
				na = isIE ? 'styleFloat' : 'cssFloat';

			// IE & Opera
			if (n.currentStyle && c)
				return n.currentStyle[na];

			return n.style[na];
		},

		setStyles : function(e, o) {
			var t = this, s = t.settings, ol;

			ol = s.update_styles;
			s.update_styles = 0;

			each(o, function(v, n) {
				t.setStyle(e, n, v);
			});

			// Update style info
			s.update_styles = ol;
			if (s.update_styles)
				t.setAttrib(e, s.cssText);
		},

		setAttrib : function(e, n, v) {
			var t = this;

			// Whats the point
			if (!e || !n)
				return;

			// Strict XML mode
			if (t.settings.strict)
				n = n.toLowerCase();

			return this.run(e, function(e) {
				var s = t.settings;

				switch (n) {
					case "style":
						if (!is(v, 'string')) {
							each(v, function(v, n) {
								t.setStyle(e, n, v);
							});

							return;
						}

						// No mce_style for elements with these since they might get resized by the user
						if (s.keep_values) {
							if (v && !t._isRes(v))
								e.setAttribute('mce_style', v, 2);
							else
								e.removeAttribute('mce_style', 2);
						}

						e.style.cssText = v;
						break;

					case "class":
						e.className = v || ''; // Fix IE null bug
						break;

					case "src":
					case "href":
						if (s.keep_values) {
							if (s.url_converter)
								v = s.url_converter.call(s.url_converter_scope || t, v, n, e);

							t.setAttrib(e, 'mce_' + n, v, 2);
						}

						break;
					
					case "shape":
						e.setAttribute('mce_style', v);
						break;
				}

				if (is(v) && v !== null && v.length !== 0)
					e.setAttribute(n, '' + v, 2);
				else
					e.removeAttribute(n, 2);
			});
		},

		setAttribs : function(e, o) {
			var t = this;

			return this.run(e, function(e) {
				each(o, function(v, n) {
					t.setAttrib(e, n, v);
				});
			});
		},


		getAttrib : function(e, n, dv) {
			var v, t = this;

			e = t.get(e);

			if (!e || e.nodeType !== 1)
				return false;

			if (!is(dv))
				dv = '';

			// Try the mce variant for these
			if (/^(src|href|style|coords|shape)$/.test(n)) {
				v = e.getAttribute("mce_" + n);

				if (v)
					return v;
			}

			if (isIE && t.props[n]) {
				v = e[t.props[n]];
				v = v && v.nodeValue ? v.nodeValue : v;
			}

			if (!v)
				v = e.getAttribute(n, 2);

			if (n === 'style') {
				v = v || e.style.cssText;

				if (v) {
					v = t.serializeStyle(t.parseStyle(v));

					if (t.settings.keep_values && !t._isRes(v))
						e.setAttribute('mce_style', v);
				}
			}

			// Remove Apple and WebKit stuff
			if (isWebKit && n === "class" && v)
				v = v.replace(/(apple|webkit)\-[a-z\-]+/gi, '');

			// Handle IE issues
			if (isIE) {
				switch (n) {
					case 'rowspan':
					case 'colspan':
						// IE returns 1 as default value
						if (v === 1)
							v = '';

						break;

					case 'size':
						// IE returns +0 as default value for size
						if (v === '+0' || v === 20 || v === 0)
							v = '';

						break;

					case 'width':
					case 'height':
					case 'vspace':
					case 'checked':
					case 'disabled':
					case 'readonly':
						if (v === 0)
							v = '';

						break;

					case 'hspace':
						// IE returns -1 as default value
						if (v === -1)
							v = '';

						break;

					case 'maxlength':
					case 'tabindex':
						// IE returns default value
						if (v === 32768 || v === 2147483647 || v === '32768')
							v = '';

						break;

					case 'multiple':
					case 'compact':
					case 'noshade':
					case 'nowrap':
						if (v === 65535)
							return n;

						return dv;

					case 'shape':
						v = v.toLowerCase();
						break;

					default:
						// IE has odd anonymous function for event attributes
						if (n.indexOf('on') === 0 && v)
							v = ('' + v).replace(/^function\s+\w+\(\)\s+\{\s+(.*)\s+\}$/, '$1');
				}
			}

			return (v !== undefined && v !== null && v !== '') ? '' + v : dv;
		},

		getPos : function(n, ro) {
			var t = this, x = 0, y = 0, e, d = t.doc, r;

			n = t.get(n);
			ro = ro || d.body;

			if (n) {
				// Use getBoundingClientRect on IE, Opera has it but it's not perfect
				if (isIE && !t.stdMode) {
					n = n.getBoundingClientRect();
					e = t.boxModel ? d.documentElement : d.body;
					x = t.getStyle(t.select('html')[0], 'borderWidth'); // Remove border
					x = (x == 'medium' || t.boxModel && !t.isIE6) && 2 || x;
					n.top += t.win.self != t.win.top ? 2 : 0; // IE adds some strange extra cord if used in a frameset

					return {x : n.left + e.scrollLeft - x, y : n.top + e.scrollTop - x};
				}

				r = n;
				while (r && r != ro && r.nodeType) {
					x += r.offsetLeft || 0;
					y += r.offsetTop || 0;
					r = r.offsetParent;
				}

				r = n.parentNode;
				while (r && r != ro && r.nodeType) {
					x -= r.scrollLeft || 0;
					y -= r.scrollTop || 0;
					r = r.parentNode;
				}
			}

			return {x : x, y : y};
		},

		parseStyle : function(st) {
			var t = this, s = t.settings, o = {};

			if (!st)
				return o;

			function compress(p, s, ot) {
				var t, r, b, l;

				// Get values and check it it needs compressing
				t = o[p + '-top' + s];
				if (!t)
					return;

				r = o[p + '-right' + s];
				if (t != r)
					return;

				b = o[p + '-bottom' + s];
				if (r != b)
					return;

				l = o[p + '-left' + s];
				if (b != l)
					return;

				// Compress
				o[ot] = l;
				delete o[p + '-top' + s];
				delete o[p + '-right' + s];
				delete o[p + '-bottom' + s];
				delete o[p + '-left' + s];
			};

			function compress2(ta, a, b, c) {
				var t;

				t = o[a];
				if (!t)
					return;

				t = o[b];
				if (!t)
					return;

				t = o[c];
				if (!t)
					return;

				// Compress
				o[ta] = o[a] + ' ' + o[b] + ' ' + o[c];
				delete o[a];
				delete o[b];
				delete o[c];
			};

			st = st.replace(/&(#?[a-z0-9]+);/g, '&$1_MCE_SEMI_'); // Protect entities

			each(st.split(';'), function(v) {
				var sv, ur = [];

				if (v) {
					v = v.replace(/_MCE_SEMI_/g, ';'); // Restore entities
					v = v.replace(/url\([^\)]+\)/g, function(v) {ur.push(v);return 'url(' + ur.length + ')';});
					v = v.split(':');
					sv = tinymce.trim(v[1]);
					sv = sv.replace(/url\(([^\)]+)\)/g, function(a, b) {return ur[parseInt(b) - 1];});

					sv = sv.replace(/rgb\([^\)]+\)/g, function(v) {
						return t.toHex(v);
					});

					if (s.url_converter) {
						sv = sv.replace(/url\([\'\"]?([^\)\'\"]+)[\'\"]?\)/g, function(x, c) {
							return 'url(' + s.url_converter.call(s.url_converter_scope || t, t.decode(c), 'style', null) + ')';
						});
					}

					o[tinymce.trim(v[0]).toLowerCase()] = sv;
				}
			});

			compress("border", "", "border");
			compress("border", "-width", "border-width");
			compress("border", "-color", "border-color");
			compress("border", "-style", "border-style");
			compress("padding", "", "padding");
			compress("margin", "", "margin");
			compress2('border', 'border-width', 'border-style', 'border-color');

			if (isIE) {
				// Remove pointless border
				if (o.border == 'medium none')
					o.border = '';
			}

			return o;
		},

		serializeStyle : function(o) {
			var s = '';

			each(o, function(v, k) {
				if (k && v) {
					if (tinymce.isGecko && k.indexOf('-moz-') === 0)
						return;

					switch (k) {
						case 'color':
						case 'background-color':
							v = v.toLowerCase();
							break;
					}

					s += (s ? ' ' : '') + k + ': ' + v + ';';
				}
			});

			return s;
		},

		loadCSS : function(u) {
			var t = this, d = t.doc;

			if (!u)
				u = '';

			each(u.split(','), function(u) {
				if (t.files[u])
					return;

				t.files[u] = true;
				t.add(t.select('head')[0], 'link', {rel : 'stylesheet', href : tinymce._addVer(u)});
			});
		},


		addClass : function(e, c) {
			return this.run(e, function(e) {
				var o;

				if (!c)
					return 0;

				if (this.hasClass(e, c))
					return e.className;

				o = this.removeClass(e, c);

				return e.className = (o != '' ? (o + ' ') : '') + c;
			});
		},

		removeClass : function(e, c) {
			var t = this, re;

			return t.run(e, function(e) {
				var v;

				if (t.hasClass(e, c)) {
					if (!re)
						re = new RegExp("(^|\\s+)" + c + "(\\s+|$)", "g");

					v = e.className.replace(re, ' ');

					return e.className = tinymce.trim(v != ' ' ? v : '');
				}

				return e.className;
			});
		},

		hasClass : function(n, c) {
			n = this.get(n);

			if (!n || !c)
				return false;

			return (' ' + n.className + ' ').indexOf(' ' + c + ' ') !== -1;
		},

		show : function(e) {
			return this.setStyle(e, 'display', 'block');
		},

		hide : function(e) {
			return this.setStyle(e, 'display', 'none');
		},

		isHidden : function(e) {
			e = this.get(e);

			return !e || e.style.display == 'none' || this.getStyle(e, 'display') == 'none';
		},


		uniqueId : function(p) {
			return (!p ? 'mce_' : p) + (this.counter++);
		},

		setHTML : function(e, h) {
			var t = this;

			return this.run(e, function(e) {
				var x, i, nl, n, p, x;

				h = t.processHTML(h);

				if (isIE) {
					function set() {
						try {
							// IE will remove comments from the beginning
							// unless you padd the contents with something
							e.innerHTML = '<br />' + h;
							e.removeChild(e.firstChild);
						} catch (ex) {
							// IE sometimes produces an unknown runtime error on innerHTML if it's an block element within a block element for example a div inside a p
							// This seems to fix this problem

							// Remove all child nodes
							while (e.firstChild)
								e.firstChild.removeNode();

							// Create new div with HTML contents and a BR infront to keep comments
							x = t.create('div');
							x.innerHTML = '<br />' + h;

							// Add all children from div to target
							each (x.childNodes, function(n, i) {
								// Skip br element
								if (i)
									e.appendChild(n);
							});
						}
					};

					// IE has a serious bug when it comes to paragraphs it can produce an invalid
					// DOM tree if contents like this <p><ul><li>Item 1</li></ul></p> is inserted
					// It seems to be that IE doesn't like a root block element placed inside another root block element
					if (t.settings.fix_ie_paragraphs)
						h = h.replace(/<p><\/p>|<p([^>]+)><\/p>|<p[^\/+]\/>/gi, '<p$1 mce_keep="true">&nbsp;</p>');

					set();

					if (t.settings.fix_ie_paragraphs) {
						// Check for odd paragraphs this is a sign of a broken DOM
						nl = e.getElementsByTagName("p");
						for (i = nl.length - 1, x = 0; i >= 0; i--) {
							n = nl[i];

							if (!n.hasChildNodes()) {
								if (!n.mce_keep) {
									x = 1; // Is broken
									break;
								}

								n.removeAttribute('mce_keep');
							}
						}
					}

					// Time to fix the madness IE left us
					if (x) {
						// So if we replace the p elements with divs and mark them and then replace them back to paragraphs
						// after we use innerHTML we can fix the DOM tree
						h = h.replace(/<p ([^>]+)>|<p>/g, '<div $1 mce_tmp="1">');
						h = h.replace(/<\/p>/g, '</div>');

						// Set the new HTML with DIVs
						set();

						// Replace all DIV elements with he mce_tmp attibute back to paragraphs
						// This is needed since IE has a annoying bug see above for details
						// This is a slow process but it has to be done. :(
						if (t.settings.fix_ie_paragraphs) {
							nl = e.getElementsByTagName("DIV");
							for (i = nl.length - 1; i >= 0; i--) {
								n = nl[i];

								// Is it a temp div
								if (n.mce_tmp) {
									// Create new paragraph
									p = t.doc.createElement('p');

									// Copy all attributes
									n.cloneNode(false).outerHTML.replace(/([a-z0-9\-_]+)=/gi, function(a, b) {
										var v;

										if (b !== 'mce_tmp') {
											v = n.getAttribute(b);

											if (!v && b === 'class')
												v = n.className;

											p.setAttribute(b, v);
										}
									});

									// Append all children to new paragraph
									for (x = 0; x<n.childNodes.length; x++)
										p.appendChild(n.childNodes[x].cloneNode(true));

									// Replace div with new paragraph
									n.swapNode(p);
								}
							}
						}
					}
				} else
					e.innerHTML = h;

				return h;
			});
		},

		processHTML : function(h) {
			var t = this, s = t.settings;

			if (!s.process_html)
				return h;

			// Convert strong and em to b and i in FF since it can't handle them
			if (tinymce.isGecko) {
				h = h.replace(/<(\/?)strong>|<strong( [^>]+)>/gi, '<$1b$2>');
				h = h.replace(/<(\/?)em>|<em( [^>]+)>/gi, '<$1i$2>');
			} else if (isIE) {
				h = h.replace(/&apos;/g, '&#39;'); // IE can't handle apos
				h = h.replace(/\s+(disabled|checked|readonly|selected)\s*=\s*[\"\']?(false|0)[\"\']?/gi, ''); // IE doesn't handle default values correct
			}

			// Fix some issues
			h = h.replace(/<a( )([^>]+)\/>|<a\/>/gi, '<a$1$2></a>'); // Force open

			// Store away src and href in mce_src and mce_href since browsers mess them up
			if (s.keep_values) {
				// Wrap scripts and styles in comments for serialization purposes
				if (/<script|style/.test(h)) {
					function trim(s) {
						// Remove prefix and suffix code for element
						s = s.replace(/(<!--\[CDATA\[|\]\]-->)/g, '\n');
						s = s.replace(/^[\r\n]*|[\r\n]*$/g, '');
						s = s.replace(/^\s*(\/\/\s*<!--|\/\/\s*<!\[CDATA\[|<!--|<!\[CDATA\[)[\r\n]*/g, '');
						s = s.replace(/\s*(\/\/\s*\]\]>|\/\/\s*-->|\]\]>|-->|\]\]-->)\s*$/g, '');

						return s;
					};

					// Preserve script elements
					h = h.replace(/<script([^>]+|)>([\s\S]*?)<\/script>/g, function(v, a, b) {
						// Remove prefix and suffix code for script element
						b = trim(b);

						// Force type attribute
						if (!a)
							a = ' type="text/javascript"';

						// Wrap contents in a comment
						if (b)
							b = '<!--\n' + b + '\n// -->';

						// Output fake element
						return '<mce:script' + a + '>' + b + '</mce:script>';
					});

					// Preserve style elements
					h = h.replace(/<style([^>]+|)>([\s\S]*?)<\/style>/g, function(v, a, b) {
						b = trim(b);
						return '<mce:style' + a + '><!--\n' + b + '\n--></mce:style><style' + a + ' mce_bogus="1">' + b + '</style>';
					});
				}

				h = h.replace(/<!\[CDATA\[([\s\S]+)\]\]>/g, '<!--[CDATA[$1]]-->');

				// Process all tags with src, href or style
				h = h.replace(/<([\w:]+) [^>]*(src|href|style|shape|coords)[^>]*>/gi, function(a, n) {
					function handle(m, b, c) {
						var u = c;

						// Tag already got a mce_ version
						if (a.indexOf('mce_' + b) != -1)
							return m;

						if (b == 'style') {
							// No mce_style for elements with these since they might get resized by the user
							if (t._isRes(c))
								return m;

							if (s.hex_colors) {
								u = u.replace(/rgb\([^\)]+\)/g, function(v) {
									return t.toHex(v);
								});
							}

							if (s.url_converter) {
								u = u.replace(/url\([\'\"]?([^\)\'\"]+)\)/g, function(x, c) {
									return 'url(' + t.encode(s.url_converter.call(s.url_converter_scope || t, t.decode(c), b, n)) + ')';
								});
							}
						} else if (b != 'coords' && b != 'shape') {
							if (s.url_converter)
								u = t.encode(s.url_converter.call(s.url_converter_scope || t, t.decode(c), b, n));
						}

						return ' ' + b + '="' + c + '" mce_' + b + '="' + u + '"';
					};

					a = a.replace(/ (src|href|style|coords|shape)=[\"]([^\"]+)[\"]/gi, handle); // W3C
					a = a.replace(/ (src|href|style|coords|shape)=[\']([^\']+)[\']/gi, handle); // W3C

					return a.replace(/ (src|href|style|coords|shape)=([^\s\"\'>]+)/gi, handle); // IE
				});
			}

			return h;
		},

		getOuterHTML : function(e) {
			var d;

			e = this.get(e);

			if (!e)
				return null;

			if (e.outerHTML !== undefined)
				return e.outerHTML;

			d = (e.ownerDocument || this.doc).createElement("body");
			d.appendChild(e.cloneNode(true));

			return d.innerHTML;
		},

		setOuterHTML : function(e, h, d) {
			var t = this;

			return this.run(e, function(e) {
				var n, tp;

				e = t.get(e);
				d = d || e.ownerDocument || t.doc;

				if (isIE && e.nodeType == 1)
					e.outerHTML = h;
				else {
					tp = d.createElement("body");
					tp.innerHTML = h;

					n = tp.lastChild;
					while (n) {
						t.insertAfter(n.cloneNode(true), e);
						n = n.previousSibling;
					}

					t.remove(e);
				}
			});
		},

		decode : function(s) {
			var e, n, v;

			// Look for entities to decode
			if (/&[^;]+;/.test(s)) {
				// Decode the entities using a div element not super efficient but less code
				e = this.doc.createElement("div");
				e.innerHTML = s;
				n = e.firstChild;
				v = '';

				if (n) {
					do {
						v += n.nodeValue;
					} while (n.nextSibling);
				}

				return v || s;
			}

			return s;
		},

		encode : function(s) {
			return s ? ('' + s).replace(/[<>&\"]/g, function (c, b) {
				switch (c) {
					case '&':
						return '&amp;';

					case '"':
						return '&quot;';

					case '<':
						return '&lt;';

					case '>':
						return '&gt;';
				}

				return c;
			}) : s;
		},


		insertAfter : function(n, r) {
			var t = this;

			r = t.get(r);

			return this.run(n, function(n) {
				var p, ns;

				p = r.parentNode;
				ns = r.nextSibling;

				if (ns)
					p.insertBefore(n, ns);
				else
					p.appendChild(n);

				return n;
			});
		},


		isBlock : function(n) {
			if (n.nodeType && n.nodeType !== 1)
				return false;

			n = n.nodeName || n;

			return /^(H[1-6]|HR|P|DIV|ADDRESS|PRE|FORM|TABLE|LI|OL|UL|TR|TD|CAPTION|BLOCKQUOTE|CENTER|DL|DT|DD|DIR|FIELDSET|NOSCRIPT|NOFRAMES|MENU|ISINDEX|SAMP)$/.test(n);
		},


		replace : function(n, o, k) {
			var t = this;

			if (is(o, 'array'))
				n = n.cloneNode(true);

			return t.run(o, function(o) {
				if (k) {
					each(o.childNodes, function(c) {
						n.appendChild(c.cloneNode(true));
					});
				}

				// Fix IE psuedo leak for elements since replacing elements if fairly common
				// Will break parentNode for some unknown reason
				if (t.fixPsuedoLeaks && o.nodeType === 1) {
					o.parentNode.insertBefore(n, o);
					t.remove(o);
					return n;
				}

				return o.parentNode.replaceChild(n, o);
			});
		},


		findCommonAncestor : function(a, b) {
			var ps = a, pe;

			while (ps) {
				pe = b;

				while (pe && ps != pe)
					pe = pe.parentNode;

				if (ps == pe)
					break;

				ps = ps.parentNode;
			}

			if (!ps && a.ownerDocument)
				return a.ownerDocument.documentElement;

			return ps;
		},

		toHex : function(s) {
			var c = /^\s*rgb\s*?\(\s*?([0-9]+)\s*?,\s*?([0-9]+)\s*?,\s*?([0-9]+)\s*?\)\s*$/i.exec(s);

			function hex(s) {
				s = parseInt(s).toString(16);

				return s.length > 1 ? s : '0' + s; // 0 -> 00
			};

			if (c) {
				s = '#' + hex(c[1]) + hex(c[2]) + hex(c[3]);

				return s;
			}

			return s;
		},

		getClasses : function() {
			var t = this, cl = [], i, lo = {}, f = t.settings.class_filter, ov;

			if (t.classes)
				return t.classes;

			function addClasses(s) {
				// IE style imports
				each(s.imports, function(r) {
					addClasses(r);
				});

				each(s.cssRules || s.rules, function(r) {
					// Real type or fake it on IE
					switch (r.type || 1) {
						// Rule
						case 1:
							if (r.selectorText) {
								each(r.selectorText.split(','), function(v) {
									v = v.replace(/^\s*|\s*$|^\s\./g, "");

									// Is internal or it doesn't contain a class
									if (/\.mce/.test(v) || !/\.[\w\-]+$/.test(v))
										return;

									// Remove everything but class name
									ov = v;
									v = v.replace(/.*\.([a-z0-9_\-]+).*/i, '$1');

									// Filter classes
									if (f && !(v = f(v, ov)))
										return;

									if (!lo[v]) {
										cl.push({'class' : v});
										lo[v] = 1;
									}
								});
							}
							break;

						// Import
						case 3:
							addClasses(r.styleSheet);
							break;
					}
				});
			};

			try {
				each(t.doc.styleSheets, addClasses);
			} catch (ex) {
				// Ignore
			}

			if (cl.length > 0)
				t.classes = cl;

			return cl;
		},

		run : function(e, f, s) {
			var t = this, o;

			if (t.doc && typeof(e) === 'string')
				e = t.get(e);

			if (!e)
				return false;

			s = s || this;
			if (!e.nodeType && (e.length || e.length === 0)) {
				o = [];

				each(e, function(e, i) {
					if (e) {
						if (typeof(e) == 'string')
							e = t.doc.getElementById(e);

						o.push(f.call(s, e, i));
					}
				});

				return o;
			}

			return f.call(s, e);
		},

		getAttribs : function(n) {
			var o;

			n = this.get(n);

			if (!n)
				return [];

			if (isIE) {
				o = [];

				// Object will throw exception in IE
				if (n.nodeName == 'OBJECT')
					return n.attributes;

				// It's crazy that this is faster in IE but it's because it returns all attributes all the time
				n.cloneNode(false).outerHTML.replace(/([a-z0-9\:\-_]+)=/gi, function(a, b) {
					o.push({specified : 1, nodeName : b});
				});

				return o;
			}

			return n.attributes;
		},

		destroy : function(s) {
			var t = this;

			t.win = t.doc = t.root = null;

			// Manual destroy then remove unload handler
			if (!s)
				tinymce.removeUnload(t.destroy);
		},

		createRng : function() {
			var d = this.doc;

			return d.createRange ? d.createRange() : new tinymce.dom.Range(this);
		},

		split : function(pe, e, re) {
			var t = this, r = t.createRng(), bef, aft, pa;

			// W3C valid browsers tend to leave empty nodes to the left/right side of the contents, this makes sence
			// but we don't want that in our code since it serves no purpose
			// For example if this is chopped:
			//   <p>text 1<span>