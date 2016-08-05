<!-- Page Content -->
<div class="container">

<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Portfolio Item
            <small>Subheading</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=base_url();?>index.php">Home</a>
            </li>
            <li class="active">Portfolio Item</li>
        </ol>
    </div>
</div>
<!-- /.row -->

<!-- Portfolio Item Row -->
<div class="row">

    <div class="col-md-8">
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
            <?php
            $i = 0;
            $sn = 1;
            foreach($slider as $value){
                $img_data[] = $value;
            ?>
                <li data-target="#carousel-example-generic" data-slide-to=<?=$i;?> class="active"></li>
            <?php $i++; $sn++; } ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
            <?php
            $i = 0;
            $sn = 1;
            foreach($slider as $value){
                $img_data[] = $value;
            ?>
                <div class="<?php if($sn==1){echo "item active";}else{echo "item";}?>">
                    <img class="img-responsive"style="width:100%;height:400px;" src="<?=base_url();?>uploads/package_image/<?=$img_data[$i]['image'];?>" alt="Other major attractions">
                </div>
            <?php $sn++; $i++;} ?>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <h3>Tour lists</h3>
        <?php
            $i = 0;
            $sn = 1;
            foreach($slider as $value){
                $img_data[] = $value;
        ?>
        <li><a href="<?=base_url();?>view_single/<?=$img_data[$i]['id'];?>"><?=$img_data[$i]['title'];?></a></li>
        <?php $i++; $sn++; } ?>


</div>
<!-- /.row -->

<!-- Related Projects Row -->
<div class="row">

    <div class="col-lg-12">
        <h3 class="page-header">Other related travels</h3>
    </div>
    <?php
        $i = 0;
        $sn = 1;
        foreach($slider as $value){
            $img_data[] = $value;
    ?>
    <div class="col-sm-2">
        <a href="<?=base_url();?>view_single/<?=$img_data[$i]['id'];?>">
            <img class="img-responsive img-hover img-related" src="<?=base_url();?>uploads/package_image/<?=$img_data[$i]['image'];?>" style="width:100%;height:100px;" alt="">
        </a>
    </div>
    <?php $i++; $sn++; } ?>
</div>
<!-- /.row -->
<script>
$('.carousel').carousel({
    interval: 2000 //changes the speed
})
</script>