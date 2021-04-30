<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert" style="margin-top:15px;">
                Speicher dir deinen Schlüssel unbedingt lokal ab z.B. in einem Passwortmanager!
            </div>
            <div class="chat_box">
                <?php if ($error == true) { ?>
                    <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> <?php echo $msg ?>
                    </div>
                <?php } ?>
                <?php if ($success == true) { ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fas fa-check-square"></i> <?php echo $msg ?>
                    </div>
                <?php } ?>
                <div class="chat_header" style="height:70px;padding:18px;">
                    <h3 style="color:white;"><i class="fas fa-cog"></i> Einstellungen</h3>
                </div>
                <div style="padding:20px;padding-top:0px;">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 style="color:white;margin-top:50px;">Passwort ändern</h3>
                            <form action="" method="POST">
                                <input type="password" class="input" name="old" placeholder="Aktuelles Passwort" style="margin-bottom:15px;">

                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="password" class="input" name="new" placeholder="Neues Passwort" style="margin-bottom:15px;">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" class="input" name="wdh" placeholder="Passwort wiederholen" style="margin-bottom:15px;">
                                    </div>
                                </div>

                                <button class="button green" name="submit">
                                    Speichern
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h3 style="color:white;margin-top:50px;">Avatar ändern</h3>

                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">
                                        <input type="file" class="input" style="border:0;" name="file">
                                    </div>

                                    <div class="col-md-4">
                                        <button class="button green" name="upload">
                                            Hochladen
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h3 style="color:white;margin-top:50px;">Dein Schlüssel</h3>
                            <input type="text" id="mykey" class="input" value="" placeholder="Mein Key" style="margin-bottom:15px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="button red" onclick="ResetKey();">Schlüssel zurücksetzen</button>
                                </div>
                                <div class="col-md-6">
                                    <button class="button green" onclick="SaveKey();">Speichern</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

    getKey();

    function getKey() {
        document.getElementById("mykey").value = localStorage.getItem('<?php echo $user->username ?>');
    }

    function SaveKey() {
        text = document.getElementById("mykey").value;

        if (text.trim() != "") {
            localStorage.removeItem('<?php echo $user->username ?>');
            localStorage.setItem('<?php echo $user->username ?>', text);

            Swal.fire({
                position: 'top-end',
                icon: "success",
                title: "Erfolgreich gespeichert!",
                showConfirmButton: false,
                timer: 1500
            })
        }
    }

    function ResetKey() {
        $.post("<?php echo $_SITE['path'] . '/public/load/settings.php' ?>", {
            type: "resetkey"
        })
                .done(function (data) {
                    localStorage.removeItem('<?php echo $user->username ?>');
                    localStorage.setItem('<?php echo $user->username ?>', data.key);
                    document.getElementById("mykey").value = data.key;
                });
    }

</script>