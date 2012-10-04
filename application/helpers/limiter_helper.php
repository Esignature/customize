<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('titleLimit'))
{
	function titleLimit($title='', $maxlength=200, $trail='..', $strip=false)
	{
		$ret = $title;
		$len = mb_strlen($title);
		if($len > $maxlength) {
			if($strip == true){
				$ret = strip_tags($title);
			}
			$ret = mb_substr($title, 0, $maxlength).$trail;
		}
		return $ret;
	}
}


if ( ! function_exists('truncate'))
{
    /**
	* Truncates text.
	*
	* Cuts a string to the length of $length and replaces the last characters
	* with the ending if the text is longer than length.
	*
	* @param string $text String to truncate.
	* @param integer $length Length of returned string, including ellipsis.
	* @param string $ending Ending to be appended to the trimmed string.
	* @param boolean $exact If false, $text will not be cut mid-word
	* @param boolean $considerHtml If true, HTML tags would be handled correctly
	* @return string Trimmed string.
	*/
	function truncate($text, $length = 100, $ending = '...', $exact = true, $considerHtml = true) {
		if ($considerHtml) {
			// if the plain text is shorter than the maximum length, return the whole text
			if (mb_strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
				return $text;
			}
			
			// splits all html-tags to scanable lines
			preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
			
			$total_length = strlen($ending);
			$open_tags = array();
			$truncate = '';
			
			foreach ($lines as $line_matchings) {
				// if there is any html-tag in this line, handle it and add it (uncounted) to the output
				if (!empty($line_matchings[1])) {
					// if it's an "empty element" with or without xhtml-conform closing slash (f.e. <br/>)
					if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
					// do nothing
					// if tag is a closing tag (f.e. </b>)
					} else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
						// delete tag from $open_tags list
						$pos = array_search($tag_matchings[1], $open_tags);
						if ($pos !== false) {
						unset($open_tags[$pos]);
						}
						// if tag is an opening tag (f.e. <b>)
					} else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
						// add tag to the beginning of $open_tags list
						array_unshift($open_tags, mb_strtolower($tag_matchings[1]));
					}
					// add html-tag to $truncate'd text
					$truncate .= $line_matchings[1];
				}
				
				// calculate the length of the plain text part of the line; handle entities as one character
				$content_length = mb_strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
				if ($total_length+$content_length > $length) {
					// the number of characters which are left
					$left = $length - $total_length;
					$entities_length = 0;
					// search for html entities
					if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
						// calculate the real length of all entities in the legal range
						foreach ($entities[0] as $entity) {
							if ($entity[1]+1-$entities_length <= $left) {
								$left--;
								$entities_length += mb_strlen($entity[0]);
							} else {
								// no more characters left
								break;
							}
						}
					}
					$truncate .= mb_substr($line_matchings[2], 0, $left+$entities_length);
					// maximum lenght is reached, so get off the loop
					break;
				} else {
					$truncate .= $line_matchings[2];
					$total_length += $content_length;
				}
				
				// if the maximum length is reached, get off the loop
				if($total_length >= $length) {
				break;
				}
			}
		} else {
			if (mb_strlen($text) <= $length) {
				return $text;
			} else {
				$truncate = mb_substr($text, 0, $length - strlen($ending));
			}
		}
		
		// if the words shouldn't be cut in the middle...
		if (!$exact) {
		// ...search the last occurance of a space...
		$spacepos = mb_strrpos($truncate, ' ');
		if (isset($spacepos)) {
		// ...and cut the text in this position
		$truncate = mb_substr($truncate, 0, $spacepos);
		}
		}
		
		// add the defined ending to the text
		$truncate .= $ending;
		
		if($considerHtml) {
		// close all unclosed html-tags
		foreach ($open_tags as $tag) {
		$truncate .= '</' . $tag . '>';
		}
		}
		$lastpos=mb_strrpos($truncate,' ');
		return mb_substr($truncate,0,$lastpos);
	
	}
	
}

if(!function_exists('truncateStr')){
	function truncateStr($str, $l, $multibyte=false){
		$str = trim($str);
		if($str != ''){
			if($multibyte){				
				if(mb_strlen($str) <= $l)
					return $str;
				else
					return mb_substr($str,0,$l).'...';	
			}else{
				if(strlen($str) <= $l)
					return $str;
				else
					return substr($str,0,$l).'...';
			}
		}	
	}
}

