<?php

function get_breadcrumb() {

	global $post;
  
	$trail = '';
	$page_title = get_the_title($post->ID);

	if($post->post_parent) {
		$parent_id = $post->post_parent;

		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a> &gt; ';
			$parent_id = $page->post_parent;
		}
		
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach($breadcrumbs as $crumb) $trail .= $crumb;
	}

	/** Add home **/
	$trail = '<a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . __('Home', 'easydita_knowledge_portal') . '</a> &gt; ' . $trail;

	$trail .= $page_title;
	$trail .= '';

	return $trail;	

}

?>

<?php if (is_search()) :
	$versionId = easydita_knowledge_portal_get_version_id();
	$versionTitle = get_the_title($versionId);
	?>
	<div class="breadcrumbs"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php _e('Home', 'easydita_knowledge_portal'); ?></a> &gt; <?php echo $versionTitle; ?> &gt; <?php _e('Search Results', 'easydita_knowledge_portal'); ?></div>

<?php elseif (!is_front_page()) : ?>

	<div class="breadcrumbs"><?php echo get_breadcrumb() ?></div>

<?php endif; ?>