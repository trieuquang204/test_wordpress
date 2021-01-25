<form action="<?php echo esc_url(home_url('/')); ?>" id="searchform" method="get">
        <input type="text" id="s" name="s" value="<?php esc_html_e('Search', 'brookside'); ?>" onfocus="if(this.value=='<?php esc_html_e('Search', 'brookside') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php esc_html_e('Search', 'brookside') ?>';" autocomplete="off" />
        <input type="submit" value="<?php esc_html_e('Search', 'brookside'); ?>" id="searchsubmit" />
</form>