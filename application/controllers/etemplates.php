<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Etemplates extends CI_Controller{
    
    function __construct()
    {
        parent::__construct();        
    }
    
    function templates_menu(){
        
        $id = $this->input->get('id', true);
        $menu_id = $this->input->get('id', true);
        $sub = $this->input->get('sub', true);
        
        if($sub == 0){$menu_id = $id;}
        
        if($id==1001){
            echo '<div class="parentFolders">
                    <ul><li><span>Main category</span></li></ul>
                    <div class="clear"></div>
                </div>                
                <ul class="childFolders"><li><a href="#1000|900">Visitor Target Templates</a> </li></ul>';
        }else if($menu_id==900){
            echo '<div class="buttom">Action templates</div>
            <div class="dropDownList">    
                <div class="parentFolders">
                    <ul><li><span>Main category</span></li></ul>
                    <div class="clear"></div>
                </div>
                <ul class="childFolders"><li><a href="#1000|900">Visitor Target Templates</a> </li></ul>
            </div>';
        }else if($menu_id == 1000){
            echo '<div class="parentFolders">
                    <ul>
                        <li><a href="#1001|900">Main category</a></li>
                        <li><span>Visitor Target templates</span></li>
                    </ul>
                    <div class="clear"></div>
                </div>            
                <ul class="childFolders">            
                    <li><a href="#1002|900">Badges</a> </li>
                    <li><a href="#1003|900">Chat</a> </li>
                    <li><a href="#1004|900">Coupon</a> </li>
                    <li><a href="#1005|900">General</a> </li>
                    <li><a href="#1006|900">New</a> </li>
                    <li><a href="#1007|900">Sale</a> </li>
                    <li><a href="#1008|900">Subscribe / Join</a> </li>
                </ul>';                
        } else if($menu_id == 1002){
            echo '
                <div class="parentFolders">
                    <ul>
                        <li><a href="#1001|900">Main category</a></li>
                        <li><span>Badges</span></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <ul class="folderObjects"><li><a href="#17391,id=9,actionTemplate">Satisfaction guaranteed</a></li></ul>';                
        } else if($menu_id == 1003){
            echo '
                <div class="parentFolders">
                    <ul>
                        <li><a href="#1001|900">Main category</a></li>
                        <li><span>Chat</span></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <ul class="folderObjects">
                    <li><a href="#17399,id=17,actionTemplate">Chat support </a></li>
                    <li><a href="#17400,id=18,actionTemplate">Contact us blue button</a></li>
                </ul>';                
        } else if($menu_id == 1004){
            echo '
                <div class="parentFolders">
                    <ul>
                        <li><a href="#1001|900">Main category</a></li>
                        <li><span>Coupon</span></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <ul class="folderObjects">
                    <li><a href="#24415,id=23,actionTemplate">Coupon</a></li>
                    <li><a href="#27425,id=24,actionTemplate">Coupon (closeable)</a></li>
                </ul>';                
        } else if($menu_id == 1005){
            echo '
                <div class="parentFolders">
                    <ul>
                        <li><a href="#1001|900">Main category</a></li>
                        <li><span>General</span></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <ul class="folderObjects">
                    <li><a href="#17385,id=4,actionTemplate">Large torn page</a></li>
                    <li><a href="#17393,id=11,actionTemplate">Woman pointing blank boar</a></li>
                    <li><a href="#17394,id=12,actionTemplate">Small Note with red pin</a></li>
                    <li><a href="#17395,id=13,actionTemplate">Man holding vertical sign</a></li>
                    <li><a href="#17398,id=16,actionTemplate">Header, Content, Footer</a></li>
                    <li><a href="#17402,id=20,actionTemplate">Woman holding blank board</a></li>
                    <li><a href="#24671,id=1,actionTemplate">Expandable square (blue)</a></li>
                </ul>';                
        } else if($menu_id == 1006){
            echo '
                <div class="parentFolders">
                    <ul>
                        <li><a href="#1001|900">Main category</a></li>
                        <li><span>New</span></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <ul class="folderObjects">
                    <li><a href="#17389,id=8,actionTemplate">New paper peel Blue</a></li>
                </ul>';
                                
        } else if($menu_id == 1007){
            echo '
                <div class="parentFolders">
                    <ul>
                        <li><a href="#1001|900">Main category</a></li>
                        <li><span>Sale</span></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <ul class="folderObjects">
                    <li><a href="#17383,id=3,actionTemplate">General Sale vertical</a></li>
                    <li><a href="#17387,id=6,actionTemplate">Vertical special banner</a></li>
                    <li><a href="#17388,id=7,actionTemplate">Rectanble Sale Blue</a></li>
                    <li><a href="#17392,id=10,actionTemplate">Sale 50% big hand</a></li>
                    <li><a href="#17396,id=14,actionTemplate">Red arrow discount badge</a></li>
                    <li><a href="#17397,id=15,actionTemplate">Automn SALE banner</a></li>
                    <li><a href="#21167,id=21,actionTemplate">Low price vertical</a></li>
                    <li><a href="#21606,id=22,actionTemplate">Click to contact us</a></li>
                    <li><a href="#24668,id=2,actionTemplate">Red ribbon 50% Sale</a></li>
                </ul>';                
        } else if($menu_id == 1008){
            echo '
                <div class="parentFolders">
                    <ul>
                        <li><a href="#1001|900">Main category</a></li>
                        <li><span>Subscribe / Join</span></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <ul class="folderObjects">
                    <li><a href="#17386,id=5,actionTemplate">Join us free text</a></li>
                    <li><a href="#17401,id=19,actionTemplate">RSS icon with text</a></li>
                </ul>';                
        }
    }

    function load_template(){           
        $id = $this->input->get('id', true);    
        $a = 
        array(
            // prsno ko 7
            1=>
                '<table cellpadding="0" cellspacing="0" style="width: 400px;">
                    <tbody>
                        <tr>
                            <td>
                                <img alt="" src="http://personyze.com/uploads/2011/images/top_left.png" style="width: 12px; height: 39px;" /></td>
                            <td colspan="3" style="color: white; background-color: rgb(61, 75, 135); width: 100%; text-align: center; font-weight: bold; font-size: 15px;">
                                Enter Title Here</td>
                            <td>
                                <img alt="" src="http://personyze.com/uploads/2011/images/top_right.png" style="width: 12px; height: 39px;" /></td>
                        </tr>
                        <tr>
                            <td style="border-left: 3px solid rgb(61, 75, 135);">
                                &nbsp;</td>
                            <td colspan="3">
                                Enter text here - The width of the table is 400px by default. You can change the size in the HTML by editing the table width in the source.</td>
                            <td style="border-right: 3px solid rgb(61, 75, 135);">
                                &nbsp;</td>
                        </tr>
                        <tr>
                            <td style="vertical-align: bottom;">
                                <img alt="" src="http://personyze.com/uploads/2011/images/bottom_left.png" style="width: 12px; height: 13px;" /></td>
                            <td colspan="3" style="border-bottom: 3px solid rgb(61, 75, 135); font-size: 1px;">
                                &nbsp;</td>
                            <td style="vertical-align: bottom;">
                                <img alt="" src="http://personyze.com/uploads/2011/images/bottom_right.png" style="width: 12px; height: 13px;" /></td>
                        </tr>
                    </tbody>
                </table>',   
             
             // prsno ko 8
             2=>
                '<table cellpadding="0" cellspacing="0" style="width: 500px;">
                    <tbody>
                        <tr>
                            <td style="text-align: right; vertical-align: top;">
                                <img alt="" src="http://personyze.com/uploads/2011/images/50_percent_off.png" style="width: 213px; height: 189px;" /></td>
                            <td>
                                <div style="margin-top: 35px;">
                                    <span style="color: Black; font-size: 24px;">Enter Title Here</span><br />
                                    <span>Enter text here - You can set the left side text area width by modifying the HTML source and setting the TD width to a smaller or larger size.<br />
                                    You need to edit the link target url too or remove it if you like.<br />
                                    </span><br />
                                    <span style="padding-top: 10px; font-size: 20px; color: blue;"><a href="#">Click Here!</a></span></div>
                            </td>
                        </tr>
                    </tbody>
                </table>',
             
             // prsno ko 9
             3=>
                '<table style="width: 343px;">
                    <tbody>
                        <tr>
                            <td>
                                <p>
                                    <a href="#"><img alt="" src="http://personyze.com/uploads/2011/images/sale_banner.jpg" style="width: 343px; height: 285px; border: 0px none;" /></a></p>
                            </td>
                        </tr>
                        <tr style="background-color: rgb(102, 16, 12); color: White; height: 30px; font-size: 35px;">
                            <td style="text-align: center; padding-top: 5px; padding-bottom: 5px;">
                                Enter Title Here</td>
                        </tr>
                        <tr>
                            <td style="color: black; font-size: 20px;">
                                Enter some text here to promote one of your pages, product or services. You may want to change the target link on the &quot;Sale&quot; image above.</td>
                        </tr>
                    </tbody>
                </table>',
                
            // prsno ko 11    
            4=>
                '<div style="background-image: url(&quot;http://personyze.com/uploads/2011/images/torn_page.jpg&quot;); width: 597px; height: 390px;">
                    <div style="text-align: left; direction: ltr; float: left; padding-left: 180px;">
                        <div style="padding-top: 10px; color: white; font-size: 50px; font-weight: bold;">
                            <span>Title Goes Here</span></div>
                        <div style="padding-top: 50px;">
                            You content goes here<br />
                            &nbsp;You content goes here<br />
                            &nbsp; You content goes here<br />
                            &nbsp;&nbsp; You content goes here<br />
                            &nbsp;&nbsp;&nbsp; You content goes here<br />
                            &nbsp;&nbsp;&nbsp;&nbsp; You content goes here<br />
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; You content goes here</div>
                        <div style="text-align: left; direction: ltr; padding-top: 120px; float: left; padding-left: 180px;">
                            <div>
                                &nbsp;</div>
                        </div>
                    </div>
                </div>',
                
            // prsno ko 12        
            5=>
                '<table style="background-color: white; width: 400px;">
                    <tbody>
                        <tr>
                            <td>
                                <a href="#"><img alt="" src="http://personyze.com/uploads/2011/images/join_us_now.jpg" style="width: 200px; height: 200px; border: 0px none;" /></a></td>
                            <td style="vertical-align: top; font-size: 18px; color: black; width: 100%;">
                                Free text goes here...<br />
                                You may change the image&#39;s link to to your website signup page.</td>
                        </tr>
                    </tbody>
                </table>',
             // prsno ko 13
             6=>
                '<table style="height: 560px; width: 194px;">
                    <tbody>
                        <tr>
                            <td style="vertical-align: top; background-image: url(&quot;http://personyze.com/uploads/2011/images/special.png&quot;); background-repeat: no-repeat;">
                                <div style="margin-top: 90px; margin-left: 60px; font-weight: bolder; font-size: 60px; color: rgb(107, 107, 107);">
                                    25%</div>
                                <div style="color: white; font-size: 15px; margin-top: 40px; margin-left: 30px;">
                                    You can edit the above<br />
                                    percentage.<br />
                                    <br />
                                    Put free text here...</div>
                            </td>
                        </tr>
                    </tbody>
                </table>',
                
             // prsno ko 14
             7=>
                '<div style="background-image: url(&quot;http://personyze.com/uploads/2011/images/sale_box_blue.jpg&quot;); height: 325px; width: 333px;">
                    <div style="padding-left: 65px; padding-top: 65px;">
                        Enter you text here</div>
                </div>',   
             
             // prsno ko 15   
             8=>
                '<p>
                    <a href="#"><img height="202" src="http://personyze.com/uploads/2011/images/white_new_peel.jpg" style="border: 0px none;" width="292" /></a></p>
                ',
             
             // prsno ko 16       
             9=>
                '<table style="width: 550px;">
                    <tbody>
                        <tr>
                            <td>
                                <img alt="" src="http://personyze.com/uploads/2011/images/satisfaction_gaurantee.jpg" style="width: 228px; height: 226px;" /></td>
                                <td style="padding-left: 15px; color: black; padding-top: 15px; width: 100%; vertical-align: top;">
                                    Free text here...<br />
                                    Free text here...<br />
                                    Free text here...<br />
                                    Free text here...<br />
                                    Free text here...<br />
                                    Free text here...<br />
                                    Free text here...<br />
                                    Free text here...</td>
                            </tr>
                    </tbody>
                </table>',
                
            // prsno ko 18                            
            10=>
                '<div style="background-image: url(&quot;http://personyze.com/uploads/2011/images/sale_50_hand.png&quot;); background-repeat: no-repeat; width: 500px; height: 576px;">
                    <div style="padding-top: 260px; padding-left: 80px;">
                        Enter your content here...<br />
                        Enter your content here...<br />
                        Enter your content here...<br />
                        Enter your content here...<br />
                        Enter your content here...<br />
                        Enter your content here...<br />
                        Enter your content here...<br />
                        Enter your content here...</div>
                </div>',                       
            
            // prsno ko 19
            11=>
                '<table>
                    <tbody>
                        <tr>
                            <td>
                                <img alt="" src="http://personyze.com/uploads/2011/images/woman_pointing_down.jpg" style="width: 350px; height: 222px;" /></td>
                        </tr>
                        <tr>
                            <td>
                                Free text here...<br />
                                Free text here...<br />
                                Free text here...<br />
                                Free text here...<br />
                                Free text here...<br />
                                Free text here...</td>
                        </tr>
                    </tbody>
                </table>',
             
             // prsno ko 20
             12=>
                '<div style="background-image: url(&quot;http://personyze.com/uploads/2011/images/note-pin.png&quot;); width: 259px; height: 262px;">
                    <div style="padding-top: 80px; padding-left: 30px;">
                        Free text here...<br />
                        Free text here...<br />
                        Free text here...<br />
                        Free text here...<br />
                        Free text here...<br />
                        Free text here...<br />
                        Free text here...<br />
                        Free text here...</div>
                </div>',
                
             // prsno ko 21   
             13=>
                '<div style="background-image: url(&quot;http://personyze.com/uploads/2011/images/shutterstock_67039303.jpg&quot;); width: 309px; height: 501px;">
                        <div style="padding-top: 80px; padding-left: 70px;">
                            Enter free text here...<br />
                            Enter free text here...<br />
                            Enter free text here...<br />
                            Enter free text here...<br />
                            Enter free text here...<br />
                            Enter free text here...<br />
                            Enter free text here...<br />
                            Enter free text here...<br />
                            Enter free text here...</div>
                    </div>',
                    
             // prsno ko 22
             14=>
                '<div style="background-image: url(&quot;http://personyze.com/uploads/2011/images/discount_banner.jpg&quot;); width: 423px; height: 357px;">
                    <div style="padding-top: 130px; padding-left: 80px; font-size: 30px; color: white;">
                        Free content here...<br />
                        Free content here...<br />
                        Free content here...</div>
                </div>',
             
             // prsno ko 26
             15=>
                '<p>
                    <img alt="" src="http://personyze.com/uploads/2011/images/sale_automan_banner.jpg" style="width: 500px; height: 249px;" /></p>
                <p>
                    &nbsp;</p>
                <p>
                    <span style="font-size: 16px;">Free text here..<br />
                    Free text here..<br />
                    Free text here..<br />
                    Free text here..</span>
                </p>',
             
             // prsno ko 27
             16=>
                '<div style="width: 470px; height: 350px; border: 2px solid Red;">
                    <table style="width: 470px; height: 100%;">
                        <tbody>
                            <tr>
                                <td style="height: 10%; text-align: center; font-weight: bold;">
                                    <span style="font-size: 20px;">[TITLE]</span></td>
                            </tr>
                            <tr>
                                <td style="height: 80%; vertical-align: top; padding: 10px;">
                                    Free content here...<br />
                                    Free content here...<br />
                                    Free content here...<br />
                                    Free content here...</td>
                            </tr>
                            <tr>
                                <td style="height: 10%; text-align: center;">
                                    [Footer]</td>
                            </tr>
                        </tbody>
                    </table>
                </div>',
                
             // prsno ko 28   
             17=>
                 '<table cellpading="0" cellspacing="0" style="width: 500px; height: 169px; border: 1px solid rgb(0, 0, 0);">
                        <tbody>
                            <tr>
                                <td>
                                    <img alt="" src="http://personyze.com/uploads/2011/images/chat_support_woman.jpg" style="width: 206px; height: 169px;" /></td>
                                <td style="width: 100%; padding: 10px; vertical-align: top;">
                                    <strong><span style="font-size: 22px;">Need Help?</span></strong><br />
                                    <br />
                                    Free content here...<br />
                                    Free content here...<br />
                                    Free content here...<br />
                                    <br />
                                    <span style="font-size: 16px;">Click Here to contact our support team</span></td>
                            </tr>
                        </tbody>
                    </table>',
             
             // prsno ko 29            
             18=>
                '<table style="width: 500px; height: 188px; border: 3px solid rgb(21, 92, 186);">
                    <tbody>
                        <tr>
                            <td>
                                <img alt="" src="http://personyze.com/uploads/2011/images/contact_us_blue_button.jpg" style="width: 250px; height: 188px;" /></td>
                            <td style="width: 100%; vertical-align: top; text-align: left;">
                                <table style="width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td style="text-align: center;">
                                                <strong><span style="font-size: 24px; border-bottom: 1px solid rgb(21, 92, 186);">TITLE HERE</span></strong></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                free content here...<br />
                                                free content here...<br />
                                                free content here...<br />
                                                free content here...<br />
                                                free content here...<br />
                                                <br />
                                                &nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Link to the contact us page here</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>',               
             
             // prsno ko 30
             19=>
                '<table style="width: 400px; background-color: rgb(240, 241, 246); border: 2px solid rgb(246, 142, 30); padding: 5px;">
                    <tbody>
                        <tr>
                            <td>
                                <img alt="" src="http://personyze.com/uploads/2011/images/rss_icons.jpg" style="width: 119px; height: 140px;" /></td>
                            <td style="width: 100%; padding-left: 10px;">
                                <span style="font-size: 24px;">Subscribre&nbsp; to our Feed!<br />
                                <span style="font-size: 14px;">(don&#39;t forget to put a link)</span></span></td>
                        </tr>
                    </tbody>
                </table>',
                
            // prsno ko 31    
            20=>
                '<div style="background-image: url(&quot;http://personyze.com/uploads/2011/images/woman_holding_blank_board(1).jpg&quot;); background-repeat: no-repeat; width: 593px; height: 425px;">
                    <div style="padding-top: 80px; padding-left: 290px;">
                        <table style="width: 100%; height: 100%;">
                            <tbody>
                                <tr>
                                    <td>
                                        <span style="font-size: 20px;">PUT YOUR TITLE HERE</span></td>
                                </tr>
                                <tr>
                                    <td style="height: 100%;">
                                        <p>
                                            Content goes here...<br />
                                            Content goes here...<br />
                                            Content goes here...<br />
                                            Content goes here...<br />
                                            Content goes here...<br />
                                            Content goes here...</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>',  
                 
             // prsno ko 32   
             21=>
                '<div style="width: 200px; border: 2px solid rgb(214, 19, 24);">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <img alt="" src="http://personyze.com/uploads/2011/images/low_price_sign.jpg" style="width: 192px; height: 200px;" /></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid rgb(193, 14, 19); color: rgb(193, 14, 19); font-size: 24px; text-align: center; font-family: Georgia,Tahoma,Arial;">
                                    <strong>Title</strong></td>
                            </tr>
                            <tr>
                                <td>
                                    Content goes here...<br />
                                    Content goes here...<br />
                                    Content goes here...<br />
                                    Content goes here...<br />
                                    Content goes here...<br />
                                    Content goes here...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>',
             
             // prsno ko 33
             22=>
                '<p>
                    <a href="mailto:youremailaddress@here.com?subject=From ${ur}"><img alt="" border="0" src="http://personyze.com/uploads/2011/images/have-a-question.png" style="width: 497px; height: 155px;" /></a>
                 </p>',            
            
            // prsno ko 10     
            23=>
                '<div style="width: 318px; height: 312px; background-image: url(&quot;http://personyze.com/uploads/2011/images/cupon.jpg&quot;); background-repeat: no-repeat;">
                    <div style="padding-top: 80px; padding-left: 60px;">
                        <span style="font-size: 25px; color: Red;">Enter Title</span><br />
                        <span style="color: black; font-size: 15px;">content goes here</span></div>
                </div>',
            
            // prsno ko 35     
            24=>
                '<div style="position: relative; width: 318px; height: 312px; background-image: url(&quot;http://personyze.com/uploads/2011/images/cupon.jpg&quot;); background-repeat: no-repeat;">
                    <div onclick="document.getElementById(\'--single-popup-id--\').style.display=\'none\';" style="position: absolute; top: 4px; right: 8px; cursor: pointer;">
                        <span style="font-size: 10px; font-family: verdana; font-weight: bold;">close</span></div>
                    <div style="padding-top: 80px; padding-left: 60px;">
                        <span style="font-size: 25px; color: Red;">Enter Title</span><br />
                        <span style="color: black; font-size: 15px;">content goes here</span></div>
                </div>'
                 );
                      
                 
         echo isset($a[$id]) ? $a[$id] : '';          
    }
    
}
