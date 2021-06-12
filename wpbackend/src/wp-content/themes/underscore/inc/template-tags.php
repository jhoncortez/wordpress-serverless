<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package underscore
 */

if ( ! function_exists( 'underscore_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function underscore_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'underscore' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'underscore_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function underscore_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'underscore' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'underscore_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function underscore_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'underscore' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'underscore' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'underscore' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'underscore' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'underscore' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'underscore' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'underscore_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function underscore_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

/****** get custom fields *******/

if ( function_exists( 'get_fields' ) && !function_exists ( 'get_all_page_fields' )) :

	function get_all_page_fields( $postId ) {
		$fields = get_fields( $postId );
		return ( empty( $fields ) || is_null( $fields ) ) ? [] : $fields;
	}
	
endif;

/*
* HOME FUNCTIONS
***/
if ( ! function_exists( 'underscore_hero_section' ) ) :
	function underscore_hero_section($object) {
		?>

			<section id="<?php print $object["custom_id"] ?>" class="section hero-section">
				<div class="container">
					<h1 class="hero-title"><?php print $object['hero_title']; ?></h1>
					<div class="hero-text">
					<?php print $object['hero_description']; ?>
					</div>
					<a class="hero-link-btn" href="<?php print $object['hero_link']; ?>">
							<span class="hero-link-text"><?php print $object['hero_link_text']; ?></span>
					</a>
				</div>
				<div class="hero-image">
					<?php if ( wp_is_mobile() ) :?>
						<img src="<?php print $object['hero_image']['sizes']['medium-large']; ?>" alt="<?php print $object['hero_image']['alt']; ?>" class="mobile-image">
					<?php else:?>
						<img src="<?php print $object['hero_image']['sizes']['2048x2048']; ?>" alt="<?php print $object['hero_image']['alt']; ?>">
					<?php endif;?>
				</div>
			</section><!-- .entry-header -->
		<?php
	}

endif;

if ( ! function_exists( 'underscore_featured_section' ) ) :
	function underscore_featured_section($object) { 
		?>

		<section id="<?php print $object["custom_id"] ?>" class="section section-about">
				<div class="container">
					<div class="grid-flex ">
						<div class="grid-flex-item col3-set">
							<div class="div-block block-content">
								<?php print $object['featured_description']; ?>
								<!--h2>About our Work</h2>
								<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet</p-->
								<a href="<?php print ( $object['featured_link'] ) ? $object['featured_link'] : '#'; ?>" class="link-btn"><?php print ( $object['featured_link_text'] ) ? $object['featured_link_text'] : 'Read more ...'; ?></a>
							</div>
						</div>
						<div class="grid-flex-item col2-set">
							<div class="div-block">
								<?php if ( wp_is_mobile() ) :?>
									<img src="<?php print $object['featured_image']['sizes']['medium']; ?>"  alt="<?php print $object['featured_image']['alt']; ?>" class="mobile-image featured-image">
								<?php else:?>
									<img src="<?php print $object['featured_image']['sizes']['large']; ?>"  alt="<?php print $object['featured_image']['alt']; ?>" class="featured-image">
								<?php endif;?>
								
							</div>
						</div>
					</div>
				</div>
				
				<?php
				//the_content();
				?>
		</section><!-- .section about -->
		<?php
	}

endif;

if ( ! function_exists( 'underscore_projects_section' ) ) :
	function underscore_projects_section( $object ) { 

		if ( $object["show_projects"] ) :

			$args = 
			[
				"post_type" => 'project',
				"numberposts" => $object["number_of_projects"]
			];
			$projects = api_get_posts( $args );?>
		

			<section id="<?php print $object["custom_id"] ?>" class="section section-projects">

				<div class="container bg-vino-100">

					<?php if ( is_null( $projects ) ): ?>

						<p>Sorry there is no public projects yet</p>

					<?php else:?>

						<?php if ( $object["carousel_mode"] ) :  ?> 

							<div class="carousel relative">
								<div class="carousel-inner relative overflow-hidden w-full">
									
									<?php 
									$count = 1; 
									$cant = count( $projects ) ;
									 foreach ( $projects as $project ) : 
									 ?>
										<?php //var_dump( $project );  ?>
										<!--Slide 1-->
										<input class="carousel-open" type="radio" id="carousel-<?php print $count; ?>" name="carousel" aria-hidden="true" hidden="" <?php print ($count == 1)? 'checked="checked"' : '' ?> >
										<div class="carousel-item absolute opacity-0" ><!-- style="height:50vh;"-->
											<div class="block h-full w-full">
											    <!-- content begins here -->
												<div class="grid-flex project">
													<div class="grid-flex-item col3-set">
														<div class="div-block block-content">
															<h3 class="project-title"><a href="#<?php //print get_permalink( $project->ID ) ?>"><?php print $project->post_title; ?></a></h3>
															<a href="#<?php //print get_permalink( $project->ID ) ?>" class="link-btn">See project</a>
															
														</div>
													</div>
													<div class="grid-flex-item col2-set">
														<div class="div-block">
															<?php if ( wp_is_mobile() ) :?>
																<img src="<?php print get_the_post_thumbnail_url( $project->ID, 'medium-large' )?>"  alt="<?php print print $project->post_title ?>" class="featured-image mobile-image">
															<?php else:?>
																
																<img src="<?php print get_the_post_thumbnail_url( $project->ID, 'large' )?>"  alt="<?php print print $project->post_title ?>" class="featured-image  project-image shadow-2xl ">
															<?php endif;?>
															
														</div>
													</div>
												</div>
												<!-- content ends here -->
												
											</div>
										</div>
										<label for="carousel-<?php print ($count == 1)? $cant : $count - 1 ?>" class="arrow-control prev control-<?php print $count; ?> w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-gray-200 hover:text-gray-300 rounded-full bg-transparent leading-tight text-center z-10 inset-y-0 -left-1.5 my-auto">‹</label>
										<label for="carousel-<?php print ($count == $cant )? '1' : $count + 1 ?>" class="arrow-control next control-<?php print $count; ?> w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-gray-200 hover:text-gray-300 rounded-full leading-tight text-center z-10 inset-y-0 -right-1.5 my-auto">›</label>
										
									<?php 
										$count ++;
									 endforeach; ?>

									<!-- Add additional indicators for each slide-->
									<ol class="carousel-indicators">
									    <?php for ($i = 1; $i <= $cant; $i ++) : ?>
											<li class="inline-block mr-3">
												<label for="carousel-<?php print $i ?>" class="carousel-bullet cursor-pointer block text-4xl text-vino hover:text-vino-100">•</label>
											</li> 
										<?php endfor;?>
									</ol>
									
								</div>
							</div>

							<div class="grid-flex ">
								<div class="grid-flex-item col3-set">
									<div class="div-block block-content">
										<?php //print $object['featured_description']; ?>
										<h2 class="title-section"><?php print $object['title_section']?></h2>
										<p class="section-description"><?php print $object['section_description']?></p>
									</div>
								</div>
								<div class="grid-flex-item col2-set">
									<div class="div-block block-content">
										<a href="https://api.whatsapp.com/send?phone=573052376973&text=Hola!%20Necesito%20una%20cotizaci%C3%B3n" target="_blank" class="link-btn">Get in touch</a>
									</div>
								</div>
							</div>
					
						<?php else: ?>

							<div class="div-block list-mode">
								<h2 class="title-section"><?php print $object["title_section"] ?></h2>
								<p class="section-description"><?php print $object['section_description']?></p>
							</div> 
							<div class="collection collection-wrapper">
								<div class="collection-list">

									<?php foreach ( $projects as $project ) : ?>

										<div class="collection-item">
											<!-- content begins here -->						
											<div class="grid-flex">
												<div class="grid-flex-item col3-set">
													<div class="div-block block-content">
														<h3 class="project-title"><a href="<?php print get_permalink( $project->ID ) ?>"><?php print $project->post_title; ?></a></h3>
														<p class="project-description">
															<?php print ( !empty( $project->post_excerpt ) ) ? $project->post_excerpt : wp_trim_words( $project->post_content, 30 ) ?>
														</p>
														<a href="#<?php //print get_permalink( $project->ID ) ?>" class="link-btn">See project</a>
														
													</div>
												</div>
												<div class="grid-flex-item col2-set">
													<div class="div-block project-image-wrapper">
														<?php if ( wp_is_mobile() ) :?>
															<img src="<?php print get_the_post_thumbnail_url( $project->ID, 'medium-large' )?>"  alt="<?php print $project->post_title  ?>" class="mobile-image featured-image shadow-2xl">
														<?php else:?>
																
															<img src="<?php print get_the_post_thumbnail_url( $project->ID, 'large' )?>"  alt="<?php print $project->post_title  ?>" class="featured-image project-image shadow-2xl ">
														<?php endif;?>
															
													</div>
												</div>
												<!-- content ends here -->
											</div>
										</div>

									<?php endforeach; ?>

								</div>
							</div>
						<?php endif;?>

					<?php endif;?>


				</div>
				
				<?php
				//the_content();
				?>
			</section><!-- .section PROJECTS -->
		<?php
		endif;
	}

endif;

if ( ! function_exists( 'underscore_testimonial_section' ) ) :
	function underscore_testimonial_section($object) { 

		if ( $object["show_testimonials"] ) :
			$args = 
			[
				"post_type" => 'testimonial',
				"numberposts" => $object["number_of_testimonials"]
			];
			$testimonials = api_get_posts( $args ); //var_dump($testimonials); 
			?>

			<section id="<?php print $object["custom_id"] ?>" class="section section-testimonials">
				<div class="container">

				<?php if ( is_null( $testimonials ) ): ?>

				<p>Sorry there is no public testimonials yet</p>

				<?php else:?>
					<div class="div-block">
						<h2 class="title-section"><?php print $object["title_section"] ?></h2>
					</div> 
					<div class="collection collection-wrapper">
						<div class="collection-list">

							<?php foreach ( $testimonials as $testimonial ) : ?>

							<div class="collection-item">
								<div class="grid-flex ">
									<div class="grid-flex-item col3-set">
										<div class="div-block block-content">
											<p class="testimonial-message"><span class="quote">"</span><?php print $testimonial -> post_content; ?></p>
										</div>
									</div>
									<div class="grid-flex-item col4-set">
										<div class="div-block testimonial-autor">
										<img src="<?php print get_the_post_thumbnail_url( $testimonial->ID, 'thumbnail' ) ?>" class="featured-image author-image">
											<span class="author-name"><?php print $testimonial -> post_title; ?></span>
										</div>
									</div>
								</div>
							</div>

							<?php endforeach; ?>

						</div>
					</div>

				<?php endif;?>					

				</div>
				
				<?php
				//the_content();
				?>
			</section><!-- .section testimonials -->
		<?php
		endif;
	}

endif;
