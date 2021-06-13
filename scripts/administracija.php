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
  </body>
</html>

<?php 
    session_start();
    include'connect.php';
    define('UPLPATH', '../resources/images/'); 
    
   
// Provjera da li je korisnik došao s login forme
if(isset($_POST['prijava'])) {
  // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona
  $prijavaImeKorisnika= $_POST['username'];
  $prijavaLozinkaKorisnika= $_POST['pass'];


  $sql= "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime =?";
  $stmt= mysqli_stmt_init($dbc);
  if(mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
  }
  mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
  mysqli_stmt_fetch($stmt);

  if(mysqli_stmt_num_rows($stmt) == 0){
    echo '<a href="registracija.php">Registriraj se!</a>';
  }

  //Provjera lozinke
  if(password_verify($prijavaLozinkaKorisnika, $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
    $uspjesnaPrijava= true;
    // Provjera da li je admin
    if($levelKorisnika== 1) 
    {
      $admin= true;
    } else {
      $admin= false;
    }
    //postavljanje session varijabli
    $_SESSION['$username'] = $imeKorisnika;
    $_SESSION['$level'] = $levelKorisnika;
  } else{
    $uspjesnaPrijava= false;
  }

  
}// Brisanje i promijena arhiviranosti?>

<?php
// Pokaži stranicu ukoliko je korisnik uspješno prijavljen i administrator je
if( isset($uspjesnaPrijava) &&  ($uspjesnaPrijava== true&& $admin== true) || (isset($_SESSION['$username'])) && $_SESSION['$level'] == 1) {
  echo '<a href="unos.php">Unesi novu vijest!</a>';
  $query= "SELECT * FROM articles";
  $result= mysqli_query($dbc, $query);
  while($row= mysqli_fetch_array($result)) {
    echo'<form enctype="multipart/form-data" action="" method="POST"><div class="form-item">
        <label for="title">Naslov vjesti:</label><div class="form-field">
        <input type="text" name="title" class="form-field-textual" value="'.$row['title'].'">
        </div></div><div class="form-item"><label for="about">Kratki sadržaj vijesti (do 50 znakova):
            </label><div class="form-field"><textarea name="about" id="" cols="30" rows="10" class="form-field-textual">'.$row['about'].'</textarea>
            </div></div><div class="form-item"><label for="content">Sadržaj vijesti:</label><div class="form-field">
            <textarea name="content" id="" cols="30" rows="10" class="form-field-textual">'.$row['content'].'</textarea>
            </div></div><div class="form-item"><label for="pphoto">Slika:</label><div class="form-field">
            <input type="file" class="input-text" id="pphoto" value="'.$row['picture'].'" name="pphoto"/>
            <br><img src="'. UPLPATH . $row['picture'] . '" width=100px>
            </div></div><div class="form-item"><label for="category">Kategorija vijesti:</label>
            <div class="form-field"><select name="category" id="" class="form-field-textual" value="'.$row['category'].'">
            <option value="sport">Sport</option><option value="kultura">Kultura</option></select></div></div><div class="form-item">
            <label>Spremiti u arhivu: <div class="form-field">';if($row['archive'] == 0) {echo'<input type="checkbox" name="archive" id="archive"/> Arhiviraj?';
    } else{
        echo'<input type="checkbox" name="archive" id="archive" checked/> Arhiviraj?';
    } 
    echo'</div></label></div></div><div class="form-item"><input type="hidden" name="id" class="form-field-textual" value="'.$row['id'].'">
    <button type="reset" value="Poništi">Poništi</button><button type="submit" name="update" value="Prihvati"> Izmjeni</button>
    <button type="submit" name="delete" value="Izbriši"> Izbriši</button></div></form><br><br>';
  }

  if(isset($_POST['delete'])){
    $id=$_POST['id'];$query = "DELETE FROM articles WHERE id=$id";
    $result= mysqli_query($dbc, $query);
}

if(isset($_POST['update'])){
    $picture= $_FILES['pphoto']['name'];
    $title=$_POST['title'];
    $about=$_POST['about'];
    $content=$_POST['content'];
    $category=$_POST['category'];

    if(isset($_POST['archive'])){
        $archive=1;
    }else{
        $archive=0;
    }
    $target_dir= '../resources/images/'.$picture;
    move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_dir);
    $id=$_POST['id'];$query= "UPDATE article SET title='$title', about='$about', content='$content', picture='$picture', category='$category', archive='$archive' WHERE id=$id";
    $result= mysqli_query($dbc, $query);
}

  // Pokaži poruku da je korisnik uspješno prijavljen, ali nije administrator
} elseif(isset($uspjesnaPrijava) && $uspjesnaPrijava== true&& $admin== false) {
  echo'<p>Bok '. $imeKorisnika. '! Uspješno ste prijavljeni, ali niste administrator.</p>';
} elseif(isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {
echo'<p>Bok '. $_SESSION['$username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
} elseif(!isset($uspjesnaPrijava) || $uspjesnaPrijava== false) {
  ?>
<section role="main">
  <form enctype="multipart/form-data"action=""method="POST">
    <input type="hidden" name="prijava" value="0">
    <div class="form-item">
      <span id="porukaUsername"class="bojaPoruke"></span>
      <label for="content">Korisničko ime:</label>      
      <div class="form-field">
        <input type="text"name="username"id="username"class="form-field-textual">
      </div>
    </div>
    <div class="form-item">
      <span id="porukaPass"class="bojaPoruke"></span>
      <label for="pphoto">Lozinka: </label>
      <div class="form-field">
        <input type="password"name="pass"id="pass"class="form-field-textual">
      </div>
    </div>
    <div class="form-item">
      <button type="submit"value="Prijava"id="slanje">Prijava</button>
    </div>
    </form>
    <?php
      if(isset($uspjesnaPrijava)){
        echo "<h3>Pogrešna lozinka</h3>";
      }
    ?>
</section>
  
<script type="text/javascript">
document.getElementById("slanje").onclick= function(event) {
        // Korisničko ime mora biti uneseno
        var poljeUsername= document.getElementById("username");
        var username= document.getElementById("username").value;
        if(username.length== 0) {
            slanjeForme= false;
            poljeUsername.style.border="1px dashed red";
            document.getElementById("porukaUsername").innerHTML="<br>Unesite korisničko ime!<br>";
        } else{
            poljeUsername.style.border="1px solid green";
            document.getElementById("porukaUsername").innerHTML="";
        }
        // Provjera podudaranja lozinki
        var poljePass= document.getElementById("pass");
        var pass= document.getElementById("pass").value;
        if(pass.length== 0) {
            slanjeForme= false;
            poljePass.style.border="1px dashed red";            
            document.getElementById("porukaPass").innerHTML="<br>Lozinke nisu iste!<br>";
        } else{
            poljePass.style.border="1px solid green";
            document.getElementById("porukaPass").innerHTML="";
        }
        if(slanjeForme!= true) {
            event.preventDefault();
        }
    };
</script>

<?php     
}
?>