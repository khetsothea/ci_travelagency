<div class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pricing Table
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="index.php">Home</a>
                </li>
                <li class="active">Pricing Table</li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
</div>

    <!-- Content Row -->
    <?php 
        foreach ($pricing as $data) {  
    ?>
<div class="container">
    <div class="row">
        <div class="col-md-4 pull-left" style="display:inline;">
            <div class="panel panel-primary text-center">
                <div class="panel-heading">
                    <h3 class="panel-title panel-primary"><?=$data['title'];?></h3>
                </div>
                <div class="panel-body">
                    <span class="price"><sup>Rs.</sup><?=$data['price']-1;?><sup>99</sup></span>
                    <span class="period">for <?=$data['days']?> days tour</span>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><strong><?=$data['persons']?></strong> persons</li>
                    <li class="list-group-item"><strong>5</strong> locations</li>
                    <li class="list-group-item" style="height:80px;"><?=$data['facilities']?></li>
                    <li class="list-group-item">
                    <form action="<?=base_url();?>book_package" method="post">
                        <input type="hidden" value="<?=$data['id'];?>" name="package_id">
                        <button type="submit" class="btn btn-primary">
                            Order now
                        </button>
                    </form>
                    </li>
                </ul>
            </div>
        </div>   
         <?php } ?>
    </div>
</div>

<!-- /.row -->