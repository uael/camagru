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
    <title>Login - Camagru</title>
</head>

<?php include __DIR__ . "/header.php" ?>

<section class="section hero has-text-centered is-dark is-bold">
    <div class="container">
        <div class="field">
            <p class="control has-text-centered">
                <span class="subtitle">Change your infos:</span>
            </p>
        </div>
        <br/>
        <div class="columns is-centered is-desktop">
            <form action="/user/username" method="post">
                <div class="field has-addons has-text-centered">
                    <p class="control has-icons-left has-text-centered">
                        <input class="input" type="text"
                               placeholder="New Username" name="new_username">
                        <span class="icon is-small is-left">
          <i class="fas fa-user"></i>
        </span>
                    </p>
                    <p class="control">
                        <input type="submit" class="button is-warning"
                               value="Send">
                    </p>
                </div>
            </form>
        </div>
        <br/>
        <div class="columns is-centered is-desktop">
            <form action="/user/email" method="post">
                <div class="field has-addons">
                    <p class="control has-icons-left">
                        <input class="input" type="email"
                               placeholder="New Email" name="new_email">
                        <span class="icon is-small is-left">
          <i class="fas fa-envelope"></i>
        </span>
                    </p>
                    <p class="control">
                        <input type="submit" class="button is-warning"
                               value="Send">
                    </p>
                </div>
            </form>
        </div>
        <br/>
        <div class="columns is-centered is-desktop">
            <form action="/user/password" method="post">
                <div class="field has-addons">
                    <p class="control has-icons-left">
                        <input class="input" type="password"
                               placeholder="New Password" name="new_pwd"
                               pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$">
                        <span class="icon is-small is-left"><i
                                    class="fas fa-lock"></i></span>
                    </p>
                    <p class="control">
                        <input type="submit" class="button is-warning"
                               value="Send">
                    </p>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include __DIR__ . "/footer.php" ?>