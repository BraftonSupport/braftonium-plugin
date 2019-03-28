<?php get_header();
$term = get_queried_object()->cat_ID;
$background_image = esc_url(get_field('background_image', 'category_'.$term));
$layout = sanitize_text_field(get_field('blog_layout', 'option'));
$layoutarray = array('full','rich','simple');
$resource_tax2 = sanitize_html_class(get_field('resource_tax2', 'option')); 
if (!empty($_GET['resource-type'])): $resource_type = $_GET['resource-type']; endif;
if (!empty($_GET[$resource_tax2])): $resource_type2 = $_GET[$resource_tax2]; endif;
?>

		<div id="content">
			<div id="inner-content" class="wrap cf">
				<div class="resource-search">
					<form action="" method="get"><input type="hidden" name="post_type" value="resources" /><label for="resource-type" class="screen-reader-text">Resource Type:</label>
					<select name="resource-type" id="resource-type" multiple><option value="all">All</option>
						<?php $cats = get_categories('taxonomy=resource-type&type=resources');
						foreach ($cats as $cat){
							if ($resource_type && $cat->slug == $resource_type):
								echo '<option value="'.$cat->slug.'" selected>'.$cat->name.'</option>';
							else:
								echo '<option value="'.$cat->slug.'">'.$cat->name.'</option>';
							endif;
						}
					?></select>
					<label for="<?php echo $resource_tax2; ?>" class="screen-reader-text"><?php echo ucwords($resource_tax2).':'; ?></label>
					<select name="<?php echo $resource_tax2; ?>" id="<?php echo $resource_tax2; ?>" multiple><option value="all">All</option>
						<?php $cats = get_categories('taxonomy='.$resource_tax2.'&type=resources');
						foreach ($cats as $cat){
							if ($resource_type2 && $cat->slug == $resource_type2):
								echo '<option value="'.$cat->slug.'" selected>'.$cat->name.'</option>';
							else:
								echo '<option value="'.$cat->slug.'">'.$cat->name.'</option>';
							endif;
						}
					?></select>
					<label for="s" class="screen-reader-text">Or search for:</label><input type="text" id="s" name="s" placeholder="Search"/><input alt="Search" type="submit" value="Search" class="blue-btn"></form>
				</div>
				<main id="main" class="m-all <?php if(is_active_sidebar('blog-sidebar')): echo 't-2of3 d-5of7'; endif; ?> cf<?php echo ' '.$layout; ?>" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

					<?php if (!$background_image):
						echo '<header class="article-header">';
							the_archive_title( '<h1 class="page-title">', '</h1>' );
							the_archive_description( '<div class="taxonomy-description">', '</div>' );
						echo '</header>';
					endif; ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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
										foreach ( $terms as $term ) {
										echo '<strong>'.$term->name.'</strong><br/>';
									} ?>
										<?php printf( __( 'Posted', 'braftonium' ).' %1$s %2$s',
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
									<?php the_excerpt(); ?>
								</section></div>

							</article>

							<?php endwhile; ?>

								<?php braftonium_page_navi(); ?>

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
					<?php get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
