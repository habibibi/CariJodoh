<nav class="navbar">
    <div class="navbar-container">
        <span>
            <a href="<?= BASE_URL ?>/admin"><img src="<?= BASE_URL ?>/images/assets/logo.webp" alt="logo" class="logo-nav"/></a>
        </span>
        <ul>
            <li><a href="<?= BASE_URL ?>/admin">Admin</a></li>
            <li><a href="<?= BASE_URL ?>/admin/user">Users</a></li>
            <li><a href="<?= BASE_URL ?>/admin/notification">Notifications</a></li>
            <li><a href="<?= BASE_URL ?>/admin/likes">Likes</a></li>
        </ul>
        <div class="hamburger-menu">
            <div class="ml-auto">
                <img class="dropbtn" src="<?= BASE_URL ?>/images/icons/hamburger.webp" alt="dropdown"/>
            </div>
            <ul class="dropdown-content">
                <li><a href="<?= BASE_URL ?>/admin">Admin</a></li>
                <li><a href="<?= BASE_URL ?>/admin/user">Users</a></li>
                <li><a href="<?= BASE_URL ?>/admin/notification">Notifications</a></li>
                <li><a href="<?= BASE_URL ?>/admin/likes">Likes</a></li>
            </ul>
        </div>
    </div>
</nav>
<script src="<?= BASE_URL ?>/js/navbar.js"></script>