<?php get_header();
$term = get_queried_object()->cat_ID;
$background_image = esc_url(get_field('background_image', 'category_'.$term));
$layout = sanitize_text_field(get_field('blog_layout', 'option'));
$layoutarray = array('full','rich','simple');
$resource_tax2 = sanitize_html_class(get_field('resource_tax2', 'option'));
$usingSidebar = is_active_sidebar('resources-sidebar')? ' t-203 d-5of7': '';
$main_class_list = $layout.$usingSidebar;
if (!empty($_GET['s'])):
	$s = $_GET['s'];
else:
	if (!empty($_GET['resource-type'])): $resource_type = $_GET['resource-type']; endif;
	if (!empty($_GET[$resource_tax2])): $resource_type2 = $_GET[$resource_tax2]; endif;
endif;
?>

		<div id="content">
			<div id="inner-content" class="wrap cf">
				<div class="resource-search">
					<form id="sort-resources" action="" method="get"><input type="hidden" name="post_type" value="resources" />
						<?php $cats = get_categories('taxonomy=resource-type&type=resources');
							if ($cats): ?>
							<div class="resource-type">
								<input type="checkbox" id="dropdown" value=""><label for="dropdown" class="check">Resource Type:</label><div>
								<?php foreach ($cats as $cat):
									if ( is_array($resource_type) && in_array($cat->slug,$resource_type)):
										echo $cat->name.' <input type="checkbox" name="resource-type[]" value="'.$cat->slug.'" checked><br/>';
									elseif ( !is_array($resource_type) && $cat->slug == $resource_type):
										echo $cat->name.' <input type="checkbox" name="resource-type[]" value="'.$cat->slug.'" checked><br/>';
									else:
										echo $cat->name.' <input type="checkbox" name="resource-type[]" value="'.$cat->slug.'"><br/>';
									endif;
								endforeach;
							?></div></div>
						<?php endif; ?>
						<?php $cats = get_categories('taxonomy='.$resource_tax2.'&type=resources');
							if ($cats): ?>
							<div class="resource-type">
								<input type="checkbox" id="dropdown2" value=""><label for="dropdown2" class="check"><?php echo ucwords($resource_tax2).':'; ?></label><div>
								<?php foreach ($cats as $cat):
									if ( is_array($resource_type2) && in_array($cat->slug,$resource_type2)):
										echo $cat->name.' <input type="checkbox" name="'.$resource_tax2.'[]" value="'.$cat->slug.'" checked><br/>';
									elseif ( !is_array($resource_type2) && $cat->slug == $resource_type2):
										echo $cat->name.' <input type="checkbox" name="'.$resource_tax2.'[]" value="'.$cat->slug.'" checked><br/>';
									else:
										echo $cat->name.' <input type="checkbox" name="'.$resource_tax2.'[]" value="'.$cat->slug.'"><br/>';
									endif;
								endforeach;
							?></div></div>
						<?php endif; ?>
					<label for="s" class="screen-reader-text space"> Or Search </label>
					<input type="text" id="s" name="s" placeholder="<?php
						if (isset($_GET['s']) && !$_GET['s']=='' ):
							echo $_GET['s'];
						else:
							echo 'Search';
						endif; ?>"/>
					<button alt="Search" form="sort-resources" type="submit" value="Submit" class="btn">Submit</button>
					</form>
				</div>
				<main id="main" class="m-all cf<?php echo ' '.$main_class_list; ?>" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

					
					<?php
					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; 
					if (!empty($s)):
						$args = array(
							'posts_per_page' => 12,
							'post_type' => 'resources',
							's' =>$s
						);
						elseif (!empty($resource_type) && empty($resource_type2)):
							$args = array(
								'posts_per_page' => 12,
								'post_type' => 'resources',
								'tax_query' => array(
									array(
										'taxonomy' => 'resource-type',
										'field' => 'slug',
										'terms' => $resource_type
									)
								)
							);
						elseif (empty($resource_type) && !empty($resource_type2)):
							$args = array(
								'posts_per_page' => 12,
								'post_type' => 'resources',
								'tax_query' => array(
									array(
										'taxonomy' => $resource_tax2,
										'field' => 'slug',
										'terms' => $resource_type2
									)
								)
							);
						else:
							$args = array(
								'posts_per_page' => 12,
								'post_type' => 'resources'
							);
					endif; 

					if($paged > 1){
						$args['paged'] = $paged;
					}

                    $the_query = new WP_Query( $args );
                    
					add_filter('the_excerpt', 'braftonium_resource_excerpt');
						if ( $the_query->have_posts()) : while ( $the_query->have_posts()) :  $the_query->the_post(); 
				?>


							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?>>

								<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
									echo '<div class="thumbnail">';
									if (in_array($layout, $layoutarray)):
										echo '<a href="'. get_the_permalink().'"  title="'. the_title_attribute( 'echo=0' ) .'">';
										the_post_thumbnail('medium');
										echo '</a>';
									else:
										the_post_thumbnail('medium');
									endif;
									echo '</div>';
								} ?>
								<div class="content"><header class="entry-header article-header">
									<h2 class="h3 entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									<p class="byline entry-meta vcard">
									<?php $terms = get_the_terms( $post->ID , 'resource-type' );
									    echo '<span class="tax-terms">';
										foreach ( $terms as $term ) {
										echo '<strong>'.$term->name.' </strong>';
										}
										echo '</span><br/>'; ?>
										<?php printf( __( '', 'braftonium' ).' %1$s %2$s',
                  							     /* the time the post was published */
                  							     '<time class="updated entry-time" datetime="' . get_the_time('Y-m-d') . '" itemprop="datePublished">' . get_the_time(get_option('date_format')) . '</time>',
                       								/* the author of the post */
                       								'<span class="by">'.__('by', 'braftonium').'</span> <span class="entry-author author" itemprop="author" itemscope itemptype="http://schema.org/Person">' . get_the_author_link( get_the_author_meta( 'ID' ) ) . '</span>'
                    							);
												if (function_exists('braftonium_social_sharing_buttons')):
													braftonium_social_sharing_buttons();
												endif; ?>
									</p>
								</header>

								<section class="entry-content cf">
									<?php $e = get_the_excerpt();
									printf('<p>%s</p>', $e); ?>
									<p>
										<?php 
											$direct = get_field('direct_download');
											$url = get_the_permalink();
											$button_text = 'View';
											if($direct){
												$download_link = get_field('resource_file');
												$url = $download_link['url'];
												$button_text = 'Download';
											}
											printf('<a href="%s" class="btn">%s</a>', $url, $button_text);
										?>
										
									</p>
								</section></div>

							</article>

							<?php endwhile; ?>

								<?php if($the_query->max_num_pages > 1){ braftonium_page_navi(); } ?>

							<?php else : ?>

								<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'braftonium' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'The article you were looking for was not found, but maybe try looking again!', 'braftonium' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php // _e( 'This is the error message in the archive.php template.', 'braftonium' ); ?></p>
									</footer>
								</article>

							<?php endif; ?>

						</main>
					<?php //get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
