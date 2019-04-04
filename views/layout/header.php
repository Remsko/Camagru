<div class="header">
    <a href="/"><img class="homeimg" href="/" src="/public/images/home.jpg" alt="home"/></a>
    <div class="header-right">
    <a class="active" href="/">Gallery</a>
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