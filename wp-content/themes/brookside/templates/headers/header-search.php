<div class="search-area">
	<div class="container">
		<div class="span12">
			<form action="<?php echo esc_url(home_url('/')); ?>" id="header-searchform" method="get">
		        <input type="text" id="header-s" name="s" value="<?php esc_html_e('Enter Your Keywords', 'brookside'); ?>" onfocus="if(this.value=='<?php esc_html_e('Enter Your Keywords', 'brookside') ?>')this.value='';" onblur="if(this.value=='')this.value='<?php esc_html_e('Enter Your Keywords', 'brookside') ?>';" autocomplete="off" />
		        <button type="submit"><i class="la la-search"></i></button>
			</form>
		</div>
	</div>
	<a href="#" class="close-search"><i class="la la-times"></i></a>
</div>