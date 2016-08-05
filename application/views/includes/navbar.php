<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
        <span>
          <img src="<?=base_url();?>img/logo2.png" style="height:35px;width:35px;">
        </span>
      </button>
      <a class="navbar-brand" href="<?=base_url()?>site/index"><img src="<?=base_url();?>img/logo2.png" style="height:30px;display:inline;"> MyTravel Agency</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="mynav">
      <ul class="nav navbar-nav">        
        <ul class="nav navbar-nav navbar-right">
          <li class="<?php if($this->uri->segment(2)=="about"){echo "active";}?>">
                        <a href="<?=base_url();?>about">About</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="services"){echo "active";}?>">
                        <a href="<?=base_url();?>services">Services</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="contact"){echo "active";}?>">
                        <a href="<?=base_url();?>contact">Contact</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="blogs"){echo "active";}?>">
                        <a href="<?=base_url();?>blogs">Blogs</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2)=="portfolio"){echo "active";}?>">
                        <a href="<?=base_url();?>portfolio">Portfolio</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Pages <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?=base_url();?>full_width">Full Width Page</a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>sidebar">Sidebar Page</a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>faq">FAQ</a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>errors">Errors</a>
                            </li>
                            <li>
                                <a href="<?=base_url();?>pricing">Pricing Table</a>
                            </li>
                        </ul>
                    </li>
        </ul>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>