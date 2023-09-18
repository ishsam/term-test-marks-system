<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$term = 1;
$user = $_SESSION['user_login'];
$class = $_SESSION['class'] ;


//get class students from tbl_student
//get marks for student_id => total

$student_id_select_query = mysqli_query($db_con, "SELECT  CONCAT(`first_name`, ' ', `last_name`) AS `name` FROM `tbl_student` WHERE `class_id`= '$class';");

$resultSet = array();
$resultSet2 = array();
$resultSet3 = array();
$resultSet4 = array();

$arr = array();
$arr2 = array();
$arr3 = array();


while ($student_tbl_row = mysqli_fetch_assoc($student_id_select_query)) {
  $resultSet[] = $student_tbl_row['name'];
}

$student_rank_query = mysqli_query($db_con, "SELECT AVG(`marks`) as `average`, `student_id`, rank() OVER ( ORDER by AVG(`marks`) DESC) AS `rank` FROM `tbl_marks` WHERE `term` = '$term' GROUP BY `student_id` ORDER BY AVG(`marks`) DESC;");

while ($student_rank_tbl_row = mysqli_fetch_assoc($student_rank_query)) {
  $resultSet2[] = $student_rank_tbl_row['average'];
  $resultSet3[] = $student_rank_tbl_row['rank'];
  $resultSet4[] = $student_rank_tbl_row['student_id'];
}

for ($i=0; $i < sizeof($resultSet); $i++) { 
  $arr[$resultSet[$i]] = $resultSet2[$i];
  $arr2[$resultSet[$i]] = $resultSet3[$i];
  $arr3[$resultSet[$i]] = $resultSet4[$i];
}

?>

<?php include 'header.php';
$title = "Student Term Marks System"; ?>

  <body>
      <?php include 'navbar.php';?>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <h2>Class <?php echo $class ?> Results</h2>


      <div class="mb-3 row">
        <div class="col-sm-3">
          <select class="form-select" id="term" name="term">
          <option selected>Select Term</option>
          <option value="1">Term 1</option> 
          <option value="2">Term 2</option> 
          <option value="3">Term 3</option> 
          </select>
        </div>
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
            foreach ( $arr2 as $name => $rank) {
                    echo '<tr>
                    <th scope="row">'.$rank.'</th>
                        <td>' . $name . '</td>
                        <td>'.$arr[$name].'</td>
                        <td>
                        <a href="print-term-report.php?id='.$arr3[$name].'&term='.$term.'" class="btn btn-light" name="print-report">Print Report</a>
                        </td>
                        </tr>';
                }
                ?>
            </tbody>
        </table>
      </main>

    
      </div>
      </div>

      <?php include 'footer.php';?>
