<form action="<?=full_url()?>" method="post" id="frmLang">
    <input type="hidden" id="__set_lng" name="__set_lng" value="en" />
    <p>
        <ul id="switch_lang">
            <?php
            $CI = &get_instance(); 
            $site_lang = $CI->config->item('SITE_LANG');
            foreach($site_lang as $_ln=>$_lng){
                $class = (CURRENT_LANGUAGE == $_lng) ? 'active_lang':''?>
            <li>
                <?=anchor('#', $_ln, 'rel="' . $_lng . '" class="' . $class . '" onclick="return false;"') ?>
            </li>
            <?php }?>
        </ul>
    </p>
</form>