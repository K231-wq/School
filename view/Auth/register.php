<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="/css/register.css">
</head>
<body class="d-flex justify-content-center align-items-center" style="max-height: 100vh;">
  <div class="card px-4 py-1 mt-1" id="registerCard" style="width: 100%; max-width: 460px;">
      <h3 class="mb-2 text-center mt-0 font-bold">Create an Account</h3>
      <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ;?>" method="POST" enctype="multipart/form-data" id="registerForm" novalidate>
        <div class="mb-2">
          <label for="imageFile" class="form-label">UserImage: </label>
          <input type="file" name="image" id="imageFile" class="form-control">
        </div>

        <div class="mb-2">
          <label for="name" class="form-label">Name: </label>
          <input type="text" name="name" class="form-control" id="name" required />
          <div class="invalid-feedback">Please enter your name.</div>
        </div>

        <div class="mb-2">
          <label for="email" class="form-label">Email address: </label>
          <input type="email" name="email" class="form-control" id="email" required />
          <div class="invalid-feedback">Please enter a valid email.</div>
        </div>

        <div class="mb-2 position-relative">
          <label for="password" class="form-label">Password: </label>
          <div class="input-group">
            <input type="password" name="password" class="form-control" id="password" required />
            <button type="button" class="" id="togglePassword">Show</button>
          </div>
          <div id="passwordStrength" class="mt-1"></div>
          <div class="invalid-feedback">Password must be at least 6 characters.</div>
        </div>

        <div class="mb-2">
          <label for="passwordConfirm" class="form-label">Password Confirmation:</label>
          <input type="password" name="passwordConfirm" class="form-control" id="passwordConfirm" required />
          <div id="matchError" class="invalid-feedback">Passwords do not match.</div>
        </div>

        <?php if(!empty($message)): ?>
          <div class="messageBox">
            <p class="resultMessage"><?php echo $message; ?></p>
            <script>
              const messageBox = document.querySelector('.messageBox');
              setTimeout(() => {
                messageBox.style.display = "none";
              }, 3000);
            </script>
          </div>
        <?php endif; ?>
        
        <?php if(!empty($error)): ?>
          <div class="errorBox">
            <p class="errorMessage"><?php echo $error; ?></p>
            <script>
              const errorBox = document.querySelector('.errorBox');
              setTimeout(() => {
                errorBox.style.display = "none";
              }, 3000);
            </script>
          </div>
        <?php endif; ?>

        <button type="submit" class="mt-1 w-100 registerBtn">Register</button>
      </form>
      <a href="/login" class="text-center mt-4" id="loginLink">If you already sign in.Please go to Login page</a>
  </div>
  <script type="module" src="/js/register.js"></script>
</body>
</html>
