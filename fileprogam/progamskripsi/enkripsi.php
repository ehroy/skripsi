<!doctype html>
<html lang="en">
  <head>
    <title>Enkripsi Base64</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- BLOG BUGABAGI -->
    <!-- Style -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" >
    <link rel="stylesheet" href="assets/css/style.css" >
    <!-- JS -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </head>
  <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
          </button>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
            <li><a href="#enkripsi">ENKRIPSI</a></li>
            <li><a href="dekripsi.php">DEKRIPSI</a></li>
          </ul>
        </div>
      </div>
    </nav> 

    <div class="container-fluid bg-cover" id="enkripsi" style="margin-top:0px;">
      <div class="page-header">
        <h3><b>ENKRIPSI FILE PDF</b></h3> 
      </div>
        <div class="col-md-4">
            <form method="post" enctype="multipart/form-data">
              <label>Masukan File Berformat PDF   :</label>
              <div class="form">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span>
                  <input id="upload" type="file" class="form-control" name="result">
                </div>
                <div>
                  <br>
                    <input id="key" type="text" class="form-control" name="key" placeholder="masukan kunci">
                  <br>
                </div>
                <br>
                <button class="btn btn-primary btn-lg" type="submit" id="submit" name="submit">Enkripsi  <span class="glyphicon glyphicon-lock" aria-hidden="true"></span></button><br><br>
              </div>
            </form>
        </div>
        <div class="col-md-8">
                <?php
                include_once("./lib/functionbase64.php");
                include_once("./lib/functionAES.php");
                $startTime = microtime(true);
           
           

                $valid_array = array('jpg','jpeg','png','gif','bmp','mp4','docx','pdf');
                if(isset($_POST['submit']) && $_FILES['result']['size']>0){
                  $keyencrypt = $_POST['key'];
                  // print_r($keyencrypt);

                  $ext = @strtolower(end(@explode('.', $_FILES['result']['name'])));

                  if(in_array($ext, $valid_array)){

                    move_uploaded_file($_FILES['result']['tmp_name'], 'result/'.$_FILES['result']['name']);
                    
          $enkripsi = my_base64_encode(file_get_contents('result/'.$_FILES['result']['name'])); 
          
          $aes = new Aes($keyencrypt);

          // $a2 = hex2bin($a);
          $hasil = $aes->encrypt($enkripsi);
          echo "Time:  " . number_format(( microtime(true) - $startTime), 4) . " Seconds\n";
          // print_r(base64_encode($hasil));
          ?>
            <h4>Hasil Enkripsi Base64</h4>
                <form method="post" action="getTxt.php">
                <textarea name="txt" class="form-control" rows="12" id="comment"><?php echo ($enkripsi); ?></textarea><br>
                <label style="color:yellow;">Salin untuk digunakan saat dekripi /</label>
                <button type="submit" class="btn btn-success" href="gettxt.php">Unduh .txt</button>
            <h4>Hasil Enkripsi Chipertext dari Base64 menggunakan Kunci</h4>
                <form method="post" action="getTxt.php">
                <textarea name="txt" class="form-control" rows="12" id="comment"><?php echo my_base64_encode($hasil); ?></textarea><br>
                <label style="color:yellow;">Salin untuk digunakan saat dekripi /</label>
                <button type="submit" class="btn btn-success" href="gettxt.php">Unduh .txt</button>
                <!-- <a class="btn btn-success" type="submit" href="getTxt.php">Get .txt</a> -->
                </form>

                <?php 
              }else{

                echo "<br><div class='alert alert-danger'><strong>Maaf... file yang ada pilih bukan file gambar. Hanya file JPG, PNG, GIF, BMP atau PSD yang boleh diupload..!</strong></div>";

              }

              }?>
                
                
        </div>
    </div>

    <!-- JavaScript -->
    <script>
      $(document).ready(function(){
        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {

          // Prevent default anchor click behavior
          event.preventDefault();

          // Store hash
          var hash = this.hash;

          // Using jQuery's animate() method to add smooth page scroll
          // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
          $('html, body').animate({
            scrollTop: $(hash).offset().top
          }, 900, function(){

            // Add hash (#) to URL when done scrolling (default click behavior)
            window.location.hash = hash;
            });
          } // End if 
        });
      });
    </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  </body>
</html>