<?php

	/*
	Template Name: Главная страница
	*/

	get_header(); 

	//main section
	$main_title = get_field('main_title');
	$main_text = get_field('main_text'); 
	$main_btn_url = get_field('main_btn_url');  
	$main_btn = get_field('main_btn');
	$main_tabs = get_field('main_tabs');
	$main_tab_class = get_field('main_tab_class');
	$main_tab_icon = get_field('main_tab_icon');
	$main_tab_text = get_field('main_tab_text');
	$main_tab_close = get_field('main_tab_close');
	$tab = get_field('tab_title');

	//Optimization section
	$optimization_title = get_field('optimization_title');
	$optimization_text = get_field('optimization_text');
	$optimization_repeater = get_field('optimization_repeater');
	$optimization_tab_icon = get_field('optimization_tab_icon');
	$optimization_tab_title = get_field('optimization_tab_title');
	$optimization_tab_close = get_field('optimization_tab_close');

	//получаем классы для табов
	$tab_classes = ['tab-twitter', 'tab-pinterest', 'tab-facebook', 'tab-dribbble']; 

	//Title section
	$title = get_field('title');
	$title_opacity = get_field('title_opacity');

	//Logos section
	$logos_title = get_field('logos_title');
	$logos_repeater = get_field('logos_repeater');
	$logo = get_field('logo');

	//Tabs section
	$tabs_title = get_field('tabs_title');
	$social_tabs = get_field('social_tabs');//repeater
	$data_id = get_field('data_id');
	$socials_icon = get_field('socials_icon');
	$tab_content = get_field('tab_content'); //repeater
	$tab_content_image = get_field('tab_content_image');

	//Join section
	$join_title = get_field('join_title');
	$join_title_opacity = get_field('join_title_opacity');
	$join_btn_url = get_field('join_btn_url');
	$join_btn = get_field('join_btn');

?>

<main class="main">
	<div class="container main-container">
		<div class="main-heading">
			<h1 class="main-heading__title">
				<?php echo esc_html( $main_title ); ?>
			</h1>
			<p class="main-heading__text section-text">
				<?php echo esc_html( $main_text ); ?>
			</p>
			<a href="<?php echo esc_url( $main_btn_url ); ?>" class="btn main-btn">
				<?php echo esc_html( $main_btn ); ?>
			</a>
		</div>

		<?php if ( ! empty( $main_tabs ) ) : ?>
			<div class="main-tabs">
				<?php 
				$tab_classes = [ 'tab-twitter', 'tab-pinterest', 'tab-facebook', 'tab-dribbble' ]; 
				?>
				<?php foreach ( $main_tabs as $index => $tab ) : ?>
					<?php 
					$tab_class = isset( $tab_classes[ $index ] ) ? $tab_classes[ $index ] : '';
					$icon_url  = ! empty( $tab['main_tab_icon']['url'] ) ? esc_url( $tab['main_tab_icon']['url'] ) : '';
					$icon_alt  = ! empty( $tab['main_tab_icon']['alt'] ) ? esc_attr( $tab['main_tab_icon']['alt'] ) : 'icon';
					$tab_text  = ! empty( $tab['main_tab_text'] ) ? esc_html( $tab['main_tab_text'] ) : '';
					?>

					<div class="main-tab <?php echo esc_attr( $tab_class . ' ' . $icon_alt . ' ' . $main_tab_class ); ?>">
						<div class="main-tab__logo">
							<?php if ( $icon_url ) : ?>
								<img src="<?php echo $icon_url; ?>" alt="<?php echo $icon_alt; ?>">
							<?php endif; ?>
						</div>

						<span class="main-tab__title">
							<?php echo $tab_text; ?>
						</span>

						<div class="close main-tab__close">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/close-icon-shadow.svg' ); ?>" alt="<?php esc_attr_e( 'Close icon', 'text-domain' ); ?>">
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</main>


