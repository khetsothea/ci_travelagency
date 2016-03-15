<div class="container-fluid">
      
      <div class="row row-offcanvas row-offcanvas-left">
        
         <div class="col-sm-3 col-md-2 sidebar-offcanvas" id="sidebar" role="navigation">
          <br>
            <ul class="nav nav-sidebar">
              <!-- <li>
                <form  action="<?=base_url()?>admin/search_pro">
                  <label for="category" style="margin-left:25%;">Search category:</label>
                  <br>
                  <select name="category" id="category"  style="width:50%;margin-left:25%;">
                    <option value="">---</option>
                    <option value="users">users</option>
                    <option value="packages">packages</option>
                  </select>
                  <input type="text" name = "searchtxt" placeholder="Search..." style="width:70%;margin-left:5%;">
                  <button type="submit" class="btn btn-primary">
                  <i class="glyphicon glyphicon-search"></i>
                  </button>
                </form>
              </li> -->
              <li><a href="<?=base_url()?>admin">Dashboard</a></li>
              <li><a href="<?=base_url()?>action/pricing_table">Pricing table</a></li>
              <li><a href="<?=base_url()?>action/add_pricing">Add pricing table</a></li>
              <li><a href="<?=base_url()?>action/requested_packages">Requested packages</a></li>
              <li><a href="<?=base_url()?>action/booked_packages">Booked packages</a></li>
              <li><a href="<?=base_url()?>action/package_list">All packages</a></li>
              <li><a href="<?=base_url()?>action/add_package">Add Package</a></li>
            <?php if($this->session->userdata('usertype')=="admin"){ ?>
              <li><a href="<?=base_url()?>admin/manage_users">Manage users</a></li>
              <li><a href="<?=base_url()?>admin/add_user">Add user</a></li>
              <li><a href="<?=base_url()?>admin/add_admin">Add admin</a></li>
            <?php } ?>
              </ul>
          
        </div><!--/span-->
      <div class="col-sm-9 col-md-10 main">          
          <!--toggle sidebar button-->
          <span class="visible-xs" style="display:inline;">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas"><i class="glyphicon glyphicon-chevron-left"></i></button>
          </span>
         