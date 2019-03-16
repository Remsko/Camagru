<div class="header-div">
    <span>Camagru<span>
    <ul>
        <li><a href="/" title="Gallery">Gallery</a></li>
        <?php
            if(!isset($_SESSION['user'])) {
                echo '<li><a href="/user/signin" title="Sign in">Sign in</a></li>';
                echo '<li><a href="/user/signup" title="Sign up">Sign up</a></li>';
            }
            else {
                echo '<li><a href="/user/settings" title="Settings">Settings</a></li>';
                echo '<li><a href="/user/logout" title="Logout">Logout</a></li>';
            }
        ?>
    </ul>
</div>