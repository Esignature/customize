<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('axn_fields_repo')){
    function axn_fields_repo($code, $defaults = NULL){
        $ci = & get_instance();
        
        $fld = array(
                        
                        'p0' => array(
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
                        
                        'p1' => array(
                                    'type'      =>'static',    
                                    'field'     =>'dropdown', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'', 
                                    'tips'      =>false,     
                                    'data'      =>array(       
                                        'Pixels'    =>'Pixels',    
                                        'Percents'  =>'Percents',
                                        'Auto'      =>'Auto'        
                                     )                   
                                ),
                                    
                        'p2' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'help'=>'',      
                                    'data'=>array( 
                                        'center'        =>'Center',
                                        'top'           =>'Top',
                                        'top-right'     =>'Top-Right',
                                        'right'         =>'Right',
                                        'bottom-right'  =>'Bottom-Right',
                                        'bottom'        =>'Bottom',
                                        'bottom-left'   =>'Bottom-Left',
                                        'left'          =>'Left',
                                        'top-left'      =>'Top-Left',
                                        'top-bar'      =>'Top-Bar'                                        
                                     )
                                ),                    
                        // Animation        
                        'p3' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(),
                                    'help'=>'',      
                                    'data'=>array(
                                        'none'   =>'None',
                                        'slide'  =>'Slide',
                                        'fade'   =>'Fade'
                                     )
                                ),
                        // Delay Type
                        'p4' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(),
                                    'help'=>'',      
                                    'data'=>array(
                                        'dt1'   =>'Regular - fire Action after time delay ended ',
                                        'dt2'   =>'No activity from the first 1 second on page',
                                        'dt3'   =>'No activity after the first 5 seconds on page ',
                                        'dt4'   =>'No activity within set number of seconds'
                                     )
                                ),
                         
                         // Initial State                               
                        'p5' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(),
                                    'help'=>'',      
                                    'data'=>array(
                                        'Normal'     =>'Normal',
                                        'Minimized'  =>'Minimized'
                                     )
                                ),                   
                        // Open on
                        'p6' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(),
                                    'help'=>'',      
                                    'data'=>array(
                                        'Left button clicks'=>'Left button clicks',
                                        'Hover'=>'Hover'
                                     )
                                ),
                        
                        
                        /* FONT PROPS */
                        
                                    
                        'p7' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'everywhere'        =>'Everywhere',
                                        'inside_hyperlinks' =>'Inside Hyperlinks',
                                        'outside_hyperlinks'=>'Outside Hyperlinks'
                                     )
                                ),
                                   
              
                        'p8' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'ignore'=>'Ignore',
                                        'yes'=>'Yes',
                                        'no'=>'No'
                                    )
                                ),
                                                
                        'p9' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'ignore'=>'Ignore',
                                        'yes'=>'Yes',
                                        'no'=>'No'
                                     )   
                                ),
                                    
                        'p10' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                            'ignore'=>'Ignore',
                                            'yes'=>'Yes',
                                            'no'=>'No'
                                        )
                                    ),  
                                        
                        'p11' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                            'ignore'=>'Ignore',
                                            'yes'=>'Yes',
                                            'no'=>'No'
                                        )
                                 ), 
                                    
                        'p12' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                            'ignore'=>'Ignore',
                                            'yes'=>'Yes',
                                            'no'=>'No'
                                        )
                                 ),
                        
                        'p13' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                            'ignore'=>'Ignore',
                                            'yes'=>'Yes',
                                            'no'=>'No'
                                        )
                                 ),
                                    
                                    
                        // Containers according to the selected action types
                        'p14' => array(
                                    'type'      =>'callback',    
                                    'field'     =>'multiselect', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',      
                                    'data'      =>'segmentation:containers',
                                    'tips'      => true                           
                                    ), 
                                    
                                    
                         /* REPLACE TEXT/TOOLTIPS */           
                         
                        'p15' => array(
                                 'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                            'none'=>'None',
                                            'from_start'=>'From Start',
                                            'from_end'=>'From End',
                                            'whole_word'=>'Whole Word',
                                            'regex'=>'Regular Expression'
                                        )                                    
                                    ), 
                        
                                  
                       'p16' => array(
                                    'type'=>'static',   
                                    'field'=>'multiselect', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',
                                    'tips' => true,      
                                    'data'=>array(
                                        '{vt::date}'            =>'{vt::date} &mdash; Current year, month, day',
                                        '{vt::date_short}'      =>'{vt::date_short} &mdash; Current year, numeric month, day',
                                        '{vt::time}'            =>'{vt::time} &mdash; Current hours, minutes, seconds',
                                        '{vt::time_short}'      =>'{vt::time_short} &mdash;  Current hours, minutes',
                                        '{vt::datetime}'        =>'{vt::datetime} &mdash; Current date and time',
                                        '{vt::datetime_short}'  =>'{vt::datetime_short} &mdash; Current date and time (short)',
                                        '{vt::strftime(%d.%m.%Y %H:%M)}'  =>'{vt::strftime(%d.%m.%Y %H:%M)} &mdash; Current date and time (custom format)',
                                        '{vt::vid}'             =>'{vt::vid} &mdash; Visit ID',
                                        '{vt::srch_word}'       =>'{vt::srch_word} &mdash;  Search word',
                                        '{vt::ref_type}'        =>'{vt::ref_type} &mdash; Referrer type',
                                        '{vt::first_vid}'       =>'{vt::1_vid} &mdash; First visit ID',
                                        '{vt::first_srch_word}' =>'{vt::1_srch_word} &mdash; First search word',
                                        '{vt::first_ref_type}'  =>'{vt::1_ref_type} &mdash; First referrer type',
                                        '{vt::url}'             =>'{vt::url} &mdash; Current URL',
                                        '{vt::ref}'             =>'{vt::rf} &mdash; Current referrer',                                        
                                        '{vt::uid}'             =>'{vt::id} &mdash;  User ID',
                                        '{vt::uid_short}'       =>'{vt::id_short} &mdash; A section of User ID',
                                        '{vt::ss_datetime}'     =>'{vt::ss_datetime} &mdash; Session start time',
                                        '{vt::pv}'              =>'{vt::st} &mdash; Number of past visits',
                                        '{vt::lp_datetime}'     =>'{vt::lp_datetime} &mdash; Last past visit time',
                                        '{vt::country}'         =>'{vt::country} &mdash; Country',
                                        '{vt::region}'          =>'{vt::region}} &mdash; Region',
                                        '{vt::city}'            =>'{vt::city} &mdash; City',
                                        '{vt::ip}'              =>'{vt::ip} &mdash; IP address'
                                     )
                                 ),                   
                       
                       // Replace Image
                                                                                                                                                                             
                       'p17' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        'img_pth_bg_img'=>'Image Paths and Background Images',
                                        'img_pth'       =>'Image Paths',
                                        'bg_img'        =>'Background Images'
                                     )
                                 ),      
                    
                       'p18' => array(
                                 'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                            'none'=>'None',
                                            'from_start'=>'From Start',
                                            'from_end'=>'From End',
                                            'whole_word'=>'Whole Word'
                                        )                                    
                                    ), 
                                    
                       // Replace Number                                                                                                                                                      
                       'p19' => array(
                                    'type'=>'static',    
                                    'source'=>'',        
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(                                    
                                        'addition'      =>'Addition (+)',
                                        'substraction'  =>'Substraction (-)',
                                        'multiplication'=>'Multiplication (x)',
                                        'division'      =>'Division (/)'
                                     )
                                ),                     
                      
                        // HTML Loader
                      
                        // Containers according to the selected action types
                        'p20' => array(
                                    'type'      =>'callback',    
                                    'field'     =>'dropdown', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',      
                                    'data'      =>'segmentation:containers',
                                    'tips'      => true                           
                                    ), 
                  
                  
                  
                       // Javascript                  
                  
                       'p21' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                        ''          =>'Set Javascripts',
                                        'pg_reload' =>'Page Reload',
                                        'redirect'  =>'Redirect',
                                        'zoom'      =>'Zoom',
                                        'print'     =>'Print',
                                        'alert'     =>'Alert'
                                        )
                                     ),  
                                             
                         
                      
                      // Delicious Tagometer Badge                                                                                         
                      'p22'  => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(
                                                'Large'=>'Large',
                                                'Small'=>'Small'
                                           )
                                     ),      
                        
                        // Youtube                             
                       'p23' => array(
                                    'type'=>'static',    
                                    'field'=>'dropdown', 
                                    'events' => array(), 
                                    'default'=> '',
                                    'help'=>'',      
                                    'data'=>array(                                    
                                                'regular'   =>'Regular',
                                                'iframe'    =>'Iframe'
                                           )
                                     ),                                
                                             
                       'p24' => array(
                                    'type'      =>'callback',    
                                    'field'     =>'dropdown', 
                                    'events'    => array(), 
                                    'default'   => '',
                                    'help'      =>'',      
                                    'data'      =>'action:adword_tags',
                                    'tips'      => true                           
                                    ), 
                        /*                 
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
                        
                        
                       
                         */
                        
                       
                       
                       
                                     
                       // Textboxes 
                                             
                       // Redirects
                       'p80' => axn_clone_txtbox('', array() , 0, true), // URL
                       'p81' => axn_clone_txtbox('', array() , 0, true), // Domain Name
                       'p82' => axn_clone_txtbox('', array() , 0, true), // URL path
                       'p83' => axn_clone_txtbox('', array() , 0, true), // URL query
                       'p84' => axn_clone_txtbox('', array() , 0, true), // URL fragment
                       'p85' => axn_clone_txtarea('', array() , 5, true, '', 'width: 100% !important;'), // On Shown JS Event
                       'p86' => axn_clone_chkbx(1, array(), false, true), 
                       
                       // Pop Ups
                       'p88' => axn_clone_txtarea('', array() , 0, true),
                       'p89' => axn_clone_txtbox('200', array(), 0, true),  // Width                 
                       'p90' => axn_clone_txtbox('200', array(), 0, true),  // Height                       
                       'p91' => axn_clone_txtbox('', array(), 0, true),     // Style                               
                       'p92' => axn_clone_txtbox(0, array(), 4, true),      // Margin
                       'p93' => axn_clone_txtbox('', array(), 0, true),     // Close Button URL
                       
                       'p94' => axn_clone_button('Browse', array(), false, true),      // Browse Button for Close Button URL                       
                       
                       'p95' => axn_clone_txtbox(0, array(), 0, true),      // Time on Page
                       'p96' => axn_clone_chkbx(1, array(), false, true),   // Closeable
                       'p97' => axn_clone_txtbox(0, array(), 0, true),      // Delay time                       
                       'p98' => axn_clone_chkbx(1, array(), false, true),   // Glass panel                        
                       'p99' => axn_clone_chkbx(1, array(), false, true),   // Minimize title button
                       'p100' => axn_clone_txtbox('', array(), 0, true),     // Minimize button URL
                       'p101' => axn_clone_txtbox('', array(), 0, true),    // Trigger button URL
                       'p102' => axn_clone_txtarea('', array() , 5, true, '', 'width: 100% !important;'), // On Shown JS Event
                       'p103' => axn_clone_txtarea('', array() , 5, true, '', 'width: 100% !important;'), // On Extra JS Event
                       'p104' => axn_clone_txtarea('', array() , 5, true, '', 'width: 100% !important;'), // On Close JS Event                       
                       
                       // Font Props
                       'p105' => axn_clone_txtbox(0, array(), 4, true),      // Font From
                       'p106' => axn_clone_txtbox(1000, array(), 4, true),   // Font To
                       'p107' => axn_clone_txtbox(0, array(), 4, true),      // Font Size
                       'p108' => axn_clone_txtbox('', array(), 7, true),     // Font Color
                       'p109' => axn_clone_txtbox('', array(), 7, true),     // Font BG
                       'p110' => axn_clone_txtbox('', array(), 0, true),     // Classes
                       
                        // Replace Text/Tooltips                        
                        'p111' => axn_clone_txtbox('', array(), 0, true),    // Search Text 
                        'p112' => axn_clone_chkbx(1, array(), false, true, false),  // Search also in
                        'p113' => axn_clone_chkbx(1, array(), false, true, false),  // Case Insensitive
                        'p114' => axn_clone_chkbx(1, array(), false, true),  // Limit the action to specific areas (containers) in the page
                        
                        
                        'p115' => axn_clone_txtarea('', array() , 2, true, '', 'width: 70% !important;'), // Set tooltips
                        'p116' => axn_clone_chkbx(1, array(), false, true),   // Use Tooltip
                        'p117' => axn_clone_txtbox(0, array(), 0, true),     // Set font size (px):
                        //'p118' => axn_clone_txtbox('', array(), 0, true),    // Set text color:                        
                        'p120' => axn_clone_chkbx(1, array(), false, true),  // Replacement is HTML: 
                                                                                                 
                        // Replace Image
                        'p121' => axn_clone_txtbox(0, array(), 5, true),    // Delay By (sec):    
                        
                        // Replace Number
                        'p122' => axn_clone_txtbox(0, array(), 10, true),      // From
                        'p123' => axn_clone_txtbox(0, array(), 10, true),      // To
                        'p124' => axn_clone_txtbox(0, array(), 10, true),      // 
                        
                        // HTML Loader
                        'p125' => axn_clone_txtbox('', array(), 30, true),      // Extract From ID         
                        
                        // Javascript
                        'p126' => axn_clone_txtarea('', array() , 10, true, '', 'width: 100% !important;'),
                        
                        // Email
                        'p127' => axn_clone_txtbox('', array() , 0, true), // From
                        'p128' => axn_clone_txtbox('', array() , 0, true), // To
                        'p129' => axn_clone_txtbox('', array() , 0, true), // Subject     
                        'p130' => axn_clone_chkbx(1, array(), false, true),  // Use Visitor Email   
                        
                        // Form
                        'p131' => axn_clone_txtarea('<table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
    <tbody><tr><td>Name:</td><td><input name="vt__fname" type="text" /></td></tr><tr><td>Email:</td><td><input name="vt__email" required="1" type="email" /></td>
        </tr><tr><td colspan="2"><input name="vt__submit_form" type="submit" value="Submit" /></td></tr></tbody></table>', array() , 0, true),
                        'p132' => axn_clone_txtarea('The form was successfully submitted.', array() , 0, true),     
                        
                        // Add this
                        'p133' => axn_clone_txtbox('', array() , 0, true), // Username
                        'p134' => axn_clone_chkbx(1, array(), false, true),  // w/enable clickback analytics   
                        'p135' => axn_clone_chkbx(1, array(), false, true),  // Open in popup
                        
                        // Youtube
                        'p136' => axn_clone_txtbox('', array() , 0, true),  // Movie Code
                        'p137' => axn_clone_chkbx(1, array() , false, true),  // Remove if not HD
                        
                        // Tweetme
                        'p138' => axn_clone_txtbox('http://www.somesite.com', array() , 0, true), // URL 
                        'p139' => axn_clone_txtbox('RT @yourname', array() , 0, true),
                        'p140' => axn_clone_txtbox('', array() , 0, true),
                        'p141' => axn_clone_txtbox('', array() , 0, true),
                        
                        // Google Analytics
                        'p142' => axn_clone_txtbox('', array() , 0, true),
                        'p143' => axn_clone_txtbox('', array() , 0, true),
                        'p144' => axn_clone_txtbox('', array() , 0, true),
                        'p145' => axn_clone_txtbox('', array() , 0, true),
                        'p146' => axn_clone_txtbox('', array() , 0, true),
                        'p147' => axn_clone_txtbox('', array() , 0, true),
                                                                                                                                                                                                                                                                                                                                   
        );
        
        
         return $fld[$code];       
    }    
}

