<div class="container">
	<h2><u><?=$package[0]['title'];?></u></h2>
	<img src="<?=base_url();?>uploads/package_image/<?=$package[0]['image'];?>"  style="width:100%;height:300px;">
	<h3>
		<?=$package[0]['description'];?>
	</h3>
	<h4>
		<a href="<?=base_url()?>site">Go to home page</a>
		<br>
		<a href="<?=base_url()?>site/packages">View all packages</a>
	</h4>
	
</div>