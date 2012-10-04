<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="language" content="Japanese">
<script src="<?=base_url()?>js/jquery.js"></script>
<script>    
    function deleteLanguage(obj, lang){
        if(confirm('Deleting this language is irreversible. Do you want to continue?')){
            $(obj).prev("input[type=submit]").attr('name', 'delAxn').val(lang).trigger('click');
        }    
    }
</script>
<title><?php echo $page_title; ?></title>
<style>
body { background-color: #fff; margin: 30px; font-family: Lucida Grande, Verdana, Sans-serif; font-size: 12px; color: #4F5155; }
td { font-size: .8em; padding: .5em; margin: .5em; background: #f9f9f9; }
pre { font-size: 1.1em; }
hr { margin: 20px; }
a { color: #003399; background-color: transparent; font-weight: normal; }
h1 { color: #444; background-color: transparent; border-bottom: 1px solid #D0D0D0; font-weight: bold; margin: 24px 0 2px 0; padding: 5px 0 6px 0; }
h2{border-bottom: 1px solid #D0D0D0;padding: 5px 0 6px; margin: 2em 0 1em;}
label{font-weight:bold; display:block;margin-bottom: 9px;}
form.lfloat { float: left; }
.clear{clear:both;}
input[type=submit] { border: 1px solid #D0D0D0; margin: 1em 2em 0.4em 0; font-weight: bold; font-size: 1.2em;  padding: .5em; cursor: pointer; }
input[type=submit]:hover { border: 1px solid #D0D0D0; background-color:#fff; }
input[type=submit].master { background-color: #FEB7B7; border: 1px solid #FE8B8B; }
td { padding: 0.4em }
.translator_table_header { font-size: 1.5em; font-weight: bold; background: none; border-bottom: 1px solid  #D0D0D0; }
.translator_error { color: #f00; font-weight: bold; }
.translator_note { color: #0f0; font-weight: bold; }
input[type=text]{width: 100%; border: 1px solid #ccc; padding: 5px;}
.frm-add-lang input[type=text] {width: 274px; margin-bottom: 10px; display: block;}
.imp{color: red; font-style: italic;}
.frm_error{color:red;margin-bottom: 7px;}
.success{background-color: green; color: white;font-size: 13px;margin: 0 0 10px;padding: 6px 10px;width: 268px;}
.mrg-b{margin-bottom:1em}
.r{position:relative}
.del_lang{background-color: #eee; border: 1px solid #ccc; border-top:none; font-size: 7px; padding: 2px 4px; 
            position: absolute; top: 15px; width: 5px; top: 15px; border-radius: 0 0 4px 0; text-align:center;cursor: pointer;}
.del_lang:hover{ background-color: #333; color: white; }
.del_lang a{text-decoration: none}

</style>
</head>
<body>
<div id="wrapper" style="width:100%; margin:auto; padding:0; border: none;">
<div id="content">
<h1><?php echo $page_title ?></h1>
<p><a href="<?=site_url('apanel')?>">Apanel</a> | <a href="?">Translator home</a></p>