<!doctype html>
<html lang="en">
  <head>
    <title>Enkripsi Base64</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

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
            <li><a href="enkripsi.php">ENKRIPSI</a></li>
            <li><a href="#dekripsi">DEKRIPSI</a></li>
          </ul>
        </div>
      </div>
    </nav> 

    <div class="container-fluid bg-cover" id="dekripsi" style="margin-top:0px;">
      <div class="page-header">
        <h3><b>DEKRIPSI GAMBAR</b></h3> 
      </div>
      <div class="col-md-12">
          <form method="post" enctype="multipart/form-data">
            <label>Masukan Plaintext   :</label>
              <div class="form">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-font"></i></span>
                  <textarea class="form-control" rows="12" id="comment" name="teks"></textarea>
                </div>
                <div>
                  <br>
                    <input id="key" type="text" class="form-control" name="key" placeholder="masukan kunci">
                  <br>
                </div>
                <br>
                <button class="btn btn-primary btn-lg" type="submit" id="submit" name="submit">Dekripsi  <span class="glyphicon glyphicon-picture" aria-hidden="true"></span></button>
              </div>
          </form>
        </div>
        
    </div>
<!-- BLOG BUGABAGI -->
    

    

    <div id="dekripsi" class="container-fluid bg-1" style="margin-top:0px;">
        <div class="col-md-12">
          <h3>Hasil Dekripsi</h3>
          <hr>
          <?php
            include_once("./lib/functionAES.php");
            include_once("./lib/functionbase64.php");

            if(isset($_POST['submit'])){
              $teks = @$_POST['teks'];
              $keyencrypt = $_POST['key'];
              $decode = my_base64_decode($teks);
              $aes = new Aes($keyencrypt);

              // $a2 = hex2bin($a);
              $hasil = $aes->decrypt($decode);
              // print_r($hasil);
          ?>
          <br>
          <embed width='1366px' height='623px'frameborder='0' type="application/pdf" src="data:application/pdf;base64,<?php echo $hasil; ?>"></embed>

          <!-- <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=http://remote.url.tld/path/to/document.doc',href="application/vnd.openxmlformats-officedocument.wordprocessingml.document;base64,<?php echo $teks;?>" width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe> -->
          <!-- <a href="application/vnd.openxmlformats-officedocument.wordprocessingml.document;base64,<?php echo $teks;?>" download="hasil.docx" target="blank">Download</a> -->
          <!-- <img style="" border="0" src="application/vnd.openxmlformats-officedocument.wordprocessingml.document;base64,<?php echo $teks;?>" class = "img-thumbnail img-responsive"> -->
        </div>
          <?php
            }
          ?>        
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