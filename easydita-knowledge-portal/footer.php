<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package easydita_knowledge_portal
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer <?php if (is_front_page()) { echo "home"; } else { echo "small"; } ?>" role="contentinfo">
		<div class="user-text">
	  		<?php echo preg_replace("/^(.*?)<br\/>/",'<span class="title">$1</span><br/>',preg_replace("/\s*\n\s*/","<br/>",get_theme_mod( 'footer_html', 'Copyright 2016' ))) ?>
  		</div>
  		<?php if (get_theme_mod('facebook_enabled',1) == 1 ||
  				get_theme_mod('twitter_enabled',1) == 1 ||
  				get_theme_mod('google_enabled',1) == 1 ||
  				get_theme_mod('linkedin_enabled',1) == 1) : ?>
	  		<div class="social">
	  			<div class="title">Social</div>
	  			<?php if (get_theme_mod('facebook_enabled',1) == 1) : ?>
	  				<a href="<?php echo get_theme_mod('facebook_link','#') ?>" target="_blank"><i class="facebook-icon"></i></a>
	  			<?php endif ?>
	  			<?php if (get_theme_mod('twitter_enabled',1) == 1) : ?>
	  				<a href="<?php echo get_theme_mod('twitter_link','#') ?>" target="_blank"><i class="twitter-icon"></i></a>
	  			<?php endif ?>
	  			<?php if (get_theme_mod('google_enabled',1) == 1) : ?>
	  				<a href="<?php echo get_theme_mod('google_link','#') ?>" target="_blank"><i class="google-icon"></i></a>
	  			<?php endif ?>
	  			<?php if (get_theme_mod('linkedin_enabled',1) == 1) : ?>
	  				<a href="<?php echo get_theme_mod('linkedin_link','#') ?>" target="_blank"><i class="linkedin-icon"></i></a>
	  			<?php endif ?>
					<?php if (get_theme_mod('youtube_enabled',1) == 1) : ?>
	  				<a href="<?php echo get_theme_mod('youtube_link','#') ?>" target="_blank"><i class="youtube-icon"></i></a>
	  			<?php endif ?>
	  		</div><!-- .social -->
  		<?php endif; ?>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
