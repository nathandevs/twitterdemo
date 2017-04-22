<!DOCTYPE html>
<html>
<head>
	<title>TwitterAPI</title>

	<!-- jquery library -->
	<script type="text/javascript" src="lib/jquery/jquery.min.js"></script>

	<script src="https://cdn.plot.ly/plotly-latest.min.js"></script>

	<!-- styles -->
	<style type="text/css">
		body{background-color: #F5F5F5;}
		#wrapper{width:900px; margin: 0 auto; font-family: arial;}
		form{width: 280px; margin: 0 auto;}
		h3{text-align: center;}
		input{width: 150px; border-radius: 3px; border: 1px solid #ddd; padding: 6px 10px; display: inline-block;}
		button{background-color: #05C3AF; box-shadow: none; border: 1px solid #ddd; border-radius: 5px; padding: 5px 15px; display: inline-block; color: #e1e1e1;}
		.loading{text-align: center;  font-size: 14px; display: none; color: #C32005;}
		#tweetResult{ margin-top: 33px;}
	</style>

	

</head>
<body>
	<div id="wrapper">
		<form method="post" action="">
			<h3>Twitter Demo</h3>
			<input type="text" name="username" placeholder="Username" />
			<button type="button" class="btn btn-info">Submit</button>
		</form>
		<div class="loading">LOADING. . .</div>
		<div id="tweetResult">
			
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
		
		$(document).ready(function(){
			$('form').submit(function(){return false;})

			$('body').on('click','button',function(){
				twitterUsername = $('input').val();
				

				if(twitterUsername == ""){
					alert('Please enter twitter username');
					return false;
				}

				$('.loading').fadeIn(100);
				$.ajax({
					type: 'POST',
					url: 'twitterConfig.php',
					data: {twitterUsername, twitterUsername},
					dataType: 'json',
					success: function(rs){
						$('.loading').fadeOut(100);
					
						// plotly js library
						// sample only out of time
						// var x = [];
						// for (var i = 0; i < rs.count ; i ++) {
						//     x[i] = Math.random();
						// }
						x = rs.timestamp;
						var data = [
						  {
						    x: x,
						    type: 'histogram',
						      marker: {
						    color: 'rgba(100,250,100,0.7)',
						    },
						  }
						];
						var layout = {
							  bargap: 0.05, 
							  bargroupgap: 0.2, 
							  barmode: "overlay", 
							  title: "Sampled Results", 
							  yaxis: {title: "# of tweets"}, 
							  xaxis: {title: "Time (24 hrs format)"}
							};
						Plotly.newPlot('tweetResult', data, layout);
						
					}
				});
			});

		});	
	</script>