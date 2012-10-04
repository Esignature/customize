$j(function(){
	// language switcher          
    $j('#switch_lang li a').click(function() {
       $j('#__set_lng').val($j(this).attr('rel'));
       $j('#frmLang').submit();
       return false;
    });
	
	//search box of header
	$j('#keyword').bind('focusin focusout', function(e){
		var t = $j(this);
		if(e.type == 'focusin' && t.val() == 'Search here') {
			t.val('');
		} else if(e.type == 'focusout' && t.val() == '') {
			t.val('Search here');
		}
	});
	
	
	//userinfo
	$j('.userinfo').click(function(){
		if(!$j(this).hasClass('userinfodrop')) {
			var t = $j(this);
			$j('.userdrop').width(t.width() + 30);	//make this width the same with the user info wrapper
			$j('.userdrop').slideDown('fast');
			t.addClass('userinfodrop');					//add class to change color and background
			
		} else {
			$j(this).removeClass('userinfodrop');
			$j('.userdrop').hide();
		}
		
		//remove notification box if visible
		$j('.notialert').removeClass('notiactive');
		$j('.notibox').hide();
			
		return false;
	});
	
	
	//notification onclick
	$j('.notialert').click(function(){
		var t = $j(this);
		var url = t.attr('href');
		if(!t.hasClass('notiactive')) {
			$j('.notibox').slideDown('fast');			//show notification box
			$j('.noticontent').empty();					//clear data
			$j('.notibox .tabmenu li').each(function(){ 
				$j(this).removeClass('current');		//reset active tab menu
			});
			//make first li as default active menu
			$j('.notibox .tabmenu li:first-child').addClass('current');
			
			t.addClass('notiactive');
			
			$j('.notibox .loader').show();				//show loading image while waiting a response from server
			$j.post(url,function(data){
				$j('.notibox .loader').hide();			//hide loader after response		 
				$j('.noticontent').append(data);		//append data from server to .noticontent box
			});
		} else {
			t.removeClass('notiactive');
			$j('.notibox').hide();
		}
		
		//this will hide user info drop down when visible
		$j('.userinfo').removeClass('userinfodrop');
		$j('.userdrop').hide();
		
		return false;
	});
	
	
	$j(document).click(function(event) {
		var ud = $j('.userdrop');
		var nb = $j('.notibox');
		
		//hide user drop menu when clicked outside of this element
		if(!$j(event.target).is('.userdrop') && ud.is(':visible')) {
			ud.hide();
			$j('.userinfo').removeClass('userinfodrop');
		}
		
		//hide notification box when clicked outside of this element
		if(!$j(event.target).is('.notibox') && nb.is(':visible')) {
			nb.hide();
			$j('.notialert').removeClass('notiactive');
		}
	});
	
	
	//notification box tab menu
	$j('.tabmenu a').click(function(){
		var url = $j(this).attr('href');
		
		//reset active menu
		$j('.tabmenu li').each(function(){
			$j(this).removeClass('current');
		});
		
		$j('.noticontent').empty();					//empty content first to display new data
		$j('.notibox .loader').show();
		$j(this).parent().addClass('current');		//add current class to menu
		$j.post(url,function(data){
			$j('.notibox .loader').hide();			
			$j('.noticontent').append(data);		//inject new data from server
		});
		return false;
	});
	
	
	// Widget Box Title on Hover event
	// show arrow image in the right side of the title upon hover
	$j('.widgetbox .title').hover(function(){
		if(!$j(this).parent().hasClass('uncollapsible'))									   
			$j(this).addClass('titlehover');
	}, function(){
		$j(this).removeClass('titlehover');
	});
	
	//show/hide widget content when widget title is clicked
	$j('.widgetbox .title').click(function(){
		if(!$j(this).parent().hasClass('uncollapsible')) {									   
			if($j(this).next().is(':visible')) {
				$j(this).next().slideUp('fast');
				$j(this).addClass('widgettoggle');
			} else {
				$j(this).next().slideDown('fast');
				$j(this).removeClass('widgettoggle');
			}
		}
	});
	
	// sub items accordio: shakti
	$j('.widgetcontent2 .subtitle').click(function(){
        if(!$j(this).parent().hasClass('uncollapsible')) {                                     
            if($j(this).next().is(':visible')) {
                $j(this).next().slideUp('fast');
                $j(this).addClass('widgettoggle');
                $j(this).removeClass('active');
            } else {
                $j(this).parent().parent().find('.widgetsubcontent:visible').slideUp('fast');
                $j(this).parent().parent().find('a.active').removeClass('active');
                $j(this).next().slideDown({duration: 800, easing: 'easeOutBounce'});
                $j(this).removeClass('widgettoggle');
                $j(this).addClass('active');
            }
        }
    });
    //$j('.widgetcontent2').stop().scrollTo( { top:0,left:0} , 1700, {easing:'easeOutElastic'} );
	
	//wrap menu to em when click will return to true
	//this code is required in order the code (next below this code) to work.
	$j('.leftmenu a span').each(function(){
		$j(this).wrapInner('<em />');
	});

	$j('.leftmenu a').click(function(e) {
										 
		var t = $j(this);								 
		var p = t.parent();
		var ul = p.find('ul');
		var li = $j(this).parents('.lefticon');
		
		//check if menu have sub menu
		if($j(this).hasClass('menudrop')) {
			
			//check if menu is collapsed
			if(!li.length > 0) {
				
				//check if sub menu is available
				if(ul.length > 0) {
					
					//check if menu is visible
					if(ul.is(':visible')) {
						ul.slideUp('fast');
						p.next().css({borderTop: '0'});
						t.removeClass('active');
					} else {
						ul.slideDown('fast');	
						p.next().css({borderTop: '1px solid #ddd'});
						t.addClass('active');
					}
				}
	
				if($j(e.target).is('em'))
					return true;
				else
					return false;
			} else {
				return true;	
			}
		
		//redirect to assigned link when menu does not have a sub menu
		} else {
			return true;
		}
	});
	
	//show tooltip menu when left menu is collapsed
	$j('.leftmenu a').hover(function(){
		if($j(this).parents('.lefticon').length > 0) {
			$j(this).next().stop(true,true).fadeIn();
		}
	},function(){
		if($j(this).parents('.lefticon').length > 0) {
			$j(this).next().stop(true,true).fadeOut();
		}
	});
	
	//show/hide left menu to switch into full/icon only menu
	$j('#togglemenuleft a').click(function(){
		if($j('.mainwrapper').hasClass('lefticon')) {
			$j('.mainwrapper').removeClass('lefticon');
			$j(this).removeClass('toggle');
			
			//remove all tooltip element upon switching to full menu view
			$j('.leftmenu a').each(function(){
				$j(this).next().remove();
			});
			
		} else {
			$j('.mainwrapper').addClass('lefticon');
			$j(this).addClass('toggle');
			
			showTooltipLeftMenu();
		}
	});
	
	function showTooltipLeftMenu() {
		//create tooltip menu upon switching to icon only menu view
		$j('.leftmenu a').each(function(){
			var text = $j(this).text();								//get the text
			$j(this).removeClass('active');							//reset when there is/are active menu upon switching to icon view
			$j(this).parent().attr('style','');						//clear style attribute to this menu
			$j(this).parent().find('ul').hide();					//hide sub menu when there is/are showed sub menu
			$j(this).after('<div class="menutip">'+text+'</div>');	//append menu tooltip
		});	
	}
	
	
	/** FLOAT LEFT SIDEBAR **/
	$j(document).scroll(function(){
		var pos = $j(document).scrollTop();
		if(pos > 50) {
			$j('.floatleft').css({position: 'fixed', top: '10px', right: '10px'});
		} else {
			$j('.floatleft').css({position: 'absolute', top: 0, right: 0});
		}
	});
	
	/** FLOAT RIGHT SIDEBAR **/
	$j(document).scroll(function(){
		if($j(this).width() > 580) {
			var pos = $j(document).scrollTop();
			if(pos > 50) {
				$j('.floatright').css({position: 'fixed', top: '10px', right: '10px'});
			} else {
				$j('.floatright').css({position: 'absolute', top: 0, right: 0});
			}
		}
	});
	
	
	//NOTIFICATION CLOSE BUTTON
	$j('.notification .close').click(function(){
		$j(this).parent().fadeOut();
	});
	
	
	//button hover
	$j('.btn').hover(function(){
		$j(this).stop().animate({backgroundColor: '#eee'}, 100);
	},function(){
		$j(this).stop().animate({backgroundColor: '#f7f7f7'});
	});
	
	//standard button hover
	$j('.stdbtn').hover(function(){
		$j(this).stop().animate({opacity: 0.85}, 100);
	},function(){
		$j(this).stop().animate({opacity: 1});
	});
	
	//buttons in error page
	$j('.errorWrapper a').hover(function(){
		$j(this).switchClass('default','hover');
	},function(){
		$j(this).switchClass('hover', 'default');
	});
	
	
	//screen resize
	var TO = false;
	$j(window).resize(function(){
		if($j(this).width() < 1024) {
			$j('.mainwrapper').addClass('lefticon');
			$j('#togglemenuleft').hide();
			$j('.mainright').insertBefore('.footer');
			
			showTooltipLeftMenu();
			
			if($j(this).width() <= 580) {
				$j('.stdtable').wrap('<div class="tablewrapper"></div>');
				
				if($j('.headerinner2').length == 0)
					insertHeaderInner2();
			} else {
				removeHeaderInner2();
			}
			
		} else {
			toggleLeftMenu();
			removeHeaderInner2();
		}
		
	});	
		
	if($j(window).width() < 1024) {
		$j('.mainwrapper').addClass('lefticon');
		$j('#togglemenuleft').hide();
		$j('.mainright').insertBefore('.footer');
		
		showTooltipLeftMenu();
		
		if($j(window).width() <= 580) {
			$j('table').wrap('<div class="tablewrapper"></div>');
			insertHeaderInner2();
		}
			
	} else {
		toggleLeftMenu();
	}
	
	function toggleLeftMenu() {
		if(!$j('.mainwrapper').hasClass('lefticon')) {
			$j('.mainwrapper').removeClass('lefticon');
			$j('#togglemenuleft').show();
		} else {
			$j('#togglemenuleft').show();
			$j('#togglemenuleft a').addClass('toggle');
		}	
	}
	
	function insertHeaderInner2() {
		$j('.headerinner').after('<div class="headerinner2"></div>');
		$j('#searchPanel').appendTo('.headerinner2');
		$j('#userPanel').appendTo('.headerinner2');
		$j('#userPanel').addClass('userinfomenu');
	}
	
	function removeHeaderInner2() {
		$j('#searchPanel').insertBefore('#notiPanel');
		$j('#userPanel').insertAfter('#notiPanel');
		$j('#userPanel').removeClass('userinfomenu');
		$j('.headerinner2').remove();
	}
	
	//autocomplete
	var availableTags = [
			"ActionScript",
			"AppleScript",
			"Asp",
			"BASIC",
			"C",
			"C++",
			"Clojure",
			"COBOL",
			"ColdFusion",
			"Erlang",
			"Fortran",
			"Groovy",
			"Haskell",
			"Java",
			"JavaScript",
			"Lisp",
			"Perl",
			"PHP",
			"Python",
			"Ruby",
			"Scala",
			"Scheme"
		];
	$j( "#keyword" ).autocomplete({
		source: availableTags
	});	
	
});