// clone regular textboxes
function axn_clone_txtbox($default = '', $event = array(), $maxlength = 0, $tips = false, $help = ''){
    
    return array(
        'field'=>'input',
        'events' => $event,
        'default'=> $default,
        'data'=> array(),
        'type'=>'',
        'maxlength'=>$maxlength,
        'tips'=>$tips,
        'help'=>$help
    );
}

// clone regular button
function axn_clone_button($value = '', $event = array(), $disabled = false, $help = ''){
    
    return array(
        'field'=>'button',
        'events' => $event,
        'default'=> $value,
        'disabled'=>$disabled,
        'help'=>$help
    );
}

// clone regular textarea
function axn_clone_txtarea($default = '', $event = array(), $rows = 0, $tips = false, $help = '', $styles=''){
    
    return array(
        'field'=>'textarea',
        'events' => $event,
        'default'=> $default,
        'data'=> array(),
        'type'=>'',
        'rows'=>$rows,
        'tips'=>$tips,
        'help'=>$help,
        'styles'=>$styles
    );
}

// clone regular checkbox
function axn_clone_chkbx($value = 1, $event = array(), $checked = false, $tips = false, $pre_label = true){
    
    return array(
        'field'     => 'checkbox',
        'events'    => $event,
        'default'   => $value,
        'data'      => array(),
        'checked'   => $checked,
        'tips'      => $tips,
        'pre_label' => $pre_label
    );
}


function _axn_build_field($code, $gid, $key, $cevents = array(), $class = '', $wrap_s = '<div class="wrp_flds">', $wrap_e = '</div>', $label='', $fld_data, $set_index=0, $index = '0'){
    $ci = & get_instance();
    $info       = axn_fields_repo($code);
    $type       = isset($info['type'])?$info['type']:'';            // static, remote, file or callback function name
    $field      = $info['field'];
    $events     = $info['events'];          // series of js events, can be overridden, e.g. 'onblur'=>'abcd','onchange'=>'xyz',
    $default    = isset($info['default']) ? $info['default'] : '';         // initial empty value for dropdowns, otherwise default value for other field types
    $data       = isset($info['data']) ? $info['data'] : '';            // have data as 'Commercial:selected' if u need it auto-selected
    $checked    = isset($info['checked']) ? $info['checked']: false;            // have data as 'Commercial:selected' if u need it auto-selected
    $maxlength  = isset($info['maxlength']) ? $info['maxlength'] : 0;
    $rows       = isset($info['rows']) ? $info['rows'] : 0;
    $styles     = isset($info['styles']) ? $info['styles'] : '';
    $tips       = isset($info['tips']) ? $info['tips'] : false;
    $pre_label  = isset($info['pre_label']) ? $info['pre_label'] : false;
    $disabled   = isset($info['disabled']) ? $info['disabled'] : false;
    $field_type = 'form_'.$info['field'];
    $attrib     = '';
    $name       = '_group['.$gid.'][fieldset]['.$key.']['.$code.']['.$set_index.'][]';
    $id         = $code.'-'.$gid.'-'.$key.'-'.md5(microtime(true));    
  
    if(isset($fld_data) && is_array($fld_data) && isset($fld_data['fields'][$key][$code]) && isset($fld_data['fields'][$key][$code][$set_index])) 
        $fld_data = $fld_data['fields'][$key][$code][$set_index];
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
        case 'textarea':    
            $data = array(
              'name'        => $name,
              'id'          => $id,
              'value'       => ($fld_data ? $fld_data[0] : $default),
              'class'       => $class,
              'data-code'   => $code,
              'rows'        => $rows,
              'cols'        => '0',
              'style'       => $styles
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
        case 'button':    
            $data = array(
              'name'        => $name,
              'id'          => $id,
              'content'     => $default,
              'class'       => $class,
              'disabled'    => $disabled
            );
                        
            $events = array_merge($events, $cevents);  //override any event provided in the passed parameter.
            
            // append other available attributes
             $event_str = '';
            foreach($events as $k=>$v){
                if($k && !empty($v))   $data = array_merge($data, array($k=>$v));  
                 $event_str .= $k.'="'.$v.'"';
            }                        
            
            $tips = $tips ? '<a class="tips hidden"></a>' : '';
            
            if(isset($fld_data[$code][$index]) && !empty($fld_data[$code][$index]))  $wrap_s = preg_replace('/hidden/', '', $wrap_s);
            
            if(strstr($wrap_s, 'hidden')){
                $data = array_merge($data, array('disabled'=>'disabled'));
            }
            
            $label = '<label class="r_lbl">&nbsp;</label>';
            //return $wrap_s.$label.$field_type($data)
            
            return $wrap_s.$label.'<a id="'.$id.'" class="btn '.$class.' radius50" href="javascript:void(0)" '. $event_str .'><span>'.$default.'</span></a>'.$wrap_e;
            break; 
        case 'checkbox':    
            $data = array(
              'name'        => $name,
              'id'          => $id,
              'value'       => $default,
              'class'       => $class,
              'data-code'   => $code,
              'checked'     => $checked,
              'pre_label'   => $pre_label
            );
                        
            $events = array_merge($events, $cevents);  //override any event provided in the passed parameter.
            
            // append other available attributes
            foreach($events as $k=>$v){
                if($k && !empty($v))   $data = array_merge($data, array($k=>$v));  
            }                        
            
            $tips = $tips ? '<a class="tips hidden"></a>' : '';
            
            //label
            $label = $label == '' ? '&nbsp;' : $label;
            //$label2 = '<label for="" class="r_lbl">'.$label.$tips.'</label>';
            $label2 = $pre_label ? '<label for="" class="r_lbl">&nbsp;</label>' : '';
            
            if(isset($fld_data[$code][$index]) && !empty($fld_data[$code][$index]))  $wrap_s = preg_replace('/hidden/', '', $wrap_s);
            
            if(strstr($wrap_s, 'hidden')){
                $data = array_merge($data, array('disabled'=>'disabled'));
            }
            return $wrap_s.$label2.$field_type($data).$label.$wrap_e;
            break;    
    } 
    
}




