<?php 

if($this->session->flashdata('msg')){
	echo "<div class=\"container\"><h2>";
	echo $this->session->flashdata('msg');
	echo "</div></h2>";
}
else{
	redirect('book_package');
}

