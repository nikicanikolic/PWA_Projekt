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
          <div id="formContainer">
          <form enctype="multipart/form-data"action="insert.php"method="POST">
          <div class="form-item">
            <span id="porukaTitle"class="bojaPoruke"></span>
            <label for="title">Naslov vjesti</label>
            <div class="form-field">
              <input type="text"name="title"id="title"class="form-field-textual">
            </div>
          </div>
          <div class="form-item">
            <span id="porukaAbout"class="bojaPoruke"></span>
            <label for="about">Kratki sadržaj vjesti (do 50 znakova)</label>
            <div class="form-field">
              <textarea name="about"id="about"cols="30"rows="10"class="form-field-textual"></textarea>
            </div>
          </div>
          <div class="form-item">
            <span id="porukaContent"class="bojaPoruke"></span>
            <label for="content">Sadržaj vjesti</label>
            <div class="form-field">
              <textarea name="content"id="content"cols="30"rows="10"class="form-field-textual"></textarea>
            </div>
          </div>
          <div class="form-item">
            <span id="porukaSlika"class="bojaPoruke"></span>
            <label for="pphoto">Slika: </label>
            <div class="form-field">
              <input type="file"class="input-text"id="pphoto"name="pphoto"/>
            </div>
          </div>
          <div class="form-item">
            <span id="porukaKategorija"class="bojaPoruke"></span>
            <label for="category">Kategorija vjesti</label>
            <div class="form-field">
              <select name="category"id="category"class="form-field-textual">
                <option value=""disabledselected>Odabir kategorije</option>
                <option value="sport">Sport</option>
                <option value="kultura">Kultura</option>
              </select>
            </div>
          </div>
          <div class="form-item">
            <label>Spremiti u arhivu: 
              <div class="form-field">
                <input type="checkbox"name="archive"id="archive">
              </div>
            </label>
          </div>
          <div class="form-item">
            <button type="reset"value="Poništi">Poništi</button>
            <button type="submit"value="Prihvati"id="slanje">Prihvati</button>
          </div>
        </form>
          </div>
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

<script type="text/javascript">
    document.getElementById("slanje").onclick = function (event) {
    var slanjeForme = true;
    // Naslov vjesti (5-30 znakova)
    var poljeTitle = document.getElementById("title");
    var title = document.getElementById("title").value;
    if (title.length < 5 || title.length > 30) {
        slanjeForme = false;
        poljeTitle.style.border = "1px solid red";
        porukaTitle.style.color = "red";
        document.getElementById("porukaTitle").innerHTML = "Naslov vjesti mora imati između 5 i 30 znakova!<br>";
    }
    else {
        poljeTitle.style.border = "1px solid green";
        document.getElementById("porukaTitle").innerHTML = "";
    }
    // Kratki sadržaj (10-100 znakova)
    var poljeAbout = document.getElementById("about");
    var about = document.getElementById("about").value;
    if (about.length < 10 || about.length > 100) {
        slanjeForme = false;
        poljeAbout.style.border = "1px solid red";
        porukaAbout.style.color = "red";
        document.getElementById("porukaAbout").innerHTML = "Kratki sadržaj mora imati između 10 i 100 znakova!<br>";
    }
    else {
        poljeAbout.style.border = "1px solid green";
        document.getElementById("porukaAbout").innerHTML = "";
    }
    // Sadržaj mora biti unesen
    var poljeContent = document.getElementById("content");
    var content = document.getElementById("content").value;
    if (content.length == 0) {
        slanjeForme = false;
        poljeContent.style.border = "1px solid red";
        porukaContent.style.color = "red";
        document.getElementById("porukaContent").innerHTML = "Sadržaj mora biti unesen!<br>";
    }
    else {
        poljeContent.style.border = "1px solid green";
        document.getElementById("porukaContent").innerHTML = "";
    }
    // Slika mora biti unesena
    var poljeSlika = document.getElementById("pphoto");
    var pphoto = document.getElementById("pphoto").value;
    if (pphoto.length == 0) {
        slanjeForme = false; poljeSlika.style.border = "1px solid red";
        porukaSlika.style.color = "red";
        document.getElementById("porukaSlika").innerHTML = "Slika mora biti unesena!<br>";
    } else {
        poljeSlika.style.border = "1px solid green";
        document.getElementById("porukaSlika").innerHTML = "";
    }// Kategorija mora biti odabrana
    var poljeCategory = document.getElementById("category");
    if (document.getElementById("category").selectedIndex == 0) {
        slanjeForme = false;
        poljeCategory.style.border = "1px solid red";
        porukaKategorija.style.color = "red";
        document.getElementById("porukaKategorija").innerHTML = "Kategorija mora biti odabrana!<br>";
    }
    else {
        poljeCategory.style.border = "1px solid green";
        document.getElementById("porukaKategorija").innerHTML = "";
    }
    if (slanjeForme != true) {
        event.preventDefault();
    }
  };
</script>


