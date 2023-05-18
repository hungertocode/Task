<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Concert Weekend</title>
	
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<link rel="stylesheet" href="/css/fontawesome-all.css">
	<link rel="stylesheet" href="/css/animate.css">
	<link rel="stylesheet" href="/css/odometer-theme-default.css">
	<link rel="stylesheet" href="/css/video.min.css">
	<link rel="stylesheet" href="/css/slick-theme.css">
	<link rel="stylesheet" href="/css/slick.css">
	<link rel="stylesheet" href="/css/global.css">
	<link rel="stylesheet" href="/css/style.css">

	<!-- Include Datepicker CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

</head>

<body class="ori-inner-page">
	<div id="preloader"></div>
	<div class="up">
		<a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
	</div>
	<div class="cursor"></div>


	<!-- Search PopUp -->
	<div class="search-popup">
		<button class="close-search style-two"><span class="fal fa-times"></span></button>
		<button class="close-search"><span class="fa fa-arrow-up"></span></button>
		<form method="post" action="blog.html">
			<div class="form-group">
				<input type="search" name="search-field" value="" placeholder="Search Here" required="">
				<button type="submit"><i class="fa fa-search"></i></button>
			</div>
		</form>
	</div>
	<!-- Sidebar sidebar Item -->
	<div class="xs-sidebar-group info-group">
		<div class="xs-overlay xs-bg-black">
			<div class="row loader-area">
				<div class="col-3 preloader-wrap">
					<div class="loader-bg"></div>
				</div>
				<div class="col-3 preloader-wrap">
					<div class="loader-bg"></div>
				</div>
				<div class="col-3 preloader-wrap">
					<div class="loader-bg"></div>
				</div>
				<div class="col-3 preloader-wrap">
					<div class="loader-bg"></div>
				</div>
			</div>
		</div>
		<div class="xs-sidebar-widget">
			<div class="sidebar-widget-container">
				<div class="widget-heading">
					<a href="#" class="close-side-widget">
						X
					</a>
				</div>
				<div class="sidebar-textwidget">

					<div class="sidebar-info-contents headline pera-content">
						<div class="content-inner">
							
							<div class="content-box">
								<h5>About Us</h5>
								<p class="text">The argument in favor of using filler text goes something like this: If you use real content in the Consulting Process, anytime you reach a review point you’ll end up reviewing and negotiating the content itself and not the design.</p>
							</div>
							
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- End of header section
	============================================= -->

<!-- Start of Breadcrumbs  section
	============================================= -->
	<section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative" >
		<div class="container">
			<a href="{{route('preview')}}">
			<div class="ori-breadcrumb-content text-center ul-li">
				<h1>Concert Weekend</h1>
				<ul>
					<li>Feel the beat and let it move you</li>
				</ul>
			</div>
			</a>
		</div>
		<div class="line_animation">
			<div class="line_area"></div>
			<div class="line_area"></div>
			<div class="line_area"></div>
			<div class="line_area"></div>
			<div class="line_area"></div>
			<div class="line_area"></div>
			<div class="line_area"></div>
			<div class="line_area"></div> 
		</div>
	</section>	
<!-- End of Breadcrumbs section
	============================================= -->

<!-- Start of Blog Feed section
	============================================= -->
	<section id="ori-blog-feed" class="ori-blog-feed-section position-relative">
		<div class="container">
			<div class="ori-blog-feed-content">
				<div class="row">
					<div class="col-lg-4">
						<div class="ori-blog-sidebar">
							<div class="ori-blog-widget">
								<div class="search-widget">
									<h3 class="widget-title">Search</h3>
									<form action="{{route('preview')}}">
										<input type="text" name="search" placeholder="Search by Event Name">
										<button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
									</form>
								</div>
							</div>
							<div class="ori-blog-widget">
								<div class="recent-post-widget">
									<h3 class="widget-title">Filter</h3>
									<div class="form-group">
										<label for="filter" class="form-label">Filter By</label>
										<select class="form-control bg-dark text-light" onchange="filter(this.value)" id="filter">
											<option value="artist">Artist</option>
											<option value="Genre">Genre</option>
											<option value="venue">Venue</option>
											<option value="date">Date</option>
										</select>
									</div>

									<div class="search-widget mt-3">
										<form action="{{route('preview')}}">
											<input type="text" name="search_artist" placeholder="Search by Artist Name" id="filter_option">
											<button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
										</form>
									</div>
									

								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="ori-blog-feed-post-content">
							<div class="ori-blog-feed-post-item-wrap">
							@if(count($events))
                                @foreach($events as $item)
								<div class="ori-blog-feed-item">
									<div class="ori-blog-img">
										<img src="{{$item->image}}" alt="">
									</div>
									<div class="ori-blog-text pera-content">
										<div  class="blog-meta text-uppercase">
											<a class="blog-cate"> {{$item->title??'-'}}</a>
											<br>
											<a class="blog-author"><i class="fa-solid fa-guitar"></i> {{$item->artist?ucfirst(strtolower($item->artist->artist_name)):'-'}}</a>
											<a class="blog-author"><i class="fa-solid fa-location-dot"></i> {{$item->venue?ucfirst(strtolower($item->venue->venue_name)):'-'}}</a>

											<a class="blog-author"><i class="fa-solid fa-music"></i> {{$item->genre?ucfirst(strtolower($item->genre->genre_name)):'-'}}</a>

											
											<a class="blog-date"><i class="fa-solid fa-calendar-days"></i> {{\Carbon\Carbon::parse($item->date)->format('d F Y')}}</a>
											<br>
											<a class="blog-date"><i class="fa-sharp fa-solid fa-money-bill"></i> ₹ {{$item->amount??'-'}}</a>


										</div>
										<h3>
										<p>{{$item->short_description??'-'}}</p>
										
									</div>
								</div>
                                @endforeach
							@else
								<div class="row">
									<h1 class=" text-center text-white">No results found</h3>
								</div>
							@endif


                         

							</div>
							<div>

							</div>

							<div class="ori-pagination-wrap ul-li">
								{{ $events->links('custom-pagination') }}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="line_animation">
			<div class="line_area"></div>
			<div class="line_area"></div>
			<div class="line_area"></div>
			<div class="line_area"></div>
			<div class="line_area"></div>
			<div class="line_area"></div>
			<div class="line_area"></div>
			<div class="line_area"></div> 
		</div>
	</section>
