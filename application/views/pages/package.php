<div class="container">
	<div class="jumbotron">
		<h2>Package</h2>
		<?php
			$sn = 1;
			$i = 0;
			foreach($packages as $package){
				$data[] = $package;
		?>
		<h3><?= $sn.". ".$data[$i]['title']; ?></h3>
		<hr>
		<div class="media">
			<p>
				<?php 
					$img_path = base_url().'uploads/package_image/'.$data[$i]['image'];
					if(!empty($data[$i]['image'])){
				?>
				<img src="<?=$img_path;?>" style="float:left;margin-right:10px;height:200px;width:50%;">
				<?php } ?>
				<h4><?=$data[$i]['description'];?></h4>
				<form action="<?=base_url();?>site/book_package" method="post">
					<input type="hidden" value="<?=$data[$i]['id'];?>" name="package_id">
					<button type="submit" class="btn btn-primary">
						Book package
					</button>
				</form>
			</p>
		</div>
		<?php $i++; $sn++; } ?>
		<h2>
			<a href="<?=base_url()?>site/packages">See all packages</a>
		</h2>
		
	</div>
</div>
