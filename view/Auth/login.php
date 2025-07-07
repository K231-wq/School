<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <div class="container login-wrapper d-flex justify-content-center align-items-center" style="max-height: 100vh;">
        <div class="card px-4 py-2 mt-4" id="loginCard" style="width: 100%; max-width: 480px;">
            <h3 class="text-center mb-2 font-bold">Login</h3>
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" id="loginForm" novalidate>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email..." required>
                    <div class="invalid-feedback">Please enter valid email...</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password..." required>
                    <div id="passwordStrength" class="mt-1"></div>
                    <div class="invalid-feedback">Password must be at least 8 letters, Uppercase And Special char</div>
                </div>
                <div class="password-show mb-2">
                    <input type="checkbox" name="checkbox" id="checkbox" class="form-check-input">
                    <label for="checkbox" id="togglePasswordText" class="form-check-label">
                        Show Password
                    </label>
                </div>
                <?php if(!empty($errors)):?>
                    <div class="errorBox">
                        <?php foreach($errors as $error):?>
                            <p class="errorMessage"><?php echo $error; ?></p>
                        <?php endforeach; ?>
                        <script>
                            const errorBox = document.querySelector('.errorBox');
                            setTimeout(() => {
                                errorBox.style.display = "none";
                            }, 3000);
                        </script>
                    </div>
                <?php endif; ?>
                <?php if(!empty($messages)):?>
                    <div class="successBox">
                        <?php foreach($messages as $message):?>
                            <p class="successMessage"><?php echo $message; ?></p>
                        <?php endforeach; ?>
                        <script>
                            const successBox = document.querySelector('.successBox');
                            setTimeout(() => {
                                successBox.style.display = "none";
                                window.location.href = "/profile/user";
                            }, 3000);
                        </script>
                    </div>
                <?php endif; ?>
                <div class="w-100">
                    <button type="submit" class="w-50 btn btn-primary">Log In</button>
                </div>
            </form>
            <a href="/register" class="text-center mt-4" id="registerLink">If You don't have An Account. Please go to Register page</a>
        </div>
    </div>
    <script type="module" src="/js/login.js"></script>
</body>
</html>