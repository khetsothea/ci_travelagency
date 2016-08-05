<div id="slider" class="carousel slide" data-ride="carousel">

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <?php
            $i = 0;
            $sn = 1;
            //$slider_sql = 'SELECT * FROM `packages` where image != \'\' order by id desc'; 
            foreach($slider as $value){
                $img_data[] = $value;
        ?>
        <div class="item <?php if($sn==1){echo 'active';}?>">
            <img src="<?=base_url()?>uploads/package_image/<?=$img_data[$i]['image']?>" alt="Slider image" style="width:100%;height:600px;">
            <div class="carousel-caption">
                <div >
                    <h2>
                        <a href="<?=base_url();?>view_single/<?=$img_data[$i]['id'];?>"  style="background:black;opacity:0.9">
                            <?=$img_data[$i]['title'];?>
                        </a>
                    </h2>
                    <h3 style="background:black;opacity:0.6;overflow:hidden;">
                        <?=$img_data[$i]['description'];?>
                    </h3>
                </div>
            </div>
        </div>
        <?php $sn++;$i++;} ?>
    </div>
</div>

<!-- Page Content -->
<div class="container">

<div class="row">
    <div class="col-lg-10">
        <h2 class="sub-heading">
            Our major attractions
            <hr>
        </h2>
    </div>
    <?php 
        foreach($package as $data){

    ?>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><i class="fa fa-fw fa-check"></i> <?=$data['title'];?></h4>
            </div>
            <div class="panel-body">
            <img class="img img-responsive" src="<?=base_url()?>uploads/package_image/<?=$data['image'];?>" style="height:200px;width:100%">
                <br>
                <h4>Package description:</h4>
                <hr>
                <p><?=substr($data['description'], 0,100);?></p>
                <form action="<?=base_url();?>package" method="post">
                    <input type="hidden" name="package_id" value="<?=$data['id'];?>">
                    <input type="submit" class="btn btn-info" name="btnSubmit" value="Learn More">
                </form>
                
            </div>
        </div>
    </div>
    <?php } ?>
    
<!-- /.row -->

<!-- Portfolio Section -->
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">Other major attractions</h2>
    </div>
    <?php
        $i = 0;
        $sn = 1;
        $slider_sql = 'SELECT * FROM `packages` where image != \'\' order by id desc'; 
        foreach($slider as $value){
            $img_data[] = $value;
    ?>
    <div class="col-md-4">
        <a href="<?=base_url();?>site/portfolio">
            <img class="img-responsive img-portfolio img-hover" src="<?=base_url()?>uploads/package_image/<?=$img_data[$i]['image'];?>" alt="" style="height:200px;width:100%;">
        </a>
    </div>
    <?php $sn++; $i++;} ?>
</div>
<!-- /.row -->

<!-- Features Section -->
<div class="row">
    <div class="col-lg-12">
        <h2 class="page-header">This Site Features</h2>
    </div>
    <div class="col-md-6">
        <p>MyTravel Agency includes:</p>
        <ul>
            <li><strong>Attractive tour packages</strong>
            </li>
            <li>Reasonable price</li>
            <li>Many facilities</li>
            <li>Your custom package</li>
            <li>Your queries</li>
            <li>Blogs</li>
        </ul>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, omnis doloremque non cum id reprehenderit, quisquam totam aspernatur tempora minima unde aliquid ea culpa sunt. Reiciendis quia dolorum ducimus unde.</p>
    </div>
    <div class="col-md-6">
        <img class="img-responsive" src="<?=base_url()?>img/new/6.jpg" alt="Awesome image">
    </div>
</div>
<!-- /.row -->