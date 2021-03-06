<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['post_controller_constructor'][] = array(
                                'class'    => 'DynamicConfig',
                                'function' => 'setSiteConfig',
                                'filename' => 'dynamicConfig.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );


$hook['post_controller_constructor'][] = array(
                                'class'    => 'SetLang',
                                'function' => 'setLangSession',
                                'filename' => 'setLang.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );

$hook['post_controller_constructor'][] = array(
                                'class'    => 'UserAuth',
                                'function' => 'is_logged_in',
                                'filename' => 'user_auth.php',
                                'filepath' => 'hooks',
                                'params'   => array()
                                );                            

/* End of file hooks.php */
/* Location: ./application/config/hooks.php */