/**** STYLE EDITOR FORM METHODS >> ***********************************************/

function _color_options($label){
    $colors = array('black', 'blue', 'fuchsia', 'gray', 'green', 'lime', 'maroon', 'navy', 'olive', 'orange', 'purple', 'red', 'silver', 'teal', 'white', 'yellow');
    $r = '<tr>
                <th>'.$label.'</th>
                <td><input type="text" class="css-prop-input" />
              <ul style="display: none;">
                <li class="wizard color-selector">Choose Color … <div class="color-chooser"></div></li>
                <li class="inherit">inherit</li>
                <li class="default">transparent</li>
                <li class="matrix">
                    <ul class="color-matrix">';                
                foreach($colors as $c){                    
                    $r .= '<li><img src="images/colorpicker/color_swatch.png" style="background-color:'.$c.';margin-right:5px" title="'.$c.'" /></li>'."\r\n";
                }
                
              $r .= '</ul></li></ul></td>
            </tr>';
     return $r;       
}

function _per_length_options($label, $a=1){
    
        $r= '<tr>
                <th>'.$label.'</th>
                <td><input type="text" class="css-prop-input"/>
                  <ul>';
        
   if($a == 1){ 
        $r.= '
            <li class="wizard percentage">Percentage…</li>
            <li class="wizard length">Length…</li>
            <li class="inherit">inherit</li>
            <li class="default">auto</li>';
   } elseif($a == 2){ 
        $r.=  '
            <li class="wizard percentage">Percentage…</li>
            <li class="wizard length">Length…</li>
            <li class="inherit">inherit</li>
            <li class="default">normal</li>';
            
   } elseif($a == 3){ 
        $r.=  '
            <li class="wizard percentage">Percentage…</li>
            <li class="wizard length">Length…</li>
            <li class="inherit">inherit</li>
            <li>top</li>
            <li>center</li>
            <li>bottom</li>
            <li>left</li>
            <li>right</li>
            <li class="default none">none</li>';
   } elseif($a == 4){ 
        $r.=  '
            <li class="wizard percentage">Percentage…</li>
            <li class="wizard length">Length…</li>
            <li>xx-small</li>
            <li>x-small</li>
            <li>small</li>
            <li class="default">medium</li>
            <li>large</li>
            <li>x-large</li>
            <li>xx-large</li>
            <li>larger</li>
            <li>smaller</li>
            <li class="inherit">inherit</li>';
   } elseif($a == 5){ 
        $r.=  '
            <li class="wizard percentage">Percentage…</li>
            <li class="wizard length">Length…</li>
            <li class="inherit">inherit</li>
            <li class="none default">none</li>';
    } elseif($a == 6){ 
        $r.= '
            <li class="wizard percentage">Percentage…</li>
            <li class="wizard length">Length…</li>
            <li class="inherit">inherit</li>';
    } elseif($a == 7){ 
        $r.=  '
            <li class="wizard percentage">Percentage…</li>
            <li class="wizard length">Length…</li>
            <li class="default">baseline</li>
            <li>sub</li>
            <li>super</li>
            <li>top</li>
            <li>text-top</li>
            <li>middle</li>
            <li>bottom</li>
            <li>text-bottom</li>
            <li>inherit</li>';
    } elseif($a == 8){ 
        $r.=  '
            <li class="wizard length">Length…</li>
            <li class="default inherit">normal</li>
            <li class="inherit">inherit</li>';
    }
    
    $r .= '
        </ul></td></tr>
        <tr style="display:none;" class="pc-entry">
           <th>&nbsp;</th>
           <td><input type="text" class="pc-input" />%<button class="pc-ok"></button><button class="pc-cancel"></button></td>
        </tr>
        <tr style="display:none;" class="length-entry">
           <th>&nbsp;</th>
           <td><input type="text" class="ln-input" />
                <select class="ln-type">
                  <option>ex</option>
                  <option>em</option>
                  <option>px</option>
                  <option>cm</option>
                  <option>mm</option>
                  <option>pc</option>
                  <option>in</option>
                  <option>pt</option>
                </select>
                <button class="pc-ok"></button><button class="pc-cancel"></button>
            </td>
        </tr>';
    
   return $r;        
}

function _border_form($label){
    return '
            <tr>
                <th>'.$label.'</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li>hidden</li>
                    <li>dotted</li>
                    <li>dashed</li>
                    <li>solid</li>
                    <li>double</li>
                    <li>groove</li>
                    <li>ridge</li>
                    <li>inset</li>
                    <li>outset</li>
                    <li class="none default">none</li>
                    <li class="inherit">inherit</li>
                  </ul></td>
              </tr>';
}

function _style_properties_editor(){
    
    return '<div class="cssCollector">                                 
          <table>
            <tbody>
              <tr>
                <th></th>
                <td width="60%"><a href="javascript;" class="css-clear">Clear</a></td>
              </tr>
              '._color_options('background-color').'                                      
              <tr>
                <th>background-image</th>
                <td><input type="text" class="css-prop-input"/ >
                  <ul>
                    <li class="wizard image-selector">Choose image…</li>
                    <li class="inherit">inherit</li>
                    <li class="default none">none</li>
                  </ul></td>
              </tr>'.
              _per_length_options('background-position', 3).'
              <tr>
                <th>background-repeat</th>
                <td><input type="text" class="css-prop-input"/ >
                  <ul>
                    <li class="inherit">inherit</li>
                    <li>repeat-x</li>
                    <li>repeat-y</li>
                    <li>no-repeat</li>
                    <li class="default">repeat</li>
                  </ul></td>
              </tr>
              <tr>
                <th>border</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li class="inherit">inherit</li>
                  </ul></td>
              </tr>'.
              _color_options('border-color').
              _per_length_options('border-top-width').
              _per_length_options('border-top-width').
              _per_length_options('border-right-width').
              _per_length_options('border-bottom-width').
              _per_length_options('border-left-width').
              _border_form('border-top-style').
              _border_form('border-right-style').
              _border_form('border-bottom-style').
              _border_form('border-left-style').
              _color_options('border-top-color').
              _color_options('border-right-color').
              _color_options('border-bottom-color').
              _color_options('border-left-color').
              _per_length_options('bottom').
              _color_options('color').'
              <tr>
                <th>clear</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li class="inherit">inherit</li>
                    <li class="default none">none</li>
                    <li>left</li>
                    <li>right</li>
                    <li>both</li>
                  </ul></td>
              </tr>
              <tr>
                <th>direction</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li class="inherit">inherit</li>
                    <li class="none">none</li>
                    <li class="default">ltr</li>
                    <li>rtl</li>
                  </ul></td>
              </tr>
              <tr>
                <th>display</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li class="default">inline</li>
                    <li>block</li>
                    <li>list-item</li>
                    <li>run-in</li>
                    <li>inline-block</li>
                    <li>table</li>
                    <li>inline-table</li>
                    <li>table-row-group</li>
                    <li>table-header-group</li>
                    <li>table-footer-group</li>
                    <li>table-row</li>
                    <li>table-column-group</li>
                    <li>table-column</li>
                    <li>table-cell</li>
                    <li>table-caption</li>
                    <li>none</li>
                    <li class="inherit">inherit</li>
                  </ul></td>
              </tr>'.
              _per_length_options('font-size', 4).'
              <tr>
                <th>font-weight</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li class="default">normal</li>
                    <li>bold</li>
                    <li>bolder</li>
                    <li>lighter</li>
                    <li>100</li>
                    <li>200</li>
                    <li>300</li>
                    <li>400</li>
                    <li>500</li>
                    <li>600</li>
                    <li>700</li>
                    <li>800</li>
                    <li>900</li>
                    <li>inherit</li>
                  </ul></td>
              </tr>
              <tr>
                <th>float</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li>left</li>
                    <li>right</li>
                    <li class="default none">none</li>
                  </ul></td>
              </tr>'.
              _per_length_options('line-height', 2).
              _per_length_options('left').
              _per_length_options('height').'
              <tr>
                <th>margin</th>
                <td><input type="text" class="css-prop-input" />
                  <ul><li class="inherit">inherit</li></ul></td>
              </tr>'.
              _per_length_options('margin-bottom').
              _per_length_options('margin-top').
              _per_length_options('margin-left').
              _per_length_options('margin-right').
              _per_length_options('max-height', 5).
              _per_length_options('max-width', 5).
              _per_length_options('min-height', 6).
              _per_length_options('min-width', 6).'
              <tr>
                <th>padding</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li class="inherit">inherit</li>
                  </ul></td>
              </tr>'.
              _per_length_options('padding-bottom').
              _per_length_options('padding-top').
              _per_length_options('padding-left').
              _per_length_options('padding-right').'
              <tr>
                <th>position</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li class="default">static</li>
                    <li>relative</li>
                    <li>absolute</li>
                    <li>fixed</li>
                    <li>inherit</li>
                  </ul></td>
              </tr>
              <tr>
                <th>quotes</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li>auto</li>
                    <li>inherit</li>
                  </ul></td>
              </tr>'.
              _per_length_options('right').'
              <tr>
                <th>text-align</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li>left</li>
                    <li>right</li>
                    <li>center</li>
                    <li>justify</li>
                    <li>inherit</li>
                  </ul></td>
              </tr>
              <tr>
                <th>text-decoration</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li class="default">none</li>
                    <li>underline</li>
                    <li>overline</li>
                    <li>line-through</li>
                    <li>blink</li>
                    <li>inherit</li>
                  </ul></td>
              </tr>'.
              _per_length_options('text-indent', 6).'
              <tr>
                <th>text-transform</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li>capitalize</li>
                    <li>uppercase</li>
                    <li>lowercase</li>
                    <li class="default">none</li>
                    <li>inherit</li>
                  </ul></td>
              </tr>'.
              _per_length_options('top').
              _per_length_options('vertical-align', 7).'
              <tr>
                <th>white-space</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li class="default">normal</li>
                    <li>pre</li>
                    <li>nowrap</li>
                    <li>pre-wrap</li>
                    <li>pre-line</li>
                    <li>inherit</li>
                  </ul></td>
              </tr>'.
              _per_length_options('width').
              _per_length_options('word-spacing', 8).'
              <tr>
                <th>z-index</th>
                <td><input type="text" class="css-prop-input" />
                  <ul>
                    <li class="inherit">inherit</li>
                    <li class="default">auto</li>
                  </ul></td>
              </tr>
            </tbody>
          </table></div>';
}

