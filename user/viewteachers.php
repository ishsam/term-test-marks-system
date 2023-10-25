<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$user = $_SESSION['user_login'];

?>

<?php include 'header.php'; ?>

<body>
    <?php include 'navbar.php'; ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-top: 2%;">


        <div class="card text-white bg-secondary mb-3 ">
            <div class="card-header" style="background-color: #563d7c; font-size: large;">
                <h5 class="card-title">All Teachers</h5>
            </div>
            <div class="card-body" style="font-size: large;">
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
        <td>
        <a href="delete-teacher.php?id=' . $all_teachers_result['teacher_id'] . '" class="btn btn-light" id="deleteTeacherModalBtn" data-bs-toggle="modal" data-bs-target="#deleteteacherModal"><span style="margin-right: 5px;" class="fa fa-trash" ></span>Delete Teacher</a></td>
        </td>
        </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>


    </main>

    <div class="modal" tabindex="-1" id="deleteteacherModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Teacher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id='deleteTeacherForm' name="deleteTeacher" role="form">
                    <div class="modal-body" id="delete-teacher-modal-body">
                        <p>Are you sure that you want to delete the teacher ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="deleteteacherbtn" name="delete-teacher">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    </div>

    <?php include 'footer.php'; ?>