<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$user = $_SESSION['user_login'];

?>

<?php include 'header.php'; ?>

<body>
    <?php include 'navbar.php'; ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2>Teachers</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Teacher Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Registration Number</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

                <?php
                $all_teachers_query = mysqli_query($db_con, "SELECT `tbl_teacher`.`first_name`, `tbl_teacher`.`last_name`, `tbl_teacher`.`teacher_id`, `tbl_teacher`.`registration_number`, `tbl_role`.`role_name` FROM `tbl_teacher` INNER JOIN `tbl_role` WHERE `tbl_role`.`role_id` = `tbl_teacher`.`user_role` AND `tbl_teacher`.`user_role` != 3;");

                while ($all_teachers_result = mysqli_fetch_array($all_teachers_query)) {
                    echo '<tr>
        <td>' . $all_teachers_result['first_name'] . ' ' . $all_teachers_result['last_name'] . '</td>
        <td>
        ' . $all_teachers_result['role_name'] . '
        </td>
        <td>
        ' . $all_teachers_result['registration_number'] . '
        </td>
        <td><a href="delete-teacher.php?id=' . $all_teachers_result['teacher_id'] . '" class="btn btn-light"><span style="margin-right: 5px;" class="fa fa-trash" ></span>Delete Teacher</a>
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