if(!function_exists('ago')){
	function ago($d, $dateOnly = false) {
		$c = getdate();
		if(!$dateOnly){
			$p = array('year', 'mon', 'mday', 'hours', 'minutes', 'seconds');
			$display = array('year', 'month', 'day', 'hour', 'minute', 'second');
		}else{
			$p = array('year', 'mon', 'mday');
			$display = array('year', 'month', 'day');			
		}
		$factor = array(0, 12, 30, 24, 60, 60);
		$d = datetoarr($d);
		if(!$dateOnly){
			for($w = 0; $w < 6; $w++) {
				if($w > 0) {
				   $c[$p[$w]] += $c[$p[$w-1]] * $factor[$w];
				   $d[$p[$w]] += $d[$p[$w-1]] * $factor[$w];
				}
				if($c[$p[$w]] - $d[$p[$w]] > 1) { 				
					return ($c[$p[$w]] - $d[$p[$w]]).' '.$display[$w].'s ago';
				}
			}
		}else{
			for($w = 0; $w < 3; $w++) {
				if($w > 0) {
				   $c[$p[$w]] += $c[$p[$w-1]] * $factor[$w];
				   $d[$p[$w]] += $d[$p[$w-1]] * $factor[$w];
				}
				if($c[$p[$w]] - $d[$p[$w]] > 1) { 				
					return ($c[$p[$w]] - $d[$p[$w]]).' '.$display[$w].'s ago';
				}
			}
		}
		return 'Today';
	}
}

if(!function_exists('datetoarr')){
	function datetoarr($d) {
		preg_match("/([0-9]{4})(\\-)([0-9]{2})(\\-)([0-9]{2}) ([0-9]{2})(\\:)([0-9]{2})(\\:)([0-9]{2})/", $d, $matches);
		return array( 
			  'seconds' => $matches[10], 
			  'minutes' => $matches[8], 
			  'hours' => $matches[6],  
			  'mday' => $matches[5], 
			  'mon' => $matches[3],  
			  'year' => $matches[1], 
		 );
	}
}

if(!function_exists('compareevents')){
	function compareevents($today,$com_date) {
	
		$today = @explode('-', $today);
		$today = @mktime(0, 0, 0, $today[1], $today[2], $today[0]);  
		
		$com_date=@explode(" ",$com_date);
		$com_date=@$com_date[0];
		$com_date = @explode('-', $com_date);
		$com_date = @mktime(0, 0, 0, $com_date[1], $com_date[2], $com_date[0]);  
		
		if($com_date>$today){
			echo 'Upcoming';
		}
		else if($com_date==$today){
			echo 'Today';
		}
		else{
			echo "Past";
		}
	}
}
if(!function_exists('convertfulldate')){
	function convertfulldate($date) {
	
		return strftime("%a %d %b %Y", strtotime($date));
	}
}
if(!function_exists('completehour')){
	function completehour($fld,$sel) {
		$i=0;
		
		$res="<select name='".$fld."' id='".$fld."' class='input medium width-inp-num'>";
		$res.="<option value='' >Select Hour</option>";	
		  
		while($i<=23){
			$selme='';
			if($i==$sel){
				$selme='selected="selected"';
				}
			$res.='<option '.$selme.' value="'.$i.'">'.dotwodigits($i).'</option>';
			$i++;
		}
		$res.='</select>';
		return $res;
	}
}
if(!function_exists('completeminutes')){
	function completeminutes($fld,$sel) {
	
		$i=0;
		
		$res="<select name='".$fld."' id='".$fld."' class='input medium width-inp-num'>";
		$res.="<option value='' >Select Minute</option>";
		$selme='';	  
		while($i<=59){
			$selme='';
			if($i==$sel){
				$selme='selected="selected"';
				}
			$res.='<option '.$selme.' value="'.$i.'">'.dotwodigits($i).'</option>';
			$i++;
		}
		$res.='</select>';
		return $res;
	}
}
if(!function_exists('todaydate')){
	function todaydate($time=true) {
		if($time){
			return date('Y-m-d H:i:s');
		}
		else{
			return date('Y-m-d');
		}
	}
}
if(!function_exists('getdateval')){
	function getdateval($date,$get="") {
		$getDate=@explode(" ",$date);
		$completeDate=@convertfulldate($getDate[0]);
	//return $date;
		if($get=="hour"){
			return @date("g:i a", strtotime($getDate[1])) ;
		}
		else{
			return $completeDate;
		}
		
		 
	}
}