// function to disable text selection
(function($){

    $.fn.disableSelection = function() {
        return this.each(function() {           
            $(this).attr('unselectable', 'on')
                   .css({'-moz-user-select':'none',
                        '-o-user-select':'none',
                        '-khtml-user-select':'none',
                        '-webkit-user-select':'none',
                        '-ms-user-select':'none',
                        'user-select':'none'})
                   .each(function() {
                        this.onselectstart = function() { return false; };
                   });
       });
    };

})(jQuery);


/*
  jQuery utils - @VERSION
  http://code.google.com/p/jquery-utils/

  (c) Maxime Haineault <haineault@gmail.com>
  http://haineault.com

  MIT License (http://www.opensource.org/licenses/mit-license.php

*/

(function($){
    $.extend({
        // Taken from ui.core.js.        
        keyCode: {
            BACKSPACE: 8, CAPS_LOCK: 20, COMMA: 188, CONTROL: 17, DELETE: 46, DOWN: 40,
            END: 35, ENTER: 13, ESCAPE: 27, HOME: 36, INSERT:  45, LEFT: 37,
            NUMPAD_ADD: 107, NUMPAD_DECIMAL: 110, NUMPAD_DIVIDE: 111, NUMPAD_ENTER: 108,
            NUMPAD_MULTIPLY: 106, NUMPAD_SUBTRACT: 109, PAGE_DOWN: 34, PAGE_UP: 33,
            PERIOD: 190, RIGHT: 39, SHIFT: 16, SPACE: 32, TAB: 9, UP: 38
        }           
   });
})(jQuery);


