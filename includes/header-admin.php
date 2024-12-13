<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<header class="header-admin">
    <label for="menu-toggle" class="hamburger-icon">
        <img src="../images/admin-dashboard-menu-icon-black.png" alt="admin dashboard icon">
    </label>
    <label class="header-admin-details">Welcome, <?php echo $_SESSION['user_name'] ?></label>
    <i class="fa-regular fa-user" style="color: #b197fc"></i>
    <a href="logout.php"><img class="header-admin-icon" src="../images/log-out-icon.png" width="50" height="50"></a>
</header>