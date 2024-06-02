<nav class="navbar">
    <div class="navbar-container">
        <span>
            <a href="<?= BASE_URL ?>/recommendation"><img src="<?= BASE_URL ?>/images/assets/logo.webp" alt="logo" class="logo-nav"/></a>
        </span>
        <ul>
            <li><a href="<?= BASE_URL ?>/recommendation">Recommendation</a></li>
            <li><a href="<?= BASE_URL ?>/articles">Articles</a></li>
            <li><a href="<?= BASE_URL ?>/browse">Browse</a></li>
            <li><a href="<?= BASE_URL ?>/notification">Notification</a></li>
            <li><a href="<?= BASE_URL ?>/likes">Likes</a></li>
            <li><a href="<?= BASE_URL ?>/user/myprofile">Profile</a></li>
        </ul>
        <div class="hamburger-menu">
            <div class="ml-auto">
                <img class="dropbtn" src="<?= BASE_URL ?>/images/icons/hamburger.webp" alt="dropdown"/>
            </div>
            <ul class="dropdown-content">
                <li><a href="<?= BASE_URL ?>/recommendation">Recommendation</a></li>
                <li><a href="<?= BASE_URL ?>/articles">Articles</a></li>
                <li><a href="<?= BASE_URL ?>/browse">Browse</a></li>
                <li><a href="<?= BASE_URL ?>/notification">Notification</a></li>
                <li><a href="<?= BASE_URL ?>/likes">Likes</a></li>
                <li><a href="<?= BASE_URL ?>/user/myprofile">Profile</a></li>
            </ul>
        </div>
    </div>
</nav>
<script src="<?= BASE_URL ?>/js/navbar.js"></script>