//==========SHAKTI===========HERE ONWARDS

// commonly used functions
var dataType=[];
dataType['integer']         = /^(0|[1-9]+[0-9]*)$/;
dataType['positive_integer']= /^([1-9]+[0-9]*)$/;
dataType['float']           = /^((\.)|(\.[0-9]*)|(0\.?)|(0\.[0-9]*)|([1-9]+[0-9]*\.?)|([1-9]+[0-9]*\.[0-9]*))$/;        
dataType['number']          = /^\d+$/;
dataType['currency2']       = /^((\.)|(\.[0-9]{0,2})|(0\.?)|(0\.[0-9]{0,2})|([1-9]+[0-9]*\.?)|([1-9]+[0-9]*\.[0-9]{0,2}))$/;
dataType['currency5']       = /^((\.)|(\.[0-9]{0,5})|(0\.?)|(0\.[0-9]{0,5})|([1-9]+[0-9]*\.?)|([1-9]+[0-9]*\.[0-9]{0,5}))$/;
dataType['phone']           = /^[0-9]{6,15}$/;      
dataType['common']          = /^[A-Za-z0-9_]+$/;

//validate email address
function isEmail(str){  
    str = $j.trim(str);
    if(str.length){
        return dataType['email'].test(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/);
    }
}

//redirect
function redirect(url){ 
    document.location = url;
}

