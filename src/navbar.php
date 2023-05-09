<?php 
    if(isset($_COOKIE['username'])) {
        $username =  $_COOKIE['username'];
    }
    else {
        $username = '<a class="right" href="/login.php">Log In</a>';
    }
                    
?>

<link rel="stylesheet" href="styles/navbar.css">
<nav>
    <div class="search-bar"> 
        <form action="/search.php" method="GET">
            <input type="text" name="q" class="search-text" placeholder="Search" value="">
            <input name="sort" value="unsort" style="display: none">
            <input name="filter" value="unfilter" style="display: none">
            <input name="page" value="1" style="display: none">
            <button type="submit" class="btn-search"><img src="images/icon-search.png"> </button>
        </form>
    </div>

    <div class="username"><?php echo $username; ?></div>
</nav>