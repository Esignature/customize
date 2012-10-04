<?php

/* Forms */

foreach ( $langdirs as $langdir ) {
	
	echo form_open('apanel/translator', 'class="lfloat"');
	
	echo form_submit('langDir', $langdir);
	
	echo form_close();	
}


    echo '<div class="clear"></div>
    <label class="imp">Important: Please be careful while you make any changes in the entire language management procedure. Think twice before you delete or update any thing.</label>';
    

?>
