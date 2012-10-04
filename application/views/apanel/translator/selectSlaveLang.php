<?php

/* Forms */

foreach ( $languages as $language ) {
	
	echo form_open('apanel/translator', 'class="lfloat mrg-b r"', $hidden );
    
    $class= $del_link = '';
	if($masterLang == $language){
	    $class= 'master';        
	}else{
	    $del_link .= '<div class="del_lang" onclick="deleteLanguage(this, \''.$language.'\')">X</div>';
	}
	echo form_submit('slaveLang', $language, 'class="'.$class.'"');
    echo $del_link;
	
	echo form_close();
	
}

    echo '<div class="clear"></div>';
    echo '<h2>Add new slave language.</h2>';
    echo $lang_saved;    
    echo form_open('apanel/translator', 'class="frm-add-lang"', array('langDir'=>$hidden['langDir']));
    
    echo form_label('Specify language title. E.g. English, French', 'language');
    echo form_error('language', '<div class="frm_error">', '</div>');
    echo form_input(array('name'=>'language', 'id'=>'language', 'maxlength'=>"30", 'value'=>$lang_saved?set_value('language'):''));
    
    echo form_label('Specify 2 character language short-code. E.g. EN, FR', 'code');
    echo form_error('code', '<div class="frm_error">', '</div>');
    echo form_input(array('name'=>'code', 'id'=>'code', 'maxlength'=>"2", 'value'=>$lang_saved?set_value('code'):''));
    
    echo form_submit('addSlaveLang', 'Submit');
    
    echo form_close();

    echo '<div class="clear"></div>
    <label class="imp">Important: Please be careful while you make any changes in the entire language management procedure. Think twice before you delete or update any thing.</label>';
    

?>