<!-- End of Blog Feed section
	============================================= -->	

<!-- Start of Footer section
	============================================= -->
	<footer id="ori-footer" class="ori-footer-section footer-style-one">
		<div class="container">
			<div class="ori-footer-title text-center text-uppercase">
				<h2>Get In <span>Touch</span> <i class="fas fa-arrow-right"></i></h2>
			</div>
			<div class="ori-footer-widget-wrapper">
				<div class="row justify-content-center">
					
					<div class="col-lg-3 col-md-6">
						<div class="ori-footer-widget">
							<div class="menu-location-widget ul-li-block">
								<h2 class="widget-title text-uppercase">Our Location</h2>
								<ul>
									<li><a href="#">Delhi</a></li>
									<li><a href="#">Banglore</a></li>
									<li><a href="#">Mumbai</a></li>
									
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6">
						<div class="ori-footer-widget">
							<div class="contact-widget ul-li-block">
								<h2 class="widget-title text-uppercase">Contact info</h2>
								<div class="contact-info">
									<span>Concert weekend </span>
									<span>(+250)155 69569 365</span>
									<a href="#">Xoxoxoxox</a>
									<span>Office Hours: 8AM - 11PM</span>
									<span>Sunday - Wekend Day</span>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="ori-footer-copyright d-flex justify-content-between">
				<div class="ori-copyright-text">
					© 2022 All Right Recived - Concert weekend
				</div>
				<div class="ori-copyright-social">
					<a href="#"><i class="fab fa-facebook-f"></i></a>
					<a href="#"><i class="fab fa-twitter"></i></a>
					<a href="#"><i class="fab fa-instagram"></i></a>
					<a href="#"><i class="fab fa-youtube"></i></a>
				</div>
			</div>
		</div>
	</footer>
<!-- End of Footer section
	============================================= -->		



	<!-- For Js Library -->
	<script src="/js/jquery.min.js"></script>
	<script src="/js/jquery-ui.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/popper.min.js"></script>
	<script src="/js/appear.js"></script>
	<script src="/js/slick.js"></script>
	<script src="/js/twin.js"></script>
	<script src="/js/wow.min.js"></script>
	<script src="/js/knob.js"></script>
	<script src="/js/jquery.filterizr.js"></script>
	<script src="/js/imagesloaded.pkgd.min.js"></script>
	<script src="/js/rbtools.min.js"></script>
	<script src="/js/rs6.min.js"></script>
	<script src="/js/jarallax.js"></script>
	<script src="/js/jquery.inputarrow.js"></script>
	<script src="/js/swiper.min.js"></script>
	<script src="/js/jquery.counterup.min.js"></script>
	<script src="/js/waypoints.min.js"></script>
	<script src="/js/jquery.magnific-popup.min.js"></script>
	<script src="/js/jquery.marquee.min.js"></script>
	<script src="/js/script.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script>

		$(document).ready(function(){
			$('input[name="search_date"]').datepicker();
		});

		function filter(value)
		{
			$('#filter_option').attr('value','');

			if(value==="artist")
			{
				setSearchInput("Search by Artist Name","search_artist")
			}
			if(value==="venue")
			{
				setSearchInput("Search by Venue Name","search_venue")
			}
			if(value==="genre")
			{
				setSearchInput("Search by Genre Name","search_genre")
			}
			if(value==="date")
			{
				setSearchInput("Search by date","search_date")
			}

		}

		function setSearchInput(placeholder,name)
		{
			if(name==="search_date")
			{
				$('#filter_option').attr('type','date')
			}
			else{
				$('#filter_option').attr('type','text')

			}

			$('#filter_option').attr('placeholder',placeholder)
			$('#filter_option').attr('name',name)
		}
	</script>
</body>
</html>				