<?php 

$title = $_POST['title'];
$about = $_POST['about'];
$content = $_POST['content'];
$image = $_POST['pphoto'];
$category;

if(!empty($_POST['category'])){
    $category = $_POST['category'];
}
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
              <a href="../index.html">Home</a>
            </li>
            <li id="menu-item" class="menu-item menu-item-object-category">
              <a>Berlin-Sport</a>
            </li>
            <li id="menu-item" class="menu-item menu-item-object-category">
              <a>Kultur and Show</a>
            </li>
            <li id="menu-item" class="menu-item menu-item-object-category">
              <a href="unos.html">Administracija</a>
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
