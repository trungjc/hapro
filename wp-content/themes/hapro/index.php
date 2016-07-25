<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package whispli
 */

get_header(); ?>

	<section class="main">
		<div class="container-fluid">
			<div class="site-body">
				<div class="hero">
					<div class="slideshow">
						<div class="slideshow-caption">
							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<h2>Let them speak up.</h2>
										<p>Now there’s a way for people to give anonymous reports and information, and for you to communicate with them – anonymously, securely and cost-effectively. Whispli offers a range of business solutions based on a secure, anonymous, two-way communications platform.
										</p>
										<div class="button-container">
											<div class="btn-group" role="group">
												<a href="#product-panel" class="btn btn-default btn-primary">see our products <span class="icon-arrow"></span></a>
												<a href="about.html" class="btn btn-default btn-secondary">Read about Whispli <span class="icon-arrow"></span></a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="slideshow-image" id="slideshow-image">
							<div class="item">
								<img class="hidden-xs" src="<?php echo get_template_directory_uri()?>/assets/img/slideshow/item1.png" alt="" />
								<div class="visible-xs-block " style="background-image: url('<?php echo get_template_directory_uri()?>/assets/img/slideshow/item1.png')"></div>
							</div>
							<div class="item">
								<img class="hidden-xs" src="<?php echo get_template_directory_uri()?>/assets/img/slideshow/item2.png" alt="" />
								<div class="visible-xs-block" style="background-image: url('<?php echo get_template_directory_uri()?>/assets/img/slideshow/item2.png')"></div>
							</div>
							<div class="item">
								<img class="hidden-xs" src="<?php echo get_template_directory_uri()?>/assets/img/slideshow/item3.png" alt="" />
								<div class="visible-xs-block" style="background-image: url('<?php echo get_template_directory_uri()?>/assets/img/slideshow/item3.png')"></div>
							</div>
						</div>
					</div>
				</div>
				<!-- END - hero =================================================================================== -->
				<div class="bellow-hero">
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-xs-12">
								<h2>Anonymous. Secure. Two-way communications</h2>
								<p>Open the gates to the information your organisation needs. Receive and manage information securely and anonymously – all in one cloud-based responsive app.
								</p>
								<a href="contact.html" class="btn btn-default btn-border-dark hidden-xs">Request a free trial <span class="icon-arrow"></span></a>
							</div>
							<div class="col-md-6 col-xs-12">
								<div class="media">
									<div class="pull-left">
                                            <span class="">
                                                <img src="<?php echo get_template_directory_uri()?>/assets/img/clock.png" alt="" />
                                            </span>
									</div>
									<div class="media-body">
										<h3 class="media-heading">secure.</h3>
										<p>High grade 256 bit encryption for the highest data security. </p>
									</div>
								</div>
								<div class="media">
									<div class="pull-left">
                                            <span class="">
                                                 <img src="<?php echo get_template_directory_uri()?>/assets/img/laptop.png" alt="" />
                                            </span>
									</div>
									<div class="media-body">
										<h3 class="media-heading">ANONYMOUS.</h3>
										<p>IP address is scrubbed so informant can never be traced. They never need to reveal their identity.</p>
									</div>
								</div>
								<div class="media">
									<div class="pull-left">
                                            <span class="">
                                                <img src="<?php echo get_template_directory_uri()?>/assets/img/iphone.png" alt="" />
                                            </span>
									</div>
									<div class="media-body">
										<h3 class="media-heading">communications.</h3>
										<p>Stay in communication with the informant throughout the case, so they can give more information and get any help they need.</p>
									</div>
								</div>
								<a href="" class="btn btn-default btn-border-dark visible-xs-block">Request a free trial<span class="icon-arrow"></span></a>
							</div>
						</div>
					</div>
				</div>
				<!-- END - bellow-hero =================================================================================== -->
				<div class="product-panel" id="product-panel">
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="product-item purple-overlay">
									<div class="product-item-heading">
										<a href="" class="image">
											<img src="<?php echo get_template_directory_uri()?>/assets/img/products/whispli_homepage_02_03.jpg" alt="" />
										</a>
										<h2 class="name">
											<img src="<?php echo get_template_directory_uri()?>/assets/img/fraund.png" alt="" />
											<span class="title">FRAUD.</span>
										</h2>
									</div>
									<div class="description">Protect your organisation from fraud, corruption or other unethical practices. Find out about potential risks or safety hazards before it becomes a threat. </div>
									<div class="view-detail"><a class="btn btn-default btn-dark" href="product-fraudsec.html">VIEW FRAUDSEC <span class="icon-arrow"></span></a></div>
								</div>
								<div class="product-item blue-overlay">
									<div class="product-item-heading">
										<a href="" class="image">
											<img src="<?php echo get_template_directory_uri()?>/assets/img/products/whispli_homepage_02_11.jpg" alt="" />
										</a>
										<h2 class="name">
											<img src="<?php echo get_template_directory_uri()?>/assets/img/domestic-violence.png" alt="" />
											<span class="title">Domestic Violence.</span>
										</h2>
									</div>
									<div class="description">Let people report domestic violence anonymously and safely from any mobile device. Give them a channel for ongoing two way communication so they can receive the support they need.</div>
									<div class="view-detail"><a class="btn btn-default btn-dark" href="product-report-dv.html">VIEW REPORTDV<span class="icon-arrow"></span></a></div>
								</div>
								<div class="product-item purple-overlay">
									<div class="product-item-heading">
										<a href="" class="image">
											<img src="<?php echo get_template_directory_uri()?>/assets/img/products/whispli_homepage_02_18.jpg" alt="" />
										</a>
										<h2 class="name">
											<img src="<?php echo get_template_directory_uri()?>/assets/img/media.png" alt="" />
											<span class="title">Media.</span>
										</h2>
									</div>
									<div class="description">Be the first to get the scoop. Give your sources an anonymous secure two-way channel direct to you, so you can receive files and have ongoing communication.</div>
									<div class="view-detail"><a class="btn btn-default btn-dark" href="product-journoTips.html">VIEW JOURNOTIPS<span class="icon-arrow"></span></a></div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="product-item purple-overlay">
									<div class="product-item-heading">
										<a href="" class="image">
											<img src="<?php echo get_template_directory_uri()?>/assets/img/products/whispli_homepage_02_06.jpg" alt="" />
										</a>
										<h2 class="name">
											<img src="<?php echo get_template_directory_uri()?>/assets/img/education.png" alt="" />
											<span class="title">EDUCATION.</span>
										</h2>
									</div>
									<div class="description">Help students report bullying or harassment at school. Provide a safe avenue where they can anonymously chat with an expert and get support.</div>
									<div class="view-detail"><a class="btn btn-default btn-dark" href="product-schoolsafe.html">VIEW SCHOOLSAFE<span class="icon-arrow"></span></a></div>
								</div>
								<div class="product-item blue-overlay">
									<div class="product-item-heading">
										<a href="" class="image">
											<img src="<?php echo get_template_directory_uri()?>/assets/img/products/whispli_homepage_02_14.jpg" alt="" />
										</a>
										<h2 class="name">
											<img src="<?php echo get_template_directory_uri()?>/assets/img/aged-care.png" alt="" />
											<span class="title">Aged care.</span>
										</h2>
									</div>
									<div class="description">Help prevent abuse and unethical behaviour in aged care. Provide a safe haven for anyone to come forward – health care staff, patients or family – and have an ongoing conversation to manage the case and provide support.</div>
									<div class="view-detail"><a class="btn btn-default btn-dark" href="product-aged-care-line.html">VIEW AGEDCARELINE<span class="icon-arrow"></span></a></div>
								</div>
								<div class="product-item purple-overlay">
									<div class="product-item-heading">
										<a href="" class="image">
											<img src="<?php echo get_template_directory_uri()?>/assets/img/products/whispli_homepage_02_21.png" alt="" />
										</a>
										<h2 class="name">
											<img src="<?php echo get_template_directory_uri()?>/assets/img/person-of-interest.png" alt="" />
											<span class="title">Persons of <br/>interest.</span>
										</h2>
									</div>
									<div class="description">A unique solution for law enforcement authorities around the globe. Get more tipoffs and evidence about missing persons and criminal behaviour, and respond immediately.</div>
									<div class="view-detail"><a class="btn btn-default btn-dark" href="product-report-somebody.html">VIEW REPORTSOMEBODY<span class="icon-arrow"></span></a></div>
								</div>
							</div>
						</div>
						<div class="row more-item">
							<div class="col-md-6 col-sm-6 col-xs-12 ">
								<div class="description">
									<h2>More applications</h2>
									<p>Whispli solutions can be configured to fit any need for secure, anonymous (or not) two-way communication. What do you need to know, that people are unwilling to tell you?</p>
								</div>
								<div class="view-detail"><a href="contact.html" class="btn btn-default">Contact us to discuss <span class="icon-arrow"></span></a></div>
							</div>
						</div>
					</div>
				</div>
				<!-- END -product-panel =================================================================================== -->
			</div>
			<!-- END -product-panel =================================================================================== -->
		</div>
	</section>
	<!-- END - Main =================================================================================== -->
	<section class="bottom-feature-widget">
		<div class="container-fluid">
			<div class="container-fluid">
				<div class="container">
					<div class="bottom-feature-post row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="feature-post-content">
								<h3 class="heading"><span>WHISPLI IS:</span>Flexible, configurable, customisable.</h3>
								<p>Whispli’s platform is highly configurable. We can customise it to fit your unique need for secure two way communication. And it’s self-serve, so you can configure the forms and other features yourself. You can even whitelabel it.
								</p>
								<a href="contact.html" class="btn btn-default">Contact us to discuss <span class="icon-arrow"></span></a>
							</div>
						</div>
						<div class="col-md-6 col-sm-6  col-xs-12">
							<div class="feature-post-content">
								<h3 class="heading"><span>WHISPLI IS:</span>Any device, anywhere.</h3>
								<p>The Whispli range of solutions is fully mobile responsive, allowing informants to use any web-enabled device from anywhere in the world.
								</p>
								<a href="contact.html" class="btn btn-default">Request a demo <span class="icon-arrow"></span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- END - widget-content-bottom =================================================================================== -->
	<section class="bottom-brand-widget">
		<div class="container">
			<div class="brand-post row">
				<div class="col-md-12 col-xs-12">
					<h2 class="title">As featured in...</h2>
					<ul class="feature-logo clearfix">
						<li>
							<a href="http://www.theage.com.au/it-pro/business-it/whistleblower-app-fraudsec-features-anonymising-encrypted-messaging-20150504-1mzc51.html"><img src="<?php echo get_template_directory_uri()?>/assets/img/brand/whispli_homepage_02_06.jpg" alt="" /></a>
						</li>
						<li>
							<a href="http://www.smh.com.au/it-pro/business-it/whistleblower-app-fraudsec-features-anonymising-encrypted-messaging-20150504-1mzc51.html"><img src="<?php echo get_template_directory_uri()?>/assets/img/brand/whispli_homepage_02_03.jpg" alt="" /></a>
						</li>
						<li>
							<a href="http://www.smh.com.au/it-pro/business-it/whistleblower-app-fraudsec-features-anonymising-encrypted-messaging-20150504-1mzc51.html"><img src="<?php echo get_template_directory_uri()?>/assets/img/brand/whispli_homepage_02_09.jpg" alt="" /></a>
						</li>
						<li>
							<a href="img/GRC_May_2015_final.pdf" target="_blank"><img src="<?php echo get_template_directory_uri()?>/assets/img/brand/whispli_homepage_02_15.jpg" alt="" /></a>
						</li>
						<li>
							<a href="http://www.afr.com/technology/fraudsec-whistleblower-app-evolves-from-207-million-leighton-contractors-fraud-20150819-gj2hyp"><img src="<?php echo get_template_directory_uri()?>/assets/img/brand/whispli_homepage_02_17.jpg" alt="" /></a>
						</li>
						<li>
							<a href="http://www.shortpress.com.au/five-up-and-coming-entrepreneurs-to-watch"><img src="<?php echo get_template_directory_uri()?>/assets/img/brand/whispli_homepage_02_19.jpg" alt="" /></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<section class="widget-footer">
		<div class="feature-post">
			<div class="col-3 first-column">
				<div class="post-item light-blue">
					<div class="img-feature" style="background-image:url(<?php echo get_template_directory_uri()?>/assets/img/feature-img-01.jpg)">
					</div>
					<div class="content-item">
						<h3 class="heading"><span>FRAUDSEC</span>August Wrap Up</h3>
						<div class="date">1 Sep 2015</div>
						<p>Fraudsec had a stellar month in August, we were on the road at various conferences with two of our partners in Perth.</p>
						<a href="" class="btn btn-default">read more <span class="icon-arrow"></span></a>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="post-item" style="background-color:#441e74">
					<div class="img-feature">
					</div>
					<div class="content-item">
						<h3 class="heading"><span>SCHOOLSAFE</span>Sed ut perspiciatis</h3>
						<div class="date">1 Sep 2015</div>
						<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo. </p>
						<a href="" class="btn btn-default">read more <span class="icon-arrow"></span></a>
					</div>
				</div>
			</div>
			<div class="col-3">
				<div class="post-item dark-blue">
					<div class="img-feature" style="background-image:url(<?php echo get_template_directory_uri()?>/assets/img/feature-img-02.jpg)">
					</div>
					<div class="content-item">
						<h3 class="heading"><span>JOURNOTIPS</span>unde omnis iste natus</h3>
						<div class="date">1 Sep 2015</div>
						<p>Fraudsec had a stellar month in August, we were on the road at various conferences with two of our partners in Perth.</p>
						<a href="" class="btn btn-default">read more <span class="icon-arrow"></span></a>
					</div>
				</div>
			</div>
		</div>.
	</section>
	<!-- END - widget-bottom =================================================================================== -->

<?php
get_footer();
