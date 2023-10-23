    <script src="../resources/js/jquery.min.js"></script>
    <script src="../resources/js/bootstrap.bundle.js"></script>
    <!--<script src="../resources/js/bootstrap-select.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $(".toast").toast('show');
        $('.selectpicker').selectpicker();

        var form = $('.form'),
          cache_width = form.width(),
          a4 = [595.28, 841.89]; // for a4 size paper width and height  



        $('#create_class_report_pdf').on('click', function(e) {

          e.preventDefault();

          $('body').scrollTop(0);

          createPDF($('h5').text());
        });

        $('#create_pdf').on('click', function() {
          $('body').scrollTop(0);

          createPDF($('h5').text());
        });

        function createPDF(title) {
          getCanvas().then(function(canvas) {
            var
              img = canvas.toDataURL("image/png"),
              doc = new jsPDF({
                unit: 'px',
                format: 'a4'
              });
            doc.text(title, 10, 10);
            doc.addImage(img, 'JPEG', 20, 20);
            title = title.replace(/\s+/g, '-').toLowerCase();
            doc.save(title + '.pdf');
            form.width(cache_width);
          });
        }

        function getCanvas() {
          form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');
          return html2canvas(form, {
            imageTimeout: 2000,
            removeContainer: true
          });
        }

      });

      $(document).on("click", "#deleteStudentModalBtn", function(event) {

        $('#deletestudentModal').modal({
          show: true
        });


        $("#deletestudentbtn").on('click', function(e) {

          e.preventDefault();

          submitForm(event.target.href.split("=")[1]);

          return false;
        });

        function submitForm(studentId) {
          $.ajax({
            type: "POST",
            url: "delete-student.php?id=" + studentId,
            cache: false,
            data: $('form#deleteStudentForm').serialize(),
            success: function(response) {
              $("#deletestudentModal").modal('hide');
              location.reload();
            },
            error: function() {
              alert("Error");
            }
          });
        }

      });

      $(document).on("click", "#deleteclassModalBtn", function(event) {

        $('#deleteclassModal').modal({
          show: true
        });


        $("#deleteclassbtn").on('click', function(e) {

          e.preventDefault();

          submitForm(event.target.href.split("?")[1]);

          return false;
        });


        function submitForm(query) {
          $.ajax({
            type: "POST",
            url: "delete-class.php?" + query,
            cache: false,
            data: $('form#deleteClassForm').serialize(),
            success: function(response) {
              $("#deleteclassModal").modal('hide');
              location.reload();
            },
            error: function() {
              alert("Error");
            }
          });
        }

      });

      $(document).on("click", "#addclassModalBtn", function() {

        $('.modal-body').load('modal-content.php?teacher=' + $("#teacher-id").text(), function() {
          $('#addclassModal').modal({
            show: true
          });
        });



        $("#addclassbtn").on('click', function(e) {
          e.preventDefault();

          submitForm($("#teacher-id").text());

          return false;
        });



        function submitForm(teacherId) {
          $.ajax({
            type: "POST",
            url: "modal-content.php?teacherId=" + teacherId,
            cache: false,
            data: $('form#newClassForm').serialize(),
            success: function(response) {
              //$("#test").html(response)
              $("#addclassModal").modal('hide');
              location.reload();
            },
            error: function() {
              alert("Error");
            }
          });
        }


      });
    </script>

    <footer class="footer mt-auto py-3">
      <div class="container">
        <p class="mt-5 mb-3 text-muted text-center">&copy; 2023 Student Term Test Marks System</p>
      </div>
    </footer>

    </body>

    </html>