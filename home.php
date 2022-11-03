<?php
ob_start();
session_start();
include("db_config.php");
if (!$_SESSION["username"]){
header('Location:login.php?msg=1');
}
ini_set('display_errors', 1);
?>

<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
  font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}

/* Style the close button */
.topright {
  float: right;
  cursor: pointer;
  font-size: 28px;
}

.topright:hover {color: red;}
</style>

<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Home Page</title>

    <link href="css/htmlstyles.css" rel="stylesheet">
	</head>

  <body>
  <div class="container-narrow">

		<div class="jumbotron">
			<p class="lead" style="color:white">
				Welcome <?php echo $_SESSION["username"]; ?>, You are now logged in!</a>
			</p>
        </div>

        <div class="tab">
          <button class="tablinks" onclick="openCity(event, 'London')" >Home</button>
          <button class="tablinks" onclick="openCity(event, 'Paris')">Ahli</button>
          <button class="tablinks" onclick="openCity(event, 'Tokyo')">Nasihat</button>
          <button class="tablinks" onclick="openCity(event, 'Upload')">Upload Image</button>
          <button class="tablinks" onclick="openCity(event, 'Logout')">Logout</button>
        </div>

        <div id="London" class="tabcontent">
          <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
          <p>Persatuan Orang-Orang Baik (POOB) ini ditubuhkan pada Oktober 2022. Terima kasih atas sumbangan anda kepada persatuan ini</p>
          <iframe width="100%" height="315" src="https://www.youtube.com/embed/hm1WBEpsF6g" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <br><br>
          <iframe src="https://www.astroawani.com/" height="100%" width="100%"></iframe>

        </div>

        <div id="Paris" class="tabcontent">
          <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
          <h3>Senarai Ahli Aktif</h3>
          <div class="vulnerable_code_area">
		<form  method="GET">
			<p>
				ID:
				<input type="text" size="15" name="id">
				<input type="submit" name="Submit" value="Cari">
			</p>

      <?php
      include("db_config.php");
      if( isset( $_REQUEST[ 'Submit' ] ) ) {
      // Get input
      $id = $_REQUEST[ 'id' ];

      // Check database
      $query  = "SELECT username, description FROM users WHERE id = '$id';";

      if (!mysqli_query($con,$query))
      {
        die('Error: ' . mysqli_error($con));
      }
      $result = mysqli_query($con,$query );

      // Get results
      while( $row = mysqli_fetch_assoc( $result ) ) {
        // Get values
        $first = $row["username"];
        $last  = $row["description"];

        // Feedback for end user
        echo "<pre>ID: {$id}<br />Username: {$first}<br />Description: {$last}</pre>";
      }
      }

      ?>
    </div>

		</form>
        </div>

        <div id="Tokyo" class="tabcontent">
          <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
          <form name="XSS" action="#" method="GET">
    			<p>
    				Nasihat untuk saya ?
    				<input type="text" name="name">
    				<input type="submit" value="Hantar">
    			</p>

          <?php
          header ("X-XSS-Protection: 0");
          // Is there any input?
          if( array_key_exists( "name", $_GET ) && $_GET[ 'name' ] != NULL ) {
              // Feedback for end user
              echo '<pre>Selamat datang ' . $_GET[ 'name' ] . '</pre>';
          }
          ?>
    		  </form>

        </div>


    <div id="Upload" class="tabcontent">
      <form action="upload.php" method="post" enctype="multipart/form-data">
  Kongsikan foto-foto nasihat:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
    </div>

    <div id="Logout" class="tabcontent">
      <h3><a href="logout.php">Logout</h3></p>
    </div>




    <script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    </script>


	  <div class="footer">
		<p><h5><a>Developed by @d4rkpack3t</a><h5> </p>
      </div>


	</div> <!-- /container -->

</body>
</html>
