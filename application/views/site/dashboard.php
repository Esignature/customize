<?php require_once("inc/header_main.php")?>
	<?php require_once('inc/header_inner.php')?>            	
        <?php require_once('inc/main_left.php')?>
        
        <div class="maincontent">
        	<div class="maincontentinner">
            	
                <ul class="maintabmenu">
                	<li class="current"><a href="dashboard.html">Dashboard</a></li>
                </ul><!--maintabmenu-->
                
                <div class="content">
                	<!--<ul class="widgetlist">
                    	<li><a href="calendar.html" class="events">Latest Events</a></li>
                    	<li><a href="editor.html" class="message">New Message</a></li>
                        <li><a href="dashboard.html" class="upload">Upload Image</a></li>
                    	<li><a href="calendar.html" class="events">Statistics</a></li>
                    	<li><a href="editor.html" class="message">New Message</a></li>
                    </ul>                    
                    <br clear="all" /><br />-->                    
                    <div class="contenttitle">
                    	<h2 class="chart"><span>Chart</span></h2>
                    </div><!--contenttitle-->
                    
                    <div class="widgetcontent padding0">
                    	<div id="tabs">
                        	<ul>
                                <li><a href="#tabs-1">Traffic Sources</a></li>
                                <li><a href="#tabs-2">Social</a></li>
                                <li><a href="#tabs-3">Performance</a></li>
                                <li><a href="#tabs-4">Visits</a></li>
                                <li><a href="#tabs-5">Engagement</a></li>
                            </ul>
                            <div id="tabs-1" style="padding:15px 8px;">
                                <img src="images/charts/traffic.png" height="166" width="698" alt="" />
                                <!--<div id="stackedGraph"></div>
								<script>
									stackedByYear = new Array(
											[[5,6.4,5,8,8],'24.00'],
											[[5.4,8,5.9,3,8],'6.00'],
											[[4.1,18,5.64,8,16.5],'12.00'],
											[[4.5,22,4.32,4],'18.00']
										);
																		
									$("#stackedGraph").jqBarGraph({
										data: stackedByYear,
										colors: ['#6FADDA','#B2AAD6','#7AC56B','#FD8D3C','#F7DA9F'],
										legends: ['ads','leads','google ads','google ads','google ads'],
										legend: false,
										width: 300,
										prefix: '',
										postfix: '',
										title: '<h3></h3>'
									});
									
								</script>--> <!--remove comment-->
								<br />
                                <div class="dash_traffic_list">
                                	<div class="dash_traffic_boxes">
                                    	<h3><input type="checkbox" name="check3" /> Links</h3>
                                        <div class="dash_link_bar">
                                        	<span></span> 70%
                                        </div>
                                        <ul>
                                        	<li>lifehacker.com <span>20</span></li>
                                            <li>lifehacker.com <span>20</span></li>
                                            <li>lifehacker.com <span>20</span></li>
                                            <li>lifehacker.com <span>20</span></li>
                                            <li>lifehacker.com <span>20</span></li>
                                        </ul>
                                    </div>
                                    
                                </div>
                                <div class="dash_traffic_list">
                                	<div class="dash_traffic_boxes">
                                    	<h3><input type="checkbox" name="check3" /> Social</h3>
                                        <div class="dash_social_bar">
                                        	<span></span> 15%
                                        </div>
                                        <ul>
                                        	<li>facebook.com <span>20</span></li>
                                            <li>facebook.com <span>20</span></li>
                                            <li>facebook.com <span>20</span></li>
                                            <li>facebook.com <span>20</span></li>
                                            <li>facebook.com <span>20</span></li>
                                        </ul>
                                    </div>                                    
                                </div>
                                <div class="dash_traffic_list">
                                	<div class="dash_traffic_boxes">
                                    	<h3><input type="checkbox" name="check3" /> Search</h3>
                                        <div class="dash_search_bar">
                                        	<span></span> 35%
                                        </div>
                                        <ul>
                                        	<li>google.com <span>20</span></li>
                                            <li>google.com <span>20</span></li>
                                            <li>google.com <span>20</span></li>
                                            <li>google.com <span>20</span></li>
                                            <li>google.com <span>20</span></li>
                                        </ul>
                                    </div>                                    
                                </div>
                                <div class="dash_traffic_list">
                                	<div class="dash_traffic_boxes">
                                    	<h3><input type="checkbox" name="check3" /> Direct</h3>
                                        <div class="dash_direct_bar">
                                        	<span></span> 8%
                                        </div>
                                    </div>                                    
                                    <div class="dash_traffic_boxes" style="margin-top:20px;">
                                    	<h3><input type="checkbox" name="check3" /> Internal</h3>
                                        <div class="dash_internal_bar">
                                        	<span></span> 8%
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div id="tabs-2">
                                <div id="chartplace" style="height:300px;"></div>
                            </div>
                            <div id="tabs-3">
                                <img src="images/charts/traffic.png" height="166" width="698" alt="" />
                                <!--<div id="chartplace" style="height:300px;"></div>     -->
                        	</div>
                            <div id="tabs-4">
                                  <img src="images/charts/traffic.png" height="166" width="698" alt="" />
                                <!--<div id="stackedGraph"></div>
								<script>
									stackedByYear = new Array(
											[[5,6.4,5,8,8],'24.00'],
											[[5.4,8,5.9,3,8],'6.00'],
											[[4.1,18,5.64,8,16.5],'12.00'],
											[[4.5,22,4.32,4],'18.00']
										);
																		
									$("#stackedGraph").jqBarGraph({
										data: stackedByYear,
										colors: ['#6FADDA','#B2AAD6','#7AC56B','#FD8D3C','#F7DA9F'],
										legends: ['ads','leads','google ads','google ads','google ads'],
										legend: false,
										width: 300,
										prefix: '',
										postfix: '',
										title: '<h3></h3>'
									});									
								</script>--> <!--remove comment-->
								<br />
                                <div class="dash_traffic_list">
                                	<div class="dash_traffic_boxes">
                                    	<h3><input type="checkbox" name="check3" /> Links</h3>
                                        <div class="dash_link_bar">
                                        	<span></span> 70%
                                        </div>
                                        <ul>
                                        	<li>lifehacker.com <span>20</span></li>
                                            <li>lifehacker.com <span>20</span></li>
                                            <li>lifehacker.com <span>20</span></li>
                                            <li>lifehacker.com <span>20</span></li>
                                            <li>lifehacker.com <span>20</span></li>
                                        </ul>
                                    </div>                                    
                                </div>
                                <div class="dash_traffic_list">
                                	<div class="dash_traffic_boxes">
                                    	<h3><input type="checkbox" name="check3" /> Social</h3>
                                        <div class="dash_social_bar">
                                        	<span></span> 15%
                                        </div>
                                        <ul>
                                        	<li>facebook.com <span>20</span></li>
                                            <li>facebook.com <span>20</span></li>
                                            <li>facebook.com <span>20</span></li>
                                            <li>facebook.com <span>20</span></li>
                                            <li>facebook.com <span>20</span></li>
                                        </ul>
                                    </div>                                    
                                </div>
                                <div class="dash_traffic_list">
                                	<div class="dash_traffic_boxes">
                                    	<h3><input type="checkbox" name="check3" /> Search</h3>
                                        <div class="dash_search_bar">
                                        	<span></span> 35%
                                        </div>
                                        <ul>
                                        	<li>google.com <span>20</span></li>
                                            <li>google.com <span>20</span></li>
                                            <li>google.com <span>20</span></li>
                                            <li>google.com <span>20</span></li>
                                            <li>google.com <span>20</span></li>
                                        </ul>
                                    </div>                                    
                                </div>
                                <div class="dash_traffic_list">
                                	<div class="dash_traffic_boxes">
                                    	<h3><input type="checkbox" name="check3" /> Direct</h3>
                                        <div class="dash_direct_bar">
                                        	<span></span> 8%
                                        </div>
                                    </div>
                                    
                                    <div class="dash_traffic_boxes" style="margin-top:20px;">
                                    	<h3><input type="checkbox" name="check3" /> Internal</h3>
                                        <div class="dash_internal_bar">
                                        	<span></span> 8%
                                        </div>
                                    </div>
                                </div>
                                <div class="clear"></div> 
                        	</div>
                            <div id="tabs-5">
                                <img src="images/charts/pie.png" height="198" width="254" alt="" /> 
                        	</div>
                        </div><!--#dashboard chart tabs-->
                    </div><!--dashboard tab charts-->                    
                    <br /><br />                    
                    <div class="one_half">                    
                    	<div class="widgetbox">
                        <div class="title"><h2 class="cmp"><span>OS</span></h2></div>
                        <div class="widgetcontent announcement">
                            <div class="dash_desktop os_ul">
                            	<div class="os_per">
                                	<h5>Desktop</h5>
                                    <h2>90%</h2>
                                </div>
                                <div class="clear" style="height:2px;"></div>
                                <ul>
                                    <li>Windows 7 <span>20</span></li>
                                    <li>Mac <span>20</span></li>
                                    <li>LINUX <span>20</span></li>
                                    <li>Windows XP <span>20</span></li>
                                	<li>Windows Vista <span>20</span></li>
                                </ul>
                            </div>                                                        
                            <div class="dash_mobile os_ul">
                            	<div class="os_per">
                                	<h5>Mobile</h5>
                                    <h2>10%</h2>
                                </div>
                                <div class="clear" style="height:2px;"></div>
                                <ul>
                                    <li>Android <span>20</span></li>
                                    <li>iPhone <span>20</span></li>
                                    <li>Syberian <span>20</span></li>
                                    <li>Windows Phone <span>20</span></li>
                                	<li>Blackberry <span>20</span></li>
								</ul>
                            </div>                            
                        </div><!--widgetcontent-->
                    </div><!--widgetbox-->
                        
                    </div><!--OS chart-->                    
                    <div class="one_half last">                    
                        <div class="widgetbox">
                        <div class="title"><h2 class="dash_time"><span>Minutes in page</span></h2></div>
                        <div class="widgetcontent">
                        	 <img src="images/charts/time.png" height="130" width="320" align="" />
                          <!--<div id="chart1" style="width:320px; height:130px;"></div>-->
                           <div class="clear" style="height:12px"></div>
                           <div class="dash_timea">
                           		<span class="reading"></span> Reading
                           </div>
                           <div class="dash_timea">
                           		<span class="writing"></span> Writing
                           </div>
                           <div class="dash_timea">
                           		<span class="idle"></span> Idle
                           </div>
                        </div><!--widgetcontent-->
                    </div><!--widgetbox-->                        
                    </div><!--minutes on page chart-->                    
                    <br clear="all" /><br />                    
                    <div class="contenttitle radiusbottom0">
                	<h2 class="dash_page"><span>Top Pages</span></h2>
                	</div><!--contenttitle-->	
                	<div class="widgetcontent padding0">
                    	<div class="dash_toppage">
                        	<div class="topppage_up">
                            	<img src="images/up.png" height="27" width="20" alt="up" />
                            </div>
                            <div class="toppage_hits">
                            	1800
                            </div>
                            <div class="toppage_title">
                            	<h3>The Future of Book Cover Design in the Digital Age</h3>
                                <div class="toppage_small page">
                                	page  catogery name
                                </div>
                                <div class="toppage_small add">
                                	48 new visitor out of 86
                                </div>
                            </div>
                            <div class="toppage_viewed">
                            	<div class="viewd_social">
                                	<img src="images/social/fb.png" height="16" width="16" alt="facebook" />
                                    <span>10%</span>
                                </div>
                            </div>
                        </div>
                        <div class="dash_toppage">
                        	<div class="topppage_up">
                            	<img src="images/up.png" height="27" width="20" alt="up" />
                            </div>
                            <div class="toppage_hits">
                            	1800
                            </div>
                            <div class="toppage_title">
                            	<h3>The Future of Book Cover Design in the Digital Age</h3>
                                <div class="toppage_small page">
                                	page  catogery name
                                </div>
                                <div class="toppage_small add">
                                	48 new visitor out of 86
                                </div>
                            </div>
                            <div class="toppage_viewed">
                            	<div class="viewd_social">
                                	<img src="images/social/fb.png" height="16" width="16" alt="facebook" />
                                    <span>10%</span>
                                </div>
                            </div>
                        </div>
                        <div class="dash_toppage">
                        	<div class="topppage_up">
                            	<img src="images/down.png" height="27" width="20" alt="up" />
                            </div>
                            <div class="toppage_hits">
                            	1800
                            </div>
                            <div class="toppage_title">
                            	<h3>The Future of Book Cover Design in the Digital Age</h3>
                                <div class="toppage_small page">
                                	page  catogery name
                                </div>
                                <div class="toppage_small add">
                                	48 new visitor out of 86
                                </div>
                            </div>
                            <div class="toppage_viewed">
                            	<div class="viewd_social">
                                	<img src="images/social/fb.png" height="16" width="16" alt="facebook" />
                                    <span>10%</span>
                                </div>
                                <div class="viewd_social">
                                	<img src="images/social/tweet.png" height="16" width="16" alt="facebook" />
                                    <span>10%</span>
                                </div>
                                <div class="viewd_social">
                                	<img src="images/social/tweet.png" height="16" width="16" alt="facebook" />
                                    <span>10%</span>
                                </div>
                                <div class="viewd_social">
                                	<img src="images/social/tweet.png" height="16" width="16" alt="facebook" />
                                    <span>10%</span>
                                </div>
                            </div>
                        </div>
                        <div class="dash_toppage">
                        	<div class="topppage_up">
                            	<img src="images/up.png" height="27" width="20" alt="up" />
                            </div>
                            <div class="toppage_hits">
                            	1800
                            </div>
                            <div class="toppage_title">
                            	<h3>The Future of Book Cover Design in the Digital Age</h3>
                                <div class="toppage_small page">
                                	page  catogery name
                                </div>
                                <div class="toppage_small add">
                                	48 new visitor out of 86
                                </div>
                            </div>
                            <div class="toppage_viewed">
                            	<div class="viewd_social">
                                	<img src="images/social/fb.png" height="16" width="16" alt="facebook" />
                                    <span>10%</span>
                                </div>
                            </div>
                        </div>
                        <div class="dash_toppage">
                        	<div class="topppage_up">
                            	<img src="images/up.png" height="27" width="20" alt="up" />
                            </div>
                            <div class="toppage_hits">
                            	1800
                            </div>
                            <div class="toppage_title">
                            	<h3>The Future of Book Cover Design in the Digital Age</h3>
                                <div class="toppage_small page">
                                	page  catogery name
                                </div>
                                <div class="toppage_small add">
                                	48 new visitor out of 86
                                </div>
                            </div>
                            <div class="toppage_viewed">
                            	<div class="viewd_social">
                                	<img src="images/social/fb.png" height="16" width="16" alt="facebook" />
                                    <span>10%</span>
                                </div>
                            </div>
                        </div>
                        <div class="clear" style="height:8px;"></div>
                        <ul class="pagination" style="float:right;">
                    	<li class="first"><a href="" class="disable">&laquo;</a></li>
                        <li class="previous"><a href="" class="disable">&lsaquo;</a></li>
                    	<li><a href="" class="current">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href="">5</a></li>
                        <li class="next"><a href="">&rsaquo;</a></li>
                        <li class="last"><a href="">&raquo;</a></li>
                    </ul>
                    </div>
                    <br /><br />                    
                </div><!--content-->                
            </div><!--maincontentinner-->
            
            <?php require_once('inc/footer_cr.php')?>            
        </div><!--maincontent-->
        
        <?php require_once('inc/main_right.php')?>               
     	
<?php require_once("inc/footer_main.php")?>