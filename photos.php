<div class="photographs_wrapper ">
    <div class="title_wrapper">
        <div class="photographs_title">Photos</div>
        <div class="photographs_sponser"><!--<img src="images/sponser/fursad.jpg" />--></div>
        <div class="clear"></div>
    </div><!-- title wrapper end-->
    
    <div class="photographs_contents">
    <div class="photo_img">
        <a href="" id="gallery_img_view_large">
           
        </a>
    </div>
    <div class="caption">
        <a class="float_left" href="" id="gallery_img_view_caption"></a>
    <div class="see_all float_right"><?=anchor('gallery', 'See all Photos')?></div>
    
    <div class="clear"></div>
    
    <div class="jcarousel-btnbg"><img class="jcarousel-prev" id="photo_jcarousel-prev" src="<?php echo $img_path?>btn_prev.png" /><img class="jcarousel-next" id="photo_jcarousel-next" src="<?php echo $img_path?>btn_next.png" /></div>
    
    </div>
    <div class="image_slide_display">
    
    <ul id="photo_carousel">
<?php
foreach($q_gallery_list->result() as $r):
	
	if($r->ver1 == 0){
		$img = base_url().'uploads/416x231/'.$r->image;
		list($ref_w, $ref_h) = getimagesize("./uploads/".$r->image);
	} else {
		$img = $r->image;
		$r->image = base_url().'resizer.php?s='.urlencode($r->image).'&w=572&h=334';
		$ref_w = 0;
		$ref_h = 0;
	}
    echo '<li><div class="slide_image_center"><div class="img_boundary">';
	echo anchor('gallery/detail/'.$r->content_id, '<img src="'.base_url(). 'resizer.php?s='.urlencode($img).'&w=128&h=85" border="0" width="128" class="imgthumb" imgname="'.$r->image.'" cid="'.$r->content_id.'" imgver="'.$r->ver1.'" rw="'.$ref_w.'" rh="'.$ref_h.'" />');
	echo '</div>'.anchor('gallery/detail/'.$r->content_id, $r->caption, array('class'=>'limit_caption', 'id'=>'caption_id'.$r->content_id)).'</div></li>';

endforeach;
?>      
      </ul>
      <div class="clear"></div>
    </div>
    <div class="clear"></div>
  </div><!--photographs content end-->
</div>
<script type="text/javascript">
function jcarousel_initCallback(carousel) {
    $('#photo_jcarousel-next').bind('click', function() {
        carousel.next();
        return false;
    });
    $('#photo_jcarousel-prev').bind('click', function() {
        carousel.prev();
        return false;
    });
};
$(document).ready(function() {
    $("#photo_carousel").jcarousel({
        scroll: 3,
        initCallback: jcarousel_initCallback,
        buttonNextHTML: null,
        buttonPrevHTML: null,
		itemFallbackDimension: 132
    });
	//$('.imgthumb:eq(0)').trigger('mouseover');
	$('.imgthumb').hover(function(){
		var img = $(this).attr('imgname');
		var cid = $(this).attr('cid');
		var ver = $(this).attr('imgver');
		var cmt = $('#caption_id'+cid).html();
		if(ver == 0){
			$('#gallery_img_view_large').html('<img src="<?=base_url()?>uploads/gallery/'+img+'" alt="Loading..." />').attr('href', '<?=site_url('gallery/detail/')?>'+cid);
		    $('#gallery_img_view_caption').html(cmt).attr('href', '<?=site_url('gallery/detail/')?>'+cid);
		} else {
			$('#gallery_img_view_large').html('<img src="'+img+'" alt="Loading..." style="max-width:575px" />').attr('href', '<?=site_url('gallery/detail/')?>'+cid);
		    $('#gallery_img_view_caption').html(cmt).attr('href', '<?=site_url('gallery/detail/')?>'+cid);
		}
	});
	$('.imgthumb:eq(0)').trigger('mouseover');
});
</script>