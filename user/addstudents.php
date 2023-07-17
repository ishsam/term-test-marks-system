<?php include 'header.php';$title="Student Term Marks System";?>
  <body>
      <?php include 'navbar.php';?>

      <div class="center-content container" style="padding: 20px 30px;">
        <h2>Add Students</h2>

        <div class="mb-3 row">
        <label for="fname" class="col-sm-2 col-form-label">First Name</label>
          <div class="col-sm-3">
          <input type="text" class="form-control" id="fname" placeholder="First Name">
          </div>
        </div>
        <div class="mb-3 row">
        <label for="lname" class="col-sm-2 col-form-label">Last Name</label>
          <div class="col-sm-3">
          <input type="text" class="form-control" id="lname" placeholder="Last Name"/>
          </div>
        </div>
        <div class="mb-3 row">
        <label for="reg-no" class="col-sm-2 col-form-label">Registration number</label>
          <div class="col-sm-3">
          <input type="text" class="form-control" id="reg-no" placeholder="Registration No">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="student-class" class="col-sm-2 col-form-label">My Class</label>

          <select class="selectpicker" id="student-class">
            <option value="1">10A</option>
            <option value="2">10B</option>
            <option value="3">11C</option>
          </select>
        </div>
      </div>
      <?php include 'footer.php';?>
