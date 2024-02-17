<?php
/**
 * Homepage news trait.
 *
 * @package conversions-extension
 */

namespace conversions\extensions\homepage\sections;

trait news {

	/**
	 * Return the latest news.
	 *
	 * @since 2019-12-19
	 */
	public function get_news() {
		// Get latest posts.
		$args = [
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 3,
			'orderby'             => 'date',
			'order'               => 'DESC',
			'ignore_sticky_posts' => 1,
		];

		$news = new \WP_Query( $args );
		if ( ! $news->have_posts() )
			return false;

		return $news;
	}

	/**
	 * Return the news section content.
	 *
	 * @since 2019-12-19
	 */
	public function news_content() {
		$news = $this->get_news();
		if ( ! $news )
			return;
		ob_start();
		$news_count = 0;
		while ( $news->have_posts() ) :
			$news->the_post();
			?>

			<!-- Post item -->
			<div class="col-sm-12 col-lg-4 c-news__card-wrapper" id="c-news__<?php echo esc_attr( $news_count ); ?>">
				<article class="card shadow h-100">

					<!-- Post image -->
					<a class="c-news__img-link" href="<?php esc_url( the_permalink() ); ?>">
						<?php
						if ( has_post_thumbnail() ) :
							the_post_thumbnail( 'conversions-news', array( 'class' => 'card-img-top', 'loading' => 'lazy' ) );
						else :
							echo '<img class="card-img-top" loading="lazy" alt="' . esc_html( get_the_title() ) . '" src="' . esc_url( get_template_directory_uri() ) . '/placeholder.png" />';
						endif;
						?>
					</a>

					<!-- Post content -->
					<div class="card-body pb-1">
						<h3 class="h5">
							<a href="<?php esc_url( the_permalink() ); ?>">
								<?php the_title(); ?>
							</a>
						</h3>
						<p class="text-muted">
							<?php
							// Get the post exerpt and limit output to 15 words.
							$post_content = strip_shortcodes( get_the_excerpt() );
							$post_content = wp_trim_words( $post_content, 15, '...' );
							$post_content = str_replace( '[...]Read More', '', $post_content );

							// Output post content.
							echo esc_html( $post_content );
							?>
						</p>
					</div>

					<!-- Post meta -->
					<div class="card-footer text-muted d-flex justify-content-between align-items-center small">
						<?php
						conversions()->template->posted_on();
						conversions()->template->reading_time();
						?>
					</div>
				</article>
			</div>
			<!-- End Post Item -->

			<?php
			++$news_count;

		endwhile;
		wp_reset_postdata();
		$content = ob_get_contents();
		ob_clean();
		return $content;
	}

	/**
	 * News section.
	 *
	 * @since 2019-12-16
	 */
	public function news() {
		$news  = $this->get_news();
		$title = get_theme_mod( 'conversions_news_title' );
		$desc  = get_theme_mod( 'conversions_news_desc' );
		if ( ! $news && empty( $title ) && empty( $desc ) )
			return;
		?>

	<!-- News Section -->
	<section class="c-news">
		<div class="container-fluid">
			<div class="row">

				<?php if ( ! empty( $title ) || ! empty( $desc ) ) { ?>

					<!-- Title -->
					<div class="col-12 c-intro">
						<div class="w-md-80 w-lg-60 c-intro__inner">
							<?php
							if ( ! empty( $title ) ) {
								// Title.
								echo '<h2 class="h3">' . esc_html( $title ) . '</h2>';
								do_action( 'conversions_homepage_after_news_title' );
							}
							if ( ! empty( $desc ) ) {
								// Description.
								echo '<p class="subtitle">' . wp_kses_post( $desc ) . '</p>';
							}
							?>
						</div>
					</div>

					<?php
				}

				do_action( 'conversions_homepage_before_news' );
				echo $this->news_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				do_action( 'conversions_homepage_after_news' );
				?>

			</div>
		</div>
	</section>
		<?php
	}
}