if(!function_exists('dotwodigits')){
	function dotwodigits($val) 
	{
		if (intval($val) < 10) {
			$twodigits = "0$val";
		}
		else if (intval($val) >= 10) {
			$twodigits = $val;
		}
		return $twodigits;
	}
}
if(!function_exists('getpassedtime')){
	function getpassedtime($post_date) 
	{
			$post_date = strtotime($post_date);
			$now = time();
			return @timespan($post_date, $now);
	}
}
if(!function_exists('embedvideo')){
	function embedvideo($video,$width=560,$height=450) 
	{
		$video=convvidsrc($video);
			$vid='<div class="emfield-emvideo emfield-emvideo-youtube"><div id="emvideo-youtube-flash-wrapper-2">
						<object type="application/x-shockwave-flash" height="'.$height.'" width="'.$width.'" data="'.$video.'?modestbranding=1&version=3&autoplay=0&rel=0&fs=1&border=0&loop=0" id="emvideo-youtube-flash-2">
							<param name="movie" value="'.$video.'" />
							<param name="quality" value="best"/>
							<param name="allowFullScreen" value="true"/>
							<param name="bgcolor" value="#FFFFFF"/>
							<param name="wmode" value="transparent" />
							<embed src="'.$video.'?modestbranding=1&version=3&autoplay=0&rel=0&fs=1&border=0&loop=0" wmode="transparent" type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'" allowfullscreen="true"></embed>
						</object>
					</div></div>';
					return $vid;
	}
}
if(!function_exists('convertsectomins')){
	function convertsectomins($seconds) 
	{
			if ($seconds > 0) {
				$mins = floor ($seconds / 60);
				$secs = $seconds % 60;
				if($mins<10){
					$mins="0".$mins;
				}
				if($secs<10){
					$secs="0".$secs;
				}
				return $mins.':'.$secs;
        }
	}
}
if(!function_exists('convertminstosecs')){
	function convertminstosecs($minutes) 
	{		
		if($minutes!=""){
				list($mins,$secs)=@explode(':',$minutes);
				if($mins!=""){
					$mins=$mins*60;
				}
				$seconds=$mins+$secs;
				return $seconds;
		}
	}
}
if(!function_exists('convvidsrc')){
	function convvidsrc($code) 
	{		
	//echo $code;
		//preg_match('/src=(["\'])(.*?)\1/', $code, $match);
		$getval=end(explode("?v=",$code));
		$getval_2=@end(explode(".com/v/",$code));
		if($getval!="" and $getval!=$code){
			$conv="http://www.youtube.com/v/".$getval;
			return $conv;
		}
		else if($getval_2!="" and $getval_2!=$code){
			$conv="http://www.youtube.com/v/".$getval_2;
			return $conv;
		}
		else{
			return false;
		}
	}
}


if(!function_exists('userBoxTop')){
	function userBoxTop() 
	{	
	    $ret = '133px;';
	    $router =& load_class('Router');
        $controller = strtolower($router->fetch_class());
        $action     = strtolower($router->fetch_method()); 
		
		// Form an associative array for having a different 
		// Top value for user drop box..
		$index = array();
		$index[] = 'news__index';
		$index[] = 'article__index';
		$index[] = 'artist__index';
		$index[] = 'interview__index';
		$index[] = 'events__index';
		$index[] = 'gallery__index';
		$index[] = 'gallery__detail';
		$index[] = 'gallery__photo';
		$index[] = 'videos__index';
		$index[] = 'crbt__index';
		$index[] = 'itunes__index';
		$index[] = 'song__index';
		$index[] = 'album__index';
		$index[] = 'search__index';
		
		if(in_array($controller.'__'.$action, $index)) 
		{
			$ret = '191px;';
		}

	    return $ret;
	}
}


