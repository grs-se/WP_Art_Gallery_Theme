<footer class="site-footer">
	<div class="site-footer__inner container container--narrow">
		<div class="group">
			<div class="site-footer__col-one">
				<h1 class="school-logo-text school-logo-text--alt-color">
					<a href="<?php echo site_url() ?>"><strong>George Rice-Smith</strong></a>
				</h1>
				<p><a class="site-footer__link" href="#">Based in Hampshire, UK</a></p>
				<p><a class="site-footer__link" href="#">george@georgericesmithartist.co.uk</a></p>
				<p><a class="site-footer__link">Copyright © 2011–2024 George Rice-Smith</a></p>


			</div>

			<div class="site-footer__col-two-three-group">
				<div class="site-footer__col-two">
					<h3 class="headline headline--small">
						<!-- Site Map -->
					</h3>
					<nav class="nav-list">
						<!-- <?php
									wp_nav_menu(array(
										'theme_location' => 'footerLocation1'
									));
									?> -->
						<ul>
							<li><a href="<?php echo site_url('/about') ?>">About</a></li>
							<li><a href="#">Gallery</a></li>
							<li><a href="#">Exhibitions</a></li>
							<li><a href="#">Blog</a></li>
						</ul>
					</nav>
				</div>

				<div class="site-footer__col-three">
					<h3 class="headline headline--small">
						<!-- External -->
					</h3>
					<nav class="nav-list">
						<!-- <?php
									wp_nav_menu(array(
										'theme_location' => 'footerLocation2'
									));
									?> -->
						<ul>
							<li><a href="#">Web Development</Datag></a></li>
							<li><a href="<?php echo site_url('/privacy-policy') ?>">Privacy</a></li>
							<!-- <li><a href="#">Careers</a></li> -->
						</ul>
					</nav>
				</div>
			</div>

			<div class="site-footer__col-four">
				<h3 class="headline headline--small">
					Links
				</h3>
				<nav>
					<ul class="min-list social-icons-list group">
						<li>
							<a href="#" class="social-color-facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
						</li>
						<!-- <li>
							<a href="#" class="social-color-twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
						</li> -->
						<!-- <li>
							<a href="#" class="social-color-youtube"><i class="fa fa-youtube" aria-hidden="true"></i></a>
						</li> -->
						<li>
							<a href="#" class="social-color-linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
						</li>
						<li>
							<a href="#" class="social-color-instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

</body>

</html>