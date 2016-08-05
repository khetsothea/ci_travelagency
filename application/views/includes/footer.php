
    <div id="toTop" style="display: block;"><span class="glyphicon glyphicon-chevron-up"></span></div>

<hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <h3>
                        <p style="text-align:center;">Copyright &copy; MyTravelAgency</p>
                    </h3>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="<?=base_url();?>assets/js/jquery.js"></script>

    <script>
        $(document).ready(function($) { 
            $(window).scroll(function() {
                if($(this).scrollTop() != 0) {
                    $("#toTop").fadeIn();   
                } else {
                    $("#toTop").fadeOut();
                }
            });
            
            $("#toTop").click(function() {
                $("body,html").animate({scrollTop:0},800);
            });            
        });
    </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>

    <script src="<?=base_url();?>assets/js/scripts.js"></script>
</body>

</html>