//validate date format
function isDate(date_value, format) {
    var mo, day, yr;
    
    if(typeof format == 'undefined' || format == null)
        var re = /\b\d{4}[\/-]\d{1,2}[\/-]\d{1,2}\b/;
    else if(format == 1)
        var re = /\b\d{4}[\/-]\d{1,2}[\/-]\d{1,2}\b/;
    else if(format == 2)
        var re = /\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/;
            
    return re.test(date_value)
}

function isTime(time) {    
    re = /^((0?[1-9]|1[012])(:[0-5]\d){0,2}(\ [AP]M))$|^([01]\d|2[0-3])(:[0-5]\d){0,2}$/
    return re.test(time)
}

function isPrice(price){        
    var pattern= /^[0-9]+(\.[0-9]+)?$/
    return (price.match(pattern)) ? true : false;
}

function isNumeric(str){        
    var pattern= /^[0-9]+$/
    return (str.match(pattern)) ? true : false;
}
    
function isWebUrl(url){
        
    var pattern= /^(http|https):\/\/(www\.)?([A-Za-z0-9\-]+)+(\.[a-z]{1,4})(\/[a-z0-9A-Z\s\-\?\.\=\&]+)*(\/)?$/
    if (url.match(pattern)){        
        return true;
    }else{
        return false; 
    }
}

function isPhone(str){
    var bracket_flag=-1;
    for(i = 0; i < str.length; i++){
        mychar = str.charAt(i);
        if((mychar >= "0" && mychar <= "9") || mychar == "-" || mychar == "+" || mychar == "(" || mychar == ")")
        {
            if(mychar == "+" && i!=0)           return false;
            if(mychar == "-" && i==0)           return false;
            if(mychar == ")" && i<2)            return false;
            if(mychar == "(")                   bracket_flag=0;
            if(mychar == ")")
                if(bracket_flag==0)             bracket_flag=1;
                else                            return false;
            
        } 
        else
            return false; 
    }
    
    return true;
}

