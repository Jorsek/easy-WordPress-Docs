<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<?php $root_map_id = get_root_map_id(); ?>
	
	<div class="header-title"><?php echo get_the_title($root_map_id); ?></div>
	
	<div class="main-entry-wrapper">
		<?php get_template_part('template-parts/toc-tutorial'); ?>
		<div class="entry-content">
			<div class="root-title"><?php echo get_the_title(get_hierarchy()[1]) ?></div>
			<?php if (get_the_title(get_hierarchy()[1]) != get_the_title()) : ?>
			<div class="content-title"><?php echo get_the_title(); ?></div>
			<?php endif ?>
			<?php 
				the_content();
			?>
		</div><!-- .entry-content -->
	</div> <!-- .main-entry-wrapper -->
	<script type="text/javascript">
		
		jQuery(function(){ // document ready
			
			var tocOrigTop = jQuery('#side-toc').offset().top;
			var subsections = jQuery('h1[id]');
			var locations = [];
			var ids = [];
			for (var i=0; i < subsections.length; i++) {
				locations.push(subsections[i].offsetTop);
				ids.push(subsections[i].id);
			}
			
			jQuery(window).scroll(function(){ // scroll event  
			
				// Set the hash appropriately when scrolling
				var cScrollTop = jQuery('body')[0].scrollTop;
				for (var i=0; i < locations.length; i++) {
					if (i == 0 && cScrollTop < locations[i]) {
						history.replaceState({},'',location.pathname);
						break;
					} else if (cScrollTop < locations[i] && cScrollTop > locations[i-1]) {
						history.replaceState({},'',location.pathname+"#"+ids[i-1])
						// highlight the current step in the TOC
						jQuery('#side-toc li.parent-item:has(a[href ^= "#"])').each(function(index) {
							jQuery(this).removeClass('parent-item');
						});
						jQuery('#side-toc li:has(a[href = "'+location.hash+'"])').addClass('parent-item');
						break;
					}
				}
			
				// Make sure the TOC stays on screen
				var cScrollTop = jQuery(window).scrollTop(); // returns number
				if (tocOrigTop < cScrollTop+45) {
					jQuery('#side-toc').css({ position: 'fixed', top: '45px' });
				} else {
					jQuery('#side-toc').css('position','static');
				}
			
			});

		});
	</script>
</article><!-- #post-## -->

