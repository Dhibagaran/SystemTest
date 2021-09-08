<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <div>
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name" required />
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email" required />
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password" required />
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password" required />
                            </div>
                            <div class="form-group">
                                <label for="address"><i class="zmdi zmdi-pin"></i></label>
                                <input type="text" name="address" id="address" placeholder="Enter your address" required />
                            </div>
                            <div class="form-group">
                                <label for="city"><i class="zmdi zmdi-city"></i></label>
                                <input type="text" name="city" id="city" placeholder="Enter your city" required />
                            </div>
                            <div class="form-group">
                                <label for="state"><i class="zmdi zmdi-city"></i></label>
                                <input type="text" name="state" id="state" placeholder="Enter your state" required />
                            </div>
                            <div class="form-group">
                                <label for="country"><i class="zmdi zmdi-city"></i></label>
                                <input type="text" name="country" id="country" placeholder="Enter your country" required />
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="register" id="register" class="form-submit" value="Register" required />
                            </div>
                        </div>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        $("#register").click(function() {
            var name = $('#name').val();
            var email = $('#email').val();
            var pass = $('#pass').val();
            var re_pass = $('#re_pass').val();
            var address = $('#address').val();
            var city = $('#city').val();
            var state = $('#state').val();
            var country = $('#country').val();
            reg_data = {
                'type': 'add_customer',
                'name': name,
                'email': email,
                'pass': pass,
                're_pass': re_pass,
                'address': address,
                'city': city,
                'state': state,
                'country': country
            };
            email_check = {
                'type': 'email_validation',
                'email': email
            };
            if (name == '') {
                alert('please enter your name');
                return 0;
            }
            if (email == '') {
                alert('please enter your email');
                return 0;
            }
            if (pass == '') {
                alert('please enter your password');
                return 0;
            }
            if (re_pass == '') {
                alert('please re-enter your password');
                return 0;
            }
            if (re_pass !== pass) {
                alert('please re-enter your password correctly');
                return 0;
            }
            if (address == '') {
                alert('please enter your address');
                return 0;
            }
            if (city == '') {
                alert('please enter your city name');
                return 0;
            }
            if (state == '') {
                alert('please enter your state name');
                return 0;
            }
            if (country == '') {
                alert('please enter your country name');
                return 0;
            }
            if (email != '') {
                $.ajax({
                    url: "http://localhost/system_task/register-post-file.php",
                    data: email_check,
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        if (result.status != 1) {
                            alert('This Email Id is already Registered');
                            return 0;
                        } else {
                            if (name != '' && email != '' && pass != '' && re_pass != '' && address != '' && city != '' && state != '' && country != '') {
                                $.ajax({
                                    url: "http://localhost/system_task/register-post-file.php",
                                    data: reg_data,
                                    dataType: 'json',
                                    success: function(result) {
                                        console.log(result);
                                        if (result.status == 1) {
                                            alert('Succesfully Registered');
                                            location.href = "http://localhost/system_task/login.php";
                                        } else {
                                            alert('Registration is not Succesfull');
                                            location.reload();
                                        }
                                    }
                                });
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>