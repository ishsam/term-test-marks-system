<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$user = $_SESSION['user_login'];

//Get teacher id
$teacher_id_select_query = mysqli_query($db_con, "SELECT `teacher_id` FROM `tbl_teacher` WHERE `username`= '$user';");
$teacher_tbl_row = mysqli_fetch_assoc($teacher_id_select_query);
$teacher_id = $teacher_tbl_row['teacher_id'];

$class_teacher_query = mysqli_query($db_con, "SELECT * FROM `tbl_class_teacher` WHERE `teacher_id` = '$teacher_id';");
$class_teacher_tbl_row = mysqli_fetch_assoc($class_teacher_query);

$selected_class = $class_teacher_tbl_row['class_id'];

?>

<?php include 'header.php'; ?>

<body>
    <?php include 'navbar.php'; ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2>My Class Students</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Registration #</th>
                    <th scope="col">Student Name</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                <?php
                $all_class_students_query = mysqli_query($db_con, "SELECT * FROM `tbl_student` WHERE `class_id` = '$selected_class';");

                while ($class_students_result = mysqli_fetch_array($all_class_students_query)) {
                    echo '<tr><th scope="row">' . $class_students_result['registration_number'] . '</th>
        <td>' . $class_students_result['first_name'] . ' ' . $class_students_result['last_name'] . '</td>
        <td>
        <a href="update-student.php?id='.$class_students_result['id'].'" class="btn btn-light"><span style="margin-right: 5px;" class="fa fa-pencil" ></span>Update Strudent info</a>
        </td>
        <td><button class="btn"><i class="fa fa-trash"></i></button></td>
        </tr>';
                }
                ?>
            </tbody>
        </table>
    </main>

    </div>
    </div>

    <?php include 'footer.php'; ?>