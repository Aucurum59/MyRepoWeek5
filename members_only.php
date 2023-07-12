<?php
session_start();

// Function to calculate the average marks
function calculateAverageMarks($marksArray) {
  $secondYearMarks = array_slice($marksArray, 0, 6);
  $thirdYearMarks = array_slice($marksArray, 6);

  $secondYearAverage = array_sum($secondYearMarks) / 6;

  $thirdYearTotal = array_sum($thirdYearMarks) + ($marksArray[9]);
  $thirdYearAverage = $thirdYearTotal / 6;

  $averageMarks = ($secondYearAverage * 0.3) + ($thirdYearAverage * 0.7);

  return round($averageMarks);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the marks entered by the user
  $marks = array(
    $_POST['module1'],
    $_POST['module2'],
    $_POST['module3'],
    $_POST['module4'],
    $_POST['module5'],
    $_POST['module6'],
    $_POST['module7'],
    $_POST['module8'],
    $_POST['module9'],
    $_POST['module10'],
    $_POST['module11']
  );

  // Calculate the average marks
  $averageMarks = calculateAverageMarks($marks);
}

// Generate random marks for each input box
if (!isset($_POST['module1'])) {
  $randomMarks = [];
  for ($i = 0; $i < 11; $i++) {
    $randomMarks[] = rand(0, 100);
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Members Only</title>
  <style>
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    h1 {
      text-align: center;
    }

    .table-container {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    table {
      border-collapse: collapse;
      width: 45%;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: yellow;
    }

    form {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 20px;
    }

    input[type="number"] {
      padding: 5px;
      width: 70px;
    }

    input[type="submit"] {
      padding: 5px 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }

    .result-text {
      font-size: 30px;
      margin-bottom: 60px;
      animation: flashText 1s infinite;
      background-color: yellow;
       
    }

    .pass-animation {
      color: green;
      animation-name: flashPassText;
    }

    .fail-animation {
      color: red;
      animation-name: flashFailText;
    }

    @keyframes flashText {
      0% {
        opacity: 1;
      }
      50% {
        opacity: 0;
      }
      100% {
        opacity: 1;
      }
    }

    @keyframes flashPassText {
      0% {
        color: green;
      }
      50% {
        color: yellow;
      }
      100% {
        color: green;
      }
    }

    @keyframes flashFailText {
      0% {
        color: red;
      }
      50% {
        color: yellow;
      }
      100% {
        color: red;
      }
    }
  </style>
</head>
<body>
  <h1>Members Only</h1>

  <?php
  // check session variable
  if (isset($_SESSION['valid_user']))
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if ($averageMarks > 0 && $averageMarks < 40)  {
        echo '<p class="result-text fail-animation">Sorry '.$_SESSION['valid_user'].', you failed.</p>';
        echo '<p class="result-text">Your Average Mark is: '.$averageMarks.'</p>';
      } 
      elseif ($averageMarks >= 40 && $averageMarks < 70) {
        echo '<p class="result-text">Congratulations '.$_SESSION['valid_user'].', you passed!</p>';
        echo '<p class="result-text">Your Average Mark is: '.$averageMarks.'</p>';
      }
      elseif ($averageMarks >= 70) {
        echo '<p class="result-text pass-animation">Congratulations '.$_SESSION['valid_user'].', you are first class!</p>';
        echo '<p class="result-text">Your Average Mark is: '.$averageMarks.'</p>';
      }
      else {
        echo '<p>No valid modules found to calculate average marks.</p>';
      }
    } else {
  ?>
      <form method="post" action="">
        <div class="table-container">
          <table>
            <caption>Second Year Modules</caption>
            <tr>
              <th>Module</th>
              <th>Marks</th>
            </tr>
            <tr>
              <td>System Development</td>
              <td><input type="number" name="module1" value="<?php echo isset($randomMarks[0]) ? $randomMarks[0] : ''; ?>" required></td>
            </tr>
            <tr>
              <td>System Security</td>
              <td><input type="number" name="module2" value="<?php echo isset($randomMarks[1]) ? $randomMarks[1] : ''; ?>" required></td>
            </tr>
            <tr>
              <td>Networking</td>
              <td><input type="number" name="module3" value="<?php echo isset($randomMarks[2]) ? $randomMarks[2] : ''; ?>" required></td>
            </tr>
            <tr>
              <td>Artificial Intelligence</td>
              <td><input type="number" name="module4" value="<?php echo isset($randomMarks[3]) ? $randomMarks[3] : ''; ?>" required></td>
            </tr>
            <tr>
              <td>Software Development</td>
              <td><input type="number" name="module5" value="<?php echo isset($randomMarks[4]) ? $randomMarks[4] : ''; ?>" required></td>
            </tr>
            <tr>
              <td>Dynamic Web Authoring</td>
              <td><input type="number" name="module6" value="<?php echo isset($randomMarks[5]) ? $randomMarks[5] : ''; ?>" required></td>
            </tr>
          </table>

          <table>
            <caption>Third Year Modules</caption>
            <tr>
              <th>Module</th>
              <th>Marks</th>
            </tr>
            <tr>
              <td>Cloud Development</td>
              <td><input type="number" name="module7" value="<?php echo isset($randomMarks[6]) ? $randomMarks[6] : ''; ?>" required></td>
            </tr>
            <tr>
              <td>Data Analytics</td>
              <td><input type="number" name="module8" value="<?php echo isset($randomMarks[7]) ? $randomMarks[7] : ''; ?>" required></td>
            </tr>
            <tr>
              <td>Project Management</td>
              <td><input type="number" name="module9" value="<?php echo isset($randomMarks[8]) ? $randomMarks[8] : ''; ?>" required></td>
            </tr>
            <tr>
              <td>Computing Systems Project</td>
              <td><input type="number" name="module10" value="<?php echo isset($randomMarks[9]) ? $randomMarks[9] : ''; ?>" required></td>
            </tr>
            <tr>
              <td>Web Application Development</td>
              <td><input type="number" name="module11" value="<?php echo isset($randomMarks[10]) ? $randomMarks[10] : ''; ?>" required></td>
            </tr>
          </table>
        </div>

        <p style="text-align: center;">Please enter your marks below to see the average of your graduation marks.</p>
        <div style="display: flex; justify-content: center;">
          <input type="submit" value="Calculate Average" name="calculate">
        </div>
      </form>
    <?php
    }
  }
  else
  {
    echo '<p>You are not logged in.</p>';
    echo '<p>Only logged in members may see this page.</p>';
  }
  ?>

  <p><a href="authmain.php"> Click to go Back to Home Page</a></p>

</body>
</html>
