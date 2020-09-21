<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/icon">
		<title>Home - NASA</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<?php
			$json=json_decode(file_get_contents('json/latest.json'),true);
			$small_news=$json['news'];
			$events=$json['events'];
			$mission=$json['mission'];
			unset($json);
		?>
	</head>
	<body>
		<div id="navbar">
			<div id="left">
				<a href="index.html">
					<img src="img/logo/nasa-logo.svg" alt="Nasa Logo"/>
				</a>
			</div>
			<div class="fill-parent">
				<div id="up">
					<div class="dropdown">
						<input type="button" class="flat nav-dropdown text-white" value="Missions" />
						<div class="dropdown-content text-left text-white">
							<a class="text-white" href="#">Link 1</a>
							<a class="text-white" href="#">Link 2</a>
							<a class="text-white" href="#">Link 3</a>
						</div>
					</div>
					<div class="dropdown">
						<input type="button" class="flat nav-dropdown  text-white" value="Galleries" />
						<div class="dropdown-content text-left">
							<a class="text-white" href="#">Link 1</a>
							<a class="text-white" href="#">Link 2</a>
							<a class="text-white" href="#">Link 3</a>
						</div>
					</div>
					<input type="button" class="flat nav-dropdown  text-white" value="NASA TV" />
					<div class="dropdown">
						<input type="button" class="flat nav-dropdown text-white" value="Follow NASA" />
						<div class="dropdown-content text-left">
							<a class="text-white" href="#">Link 1</a>
							<a class="text-white" href="#">Link 2</a>
							<a class="text-white" href="#">Link 3</a>
						</div>
					</div>
					<div class="dropdown">
						<input type="button" class="flat nav-dropdown text-white" value="Downloads" />
						<div class="dropdown-content text-left">
							<a class="text-white" href="#">Link 1</a>
							<a class="text-white" href="#">Link 2</a>
							<a class="text-white" href="#">Link 3</a>
						</div>
					</div>
					<div class="dropdown">
						<input type="button" class="flat nav-dropdown  text-white" value="About" />
						<div class="dropdown-content text-left">
							<a class="text-white" href="#">Link 1</a>
							<a class="text-white" href="#">Link 2</a>
							<a class="text-white" href="#">Link 3</a>
						</div>
					</div>
					<div class="dropdown">
						<input type="button" class="flat nav-dropdown  text-white no-right-bar" value="NASA Audiences" />
						<div class="dropdown-content text-left">
							<a class="text-white" href="#">Link 1</a>
							<a class="text-white" href="#">Link 2</a>
							<a class="text-white" href="#">Link 3</a>
						</div>
					</div>
					<form method="get" action="#">
						<input type="text" id="search" class="flat text-white" placeholder="Search" />
						<input type="image" src="img/icon/search.svg" alt="Submit" />
					</form>
					<input type="image" src="img/icon/share.svg" alt="Share" />
				</div>
				<div id="down">
					<div id="gray-back">
					<input type="button" class="flat nav-btn text-white" value="International Space Station" />
					<input type="button" class="flat nav-btn text-white" value="Journey to Mars" />
					<input type="button" class="flat nav-btn text-white" value="Earth" />
					<input type="button" class="flat nav-btn text-white" value="Technology" />
					<input type="button" class="flat nav-btn text-white" value="Aereonautics" />
					<input type="button" class="flat nav-btn text-white" value="Solar System and Beyond" />
					<input type="button" class="flat nav-btn text-white" value="Education" />
					<input type="button" class="flat nav-btn text-white" value="History" />
					<input type="button" class="flat nav-btn text-white" value="Benefits to You" />
					</div>
				</div>
			</div>
		</div>
		<div role="content">
			<div class="row" id="top-news">
			</div>
			<div class="row">
				<div class="default-column column font-10 text-left text-white" id="events">
					<p>NASA Events</p>
					<p class="line-up line-down" id="events-content">
						<?php
							$content="";
							foreach($events as $elem){
								echo (empty($elem['action'])?"":$elem['action'])
										.(empty($elem['day'])?"":date('l, F j', strtotime($elem['day']))).
										": ".$elem['content']."<br />";
							}
						?>
					</p>
					<p>Calendar <span id="right-span">Launches and Landings</span></p>
				</div>
				<div style="background-image: url('<?=$small_news['imgurl']?>');" class="default-column column card-content img-container" id="img2">
					<h4 class="opacity-60 text-white top-zero bottom-zero column-four first" id="other-news-title">
						<?=$small_news['title']?>
					</h4>
					<p class="opacity-60 top-zero bottom-zero" id="other-news" >
						<?=$small_news['content']?>
					</p>
				</div>
				<div class="default-column column-two card-content img-container" style="background-image: url('<?=$mission['imgurl']?>')" id="img3">
					<div class="default-column column-two right-zero" id="arrow-div">
						<img src="img/arrow.png" alt="arrow" id="arrow" />
					</div>
					<div class="default-column column-two back-white top-zero bottom-zero right-zero left-zero" id="mission-container">
						<p class="text-blue top-zero" id="mission-title">
							<?=$mission['title']?>
						</p>
						<p id="mission-content">
						<?="<span class='text-blue'>".$mission['action']
								.date(' \o\n F j Y. ', strtotime($mission['date']))."</span>"
								.$mission['content'];
						?>
						</p>
						<p class="text-blue font-10" id="mission-links">
							<?php
								foreach($mission['links'] as $link){
									echo "<a href='".$link['url']."'>".$link['text']."</a><br />";
								}
							?>
						</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="default-column column img-container" id="img4"></div>
				<div class="default-column column-two img-container text-white" id="img5">
					<p class="top-zero bottom-zero">
						<span class="font-40"><big>Lorem</big></span><br />
						<span class="font-40">Ipsum</span><br />
						<span class="font-10">Fusce vulputate placerat sapien id pretium. Nam id mauris.</span>
					</p>
				</div>
				<div class="default-column column text-white" id="twitter">
					<h4>Tweets</h4>
					<div class="line-up text-left">
						<img src="img/profile_pic.jpg" alt="profile pic" id="twitter-prof-pic" />
						<b>Nickname</b><br/>
						<p class="font-10">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
							sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="row" role="footer">
			<div class="default-column column-four">
				<input type="button" class="flat text-white right-zero" value="Go To Admin Page" id="go-to-admin-btn"/>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" >
			var news=[],addedNews;
			<?php
				$news=str_replace(array("\r", "\n"),'',file_get_contents('json/News.json'));
				$news=str_replace("\"","\\\"",$news);
			?>
			news=$.parseJSON("<?=$news?>").news;
			createTopNews(0,true);
			addedNews="<?=$small_news['extended-content']?>";
		</script>
	</body>
</html>
