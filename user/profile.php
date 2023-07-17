<?php include 'header.php';$title="Student Term Marks System";?>
  <body>
      <?php include 'navbar.php';?>

      <div class="center-content container" style="padding: 20px 30px;">
        <h2>Profile</h2>

        <div class="mb-3 row">
          <label for="teacher-own-class" class="col-sm-2 col-form-label">My Class</label>

          <select class="selectpicker" id="teacher-own-class">
            <option value="1">10A</option>
            <option value="2">10B</option>
            <option value="3">11C</option>
          </select>
        </div>

        <div class="mb-3 row">
          <label for="teacher-subjects" class="col-sm-2 col-form-label">Subjects</label>

          <select class="selectpicker" multiple id="teacher-subjects" data-live-search="true">
            <option value="1">Maths</option>
            <option value="2">Science</option>
            <option value="3">Buddhism</option>
          </select>
        </div>

        <div class="mb-3 row">
          <label for="teacher-other-classes" class="col-sm-2 col-form-label">My Other Classes</label>

          <select class="selectpicker" multiple id="teacher-other-classes" data-live-search="true">
            <option value="1">9A</option>
            <option value="2">9B</option>
            <option value="3">7C</option>
          </select>
        </div>
        <div class="mb-3 row">
        <label for="reg-no" class="col-sm-2 col-form-label">Registration number</label>
          <div class="col-sm-3">
          <input type="text" class="form-control" id="reg-no" placeholder="Registration No">
          </div>
        </div>

        <div class="mb-3">
        <button type="submit" class="btn btn-primary mb-3">Update My Profile</button>
        </div>
  
      </div>
      <?php include 'footer.php';?>
