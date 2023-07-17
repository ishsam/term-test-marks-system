<?php include 'header.php';$title="Student Term Marks System";?>
  <body>
      <?php include 'navbar.php';?>

      <div class="center-content container" style="padding: 20px 30px;">
        <h2>My Class Students</h2>

        <table class="table">
            <thead>
                <tr>
                <th scope="col">Registration#</th>
                <th scope="col">Student Name</th>
                <th scope="col"></th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td><button type="button" class="btn btn-light"><span style="margin-right: 5px;" class="fa fa-pencil"></span>Update Info</button></td>
                <td><button class="btn"><i class="fa fa-trash"></i></button></td>
                </tr>
            </tbody>
        </table>
  
      </div>
      <?php include 'footer.php';?>
