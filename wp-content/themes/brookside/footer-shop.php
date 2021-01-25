		<div id="section-subscribe">
			<div class="container">
				<div class="span12">
					<?php echo do_blocks('<!-- wp:brookside/subscribe /-->'); ?>
				</div>
			</div>
		</div>
		<?php 
			$footer_display = brookside_get_footer_display_option();
			if($footer_display != 'disable') 
				get_template_part('templates/footer/footer', $footer_display );
		?>
		</div> <!-- end boxed -->
	<?php wp_footer(); ?>
	</body>
</html>
