<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>School Management Software In Hyderabad | Pracha Edu</title> 	
	<link rel="icon" href="<?php echo base_url(); ?>assets/vendor/homepage/img/fav.png" >
	<meta name="description" content="Pracha Technologies Pvt. Ltd. offers prominent  school management software in Hyderabad. This is Secured, Comprehensive, Dynamic, Integrated and Smart School Management Software for effective control. ">
		<meta name="keywords" content="school management software in hyderabad, school management software, school management system in hyderabad, school management system, school management software india, school management software, School Management System, online school management system, school management, school software, Online school management software, school administration software, online school administration software, online school management, school software, school management software india, private school management software, school management software free, best school management software.">
	
    <!-- Font Awesome -->
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114861070-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-114861070-2');
</script>
	 <link href="<?php echo base_url(); ?>assets/vendor/homepage/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/homepage/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/homepage/css/bootstrapValidator.min.css" rel="stylesheet">
	
    <!-- Material Design Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/vendor/homepage/css/mdb.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/homepage/css/custom.css" rel="stylesheet">
	
    <!-- Your custom styles (optional) -->
    
   
	
    
	 <script type="text/javascript" src="<?php echo base_url(); ?>assets/vendor/homepage/js/jquery-3.2.1.min.js"></script>
</head>
<body>
<header class="header-fix">
<nav class="navbar navbar-expand-lg navbar-dark bg-indigo height-60 " >
		<div class="logo-style">
        <a class="navbar-brand "  href="#"><img src="<?php echo base_url(); ?>assets/vendor/homepage/img/logo.png" alt="logo"></a>
		</div>
       
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
		
		
        <div class="collapse navbar-collapse float-right " id="navbarSupportedContent">
            <ul id="menu_active" class="navbar-nav mr-auto pos-nav nav">
              
				<li class="nav-item active smooth-scroll">
                    <a class="nav-link" href="#intro">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item smooth-scroll">
                    <a class="nav-link" href="#about-us">About Us </a>
                </li>
               <!-- <li class="nav-item smooth-scroll">
                    <a class="nav-link">Feedback</a>
                </li>-->
                <li class="nav-item smooth-scroll">
                    <a class="nav-link" href="#contact-us">Contact us</a>
                </li>  
				<li class="nav-item">
                    <a target="_blank" class="nav-link" href="<?php echo base_url('home'); ?>">Login</a>
                </li>
            </ul>
           
        </div>
    </nav>

</header>
    
<script type="text/javascript">

function scrollNav() {
  $('.nav a').click(function(){  
    //Toggle Class
    $("li.active").removeClass("active");      
    $(this).closest('li').addClass("active");
//    var theClass = $(this).attr("class");
//    $('.'+theClass).parent('li').addClass('active');
    //Animate
    $('html, body').stop().animate({
        scrollTop: $( $(this).attr('href') ).offset().top - 160
    }, 400);
    return false;
  });
  $('.scrollTop a').scrollTop();
}
scrollNav();
  </script>

<script>
$(document).ready(function() {
		$('a[href="#"]').bind('click', function(e) {
		//$('a[href*=#]').bind('click', function(e) {
				e.preventDefault(); // prevent hard jump, the default behavior

				var target = $(this).attr("href"); // Set the target as variable

				// perform animated scrolling by getting top-position of target-element and set it as scroll target
				$('html, body').stop().animate({
						scrollTop: $(target).offset().top
				}, 100, function() {
						location.hash = target; //attach the hash (#jumptarget) to the pageurl
				});

				return false;
		});
});

$(window).scroll(function() {
		var scrollDistance = $(window).scrollTop();

		// Show/hide menu on scroll
		//if (scrollDistance >= 850) {
			//alert();
		//} else {
			//alert();
		//}
	
		// Assign active class to nav links while scolling
		$('#menu_active').each(function(i) {
				if ($(this).position().top <= scrollDistance) {
						//$('li nav-item ').removeClass('active');
						//$('li nav-item ').eq(i).addClass('active');
						console.log('hi');
				}else{
					console.log('hello');
				}
				
		});
}).scroll();
</script>
  