<div class="header col-12 col-lg-12">
	<div class="burgerMenu">
		<input type="checkbox" class="checkBox">

		<div class="bars">
			<i class="fas fa-bars"></i>
		</div>

		<div id="flyoutMenu">
		<?php
			$arrMenu = array(
				array('menu'=>'Home', 'link'=>'index.php'),
				array('menu'=>'Assignments', 'link'=>'assignments.php'),
				array('menu'=>'Grades', 'link'=>'grades.php')
			);
			foreach ($arrMenu as $key => $nav) {
		?>
			<a href="<?=$nav["link"]?>"><?=$nav["menu"]?></a>
		<?php
			}
		?>
		</div><!-- #flyout menu -->
	</div><!-- .burger menu -->


	<div class="logo">
		<a href="index.php"><h1>HandsUp</h1></a>
	</div><!-- .logo -->

	<nav>
	<?php
		foreach ($arrMenu as $key => $nav) {
	?>
		<a href="<?=$nav["link"]?>"><?=$nav["menu"]?></a>
	<?php
		}
	?>
	</nav><!--  nav -->

	<div class="info">
		<i class="fas fa-bell"></i>
		<div class="student">
			<h2>Student Name</h2>
			<p>Student ID: 12345</p>
		</div><!-- .student -->
	</div><!-- .info -->
	
</div><!-- .header -->

