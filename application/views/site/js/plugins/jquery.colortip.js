(function($){
	$.fn.colorTip = function(settings){

		var defaultSettings = {
			color		: 'yellow',
			timeout		: 200,
			content     : '',
			align       : 'center',
			left        : -1,  // adjustLeft
			top         : -1,   // adjustRight
			arrow       : true   
		};
		
		var supportedColors = ['red','green','blue','white','yellow','black'];
		
		/* Combining the default settings object with the supplied one */
		settings = $.extend(defaultSettings,settings);

		/*
		*	Looping through all the elements and returning them afterwards.
		*	This will add chainability to the plugin.
		*/
		
		return this.each(function(){

			var elem = $(this);
			
			// If the title attribute is empty, continue with the next element
			if(settings.content == '' && !elem.attr('title')) return true;
			
			// Creating new eventScheduler and Tip objects for this element.
			// (See the class definition at the bottom).
			
			var scheduleEvent = new eventScheduler();
			var tip = new Tip(settings.content != '' ? settings.content : elem.attr('title'), settings.align, settings.left, settings.arrow);

			// Adding the tooltip markup to the element and
			// applying a special class:
			
			elem.append(tip.generate()).addClass('colorTipContainer');

			// Checking to see whether a supported color has been
			// set as a classname on the element.
			
			var hasClass = false;
			for(var i=0;i<supportedColors.length;i++)
			{
				if(elem.hasClass(supportedColors[i])){
					hasClass = true;
					break;
				}
			}
			
			// If it has been set, it will override the default color
			
			if(!hasClass){
				elem.addClass(settings.color);
			}
			
			// On mouseenter, show the tip, on mouseleave set the
			// tip to be hidden in half a second.
			
			elem.hover(function(){

				tip.show();
				
				// If the user moves away and hovers over the tip again,
				// clear the previously set event:
				
				scheduleEvent.clear();

			},function(){

				// Schedule event actualy sets a timeout (as you can
				// see from the class definition below).
				
				scheduleEvent.set(function(){
					tip.hide();
				},settings.timeout);

			});
			
			// Removing the title attribute, so the regular OS titles are
			// not shown along with the tooltips.
			
			elem.removeAttr('title');
		});
		
	};


	/*
	/	Event Scheduler Class Definition
	*/

	function eventScheduler(){};
	
	eventScheduler.prototype = {
		set	: function (func,timeout){

			// The set method takes a function and a time period (ms) as
			// parameters, and sets a timeout

			this.timer = setTimeout(func,timeout);
		},
		clear: function(){
			
			// The clear method clears the timeout
			
			clearTimeout(this.timer);
		}
	};


	/*
	/	Tip Class Definition
	*/

	function Tip(txt, align, left, arrow){
		this.content = txt;
		this.shown = false;
		this.align = align;
		this.left = left;
		this.arrow = arrow;
	};
	
	Tip.prototype = {
		generate: function(){
			
			// The generate method returns either a previously generated element stored in the tip variable, 
			// or generates it and saves it in tip for later use, after which returns it.			
			return this.tip || (this.tip = $('<span class="colorTip">'+this.content+ (this.arrow ?
											 '<span class="pointyTipShadow '+this.align+'"></span><span class="pointyTip '+this.align+'"></span>':'')+'</span>'));
		},
		show: function(){
			if(this.shown) return;
			
			var lt = 0;
			if(this.align == 'left') lt = this.tip.outerWidth()/2 - 15;
			else if(this.align == 'right') lt = 15-this.tip.outerWidth()/2;
			
			// Center the tip and start a fadeIn animation
			this.tip.css('margin-left',(-this.tip.outerWidth()/2)+lt+ (this.left != -1 ? this.left : 0) ).fadeIn('fast');
			//if(this.top != -1)  this.tip.css('margin-top', this.top);
			this.shown = true;
		},
		hide: function(){
			this.tip.fadeOut();
			this.shown = false;
		}
	};
	
})(jQuery);
