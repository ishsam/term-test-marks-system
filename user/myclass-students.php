<?php require_once 'db_con.php';
session_start();
$title = "Student Term Marks System";

$user = $_SESSION['user_login'];
$selected_class = $_SESSION['class'];


?>

<?php include 'header.php'; ?>

<body>
    <?php include 'navbar.php'; ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" style="margin-top: 2%;">


        <div class="card text-white bg-secondary mb-3 " style="opacity: 0.8;">
            <div class="card-header" style="background-color: #563d7c; font-size: large;">
                <h5 class="card-title">My Class Students</h5>
            </div>
            <div class="card-body" style="font-size: large;">
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
        <a href="update-student.php?id=' . $class_students_result['id'] . '" class="btn btn-light"><span style="margin-right: 5px;" class="fa fa-pencil" ></span>Update Student info</a>
        </td>
        
        <td> 
        <a href="delete-model-content.php?id=' . $class_students_result['id'] . '" class="btn btn-light" id="deleteStudentModalBtn" data-bs-toggle="modal" data-bs-target="#deletestudentModal"><span style="margin-right: 5px;" class="fa fa-trash" ></span>Delete Student</a></td>
        </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
        <!-- <td><a href="delete-student.php?id=' . $class_students_result['id'] . '" class="btn btn-light" id="deletestudentbtn"><span style="margin-right: 5px;" class="fa fa-trash" ></span>Delete Student</a> </td>-->

    </main>


    <div class="modal" tabindex="-1" id="deletestudentModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id='deleteStudentForm' name="deleteStudent" role="form">
                    <div class="modal-body" id="delete-modal-body">
                    <p>Are you sure that you want to delete the student ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="deletestudentbtn" name="delete-student">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    </div>

    <?php include 'footer.php'; ?>