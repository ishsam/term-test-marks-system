    <script src="../resources/js/jquery.min.js"></script>
    <script src="../resources/js/bootstrap.bundle.js"></script>
    <!--<script src="../resources/js/bootstrap-select.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $(".toast").toast('show');
        $('.selectpicker').selectpicker();
      });

      $(document).on("click", "#addclassModalBtn", function() {

        $('.modal-body').load('modal-content.php', function() {
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
            },
            error: function() {
              alert("Error");
            }
          });
        }


      });
    </script>
    <p class="mt-5 mb-3 text-muted text-center">&copy; 2023 Student Term Test Marks System</p>
    </body>

    </html>