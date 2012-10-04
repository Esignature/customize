<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('rule_fields_repo')){
    function rule_fields_repo($code, $defaults = NULL){
        $ci = & get_instance();
        
        $fld = array(
                        
                        'p0' => array(
                                    'type'=>'static',       // static, remote, file or callback function name; all will be populated in data index
                                    'field'=>'dropdown',
                                    'events' => array(),    // series of js events, can be overridden, e.g. 'onblur'=>'abcd','onchange'=>'xyz',
                                    'default'=> '',         // initial empty value for dropdowns, otherwise default value for other field types
                                    'help'=>'',
                                    'data'=>array(
                                        'Commercial'=>'Commercial',       // have data as 'Commercial:selected' if u need it auto-selected      
                                        'Organic'   =>'Organic'
                                     )                                                                         
                                ),
        
                        'p1' => array(
                                    'type'      =>'static',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'', 
                                    'tips'      =>true,     
                                    'data'      =>array(       
                                        'Commercial'=>'Commercial',    
                                        'Organic'   =>'Organic',
                                        'Internal'  =>'Internal'        
                                     )                   
                                ),
                                    
                        'p2' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array( 
                                        'Contains'          =>'Contains',
                                        'Does Not Contain'  =>'Does Not Contain',
                                        'Equals'            =>'Equals',
                                        'Does Not Equal'    =>'Does Not Equal',
                                        'Matches by RegEx'  =>'Matches by RegEx',
                                        'Starts With'       =>'Starts With',
                                        'Ends With'         =>'Ends With',
                                        'Is Empty'          =>'Is Empty',
                                        'Is Not Empty'      =>'Is Not Empty'                                        
                                     )
                                ),                    
                                
                        'p3' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Current Page'      =>'Current Page',
                                        'Current Session'   =>'Current Session'
                                     )
                                ),
               
                        'p4' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'All Pages'     =>'All Pages',
                                        'Full URL'      =>'Full URL',
                                        'URL Parameters'=>'URL Parameters',
                                        'URL Path'      =>'URL Path',
                                        'Hostname'      =>'Hostname',
                                        'Fragment'      =>'Fragment',
                                        'Page Title'    =>'Page Title',
                                        'Page Group'    =>'Page Group'
                                     )
                                ),
                                                        
                        'p5' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Equals To'     =>'Equals To',
                                        'Not Equal To'  =>'Not Equal To',
                                        'Empty'         =>'Empty',
                                        'Not Empty'     =>'Not Empty'
                                     )
                                ),                   
             
                        'p6' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'URL Parameters'=>'URL Parameters',
                                        'URL Path'=>'URL Path',
                                        'Hostname'=>'Hostname',
                                        'Fragment'=>'Fragment',
                                        'Full URL'=>'Full URL'
                                     )
                                ),
                                    
                        'p7' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'All Pages'     =>'Current Pages',
                                        'Full URL'      =>'Full URL',
                                        'URL Parameters'=>'URL Parameters',
                                        'URL Path'      =>'URL Path',
                                        'Hostname'      =>'Hostname',
                                        'Fragment'      =>'Fragment',
                                        'Page Title'    =>'Page Title',
                                        'Page Group'    =>'Page Group'
                                     )
                                ),
                                   
              
                        'p8' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'All'=>'All',
                                        'Unique'=>'Unique'
                                    )
                                ),
                                                
                        'p9' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Equals'=>'Equals',
                                        'Not Equals'=>'Not Equals',
                                        'Empty'=>'Empty',
                                        'Not Empty'=>'Not Empty'
                                     )   
                                ),
                                    
                        'p10' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                                    '>=' => '>=',
                                                    '>'  => '>',
                                                    '='  => '=',
                                                    '!=' => '!=',
                                                    '<'  => '<',
                                                    '<=' => '<='
                                                )
                                    ),  
                                        
                        'p11' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Views'=>'Views',
                                        'Time'=>'Time'
                                     )
                                 ), 
                                    
                        'p12' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'More'=>'More',
                                        'Less'=>'Less',
                                        '>'=>'>',
                                        '<'=>'<'
                                     )
                                 ),
                                    
                        'p13' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Count'=>'Count',
                                        'Percet'=>'Percent'
                                     )
                                 ),  
                                    
                        'p14' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Between Dates'=>'Between Dates',
                                        'Between Daily Times'=>'Between Daily Times',
                                        'Days of Week'=>'Days of Week'
                                        )
                                    ),   
              
                        'p15' => array(
                                 'type'=>'callback',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> 'Local Time',
                                    'help'=>'',      
                                    'data'=> 'address:uniqTimezoneOffsets' 
                                ), 
                                  
                       'p16' => array(
                                    'type'=>'static',   
                                    'field'=>'multiselect', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',
                                    'tips' => true,      
                                    'data'=>array(
                                        'Sunday'    =>'Sunday',
                                        'Monday'    =>'Monday',
                                        'Tuesday'   =>'Tuesday',
                                        'Wednesday' =>'Wednesday',
                                        'Thursday'  =>'Thursday',
                                        'Friday'    =>'Friday',
                                        'Saturday'  =>'Saturday'
                                     )
                                 ),                   
                                                                                                                                                                             
                       'p17' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'First Visit'   =>'First Visit',
                                        'Pages'         =>'Pages',
                                        'Container'     =>'Container',
                                        'Segments Matched'=>'Segments Matched',
                                        'Actions'       =>'Actions'
                                     )
                                 ),      
                    
                       'p18' => array(                                    
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Pages'     =>'Pages',
                                        'Container' =>'Container',
                                        'Segments Matched'=>'Segments Matched',
                                        'Actions'   =>'Actions'
                                        )
                                    ),  
                                                                                                                                                                             
                       'p19' => array(
                                    'type'=>'static',    
                                    'source'=>'',        
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(                                    
                                        'Seconds'=>'Seconds',
                                        'Page Views'=>'Page Views'
                                     )
                                ),                     
                      
                       'p20' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'All Events'=>'All Events',
                                        'Page Scrolls'=>'Page Scrolls',
                                        'Key Presses'=>'Key Presses',
                                        'Left Button Clicks'=>'Left Button Clicks',
                                        'Right Button Clicks'=>'Right Button Clicks'
                                     )
                                ),    
                  
                       'p21' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Sum Time'       =>'Sum Time',
                                        'Individual Time'=>'Individual Time'
                                        )
                                     ),  
                                             
                       'p22' => array(
                                    'type'=>'static',    
                                    'source'=>'',        
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                                'https'=>'https',
                                                'http'=>'http'
                                            )
                                     ),  
                                                                   
                      'p23'  => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                                'All'=>'All',
                                                'In'=>'In',
                                                'Out'=>'Out'
                                           )
                                     ),      
                                             
                       'p24' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(                                    
                                                'Africa'    =>'Africa',
                                                'Asia'      =>'Asia',
                                                'Europe'    =>'Europe',
                                                'N. America'=>'N. America',
                                                'Oceania'   =>'Oceania',
                                                'S. America'=>'S. America'
                                           )
                                     ),                           
                                             
                       'p25' => array(
                                    'type'=>'static',    
                                    'field'=>'multiselect', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',
                                    'tips' => true,      
                                    'data'=>array(
                                            'New Visitor, First Page'       =>'New Visitor, First Page',
                                            'Returning Visitor, First Page' =>'Returning Visitor, First Page',
                                            'New Visitor/Further Page'      =>'New Visitor/Further Page',
                                            'Repeating Visitor/Further Page'=>'Repeating Visitor/Further Page'
                                         )
                                    ),  
                                         
                        'p26' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=> array_combine(range(0, 23), array_map('two_digit', range(0, 23)))
                                    ),
                        
                        'p27' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=> array_combine(range(0, 59), array_map('two_digit', range(0, 59)))
                                    ),
                        
                        'p28' => array(
                                    'type'=>'static',    
                                    'field'=>'multiselect', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',   
                                    'tips' => true,   
                                    'data'=>array(
                                                'ar'=>'ar', 'ca'=>'ca', 'cs'=>'cs', 'da'=>'da', 'de'=>'de', 'el'=>'el', 'en'=>'en',
                                                'es'=>'es', 'fi'=>'fi', 'fr'=>'fr', 'he'=>'he', 'hu'=>'hu', 'it'=>'it', 'ja'=>'ja',
                                                'ko'=>'ko', 'nb'=>'nb', 'nl'=>'nl', 'pl'=>'pl', 'pt'=>'pt', 'ru'=>'ru', 'sk'=>'sk',
                                                'sl'=>'sl', 'sv'=>'sv', 'th'=>'th', 'tr'=>'tr', 'zh'=>'zh'
                                            )
                                    ),  
                       
                                                
                       'p29' => array(
                                    'type'=>'callback',    
                                    'field'=>'multiselect', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=> 'segmentation:page_list',
                                    'tips' => true
                                    ),
                                                                                 
                       'p30' => array(
                                    'type'=>'callback',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=> 'segmentation:page_group',
                                    'tips' => true
                                    ),      
                                 
                       'p31' => array(
                                    'type'=>'static',    
                                    'field'=>'multiselect', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'', 
                                    'tips' => true,     
                                    'data'=>array(    
                                        '16'=>'16 (High Color)',
                                        '24'=>'24 (True Color)'
                                        )
                                    ),
                                         
                       'p32' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Yes'=>'Yes',
                                        'No'=>'No:selected'
                                        )
                                    ),
                                    
                      'p33' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Cookie Enabled'=>'Cookie Enabled',
                                        'Ajax Enabled'=>'Ajax Enabled',
                                        'Javascript Enabled'=>'Javascript Enabled'
                                     )
                                    ),  
                                 
                      'p34' => array(
                                    'type'=>'static',     
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Silverlight'=>'Silverlight',
                                        'Flash'=>'Flash',
                                        'Media Player'=>'Media Player',
                                        'VLC'=>'VLC',
                                        'Quicktime'=>'Quicktime'
                                     )
                                    ), 
                                 
                       'p35' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Not Shown'=>'Not Shown',
                                        'Shown'=>'Shown',
                                        'Shown & Clicked'=>'Shown & Clicked'
                                        )
                                    ),  
                        // Goal Types         
                       'p36' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                            'All'=>'All',
                                            'Constant'=>'Constant',
                                            'Variable'=>'Variable'
                                      )
                                    ),
                                                  
                       'p37' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                                'User'=>'User',
                                                'Session'=>'Session'
                                       )
                                    ),   
                                 
                       'p38' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                                'User'=>'User',
                                                'Session'=>'Session',
                                                'Page'=>'Page'
                                           )
                                    ), 
                                             
                       'p39' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                            'Integer 1'=>'Integer 1',
                                            'Integer 2'=>'Integer 2',
                                            'Integer 3'=>'Integer 3',
                                            'Integer 4'=>'Integer 4',
                                            'Float 1'=>'Float 1',
                                            'Float 2'=>'Float 2'
                                            )
                                    ),
                                                  
                        'p40' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Text 1'=>'Text 1',
                                        'Text 2'=>'Text 2',
                                        'Text 3'=>'Text 3',
                                        'Text 4'=>'Text 4'
                                        )
                                    ), 
                                 
                        'p41' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                            'Facebook Birthday'             =>'Facebook Birthday',
                                            'Facebook Religion'             =>'Facebook Religion',
                                            'Facebook Current City'         =>'Facebook Current City',
                                            'Facebook Current State'        =>'Facebook Current State',
                                            'Facebook Current Country'      =>'Facebook Current Country',
                                            'Facebook Hometown City'        =>'Facebook Hometown City', 
                                            'Facebook Hometown State'       =>'Facebook Hometown State',
                                            'Facebook Hometown Country'     =>'Facebook Hometown Country',
                                            'Facebook Meeting Gender'       =>'Facebook Meeting Gender',
                                            'Facebook Gender'               =>'Facebook Gender',
                                            'Facebook Relationship Status'  =>'Facebook Relationship Status',
                                            'Facebook Political Interest'   =>'Facebook Political Interest',
                                            'Facebook Allowed Restrictions' =>'Facebook Allowed Restrictions',
                                            'Facebook Interests'            =>'Facebook Interests',
                                            'Facebook Website'              =>'Facebook Website',
                                            'Facebook Education Year'       =>'Facebook Education Year',
                                            'Facebook Education Name'       =>'Facebook Education Name',
                                            'Facebook Education Degree'     =>'Facebook Education Degree',
                                            'Facebook Friends Count'        =>'Facebook Friends Count',
                                            'Facebook Occupation'           =>'Facebook Occupation',
                                            'Facebook Vehical Type'         =>'Facebook Vehical Type',
                                            'Facebook Financial'            =>'Facebook Financial',
                                            'Facebook Purchase History'     =>'Facebook Purchase History'
                                         )
                                    ),                                 
                                 
                        'p42' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'Unknown'=>'Unknown',
                                        'Male'=>'Male',
                                        'Female'=>'Female'
                                        )
                                    ),    
                                 
                        'p43' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                            'Pages'=>'Pages',
                                            'Session'=>'Session',
                                            'Always'=>'Always'
                                         )
                                    ),   
                        
                        'p44' => array(
                                    'type'      =>'static',    
                                    'field'     =>'dropdown', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',      
                                    'data'      =>array(
                                                'Count'=>'Seconds',
                                                'Percent'=>'Percent'
                                     )
                                 ),
                        
                        // segments matched
                        'p45' => array(
                                    'type'      =>'callback',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',      
                                    'data'      =>'segmentation:segments',
                                    'tips'      => true
                                    ),
                       
                       'p46' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                                    '>=' => '>=',
                                                    '>'  => '>',
                                                    '<'  => '<',
                                                    '<=' => '<='
                                                )
                                    ),
                                    
                        // Action types matched
                        'p47' => array(
                                    'type'      =>'callback',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',      
                                    'data'      =>'segmentation:action_types',
                                    'tips'      => true
                                    ),
                                    
                        // Actions according to the selected action types
                        'p48' => array(
                                    'type'      =>'callback',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',      
                                    'data'      =>'segmentation:actions',
                                    'tips'      => true
                                    ),            
                                    
                         
                         // Container types matched
                        'p49' => array(
                                    'type'      =>'callback',    
                                    'field'     =>'dropdown', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',      
                                    'data'      =>'segmentation:container_types',
                                    'tips'      => true
                                    ),
                                    
                        // Containers according to the selected action types
                        'p50' => array(
                                    'type'      =>'callback',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',      
                                    'data'      =>'segmentation:containers',
                                    'tips'      => true
                                    ),            
                        
                        
                        'p51' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array( 
                                        'Contains'          => 'Contains',
                                        'Does Not Contain'  => 'Does Not Contain',
                                        'Equals'            => 'Equals',
                                        'Does Not Equal'    => 'Does Not Equal',
                                        'Matches by RegEx'  => 'Matches by RegEx',
                                        'Starts With'       => 'Starts With',
                                        'Ends With'         => 'Ends With',
                                        'Is Empty'          => 'Is Empty',
                                        'Is Not Empty'      => 'Is Not Empty',
                                        '>='                => '>=',
                                        '>'                 => '>',
                                        '='                 => '=',
                                        '!='                => '!=',
                                        '<'                 => '<',
                                        '<='                => '<='                                        
                                     )
                                ),  
                        
                        // Countries multiselect
                        'p52' => array(
                                    'type'      =>'callback',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',      
                                    'data'      =>'address:onlyCountryNames',
                                    'tips'      => true
                                    ), 
                                    
                        // Countries Dropdown
                        'p53' => array(
                                    'type'      =>'callback',    
                                    'field'     =>'dropdown', 
                                    'events'    => array(), 
                                    'default'   => ' ',
                                    'help'      =>'',      
                                    'data'      =>'address:onlyCountryNames',
                                    'tips'      => true
                                    ),                         
                       
                        // States / Zones
                        'p54' => array(
                                    'type'      =>'static',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      => '',      
                                    'data'      => array(''),
                                    'tips'      => true
                                    ),
                                    
                        // Cities
                        'p55' => array(
                                    'type'      =>'static',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      => '',      
                                    'data'      => array(''),
                                    'tips'      => true
                                    ),             
                       
                       
                        // Containers according to the selected action types
                        'p56' => array(
                                    'type'      =>'static',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'', 
                                    'tips'      => true,     
                                    'data'      => array( 
                                                        'Africa'    => 'Africa',
                                                        'Asia'      => 'Asia',
                                                        'Europe'    => 'Europe',
                                                        'N. America'=> 'N. America',
                                                        'Oceania'   => 'Oceania',
                                                        'S. America'=> 'S. America'                                                                                                
                                                   )
                                    ), 
                       
                       
                        // Companies Multi select
                        'p57' => array(
                                    'type'      =>'static',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'tips' => true,      
                                    'data'      => array()
                                    ),
                        
                        // Commercial Domains
                        'p58' => array(
                                    'type'      =>'callback',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',      
                                    'data'      => 'settings:getSiteCommercialReferrers',
                                    'tips'      => true
                                    ),
                        
                         // Domain Types
                        'p59' => array(
                                    'type'      =>'callback',    
                                    'field'     =>'dropdown', 
                                    'events'    => array(), 
                                    'default'   => ' ',
                                    'help'      => '',      
                                    'data'      => 'settings:getDomainTypes',
                                    'tips'      => true
                                    ),
                        
                        'p60' => array(
                                    'type'      =>'static',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      => '', 
                                    'tips'      => true,     
                                    'data'      => array()
                                    ),
                       
                        'p61' => array(
                                    'type'      =>'callback',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      =>'settings:getSearchDomainTypes', // 'Commercial' and 'Organic'
                                    'tips'      => true                                                                         
                                ),
                                
                        'p62' => array(
                                    'type'      =>'static',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      =>array(''), 
                                    'tips'      => true                                                                            
                                ),    
                        
                        /* VISITOR SYSTEM INFO BEGINS */     
                         
                         
                        // Visitor OS    
                        'p63' => array(
                                    'type'      =>'callback',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      =>'visitor_prop:visitorOS',
                                    'tips'      => true                                                                         
                                ), 
                                
                        // Visitor Web Browser    
                        'p64' => array(
                                    'type'      =>'callback',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      =>'visitor_prop:visitorBrowser',
                                    'tips'      => true                                                                         
                                ), 
                                
                        // Visitor Web Browser Version accompanied by above field  
                        'p65' => array(
                                    'type'      =>'static',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      => array(),
                                    'tips'      => true                                                                         
                                ),           
                         
                        // Visitor Platforms
                        'p66' => array(
                                    'type'      =>'callback',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      => 'visitor_prop:visitorPlatforms',
                                    'tips'      => true                                                                         
                                ),    
                       
                        // Media Plugin Versions
                        'p67' => array(
                                    'type'      =>'static',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'tips'      => true,
                                    'data'      => range(1, 15)                                                                         
                                ),   
                        // Screen Resolutions
                        'p68' => array(
                                    'type'      =>'callback',
                                    'field'     =>'dropdown',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      => 'visitor_prop:visitorResolution',
                                    'tips'      => true
                                ), 
                        
                       // Goal Types
                        'p69' => array(
                                    'type'      =>'static',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'tips'      => true,
                                    'data'      => array()                                                                         
                                ), 
                       
                        // Total Goals Achieved
                        'p70' => array(
                                    'type'      =>'callback',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      => 'segmentation:goalsAchieved',
                                    'tips'      => true                                                                        
                                ), 
                       
                        /* BROADCAST BEGINS HERE */
                        // Campaigns
                        'p71' => array(
                                    'type'      =>'callback',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      => 'settings:campaigns',
                                    'tips'      => true                                                                        
                                ),
                                
                        // Lists
                        'p72' => array(
                                    'type'      =>'callback',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      => 'settings:lists',
                                    'tips'      => true                                                                       
                                ),
                       
                        // Message Types
                        'p73' => array(
                                    'type'      =>'callback',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      => 'settings:msg_types',
                                    'tips'      => true                                                                        
                                ),
                                
                        // Campaigns
                        'p74' => array(
                                    'type'      => in_array($_POST['i'], array('_s_mrc50', '_s_mrc51')) ? 'static' : 'callback',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      => in_array($_POST['i'], array('_s_mrc50', '_s_mrc51')) ? array() : 'settings:campaigns',
                                    'tips'      => true                                                                        
                                ),         
                       
                        // Messages
                        'p75' => array(
                                    'type'      => in_array($_POST['i'], array('_s_mrc50', '_s_mrc51')) ? 'static' : 'callback',
                                    'field'     =>'multiselect',
                                    'events'    => array(),
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      => in_array($_POST['i'], array('_s_mrc50', '_s_mrc51')) ? array() : 'settings:messages',
                                    'tips'      => true
                                ),                       
                                               
                        // Message Variations
                        'p76' => array(
                                    'type'      =>'static',
                                    'field'     =>'multiselect',
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',
                                    'data'      => array(),
                                    'tips'      =>true
                                ),
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                                     
                       // Textboxes 
                                             
                       // Site Enter Time  
                       'p80' => clone_txtbox(date('Y-m-d'), array() , '10', true), // date from
                       'p81' => clone_txtbox(date('Y-m-d'), array() , '10', true), // date to
                       'p82' => clone_txtbox(date('H:i'), array() , '5', true), // time from 
                       'p83' => clone_txtbox(date('H:i'), array() , '5', true), // time to
                       
                       // Page Enter Time 
                       // 4txtboxes same as in Site Enter Time                         
                       'p88' => clone_txtbox('', array(), 0, true), // contains textbox                       
                       'p89' => clone_txtbox('', array(), 0, true), // name textbox for name value pair for URL Parameter
                       'p90' => clone_txtbox('', array(), 0, true), // value textbox for name value pair for URL Parameter
                       
                       // Popular Pages
                       'p91' => clone_txtbox(0, array(), 0, true), // More or Less textbox
                       
                       // Avg. Time on Page        
                       'p92' => clone_txtbox(1, array(), 5, true), // Operator Value textbox                       
                       
                       // Time/pages between page/ action/segment
                       'p93' => clone_txtbox('', array(), 0, true), // Container Contains
                       'p94' => clone_txtbox(1, array(), 0, true), // Container Container numeric value for operator matching
                       
                       // Total Time in Focus
                       'p97' => clone_txtbox(1, array(), 0, true), 
                        
                       //Page Events 
                       'p98' => clone_txtbox(1, array(), 0, true),
                       
                       //Companies search box
                       'p99' => clone_txtbox('', array(), 0, true),

                        // Keywords
                       'p100' => clone_txtbox('', array(), 0, true), 
                       
                        // Control Group
                       'p101' => clone_txtbox(0, array(), 3, true),
                       'p102' => clone_txtbox(0, array(), 3, true),   
                       
                       // Facebook
                       'p103' => clone_txtbox(2000, array(), 4, true),                                                                                                                                                                                                                                                                                                                                                        
        );
        
        
         return $fld[$code];       
    }    
}

