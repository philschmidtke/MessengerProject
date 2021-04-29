<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">


  <?php include('./inc/template/homepage/style.php'); ?>

  <title><?php echo $_SITE['name'] ?></title>
</head>

<body>


  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="logo">
          <center><?php echo $_SITE['name'] ?></center>
        </h1>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <div class="box index">
          <h2 style="margin-bottom:30px;">
            <center>{TEST}</center>
          </h2>

          <div class="content" id="content"></div>

          <input type="text" class="input index" id="input_message" autocomplete="on" placeholder="Antwort eingeben....">
        </div>
      
        <footer class="index">
          <a href="" target="_blank">Github</a>

        </footer>

      </div>
      <div class="col-md-2"></div>
    </div>
  </div>

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    let status = 0;

    window.onload = function() {
      AddMessage("Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam <br> <b>1. Einloggen</b> <br> <b>2. Registrieren</b>", 1);
    };

    $(document).keydown(function(e) {
      if (e.keyCode == 13) {
        const text = document.getElementById("input_message").value;

        switch (status) {
          //Startseite
          case 0:
            switch (text) {
              //Einloggen
              case "1":
                document.getElementById("input_message").value = "";

                AddMessage("<b>Einloggen</b>", 2);
                ScrollDown()
                setTimeout(function() {
                  AddMessage("Gebe deine Username ein", 1);
                  ScrollDown()
                }, 500);

                status = 1;
                break;

                //Registrieren
              case "2":
                document.getElementById("input_message").value = "";
                AddMessage("<b>Registrieren</b>", 2);
                ScrollDown()
                setTimeout(function() {
                  AddMessage("Wähle einen Usernamen", 1);
                  ScrollDown()
                }, 500);

                status = 2;
                break;
            }
            break;

            //Einloggen -> Username
          case 1:

            $.post("<?php echo $_SITE['path'] . '/public/load/index.php' ?>", {
                status: "1",
                username: text
              })
              .done(function(data) {
                AddMessage(text, 2);
                ScrollDown()

                if (data.type == 'error') {
                  AddMessage("Fehler: " + data.msg + ". Bitte probiere es erneut!", 1);
                  ScrollDown()
                } else if (data.type == 'success') {
                  AddMessage(data.msg, 1);
                  document.getElementById("input_message").value = ""
                  ScrollDown()
                  status = 11;
                  document.getElementById("input_message").type = "password"
                }
              });



            break;
            //Einloggen -> Passwort
          case 11:

            $.post("<?php echo $_SITE['path'] . '/public/load/index.php' ?>", {
                status: "11",
                password: text
              })
              .done(function(data) {
                AddMessage("**********", 2);
                ScrollDown()

                if (data.type == 'error') {
                  AddMessage("Fehler: " + data.msg + ". Bitte probiere es erneut!", 1);
                  ScrollDown()
                } else if (data.type == 'success') {
                  window.location = "<?php echo $_SITE['path'] . '/chat' ?>";
                }
              });


            break;
            //Registrieren -> Username
          case 2:
            $.post("<?php echo $_SITE['path'] . '/public/load/index.php' ?>", {
                status: "2",
                username: text
              })
              .done(function(data) {
                AddMessage(text, 2);
                ScrollDown()

                if (data.type == 'error') {
                  AddMessage("Fehler: " + data.msg + ". Bitte probiere es erneut!", 1);
                  ScrollDown()
                } else if (data.type == 'success') {
                  AddMessage(data.msg, 1);
                  document.getElementById("input_message").value = ""
                  ScrollDown()
                  status = 22;
                  document.getElementById("input_message").type = "password"
                }
              });
            break;
            //Registrieren -> Passwort
          case 22:
            $.post("<?php echo $_SITE['path'] . '/public/load/index.php' ?>", {
                status: "22",
                password: text
              })
              .done(function(data) {
                AddMessage("*******", 2);
                ScrollDown()

                if (data.type == 'error') {
                  AddMessage("Fehler: " + data.msg + ". Bitte probiere es erneut!", 1);
                  ScrollDown()
                } else if (data.type == 'success') {
                  AddMessage(data.msg, 1);
                  document.getElementById("input_message").value = ""
                  ScrollDown()
                  status = 222;
                  document.getElementById("input_message").type = "password"
                }
              });
            break;

            //Registrieren -> Passwort wdh
          case 222:
            $.post("<?php echo $_SITE['path'] . '/public/load/index.php' ?>", {
                status: "222",
                password: text
              })
              .done(function(data) {
                AddMessage("*******", 2);
                ScrollDown()

                if (data.type == 'error') {
                  AddMessage("Fehler: " + data.msg + ". Bitte probiere es erneut!", 1);
                  ScrollDown()
                } else if (data.type == 'success') {
                  window.location = "<?php echo $_SITE['path'] . '/chat' ?>";
                }
              });
            break;
        }

      }
    });

    function AddMessage(message, side) {

      if (side == 1) {
        $(".content").append('<div class="row">\n\
        \n\<div class="col-md-4">\n\
        \n\<div class="chat_messagebox">\n\
        \n\ ' + message + ' \n\
        \n\</div>\n\
        \n\</div>\n\
        \n\<div class="col-md-4"></div>\n\
        \n\<div class="col-md-4"></div>\n\
        </div>');

      } else {
        $(".content").append('<div class="row">\n\
        \n\<div class="col-md-4"></div>\n\
        \n\<div class="col-md-4"></div>\n\
        \n\<div class="col-md-4">\n\
        \n\<div class="chat_messagebox">\n\
        \n\ ' + message + ' \n\
        \n\</div>\n\
        \n\</div>\n\
        </div>');
      }

    }


    function ScrollDown() {
      var objDiv = document.getElementById("content");
      objDiv.scrollTop = objDiv.scrollHeight;
    }
  </script>
</body>

</html>