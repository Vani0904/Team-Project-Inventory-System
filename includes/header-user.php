<header id="header-user">
    <div id="left">
        <img src="../images/logo_main.png" alt="company logo" width="125" height="125">
    </div>
    <div id="right">
        <button id="button-logout">Logout</button>
        <div class="spaced">
            <form id="search-container">
                <input id="searchbar" type="text" placeholder="Search..." name="searchbar" value="<?= $_GET['searchbar'] ?? '' ?>">
                <button id="search-button" type="submit"><img src="../images/icon-search.png"
                        alt="search button magnifying glass" width="25px" height="25px"></button>
            </form>
        </div>
        <div id="basket-button-container">
            <label id="basket-label">Shopping Cart:</label>
            <button id="basket-button" onclick="window.location.href='user-basket.php'"><img
                    src="../images/icon-basket.png" alt="basket button icon" width="30px" height="30px"></button>
        </div>
    </div>
</header>