// clone regular textboxes
function clone_txtbox($default = '', $event = array(), $maxlength = 0, $tips = false){
    
    return array(
        'field'=>'input',
        'events' => $event,
        'default'=> $default,
        'data'=> array(),
        'type'=>'',
        'maxlength'=>$maxlength,
        'tips'=>$tips
    );
}

function _build_field($code, $gid, $key, $so, $cevents = array(), $class = '', $wrap_s = '<div class="wrp_flds">', $wrap_e = '</div>', $label='', $fld_data, $set_index=0, $index = '0'){
    $ci = & get_instance();
    $info       = rule_fields_repo($code);
    $type       = $info['type'];            // static, remote, file or callback function name
    $field      = $info['field'];
    $events     = $info['events'];          // series of js events, can be overridden, e.g. 'onblur'=>'abcd','onchange'=>'xyz',
    $default    = $info['default'];         // initial empty value for dropdowns, otherwise default value for other field types
    $data       = $info['data'];            // have data as 'Commercial:selected' if u need it auto-selected
    $maxlength  = isset($info['maxlength']) ? $info['maxlength'] : 0;
    $tips       = isset($info['tips']) ? $info['tips'] : false;
    $field_type = 'form_'.$info['field'];
    $attrib     = '';
    $name       = '_group['.$gid.'][fieldset]['.$so.']['.$key.']['.$code.']['.$set_index.'][]';
    $id         = $code.'-'.$gid.'-'.$key.'-'.md5(microtime(true));    
    
    if(isset($fld_data) && isset($fld_data[$so]) && isset($fld_data[$so]['fields'][$key][$code]) && isset($fld_data[$so]['fields'][$key][$code][$set_index])) 
        $fld_data = $fld_data[$so]['fields'][$key][$code][$set_index];
    else 
        $fld_data = false;
    //fl($fld_data);
    switch($field){
        case 'dropdown':
        case 'multiselect':
            
            if($type == 'callback' && !is_array($data)){
                $method = $data;
                $e = explode(':', $data);
                if(count($e) == 2)
                    list($helper, $method) = $e;
                elseif(count($e) == 3)
                    list($helper, $method, $param) = $e;
                    
                $ci->load->helper($helper);
                $data = $method(isset($param)?$param:'');
            }
            if(1==1){
                $options = array();
                
                if($default != '') {
                    $options = array(''=>$default);
                }                
                
                // filter out selected option values
                $s_data = array();                
                
                if($fld_data){
                    foreach($data as $k=>$v){
                        $data[$k] = preg_replace('/:selected/', '', $v);
                        if(in_array($k, $fld_data)){                            
                            if($field == 'multiselect'){
                                array_push($s_data, $k);    
                            }else{
                                $s_data = $k;
                                break; // u just need a single selection value for dropdown, while for multi-select that could be many.
                            }   
                        }
                    }   
                }else{
                    foreach($data as $k=>$v){
                        if(substr($v, -9, 9) == ':selected'){
                                                    
                            $data[$k] = preg_replace('/:selected/', '', $v);                        
                            
                            if($field == 'multiselect'){
                                array_push($s_data, $k);    
                            }else{
                                $s_data = $k;
                                break; // u just need a single selection value for dropdown, while for multi-select that could be many.
                            }   
                        }
                    }
                }
                               
                
                // merge with the option initialized earlier (if any)
                $options = $options+ $data;
                $events = array_merge($events, $cevents);  //override any event provided in the passed parameter.

                // append other available attributes
                foreach($events as $k=>$v){
                    if($k && !empty($v))   $attrib .= " $k=$v ";  
                }
                
                if($class != ''){
                    $attrib .= " class = '$class' ";
                } 
                
                $attrib .= " id = '$id' ";
                $attrib .= " data-code='{$code}'";
                
                $tips = $tips ? '<a class="tips hidden"></a>' : '';
                
                //label
                $label = $label == '' ? '&nbsp;' : $label;
                $label = '<label for="'.$name.'" class="r_lbl">'.$label.$tips.'</label>';
                
                if($fld_data)  $wrap_s = preg_replace('/hidden/', '', $wrap_s);
                
                if(strstr($wrap_s, 'hidden')){
                    $attrib .= " disabled='disabled' ";
                }
                
                return $wrap_s.$label.$field_type($name, $options, $s_data, $attrib).$wrap_e;
        
            }
            break;
            
        case 'input':
            
            $data = array(
              'name'        => $name,
              'id'          => $id,
              'value'       => ($fld_data ? $fld_data[0] : $default),
              'class'       => $class,
              'data-code'   => $code
            );
            if(!empty($maxlength))  $data = array_merge($data, array('maxlength'=>$maxlength));
            
            $events = array_merge($events, $cevents);  //override any event provided in the passed parameter.
            
            // append other available attributes
            foreach($events as $k=>$v){
                if($k && !empty($v))   $data = array_merge($data, array($k=>$v));  
            }                        
            
            $tips = $tips ? '<a class="tips hidden"></a>' : '';
            
            //label
            $label = $label == '' ? '&nbsp;' : $label;
            $label = '<label for="'.$name.'" class="r_lbl">'.$label.$tips.'</label>';
            
            if(isset($fld_data[$code][$index]) && !empty($fld_data[$code][$index]))  $wrap_s = preg_replace('/hidden/', '', $wrap_s);
            
            if(strstr($wrap_s, 'hidden')){
                $data = array_merge($data, array('disabled'=>'disabled'));
            }
            return $wrap_s.$label.$field_type($data).$wrap_e;
            break; 
            
    } 
    
}

