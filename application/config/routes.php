<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "welcome";
$route['404_override'] = '';

$route['^apanel/translator(/)?$'] = "translator/index";
$route['^apanel/translator/([a-zA-Z\-\_]+)$'] = "translator/$1";

/*
 * ROUTES FOR FRONTE-END SITE
   Here 'site' is a virtual segment and is applicable to url without 'apanel/' keyword after 'site/'.
   That prevents it to route to the apanel controller.
   e.g. http://localhost/visitor_target/index.php/site/article/index
        http://localhost/visitor_target/index.php/site/article/index/54
 **/ 
$route['^site/(?!apanel/)([a-zA-Z\-\_]+)/([a-zA-Z\-\_]+)(/[a-zA-Z0-9\-\_]+)?$'] = "$1/$2/$3";

//$route['^site/(?!apanel/|ezsell|login).*'] = "$2/$3"; // WORKS!!!


/* End of file routes.php */
/* Location: ./application/config/routes.php */