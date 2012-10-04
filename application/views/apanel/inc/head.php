<?php
$path    = base_url().'application/views/apanel/';
$js_path = base_url().'js/';
$library_folder = base_url().'application/libraries/';
$title   = (isset($title)) ? $title : strtoupper(APPNAME).' Administrator Panel';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title?></title>

<!--  REQUIRED FOR IE6 SUPPORT -->
<style type="text/css">
img, div { behavior: url(iepngfix.htc) }</style> 

<script type="text/javascript" src="<?=$js_path?>jquery.js"></script>
<!-- UI -->
<link type="text/css" href="<?=base_url()?>css/calendar/calendar.css" rel="stylesheet" />	
<script type="text/javascript" src="<?=$js_path?>jquery.ui.js"></script>
<!-- Pack :: alphanumeric, form, easing, preview -->
<script type="text/javascript" src="<?=$js_path?>jquery.pack.js"></script>
<script type="text/javascript" src="<?=$path?>js/jquery.tablesorter.min.js"></script>
<script type="text/javascript" src="<?=$path?>js/tag.js"></script>
<script type="text/javascript" src="<?=$path?>js/artist.js"></script>
<script type="text/javascript" src="<?=$path?>js/scripts.js"></script>
<script type="text/javascript" src="<?=$path?>js/facebox.js"></script>
<script type="text/javascript" src="<?=$path?>js/dashboard.js"></script>

<link href="<?=$path?>css/styles.css" rel="stylesheet" type="text/css" />
<link href="<?=$path?>css/facebox.css" rel="stylesheet" type="text/css" />
<!-- Load Tipsy -->
<link rel="stylesheet" href="<?php echo  $library_folder;?>tipsy/tipsy.css" type="text/css" />
<script type="text/javascript" src="<?php echo  $library_folder;?>tipsy/jquery.tipsy.js"></script>
<script type='text/javascript'>
  $(function() {
    $('.title').tipsy({gravity: 'nw', html:true, fade:true});
    $('.todo_icon').tipsy({gravity: 's', html:true});
	$('.tooltip').tipsy({gravity: 'w', html:true});
    $('.form_tip').tipsy({trigger: 'focus', gravity: 'w', html:true});
  });
  function base_url(){
     return '<?php echo base_url();?>'; 
  }
  $('ul.paginator li a').click(function(){
	  alert($(this).attr('href'));
	  return false;
  });
</script>