<section class="tabs-section section section-optimization">
    <div class="container">
        <div class="tabs-wrapper">
            <div class="tabs-content">
                <h2 class="section-title tabs-content__title">
                    <?php echo esc_html( $optimization_title ); ?>
                </h2>
                <img class="tabs-arrow__icon tabs-arrow__icon--left" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/arrow-left-icon.svg' ); ?>" alt="<?php esc_attr_e( 'Arrow left', 'text-domain' ); ?>">
                <div class="tabs-notification">
                    <?php if ( ! empty( $optimization_repeater ) ) : ?>
                        <?php foreach ( $optimization_repeater as $tab ) : ?>
                            <div class="tabs-notification">
                                <div class="tabs-notification__btn">
                                    <div class="tabs-notification__logo">
                                        <?php if ( ! empty( $tab['optimization_tab_icon']['url'] ) ) : ?>
                                            <img src="<?php echo esc_url( $tab['optimization_tab_icon']['url'] ); ?>" alt="<?php echo esc_attr( $tab['optimization_tab_icon']['alt'] ?? 'icon' ); ?>">
                                        <?php endif; ?>
                                    </div>
                                    <span><?php echo esc_html( $tab['optimization_tab_title'] ?? '' ); ?></span>
                                    <div class="close">
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/close-icon.svg' ); ?>" alt="<?php esc_attr_e( 'Close icon', 'text-domain' ); ?>">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <img class="tabs-arrow__icon tabs-arrow__icon--right" src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/arrow-right-icon.svg' ); ?>" alt="<?php esc_attr_e( 'Arrow right', 'text-domain' ); ?>">
                <p class="section-text tabs-text">
                    <?php echo esc_html( $optimization_text ); ?>
                </p>
            </div>
        </div>
    </div>
</section>


<section class="title-section section">
	<div class="container">
		<h2 class="section-title">
			<?php echo $title; ?>
			<span class="section-title--opacity"> 
				<?php echo $title_opacity; ?>
			</span>
		</h2>
	</div>
</section>

