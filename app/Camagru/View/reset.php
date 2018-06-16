<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html"
      class="has-background-black-ter">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer
            src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <title>Reset you Password - Camagru</title>
</head>

<?php include __DIR__ . "/header.php" ?>

<section class="section hero has-text-centered is-light is-bold">
    <div class="container">
        <form action="/user/reset" method="post">
            <div class="field">
                <p class="control">
                    <input type="hidden" name="hash" value=<?= $hash ?>>
                    <span class="subtitle">Please input your new password :</span>
                </p>
            </div>
            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="password"
                           placeholder="New Password" name="new_pwd">
                    <span class="icon is-small is-left">
              <i class="fas fa-lock"></i>
            </span>
                </p>
            </div>
            <div class="field">
                <p class="control">
                    <input type="submit" class="button is-warning"
                           value="Submit" name="forgotten_pwd">
                </p>
            </div>
        </form>
    </div>
</section>


<?php include __DIR__ . "/footer.php" ?>