function checkEnter(e){ //e is event object passed from function invocation
    var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : e.which  ? e.which : 0; 
    return key == 13 ? true : false; //if generated character code is equal to ascii 13 (if enter key)
}

//capitalize the first character of each word in the string
function ucwords(str){
    
    if(!empty(str)){
        splitted = str.split(' ');
        space = result = '';
        for(i=0; i<splitted.length; i++){
            s = splitted[i] ;
            
                if(s.length == 1)
                    result += space+s.substring(0, 1).toUpperCase();
                else
                    result += space+s.substring(0, 1).toUpperCase()+s.substring(1, s.length);
                space = ' ';
                
        }
        return ltrim(result);
    }
}

function isEmpty(obj, trim){
    if(typeof trim == 'undefined') trim = true;
    var testVal = trim ? $j.trim(obj.val()):obj.val();
    if(obj.attr('tg_default'))
        return testVal == obj.attr('tg_default');
    else
        return testVal == '';
}

//innerttrim :: replace multiple spaces with a single space
function innerTrim(str)
{
    return str.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
}


//http://www.bloggingdeveloper.com?author=bloggingdeveloper 
//var author_value = getQuerystring('author'); 
function getQuerystring(key, default_)
{
  if (default_==null) default_="";
  key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
  var qs = regex.exec(window.location.href);
  if(qs == null)
    return default_;
  else
    return qs[1];
} 

//serialize form field values info object which can further be converted into json format
$j.fn.serializeObject = function(jsonify)
{
   if(typeof jsonify != 'undefined') jsonify = true;
    var o = {};
    var a = this.serializeArray();
    $j.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return jsonify?$j.parseJSON(JSON.stringify(o)):o;
};


// captcha refeshing
function refreshCap(imgSelector, txtboxSelector){
     $j(imgSelector).attr('src', ($j(imgSelector).attr('src').replace(/\&[0-9\.]+/g, ''))+'&'+Math.random());   
     $j(txtboxSelector).val('').focus();
}

//◘ element attribute toggler ◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘◘
function tgAttribs(selector, type){
    obj = $j(selector);
    
    switch(type){
        case 'disabled': (obj.is(':disabled')) ? obj.removeAttr('disabled') : obj.attr('disabled', 'disabled'); break;
        case 'selected': (obj.is(':selected')) ? obj.removeAttr('selected') : obj.attr('selected', 'selected'); break;
        case 'visible': (obj.is(':visible')) ? obj.hide() : obj.show(); break;
    }
    
}

//reset and bind event for toggling default values in form fields
function resetForm(formObj){
    $j(formObj).each(function(){
          this.reset();
    }); 
}


//generate slug for the admin panel cms
function generateSlug(sourceObj, targetObj, t, keyid){
    if($j.trim(sourceObj.value) != ''){  
        $j.ajax({
            url: '../../handle_ajax.php',
            type: 'post',
            data: {'req': 'slug', 't': t, 'v':sourceObj.value, 'xkey' : (keyid ? keyid : '')},
            dataType: 'json',
            success: function(r){
                if(r.exists){
                    alert('The slug already exists. Please try a different slug by yourself.');
                }else{
                    targetObj.value = r.slug;
                }
            }   
        })
    }
}



/********************CREDIT CARD NUMBER VALIDATION RULES*************************/
/*
This routine checks the credit card number. The following checks are made:
1. A number has been provided
2. The number is a right length for the card
3. The number has an appropriate prefix for the card
4. The number has a valid modulus 10 number check digit if required
Parameters:
            cardnumber           number on the card
            cardname             name of card as defined in the card list below

   If a credit card number is invalid, an error reason is loaded into the 
   global ccErrorNo variable. This can be be used to index into the global error  
   string array to report the reason to the user if required:
   
   e.g. if (!checkCreditCard (number, name) alert (ccErrors(ccErrorNo);
*/

var ccErrorNo = 0;
var ccErrors = new Array ()

ccErrors [0] = "Unknown card type";
ccErrors [1] = "No card number provided";
ccErrors [2] = "Credit card number is not in valid format";
ccErrors [3] = "Credit card number is invalid";
ccErrors [4] = "Credit card number has an inappropriate number of digits";

