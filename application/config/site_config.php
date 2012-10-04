<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
|--------------------------------------------------------------------------
| Default Currency used in the site
|--------------------------------------------------------------------------
|
*/
$config['def_curr'] = 'USD';
$config['def_curr_sym'] = '$';
$config['fsite_page'] = 'site/';
$config['SITE_LANG'] = array('EN'=>'english', 'CZ'=>'czech', 'ES'=>'spanish', 'FR'=>'french', 'RU'=>'russian');

/* Where are the language files */
$config['translator_langDir'] = array( BASEPATH . 'language', APPPATH . 'language' );

/* c$Where are the language files */
$config['translator_masterLang'] = 'english';

// OTHER CONFIG ITEMS HAVE BEEN DYNAMICALLY DEFINED AT hooks/dynamicConfig.php 

/* End of file site_config.php */
/* Location: ./application/config/site_config.php */