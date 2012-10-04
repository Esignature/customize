<!-- START OF HEADER -->
<div class="header radius3">        
    <div class="headerinner">           
        <a href=""><img src="images/admin_logo_small.png" alt="" /></a>
        <div class="headright">
            <div class="headercolumn">&nbsp;</div>
            <div id="searchPanel" class="headercolumn">
                <div class="searchbox">
                    <form action="" method="post">
                        <input type="text" id="keyword" name="keyword" class="radius2" value="http://www.esignature.com.np" /> 
                    </form>
                </div><!--searchbox-->
            </div><!--website url-->
            <div id="notiPanel" class="headercolumn">
                <div class="notiwrapper">
                    <a href="ajax/messages.php" class="notialert radius2">Add Widget</a>
                    <div class="notibox">
                        <ul class="tabmenu">
                            <li class="current"><a href="ajax/messages.php" class="msg">By Category</a></li>
                            <li><a href="ajax/activities.php" class="act">Costom (Advance)</a></li>
                        </ul>
                        <br clear="all" />
                        <div class="loader"><img src="images/loaders/loader3.gif" alt="Loading Icon" /> Loading...</div>
                        <div class="noticontent"></div><!--noticontent-->
                    </div><!--notibox-->
                </div><!--notiwrapper-->
            </div><!--add widget-->
            <div id="userPanel" class="headercolumn">
                <a href="" class="userinfo radius2">
                    <img src="images/avatar.png" alt="" class="radius2" />
                    <span><strong>Justin Meller</strong></span>
                </a>
                <div class="userdrop">
                    <ul>
                        <li><a href="">Setting</a></li>
                        <li><a href="">Upgrade</a></li>
                        <li><a href="#">Account</a></li>
                        <li><a href="#">Help</a></li>
                        <li><a href="#">Languages</a></li>
                        <li><a href="<?=fsite_url('user/logout')?>">Logout</a></li>
                    </ul>
                </div><!--userdrop-->
            </div><!--profile-->
        </div><!--headright-->
    
    </div><!--headerinner-->
</div><!--header-->
<!-- END OF HEADER -->

<!-- START OF MAIN CONTENT -->
    <div class="mainwrapper">
        <div class="mainwrapperinner">