function axn_field_sets($key, $gid, $fld_data){                
    
        switch($key){
            
            // Wysiwyg Editor
            case '_axn0' :    
               return '';
            
            // Redirect
            case '_axn1' :    
               return array(
                        'help'=>'Allows you to perform a page redirection by specifying a URL or changing part of the current URL.',
                        'title' => 'Redirect', 
                        'fields'=>
                            array(                                    
                                _axn_build_field('p80', $gid, $key, array(), '', '<fieldset><legend>Content</legend><div class="wrp_flds set2">', '</div>', 'URL', $fld_data),
                                '<br clear="all" />' ,
                                // Checkbox
                                _axn_build_field('p86', $gid, $key, array('onclick'=>"p86(this)"), '', '<div class="wrp_flds set2">', '</div>', ' Let me choose part of the url to change', $fld_data),
                                '<br clear="all" />' ,
                                _axn_build_field('p0', $gid, $key, array(), '', '<div class="wrp_flds proto set7 hidden">', '</div>', 'Protocol', $fld_data),
                                _axn_build_field('p81', $gid, $key, array(), '', '<div class="wrp_flds dmn set5 hidden">', '</div>', 'Domain name', $fld_data),
                                _axn_build_field('p82', $gid, $key, array(), '', '<div class="wrp_flds url set5 hidden">', '</div>', 'URL Path', $fld_data),
                                _axn_build_field('p83', $gid, $key, array(), '', '<div class="wrp_flds qry set5 hidden">', '</div>', 'URL Query', $fld_data),
                                _axn_build_field('p84', $gid, $key, array(), '', '<div class="wrp_flds frg set5 hidden">', '</div></fieldset>', 'URL Fragment', $fld_data),
                                // JS Event
                                _axn_build_field('p85', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div></fieldset>', 'On shown', $fld_data),
                                '<br clear="all" />'                             
                            )
                      );           
            
            // Pop Up
            case '_axn2' :
            
               $css_props = _style_properties_editor();
                                  
               return array(
                        'help'=>'Allows you to display a customized popup, inlcuding images and text.',
                        'title' => 'Pop Up', 
                        'fields'=>
                            array(
                                _axn_build_field('p88',  $gid, $key, array(), 'editor', '<fieldset><legend>Content</legend><div class="wrp_flds set100 html">', '</div></fieldset>', 'HTML', $fld_data),
                                
                                _axn_build_field('p89',  $gid, $key, array(), 'spn_1', '<fieldset><legend>Style</legend><div class="wrp_flds wdth">', '</div>', 'Width', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p90', $gid, $key, array(), 'spn_1', '<div class="wrp_flds hght">', '</div>', 'Height', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div></fieldset>', 'Style', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                _axn_build_field('p92', $gid, $key, array(), 'spn_2', '<fieldset><legend>Behavior</legend><div class="wrp_flds set1 mrg">', '</div>', 'Margin (px)', $fld_data),
                                _axn_build_field('p2',  $gid, $key, array(), '', '<div class="wrp_flds set3 pos">', '</div>', 'Position', $fld_data),
                                _axn_build_field('p3', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div>', 'Animation Type', $fld_data),
                                
                                _axn_build_field('p93', $gid, $key, array(), '', '<div class="wrp_flds set8 clsimg">', '</div>', 'Close button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.clsimg')"), 'btn_search', '<div class="wrp_flds set1 clsbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />',
                                                                
                                _axn_build_field('p95', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set2 tmopg">', '</div>', 'Time on page (seconds, 0=unlimited)', $fld_data),
                                _axn_build_field('p97', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set4">', '</div>', ' Delay time (in seconds)', $fld_data),
                                _axn_build_field('p4', $gid, $key, array(), '', '<div class="wrp_flds set8">', '</div>', 'Delay Type', $fld_data),
                                '<br clear="all" />',
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', ' Closable (allow dismissing the popup)', $fld_data),
                                _axn_build_field('p98', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', ' Glass Panel', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<fieldset><legend>Minimize Setting</legend><div class="wrp_flds set4">', '</div>', ' Minimize Title Button', $fld_data),
                                '<br clear="all" />'  ,
                                _axn_build_field('p100', $gid, $key, array(), '', '<div class="wrp_flds set8 minimg">', '</div>', 'Minimize Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.minimg')"), 'btn_search', '<div class="wrp_flds set1 minbtn">', '</div>', ' ', $fld_data),
                                
                                _axn_build_field('p101', $gid, $key, array(), '', '<div class="wrp_flds set8 trigimg">', '</div>', 'Trigger Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.trigimg')"), 'btn_search', '<div class="wrp_flds set1 trigbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />'  ,
                                _axn_build_field('p5',  $gid, $key, array(), '', '<div class="wrp_flds set3 initst">', '</div>', 'Initial State', $fld_data),
                                
                                _axn_build_field('p6', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', 'Open On', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div>', 'On shown', $fld_data),
                                _axn_build_field('p103', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div>', 'On extra', $fld_data),
                                _axn_build_field('p104', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div></fieldset>', 'On close', $fld_data),
                                
                                '<br clear="all" />'                                                             
                            )
                      ); 
           
            // Font Properties
            case '_axn3' :    
               return array(
                        'help'=>'Allows you to change font properties, including size, color and style.',
                        'title' => 'Font Properties', 
                        'fields'=>
                            array(
                                '<fieldset><legend>Style</legend>',
                                _axn_build_field('p7', $gid, $key, array(), '', '<fieldset style="width:46%;margin-right:15px;float:left"><legend>Conditions</legend><div class="wrp_flds set3 whr">', '</div>', 'Where to apply?', $fld_data),                                
                                '<br clear="all" />',
                                _axn_build_field('p105', $gid, $key, array(), 'spn_2', '<div class="wrp_flds fntfrm">', '</div>', 'If font-size from', $fld_data),
                                _axn_build_field('p106', $gid, $key, array(), 'spn_3', '<div class="wrp_flds fntto">', '</div>', 'If font-size to', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p8', $gid, $key, array(), '', '<div class="wrp_flds set3 if_fntbld">', '</div>', 'If font bold', $fld_data),
                                _axn_build_field('p9', $gid, $key, array(), '', '<div class="wrp_flds set3 if_fntitl">', '</div>', 'If font italic', $fld_data),
                                _axn_build_field('p10', $gid, $key, array(), '', '<div class="wrp_flds set3 if_fntund">', '</div>', 'If font underlined', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p14', $gid, $key, array(), '', '<div class="wrp_flds set99 cntnr">', '</div></fieldset>', 'Limit the action to
specific areas/containers in the page', $fld_data),
                                
                                
                                _axn_build_field('p107', $gid, $key, array(), 'spn_2', '<fieldset style="width:46%;float:left"><legend>Set To</legend><div class="wrp_flds set3 fntsz">', '</div>', 'Font Size', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p108', $gid, $key, array(), '', '<div class="wrp_flds set3 fntclr">', '</div>', 'Font Color', $fld_data),
                                _axn_build_field('p109', $gid, $key, array(), '', '<div class="wrp_flds set5 fntbgclr">', '</div>', 'Font Background Color', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p11', $gid, $key, array(), '', '<div class="wrp_flds set3 fntbld">', '</div>', 'Font Bold', $fld_data),
                                _axn_build_field('p12', $gid, $key, array(), '', '<div class="wrp_flds set3 fntitl">', '</div>', 'Font Italic', $fld_data),
                                _axn_build_field('p13', $gid, $key, array(), '', '<div class="wrp_flds set3 fntund">', '</div>', 'Font Underline', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p110', $gid, $key, array(), '', '<div class="wrp_flds set99 clses">', '</div></fieldset>', 'Classes', $fld_data),
                                '</fieldset><br clear="all" />'                             
                            )
                      ); 
                      
            // Replace Text/Tooltips
            case '_axn4' :    
               return array(
                        'help'  => 'Allow you to search for text in a page/area and replace it with new text.',
                        'title' => 'Replace Text/Tooltips', 
                        'fields'=>
                            array(
                                _axn_build_field('p116', $gid, $key, array('onclick'=>"p116(this)"), '', '', '', ' Use Tooltip', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p111', $gid, $key, array(), '', '<fieldset style="width:46%;margin-right:15px;float:left"><legend>Search for</legend><div class="wrp_flds set99 srchtxt">', '</div>', 'Search Text', $fld_data),                                
                                '<br clear="all" />',
                                _axn_build_field('p112', $gid, $key, array(), '', '<div class="wrp_flds set3 srchalsoin"><label class="r_lbl">Search also in</label>', '', ' Image path', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p112', $gid, $key, array(), '', '', '', ' Link paths', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p112', $gid, $key, array(), '', '', '</div>', ' Background image', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p7', $gid, $key, array(), '', '<div class="wrp_flds">', '</div>', 'Where to search?', $fld_data),
                                _axn_build_field('p15', $gid, $key, array(), '', '<div class="wrp_flds">', '</div>', 'Match only', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p113', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div>', ' Case Insensitive', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p114', $gid, $key, array('onclick'=>"p114(this)"), '', '<div class="wrp_flds set3 lmt">', '</div>', ' Limit the action to specific areas/ containers in the page ', $fld_data),
                                _axn_build_field('p14', $gid, $key, array(), '', '<div class="wrp_flds set8 cntnr hidden">', '</div></fieldset>', 'Containers', $fld_data),
                                
                                // ------------------------------------------------------------------------------------>
                                
                                '<fieldset style="width:46%;margin-right:15px;float:left"><legend>Set to</legend>',
                                _axn_build_field('p115', $gid, $key, array(), '', '<div class="wrp_flds set99 settltip hidden">', '</div>', 'Set Tooltip', $fld_data),
                                _axn_build_field('p16', $gid, $key, array(), '', '<div class="wrp_flds set99 repltxt">', '</div>', 'Replacement Text', $fld_data),
                                
                                _axn_build_field('p117', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set3 fntsz">', '</div>', 'Set Font Size (px)', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p108', $gid, $key, array(), '', '<div class="wrp_flds set3 fntclr">', '</div>', 'Set Font Color', $fld_data),
                                _axn_build_field('p109', $gid, $key, array(), '', '<div class="wrp_flds set5 fntbgclr">', '</div>', 'Set Font Background Color', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p11', $gid, $key, array(), '', '<div class="wrp_flds set3 fntbld">', '</div>', 'Set Font Bold', $fld_data),
                                _axn_build_field('p12', $gid, $key, array(), '', '<div class="wrp_flds set3 fntitl">', '</div>', 'Set Font Italic', $fld_data),
                                _axn_build_field('p13', $gid, $key, array(), '', '<div class="wrp_flds set3 fntund">', '</div>', 'Set Font Underline', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p120', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div></fieldset>', ' Replacement is HTML', $fld_data),
                                '<br clear="all" />',  
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div></fieldset>', 'On shown', $fld_data),
                                '<br clear="all" />'                               
                            )
                      ); 
           
            // Replace Image
            case '_axn5' :    
               return array(
                        'help'  => 'Allows you to search for an image in a page/area and replace it with new one.',
                        'title' => 'Replace Image', 
                        'fields'=>
                            array(
                                _axn_build_field('p111', $gid, $key, array(), '', '<fieldset style="width:46%;margin-right:15px;float:left"><legend>Content</legend><div class="wrp_flds set99 srchtxt">', '</div>', 'Search', $fld_data),                                
                                _axn_build_field('p113', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div>', ' Case Insensitive', $fld_data),
                                
                                '<br clear="all" />',
                                _axn_build_field('p17', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', 'Search In', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p7', $gid, $key, array(), '', '<div class="wrp_flds">', '</div>', 'Where to search?', $fld_data),
                                _axn_build_field('p18', $gid, $key, array(), '', '<div class="wrp_flds">', '</div>', 'Match only', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p114', $gid, $key, array('onclick'=>"p114(this)"), '', '<div class="wrp_flds set3 lmt">', '</div>', ' Limit the action to specific areas/ containers in the page ', $fld_data),
                                _axn_build_field('p14', $gid, $key, array(), '', '<div class="wrp_flds set8 cntnr hidden">', '</div>', 'Containers', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p100', $gid, $key, array(), '', '<div class="wrp_flds set8 replcimg">', '</div>', 'Replacement Image', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.replcimg')"), 'btn_search', '<div class="wrp_flds set1 replbtn">', '</div></fieldset>', ' ', $fld_data),
                                                                
                                // ------------------------------------------------------------------------------------>
                                
                                '<fieldset style="width:46%;margin-right:15px;float:left"><legend>Action Setting</legend>',
                                _axn_build_field('p121', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set3 dly">', '</div></fieldset>', 'Delay By (sec):', $fld_data),
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset style="width:46%;margin-right:15px;float:left"><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div></fieldset>', 'On shown', $fld_data),
                                '<br clear="all" />'                               
                            )
                      ); 
                                    
            // Replace Number
            case '_axn6' :    
               return array(
                        'help'=>'Allows you to add, substract, multiply or divide all numbers in a page (or area) by a specified number.',
                        'title' => 'Replace Number', 
                        'fields'=>
                            array(     
                                _axn_build_field('p122',  $gid, $key, array(), '', '<fieldset style="width:46%;margin-right:15px;float:left"><legend>Search For</legend><div class="wrp_flds set3">', '</div>', 'From', $fld_data),
                                _axn_build_field('p123',  $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div>', 'To', $fld_data),
                                
                                '<br clear="all" />',
                                _axn_build_field('p114', $gid, $key, array('onclick'=>"p114(this)"), '', '<div class="wrp_flds set3 lmt">', '</div>', ' Limit the action to specific areas/ containers in the page ', $fld_data),
                                _axn_build_field('p14', $gid, $key, array(), '', '<div class="wrp_flds set8 cntnr hidden">', '</div></fieldset>', 'Containers', $fld_data),
                                
                                _axn_build_field('p19', $gid, $key, array(''), '', '<fieldset style="width:46%;margin-right:15px;float:left"><legend>Replace With</legend><div class="wrp_flds set3">', '</div>', 'Operation', $fld_data),
                                _axn_build_field('p124', $gid, $key, array(''), '', '<div class="wrp_flds set3">', '</div></fieldset>', '', $fld_data),
                                '<br clear="all" />',
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div></fieldset>', 'On shown', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      );
                        
            // Style
            case '_axn7' :    
                
               $css_props = _style_properties_editor();
                
               return array(
                        'help'=>'Allows you to change the look and feel of a page or part of it.',
                        'title' => 'Style',
                        'fields'=>
                            array(                                    
                                _axn_build_field('p114', $gid, $key, array('onclick'=>"p114(this)"), '', '<fieldset><legend>Content</legend><div class="wrp_flds set3 lmt">', '</div>', ' Limit the action to specific areas/ containers in the page ', $fld_data),
                                _axn_build_field('p14', $gid, $key, array(), '', '<div class="wrp_flds set8 cntnr hidden">', '</div>', 'Containers', $fld_data),                                      
                                _axn_build_field('p110', $gid, $key, array(), '', '<div class="wrp_flds set99 clses">', '</div>', 'Classes', $fld_data),
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div></fieldset>', 'Style', $fld_data),
                                '<br clear="all" />',
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div></fieldset>', 'On shown', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      );
                        
            // HTML
            case '_axn8' :   
                
               $css_props = _style_properties_editor();
                 
               return array(
                        'help'=>'Allows you to add or change text and images in a page.',
                        'title' => 'HTML', 
                        'fields'=>
                            array(
                                _axn_build_field('p88',  $gid, $key, array(), 'editor', '<fieldset><legend>Content</legend><div class="wrp_flds set100 html">', '</div></fieldset>', 'HTML', $fld_data),
                                
                                _axn_build_field('p89',  $gid, $key, array(), 'spn_1', '<fieldset><legend>Style</legend><div class="wrp_flds wdth">', '</div>', 'Width', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p90', $gid, $key, array(), 'spn_1', '<div class="wrp_flds hght">', '</div>', 'Height', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div></fieldset>', 'Style', $fld_data),                                
                                
                                _axn_build_field('p14', $gid, $key, array(), '', '<fieldset><legend>Action Settings</legend><div class="wrp_flds set8 cntnr">', '</div></fieldset>', 'Containers', $fld_data),
                                      
                                '<br clear="all" />',
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div>', 'On shown', $fld_data),
                                _axn_build_field('p103', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div>', 'On extra', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      );
                        
            // HTML Loader
            case '_axn9' :    
                $css_props = _style_properties_editor();
               return array(
                        'help'=>'Allows you to extract content from other pages in the website and place it in another page.',
                        'title' => 'HTML Loader', 
                        'fields'=>
                            array(                                    
                                _axn_build_field('p80', $gid, $key, array(), '', '<fieldset><legend>Content</legend><div class="wrp_flds set2">', '</div>', 'URL', $fld_data),
                                '<br clear="all" />' ,
                                // Checkbox
                                _axn_build_field('p86', $gid, $key, array('onclick'=>"p86(this)"), '', '<div class="wrp_flds set2">', '</div>', ' Let me choose part of the url to change', $fld_data),
                                '<br clear="all" />' ,
                                _axn_build_field('p0', $gid, $key, array(), '', '<div class="wrp_flds proto set7 hidden">', '</div>', 'Protocol', $fld_data),
                                _axn_build_field('p81', $gid, $key, array(), '', '<div class="wrp_flds dmn set5 hidden">', '</div>', 'Domain name', $fld_data),
                                _axn_build_field('p82', $gid, $key, array(), '', '<div class="wrp_flds url set5 hidden">', '</div>', 'URL Path', $fld_data),
                                _axn_build_field('p83', $gid, $key, array(), '', '<div class="wrp_flds qry set5 hidden">', '</div>', 'URL Query', $fld_data),
                                _axn_build_field('p84', $gid, $key, array(), '', '<div class="wrp_flds frg set5 hidden">', '</div>', 'URL Fragment', $fld_data),
                                '<br clear="all" />' ,
                                _axn_build_field('p20', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', 'From Containers', $fld_data),
                                _axn_build_field('p125', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div></fieldset>', 'Extract From ID', $fld_data),
                                
                                
                                _axn_build_field('p89',  $gid, $key, array(), 'spn_1', '<fieldset><legend>Style</legend><div class="wrp_flds wdth">', '</div>', 'Width', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p90', $gid, $key, array(), 'spn_1', '<div class="wrp_flds hght">', '</div>', 'Height', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div></fieldset>', 'Style', $fld_data),                                
                                
                                _axn_build_field('p14', $gid, $key, array(), '', '<fieldset><legend>Action Settings</legend><div class="wrp_flds set8 cntnr">', '</div></fieldset>', 'Containers', $fld_data),
                                      
                                '<br clear="all" />',
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div>', 'On shown', $fld_data),
                                _axn_build_field('p103', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div>', 'On extra', $fld_data),
                                    
                                '<br clear="all" />'                             
                            )
                      );    
            
            // Image
            case '_axn10' : 
               $css_props = _style_properties_editor();    
               return array(
                        'help'=>'Allows you to add or change banners and images in a page.',
                        'title' => 'Image', 
                        'fields'=>
                            array(                                    
                                
                                _axn_build_field('p93', $gid, $key, array(), '', '<fieldset><legend>Content</legend><div class="wrp_flds set8 clsimg">', '</div>', 'Image URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.clsimg')"), 'btn_search', '<div class="wrp_flds set1 clsbtn">', '</div></fieldset>', ' ', $fld_data),
                                '<br clear="all" />',
                                
                                _axn_build_field('p89',  $gid, $key, array(), 'spn_1', '<fieldset><legend>Style</legend><div class="wrp_flds wdth">', '</div>', 'Width', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p90', $gid, $key, array(), 'spn_1', '<div class="wrp_flds hght">', '</div>', 'Height', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div></fieldset>', 'Style', $fld_data),                                
                                
                                _axn_build_field('p14', $gid, $key, array(), '', '<fieldset><legend>Action Settings</legend><div class="wrp_flds set8 cntnr">', '</div></fieldset>', 'Containers', $fld_data),
                                '<br clear="all" />',
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div>', 'On shown', $fld_data),
                                _axn_build_field('p103', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div></fieldset>', 'On extra', $fld_data),
                                '<br clear="all" />'                             
                            )
                      );
                        
            // Javascript
            case '_axn11' :    
               return array(
                        'help'=>'Allows you to run JavaSctipt code per segment.',
                        'title' => 'Javascript', 
                        'fields'=>
                            array(               
                                _axn_build_field('p21',  $gid, $key, array('onchange'=>"p21(this)"), '', '<fieldset><legend>Content</legend><div class="wrp_flds set3">', '</div>', 'Javascript', $fld_data),     
                                _axn_build_field('p126',  $gid, $key, array(), '', '<div class="wrp_flds set99 ctns">', '</div></fieldset>', '', $fld_data),                                     
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div></fieldset>', 'On shown', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      );
            
            // Emails
            case '_axn12' :    
               return array(
                        'help'=>'Allows you to send an email message to a specific address(es) or to the visitor, whenever the segment is matched.',
                        'title' => 'Email', 
                        'fields'=>
                            array(                                
                                _axn_build_field('p127', $gid, $key, array(), '', '<fieldset><legend>Content</legend><div class="wrp_flds set2">', '</div>', 'From', $fld_data), // From 
                                '<br clear="all" />',                               
                                _axn_build_field('p128', $gid, $key, array(), '', '<div class="wrp_flds set75">', '</div>', 'To', $fld_data), // To
                                _axn_build_field('p130', $gid, $key, array(), '', '<div class="wrp_flds set5">', '</div>', ' Use Visitor Email Address', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p129', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div>', 'Subject', $fld_data),
                                _axn_build_field('p88',  $gid, $key, array(), 'editor', '<div class="wrp_flds set100 html">', '</div></fieldset>', 'Email Body', $fld_data),
                                '<br clear="all" />'                                    
                            )
                      );
            
            // Form
            case '_axn13' :
                $css_props = _style_properties_editor();        
               return array(
                        'help'=>'Easily create form to collect prospect data or to collect data for personalization .You can choose which filed to display you can create custom filed and more. Data collected by the form can be used immediately for personalization or for dynamic param to replace. You can also view (after 90 min) report base on the data collected.',
                        'title' => 'Form', 
                        'fields'=>
                            array(
                                _axn_build_field('p131', $gid, $key, array(), 'editor', '<fieldset><legend>Content</legend><div class="wrp_flds set100 html">', '</div></fieldset>', 'Form', $fld_data),
                                _axn_build_field('p132', $gid, $key, array(), 'editor', '<div class="wrp_flds set100 html">', '</div></fieldset>', 'Message after submission', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p89', $gid, $key, array(), 'spn_1', '<fieldset><legend>Style</legend><div class="wrp_flds wdth">', '</div>', 'Width', $fld_data),
                                _axn_build_field('p1', $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p90', $gid, $key, array(), 'spn_1', '<div class="wrp_flds hght">', '</div>', 'Height', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div></fieldset>', 'Style', $fld_data),                                
                                
                                _axn_build_field('p14', $gid, $key, array(), '', '<fieldset><legend>Action Settings</legend><div class="wrp_flds set8 cntnr">', '</div></fieldset>', 'Containers', $fld_data),
                                '<br clear="all" />',
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div>', 'On shown', $fld_data),
                                _axn_build_field('p103', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div></fieldset>', 'On extra', $fld_data),
                                '<br clear="all" />'                                       
                            )
                      );
                        
            // Add This
            case '_s_axn14_1' :    
                $css_props = _style_properties_editor(); 
               return array(
                        'help'=>'Add an AddThis widget.',
                        'title' => 'Add This', 
                        'fields'=>
                            array(
                                _axn_build_field('p133', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', 'Username', $fld_data),
                                _axn_build_field('p134', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', ' w/Enable clickback analytics', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p89', $gid, $key, array(), 'spn_1', '<fieldset><legend>Style</legend><div class="wrp_flds wdth">', '</div>', 'Width', $fld_data),
                                _axn_build_field('p1', $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p90', $gid, $key, array(), 'spn_1', '<div class="wrp_flds hght">', '</div>', 'Height', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div></fieldset>', 'Style', $fld_data),                                
                                
                                _axn_build_field('p14', $gid, $key, array(), '', '<fieldset><legend>Action Settings</legend><div class="wrp_flds set8 cntnr">', '</div></fieldset>', 'Containers', $fld_data),
                                _axn_build_field('p135', $gid, $key, array('onclick'=>"p135(this)"), '', '<div class="wrp_flds set2">', '</div>', ' Put in pop-up', $fld_data),                                
                                
                                
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                '<br clear="all" />',
                                _axn_build_field('p92', $gid, $key, array(), 'spn_2', '<fieldset class="popup hidden"><legend>Behavior</legend><div class="wrp_flds set1 mrg">', '</div>', 'Margin (px)', $fld_data),
                                _axn_build_field('p2',  $gid, $key, array(), '', '<div class="wrp_flds set3 pos">', '</div>', 'Position', $fld_data),
                                _axn_build_field('p3', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div>', 'Animation Type', $fld_data),
                                
                                _axn_build_field('p93', $gid, $key, array(), '', '<div class="wrp_flds set8 clsimg">', '</div>', 'Close button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.clsimg')"), 'btn_search', '<div class="wrp_flds set1 clsbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />',
                                                                
                                _axn_build_field('p95', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set2 tmopg">', '</div>', 'Time on page (seconds, 0=unlimited)', $fld_data),
                                _axn_build_field('p97', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set4">', '</div>', ' Delay time (in seconds)', $fld_data),
                                _axn_build_field('p4', $gid, $key, array(), '', '<div class="wrp_flds set8">', '</div>', 'Delay Type', $fld_data),
                                '<br clear="all" />',
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', ' Closable (allow dismissing the popup)', $fld_data),
                                _axn_build_field('p98', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', ' Glass Panel', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<fieldset class="popup hidden"><legend>Minimize Setting</legend><div class="wrp_flds set4">', '</div>', ' Minimize Title Button', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p100', $gid, $key, array(), '', '<div class="wrp_flds set8 minimg">', '</div>', 'Minimize Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.minimg')"), 'btn_search', '<div class="wrp_flds set1 minbtn">', '</div>', ' ', $fld_data),
                                
                                _axn_build_field('p101', $gid, $key, array(), '', '<div class="wrp_flds set8 trigimg">', '</div>', 'Trigger Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.trigimg')"), 'btn_search', '<div class="wrp_flds set1 trigbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />'  ,
                                _axn_build_field('p5',  $gid, $key, array(), '', '<div class="wrp_flds set3 initst">', '</div>', 'Initial State', $fld_data),
                                
                                _axn_build_field('p6', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', 'Open On', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                '<br clear="all" />',
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div>', 'On shown', $fld_data),
                                _axn_build_field('p103', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div>', 'On extra', $fld_data),
                                _axn_build_field('p104', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div></fieldset>', 'On close', $fld_data),
                                '<br clear="all" />'      
                            )
                      );
                      
            // Share this
            case '_s_axn14_2' :    
               $css_props = _style_properties_editor(); 
               return array(
                        'help'=>'Add a ShareThis widget.',
                        'title' => 'Share This', 
                        'fields'=>
                            array(
                                _axn_build_field('p133', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', 'Publisher', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p89', $gid, $key, array(), 'spn_1', '<fieldset><legend>Style</legend><div class="wrp_flds wdth">', '</div>', 'Width', $fld_data),
                                _axn_build_field('p1', $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p90', $gid, $key, array(), 'spn_1', '<div class="wrp_flds hght">', '</div>', 'Height', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div></fieldset>', 'Style', $fld_data),                                
                                
                                _axn_build_field('p14', $gid, $key, array(), '', '<fieldset><legend>Action Settings</legend><div class="wrp_flds set8 cntnr">', '</div></fieldset>', 'Containers', $fld_data),
                                _axn_build_field('p135', $gid, $key, array('onclick'=>"p135(this)"), '', '<div class="wrp_flds set2">', '</div>', ' Put in pop-up', $fld_data),                                
                                
                                
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                '<br clear="all" />',
                                _axn_build_field('p92', $gid, $key, array(), 'spn_2', '<fieldset class="popup hidden"><legend>Behavior</legend><div class="wrp_flds set1 mrg">', '</div>', 'Margin (px)', $fld_data),
                                _axn_build_field('p2',  $gid, $key, array(), '', '<div class="wrp_flds set3 pos">', '</div>', 'Position', $fld_data),
                                _axn_build_field('p3', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div>', 'Animation Type', $fld_data),
                                
                                _axn_build_field('p93', $gid, $key, array(), '', '<div class="wrp_flds set8 clsimg">', '</div>', 'Close button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.clsimg')"), 'btn_search', '<div class="wrp_flds set1 clsbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />',
                                                                
                                _axn_build_field('p95', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set2 tmopg">', '</div>', 'Time on page (seconds, 0=unlimited)', $fld_data),
                                _axn_build_field('p97', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set4">', '</div>', ' Delay time (in seconds)', $fld_data),
                                _axn_build_field('p4', $gid, $key, array(), '', '<div class="wrp_flds set8">', '</div>', 'Delay Type', $fld_data),
                                '<br clear="all" />',
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', ' Closable (allow dismissing the popup)', $fld_data),
                                _axn_build_field('p98', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', ' Glass Panel', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<fieldset class="popup hidden"><legend>Minimize Setting</legend><div class="wrp_flds set4">', '</div>', ' Minimize Title Button', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p100', $gid, $key, array(), '', '<div class="wrp_flds set8 minimg">', '</div>', 'Minimize Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.minimg')"), 'btn_search', '<div class="wrp_flds set1 minbtn">', '</div>', ' ', $fld_data),
                                
                                _axn_build_field('p101', $gid, $key, array(), '', '<div class="wrp_flds set8 trigimg">', '</div>', 'Trigger Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.trigimg')"), 'btn_search', '<div class="wrp_flds set1 trigbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />'  ,
                                _axn_build_field('p5',  $gid, $key, array(), '', '<div class="wrp_flds set3 initst">', '</div>', 'Initial State', $fld_data),
                                
                                _axn_build_field('p6', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', 'Open On', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                '<br clear="all" />',
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div>', 'On shown', $fld_data),
                                _axn_build_field('p103', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div></fieldset>', 'On extra', $fld_data),
                                '<br clear="all" />'      
                            )
                      );        
                        
            // Delicious Tagometer Badge
            case '_s_axn14_3' :    
               $css_props = _style_properties_editor(); 
               return array(
                        'help'=>'Add a Delicious widget.',
                        'title' => 'Delicious Tagometer Badge', 
                        'fields'=>
                            array(
                                _axn_build_field('p22', $gid, $key, array(), '', '<div class="wrp_flds set1">', '</div>', 'Size', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p89', $gid, $key, array(), 'spn_1', '<fieldset><legend>Style</legend><div class="wrp_flds wdth">', '</div>', 'Width', $fld_data),
                                _axn_build_field('p1', $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p90', $gid, $key, array(), 'spn_1', '<div class="wrp_flds hght">', '</div>', 'Height', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div></fieldset>', 'Style', $fld_data),                                
                                
                                _axn_build_field('p14', $gid, $key, array(), '', '<fieldset><legend>Action Settings</legend><div class="wrp_flds set8 cntnr">', '</div></fieldset>', 'Containers', $fld_data),
                                _axn_build_field('p135', $gid, $key, array('onclick'=>"p135(this)"), '', '<div class="wrp_flds set2">', '</div>', ' Put in pop-up', $fld_data),                                
                                
                                
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                '<br clear="all" />',
                                _axn_build_field('p92', $gid, $key, array(), 'spn_2', '<fieldset class="popup hidden"><legend>Behavior</legend><div class="wrp_flds set1 mrg">', '</div>', 'Margin (px)', $fld_data),
                                _axn_build_field('p2',  $gid, $key, array(), '', '<div class="wrp_flds set3 pos">', '</div>', 'Position', $fld_data),
                                _axn_build_field('p3', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div>', 'Animation Type', $fld_data),
                                
                                _axn_build_field('p93', $gid, $key, array(), '', '<div class="wrp_flds set8 clsimg">', '</div>', 'Close button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.clsimg')"), 'btn_search', '<div class="wrp_flds set1 clsbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />',
                                                                
                                _axn_build_field('p95', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set2 tmopg">', '</div>', 'Time on page (seconds, 0=unlimited)', $fld_data),
                                _axn_build_field('p97', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set4">', '</div>', ' Delay time (in seconds)', $fld_data),
                                _axn_build_field('p4', $gid, $key, array(), '', '<div class="wrp_flds set8">', '</div>', 'Delay Type', $fld_data),
                                '<br clear="all" />',
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', ' Closable (allow dismissing the popup)', $fld_data),
                                _axn_build_field('p98', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', ' Glass Panel', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<fieldset class="popup hidden"><legend>Minimize Setting</legend><div class="wrp_flds set4">', '</div>', ' Minimize Title Button', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p100', $gid, $key, array(), '', '<div class="wrp_flds set8 minimg">', '</div>', 'Minimize Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.minimg')"), 'btn_search', '<div class="wrp_flds set1 minbtn">', '</div>', ' ', $fld_data),
                                
                                _axn_build_field('p101', $gid, $key, array(), '', '<div class="wrp_flds set8 trigimg">', '</div>', 'Trigger Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.trigimg')"), 'btn_search', '<div class="wrp_flds set1 trigbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />'  ,
                                _axn_build_field('p5',  $gid, $key, array(), '', '<div class="wrp_flds set3 initst">', '</div>', 'Initial State', $fld_data),
                                
                                _axn_build_field('p6', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', 'Open On', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                '<br clear="all" />',
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div>', 'On shown', $fld_data),
                                _axn_build_field('p103', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div></fieldset>', 'On extra', $fld_data),
                                '<br clear="all" />'      
                            )
                      );
                      
            // YouTube
            case '_s_axn14_4' :    
               $css_props = _style_properties_editor(); 
               return array(
                        'help'=>'Add a YouTube widget.',
                        'title' => 'YouTube', 
                        'fields'=>
                            array(
                                _axn_build_field('p23', $gid, $key, array(), '', '<div class="wrp_flds set1">', '</div>', 'Display Format', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p136', $gid, $key, array(), '', '<div class="wrp_flds set75">', '</div>', 'Movie Code', $fld_data),
                                _axn_build_field('p137', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div>', ' Remove if not HD ', $fld_data),
                                
                                '<br clear="all" />',
                                _axn_build_field('p89', $gid, $key, array(), 'spn_1', '<fieldset><legend>Style</legend><div class="wrp_flds wdth">', '</div>', 'Width', $fld_data),
                                _axn_build_field('p1', $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p90', $gid, $key, array(), 'spn_1', '<div class="wrp_flds hght">', '</div>', 'Height', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div></fieldset>', 'Style', $fld_data),                                
                                
                                _axn_build_field('p14', $gid, $key, array(), '', '<fieldset><legend>Action Settings</legend><div class="wrp_flds set8 cntnr">', '</div></fieldset>', 'Containers', $fld_data),
                                _axn_build_field('p135', $gid, $key, array('onclick'=>"p135(this)"), '', '<div class="wrp_flds set2">', '</div>', ' Put in pop-up', $fld_data),                                
                                
                                
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                '<br clear="all" />',
                                _axn_build_field('p92', $gid, $key, array(), 'spn_2', '<fieldset class="popup hidden"><legend>Behavior</legend><div class="wrp_flds set1 mrg">', '</div>', 'Margin (px)', $fld_data),
                                _axn_build_field('p2',  $gid, $key, array(), '', '<div class="wrp_flds set3 pos">', '</div>', 'Position', $fld_data),
                                _axn_build_field('p3', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div>', 'Animation Type', $fld_data),
                                
                                _axn_build_field('p93', $gid, $key, array(), '', '<div class="wrp_flds set8 clsimg">', '</div>', 'Close button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.clsimg')"), 'btn_search', '<div class="wrp_flds set1 clsbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />',
                                                                
                                _axn_build_field('p95', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set2 tmopg">', '</div>', 'Time on page (seconds, 0=unlimited)', $fld_data),
                                _axn_build_field('p97', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set4">', '</div>', ' Delay time (in seconds)', $fld_data),
                                _axn_build_field('p4', $gid, $key, array(), '', '<div class="wrp_flds set8">', '</div>', 'Delay Type', $fld_data),
                                '<br clear="all" />',
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', ' Closable (allow dismissing the popup)', $fld_data),
                                _axn_build_field('p98', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', ' Glass Panel', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<fieldset class="popup hidden"><legend>Minimize Setting</legend><div class="wrp_flds set4">', '</div>', ' Minimize Title Button', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p100', $gid, $key, array(), '', '<div class="wrp_flds set8 minimg">', '</div>', 'Minimize Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.minimg')"), 'btn_search', '<div class="wrp_flds set1 minbtn">', '</div>', ' ', $fld_data),
                                
                                _axn_build_field('p101', $gid, $key, array(), '', '<div class="wrp_flds set8 trigimg">', '</div>', 'Trigger Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.trigimg')"), 'btn_search', '<div class="wrp_flds set1 trigbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />'  ,
                                _axn_build_field('p5',  $gid, $key, array(), '', '<div class="wrp_flds set3 initst">', '</div>', 'Initial State', $fld_data),
                                
                                _axn_build_field('p6', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', 'Open On', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                '<br clear="all" />',
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div>', 'On shown', $fld_data),
                                _axn_build_field('p103', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div></fieldset>', 'On extra', $fld_data),
                                '<br clear="all" />'      
                            )
                      ); 
                      
            // Forward back buttons
            case '_s_axn14_5' :    
               $css_props = _style_properties_editor(); 
               return array(
                        'help'=>'Add forward and backward buttons to a page.',
                        'title' => 'Forward and Back buttons', 
                        'fields'=>
                            array(
                                _axn_build_field('p93', $gid, $key, array(), '', '<div class="wrp_flds set8 clsimg">', '</div>', 'Forward Button Image URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.clsimg')"), 'btn_search', '<div class="wrp_flds set1 clsbtn">', '</div>', ' ', $fld_data),
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div>', 'Forward button CSS', $fld_data),
                                
                                '<br clear="all" />',
                                _axn_build_field('p100', $gid, $key, array(), '', '<div class="wrp_flds set8 minimg">', '</div>', 'Back Button Image URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.minimg')"), 'btn_search', '<div class="wrp_flds set1 minbtn">', '</div>', ' ', $fld_data),
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div>', 'Back button CSS', $fld_data),

                                
                                '<br clear="all" />',
                                _axn_build_field('p89', $gid, $key, array(), 'spn_1', '<fieldset><legend>Style</legend><div class="wrp_flds wdth">', '</div>', 'Width', $fld_data),
                                _axn_build_field('p1', $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p90', $gid, $key, array(), 'spn_1', '<div class="wrp_flds hght">', '</div>', 'Height', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div></fieldset>', 'Style', $fld_data),                                
                                
                                _axn_build_field('p14', $gid, $key, array(), '', '<fieldset><legend>Action Settings</legend><div class="wrp_flds set8 cntnr">', '</div></fieldset>', 'Containers', $fld_data),
                                _axn_build_field('p135', $gid, $key, array('onclick'=>"p135(this)"), '', '<div class="wrp_flds set2">', '</div>', ' Put in pop-up', $fld_data),                                
                                
                                
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                '<br clear="all" />',
                                _axn_build_field('p92', $gid, $key, array(), 'spn_2', '<fieldset class="popup hidden"><legend>Behavior</legend><div class="wrp_flds set1 mrg">', '</div>', 'Margin (px)', $fld_data),
                                _axn_build_field('p2',  $gid, $key, array(), '', '<div class="wrp_flds set3 pos">', '</div>', 'Position', $fld_data),
                                _axn_build_field('p3', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div>', 'Animation Type', $fld_data),
                                
                                _axn_build_field('p93', $gid, $key, array(), '', '<div class="wrp_flds set8 clsimg">', '</div>', 'Close button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.clsimg')"), 'btn_search', '<div class="wrp_flds set1 clsbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />',
                                                                
                                _axn_build_field('p95', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set2 tmopg">', '</div>', 'Time on page (seconds, 0=unlimited)', $fld_data),
                                _axn_build_field('p97', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set4">', '</div>', ' Delay time (in seconds)', $fld_data),
                                _axn_build_field('p4', $gid, $key, array(), '', '<div class="wrp_flds set8">', '</div>', 'Delay Type', $fld_data),
                                '<br clear="all" />',
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', ' Closable (allow dismissing the popup)', $fld_data),
                                _axn_build_field('p98', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', ' Glass Panel', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<fieldset class="popup hidden"><legend>Minimize Setting</legend><div class="wrp_flds set4">', '</div>', ' Minimize Title Button', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p100', $gid, $key, array(), '', '<div class="wrp_flds set8 minimg">', '</div>', 'Minimize Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.minimg')"), 'btn_search', '<div class="wrp_flds set1 minbtn">', '</div>', ' ', $fld_data),
                                
                                _axn_build_field('p101', $gid, $key, array(), '', '<div class="wrp_flds set8 trigimg">', '</div>', 'Trigger Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.trigimg')"), 'btn_search', '<div class="wrp_flds set1 trigbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />'  ,
                                _axn_build_field('p5',  $gid, $key, array(), '', '<div class="wrp_flds set3 initst">', '</div>', 'Initial State', $fld_data),
                                
                                _axn_build_field('p6', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', 'Open On', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                '<br clear="all" />',
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div>', 'On shown', $fld_data),
                                _axn_build_field('p103', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div></fieldset>', 'On extra', $fld_data),
                                '<br clear="all" />'      
                            )
                      );
                      
            // TweetMeMe
            case '_s_axn14_6' :    
               $css_props = _style_properties_editor(); 
               return array(
                        'help'=>'Add a Tweetmeme widget.',
                        'title' => 'TweetMeMe', 
                        'fields'=>
                            array(
                                _axn_build_field('p138', $gid, $key, array(), '', '<div class="wrp_flds set8">', '</div>', 'URL', $fld_data),
                                _axn_build_field('p139', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', 'Tweetmeme Source', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p140', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', 'Tweetmeme Style', $fld_data),                                
                                _axn_build_field('p141', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', 'Tweetmeme Service', $fld_data),

                                '<br clear="all" />',
                                _axn_build_field('p89', $gid, $key, array(), 'spn_1', '<fieldset><legend>Style</legend><div class="wrp_flds wdth">', '</div>', 'Width', $fld_data),
                                _axn_build_field('p1', $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p90', $gid, $key, array(), 'spn_1', '<div class="wrp_flds hght">', '</div>', 'Height', $fld_data),
                                _axn_build_field('p1',  $gid, $key, array(), '', '<div class="wrp_flds wdthpxl">', '</div>', '', $fld_data),
                                
                                _axn_build_field('p91', $gid, $key, array(), 'style_ph', '<div class="wrp_flds set2 relative styl">', $css_props.'</div></fieldset>', 'Style', $fld_data),                                
                                
                                _axn_build_field('p14', $gid, $key, array(), '', '<fieldset><legend>Action Settings</legend><div class="wrp_flds set8 cntnr">', '</div></fieldset>', 'Containers', $fld_data),
                                _axn_build_field('p135', $gid, $key, array('onclick'=>"p135(this)"), '', '<div class="wrp_flds set2">', '</div>', ' Put in pop-up', $fld_data),                                
                                
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                '<br clear="all" />',
                                _axn_build_field('p92', $gid, $key, array(), 'spn_2', '<fieldset class="popup hidden"><legend>Behavior</legend><div class="wrp_flds set1 mrg">', '</div>', 'Margin (px)', $fld_data),
                                _axn_build_field('p2',  $gid, $key, array(), '', '<div class="wrp_flds set3 pos">', '</div>', 'Position', $fld_data),
                                _axn_build_field('p3', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div>', 'Animation Type', $fld_data),
                                
                                _axn_build_field('p93', $gid, $key, array(), '', '<div class="wrp_flds set8 clsimg">', '</div>', 'Close button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.clsimg')"), 'btn_search', '<div class="wrp_flds set1 clsbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />',
                                                                
                                _axn_build_field('p95', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set2 tmopg">', '</div>', 'Time on page (seconds, 0=unlimited)', $fld_data),
                                _axn_build_field('p97', $gid, $key, array(), 'spn_2', '<div class="wrp_flds set4">', '</div>', ' Delay time (in seconds)', $fld_data),
                                _axn_build_field('p4', $gid, $key, array(), '', '<div class="wrp_flds set8">', '</div>', 'Delay Type', $fld_data),
                                '<br clear="all" />',
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<div class="wrp_flds set2">', '</div>', ' Closable (allow dismissing the popup)', $fld_data),
                                _axn_build_field('p98', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', ' Glass Panel', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                _axn_build_field('p96', $gid, $key, array(), '', '<fieldset class="popup hidden"><legend>Minimize Setting</legend><div class="wrp_flds set4">', '</div>', ' Minimize Title Button', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p100', $gid, $key, array(), '', '<div class="wrp_flds set8 minimg">', '</div>', 'Minimize Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.minimg')"), 'btn_search', '<div class="wrp_flds set1 minbtn">', '</div>', ' ', $fld_data),
                                
                                _axn_build_field('p101', $gid, $key, array(), '', '<div class="wrp_flds set8 trigimg">', '</div>', 'Trigger Button URL', $fld_data),
                                _axn_build_field('p94', $gid, $key, array('onclick'=>"p94(this, '.trigimg')"), 'btn_search', '<div class="wrp_flds set1 trigbtn">', '</div>', ' ', $fld_data),
                                '<br clear="all" />'  ,
                                _axn_build_field('p5',  $gid, $key, array(), '', '<div class="wrp_flds set3 initst">', '</div>', 'Initial State', $fld_data),
                                
                                _axn_build_field('p6', $gid, $key, array(), '', '<div class="wrp_flds set3">', '</div></fieldset>', 'Open On', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                
                                '<br clear="all" />',
                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div>', 'On shown', $fld_data),
                                _axn_build_field('p103', $gid, $key, array(), '', '<div class="wrp_flds set99">', '</div></fieldset>', 'On extra', $fld_data),
                                '<br clear="all" />'      
                            )
                      );       
                                      
            // Google Analytics
            case '_s_axn15_1' :    
               $css_props = _style_properties_editor(); 
               return array(
                        'help'=>'Allows you to transmit Goal events and values to Google Analytics.',
                        'title' => 'Google Analytics', 
                        'fields'=>
                            array(
                                _axn_build_field('p142', $gid, $key, array(), '', '<fieldset><legend>Analytics Custom Event Options</legend><div class="wrp_flds set75">', '</div>', '* Tracking Code (This is your google tracking code provided by google analytics).', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p143', $gid, $key, array(), '', '<div class="wrp_flds set75">', '</div>', '* Tracking Code Domain (This is your google tracking code domain provided by google analytics).', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p144', $gid, $key, array(), '', '<div class="wrp_flds set75">', '</div>', '* Category (The name you supply for the group of objects you want to track).', $fld_data),
                                '<br clear="all" />',                                
                                _axn_build_field('p145', $gid, $key, array(), '', '<div class="wrp_flds set75">', '</div>', '* Action (A string that is uniquely paired with each category, and commonly used to define the type of user interaction for the web object).', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p146', $gid, $key, array(), '', '<div class="wrp_flds set75">', '</div>', 'Label (An optional string to provide additional dimensions to the event data).', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p147', $gid, $key, array(), '', '<div class="wrp_flds set75">', '</div></fieldset>', 'Value (An integer that you can use to provide numerical data about the user event).', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                '<br clear="all" />',                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div></fieldset>', 'On shown', $fld_data),
                                '<br clear="all" />'      
                            )
                      );   
                      
                      
            case '_s_axn15_2' : 
                $ci = & get_instance();
                $ci->load->helper('site_settings');
                $adw_setting = getSiteAdwordSetting();                
                  
                $css_props = _style_properties_editor(); 
                return array(
                        'help'=>'Allows you to transmit Goal events and values to Google Analytics.',
                        'title' => 'Google Analytics', 
                        'fields'=>
                            array(
                                ($adw_setting->analytics_id == '' || $adw_setting->adword_id == '') ? 
                                
                                'You need to setup the google adwords settings: <a href="#">Setup</a>' : 
                                
                                _axn_build_field('p142', $gid, $key, array(), '', '<fieldset><legend>AdWords Options</legend><div class="wrp_flds set75">', '</div>', '* Tracking Code (This is your google tracking code provided by google analytics).', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p143', $gid, $key, array(), '', '<div class="wrp_flds set75">', '</div>', '* Tracking Code Domain (This is your google tracking code domain provided by google analytics).', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p144', $gid, $key, array(), '', '<div class="wrp_flds set75">', '</div>', '* Category (The name you supply for the group of objects you want to track).', $fld_data),
                                '<br clear="all" />',                                
                                _axn_build_field('p145', $gid, $key, array(), '', '<div class="wrp_flds set75">', '</div>', '* Action (A string that is uniquely paired with each category, and commonly used to define the type of user interaction for the web object).', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p146', $gid, $key, array(), '', '<div class="wrp_flds set75">', '</div>', 'Label (An optional string to provide additional dimensions to the event data).', $fld_data),
                                '<br clear="all" />',
                                _axn_build_field('p147', $gid, $key, array(), '', '<div class="wrp_flds set75">', '</div></fieldset>', 'Value (An integer that you can use to provide numerical data about the user event).', $fld_data),
                                
                                // ------------------------------------------------------------------------------------------------------------->
                                '<br clear="all" />',                                
                                // JS Event
                                _axn_build_field('p102', $gid, $key, array(), '', '<fieldset><legend>Javascript Events</legend><div class="wrp_flds set99">', '</div></fieldset>', 'On shown', $fld_data),
                                '<br clear="all" />'      
                            )
                      );    
                                                                                                          
        }   
}

function display_axn_fields($key, $gid, $fld_data){    
    $field = axn_field_sets($key, $gid, $fld_data);
    $op = '';
    foreach($field['fields'] as $fld){
        $op .= $fld;
    }
    
    return array('fields'=>$op, 'title'=>$field['title'], 'help'=>$field['help']);
}

function main_axn_categories(){
    
    $ci = & get_instance();
    $ci->load->language('actions', CURRENT_LANGUAGE);
        
    $axn = array(
        '_axn0' => array(
                    'title'=> $ci->lang->line('_axn0'),
                    'sub' => array()
                    ),
                    
        '_axn1' => array(
                    'title'=> $ci->lang->line('_axn1'),
                    'sub' => array()
                    ),
         
         '_axn2' => array(
                    'title'=> $ci->lang->line('_axn2'),
                    'sub' => array()
                    ),           
          
        '_axn3' => array(
                    'title'=> $ci->lang->line('_axn3'),
                    'sub' => array()
                    ), 
                    
        '_axn4' => array(
                    'title'=> $ci->lang->line('_axn4'),
                    'sub' => array()
                    ), 
                    
        '_axn5' => array(
                    'title'=> $ci->lang->line('_axn5'),
                    'sub' => array()
                    ),
        '_axn6' => array(
                    'title'=> $ci->lang->line('_axn6'),
                    'sub' => array()
                    ),
        '_axn7' => array(
                    'title'=> $ci->lang->line('_axn7'),
                    'sub' => array()
                    ),
        '_axn8' => array(
                    'title'=> $ci->lang->line('_axn8'),
                    'sub' => array()
                    ),
        '_axn9' => array(
                    'title'=> $ci->lang->line('_axn9'),
                    'sub' => array()
                    ),
        '_axn10' => array(
                    'title'=> $ci->lang->line('_axn10'),
                    'sub' => array()
                    ),
        '_axn11' => array(
                    'title'=> $ci->lang->line('_axn11'),
                    'sub' => array()
                    ),
        '_axn12' => array(
                    'title'=> $ci->lang->line('_axn12'),
                    'sub' => array()
                    ),
        '_axn13' => array(
                    'title'=> $ci->lang->line('_axn13'),
                    'sub' => array()
                    ),
        '_axn14' => array(
                    'title'=> $ci->lang->line('_axn14'),
                    'sub' => 
                        array(
                            '_s_axn14_1'  => $ci->lang->line('_s_axn14_1'),
                            '_s_axn14_2'  => $ci->lang->line('_s_axn14_2'),
                            '_s_axn14_3'  => $ci->lang->line('_s_axn14_3'),
                            '_s_axn14_4'  => $ci->lang->line('_s_axn14_4'),
                            '_s_axn14_5'  => $ci->lang->line('_s_axn14_5'),
                            '_s_axn14_6'  => $ci->lang->line('_s_axn14_6')                          
                        )
                    ),
        '_axn15' => array(
                    'title'=> $ci->lang->line('_axn15'),
                    'sub' => 
                        array(
                            '_s_axn15_1'  => $ci->lang->line('_s_axn15_1'),
                            '_s_axn15_2'  => $ci->lang->line('_s_axn15_2'),
                            '_s_axn15_3'  => $ci->lang->line('_s_axn15_3')                           
                        )
                    ),
         '_axn16' => array(
                    'title'=> $ci->lang->line('_axn16'),
                    'sub' => 
                        array(
                            '_s_axn16_1'  => $ci->lang->line('_s_axn16_1'),
                            '_s_axn16_2'  => $ci->lang->line('_s_axn16_2')                          
                        )
                    ),
          '_axn17' => array(
                    'title'=> $ci->lang->line('_axn17'),
                    'sub' => 
                        array(
                            '_s_axn17_1'  => $ci->lang->line('_s_axn17_1'),
                            '_s_axn17_2'  => $ci->lang->line('_s_axn17_2'),
                            '_s_axn17_3'  => $ci->lang->line('_s_axn17_3'),
                            '_s_axn17_4'  => $ci->lang->line('_s_axn17_4'),
                            '_s_axn17_5'  => $ci->lang->line('_s_axn17_5')                          
                        )
                    )  
        );  
        
        return $axn;  
}


function adword_tags(){
    
}
