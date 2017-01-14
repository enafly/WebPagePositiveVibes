<?php
include('header.php');
?>
	<div class="row">
			<div id="glavni" class="col-12">
				<div class="col-2">
					<!--Nazad-->
					<button onclick="slike.prev();" >  &#8592; </button>
				</div>

				<div class="col-8">
					<!--<span class="carousel"> Jedna </span>-->
					<img class="carousel" id="img1" src="img/pic.jpg" alt="Stay positive!">
					<img class="carousel" id="img2" src="img/on.jpg" alt="Stay positive!">
					<img class="carousel" id="img3" src="img/cf.jpg" alt="Stay positive!">
					<img class="carousel" id="img4" src="img/wow.jpg" alt="Stay positive!">

					<script>
					var slike=new Carousel();
					</script>
				</div>
	<!--naprijed
	 	ili sa intervalom: <button onclick="numbers.next(1000);"> &#8594; </button>
	-->
	 			<div class="col-2">
					<button onclick="slike.next();"> &#8594; </button>
				</div>

			</div>
	</div>
	<?php
	include('footer.php');
	?>
