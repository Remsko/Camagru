<div class="header">
    <a class="active" href="/">Gallery</a>
    <div class="header-right">
    <?php
        if(!isset($_SESSION['userId'])) {
            echo '<a href="/user/signin">Sign In</a>';
            echo '<a href="/user/signup">Sign Up</a>';
        }
        else {
            echo '<a href="/studio">Studio</a>';
            echo '<a href="/user/settings">Settings</a>';
            echo '<a href="/user/logout">Logout</a>';
        }
    ?>
    </div>
</div>