<?php require_once('connect.php');
session_start();
$User_ID = $_SESSION['User_ID'];

?>
<!DOCTYPE html>
<html>

<head>
  <title>Leaving Status</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">
</head>

<body>
  <div class="py-5" style="background-color: #adc5d8;">
    <div class="container">
      <div class="row">
        <div class="col-md-12" style="background-color: #608fb7;">
          <h1 class="display-4 text-center" style="color: white;font-family: 'Segoe Print';"><img style="position: relative; left: 14px;" src="image/signal.png" width="50px" height="50px"> Leave Status </h1>
        </div>
      </div>
      <br>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive" style="color: #0c4876;font-family: 'Bahnschrift';font-size:18px;">
              <table class="table table-bordered " style="background-color: white;">
                <thead class="thead-dark">
                  <tr>
                    <th>Title</th>
                    <th>Reason</th>
                    <th>Date Start</th>
                    <th>Date End</th>
                    <th>Status</th>
                    <th>Emergency Leave</th>
                  </tr>
                </thead>
                <tbody style="color: #0c4876;font-family: 'Bahnschrift';font-size:16px;">

                  <?php

                  $q = "select * from leaving_form inner join user on leaving_form.user_id = user.user_id where user.user_id = $User_ID";

                  $result = $mysqli->query($q);
                  if (!$result) {
                    echo "Select failed. Error: " . $mysqli->error;
                    return false;
                  }
                  while ($row = $result->fetch_array()) { ?>
                    <?php if (!isset($row['Form_status'])) {
                      $row['Form_status'] = "Waiting";
                    } ?>
                    <tr>
                      <td><?= $row['Form_Title'] ?></td>
                      <td><?= $row['Form_detail'] ?></td>
                      <td><?= $row['Form_DateStart'] ?></td>
                      <td><?= $row['Form_DateEnd'] ?></td>
                      <td><?= $row['Form_status'] ?></td>

                      <td>

                      <?php
                      if ($row['Form_EL'] == 1)
                        echo "<input type='checkbox' CHECKED  disabled>";
                      else
                        echo "<input type='checkbox' disabled >";
                    } ?>

                      <?php $count = $result->num_rows;
                      echo "<tr><td colspan=7 align=right>Total $count records</td></tr>";
                      $result->free();
                      ?>
                </tbody>

              </table>
            </div>
          </div>

        </div>
        <div class="py-4">
          <div class="container">
            <div class="row">
              <div>
                <a href="requestleave_menu.html"><button class="btn btn-dark" style="color:white;font-family: 'Lucida Sans';font-size: 16px;">Back </button></a>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>