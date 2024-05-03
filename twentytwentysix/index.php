<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Six
 * @since Twenty Twenty-Six 1.0
 */

get_header(); ?>



<?php
$number_posts = 3;

$args = array(
	'post_type' => 'post',
	'posts_per_page' => $number_posts,
	'post_status' => 'publish',
);
$query = new WP_Query($args);

for ($i = 0; $i < $number_posts; $i++) :
	echo $query->posts[$i]->post_title . "<br>";
endfor;

if ($query->have_posts()) :
	$i = 0;
?>
	<!-- blog-home-starts -->
	<div class="blog-home-wrap section">
		<div class="container">
			<div class="content">
				<div class="sec-title text-center">
					<h2 class="h2 title">Our Blogs</h2>
				</div>
				<div class="row listing">
					<?php while ($query->have_posts()) : $query->the_post();
						$image_url = get_the_post_thumbnail_url();
						$post_title = get_the_title();
						$post_date = get_the_date();
					?>
						<?php if ($i == 0) : ?>
							<div class="col-lg-6">
								<!-- Big card-->
								<div class="card">
									<a href="#">
										<img src="<?php echo $image_url; ?>" alt="blog-home" width="760" height="550" />
										<div class="overlay-text">
											<div class="date"><?php echo $post_date; ?></div>
											<h3 class="h4 blog-title">
												<?php echo $post_title; ?>
											</h3>
										</div>
									</a>
								</div>
								<!-- Big card end-->
							</div>
							<div class="col-lg-6">
								<div class="row list-two">
								<?php else : ?>
									<?php if ($i == 1) : ?>
										<div class="col-lg-12">
											<div class="card">
												<a href="#">
													<img src="<?php echo $image_url; ?>" alt="blog-home" width="527" height="263" />
													<div class="overlay-text">
														<div class="date"><?php echo $post_date; ?></div>
														<h3 class="h4 blog-title">
															<?php echo $post_title; ?>
														</h3>
													</div>
												</a>
											</div>
										</div>
									<?php else : ?>
										<div class="col-lg-12">
											<div class="card">
												<a href="#">
													<img src="<?php echo $image_url; ?>" alt="blog-home" width="527" height="263" />
													<div class="overlay-text">
														<div class="date"><?php echo $post_date; ?></div>
														<h3 class="h4 blog-title">
															<?php echo $post_title; ?>
														</h3>
													</div>
												</a>
											</div>
										</div>
								</div>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php $i++;
					endwhile; ?>
				</div>
				<div id="row-list-two" class="row list-two">
				</div>
				<div class="btn-wrap text-center">
					<a id="load-all-btn" href="#" class="btn btn-primary">View All Blogs</a>
				</div>
			</div>
		</div>
	</div>
	<!-- blog-home-ends -->

<?php
endif;
get_footer();
