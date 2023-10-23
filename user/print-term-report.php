<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$student_id = $_GET['id'];
$term = $_GET['term'];

$student_select_query = mysqli_query($db_con, "SELECT CONCAT(`first_name`, ' ', `last_name`) AS `name` FROM `tbl_student` WHERE `id`= '$student_id';");
$student_tbl_row = mysqli_fetch_assoc($student_select_query);

?>

<?php include 'header.php';
$title = "Student Term Marks System"; ?>

<body>
    <?php include 'navbar.php'; ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-top: 2%;">
        <h2></h2>

        <div class="card text-white bg-secondary mb-3 " style="opacity: 0.8;">
            <div class="card-header" style="background-color: #563d7c; font-size: large;">
                <h5 class="card-title"><?php echo $student_tbl_row['name'] ?> Term <?php echo $term ?> Results</h5>
            </div>
            <div class="card-body" style="font-size: large;">
                <form class="form" id="term-report-form">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Marks</th>
                            </tr>
                        </thead>


                        <tbody>

                            <?php

                            $marks_select_query = mysqli_query($db_con, "SELECT `subject_id`, `marks` FROM `tbl_marks` WHERE `student_id`= '$student_id' AND `term` = '$term';");

                            while ($student_marks_result = mysqli_fetch_array($marks_select_query)) {

                                $subject_id = $student_marks_result['subject_id'];

                                $subject_select_query = mysqli_query($db_con, "SELECT `name` FROM `tbl_subject` WHERE `id`= '$subject_id';");
                                $subject_tbl_row = mysqli_fetch_assoc($subject_select_query);


                                echo '<tr><td scope="row">' . $subject_tbl_row['name'] . '</td>
     
        <td> ' . $student_marks_result['marks'] . '  </td>
        </tr>';
                            }

                            $marks_aggregate = mysqli_query($db_con, "SELECT AVG(`marks`) AS `average_marks` , SUM(`marks`) AS `total_marks` FROM `tbl_marks` WHERE `student_id`= '$student_id' AND `term` = '$term' GROUP BY `student_id`;");
                            $aggregate_row = mysqli_fetch_assoc($marks_aggregate);

                            echo '
                
                <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                <tr><td scope="row" align="right"> Total </td>
     
        <td> ' . $aggregate_row['total_marks'] . '  </td>
        </tr>';

                            echo '<tr><td scope="row" align="right"> Average </td>
     
        <td> ' . $aggregate_row['average_marks'] . '  </td>
        </tr>';

                            ?>

                        </tbody>
                    </table>
                </form>
                <input type="button" class="btn btn-primary" id="create_pdf" name="print-report" value="Print Report" />

            </div>

        </div>


    </main>


    </div>
    </div>

    <?php include 'footer.php'; ?>