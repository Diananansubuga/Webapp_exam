<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Registration Form</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>
    <?php
    $error_message = "";
    ?>
    <div class="container">
        <div class="title">Registration</div>
        <div class="content">
            <form action="users.php" method="POST" onsubmit="return validateForm()">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" name="full_name" placeholder="Enter your name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Address</span>
                        <input type="text" name="address" placeholder="Enter your address" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="email" name="email" placeholder="Enter your email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                        <span class="error"><?php echo $error_message; ?></span>
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="tel" name="phone_number" placeholder="Enter your number" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" id="password" name="password" placeholder="Enter your password" required>
                        <i class="fa fa-eye-slash toggle-password" id="togglePassword"></i>
                    </div>
                    <div class="input-box">
                        <span class="details">Confirm Password</span>
                        <input type="password" id="confirmPassword" placeholder="Confirm your password" required>
                        <i class="fa fa-eye-slash toggle-password" id="toggleConfirmPassword"></i>
                    </div>
                    <!-- <div class="input-box">
                        <span class="details">Role</span>
                        <select name="role" required>
                            <option value="librarian">Librarian</option>
                            <option value="manager">Manager</option>
                            <option value="customer">Customer</option>
                        </select>
                    </div> -->
                </div>
                <div class="gender-details">
                    <input type="radio" name="gender" id="dot-1">
                    <input type="radio" name="gender" id="dot-2">
                    <input type="radio" name="gender" id="dot-3">
                    <span class="gender-title">Gender</span>
                    <div class="category">
                        <label for="dot-1">
                            <span class="dot one"></span>
                            <span class="gender">Male</span>
                        </label>
                        <label for="dot-2">
                            <span class="dot two"></span>
                            <span class="gender">Female</span>
                        </label>
                        <label for="dot-3">
                            <span class="dot three"></span>
                            <span class="gender">Prefer not to say</span>
                        </label>
                    </div>
                </div>
                <div class="button">
                    <a href="selection.php"><input type="submit" value="Register"></a>
                </div>
                <center><p class="login-link">Already have an account?🤔 <a href="login.php">Login here!</a></p></center>
            </form>
        </div>
    </div>
    <script>
        const togglePasswords = document.querySelectorAll(".toggle-password");
        togglePasswords.forEach(function (togglePassword) {
            togglePassword.addEventListener("click", function () {
                const passwordField = togglePassword.previousElementSibling;
                if (passwordField.type === "password") {
                    passwordField.type = "text";
                    togglePassword.classList.remove("fa-eye-slash");
                    togglePassword.classList.add("fa-eye");
                } else {
                    passwordField.type = "password";
                    togglePassword.classList.remove("fa-eye");
                    togglePassword.classList.add("fa-eye-slash");
                }
            });
        });

        function validateForm() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
