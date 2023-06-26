<div class="assignmentList col-12 col-lg-6" >
<div class="assignments">
	<?php	
	foreach ($this->oAssignment as $assignment)
	{
	?>
	<a href="index.php?controller=assignments&action=detailsSA&aId=<?=$assignment->id?>">
		<div class="assignment">
			<div class="row">
				<h3><?=$assignment->name?></h3>
				<p><?=$assignment->publish_date?></p>
			</div><!-- .title -->
			<i class="fas fa-chevron-circle-right"></i>
		</div><!-- .assignment -->
	</a>
	<?php
		}
	?>
</div><!-- .assignments -->
	</div><!-- end of assignmentList -->