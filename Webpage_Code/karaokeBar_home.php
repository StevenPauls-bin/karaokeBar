<html>
    <head>
        <title>Group 3 | Karaoke Bar</title>
        <link rel="shortcut icon" href="https://seeklogo.com/images/N/niu-huskies-logo-7821F4963B-seeklogo.com.png"/>
        <link rel="apple-touch-icon" href="https://seeklogo.com/images/N/niu-huskies-logo-7821F4963B-seeklogo.com.png"/>
    </head>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap');
		@keyframes pulsate{
			100%{
			text-shadow:
				0 0 7px #97c0fc,
				0 0 10px #97c0fc,
				0 0 21px #97c0fc,
				0 0 42px #182ac7,
				0 0 82px #182ac7,
				0 0 92px #182ac7,
				0 0 102px #182ac7,
				0 0 151px #182ac7; 
				}
			0%{
			text-shadow:
				0 0 2px #97c0fc,
				0 0 3px #97c0fc,
				0 0 7px #97c0fc,
				0 0 18px #182ac7,
				0 0 37px #182ac7,
				0 0 43px #182ac7,
				0 0 47px #182ac7,
				0 0 78px #182ac7; 
				}}	
					
	 	h1 { text-align:center;
		     font-family: 'Tilt Neon',sans-serif;
                     font-optical-sizing:auto;
		     font-weight: 400; 
                     font-size: 50px;
                     font-style: normal;
                     font-variation-settings: 
                     	"XROT" 0,
                        "YROT" 0;
		     color: #fff;
                     text-shadow: 
                     	0 0 7px #bcefff,
                        0 0 10px #bcefff,
			0 0 21px #bcefff,
                        0 0 42px #182ac7,
                        0 0 82px #182ac7,
			0 0 92px #182ac7,
                        0 0 102px #182ac7,
			0 0 151px #182ac7; 
		     animation: pulsate 2.5s infinite alternate; animation-fill-mode:forwards;}

		fieldset {
            text-align: center; /* Align the content of the fieldset */
			margin: 0 auto; /* Center the fieldset horizontally */
            padding: 20px; /* Add some padding for better spacing */
            max-width: 500px; /* Limit the width of the fieldset */
			display: flex; /* Use flexbox */
            flex-wrap: wrap; /* Allow flex items to wrap to the next line */
            justify-content: space-between; /* Distribute items evenly between each other */
        }
		/* Base button styles */
        .neon-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            border: 2px solid #ff69b4; /* Neon pink border color */
            border-radius: 5px;
            color: #ff69b4; /* Neon pink text color */
            background-color: transparent;
            cursor: pointer;
            transition: color 0.3s, border-color 0.3s;
        }

        /* Hover effect */
        .neon-button:hover {
            color: #ffffff; /* White text color on hover */
            border-color: #ffffff; /* White border color on hover */
            box-shadow: 0 0 10px #ff69b4; /* Neon pink glow effect on hover */
        }
	</style>
    <body style="background-image:url('brick_wall_texture_192138_2560x1440.png')">
		<fieldset>
			<legend><h1><u>Group 3 | Karaoke Bar</u></h1></legend>
			<form action="./karaokeBar_signUp.php" method="POST">
				<div align="center">
					<button class="neon-button"">Sing Karaoke</button>
				</div>
			</form>
			<form action="./karaokeBar_djQueue.php" method="POST">
				<div align="center">
					<button class="neon-button"">Become the DJ</button>
				</div>
			</form>
		</fieldset>
    </body>
</html>
