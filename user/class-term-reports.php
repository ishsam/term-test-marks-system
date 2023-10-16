<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$term = filter_input(INPUT_POST, 'term', FILTER_SANITIZE_STRING);

//$term = 1;
$user = $_SESSION['user_login'];
$class = $_SESSION['class'];



if ($term) {

  $avg_resultSet = array();
  $rank_resultSet = array();
  $stud_name_resultSet = array();
  $stud_id_resultSet = array();

  $arr = array();
  $arr2 = array();
  $arr3 = array();
  $arr4 = array();


  $student_rank_query = mysqli_query($db_con, "SELECT `tbl_student`.`id` AS `id`, CONCAT(`tbl_student`.`first_name`, ' ', `tbl_student`.`last_name`) AS `name`, AVG(`tbl_marks`.`marks`) as `average`, `tbl_marks`.`student_id`, rank() OVER ( ORDER by AVG(`tbl_marks`.`marks`) DESC) AS `rank` FROM `tbl_marks` INNER JOIN `tbl_student` WHERE `tbl_marks`.`term` = '$term' AND `tbl_marks`.`student_id` = `tbl_student`.`id` GROUP BY `tbl_marks`.`student_id` ORDER BY AVG(`tbl_marks`.`marks`) DESC;");

  while ($student_rank_tbl_row = mysqli_fetch_assoc($student_rank_query)) {
    $avg_resultSet[] = round($student_rank_tbl_row['average'], 2);
    $rank_resultSet[] = $student_rank_tbl_row['rank'];
    $stud_name_resultSet[] = $student_rank_tbl_row['name'];
    $stud_id_resultSet[] = $student_rank_tbl_row['id'];
  }

  if (sizeof($avg_resultSet) > 0)
    for ($i = 0; $i < sizeof($stud_name_resultSet); $i++) {
      $arr[$stud_name_resultSet[$i]] = $avg_resultSet[$i];
      $arr2[$stud_name_resultSet[$i]] = $rank_resultSet[$i];
      $arr3[$stud_name_resultSet[$i]] = $stud_name_resultSet[$i];
      $arr4[$stud_name_resultSet[$i]] = $stud_id_resultSet[$i];
    }
}

?>

<?php include 'header.php';
$title = "Student Term Marks System"; ?>

<body>
  <?php include 'navbar.php'; ?>

  <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <h2>Class <?php echo $class ?> Results</h2>


    <div class="mb-3 row">
      <div class="col-sm-3">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
          <select class="form-select" id="term" name="term">
            <option selected value="1">Term 1</option>
            <option value="2">Term 2</option>
            <option value="3">Term 3</option>
          </select>
      </div>
      <div class="col-sm-3">
        <button type="submit" class="btn btn-outline-secondary btn-sm">Select Term</button>
      </div>
      </form>

    </div>

    <table class="table">
      <thead>
        <tr>
          <th scope="col">#Rank</th>
          <th scope="col">Student name</th>
          <th scope="col">Average</th>
          <th scope="col"></th>
        </tr>
      </thead>


      <tbody>

        <?php
        if ($term)
          foreach ($arr2 as $name => $rank) {
            echo '<tr>
                    <th scope="row">' . $rank . '</th>
                        <td>' . $name . '</td>
                        <td>' . $arr[$name] . '</td>
                        <td>
                        <a href="print-term-report.php?id=' . $arr4[$name] . '&term=' . $term . '" class="btn btn-light" name="print-report">Print Report</a>
                        </td>
                        </tr>';
          }
        ?>
      </tbody>
    </table>
  </main>


  </div>
  </div>

  <?php include 'footer.php'; ?>