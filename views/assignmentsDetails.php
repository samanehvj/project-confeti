	<div class="container col-12 col-lg-12" id="index">
		
			<div class="assignments col-12 col-lg-6">
		
				
				<!-- <a href="#"> WAS GIVING ERROR : nicole --> 
					<div class="assignment">
						<div class="row">
							<a href="index.php?controller=user&action=main&">Back to Dashboard</a>
							<h3><?=$this->oAssignment->name?></h3>
							<p>Due: <?=$this->oAssignment->due_date?></p>
							<h4>Description</h4>
							<p><?=$this->oAssignment->description?></p>
							<h4>Resources</h4>
							<p><?=$this->oAssignment->resources?></p>
							<p>Weight: <?=$this->oAssignment->weight?></p>
							<p>published on: <?=$this->oAssignment->publish_date?></p>	

						</div><!-- .title -->
					</div><!-- .assignment -->
				<!-- </a> -->
				
			</div><!-- .assignments -->

		</div><!-- .container -->
