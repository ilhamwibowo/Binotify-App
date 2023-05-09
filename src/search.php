<?php
    include_once 'utilities.php';
    include 'db.php';
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="'https://fonts.googleapis.com/css?family=Montserrat|Open+Sans:600&display=swap'">
        <link rel="stylesheet" href="styles/index.css"<?php echo time(); ?>>
        <link rel="stylesheet" href="styles/search.css"<?php echo time(); ?>>
        <title>Binotify</title>
    </head>
    <body>
        <div class="container">
            <div class="sidebar">
                <?php include 'side.php'; ?>
            </div>
            <div class="navbar">
                <?php include 'navbar.php'?>
            </div>
            <div class="main">
                <!-- <div class="section-search"> -->
                    <div class="container-search">
                        <form class="container-flex-sort-filter" action="" method="GET">
                            <input name="q" value="<?php echo $_GET['q']; ?>" style="display: none">
                            <div class = "flex-sort-filter-item-1">
                                <p>Sorted by: </p>
                                <select name="sort">
                                    <option value="unsort">-</option>
                                    <option value="Judul ASC">Title Asc</option>
                                    <option value="Judul DESC">Title Desc</option>
                                    <option value="Tanggal_terbit ASC">Year Asc</option>
                                    <option value="Tanggal_terbit DESC">Year Desc</option>
                                </select>
                            </div>
                            <div class = "flex-sort-filter-item-2">
                                <p>Filtered by:</p>
                                <select name="filter">
                                    <option value="unfilter">-</option>
                                    <?php
                                        $query = "SELECT DISTINCT Genre FROM song";
                                        $genre = mysqli_query($conn, $query);
                                        if (mysqli_num_rows($genre) > 0) {
                                            while ($g = mysqli_fetch_array($genre)) {
                                                ?> <option value="<?php 
                                                echo $g['Genre'] ;
                                                ?>"> <?php 
                                                echo $g['Genre'] 
                                                ?></option> <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                            <input name="page" value="<?php echo $_GET['page']; ?>" style="display: none">
                            <input class="submit" type="submit" name="">
                        </form>
                        <h3>Result</h3>
                        <hr>
                        <?php  
                            # Make Query
                            $sort = $_GET['sort'];
                            $filter = $_GET['filter'];
                            $q = $_GET['q'];
                            if (empty($q)) { # If search bar is empty
                                $query = "SELECT * FROM song";
                                # Input for filter
                                if ($filter != "unfilter") {
                                    $query = $query . " WHERE Genre='" . $filter . "'";
                                }
                                # Input for sort
                                if ($sort != "unsort") {
                                    $query = $query . " ORDER BY " . $sort;
                                }
                            } else { # If search bar is not empty
                                $query = "SELECT * FROM song WHERE Judul REGEXP '" . $q . "' OR Penyanyi REGEXP '" . $q . "' OR year(Tanggal_terbit) = '" . $q . "'";

                                # Input for filter
                                if ($filter != "unfilter") {
                                    $query = $query . " AND Genre='" . $filter . "'";
                                }
                                # Input for sort
                                if ($sort != "unsort") {
                                    $query = $query . " ORDER BY " . $sort;
                                }
                            }
                            

                            $song = mysqli_query($conn, $query);
                            
                            # Pagination
                            $song_per_page = 8;
                            $total_song = mysqli_num_rows($song);
                            $total_page = ceil($total_song / $song_per_page);
                            $start_query = ($_GET['page']-1) * $song_per_page;
                            
                            $query = $query . " LIMIT " . $start_query . ", " . $song_per_page;
                            $song = mysqli_query($conn, $query);
                            if (mysqli_num_rows($song) > 0) {
                                while ($s = mysqli_fetch_array($song)) {
                                    $src_song = "detail_lagu.php?song_id=" . $s["song_id"];
                                    echo list_song($src_song, $s['Image_path'], $s['Judul'], $s['Penyanyi'], $s['Genre'], $s['Tanggal_terbit']);
                                }
                            } else {
                                ?> <p>Song not found</p> <?php
                            }

                        ?>
                        <div class="pagination-flex">
                            <?php 
                                for ($i=1; $i<=$total_page; $i++) {
                                    ?><a href="<?php echo substr($_SERVER['REQUEST_URI'], 0, -1) . $i; ?>"><span class="pagination-item"><?php echo $i; ?></span></a> <?php
                                }
                            ?>
                        </div>
                        <!-- <a href="#">
                            <div class = "container-flex-list">
                                <div class="flex-list-item-1">
                                    <div class="grid-list-item-1">
                                        <img src="./images/115-kilo-meter.jpg">
                                    </div>
                                    <div class="grid-list-item-2">
                                        <p>115 Kilo Meter</p>
                                    </div>
                                    <div class="grid-list-item-3">
                                        <p>Dism Huaha</p>
                                    </div>
                                </div>
                                <div class="flex-list-item-2">flex item 2</div>
                                <div class="flex-list-item-3">flex item 3</div>
                            </div>
                        </a> -->
                    </div>
                </div>
            <!-- </div> -->
        </div>
    </body>
</html>