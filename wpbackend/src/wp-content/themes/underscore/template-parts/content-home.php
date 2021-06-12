<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscore
 */

?>

<?php
$current_id = get_the_ID();
 $acf_fields = get_all_page_fields( $current_id );

?>

<article id="post-<?php print get_the_ID(); ?>" <?php post_class(); ?>>

	<?php 
	//HOME SECTIONS
	if ( !empty($acf_fields) && !is_null($acf_fields) ) {

		// HERO SECTION
		if ( !empty( $acf_fields["hero_section"] ) && !is_null( $acf_fields["hero_section"] ) ) {
			underscore_hero_section($acf_fields["hero_section"]);
		}

		// ABOUT SECTION
		if ( !empty( $acf_fields["featured_section"] ) && !is_null( $acf_fields["featured_section"] ) ) {
			underscore_featured_section($acf_fields["featured_section"]);
		}

		// PROJECTS SECTION
		if ( !empty( $acf_fields["projects_section"] ) && !is_null( $acf_fields["projects_section"] ) ) {
			underscore_projects_section($acf_fields["projects_section"]);
		}

		// TESTIMONIAL SECTION
		if ( !empty( $acf_fields["testimonials_section"] ) && !is_null( $acf_fields["testimonials_section"] ) ) {
			underscore_testimonial_section($acf_fields["testimonials_section"]);
		}
	}
	?>
	
</article><!-- #post-<?php the_ID(); ?> -->
