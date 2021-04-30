<div class="modal fade" id="notification" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Benachrichtigungen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Sweetalert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

<script>
    GetNotification();

    setInterval(() => {
        GetNotification();
    }, 5000);

    function AddRequest(id, avatar, username) {
        $(".modal-body").append('<div class="box" id="friend_' + id + '" style="margin-bottom:15px;">\n\
        \n\<div class="row">\n\
        \n\<div class="col-md-2">\n\
        \n\ <center>\n\
        \n\<img src="' + avatar + '" class="avatar" style="margin-top:10px;height:50px;max-width:50px;">\n\
        \n\</center>\n\
        \n\</div>\n\
        \n\<div class="col-md-10">\n\
        \n\<b style="color:black;">' + username + '</b>\n\
        \n\<p style="color:black;">hat dir eine Freundschaftsanfrage geschickt</p>\n\
        \n\</div>\n\
        \n\<div class="col-md-2"></div>\n\
        \n\<div class="col-md-5">\n\
        \n\<button class="button green" onclick="AcceptFriend(' + id + ');">\n\
        \n\<i class="fas fa-check"></i>\n\
        \n\</button>\n\
        \n\</div>\n\
        \n\<div class="col-md-5">\n\
        \n\<button class="button red" onclick="DeclineFriend(' + id + ');">\n\
        \n\<i class="fas fa-times"></i>\n\
        \n\</button>\n\
        \n\</div>\n\
        \n\</div>\n\
        \n\</div>\n\
        ');
    }

    function GetNotification() {
        let i = 0;
        ClearNotification();
        $.get("<?php echo $_SITE['path'] . '/public/load/notification.php' ?>", {
                type: 't'
            })
            .done(function(data) {
                for (x in data) {
                    i++;

                    AddRequest(data[x].id, data[x].avatar, data[x].username);

                }
                document.getElementById("count_notification").innerHTML = i;
                console.log("YES");
            });
    }


    function AcceptFriend(id) {
        $.post("<?php echo $_SITE['path'] . '/public/load/user.php' ?>", {
                id: id,
                type: 'accept_friend'
            })
            .done(function(data) {
                if (data.type == 'success') {
                    document.getElementById("friend_" + id).remove();
                    GetNotification();
                }
            });
    }

    function DeclineFriend(id) {
        $.post("<?php echo $_SITE['path'] . '/public/load/user.php' ?>", {
                id: id,
                type: 'decline_friend'
            })
            .done(function(data) {
                document.getElementById("friend_" + id).remove();
                GetNotification();
            });
    }
    
    function ClearNotification() {
        $(".modal-body").html("");
        $(".modal-body").html("");
        $(".modal-body").html("");
    }
</script>
</body>

</html>