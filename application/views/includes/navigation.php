<!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
                    <img src="<?=base_url();?>img/logo2.png" style="height:30px;width:30px;">
                </button>
                <a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url();?>img/logo2.png" style="height:25px;width:40px;display:inline;"> MyTravel Agency</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="mynav">
                <ul class="nav navbar-nav nav-tabs nav-stacked navbar-right">
                    <?php $page = $this->uri->segment(1); ?>
                    <li class="<?php if($page=="index" or $page =="site" or $page=="index.php"){echo "active";}?>">
                        <a href="<?=base_url();?>index">Home</a>
                    </li>
                    <li class="<?php if($page=="about"){echo "active";}?>">
                        <a href="<?=base_url();?>about">About</a>
                    </li>
                    <!-- <li class="<?php if($page=="services"){echo "active";}?>">
                        <a href="<?=base_url();?>site/services">Services</a>
                    </li> -->
                    <li class="<?php if($page=="contact"){echo "active";}?>">
                        <a href="<?=base_url();?>contact">Contact</a>
                    </li>
                    <!-- <li class="<?php if($page=="blogs"){echo "active";}?>">
                        <a href="<?=base_url();?>site/blogs">Blogs</a>
                    </li> -->
                    <li class="<?php if($page=="portfolio"){echo "active";}?>">
                        <a href="<?=base_url();?>portfolio">Portfolio</a>
                    </li>
                    <li class="dropdown inverse">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Pages <b class="caret"></b></a>
                        <ul class="dropdown-menu nav navbar-default col-sm-4">
                            
                            <li>
                                <a href="<?=base_url();?>packages">Tour Packages</a>
                            </li>

                            <li>
                                <a href="<?=base_url();?>order_package">Order Tour Packages</a>
                            </li>

                            <li>
                                <a href="<?=base_url();?>pricing">Pricing Table</a>
                            </li>

                            <li>
                                <a href="<?=base_url();?>faq">FAQ</a>
                            </li> 
                            
                        </ul>
                    </li>
                    <!-- <li  class="<?php if($this->uri->segment(2)=="login_page"){echo "active";}?>">
                        <a href="<?=base_url();?>site/login_page">Sign In</a>
                    </li> -->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>