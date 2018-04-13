<head>
<title>E-Commerce aún no terminada</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Smart Bazaar Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Custom Theme files -->
<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('/css/plantilla/css/style.css')}}" rel="stylesheet" type="text/css" media="all" /> 
<link href="{{asset('/css/plantilla/css/menu.css')}}" rel="stylesheet" type="text/css" media="all" /> <!-- menu style --> 
<link href="{{asset('/css/plantilla/css/ken-burns.css')}}" rel="stylesheet" type="text/css" media="all" /> <!-- banner slider --> 
<link href="{{asset('/css/plantilla/css/animate.min.css')}}" rel="stylesheet" type="text/css" media="all" /> 
<link href="{{asset('/css/plantilla/css/owl.carousel.css')}}" rel="stylesheet" type="text/css" media="all"> <!-- carousel slider -->  
<!-- //Custom Theme files -->
<!-- font-awesome icons -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="{{asset('/js/plantilla/js/jquery-2.2.3.min.js')}}"></script> 
<!-- //js --> 
<!-- web-fonts -->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Lovers+Quarrel' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Offside' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Tangerine:400,700' rel='stylesheet' type='text/css'>
<!-- web-fonts --> 
<script src="{{asset('/js/plantilla/js/owl.carousel.js')}}"></script>  
<script>
$(document).ready(function() { 
	$("#owl-demo").owlCarousel({ 
	  autoPlay: 3000, //Set AutoPlay to 3 seconds 
	  items :4,
	  itemsDesktop : [640,5],
	  itemsDesktopSmall : [480,2],
	  navigation : true
 
	}); 
}); 
</script>
<script src="{{asset('/js/plantilla/js/jquery-scrolltofixed-min.js')}}" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        // Dock the header to the top of the window when scrolled past the banner. This is the default behaviour.

        $('.header-two').scrollToFixed();  
        // previous summary up the page.

        var summaries = $('.summary');
        summaries.each(function(i) {
            var summary = $(summaries[i]);
            var next = summaries[i + 1];

            summary.scrollToFixed({
                marginTop: $('.header-two').outerHeight(true) + 10, 
                zIndex: 999
            });
        });
    });
</script>
<!-- start-smooth-scrolling -->
<script type="text/javascript" src="{{asset('/js/plantilla/js/move-top.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/plantilla/js/easing.js')}}"></script>	
<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
			});
		});
</script>
<!-- //end-smooth-scrolling -->
<!-- smooth-scrolling-of-move-up -->
	<script type="text/javascript">
		$(document).ready(function() {
		
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->
<script src="{{asset('/js/plantilla/js/bootstrap.js')}}"></script>	
</head>