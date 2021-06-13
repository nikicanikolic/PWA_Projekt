<?php
    include'connect.php';
    define('UPLPATH', '../resources/images/')
;?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>BZ Berlin</title>
    <link rel="stylesheet" href="../style.css" />
  </head>
  <body>
    <header class="nav-container">
      <div id="redline"></div>
      <nav id="navigation-bar" class="navbar nabvar-fixed-top">
        <div id="navbarInner" class="nabvar-inner">
          <img src="../resources/images/logo.png" />
        </div>
        <div class="nav-list">
        <ul id="menu-logo-menue" class="menu">
            <li id="menu-item" class="menu-item menu-item-object-category">
                <a href="index.php"class="">Home</a>
            </li>
            <li id="menu-item" class="menu-item menu-item-object-category">
                <a href="kategorija.php?kategorija=sport"class="">Sport</a>
            </li>
            <li id="menu-item" class="menu-item menu-item-object-category">
                <a href="kategorija.php?kategorija=kultura"class="">Kultura</a>
            </li>
            <li id="menu-item" class="menu-item menu-item-object-category">
                <a href="administracija.php"class="">Administracija</a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <section>
      <section id="sectionBody">
        <div id="topRow" class="row">
          <div id="topRowTitle">
            <h1><?php echo $_GET["kategorija"] ?></h1>
          </div>
          <ul class="articleList">
            
            <?php
                $kategorija = $_GET["kategorija"];                
                $query= "SELECT * FROM articles WHERE category = \"" . $kategorija ."\";";       
                $result= mysqli_query($dbc, $query);
                $i=0;
                while($row= mysqli_fetch_array($result)) {
                    echo '<article>';
                    echo '<img class="articleImg" src="'. UPLPATH . $row['picture'] . '"';              
                    echo '<h2 class="articleTitle">';
                    echo '<a href="clanak.php?id='.$row['id'].'">';
                    echo $row['title'];
                    echo '</a></h2>';
                    echo '</article>';
                }
            ?>

          </ul>
        </div>
      </section>
    </section>
    <footer>
      <div id="footerDiv">
        <p>Weitere Online-Angebote der Axel Springer SE</p>
      </div>
    </footer>
  </body>
</html>

<?php
    mysqli_close($dbc);
?>