<section class="logos section">
    <div class="container">
        <h2 class="section-title logos-title">
            <?php echo esc_html( $logos_title ); ?>
        </h2>
        <div class="logos-wrapper row">
            <?php if ( ! empty( $logos_repeater ) ) : ?>
                <?php foreach ( $logos_repeater as $logo ) : ?>
                    <div class="logo-company">
                        <?php if ( ! empty( $logo['logo']['url'] ) ) : ?>
                            <img src="<?php echo esc_url( $logo['logo']['url'] ); ?>" alt="<?php echo esc_attr( $logo['logo']['alt'] ?? 'Company logo' ); ?>">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="social-tabs-section section">
    <div class="container">
        <h2 class="section-title tabs-title">
            <?php echo esc_html( $tabs_title ); ?>
        </h2>
        <div class="tabs">
            <?php if ( ! empty( $social_tabs ) ) : ?>
                <?php foreach ( $social_tabs as $index => $tab ) : ?>
                    <button class="tab <?php echo ( $index === 0 ) ? 'active' : ''; ?>" data-tab="<?php echo esc_attr( $tab['data_id'] ); ?>">
                        <img src="<?php echo esc_url( $tab['socials_icon']['url'] ); ?>" alt="<?php echo esc_attr( $tab['socials_icon']['alt'] ?? 'Social icon' ); ?>">
                    </button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="tab-contents">
            <?php if ( ! empty( $social_tabs ) ) : ?>
                <?php foreach ( $social_tabs as $index => $tab ) : ?>
                    <div class="tab-content <?php echo ( $index === 0 ) ? 'active' : ''; ?>" id="<?php echo esc_attr( $tab['data_id'] ); ?>">
                        <?php if ( ! empty( $tab['tab_content'] ) ) : ?>
                            <?php foreach ( $tab['tab_content'] as $content_image ) : ?>
                                <div class="tweet-image">
                                    <img src="<?php echo esc_url( $content_image['tab_content_image']['url'] ); ?>" alt="<?php echo esc_attr( $content_image['tab_content_image']['alt'] ?? 'Content image' ); ?>">
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <!-- <button class="tab-content__btn more-btn btn">View More Trend</button> -->
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section pricing">
	<div class="container">
		<div class="section-heading pricing-heading">
			<h2 class="section-title pricing-title">Get your best deal</h2>
			<div class="toggle-container">
				<span>Monthly</span>
				<label class="switch">
					<input type="checkbox" id="pricing-toggle">
					<span class="slider"></span>
				</label>
				<span>Yearly</span>
			</div>
		</div>
		<?php
		$args = [
			'post_type'      => 'packages',
			'posts_per_page' => -1,
		];
		$packages_query = new WP_Query( $args );

		if ( $packages_query->have_posts() ) :
			$counter = 0;
			?>
			<div class="pricing-wrapper row">
				<?php
				while ( $packages_query->have_posts() ) :
					$packages_query->the_post();
					$tariff_name        = get_field( 'tariff_name' );
					$tariff_description = get_field( 'tariff_description' );
					$price_monthly      = get_field( 'price_monthly' );
					$price_yearly       = get_field( 'price_yearly' );
					$tariff_list        = get_field( 'tariff_list' ); // Repeater
					$tariff_btn_url     = get_field( 'tariff_btn_url' );
					$tariff_btn_text    = get_field( 'tariff_btn_text' );

					$counter++;
					$highlight_class    = ( 2 === $counter ) ? ' highlighted' : '';
					$highlight_btn_class = ( 2 === $counter ) ? ' highlighted-btn' : 'pricing-btn--green';
					?>
					<div class="pricing-column">
						<div class="pricing-item<?php echo esc_attr( $highlight_class ); ?>">
							<h4 class="pricing-item__title"><?php echo esc_html( $tariff_name ); ?></h4>
							<h5 class="pricing-item__subtitle"><?php echo esc_html( $tariff_description ); ?></h5>
							<p class="price" data-monthly="<?php echo esc_attr( $price_monthly ); ?>" data-yearly="<?php echo esc_attr( $price_yearly ); ?>">
								<?php echo esc_html( $price_monthly ); ?> <span>/Month</span>
							</p>
							<ul class="pricing-list">
								<?php if ( $tariff_list ) : ?>
									<?php foreach ( $tariff_list as $item ) : ?>
										<li class="pricing-list__item">
											<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M18.6946 7.93136C19.1467 8.45305 19.0904 9.2425 18.5687 9.69463L11.0687 16.1946C10.5731 16.6241 9.82984 16.5976 9.36612 16.1339L5.36612 12.1339C4.87796 11.6457 4.87796 10.8543 5.36612 10.3661C5.85427 9.87798 6.64573 9.87798 7.13388 10.3661L10.3109 13.5431L16.9313 7.80541C17.453 7.35327 18.2425 7.40966 18.6946 7.93136Z" fill="black" />
											</svg>
											<?php echo esc_html( $item['tariff_list_text'] ); ?>
										</li>
									<?php endforeach; ?>
								<?php endif; ?>
							</ul>
							<a href="<?php echo esc_url( $tariff_btn_url['url'] ); ?>" class="btn pricing-btn <?php echo esc_attr( $highlight_btn_class ); ?>">
								<?php echo esc_html( $tariff_btn_text ); ?>
							</a>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
		<div id="modal" class="modal">
			<div class="modal-content">
				<span class="close-btn" id="close-modal">&times;</span>
				<h2>Subscribe</h2>
				<form method="post" class="modal-form">
					<input type="hidden" name="action" value="submit_request" />
					<input type="hidden" id="selected-tariff" name="tariff_name" />
					<label class="modal-form__label" for="name">Username</label>
					<input type="text" placeholder="Enter username" id="name" name="name" required />
					<label class="modal-form__label" for="email">Email</label>
					<input type="email" placeholder="Enter email" id="email" name="email" required />
					<button type="submit" class="submit-btn">Buy a tariff</button>
				</form>
			</div>
		</div>
	</div>
</section>

<section class="join">
	<div class="container">
		<div class="join-heading">
			<div class="join-heading__title">
				<h2 class="section-title--large"> 
					<?php echo $join_title; ?> 
				</h2>
				<h2 class="section-title--large section-title--green">
					<?php echo $join_title_opacity; ?>
				</h2>
			</div>
			<a href ="<?php echo $join_btn_url; ?>" class="join-btn btn">
				<?php echo $join_btn; ?> 
			</a>
		</div>
	</div>
</section>
<?php get_footer(); ?>