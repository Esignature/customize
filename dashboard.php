<script type="text/javascript">
$(function(){
	currentMenu('Dashboard', 'abc');
});
</script>
<style type="text/css">
h3.dash_title{padding-left:10px;color:#444!important;font:15px Arial, Helvetica, sans-serif;text-shadow:2px 2px 2px #ccc;cursor:default;}
ul{padding:0;margin:0;}
ul.dashbaord_links{list-style-type:none;padding:0!important;margin:0!important;}
ul.dashbaord_links li{float:left;margin:5px 10px;width:87px;border:1px solid #ccc;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px;padding:8px;text-align:center;background:#f5f5f5;list-style-type:none;box-shadow:1px 2px 2px #E4E2E2;}
ul.dashbaord_links li:hover{ background:#fff;box-shadow:3px 4px 2px #ccc;}
ul.dashbaord_links li a{font:11px Tahoma;color:#06C;display:block;text-decoration:none;margin-top:5px;}
ul.dashbaord_links li a img{border:none;margin-top:0;width:64px;height:64px;}
</style>
<!--<h2>Dashboard</h2>-->
    
     <p>
     <h3 class="dash_title">Quick Add Links</h3>
         <ul class="dashbaord_links">
           <li>
		       <?=anchor('apanel/news_form', '<img src="'.$path.'img/dash_add_news.png" alt="Add News" />')?>
               <?=anchor('apanel/news_form', '<div class="detail">Add News</div>')?>
           </li>           
           <li>
		       <?=anchor('apanel/article_form', '<img src="'.$path.'img/dash_add_article.png" alt="Add Article" />')?>
               <?=anchor('apanel/article_form', '<div class="detail">Add Article</div>')?>
           </li>
           <li>
               <?=anchor('apanel/user_form', '<img src="'.$path.'img/dash_add_article.png" alt="Add Admin User" />')?>
               <?=anchor('apanel/user_form', '<div class="detail">Add Admin User</div>')?>
           </li>           
           <li>
		       <?=anchor('apanel/package_form', '<img src="'.$path.'img/dash_add_interview.png" alt="Add Package" />')?>
               <?=anchor('apanel/package_form', '<div class="detail">Add Package</div>')?>
           </li>
           <!--<li>
		       <?=anchor('apanel/events_form', '<img src="'.$path.'img/dash_add_event.png" alt="Add Event" />')?>
               <?=anchor('apanel/events_form', '<div class="detail">Add Event</div>')?>
           </li>
           
           <li>
		       <?=anchor('apanel/gallery_form', '<img src="'.$path.'img/dash_add_photos.png" alt="Add Photos" />')?>
               <?=anchor('apanel/gallery_form', '<div class="detail">Add Photo</div>')?>
           </li>
           <li>
		       <?=anchor('apanel/videos_form', '<img src="'.$path.'img/dash_add_video.png" alt="Add Video" />')?>
               <?=anchor('apanel/videos_form', '<div class="detail">Add Video</div>')?>
           </li>
           <li>
		       <?=anchor('apanel/artist_form', '<img src="'.$path.'img/dash_add_artist.png" alt="Add Artist" />')?>
               <?=anchor('apanel/artist_form', '<div class="detail">Add Artist</div>')?>
           </li>
           <li>
		       <?=anchor('apanel/poll_form', '<img src="'.$path.'img/dash_add_poll.png" alt="Add Poll" />')?>
               <?=anchor('apanel/poll_form', '<div class="detail">Add Poll</div>')?>
           </li>-->
         </ul>
         <div class="clear"></div>
         <h3 class="dash_title">My Records</h3>
         <ul class="dashbaord_links">
           <li>
		       <?=anchor('apanel/news', '<img src="'.$path.'img/dash_news.png" alt="My News" />')?>
               <?=anchor('apanel/news', '<div class="detail">All News</div>')?>
           </li>           
           <li>
		       <?=anchor('apanel/article', '<img src="'.$path.'img/dash_article.png" alt="All Article" />')?>
               <?=anchor('apanel/article', '<div class="detail">Articles</div>')?>
           </li>
           <li>
               <?=anchor('apanel/account', '<img src="'.$path.'img/dash_quiz.png" alt="Accounts" />')?>
               <?=anchor('apanel/account', '<div class="detail">Accounts</div>')?>
           </li>
           <li>
		       <?=anchor('apanel/package', '<img src="'.$path.'img/dash_interview.png" alt="Packages & Sites" />')?>
               <?=anchor('apanel/package', '<div class="detail">Packages & Sites</div>')?>
           </li>
           <li>
		       <?=anchor('apanel/user', '<img src="'.$path.'img/dash_event.png" alt="Admin Users" />')?>
               <?=anchor('apanel/user', '<div class="detail">Admin Users</div>')?>
           </li>
           <!--
           <li>
		       <?=anchor('apanel/gallery', '<img src="'.$path.'img/dash_photos.png" alt="All Photos" />')?>
               <?=anchor('apanel/gallery', '<div class="detail">Photos</div>')?>
           </li>
           <li>
		       <?=anchor('apanel/videos', '<img src="'.$path.'img/dash_video.png" alt="All Videos" />')?>
               <?=anchor('apanel/videos', '<div class="detail">Videos</div>')?>
           </li>
           <li>
		       <?=anchor('apanel/artist', '<img src="'.$path.'img/dash_artist.png" alt="All Artists" />')?>
               <?=anchor('apanel/artist', '<div class="detail">Artists</div>')?>
           </li>
           <li>
		       <?=anchor('apanel/poll', '<img src="'.$path.'img/dash_poll.png" alt="All Polls" />')?>
               <?=anchor('apanel/poll', '<div class="detail">Polls</div>')?>
           </li>-->
         </ul>
         <div class="clear"></div>
     </p>
     
     <p style="font:11px Arial, Helvetica, sans-serif;color:#777;font-style:italic;">Get quick access to what you want to do here by clicking on the images.</p>
    </div>
    
    
    
  <div id="sidebar">
        <ul>
        </ul>
   </div>