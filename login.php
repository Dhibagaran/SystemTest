<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="main">

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                     <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign In</h2>
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="your_email" id="your_email" placeholder="Your Email" />
                        </div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="your_pass" id="your_pass" placeholder="Password" />
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $("#signin").click(function() {
            var email = $('#your_email').val();
            var passwd = $('#your_pass').val();

            if (email == '') {
                alert('please enter your email');
                return 0;
            }
            if (passwd == '') {
                alert('please enter your password');
                return 0;
            }
            log_data = {
                'type': 'login_customer',
                'email': email,
                'password': passwd
            };
            if (passwd != '' && email != '') {
                $.ajax({
                    url: "http://localhost/system_task/register-post-file.php",
                    data: log_data,
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == 1) {
                            location.href = "http://localhost/system_task/product-list.php";
                        } else {
                            alert('please enter email/password correctly');
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>