if ( ! function_exists('dialcode'))
{
	function dialcode()
	{
		$codes = array(		
			'Afghanistan'=>'+93',
			'Albania'=>'+355',
			'Algeria'=>'+213',
			'Andorra'=>'+376',
			'Angola'=>'+244',
			'Antigua and Barbuda'=>'+1268',
			'Argentina'=>'+54',
			'Armenia'=>'+374',
			'Aruba'=>'+297',
			'Australia'=>'+61',
			'Austria'=>'+43',
			'Azerbaijan'=>'+994',
			'Bahamas'=>'+1242',
			'Bahrain'=>'+973',
			'Bangladesh'=>'+880',
			'Barbados'=>'+1246',
			'Belarus'=>'+375',
			'Belgium'=>'+32',
			'Belize'=>'+501',
			'Benin'=>'+229',
			'Bermuda'=>'+1441',
			'Bhutan'=>'+975',
			'Bolivia'=>'+591',
			'Bosnia and Herzegovina'=>'+387',
			'Botswana'=>'+267',
			'Brazil'=>'+55',
			'Brunei Darussalam'=>'+673',
			'Bulgaria'=>'+359',
			'Burkina Faso'=>'+226',
			'Burundi'=>'+257',
			'Cambodia'=>'+855',
			'Cameroon'=>'+237',
			'Canada'=>'+1',
			'Chad'=>'+235',
			'Chile'=>'+56',
			'China'=>'+86',
			'Colombia'=>'+57',
			'Comoros'=>'+269',
			'Congo'=>'+243',
			'Costa Rica'=>'+506',
			'Croatia'=>'+385',
			'Cuba'=>'+53',
			'Cyprus'=>'+357',
			'Cyprus'=>'+357',
			'Czech Republic'=>'+420',
			'Denmark'=>'+45',
			'Dominica'=>'+1767',
			'Ecuador'=>'+593',
			'Egypt'=>'+20',
			'El Salvador'=>'+503',
			'Equatorial Guinea'=>'+240',
			'Eritrea'=>'+291',
			'Estonia'=>'+372',
			'Ethiopia'=>'+251',
			'Falkland Islands'=>'+5+',
			'Fiji'=>'+679',
			'Finland'=>'+358',
			'France'=>'+33',
			'French Guyana'=>'+594',
			'Gabon'=>'+241',
			'Gambia'=>'+220',
			'Georgia'=>'+995',
			'Germany'=>'+49',
			'Ghana'=>'+233',
			'Gibraltar'=>'+350',
			'Glorios Islands'=>'+262',
			'Greece'=>'+30',
			'Greenland'=>'+299',
			'Grenada'=>'+1473',
			'Guadeloupe'=>'+590',
			'Guam'=>'+1671',
			'Guatemala'=>'+502',
			'Guernsey'=>'+44',
			'Guinea'=>'+224',
			'Guinea-Bissau'=>'+245',
			'Guyana'=>'+592',
			'Haiti'=>'+509',
			'Honduras'=>'+504',
			'Hong Kong'=>'+852',
			'Hungary'=>'+36',
			'Iceland'=>'+354',
			'India'=>'+91',
			'Indonesia'=>'+62',
			'Iran'=>'+98',
			'Iraq'=>'+964',
			'Ireland'=>'+353',
			'Israel'=>'+972',
			'Italy'=>'+39',
			'Ivory Coast'=>'+225',
			'Jamaica'=>'+1876',
			'Jan Mayen'=>'+47',
			'Japan'=>'+81',
			'Jarvis Island'=>'+1',
			'Jersey'=>'+44',
			'Jordan'=>'+962',
			'Kazakhstan'=>'+7',
			'Kenya'=>'+254',
			'Kosovo'=>'+381',
			'Kuwait'=>'+965',
			'Kyrgyzstan'=>'+996',
			'Laos'=>'+856',
			'Latvia'=>'+371',
			'Lebanon'=>'+961',
			'Liberia'=>'+231',
			'Libya'=>'+218',
			'Luxembourg'=>'+352',
			'Macao'=>'+853',
			'Macedonia'=>'+389',
			'Madagascar'=>'+261',
			'Malawi'=>'+265',
			'Malaysia'=>'+60',
			'Maldives'=>'+960',
			'Mali'=>'+223',
			'Malta'=>'+356',
			'Mauritius'=>'+230',
			'Mexico'=>'+52',
			'Monaco'=>'+377',
			'Mongolia'=>'+976',
			'Montenegro'=>'+382',
			'Montserrat'=>'+1664',
			'Morocco'=>'+212',
			'Mozambique'=>'+258',
			'Myanmar'=>'+95',
			'Namibia'=>'+264',
			'Nauru'=>'+674',
			'Navassa Island'=>'+1',
			'Nepal'=>'+977',
			'Netherlands'=>'+31',
			'New Zealand'=>'+64',
			'Niger'=>'+227',
			'Nigeria'=>'+234',
			'North Korea'=>'+82',
			'Norway'=>'+47',
			'Oman'=>'+968',
			'Pakistan'=>'+92',
			'Palau'=>'+680',
			'Palestine'=>'+972',
			'Panama'=>'+507',
			'Papua New Guinea'=>'+675',
			'Paraguay'=>'+595',
			'Peru'=>'+51',
			'Philippines'=>'+63',
			'Poland'=>'+48',
			'Portugal'=>'+351',
			'Qatar'=>'+974',
			'Réunion'=>'+262',
			'Romania'=>'+40',
			'Russia'=>'+7',
			'Rwanda'=>'+250',
			'Samoa'=>'+685',
			'San Marino'=>'+378',
			'Saudi Arabia'=>'+966',
			'Senegal'=>'+221',
			'Serbia'=>'+381',
			'Seychelles'=>'+248',
			'Sierra Leone'=>'+232',
			'Singapore'=>'+65',
			'Slovakia'=>'+421',
			'Slovenia'=>'+386',
			'Somalia'=>'+252',
			'South Africa'=>'+27',
			'South Georgia'=>'+5+',
			'South Korea'=>'+82',
			'Spain'=>'+34',
			'Sri Lanka'=>'+94',
			'Sudan'=>'+249',
			'Suriname'=>'+597',
			'Svalbard'=>'+47',
			'Swaziland'=>'+268',
			'Sweden'=>'+46',
			'Switzerland'=>'+41',
			'Syria'=>'+963',
			'Taiwan'=>'+886',
			'Tajikistan'=>'+992',
			'Tanzania'=>'+255',
			'Thailand'=>'+66',
			'Togo'=>'+228',
			'Tokelau'=>'+64',
			'Tonga'=>'+676',
			'Tunisia'=>'+216',
			'Turkey'=>'+90',
			'Turkmenistan'=>'+993',
			'Uganda'=>'+256',
			'Ukraine'=>'+380',
			'United Arab Emirates'=>'+971',
			'United Kingdom'=>'+44',
			'United States'=>'+1',
			'Uruguay'=>'+598',
			'Uzbekistan'=>'+998',
			'Vatican City'=>'+3906',
			'Venezuela'=>'+58',
			'Vietnam'=>'+84',
			'Virgin Islands'=>'+1340',
			'Wallis and Futuna Islands'=>'+678',
			'Western Sahara'=>'+212',
			'Yemen'=>'+967',
			'Zambia'=>'+260',
			'Zimbabwe'=>'+263',
		);
		ksort($codes);

		return $codes;
	}
	
}


