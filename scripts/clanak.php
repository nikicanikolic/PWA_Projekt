<?php include'connect.php'; 

    $id = $_GET['id'];

    define('UPLPATH', '..resources/images/');
    $query= "SELECT * FROM articles WHERE id = $id";
    $result= mysqli_query($dbc, $query);
    $row= mysqli_fetch_array($result);

    $title = $row['title'];
    $about = $row['about'];
    $content = $row['content'];
    $image = $row['picture'];
    $category = $row['category'];
    mysqli_close($dbc);
?>

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
        <article id="fullPageArticle">
          <h1 id="fullPageTitle"><?php echo $title; ?></h1>
          <img id='articleImage' src='<?php echo "../resources/images/" . $image; ?>'>
          <h2><?php echo $about; ?></h2>
          <p id="articleText"><?php echo $content; ?></p>
        </article>
      </section>
    </section>
    <footer>
      <div id="footerDiv">
        <p>Weitere Online-Angebote der Axel Springer SE</p>
      </div>
    </footer>
  </body>
</html>
