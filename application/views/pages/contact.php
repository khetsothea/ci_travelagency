<!-- Page Content -->
<div class="container">

<!-- Page Heading/Breadcrumbs -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Contact
            <small>--your queries</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php">Home</a>
            </li>
            <li class="active">Contact</li>
        </ol>
    </div>
</div>
<!-- /.row -->

<!-- Content Row -->
<div class="row">
    <!-- Map Column -->
    <div class="col-md-8">
        <img src="<?=base_url();?>img/contact.jpg" alt="contact image" style="height:100%;width:100%;">
    </div>
    <!-- Contact Details Column -->
    <div class="col-md-4">
        <br>
        <h3>Contact Details</h3>
        <p>
            0036 Koteshwor<br>Kathmandu, Nepal<br>
        </p>
        <p><i class="fa fa-phone"></i> 
            <abbr title="Phone">P</abbr>: (+977) 9840070036</p>
        <p><i class="fa fa-envelope-o"></i> 
            <abbr title="Email">E</abbr>: <a href="mailto:name@example.com">mandip810@gmail.com</a>
        </p>
        <p><i class="fa fa-clock-o"></i> 
            <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM</p>
        <ul class="list-unstyled list-inline list-social-icons">
            <li>
                <a href="https://facebook.com/memandip"><i class="fa fa-facebook-square fa-2x"></i></a>
            </li>
            <li>
                <a href="https://linked.com/mandipthr"><i class="fa fa-linkedin-square fa-2x"></i></a>
            </li>
            <li>
                <a href="https://twitter.com/tharumandip"><i class="fa fa-twitter-square fa-2x"></i></a>
            </li>
            <li>
                <a href="https://plus.google.com/tharumandip"><i class="fa fa-google-plus-square fa-2x"></i></a>
            </li>
        </ul>
    </div>
</div>
<!-- /.row -->

<!-- Contact Form -->
<div class="row">
    <div class="col-md-8">
        <h3>Send us a Message <sup style="font-size:14px;">*All fields are strictly required</sup></h3>
        <form action="" method="post">
            <!-- For success/fail messages -->
            <div><h3 style="color:red;"><?=$this->session->flashdata('err_success');?></h3></div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>Full Name:</label>
                    <input type="text" name="name" placeholder="Your full name" class="form form-control" value="<?=set_value('name')?>">
                    <?php if(form_error('name')){ ?>
                        <?=form_error('name','<p class="text-danger">')?>
                    <?php } ?>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>Phone Number:</label>
                    <input type="text" name="phone" placeholder="Phone number" class="form form-control" value="<?=set_value('phone')?>">
                     <?php if(form_error('phone')){ ?>
                        <?=form_error('phone','<p class="text-danger">')?>
                    <?php } ?>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>Email Address:</label>
                    <input type="email" name="email" placeholder="Your email address" class="form form-control" value="<?=set_value('email')?>">
                     <?php if(form_error('email')){ ?>
                        <?=form_error('email','<p class="text-danger">')?>
                    <?php } ?>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>Message:</label>
                    <textarea class="form form-control" rows="10" placeholder="Enter your message here" name="message"><?=set_value('message')?></textarea>   
                     <?php if(form_error('message')){ ?>
                        <?=form_error('message','<p class="text-danger">')?>
                    <?php } ?> 
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>

</div>
<!-- /.row -->
<script src="<?=base_url();?>assets/js/jqBootstrapValidation.js"></script>
<script src="<?=base_url();?>assets/js/contact_me.js"></script>