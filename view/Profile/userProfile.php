<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <title>Profile Page</title>
</head>
<body>
    <div class="fluid-container border rounded-lg mb-4 border-radius">
        <h2 class="text-center">Welcome to Profile Page</h2>
        <h3 class="text-center">User's data</h3>
        <div class="fw-semibold bg-secondary text-white p-4">
            <?php echo '<pre>' ?>
            <?php var_dump($user); ?>
            <?php echo '</pre>' ?>
        </div>
    </div>
    <a href="/logout"><button class="w-40 m-auto btn btn-primary">Logout</button></a>
</body>
</html>