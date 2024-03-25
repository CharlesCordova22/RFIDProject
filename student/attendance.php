<html>
    <head>
        <script type="text/javascript" src="../node_modules/jquery/dist/jquery.min.js"></script>
        <script>
			$(document).ready(function(){
				 $("#getUID").load("UIDContainer.php");
				setInterval(function() {
					$("#getUID").load("UIDContainer.php");
				}, 500);
			});
		</script>
    </head>
    <body>
    <p id="getUID"></p>
    </body>
</html>