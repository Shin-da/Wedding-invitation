<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>You are Invited</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link href="css/styles.css" rel="stylesheet" />
  <link href='https://fonts.googleapis.com/css?family=Dancing Script&effect=emboss' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      animation: fadeInAnimation ease 3s;
      animation-iteration-count: 1;
      animation-fill-mode: forwards;
    }

    @keyframes fadeInAnimation {
      0% {
        opacity: 0;
      }

      100% {
        opacity: 1;
      }
    }
  </style>

</head>

<body class="fadeOut">
<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $dbname = "wedding";
  $conn = new mysqli($hostname, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT * FROM attendees";
  $result = $conn->query($sql);

  if ($result === false) {
    die("Query execution failed: " . $conn->error);
  }
  ?>
  <!-- BACKGROUND MUSIC -->
  <!-- <audio src="buttercup.mp3" autoplay loop></audio> -->

  <nav class="navbar navbar-expand-lg navbar fixed-top" id="mainNav">
    <div class="container px-4 px-lg-5">

      <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link " href="index.html">Our Story</a></li>
          <li class="nav-item"><a class="nav-link " href="index2.html">Guest List</a></li>
          <li class="nav-item"><a class="nav-link " href="details.html">Wedding Details</a></li>
          <li class="nav-item"><a class="nav-link "> RSVP</a></li>
          <li class="nav-item"><a class="nav-link " href="attendees.php"> Attendees</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid welcome" id="entourage">
    <div class="container" style="background-color:#af8d6b; margin-top:1vh;">
      <div class="container">
        <h1 class="name" style="font-size: 4vw;">You are Invited</h1>
        <input class="form-control" id="myInput" type="text" placeholder="Search for your name..">
        <br>
      </div>
      <script>
        $(document).ready(function() {
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tbody tr").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
      </script>

      <table id="myTable" class="table table-bordered">
        <thead>
          <tr>
            <th>Name</th>
            <th>Coming</th>
            <th>Not Coming</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<form class='form' action='update.php' method='POST'>
                    <tr>
                      <td>" . $row["name"] . "</td>
                      <input type='hidden' name='id' value='" . $row["id"] . "'>
                      <td><input type='radio' name='action' value='Coming'></td>
                      <td><input type='radio' name='action' value='Not Coming'></td>
                      <td><input class='btn btn-primary' type='submit' value='Submit'></td>
                    </tr>
                    </form>";
            }
          } else {
            echo "0 results";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="container-fluid Head"  style="background-image:url('ABC01003.JPG')">
      <div class="overlay container-fluid"></div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/scripts.js"></script>
</body>


</html>