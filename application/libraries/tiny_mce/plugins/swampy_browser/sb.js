if(typeof _base_url == 'undefined' && typeof base_url() != 'undefined'){
    _base_url = base_url();
}
var browser_url = _base_url+"application/libraries/tiny_mce/plugins/swampy_browser/";

var fieldName = null;
var wind = null;

function openSwampyBrowser(field_name, url, type, win)
{
	wind = win;
	fieldName = field_name;

	var height = 650;
	var width = 1027;

	var top=Math.round((screen.height-height)/2);
	var left=Math.round(screen.width/2);

	var params = "top="+top+",left="+left+",width="+width+",height="+height+",buttons=no,scrollbars=no,location=no,menubar=no,resizable=no,status=no,directories=no,toolbar=no";

	var wnd = window.open(browser_url, name,  params);
	wnd.focus();
}  

function insertURL(url)
{
    var strLen = _base_url.length;
    _base_url = _base_url.slice(0,strLen-1);
	wind.document.getElementById(fieldName).value = _base_url+url;
}