if(!function_exists('list_country')){
	function list_country($selection='Nepal') 
	{		
	    $list = '';
	    /*$countries = array(
						"Nepal",
						"United Kingdom",
						"United States",
						"Afghanistan",
						"Albania",
						"Algeria",
						"American Samoa",
						"Andorra",
						"Angola",
						"Anguilla",
						"Antarctica",
						"Antigua And Barbuda",
						"Argentina",
						"Armenia",
						"Aruba",
						"Australia",
						"Austria",
						"Azerbaijan",
						"Bahamas",
						"Bahrain",
						"Bangladesh",
						"Barbados",
						"Belarus",
						"Belgium",
						"Belize",
						"Benin",
						"Bermuda",
						"Bhutan",
						"Bolivia",
						"Bosnia And Herzegowina",
						"Botswana",
						"Bouvet Island",
						"Brazil",
						"British Indian Ocean Territory",
						"Brunei Darussalam",
						"Bulgaria",
						"Burkina Faso",
						"Burundi",
						"Cambodia",
						"Cameroon",
						"Canada",
						"Cape Verde",
						"Cayman Islands",
						"Central African Republic",
						"Chad",
						"Chile",
						"China",
						"Christmas Island",
						"Cocos (Keeling) Islands",
						"Colombia",
						"Comoros",
						"Congo",
						"Congo, The Democratic Republic Of The",
						"Cook Islands",
						"Costa Rica",
						"Cote D'Ivoire",
						"Croatia (Local Name: Hrvatska)",
						"Cuba",
						"Cyprus",
						"Czech Republic",
						"Denmark",
						"Djibouti",
						"Dominica",
						"Dominican Republic",
						"East Timor",
						"Ecuador",
						"Egypt",
						"El Salvador",
						"Equatorial Guinea",
						"Eritrea",
						"Estonia",
						"Ethiopia",
						"Falkland Islands (Malvinas)",
						"Faroe Islands",
						"Fiji",
						"Finland",
						"France",
						"France, Metropolitan",
						"French Guiana",
						"French Polynesia",
						"French Southern Territories",
						"Gabon",
						"Gambia",
						"Georgia",
						"Germany",
						"Ghana",
						"Gibraltar",
						"Greece",
						"Greenland",
						"Grenada",
						"Guadeloupe",
						"Guam",
						"Guatemala",
						"Guinea",
						"Guinea-Bissau",
						"Guyana",
						"Haiti",
						"Heard And Mc Donald Islands",
						"Holy See (Vatican City State)",
						"Honduras",
						"Hong Kong",
						"Hungary",
						"Iceland",
						"India",
						"Indonesia",
						"Iran (Islamic Republic Of)",
						"Iraq",
						"Ireland",
						"Israel",
						"Italy",
						"Jamaica",
						"Japan",
						"Jordan",
						"Kazakhstan",
						"Kenya",
						"Kiribati",
						"Korea, Democratic People's Republic Of",
						"Korea, Republic Of",
						"Kuwait",
						"Kyrgyzstan",
						"Lao People's Democratic Republic",
						"Latvia",
						"Lebanon",
						"Lesotho",
						"Liberia",
						"Libyan Arab Jamahiriya",
						"Liechtenstein",
						"Lithuania",
						"Luxembourg",
						"Macau",
						"Macedonia, Former Yugoslav Republic Of",
						"Madagascar",
						"Malawi",
						"Malaysia",
						"Maldives",
						"Mali",
						"Malta",
						"Marshall Islands",
						"Martinique",
						"Mauritania",
						"Mauritius",
						"Mayotte",
						"Mexico",
						"Micronesia, Federated States Of",
						"Moldova, Republic Of",
						"Monaco",
						"Mongolia",
						"Montserrat",
						"Morocco",
						"Mozambique",
						"Myanmar",
						"Namibia",
						"Nauru",
						"Netherlands",
						"Netherlands Antilles",
						"New Caledonia",
						"New Zealand",
						"Nicaragua",
						"Niger",
						"Nigeria",
						"Niue",
						"Norfolk Island",
						"Northern Mariana Islands",
						"Norway",
						"Oman",
						"Pakistan",
						"Palau",
						"Panama",
						"Papua New Guinea",
						"Paraguay",
						"Peru",
						"Philippines",
						"Pitcairn",
						"Poland",
						"Portugal",
						"Puerto Rico",
						"Qatar",
						"Reunion",
						"Romania",
						"Russian Federation",
						"Rwanda",
						"Saint Kitts And Nevis",
						"Saint Lucia",
						"Saint Vincent And The Grenadines",
						"Samoa",
						"San Marino",
						"Sao Tome And Principe",
						"Saudi Arabia",
						"Senegal",
						"Seychelles",
						"Sierra Leone",
						"Singapore",
						"Slovakia (Slovak Republic)",
						"Slovenia",
						"Solomon Islands",
						"Somalia",
						"South Africa",
						"South Georgia, South Sandwich Islands",
						"Spain",
						"Sri Lanka",
						"St. Helena",
						"St. Pierre And Miquelon",
						"Sudan",
						"Suriname",
						"Svalbard And Jan Mayen Islands",
						"Swaziland",
						"Sweden",
						"Switzerland",
						"Syrian Arab Republic",
						"Taiwan",
						"Tajikistan",
						"Tanzania, United Republic Of",
						"Thailand",
						"Togo",
						"Tokelau",
						"Tonga",
						"Trinidad And Tobago",
						"Tunisia",
						"Turkey",
						"Turkmenistan",
						"Turks And Caicos Islands",
						"Tuvalu",
						"Uganda",
						"Ukraine",
						"United Arab Emirates",
						"United States Minor Outlying Islands",
						"Uruguay",
						"Uzbekistan",
						"Vanuatu",
						"Venezuela",
						"Viet Nam",
						"Virgin Islands (British)",
						"Virgin Islands (U.S.)",
						"Wallis And Futuna Islands",
						"Western Sahara",
						"Yemen",
						"Yugoslavia",
						"Zambia",
						"Zimbabwe"
					);*/
		
		$countries = dialcode();			
		foreach($countries as $country=>$code)  {
			$sel = ($country== $selection) ? 'selected="selected"' : '';
			$list .= "<option value='{$country}' code='{$code}' {$sel}>{$country}</option>";
		}
		echo $list;
	}
}

if(!function_exists('dt_format')){
	function dt_format($d, $f) {
		if($d != ''){
			$dt = strtotime($d);
		
			switch($f){
				case 1:
					return date('jS M,Y', $dt);
				break;
				case 2:
				break;
				case 3:
				break;	
			}
		}
	}
}