<?php require_once 'db_con.php';

session_start();
$user = $_SESSION['user_login'];
$title = "Student Term Marks System";

//Get teacher id
$teacher_id_select_query = mysqli_query($db_con, "SELECT `teacher_id` FROM `tbl_teacher` WHERE `username`= '$user';");
$teacher_tbl_row = mysqli_fetch_assoc($teacher_id_select_query);
$teacher_id = $teacher_tbl_row['teacher_id'];
?>
<?php include 'header.php'; ?>

<body>
    <?php include 'navbar.php'; ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h2>My Other Classes</h2>
        <button type="button" id="addclassModalBtn" data-bs-toggle="modal" data-bs-target="#addclassModal" class="btn btn-outline-secondary"><span style="margin-right: 5px;" class="fa fa-plus"></span>Add New Class</button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Class</th>
                    <th scope="col">Subject</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $teacher_class_subjects_query = mysqli_query($db_con, "SELECT `tbl_class_subject`.`class_id`, `tbl_subject`.`name` FROM `tbl_class_subject` INNER JOIN `tbl_subject` ON  `tbl_subject`.`id` = `tbl_class_subject`.`subject_id` WHERE `tbl_class_subject`.`teach_by`= '$teacher_id ';");

                while ($class_subjects_result = mysqli_fetch_array($teacher_class_subjects_query)) {
                    echo '<tr><th scope="row">' . $class_subjects_result['class_id'] . '</th>
        <td>' . $class_subjects_result['name'] . '</td>
        <td><a href="add-marks.php?class=' . $class_subjects_result['class_id'] . '&subject=' . $class_subjects_result['name'] . '" class="btn btn-light"><span style="margin-right: 5px;" class="fa fa-plus" ></span>Add Marks</a></td>
        <td>
        <a href="delete-class.php?class=' . $class_subjects_result['class_id'] . '&subject=' . $class_subjects_result['name'] . '" class="btn btn-light"><span style="margin-right: 5px;" class="fa fa-trash" ></span>Delete Subject</a>
        </td>
        </tr>';
                }

                ?>

            </tbody>
        </table>
    </main>

    <div style="display:none;" id="teacher-id"><?php echo $teacher_id; ?></div>
    <div class="modal" tabindex="-1" id="addclassModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id='newClassForm' name="newclass" role="form">
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="addclassbtn" name="add-class">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>
    </div>


    <?php include 'footer.php'; ?>