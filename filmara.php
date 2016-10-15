<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Film Ara</title>
	<link rel="stylesheet" href="css/film.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.1.1.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
	<script>
		$(function(){
			$("li").css("height","100");
			$("h3#filmbaslik").mousemove(function(event) {
				var hangisi = $("h3#filmbaslik").index(this);
				$("li").eq(hangisi).css("height","400");
				$("div#ayrinti").eq(hangisi).show(100);
			});
			$("h3#filmbaslik").mouseout(function(event) {				
				var hangisi = $("h3#filmbaslik").index(this);
				$("li").eq(hangisi).css("height","100");
				$("div#ayrinti").eq(hangisi).hide(100);

			});
		});
	</script>
</head>
<body>

<?php 
		$odalar = file_get_contents('http://filmhafizasi.com/');
		$re = '/http:\/\/filmhafizasi.com\/category\/sinema-odalari\/(.*?)" class="menu-link sub-menu-link"><span>(.*?)<\/span>/is';
		preg_match_all($re, $odalar, $oda);
		$odam = $oda[1];
		$odambas = $oda[2];
 ?>
<form action="" method="post">
 <select class="form-control" name="odaismi" id="">
 <?php 
 	for ($i=1; $i < 15; $i++) { 
  ?>
 	<option value="<?php echo $odam[$i];?>"><?php echo $odambas[$i];?></option>
 	<?php } ?>
 </select>
 <input class="form-control" type="submit" value="Film Getir">
</form>






	<?php

if ($_POST) {
	$oda = $_POST['odaismi'];


		$site = file_get_contents('http://filmhafizasi.com/category/sinema-odalari/'.$oda);
		$re = '/<div class=\'at-above-post-cat-page addthis_default_style addthis_toolbox at-wordpress-hide\' data-title=\'(.*?)\' data-url=\'(.*?)\'><\/div>\s+<p>(.*?)<div class=\'at-below-post-cat-page addthis_default_style addthis_toolbox at-wordpress-hide\' data-title=\'(.*?)\' data-url=\'(.*?)\'><\/div>/is';
		$re2 = '/<div class="vw-post-box vw-post-box-style-left-thumbnail vw-post-box-classic clearfix">\s+<a class="vw-post-box-thumbnail" href="(.*?)" rel="bookmark"><img width="(.*?)" height="(.*?)" src="(.*?)"/is';
		preg_match_all($re, $site, $sonuc);
		preg_match_all($re2, $site, $resim);

		$filmismi = $sonuc[1];
		$filmlinki = $sonuc[2];
		$filmaciklama = $sonuc[3];
		$filmresmi = $resim[4];

		/*echo "<pre>";
		print_r($resim[4]); 
		echo "</pre>";*/
	 ?>
		<div id="ana" class="filmler">
			<ul>
			<?php 
				for ($i=0; $i < 6; $i++) { 

			 ?>
				<li>
					<h3 id="filmbaslik"><a href=''><?php echo $filmismi[$i]; ?></a></h3>
					<div style="display: none;" id="ayrinti">
						<img style="border-radius: 10px; margin: auto; text-align: center" width="150" src="<?php echo $filmresmi[$i]; ?>" alt="">
						<p><?php echo $filmaciklama[$i]; ?></p>
					</div>
				</li>	
				<?php }; ?>						
			</ul>
		</div>
<?php } ?>
</body>
</html>