function checkCreditCard (cardnumber, cardname) {
     
    // Array to hold the permitted card characteristics
    var cards = new Array();
    
    // Define the cards we support. You may add addtional card types.   
    //  Name:      As in the selection box of the form - must be same as user's
    //  Length:    List of possible valid lengths of the card number for the card
    //  prefixes:  List of possible prefixes for the card
    //  checkdigit Boolean to say whether there is a check digit
    
    cards [0] = {name: "Visa",              length: "13,16",    prefixes: "4",              checkdigit: true};
    cards [1] = {name: "Master Card",       length: "16",       prefixes: "51,52,53,54,55", checkdigit: true};
    cards [2] = {name: "Diners Club",       length: "14,16",    prefixes: "300,301,302,303,304,305,36,38,55", checkdigit: true};
    cards [3] = {name: "Carte Blanche",     length: "14",       prefixes: "300,301,302,303,304,305,36,38", checkdigit: true};
    cards [4] = {name: "American Express",  length: "15",       prefixes: "34,37",          checkdigit: true};
    cards [5] = {name: "Discover",          length: "16",       prefixes: "6011,650",       checkdigit: true};
    cards [6] = {name: "JCB",               length: "15,16",    prefixes: "3,1800,2131",    checkdigit: true};
    cards [7] = {name: "enRoute",           length: "15",       prefixes: "2014,2149",      checkdigit: true};
    cards [8] = {name: "Solo",              length: "16,18,19", prefixes: "6334, 6767",     checkdigit: true};
    cards [9] = {name: "Switch",            length: "16,18,19", prefixes: "4903,4905,4911,4936,564182,633110,6333,6759", checkdigit: true};
    cards [10] = {name: "Maestro",          length: "16",       prefixes: "5020,6",         checkdigit: true};
    cards [11] = {name: "Visa Electron",    length: "16",       prefixes: "417500,4917,4913", checkdigit: true};
               
    // Establish card type
    var cardType = -1;
    for (var i=0; i<cards.length; i++) {
    
        // See if it is this card (ignoring the case of the string)
        if (cardname.toLowerCase () == cards[i].name.toLowerCase()) {
            cardType = i;
            break;
        }
    }
    
    // If card type not found, report an error
    if (cardType == -1) {
        ccErrorNo = 0;      
        return false; 
    }
    
    // Ensure that the user has provided a credit card number
    if (cardnumber.length == 0)  {
        ccErrorNo = 1;
        return false; 
    }
    
     // Now remove any spaces from the credit card number
    cardnumber = cardnumber.replace (/\s/g, "");
  
    // Check that the number is numeric
    var cardNo = cardnumber
    var cardexp = /^[0-9]{13,19}$/;
    if (!cardexp.exec(cardNo))  {
        ccErrorNo = 2;
        return false; 
    }
       
    // Now check the modulus 10 check digit - if required
    if (cards[cardType].checkdigit) {
        var checksum = 0;                                  // running checksum total
        var mychar = "";                                   // next char to process
        var j = 1;                                         // takes value of 1 or 2
    
        // Process each digit one by one starting at the right
        var calc;
        for (i = cardNo.length - 1; i >= 0; i--) {
    
            // Extract the next digit and multiply by 1 or 2 on alternative digits.
            calc = Number(cardNo.charAt(i)) * j;
    
            // If the result is in two digits add 1 to the checksum total
            if (calc > 9) {
                checksum = checksum + 1;
                calc = calc - 10;
            }
    
            // Add the units element to the checksum total
            checksum = checksum + calc;
    
            // Switch the value of j
            if (j ==1) {j = 2} else {j = 1};
        } 
    
        // All done - if checksum is divisible by 10, it is a valid modulus 10.
        // If not, report an error.
        if (checksum % 10 != 0)  {
            ccErrorNo = 3;
            return false; 
        }
    }  

    // The following are the card-specific checks we undertake.
    var LengthValid = false;
    var PrefixValid = false; 
    var undefined; 
    
    // We use these for holding the valid lengths and prefixes of a card type
    var prefix = new Array ();
    var lengths = new Array ();
    
    // Load an array with the valid prefixes for this card
    prefix = cards[cardType].prefixes.split(",");
      
    // Now see if any of them match what we have in the card number
    for (i=0; i<prefix.length; i++) {
        var exp = new RegExp ("^" + prefix[i]);
        if (exp.test (cardNo)) PrefixValid = true;
    }
      
    // If it isn't a valid prefix there's no point at looking at the length
    if (!PrefixValid) {
        ccErrorNo = 3;
        return false; 
    }
    
    // See if the length is valid for this card
    lengths = cards[cardType].length.split(",");
    for (j=0; j<lengths.length; j++) {
        if (cardNo.length == lengths[j]) LengthValid = true;
    }
  
    // See if all is OK by seeing if the length was valid. We only check the 
    // length if all else was hunky dory.
    if (!LengthValid) {
        ccErrorNo = 4;
        return false; 
    };   
  
    // The credit card is in the required format.
    return true;
}
/*============================================================================*/

