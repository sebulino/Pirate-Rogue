<?php
/**
 * The template used for displaying single post content.
 *
 * @package Pirate Rogue
 * @since Pirate Rogue 1.0
 * @version 1.0
 */
?>

<?php
$introtext = get_post_meta($post->ID, 'intro', true);
$custom_class = get_post_meta($post->ID, 'post_class', true);
?>
    
    <article id="post-<?php the_ID(); ?>" <?php post_class($custom_class); ?>>
	<header class="entry-header cf">
			<?php if ( $custom_class != 'no-thumb' 
				&& $custom_class == 'big-thumb' 
				&& '' != get_the_post_thumbnail() 
				&& ! post_password_required() ) : ?>
				<div class="entry-thumbnail">
					<?php the_post_thumbnail('pirate-rogue-bigthumb'); ?>
				</div><!-- end .entry-thumbnail -->
			<?php endif; ?>

			<div class="title-wrap">
				<?php if ( has_category() ) : ?>
				<div class="entry-cats">
					<?php the_category(' '); ?>
				</div><!-- end .entry-cats -->
				<?php endif; // has_category() 
                                
                                $piratenkleider_untertitel  = get_post_meta( get_the_ID(), 'piratenkleider_subtitle', true );	
                                $subtitle  = get_post_meta( get_the_ID(), 'pirate_rogue_subtitle', true );
                                if ((empty($subtitle)) && (isset($piratenkleider_untertitel))) {
                                    $subtitle = $piratenkleider_untertitel;
                                }
                                if ($subtitle) {
                                    echo '<h2 class="subtitle">'.$subtitle."</h2>\n";
                                }
                                                           
                                
				the_title( '<h1 class="entry-title">', '</h1>' );  
                               
				if ( get_post_meta($post->ID, 'intro', true) ) { ?>
					<p class="intro"><?php echo $introtext; ?></p>
				<?php } ?>
			</div><!-- end .title-wrap -->

			<div class="entry-meta cf">
				<div class="meta-columnone">
				    
				    <?php if (('' == get_theme_mod( 'uku_front_hideauthor' ) ) &&  ('' == get_theme_mod( 'uku_all_hideauthor' ) )) { ?>
					<div class="author-pic">
						<?php
						$author_bio_avatar_size = apply_filters( 'uku_author_bio_avatar_size', 100 );
						echo get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
						?>
					</div><!-- end .author-pic -->
                                   
					<div class="entry-author">
					<?php pirate_rogue_posted_by(); ?>
					</div><!-- end .entry-author -->
                                    <?php } ?>
					
					
					
				    <div class="entry-date">
					<a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a>
				    </div><!-- end .entry-date -->
				</div><!-- end .meta-columnone -->

				<div class="meta-columntwo">
					<?php if ( comments_open() ) : ?>
					<div class="entry-comments-single">
						<span class="entry-comments-title"><?php esc_html_e( 'Comments', 'pirate-rogue'); ?></span>
						<span class="entry-comments"><?php comments_popup_link( esc_html__( '0', 'pirate-rogue'), esc_html__( '1', 'pirate-rogue'), esc_html__( '%', 'pirate-rogue'),'comments-link' ); ?></span>
					</div><!-- end .entry-comments -->
					<?php endif; // comments_open() ?>
				</div><!-- end .meta-columntwo -->

				<div class="meta-columnthree">
					<?php edit_post_link( esc_html__( 'Edit Post', 'pirate-rogue'), '<span class="entry-edit">', '</span>' ); ?>
				</div><!-- end .meta-columnthree -->
			</div><!-- end .entry-meta -->
	</header><!-- end .entry-header -->
	<div class="contentwrap">
	    <?php if ( $custom_class != 'big-thumb' 
		    && $custom_class != 'no-thumb' 
		    && '' != get_the_post_thumbnail() 
		    && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div><!-- end .entry-thumbnail -->
	    <?php endif; ?>

	    <div id="socialicons-sticky">
			<div id="entry-content" class="entry-content">
			    <?php    

			     the_content(); 

			    if ( class_exists( 'Pirate_Crew' ) && 'content' == get_theme_mod( 'pirate_rogue_crewmember-position' ) ) {
				$preauthor =  get_post_meta( $post->ID, 'pirate_crew_member_id', true );	
				$style = pirate_rogue_sanitize_pirate_crew_member_style(get_theme_mod( 'pirate_rogue_crewmember-style' ));
				$format = pirate_rogue_sanitize_pirate_crew_member_format(get_theme_mod( 'pirate_rogue_crewmember-format' ));
				$title = get_theme_mod( 'pirate_rogue_crewmember-title' );

				if ($preauthor) {		
				    if (isset($title)) {  
					echo '<h2 class="pirate-crew-title">'.$title.'</h2>';
				    }
				    echo do_shortcode( '[pirate id="'.$preauthor.'" format="'.$format.'" style="'.$style.'" showcontent="0"]' ); 
				}
			    }

			     ?>
			    <?php
				    wp_link_pages( array(
					    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pirate-rogue'),
					    'after'  => '</div>',
				    ) );
			    ?>
			    <?php if ( function_exists( 'sharing_display' ) ) {sharing_display( '', true );}
				    if ( class_exists( 'Jetpack_Likes' ) ) {
				    $custom_likes = new Jetpack_Likes;
				    echo $custom_likes->post_likes( '' );
			    } ?>
			</div><!-- end .entry-content -->

			<footer class="entry-footer cf">
			    <?php $tags_list = get_the_tag_list();
				if ( $tags_list ): ?>
				    <div class="entry-tags"><span><?php esc_html_e('Tags', 'pirate-rogue') ?></span><?php the_tags('',' &bull; ', ''); ?></div>
				<?php endif; ?>
			    <?php
			    // Author bio.
			    if ( get_the_author_meta( 'description' ) ) :
				    get_template_part( 'template-parts/authorbox' );
			    endif;

			    $canonical = get_post_meta( get_the_ID(), 'pirate_rogue_canonical', true );

			     if ($canonical) { ?>
				    <div class="canonical-link"><span><?php echo __('Origin: ','pirate_rogue');?></span><a href="<?php echo $canonical; ?>"><?php echo $canonical; ?></a></div>

			     <?php }

			    ?>
			</footer><!-- end .entry-footer -->

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>

			<?php the_post_navigation( array (
				'next_text' => '<span class="meta-nav">' . esc_html__( 'Next Post', 'pirate-rogue') . '</span> ' .
				'<span class="screen-reader-text">' . esc_html__( 'Next Post', 'pirate-rogue') . '</span> ',
				'prev_text' => '<span class="meta-nav">' . esc_html__( 'Previous Post', 'pirate-rogue') . '</span> ' .
				'<span class="screen-reader-text">' . esc_html__( 'Previous Post', 'pirate-rogue') . '</span> ',
			) ); ?>

	    </div><!-- end #socialicons-sticky -->
	</div><!-- end .content-wrap -->
    </article><!-- end post -<?php the_ID(); ?> -->