// the main events wrapper block is cloned out of this
function event_group_block_tmpl(){
    return '<div class="event-group-block-cloner hidden">
                 <input type="hidden" id="evt_grp_blk_so" value="0" />
                 <ul class="rule-container"></ul>
                 <div clear="all"></div>
                 <a class="stdbtn btn_yellow btn_add_rule" href="javascript:;"><span>Add Rule</span></a>
            </div>';
}

function rule_field_sets($key, $gid, $so, $fld_data){                
    
        switch($key){
            
            // Site Enter TIme
            case '_s_mrc0' :    
               return array(
                        'help'=>'Time of the first view of the page in the session.',
                        'title' => 'Site Enter Time', 
                        'fields'=>
                            array(                                    
                                _build_field('p14', $gid, $key, $so, array('onchange'=>"p14(this)"), '', '<div class="wrp_flds set4">', '</div>', '', $fld_data),
                                _build_field('p80', $gid, $key, $so, array(''), 'datepicker1', '<div class="wrp_flds set1 dp1">', '</div>', 'From', $fld_data),
                                _build_field('p81', $gid, $key, $so, array(''), 'datepicker2', '<div class="wrp_flds set1 dp2">', '</div>', 'To', $fld_data),
                                _build_field('p82', $gid, $key, $so, array(''), 'timepicker1', '<div class="wrp_flds set1 hidden tp1">', '</div>', 'From', $fld_data),
                                _build_field('p83', $gid, $key, $so, array(''), 'timepicker2', '<div class="wrp_flds set1 hidden tp2">', '</div>', 'To', $fld_data),
                                _build_field('p16', $gid, $key, $so, array(''), 'daypicker', '<div class="wrp_flds set1 hidden dyp">', '</div>', '', $fld_data),                                
                                _build_field('p15', $gid, $key, $so, array(), '', '<div class="wrp_flds set3">', '</div>', 'Timezone', $fld_data),     
                                '<br clear="all" />'                             
                            )
                      );
            
            // Page Enter Time
            case '_s_mrc1' :    
               return array(
                        'help'=>'Moment the current page gets loaded.',
                        'title' => 'Page Enter Time', 
                        'fields'=>
                            array(                                    
                                _build_field('p14', $gid, $key, $so,  array('onchange'=>"p14(this)"), '', '<div class="wrp_flds set4">', '</div>', '', $fld_data),
                                _build_field('p80', $gid, $key, $so,  array(''), 'datepicker1', '<div class="wrp_flds set1 dp1">', '</div>', 'From', $fld_data),
                                _build_field('p81', $gid, $key, $so,  array(''), 'datepicker2', '<div class="wrp_flds set1 dp2">', '</div>', 'To', $fld_data),
                                _build_field('p82', $gid, $key, $so,  array(''), 'timepicker1', '<div class="wrp_flds set1 hidden tp1">', '</div>', 'From', $fld_data),
                                _build_field('p83', $gid, $key, $so,  array(''), 'timepicker2', '<div class="wrp_flds set1 hidden tp2">', '</div>', 'To', $fld_data),
                                _build_field('p16', $gid, $key, $so,  array(''), 'daypicker', '<div class="wrp_flds set1 hidden dyp">', '</div>', '', $fld_data),                                
                                _build_field('p15', $gid, $key, $so,  array(), '', '<div class="wrp_flds set3">', '</div>', 'Timezone', $fld_data),
                                // page
                                _build_field('p4',  $gid, $key, $so,  array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so,  array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set4 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so,  array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),  
                                // Current Session - Page Session
                                _build_field('p3', $gid, $key, $so,  array(), '', '<div class="wrp_flds set3">', '</div>', 'When', $fld_data),      
                                '<br clear="all" />'                             
                            )
                      );           
            
            // Popular Pages
            case '_s_mrc2' :    
               return array(
                        'help'=>'Find if current/specific page is most popular during the visitor session.<br />Popularity is based on page views or time spent on a page.<br />You can choose popularity comparing all pages viewed during session or specific pages.',
                        'title' => 'Popular Pages', 
                        'fields'=>
                            array(
                                // page
                                _build_field('p7',  $gid, $key, $so,  array('onchange'=>"p7(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so,  array('onchange'=>"p2(this)"), '', '<div class="wrp_flds ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so,  array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                // View - Time
                                _build_field('p11',  $gid, $key, $so,  array('onchange'=>"p11(this)"), '', '<div class="wrp_flds vw_tm">', '</div>', '', $fld_data),
                                // More-Less 
                                _build_field('p12',  $gid, $key, $so,  array('onchange'=>"p12(this)"), '', '<div class="wrp_flds mr_ls">', '</div>', '', $fld_data),
                                // More-Less textbox
                                _build_field('p91', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set0 mr_ls_txt hidden">', '</div>', '', $fld_data),
                                // View Count-Percent
                                _build_field('p13',  $gid, $key, $so,  array(''), '', '<div class="wrp_flds cnt_prct hidden">', '</div>', '', $fld_data),
                                // Time Seconds-Percent
                                _build_field('p44',  $gid, $key, $so,  array(''), '', '<div class="wrp_flds sec_prct hidden">', '</div>', '', $fld_data),
                                
                                    
                                // page
                                _build_field('p4',  $gid, $key, $so,  array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', 'of', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so,  array('onchange'=>"p2(this)"), '', '<div class="wrp_flds ctns hidden">', '</div>', '', $fld_data, 1),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data, 1),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data, 1),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data, 1),
                                // equals
                                _build_field('p5', $gid, $key, $so,  array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data, 1),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),    
                                
                                '<br clear="all" />'                             
                            )
                      ); 
           
            // Average Time on Page
            case '_s_mrc3' :    
               return array(
                        'help'=>'Total time on page / Total page views.',
                        'title' => 'Average Time on Page', 
                        'fields'=>
                            array(
                                    
                                // page
                                _build_field('p4',  $gid, $key, $so,  array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so,  array('onchange'=>"p2(this)"), '', '<div class="wrp_flds ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so,  array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),    
                                
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so,  array(''), '', '<div class="wrp_flds mt_op">', '</div>', '', $fld_data),
                                // avg. time value
                                _build_field('p92', $gid, $key, $so,  array(''), '', '<div class="wrp_flds tm_vl">', '</div>', '', $fld_data),
                                
                                '<br clear="all" />'                             
                            )
                      ); 
                      
            // Time/Pages Between Page/Action/Segment
            case '_s_mrc4' :    
               return array(
                        'help'  => 'Allow you to segment visitors based on time passed or number of pages viewed after they have visited <br />specific 
                                    page or occurrence of specific action or segment.',
                        'title' => 'Time/Pages Between Page/Action/Segment', 
                        'fields'=>
                            array(
                                // fpcsa
                                _build_field('p17', $gid, $key, $so,  array('onchange'=>"p17(this)"), '', '<div class="wrp_flds set4 fpcsa">', '</div>', 'From', $fld_data),                                 
                                // segments matched multiselect    
                                _build_field('p45', $gid, $key, $so,  array(), '', '<div class="wrp_flds set3 seg_mtch hidden">', '</div>', 'Segments', $fld_data),
                                // action types multiselect    
                                _build_field('p47', $gid, $key, $so,  array(), '', '<div class="wrp_flds set3 axn_types hidden">', '</div>', 'Action Types', $fld_data),
                                // actions according to the selected action types: multiselect    
                                _build_field('p48', $gid, $key, $so,  array(), '', '<div class="wrp_flds set3 axns hidden">', '</div>', 'Actions', $fld_data),
                                // action status    
                                _build_field('p35', $gid, $key, $so,  array(), '', '<div class="wrp_flds set3 axn_status hidden">', '</div>', 'Actions Status', $fld_data),
                                
                                // container types dropdown    
                                _build_field('p49', $gid, $key, $so,  array(), '', '<div class="wrp_flds set4 cntnr_types hidden">', '</div>', 'Container Types', $fld_data),
                                // containers according to the selected container types: multiselect    
                                _build_field('p50', $gid, $key, $so,  array(), '', '<div class="wrp_flds set5 cntnrs hidden">', '</div>', 'Containers', $fld_data),
                                // container matching operator dropdowns (contains + operators)
                                _build_field('p51', $gid, $key, $so,  array('onchange'=>"p51(this)"), '', '<div class="wrp_flds set3 ctns_op hidden">', '</div>', '', $fld_data),
                                // textbox for contains in ctns_op
                                _build_field('p93', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 ctns_op_txt1 hidden">', '</div>', '', $fld_data),
                                // textbox for operators in ctns_op 
                                _build_field('p94', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 ctns_op_txt2 hidden">', '</div>', '', $fld_data, '0'),                                
                                
                                // page
                                _build_field('p4',  $gid, $key, $so,  array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url hidden">', '</div>', '', $fld_data, '0'),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so,  array('onchange'=>"p2(this)"), '', '<div class="wrp_flds ctns hidden">', '</div>', '', $fld_data, '0'),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data, '0'),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5',  $gid, $key, $so,  array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                                               
                                
                                // sp: Seconds-PageViews
                                _build_field('p19', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 sp">', '</div>', '', $fld_data),
                                // mathematical operators
                                _build_field('p46', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set6 mt_op">', '</div>', '', $fld_data),
                                // count textbox
                                _build_field('p94', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set0 mt_op_vl">', '</div>', '', $fld_data, 1),
                                
                                '<br clear="all" />',
                                // -------------------------------------------------------------------------------------------->
                                
                                _build_field('p18', $gid, $key, $so,  array('onchange'=>"p18(this)"), '', '<div class="wrp_flds set3 pg_n_cntn">', '</div>', 'To', $fld_data),                                
                                
                                // segments matched multiselect    
                                _build_field('p45', $gid, $key, $so,  array(), '', '<div class="wrp_flds set3 seg_mtch hidden">', '</div>', 'Segments', $fld_data, 1),
                                // action types multiselect    
                                _build_field('p47', $gid, $key, $so,  array(), '', '<div class="wrp_flds set3 axn_types hidden">', '</div>', 'Action Types', $fld_data, 1),
                                // actions according to the selected action types: multiselect    
                                _build_field('p48', $gid, $key, $so,  array(), '', '<div class="wrp_flds set3 axns hidden">', '</div>', 'Actions', $fld_data, 1),
                                // action status    
                                _build_field('p35', $gid, $key, $so,  array(), '', '<div class="wrp_flds set3 axn_status hidden">', '</div>', 'Actions Status', $fld_data, 1),
                                
                                // container types dropdown    
                                _build_field('p49', $gid, $key, $so,  array(), '', '<div class="wrp_flds set4 cntnr_types hidden">', '</div>', 'Container Types', $fld_data, 1),
                                // containers according to the selected container types: multiselect    
                                _build_field('p50', $gid, $key, $so,  array(), '', '<div class="wrp_flds set5 cntnrs hidden">', '</div>', 'Containers', $fld_data, 1),
                                // container matching operator dropdowns (contains + operators)
                                _build_field('p51', $gid, $key, $so,  array('onchange'=>"p51(this)"), '', '<div class="wrp_flds set3 ctns_op hidden">', '</div>', '', $fld_data, 1),
                                // textbox for contains in ctns_op
                                _build_field('p93', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 ctns_op_txt1 hidden">', '</div>', '', $fld_data, 1),
                                // textbox for operators in ctns_op 
                                _build_field('p94', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 ctns_op_txt2 hidden">', '</div>', '', $fld_data, 2),
                                
                                
                                // page
                                _build_field('p4',  $gid, $key, $so,  array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data, 1),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so,  array('onchange'=>"p2(this)"), '', '<div class="wrp_flds ctns hidden">', '</div>', '', $fld_data, 1),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data, 1),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data, 1),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data, 1),
                                // equals
                                _build_field('p5',  $gid, $key, $so,  array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data, 1),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data, 1),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data, 1),                            
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set6 mt_op">', '</div>', 'Count', $fld_data),
                                // count textbox
                                _build_field('p94', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set0 mt_op_vl">', '</div>', '', $fld_data, 3),
                                '<br clear="all" />'                             
                            )
                      ); 
           
            // Total Time in Focus
            case '_s_mrc5' :    
               return array(
                        'help'=>'Total time that the pages were in focus or active',
                        'title' => 'Total Time in Focus', 
                        'fields'=>
                            array(                                    
                                // page
                                _build_field('p4',  $gid, $key, $so,  array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so,  array('onchange'=>"p2(this)"), '', '<div class="wrp_flds ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5',  $gid, $key, $so,  array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),                                
                                                               
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set6 mt_op">', '</div>', '', $fld_data),
                                // count textbox
                                _build_field('p97', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set0 mt_op_vl">', '</div>', '', $fld_data),
                                
                                '<br clear="all" />'                             
                            )
                      ); 
                        
            // Page Events
            case '_s_mrc6' :    
               return array(
                        'help'=>'Count of page events (i.e. Scrolling, Key Presses and Mouse Clicks)',
                        'title' => 'Page Events', 
                        'fields'=>
                            array(                                    
                                // page
                                _build_field('p4',  $gid, $key, $so,  array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so,  array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so,  array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                
                                // All Events ... 
                                _build_field('p20', $gid, $key, $so,  array(''), '', '<div class="wrp_flds set3 pg_evt">', '</div>', '', $fld_data),
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 mt_op">', '</div>', '', $fld_data),
                                // count textbox
                                _build_field('p98', $gid, $key, $so, array(''), '', '<div class="wrp_flds set0 mt_op_vl">', '</div>', '', $fld_data),
                                  
                                // Current Session - Page Session
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3">', '</div>', 'When', $fld_data),      
                                '<br clear="all" />'                                    
                            )
                      );
                        
            // Total Time on Pages
            case '_s_mrc7' :    
               return array(
                        'help'=>'Total time spent on pages',
                        'title' => 'Total Time on Pages', 
                        'fields'=>
                            array(                                    
                                // page
                                _build_field('p4',  $gid, $key, $so, array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so, array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                
                                // All Events ... 
                                _build_field('p20', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 mt_op">', '</div>', '', $fld_data),
                                // count textbox
                                _build_field('p98', $gid, $key, $so, array(''), '', '<div class="wrp_flds set0 mt_op_vl">', '</div>', '', $fld_data),
                                  
                                // Sum Time- Individual Time
                                _build_field('p21', $gid, $key, $so, array(), '', '<div class="wrp_flds set3">', '</div>', 'Type', $fld_data),      
                                '<br clear="all" />'                                    
                            )
                      );
                        
            // % Time and Focus
            case '_s_mrc8' :    
               return array(
                        'help'=>'Focus Time by Total Time',
                        'title' => '% Time and Focus', 
                        'fields'=>
                            array(                                    
                                // page
                                _build_field('p4',  $gid, $key, $so, array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so, array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                                                
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 mt_op">', '</div>', '', $fld_data),
                                // count textbox
                                _build_field('p98', $gid, $key, $so, array(''), '', '<div class="wrp_flds set0 mt_op_vl">', '</div>', '', $fld_data),                                  
                                      
                                '<br clear="all" />'                                    
                            )
                      );
            
            // % of Pages that Lost Focus
            case '_s_mrc80' :    
               return array(
                        'help'=>'Times that pages lost focus by Total pages viewed in current session.',
                        'title' => '% of Pages that Lost Focus', 
                        'fields'=>
                            array(                                    
                                // page
                                _build_field('p4',  $gid, $key, $so, array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so, array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                                                
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 mt_op">', '</div>', '', $fld_data),
                                // count textbox
                                _build_field('p98', $gid, $key, $so, array(''), '', '<div class="wrp_flds set0 mt_op_vl">', '</div>', '', $fld_data),                                  
                                      
                                '<br clear="all" />'                                    
                            )
                      );
            
            // SSl Connection
            case '_s_mrc9' :    
               return array(
                        'help'=>'Check if the connection protocol is HTTP or HTTPS',
                        'title' => 'SSL Connection', 
                        'fields'=>
                            array(                                    
                                _build_field('p22', $gid, $key, $so, array(''), '', '<div class="wrp_flds set1">', '</div>', '', $fld_data),     
                                '<br clear="all" />'                             
                            )
                      );    
            
            // Page Refresh
            case '_s_mrc10' :    
               return array(
                        'help'=>'No. of times that the page refreshes was performed.',
                        'title' => 'Page Refresh', 
                        'fields'=>
                            array(                                    
                                // page
                                _build_field('p4',  $gid, $key, $so, array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so, array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                                                
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 mt_op">', '</div>', '', $fld_data),
                                // count textbox
                                _build_field('p98', $gid, $key, $so, array(''), '', '<div class="wrp_flds set0 mt_op_vl">', '</div>', '', $fld_data),                                  
                                      
                                '<br clear="all" />'                                    
                            )
                      );
                        
            // Links
            case '_s_mrc11' :    
               return array(
                        'help'=>'Name and type of hyperlinks clicked.',
                        'title' => 'Links', 
                        'fields'=>
                            array(               
                                // All - In - Out
                                _build_field('p23',  $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', 'Type', $fld_data),     
                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 mt_op">', '</div>', '', $fld_data),
                                // count textbox
                                _build_field('p98', $gid, $key, $so, array(''), '', '<div class="wrp_flds set0 mt_op_vl">', '</div>', '', $fld_data),
                                
                                                                                           
                                // page
                                _build_field('p4',  $gid, $key, $so, array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so, array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                                                
                                // Current Session - Page Session
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3">', '</div>', 'When', $fld_data),                                     
                                      
                                '<br clear="all" />'                                    
                            )
                      );
            
            // Pages Visited
            case '_s_mrc13' :    
               return array(
                        'help'=>'Pages in website which the visitors have visited.',
                        'title' => 'Pages Visited', 
                        'fields'=>
                            array(
                                                                                           
                                // page
                                _build_field('p4',  $gid, $key, $so, array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so, array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),                                    
                                      
                                '<br clear="all" />'                                    
                            )
                      );
            
            // Page Views
            case '_s_mrc14' :    
               return array(
                        'help'=>'Number of Page Views.',
                        'title' => 'Page Views', 
                        'fields'=>
                            array(               
                                // All - Unique
                                _build_field('p8',  $gid, $key, $so, array(''), '', '<div class="wrp_flds set1 pg_n_url">', '</div>', '', $fld_data),
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 mt_op">', '</div>', '', $fld_data),
                                // count textbox
                                _build_field('p98', $gid, $key, $so, array(''), '', '<div class="wrp_flds set0 mt_op_vl">', '</div>', '', $fld_data),
                                // page
                                _build_field('p4',  $gid, $key, $so, array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so, array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      );
            
            /* VISITOR PROPERTIES STARTS */
            // IP Address
            case '_s_mrc15' :    
               return array(
                        'help'=>'The visitor\'s IP Address.',
                        'title' => 'IP Address', 
                        'fields'=>
                            array(               
                                                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),
                                // Current Session - Page Session
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3">', '</div>', 'When', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      );
                      
            // My IP
            case '_s_mrc16' :    
               return array(
                        'help'=>'Your IP Address. You do not need to specify anything here. The system will automatically detect your IP',
                        'title' => 'MY Address', 
                        'fields'=>
                            array(    
                                '<br clear="all" />'                                    
                            )
                      );          
                        
            // User ID
            case '_s_mrc17' :    
               return array(
                        'help'=>'Unique user id as defined by Visitor Target.',
                        'title' => 'User ID', 
                        'fields'=>
                            array(               
                                                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      );
            
            // Session Count
            case '_s_mrc18' :    
               return array(
                        'help'=>'Number of sessions since the cookie was created.',
                        'title' => 'Session Count', 
                        'fields'=>
                            array(                                                                
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 mt_op">', '</div>', '', $fld_data),
                                // count textbox
                                _build_field('p98', $gid, $key, $so, array(''), '', '<div class="wrp_flds set0 mt_op_vl">', '</div>', '', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      ); 
            
            // Countries
            case '_s_mrc19' :    
               return array(
                        'help'=>'Countries in which the visitor\'s IP Address is located.',
                        'title' => 'Countries', 
                        'fields'=>
                            array(                                                                
                                // countries multiselect
                                _build_field('p52', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2">', '</div>', 'Countries', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      );
            
            // Regions
            case '_s_mrc20' :    
               return array(
                        'help'=>'Region in which the visitor\'s IP Address is located.',
                        'title' => 'Regions', 
                        'fields'=>
                            array(                                                                
                                // country multiselect
                                _build_field('p53', $gid, $key, $so, array('onchange'=>"p53(this)"), '', '<div class="wrp_flds set2">', '</div>', 'Countries', $fld_data),
                                // states multiselect
                                _build_field('p54', $gid, $key, $so, array(''), '', '<div class="wrp_flds stt set2">', '</div>', 'Regions', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      );
                      
            // Cities
            case '_s_mrc21' :    
               return array(
                        'help'=>'City in which the visitor\'s IP Address is located.',
                        'title' => 'Cities', 
                        'fields'=>
                            array(                                                                
                                // country multiselect
                                _build_field('p53', $gid, $key, $so, array('onchange'=>"p53_ct(this)"), '', '<div class="wrp_flds set2">', '</div>', 'Countries', $fld_data),
                                _build_field('p55', $gid, $key, $so, array(''), '', '<div class="wrp_flds ct set2">', '</div>', 'Cities', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      );          
            
            // Continents
            case '_s_mrc22' :    
               return array(
                        'help'=>'Continent in which the visitor\'s IP Address is located.',
                        'title' => 'Continents', 
                        'fields'=>
                            array(
                                _build_field('p56', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2">', '</div>', 'Continents', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      );
            
            // Visit Type
            case '_s_mrc23' :    
               return array(
                        'help'=>'New or Returning Visitor.',
                        'title' => 'Visit Type', 
                        'fields'=>
                            array(
                                _build_field('p25', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2">', '</div>', 'Visitor Types', $fld_data),
                                
                                // page
                                _build_field('p4',  $gid, $key, $so, array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so, array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                // Current Session - Page Session
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3">', '</div>', 'When', $fld_data),   
                                '<br clear="all" />'                                    
                            )
                      );
            
            // Time since last visit
            case '_s_mrc24' :    
               return array(
                        'help'=>'Time since the view of the last page in previous session.',
                        'title' => 'Time Since Last Visit', 
                        'fields'=>
                            array(
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', 'Time Since Last Visit', $fld_data),
                                // days textbox
                                _build_field('p91', $gid, $key, $so, array(''), '', '<div class="wrp_flds set0 days">', '</div>', 'Days', $fld_data),
                                _build_field('p26', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 hrs">', '</div>', 'Hours', $fld_data),
                                _build_field('p27', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 mins">', '</div>', 'Minutes', $fld_data),                                  
                                '<br clear="all" />'                                    
                            )
                      );
                      
            // System Languages
            case '_s_mrc25' :    
               return array(
                        'help'=>'Browser Language Preference.',
                        'title' => 'Languages', 
                        'fields'=>
                            array(
                                _build_field('p28', $gid, $key, $so, array(''), '', '<div class="wrp_flds lgn set3">', '</div>', 'System Languages', $fld_data),                                  
                                '<br clear="all" />'                                    
                            )
                      );   
                                  
            // Company
            case '_s_mrc26' :    
               return array(
                        'help'=>'Company to which the IP address is assigned.',
                        'title' => 'Companies', 
                        'fields'=>
                            array(
                                _build_field('p99', $gid, $key, $so, array('onkeypress'=>"p99(this)"), '', '<div class="wrp_flds lgn set2">', '</div>', 'Search for Companies', $fld_data),
                                _build_field('p57', $gid, $key, $so, array(''), '', '<div class="wrp_flds cmpny set2">', '</div>', 'Companies', $fld_data),                                  
                                '<br clear="all" />'                                    
                            )
                      );          
            
            /* CAME FROM STARTS HERE */
                                 
            // Keywords
            case '_s_mrc27' :    
               return array(
                        'help'=>'The keywords lead visitor to the website. Separate words in a string using a space between words (e.g. "mobile phone").<br />Separate alternative keywords using a comma (e.g., "mobile&nbsp;phone,&nbsp;cellular").',
                        'title' => 'Keywords', 
                        'fields'=>
                            array(                                    
                                _build_field('p1', $gid, $key, $so, array(''), '', '<div class="wrp_flds set1">', '</div>', '', $fld_data),
                                _build_field('p2', $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3">', '</div>', '', $fld_data),
                                _build_field('p100', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2">', '</div>', '', $fld_data),
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3">', '</div>', 'When', $fld_data),     
                                '<br clear="all" />'                             
                            )
                      );    
                      
            // Direct
            case '_s_mrc28' :    
               return array(
                        'help'=>'Arrival to the website pages directly by typing URL in the browser.',
                        'title' => 'Direct', 
                        'fields'=>
                            array(                                    
                                // page
                                _build_field('p4',  $gid, $key, $so, array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so, array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                                                     
                                '<br clear="all" />'                             
                            )
                      );              
                      
            // Internal Page
            case '_s_mrc29' :    
               return array(
                        'help'=>'Visitors who arrived to the internal website pages by clicking a link in a page within the site.',
                        'title' => 'Internal Page', 
                        'fields'=>
                            array(                                    
                                // page
                                _build_field('p4',  $gid, $key, $so, array('onchange'=>"p4(this)"), '', '<div class="wrp_flds set3 pg_n_url">', '</div>', '', $fld_data),                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 nm_pair hidden">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 val_pair hidden">', '</div>', 'Value', $fld_data),
                                // equals
                                _build_field('p5', $gid, $key, $so, array('onchange'=>"p5(this)"), '', '<div class="wrp_flds set1 hidden eqls hidden">', '</div>', '', $fld_data),
                                // page title multi-select
                                _build_field('p29', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_title hidden">', '</div>', '', $fld_data),
                                // page group multi-select
                                _build_field('p30', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 pg_grp hidden">', '</div>', '', $fld_data),
                                                                     
                                '<br clear="all" />'                             
                            )
                      );          
           
            // Internal Search
            case '_s_mrc30' :    
               return array(
                        'help'=>'Keywords searched in the site (to define an internal search go to Settings).',
                        'title' => 'Internal Search', 
                        'fields'=>
                            array(                              
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3">', '</div>', 'When', $fld_data),                                     
                                '<br clear="all" />'                             
                            )
                      );
             
             
            // Referring Sites
            case '_s_mrc31' :    
               return array(
                        'help'=>'From specific referring sites visitors have reached pages on your website.',
                        'title' => 'Referring Sites', 
                        'fields'=>
                            array(         
                                _build_field('p6',  $gid, $key, $so, array('onchange'=>"p6(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns hidden">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt hidden">', '</div>', '', $fld_data),
                                // name box of the name-value pair                                
                                _build_field('p89', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 nm_pair">', '</div>', 'Name', $fld_data),
                                // value box of the name-value pair
                                _build_field('p90', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 val_pair">', '</div>', 'Value', $fld_data),
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3">', '</div>', 'When', $fld_data),                                     
                                '<br clear="all" />'                             
                            )
                      );  
                      
            // Commercial Domains
            case '_s_mrc32' :    
               return array(
                        'help'=>'Commercial domains which are defined as \'Commercial\' under the \'Referrer Settings\' via the Settings page.',
                        'title' => 'Commercial Domains', 
                        'fields'=>
                            array(         
                                _build_field('p58',  $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns">', '</div>', 'Domains', $fld_data),                                
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3">', '</div>', 'When', $fld_data),                                     
                                '<br clear="all" />'                             
                            )
                      );                  
                      
            // Domain Types
            case '_s_mrc33' :    
               return array(
                        'help'=>'The domain type source that refer to your website pages as set in "Referrer Settings" poge.',
                        'title' => 'Domain Types', 
                        'fields'=>
                            array(         
                                _build_field('p59',  $gid, $key, $so, array('onchange'=>"p59(this)"), '', '<div class="wrp_flds set2">', '</div>', 'Domain Types', $fld_data),
                                _build_field('p60',  $gid, $key, $so, array(), '', '<div class="wrp_flds dmns set2">', '</div>', 'Domains', $fld_data),                                
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3 ">', '</div>', 'When', $fld_data),                                     
                                '<br clear="all" />'                             
                            )
                      );  
            // Referrers
            case '_s_mrc34' :    
               return array(
                        'help'=>'Referring Search Engines (Commercial or Organic) which the visitors came from.',
                        'title' => 'Referrers', 
                        'fields'=>
                            array(         
                                _build_field('p61',  $gid, $key, $so, array('onchange'=>"p61(this)"), '', '<div class="wrp_flds set2">', '</div>', 'Domain Types', $fld_data),
                                _build_field('p62',  $gid, $key, $so, array(), '', '<div class="wrp_flds dmns set2">', '</div>', 'Domains', $fld_data),  
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(), '', '<div class="wrp_flds set6 mt_op hidden">', '</div>', 'Position', $fld_data),
                                // count textbox
                                _build_field('p98', $gid, $key, $so, array(), '', '<div class="wrp_flds set0 mt_op_vl hidden">', '</div>', '', $fld_data),                                   
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3 ">', '</div>', 'When', $fld_data),                                     
                                '<br clear="all" />'                             
                            )
                      );  
                      
                      
             /* VISITOR SYSTEM INFO BEGINS HERE */
                      
            // Visitor OS
            case '_s_mrc35' :    
               return array(
                        'help'=>'Operating System that the visitor is using in the visit.',
                        'title' => 'OS Name', 
                        'fields'=>
                            array(         
                                _build_field('p63',  $gid, $key, $so, array(''), '', '<div class="wrp_flds set2">', '</div>', 'Operating Systems', $fld_data),                                     
                                '<br clear="all" />'                             
                            )
                      );
                      
            // Visitor Browsers
            case '_s_mrc36' :    
               return array(
                        'help'=>'Browser name and version that the visitor is using in the visit.',
                        'title' => 'Browser Name', 
                        'fields'=>
                            array(         
                                _build_field('p64',  $gid, $key, $so, array('onchange'=>"p64(this)"), '', '<div class="wrp_flds set2">', '</div>', 'Web Browsers', $fld_data),
                                _build_field('p65',  $gid, $key, $so, array(''), '', '<div class="wrp_flds br_ver set2">', '</div>', 'Web Browser Versions', $fld_data),                                     
                                '<br clear="all" />'                             
                            )
                      );   
                      
            // Screen Bit Depth
            case '_s_mrc37' :    
               return array(
                        'help'=>'Display bit depth as set in the OS.',
                        'title' => 'Screen Bit Depth', 
                        'fields'=>
                            array(         
                                _build_field('p31',  $gid, $key, $so, array(''), '', '<div class="wrp_flds set2">', '</div>', 'Screen Color Bit Depth', $fld_data),                               
                                '<br clear="all" />'                             
                            )
                      );  

            // Platforms
            case '_s_mrc38' :    
               return array(
                        'help'=>'Browsing device\'s hardware type.',
                        'title' => 'Platform', 
                        'fields'=>
                            array(         
                                _build_field('p66',  $gid, $key, $so, array(''), '', '<div class="wrp_flds set2">', '</div>', 'Platforms', $fld_data),                               
                                '<br clear="all" />'                             
                            )
                      );  
                      
            // Mobile Browsing
            case '_s_mrc39' :    
               return array(
                        'help'=>'Checks if browsing through a mobile device.',
                        'title' => 'Mobile Browsing', 
                        'fields'=>
                            array(         
                                _build_field('p32',  $gid, $key, $so, array(''), '', '<div class="wrp_flds set2">', '</div>', 'Detect Mobile Browsing?', $fld_data),
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3 ">', '</div>', 'When', $fld_data),                               
                                '<br clear="all" />'                             
                            )
                      ); 
                      
             // Browser Settings
            case '_s_mrc40' :    
               return array(
                        'help'=>'Checks if Cookies, Ajax or JavaScript are enabled.',
                        'title' => 'Browser Settings', 
                        'fields'=>
                            array(         
                                _build_field('p33',  $gid, $key, $so, array(''), '', '<div class="wrp_flds set4">', '</div>', '', $fld_data),
                                _build_field('p32',  $gid, $key, $so, array(''), '', '<div class="wrp_flds set6">', '</div>', '', $fld_data),
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3 ">', '</div>', 'When', $fld_data),                               
                                '<br clear="all" />'                             
                            )
                      );      
                                             
            // Media Plugins and Versions
            case '_s_mrc41' :    
               return array(
                        'help'=>'Which media plugins (and their versions) are supported on the visitor\'s browser.',
                        'title' => 'Media Plugins and Versions', 
                        'fields'=>
                            array(         
                                _build_field('p34',  $gid, $key, $so, array(''), '', '<div class="wrp_flds set4">', '</div>', 'Media', $fld_data),
                                _build_field('p67',  $gid, $key, $so, array(''), '', '<div class="wrp_flds set1">', '</div>', 'Versions', $fld_data),                               
                                '<br clear="all" />'                             
                            )
                      );   
            
            // Screen Resolution
            case '_s_mrc42' :    
               return array(
                        'help'=>'Display resolution as set in the OS.',
                        'title' => 'Screen Resolution', 
                        'fields'=>
                            array(         
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', 'Screen Resolution is', $fld_data),
                                _build_field('p68',  $gid, $key, $so, array(''), '', '<div class="wrp_flds set1">', '</div>', '', $fld_data), 
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3 ">', '</div>', 'When', $fld_data),                                
                                '<br clear="all" />'                             
                            )
                      );  
                      
             /* SEGMENTS, ACTIONS AND CONTAINERS BEGIN HERE */
             
            // Actions
            case '_s_mrc43' :    
               return array(
                        'help'=>'Actions executed in the site.',
                        'title' => 'Actions', 
                        'fields'=>
                            array(
                                // action types multiselect    
                                _build_field('p47', $gid, $key, $so, array(), '', '<div class="wrp_flds set5">', '</div>', 'Action Types', $fld_data),
                                // actions according to the selected action types: multiselect    
                                _build_field('p48', $gid, $key, $so, array(), '', '<div class="wrp_flds set5 axns">', '</div>', 'Actions', $fld_data),
                                // action status    
                                _build_field('p35', $gid, $key, $so, array(), '', '<div class="wrp_flds set3 axn_status">', '</div>', 'Actions Status', $fld_data),
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', 'Quantity', $fld_data),                                
                                // textbox for operators 
                                _build_field('p94', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 ctns_op">', '</div>', '', $fld_data),
                                
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3 ">', '</div>', 'When', $fld_data),                                
                                '<br clear="all" />'                             
                            )
                      ); 
                      
                      
            // Containers
            case '_s_mrc44' :    
               return array(
                        'help'=>'Containers and events which occured and number of times they have occured.',
                        'title' => 'Containers', 
                        'fields'=>
                            array(         
                                
                                // container types dropdown    
                                _build_field('p49', $gid, $key, $so, array(), '', '<div class="wrp_flds set4 cntnr_types">', '</div>', 'Container Types', $fld_data),
                                // containers according to the selected container types: multiselect    
                                _build_field('p50', $gid, $key, $so, array(), '', '<div class="wrp_flds set5 cntnrs">', '</div>', 'Containers', $fld_data),
                                // container matching operator dropdowns (contains + operators)
                                _build_field('p51', $gid, $key, $so, array('onchange'=>"p51(this)"), '', '<div class="wrp_flds set3 ctns_op">', '</div>', 'Value', $fld_data),
                                // textbox for contains in ctns_op
                                _build_field('p93', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 ctns_op_txt1">', '</div>', '', $fld_data),
                                // textbox for operators in ctns_op 
                                _build_field('p94', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 ctns_op_txt2 hidden">', '</div>', '', $fld_data),
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', 'Count', $fld_data),
                                // textbox for operators 
                                _build_field('p94', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 ctns_op">', '</div>', '', $fld_data),
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3 ">', '</div>', 'When', $fld_data),                                
                                '<br clear="all" />'                             
                            )
                      );
                      
                      
            // Segments Matched
            case '_s_mrc45' :    
               return array(
                        'help'=>'Segment matched during visitor session .Please note that the rule work from one or more pages ( Or log record ) after the visitor matched the segment ,So if a segment happen for the first time in the session other segment containing that segment will not be trigger on that page they will be trigger from the page later on.',
                        'title' => 'Segments Matched', 
                        'fields'=>
                            array(         
                                // segments matched multiselect    
                                _build_field('p45', $gid, $key, $so, array(), '', '<div class="wrp_flds set3 seg_mtch">', '</div>', 'Segments Matched', $fld_data),
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', 'Happened', $fld_data),
                                // textbox for operators 
                                _build_field('p94', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 ctns_op">', '</div>', '', $fld_data),                                
                                '<br clear="all" />'                             
                            )
                      );      
            
            /* GOALS ACHIEVED BEGINS HERE */
                      
            // Quantity of Goals
            case '_s_mrc46' :    
               return array(
                        'help'=>'Quantity of achieved goals.',
                        'title' => 'Quantity of Goals', 
                        'fields'=>
                            array(         
                                // All, Constant, Variable 
                                _build_field('p36', $gid, $key, $so, array('onchange'=>"p36(this)"), '', '<div class="wrp_flds set3 seg_mtch">', '</div>', 'Goal Type', $fld_data),
                                // goals
                                _build_field('p69', $gid, $key, $so, array(''), '', '<div class="wrp_flds gls set3">', '</div>', 'Goals', $fld_data),
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', 'Happened', $fld_data),
                                // textbox for operators 
                                _build_field('p94', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 ctns_op">', '</div>', '', $fld_data),
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3 ">', '</div>', 'When', $fld_data),                                 
                                '<br clear="all" />'                             
                            )
                      );         
                      
            // Goals Achieved
            case '_s_mrc47' :    
               return array(
                        'help'=>'Total value of the achieved goals.',
                        'title' => 'Goals Achieved', 
                        'fields'=>
                            array(         
                                // Goals 
                                _build_field('p70', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', 'Goals Achieved', $fld_data),
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', 'Happened', $fld_data),
                                // textbox for operators 
                                _build_field('p94', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 ctns_op">', '</div>', '', $fld_data),
                                _build_field('p3', $gid, $key, $so, array(), '', '<div class="wrp_flds set3 ">', '</div>', 'When', $fld_data),                                 
                                '<br clear="all" />'                             
                            )
                      );        
            
            /* BROADCAST BEGINS HERE */
                      
            // Campaigns
            case '_s_mrc48' :    
               return array(
                        'help'=>'Allow you to choose visitor base on the broadcast campaign that are sent during the current session.',
                        'title' => 'Campaigns', 
                        'fields'=>
                            array( 
                                _build_field('p70', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2">', '</div>', 'Available Campaigns', $fld_data),               
                                '<br clear="all" />'                             
                            )
                      );        
             
             
            // Lists
            case '_s_mrc49' :    
               return array(
                        'help'=>'Allow you to choose visitors base on their subscription to one of your mailing list that resulted the current session as part of message distribution to mailing list.',
                        'title' => 'Lists', 
                        'fields'=>
                            array( 
                                _build_field('p71', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', 'Lists', $fld_data),               
                                '<br clear="all" />'                             
                            )
                      );
                 
                                            
            // Messages
            case '_s_mrc50' :    
               return array(
                        'help'=>'Allow you to choose visitor base on the message ( part of the broadcast campaign ) that results in the current session.',
                        'title' => 'Messages', 
                        'fields'=>
                            array( 
                                _build_field('p73', $gid, $key, $so, array('onchange'=>"p73(this)"), '', '<div class="wrp_flds set3">', '</div>', 'Type', $fld_data),
                                _build_field('p74', $gid, $key, $so, array('onchange'=>"p74(this)"), '', '<div class="wrp_flds camp set3">', '</div>', 'Campaigns', $fld_data),
                                _build_field('p75', $gid, $key, $so, array(''), '', '<div class="wrp_flds msg set3">', '</div>', 'Messages', $fld_data),               
                                '<br clear="all" />'                             
                            )
                      ); 
                      
            // Messages Variations
            case '_s_mrc51' :    
               return array(
                        'help'=>'',
                        'title' => 'Variations', 
                        'fields'=>
                            array( 
                                _build_field('p73', $gid, $key, $so, array('onchange'=>"p73(this)"), '', '<div class="wrp_flds set3">', '</div>', 'Type', $fld_data),
                                _build_field('p74', $gid, $key, $so, array('onchange'=>"p74(this)"), '', '<div class="wrp_flds camp set3">', '</div>', 'Campaigns', $fld_data),
                                _build_field('p75', $gid, $key, $so, array('onchange'=>"p75(this)"), '', '<div class="wrp_flds msg set3">', '</div>', 'Messages', $fld_data),
                                _build_field('p76', $gid, $key, $so, array(''), '', '<div class="wrp_flds var set3">', '</div>', 'Variations', $fld_data),               
                                '<br clear="all" />'                             
                            )
                      );         
           
           /* CONTROL GROUP/ROTATION BEGINS HERE */
           
            // Control Group
            case '_s_mrc52' :    
               return array(
                        'help'=>'Allows you to include or exclude % from site\'s total users.',
                        'title' => 'Control Group',
                        'fields'=>
                            array( 
                                _build_field('p37', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', 'Type', $fld_data),
                                _build_field('p101', $gid, $key, $so, array(''), '', '<div class="wrp_flds cg-range-set" style="padding-right: 0;"><div class="wrp_flds l_limit set6 green-bar">', '</div>', '', $fld_data),
                                '<div class="wrp_flds cg-fld-sep green-bar"><div class="del-control-group"></div><br style="line-height:10px" />&mdash;</div>',
                                _build_field('p102', $gid, $key, $so, array(''), '', '<div class="wrp_flds h_limit set6 marginright10 green-bar">', '</div><small class="cg-interval">(Interval 0-100%)</small></div>', '', $fld_data),
                                '<div class="wrp_flds set3"><br /><label class="r_lbl">&nbsp;</label><a class="btn btn5 btn5_add add_cgrp" href="javascript:void(0)" onclick="add_cgrp(this)"><span>Add More</span></a></div>',
                                '<br clear="all" />'                             
                            )
                      );    
                      
            // Rotation            
                      
            case '_s_mrc53' :    
               return array(
                        'help'=>'Rotation- allow you to randomly include % from site user/sessions/pages to the segment.',
                        'title' => 'Rotation',
                        'fields'=>
                            array( 
                                _build_field('p38', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', 'Type', $fld_data),
                                _build_field('p101', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3 rot_pc">', '</div>', 'Percent (1-100%)', $fld_data),                                
                                '<br clear="all" />'                             
                            )
                      ); 
                      
                      
             case '_s_mrc54' :    
               return array(
                        'help'=>'Custom data saved as number.<br />NOTE: You can save data from Facebook, Containers or forms.',
                        'title' => 'Number',
                        'fields'=>
                            array( 
                                _build_field('p39', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', '', $fld_data),
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds set6 op">', '</div>', '', $fld_data),
                                // count textbox
                                _build_field('p94', $gid, $key, $so, array(''), '', '<div class="wrp_flds set0 op_vl">', '</div>', '', $fld_data),                                
                                '<br clear="all" />'                             
                            )
                      );          
                      
           case '_s_mrc55' :    
               return array(
                        'help'=>'Gender preference as specified in the visitor\'s profile. <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Text',
                        'fields'=>
                            array( 
                                _build_field('p40', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', '', $fld_data),
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );          
            
             
            /* FACEBOOK BEGINS HERE */
            
            // FB Birthday            
            case '_s_mrc56' :    
               return array(
                        'help'=>'Birthday date range <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Birthday',
                        'fields'=>
                            array( 
                                _build_field('p80', $gid, $key, $so, array(''), 'datepicker1', '<div class="wrp_flds set1 dp1">', '</div>', 'From', $fld_data),
                                _build_field('p81', $gid, $key, $so, array(''), 'datepicker2', '<div class="wrp_flds set1 dp2">', '</div>', 'To', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );   
             
            // FB Religion            
            case '_s_mrc57' :    
               return array(
                        'help'=>'Religion as specified in the visitor\'s profile <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Religion',
                        'fields'=>
                            array( 
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                      
                                '<br clear="all" />'                             
                            )
                      );
             
            
            // Facebook Current City
            case '_s_mrc58' :    
               return array(
                        'help'=>'Current city <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Current City',
                        'fields'=>
                            array( 
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
            // Facebook Current State
            case '_s_mrc59' :    
               return array(
                        'help'=>'Current State <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Current State',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
                      
            // Facebook Current Country        
            case '_s_mrc60' :    
               return array(
                        'help'=>'Current Country <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Current Country',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
            // Facebook Hometown City
            case '_s_mrc61' :    
               return array(
                        'help'=>'Current Hometown City <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Hometown City',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
            
            // Facebook Hometown State
            case '_s_mrc62' :    
               return array(
                        'help'=>'Current Hometown State <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Hometown State',
                        'fields'=>
                            array( 
                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
            
            // Facebook Hometown Country
            case '_s_mrc63' :    
               return array(
                        'help'=>'Current Hometown Country <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Hometown Country',
                        'fields'=>
                            array( 
                                
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
            
            // Facebook Meeting Gender
            case '_s_mrc64' :    
               return array(
                        'help'=>'Gender preference as specified in the visitor\'s profile <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Meeting Gender',
                        'fields'=>
                            array( 
                                _build_field('p42', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );

             // Facebook Gender
             case '_s_mrc65' :    
               return array(
                        'help'=>'The visitor\'s gender <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Gender',
                        'fields'=>
                            array( 
                                _build_field('p42', $gid, $key, $so, array(''), '', '<div class="wrp_flds set3">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Relationship Status
             case '_s_mrc66' :    
               return array(
                        'help'=>'The relationship status of the visitor <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Relationship Status',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Political Interest
             case '_s_mrc67' :    
               return array(
                        'help'=>'Political views <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Political Interest',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Allowed Restrictions
             case '_s_mrc68' :    
               return array(
                        'help'=>'Allowed restrictions as set in the Facebook profile <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Allowed Restrictions',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Interests
             case '_s_mrc69' :    
               return array(
                        'help'=>'Interests as set in the profile <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Interests',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Website
             case '_s_mrc70' :    
               return array(
                        'help'=>'Visitor\'s website as specified in the profile <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Website',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Education Year
             case '_s_mrc71' :    
               return array(
                        'help'=>'Year that the degree was obtained <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Education Year',
                        'fields'=>
                            array( 
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds op">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p103', $gid, $key, $so, array(''), '', '<div class="wrp_flds set1 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Education Name
             case '_s_mrc72' :    
               return array(
                        'help'=>'Education Program <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Education Name',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Education Degree
             case '_s_mrc73' :    
               return array(
                        'help'=>'Education degree <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Education Degree',
                        'fields'=>
                            array(                                 
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Friends Count
             case '_s_mrc74' :    
               return array(
                        'help'=>'Gender preference as specified in the visitor\'s profile <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Friends Count',
                        'fields'=>
                            array(
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds op">', '</div>', 'Count', $fld_data),
                                // contains textbox
                                _build_field('p98', $gid, $key, $so, array(''), '', '<div class="wrp_flds set1 ctns_txt">', '</div>', '', $fld_data),                                     
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Email
             case '_s_mrc75' :    
               return array(
                        'help'=>'Facebook Email Address. <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.</span>',
                        'title' => 'Facebook Email',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Occupation
             case '_s_mrc76' :    
               return array(
                        'help'=>'Occupation as specified in the visitor\'s profile <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Occupation',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Vehicle Type
             case '_s_mrc77' :    
               return array(
                        'help'=>'Vehicle Type as specified in the visitor\'s profile <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Vehicle Type',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Financial
             case '_s_mrc78' :    
               return array(
                        'help'=>'Facebook Financial <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Financial',
                        'fields'=>
                            array( 
                                // mathematical operators
                                _build_field('p10', $gid, $key, $so, array(''), '', '<div class="wrp_flds op">', '</div>', 'Count', $fld_data),
                                // contains textbox
                                _build_field('p98', $gid, $key, $so, array(''), '', '<div class="wrp_flds set1 ctns_txt">', '</div>', '', $fld_data),                                     
                                '<br clear="all" />'                             
                            )
                      );
                      
             // Facebook Purchase History
             case '_s_mrc79' :    
               return array(
                        'help'=>'Facebook Purchase History <span style="color:red">IMPORTANT: </span>you must have integration configured in the \'Settings\' page.',
                        'title' => 'Facebook Purchase History',
                        'fields'=>
                            array(
                                // contains
                                _build_field('p2',  $gid, $key, $so, array('onchange'=>"p2(this)"), '', '<div class="wrp_flds set3 ctns">', '</div>', '', $fld_data),
                                // contains textbox
                                _build_field('p88', $gid, $key, $so, array(''), '', '<div class="wrp_flds set2 ctns_txt">', '</div>', '', $fld_data),                                        
                                '<br clear="all" />'                             
                            )
                      );
                                                                                                      
        }   
}

function display_rule_fields($key, $gid, $so, $fld_data){
    
    $field = rule_field_sets($key, $gid, $so, $fld_data);
    $op = '';
    foreach($field['fields'] as $fld){
        $op .= $fld;
    }
    
    return array('fields'=>$op, 'title'=>$field['title'], 'help'=>$field['help']);
}

function main_rule_categories(){
    
    $ci = & get_instance();
    $ci->load->language('segmentation_rules', CURRENT_LANGUAGE);
        
    $mrc = array(
        '_mrc0' => array(
                    'title'=> $ci->lang->line('_mrc0'),
                    'sub' => 
                        array(
                            '_s_mrc27' => $ci->lang->line('_s_mrc27'),
                            '_s_mrc13' => $ci->lang->line('_s_mrc13'),
                            '_s_mrc31' => $ci->lang->line('_s_mrc31'),
                            '_s_mrc19' => $ci->lang->line('_s_mrc19'),
                            '_s_mrc14' => $ci->lang->line('_s_mrc14'),
                            '_s_mrc2'  => $ci->lang->line('_s_mrc2'),
                            '_s_mrc18' => $ci->lang->line('_s_mrc18')
                        )
                    ),
                    
        '_mrc1' => array(
                    'title'=> $ci->lang->line('_mrc1'),
                    'sub' => 
                        array(
                            '_s_mrc0'  => $ci->lang->line('_s_mrc0'),
                            '_s_mrc1'  => $ci->lang->line('_s_mrc1'),
                            '_s_mrc2'  => $ci->lang->line('_s_mrc2'),
                            '_s_mrc3'  => $ci->lang->line('_s_mrc3'),
                            '_s_mrc4'  => $ci->lang->line('_s_mrc4'),
                            '_s_mrc5'  => $ci->lang->line('_s_mrc5'),
                            '_s_mrc6'  => $ci->lang->line('_s_mrc6'),
                            '_s_mrc7'  => $ci->lang->line('_s_mrc7'),
                            '_s_mrc8'  => $ci->lang->line('_s_mrc8'),
                            '_s_mrc80' => $ci->lang->line('_s_mrc80'),
                            '_s_mrc9'  => $ci->lang->line('_s_mrc9'),
                            '_s_mrc10' => $ci->lang->line('_s_mrc10'),
                            '_s_mrc11' => $ci->lang->line('_s_mrc11')
                        )
                    ),
         
         '_mrc2' => array(
                    'title'=> $ci->lang->line('_mrc2'),
                    'sub' => 
                        array(                            
                            '_s_mrc13'  => $ci->lang->line('_s_mrc13'),
                            '_s_mrc14'  => $ci->lang->line('_s_mrc14'),
                            '_s_mrc2'  => $ci->lang->line('_s_mrc2')                          
                        )
                    ),           
          
        '_mrc3' => array(
                    'title'=> $ci->lang->line('_mrc3'),
                    'sub' => 
                        array(
                            '_s_mrc15'  => $ci->lang->line('_s_mrc15'),
                            '_s_mrc16'  => $ci->lang->line('_s_mrc16'),
                            '_s_mrc17'  => $ci->lang->line('_s_mrc17'),
                            '_s_mrc18'  => $ci->lang->line('_s_mrc18'),
                            '_s_mrc19'  => $ci->lang->line('_s_mrc19'),
                            '_s_mrc20'  => $ci->lang->line('_s_mrc20'),
                            '_s_mrc21'  => $ci->lang->line('_s_mrc21'),
                            '_s_mrc22'  => $ci->lang->line('_s_mrc22'),
                            '_s_mrc23'  => $ci->lang->line('_s_mrc23'),
                            '_s_mrc24'  => $ci->lang->line('_s_mrc24'),
                            '_s_mrc25'  => $ci->lang->line('_s_mrc25'),
                            '_s_mrc26'  => $ci->lang->line('_s_mrc26')                            
                        )
                    ), 
                    
        '_mrc4' => array(
                    'title'=> $ci->lang->line('_mrc4'),
                    'sub' => 
                        array(
                            '_s_mrc27'  => $ci->lang->line('_s_mrc27'),
                            '_s_mrc28'  => $ci->lang->line('_s_mrc28'),
                            '_s_mrc29'  => $ci->lang->line('_s_mrc29'),
                            '_s_mrc30'  => $ci->lang->line('_s_mrc30'),
                            '_s_mrc31'  => $ci->lang->line('_s_mrc31'),
                            '_s_mrc32'  => $ci->lang->line('_s_mrc32'),
                            '_s_mrc33'  => $ci->lang->line('_s_mrc33'),
                            '_s_mrc34'  => $ci->lang->line('_s_mrc34')                            
                        )
                    ), 
        '_mrc5' => array(
                    'title'=> $ci->lang->line('_mrc5'),
                    'sub' => 
                        array(
                            '_s_mrc35'  => $ci->lang->line('_s_mrc35'),
                            '_s_mrc36'  => $ci->lang->line('_s_mrc36'),
                            '_s_mrc37'  => $ci->lang->line('_s_mrc37'),
                            '_s_mrc38'  => $ci->lang->line('_s_mrc38'),
                            '_s_mrc39'  => $ci->lang->line('_s_mrc39'),
                            '_s_mrc40'  => $ci->lang->line('_s_mrc40'),
                            '_s_mrc41'  => $ci->lang->line('_s_mrc41'),
                            '_s_mrc42'  => $ci->lang->line('_s_mrc42')                            
                        )
                    ),
        '_mrc6' => array(
                    'title'=> $ci->lang->line('_mrc6'),
                    'sub' => 
                        array(
                            '_s_mrc43'  => $ci->lang->line('_s_mrc43'),
                            '_s_mrc44'  => $ci->lang->line('_s_mrc44'),
                            '_s_mrc45'  => $ci->lang->line('_s_mrc45')                           
                        )
                    ),
        '_mrc7' => array(
                    'title'=> $ci->lang->line('_mrc7'),
                    'sub' => 
                        array(
                            '_s_mrc46'  => $ci->lang->line('_s_mrc46'),
                            '_s_mrc47'  => $ci->lang->line('_s_mrc47')                           
                        )
                    ),
        '_mrc8' => array(
                    'title'=> $ci->lang->line('_mrc8'),
                    'sub' => 
                        array(
                            '_s_mrc48'  => $ci->lang->line('_s_mrc48'),
                            '_s_mrc49'  => $ci->lang->line('_s_mrc49'),
                            '_s_mrc50'  => $ci->lang->line('_s_mrc50'),
                            '_s_mrc51'  => $ci->lang->line('_s_mrc51')                           
                        )
                    ),
        '_mrc9' => array(
                    'title'=> $ci->lang->line('_mrc9'),
                    'sub' => 
                        array(
                            '_s_mrc52'  => $ci->lang->line('_s_mrc52'),
                            '_s_mrc53'  => $ci->lang->line('_s_mrc53')                           
                        )
                    ),
        '_mrc10' => array(
                    'title'=> $ci->lang->line('_mrc10'),
                    'sub' => 
                        array(
                            '_s_mrc54'  => $ci->lang->line('_s_mrc54'),
                            '_s_mrc55'  => $ci->lang->line('_s_mrc55')                           
                        )
                    ),
        '_mrc11' => array(
                    'title'=> $ci->lang->line('_mrc11'),
                    'sub' => 
                        array(
                            '_s_mrc56'  => $ci->lang->line('_s_mrc56'),
                            '_s_mrc57'  => $ci->lang->line('_s_mrc57'),
                            '_s_mrc58'  => $ci->lang->line('_s_mrc58'),
                            '_s_mrc59'  => $ci->lang->line('_s_mrc59'),
                            '_s_mrc60'  => $ci->lang->line('_s_mrc60'),
                            '_s_mrc61'  => $ci->lang->line('_s_mrc61'),
                            '_s_mrc62'  => $ci->lang->line('_s_mrc62'),
                            '_s_mrc63'  => $ci->lang->line('_s_mrc63'),
                            '_s_mrc64'  => $ci->lang->line('_s_mrc64'),
                            '_s_mrc65'  => $ci->lang->line('_s_mrc65'),
                            '_s_mrc66'  => $ci->lang->line('_s_mrc66'),
                            '_s_mrc67'  => $ci->lang->line('_s_mrc67'),
                            '_s_mrc68'  => $ci->lang->line('_s_mrc68'),
                            '_s_mrc69'  => $ci->lang->line('_s_mrc69'),
                            '_s_mrc70'  => $ci->lang->line('_s_mrc70'),
                            '_s_mrc71'  => $ci->lang->line('_s_mrc71'),
                            '_s_mrc72'  => $ci->lang->line('_s_mrc72'),
                            '_s_mrc73'  => $ci->lang->line('_s_mrc73'),
                            '_s_mrc74'  => $ci->lang->line('_s_mrc74'),
                            '_s_mrc75'  => $ci->lang->line('_s_mrc75'),
                            '_s_mrc76'  => $ci->lang->line('_s_mrc76'),
                            '_s_mrc77'  => $ci->lang->line('_s_mrc77'),
                            '_s_mrc78'  => $ci->lang->line('_s_mrc78'),
                            '_s_mrc79'  => $ci->lang->line('_s_mrc79')                           
                        )
                    ),
        );  
        
        return $mrc;  
}

function rule_cat_title($catArr, $code){
    foreach($catArr as $v){
        if(isset($v['sub'][$code]))
            return $v['sub'][$code];
    }
}


function two_digit($a){
   return str_pad($a, 2, '0', STR_PAD_LEFT);
}

// page list callback function
function page_list(){
    return array();
}

// page group callback function
function page_group(){
    return array();
}

// segments callback function
function segments(){
    return array();
}

// action types callback function
function action_types(){
    return array();
}

// actions callback function
function actions($axn_type){
    $args = func_get_args();
    return array();
}


// contanier types callback function
function container_types(){
    return array();
}

// container callback function
function containers(){
    $args = func_get_args();
    $axn_type = $args[0];
    return array();
}

// until now dont know where to pick the company data from
function company_list(){
    $args = func_get_args();
    $s = $args[0];
    $sel = $args[1];
    return array();
    //return array('Microsoft', 'Apple', 'BridgeTown', 'Virgin');
}

// Quantity of Goals
function goals($type){
    return array();
}


function goalsAchieved(){
    return array();
}
