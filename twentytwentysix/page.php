<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Six
 * @since Twenty Twenty-Six 1.0
 */

get_header();

the_content();

if (have_rows('sections')) :
	while (have_rows('sections')) : the_row();
		if (get_row_layout() == 'stats-block') :
			$title = get_sub_field('title');
			$description = get_sub_field('description');
?>
			<!-- stats-sec-starts -->
			<div class="stats-wrap section-bg blue-bg">
				<div class="container">
					<div class="content">
						<div class="row">
							<div class="col-lg-6">
								<?php if ($title) : ?>
									<h2 class="h3 title"><?php echo esc_html($title); ?></h2>
								<?php endif;
								if ($description) :
								?>
									<p class="desc">
										<?php echo esc_html($description); ?>
									</p>
								<?php endif; ?>
								<?php if (get_sub_field('learn_more_link')) : ?>
									<div class="btn-wrap">
										<a href="<?php echo get_sub_field('learn_more_link'); ?>" class="btn-sm btn-primary btn-icon-right">Learn More
											<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/btn-arrow-right.svg" alt="arrow" class="svg" /></a>
									</div>
								<?php endif; ?>
							</div>
							<div class="col-lg-6">
								<ul class="card-group-sec">
									<?php
									$cards = get_sub_field('card');
									if ($cards) :
										for ($i = 0; $i < count($cards); $i++) :
											$color = $cards[$i]['bg-color'];
									?>
											<li class="card card-top-<?php echo ($i % 2 == 0) ? "left" : "right"; ?>" <?php echo ($color) ? "style='background-color: $color'" : ''; ?>>
												<h3 class=" h4 num"><?php echo esc_html($cards[$i]['num']); ?><span>+</span></h3>
												<p class="subtitle"><?php echo esc_html($cards[$i]['subtitle']); ?></p>
											</li>
									<?php
										endfor;
									endif;
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- stats-sec-ends -->
		<?php
		endif;

		if (get_row_layout() == 'testimonials') :
			$testimonials = get_sub_field('cards-testimonial');
		?>
			<!-- testimonial-sec-starts -->
			<div class="testimonial-sec-wrap section-bg light-bg">
				<div class="content">
					<div class="sec-title text-center">
						<h2 class="h2 title">Testimonials</h2>
					</div>
					<div class="full-slider-wrap">
						<div class="container">
							<div class="testimonial-slider swiper-slider">
								<div class="swiper-wrapper">
									<?php
									foreach ($testimonials as $testimonial) :
										$name = $testimonial['name'];
										$designation = $testimonial['designation'];
										$paragraph = $testimonial['paragraph'];
										if ($name) :
									?>
											<div class="swiper-slide">
												<div class="card">
													<div class="title-group">
														<div class="left">
															<h6 class="h6 name"><?php echo esc_html($name); ?></h6>
															<?php if ($designation) : ?>
																<div class="designation"><?php echo esc_html($designation); ?></div>
															<?php endif; ?>
														</div>
														<div class="right">
															<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/quote-img.png" alt="quote" width="49" height="32" />
														</div>
													</div>
													<p class="desc">
														<?php echo $paragraph; ?>
													</p>
												</div>
											</div>
									<?php
										endif;
									endforeach;
									?>
								</div>
								<div class="custom-nav">
									<div class="swiper-prev testimonial-prev swiper-button">
										<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/slider-prev-arrow.svg" alt="slider-arrow" class="svg" />
									</div>
									<div class="swiper-next testimonial-next swiper-button">
										<img src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/slider-next-arrow.svg" alt="slider-arrow" class="svg" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php
		endif;
	endwhile;
endif;


get_footer();
