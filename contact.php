<?php
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>ĐỒ ÁN CUỐI KỲ</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>
  <!-- Navigation -->
  <?php include('includes/header.php'); ?>
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <br>
        <br>
        <br>
        <h2>LIÊN HỆ QUA EMAIL</h2>
        <h5 class="sent-notification"></h5>
        <form id="myForm">
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" id="name" placeholder="Tên của bạn">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" id="email" placeholder="Email của bạn">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <input type="text" class="form-control" id="subject" placeholder="Chủ đề lời nhắn">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <textarea id="body" class="form-control" placeholder="Lời nhắn"></textarea>
            </div>
          </div>

          <div class="form-group">
            <button type="button" class="btn btn-primary" onclick="sendEmail()">Gửi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Footer -->
  <?php include('includes/footer.php'); ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    function sendEmail() {
      var name = $("#name");
      var email = $("#email");
      var subject = $("#subject");
      var body = $("#body");

      if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {
        $.ajax({
          url: 'sendEmail.php',
          method: 'POST',
          dataType: 'json',
          data: {
            name: name.val(),
            email: email.val(),
            subject: subject.val(),
            body: body.val()
          },
          success: function(response) {
            $('#myForm')[0].reset();
            $('.sent-notification').text("Email của bạn đã được gửi thành công!");
          }
        });
      }
    }

    function isNotEmpty(caller) {
      if (caller.val() == "") {
        caller.css('border', '1px solid red');
        return false;
      } else
        caller.css('border', '');

      return true;
    }
  </script>

</body>

</html>