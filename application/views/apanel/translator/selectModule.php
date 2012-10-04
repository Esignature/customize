<?php

/* Forms */

foreach ( $masterModules as $masterModule ) {
	
	echo form_open('translator', 'class="lfloat"', $hidden );
	
	echo form_submit('langModule', $masterModule );
	
	if ( ! in_array( $masterModule, $slaveModules ) ) {
		echo $slaveLang . " module not found";
	}
	
	echo form_close();
	
}

?>
