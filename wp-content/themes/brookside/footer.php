		<?php 
			$footer_display = brookside_get_footer_display_option();
			if($footer_display != 'disable') 
				get_template_part('templates/footer/footer', $footer_display );
		?>
		</div> <!-- end boxed -->

	<?php wp_footer(); ?>
	</body>
</html>