/*
 * Encode and Decode taken from 
 * http://scriptasylum.com/tutorials/encode-decode.html 
 */

// DECODES AND UNESCAPES ALL TEXT.
function decodeTxt(s, encN){
    var s1=unescape(s.substr(0,s.length));
    var t='';
    for(i=0;i<s1.length;i++) t+=String.fromCharCode(s1.charCodeAt(i)-parseInt(encN));
    return unescape(t);
}

// ENCODES, IN UNICODE FORMAT, ALL TEXT AND THEN ESCAPES THE OUTPUT
// encN is encoding type whose value ranges from 1-5: 
function encodeTxt(s, encN){
    s=escape(s);
    var ta=new Array();
    for(i=0;i<s.length;i++)  ta[i]=s.charCodeAt(i)+parseInt(encN);
    return ""+escape(eval("String.fromCharCode("+ta+")"));
}


// CONVERTS *ALL* CHARACTERS INTO ESCAPED VERSIONS.
function escapeTxt(os){
    var ns='';
    var t;
    var chr='';
    var cc='';
    var tn='';
    for(i=0;i<256;i++){
        tn=i.toString(16);
        if(tn.length<2)tn="0"+tn;
        cc+=tn;
        chr+=unescape('%'+tn);
    }
    cc=cc.toUpperCase();
    os.replace(String.fromCharCode(13)+'',"%13");
    for(q=0;q<os.length;q++){
        t=os.substr(q,1);
        for(i=0;i<chr.length;i++){
            if(t==chr.substr(i,1)){
                t=t.replace(chr.substr(i,1),"%"+cc.substr(i*2,2));
                i=chr.length;
            }
        }
    ns+=t;
    }
    return ns;
}


// SIMPLY UNESCAPES TEXT (ONLY INCLUDED TO MAKE A COMPLEMENTARY FUNCTION FOR escapeTxt()
function unescapeTxt(s){
    return unescape(s);
}


/*----------------------------------------------------------------------------------*/




/*
* jQuery.ajaxQueue - A queue for ajax requests* 
* (c) 2011 Corey Frang*
* Requires jQuery 1.5+
*/ 
(function($) {

    // jQuery on an empty object, we are going to use this as our Queue
    var ajaxQueue = $({});
    
    $.ajaxQueue = function( ajaxOpts ) {
        var jqXHR, dfd = $.Deferred(), promise = dfd.promise();    
        // queue our ajax request
        ajaxQueue.queue( doRequest );    
        // add the abort method
        promise.abort = function( statusText ) {    
            // proxy abort to the jqXHR if it is active
            if ( jqXHR ) return jqXHR.abort( statusText );    
            // if there wasn't already a jqXHR we need to remove from queue
            var queue = ajaxQueue.queue(), index = $.inArray( doRequest, queue );    
            if ( index > -1 ) queue.splice( index, 1 );    
            // and then reject the deferred
            dfd.rejectWith( ajaxOpts.context || ajaxOpts, [ promise, statusText, "" ] );    
            return promise;
        };
    
        // run the actual query
        function doRequest( next ) {
            jqXHR = $.ajax( ajaxOpts ).then( next, next ).done( dfd.resolve ).fail( dfd.reject );
        }    
        return promise;
    };

})(jQuery);