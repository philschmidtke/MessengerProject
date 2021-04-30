<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="chat_box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="chat_header">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="<?php echo $_SITE['path'] ?>/public/img/main/<?php echo $user->avatar ?>" style="max-width:35px;">
                                </div>
                                <div class="col-md-1">

                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <?php if ($url != 'index') { ?>
                                            <div class="col-md-1">
                                                <img src="<?php echo $_SITE['path'] ?>/public/img/main/<?php echo $row->avatar ?>" style="max-width:35px;">
                                            </div>
                                            <div class="col-md-11">
                                                <p style="color:white;"><?php echo $row->username ?></p>

                                            </div>
                                        <?php } else { ?>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="chat_search">
                            <input type="text" placeholder="Suchen...." oninput="UserSearch()" id="user_search">
                        </div>
                        <div class="chat_contact" id="chat_contact">

                        </div>
                    </div>
                    <div class="col-md-8">
                        <?php if ($url != 'index') { ?>
                            <div class="chat_messagecontainer" id="chat_messagecontainer">

                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <input type="text" class="input" placeholder="Deine Nachricht..." id="message">
                                </div>
                                <div class="col-md-2">
                                    <button class="button green" onclick="SendMessage();" style="width:90%;">
                                        <i class="fas fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                        <?php } else { ?>
                            <h1 style="margin-top:43%;color:white;">
                                <center>CHAT</center>
                            </h1>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var chats = [];

    window.onload = function () {
        LoadMessage();
        UserSearch();

        $(document).keydown(function (e) {
            if (e.keyCode == 13) {
                SendMessage();
            }
        });

    }


    setInterval(() => {
        LoadMessage();
    }, 1000);


    setInterval(() => {
        UserSearch();
    }, 30000);


    function AddContactForFriend(username, avatar, id) {
        $(".chat_contact").append('<div  class="chat_user">\n\
                \n\<div class="row">\n\
                \n\<div class="col-md-3">\n\
                \n\<img src="<?php echo $_SITE['path'] ?>/public/img/main/' + avatar + '" style="max-width:50px;">\n\
                \n\</div>\n\
                \n\<div class="col-md-6">\n\
                \n\<p style="margin-top:15px;"><b>' + username + '</b></p>\n\
                \n\</div>\n\
                \n\<div class="col-md-3">\n\
                \n\<button class="button green" onclick="SendRequest(' + id + ')" style="width:auto;margin-top:2px;padding-left:20px;padding-right:20px;" id="friend_' + id + '">\n\
                \n\<i class="fas fa-user-plus"></i>\n\
                \n\</button>\n\
                \n\</div>\n\
                \n\</div>\n\
                \n\</div>\n\
            ');
    }

    function AddContact(username, avatar, id, message, count) {
        if (count == 0) {
            $(".chat_contact").append('<a href="<?php echo $_SITE['path'] ?>/chat/' + id + '" class="chat_user">\n\
                \n\<div class="row">\n\
                \n\<div class="col-md-3">\n\
                \n\<img src="<?php echo $_SITE['path'] ?>/public/img/main/' + avatar + '" style="max-width:50px;">\n\
                \n\</div>\n\
                \n\<div class="col-md-9">\n\
                \n\<p style="margin-top:15px;"><b>' + username + '</b></p>\n\
                \n\</div>\n\
                \n\</div>\n\
                \n\</div>\n\
            ');
        } else {
            $(".chat_contact").append('<a href="<?php echo $_SITE['path'] ?>/chat/' + id + '" class="chat_user">\n\
                \n\<div class="row">\n\
                \n\<div class="col-md-3">\n\
                \n\<img src="<?php echo $_SITE['path'] ?>/public/img/main/' + avatar + '" style="max-width:50px;">\n\
                \n\</div>\n\
                \n\<div class="col-md-9">\n\
                \n\<p style="margin-top:15px;"><b>' + username + '</b> <span class="badge bg-warning text-dark">' + count + '</span></p>\n\
                \n\</div>\n\
                \n\</div>\n\
                \n\</div>\n\
            ');
        }
    }

    function UserSearch() {
        ClearContacts();

        var text = document.getElementById("user_search").value;

        if (text.trim() == "") {
            $.post("<?php echo $_SITE['path'] . '/public/load/chat.php' ?>", {
                type: "getlist"
            })
                    .done(function (data) {
                        ClearContacts();
                        for (x in data) {
                            if (data[x].message == null) {
                                data[x].message = ""
                            }
                            AddContact(data[x].username, data[x].avatar, data[x].id, data[x].message, data[x].count);
                        }
                    });
        } else {
            $.post("<?php echo $_SITE['path'] . '/public/load/user.php' ?>", {
                type: "all",
                username: text
            })
                    .done(function (data) {
                        ClearContacts();
                        for (x in data) {
                            AddContactForFriend(data[x].username, data[x].avatar, data[x].id);

                            if (data[x].status == 1) {
                                text = "friend_" + data[x].id
                                var element = document.getElementById(text);
                                element.classList.remove("green");
                                var element = document.getElementById(text);
                                element.classList.add("yellow");
                                document.getElementById(text).innerHTML = '<i class="fas fa-clock"></i>';
                                document.getElementById(text).removeAttribute("onclick");
                            } else if (data[x].status == 2) {
                                text = "friend_" + data[x].id
                                var element = document.getElementById(text);
                                element.classList.remove("green");
                                var element = document.getElementById(text);
                                element.classList.add("blue");
                                document.getElementById(text).innerHTML = '<i class="fas fa-comment"></i>';
                                document.getElementById(text).removeAttribute("onclick");
                                document.getElementById(text).setAttribute("onclick", "BeginChat(" + data[x].id + ")");
                            }
                        }
                    });
        }
    }


    function ClearContacts() {
        $("#chat_contact").html("");
        $("#chat_contact").html("");
        $("#chat_contact").html("");
    }

    function SendRequest(id) {
        $.post("<?php echo $_SITE['path'] . '/public/load/user.php' ?>", {
            type: "add",
            id: id
        })
                .done(function (data) {
                    if (data.type == 'success') {
                        text = "friend_" + id
                        var element = document.getElementById(text);
                        element.classList.remove("green");
                        var element = document.getElementById(text);
                        element.classList.add("yellow");
                        document.getElementById(text).innerHTML = '<i class="fas fa-clock"></i>';
                        document.getElementById(text).removeAttribute("onclick");
                    }

                    Swal.fire({
                        position: 'top-end',
                        icon: data.type,
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
    }

    function RemoveFriend(id) {
        $.post("<?php echo $_SITE['path'] . '/public/load/user.php' ?>", {
            type: "remove",
            id: id
        })
                .done(function (data) {
                    if (data.type == 'success') {
                        text = "friend_" + id
                        var element = document.getElementById(text);
                        element.classList.remove("red");
                        var element = document.getElementById(text);
                        element.classList.add("green");
                        document.getElementById(text).innerHTML = '<i class="fas fa-user-plus"></i>';
                    }

                    Swal.fire({
                        position: 'top-end',
                        icon: data.type,
                        title: data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    })
                });
    }


    function BeginChat(id) {
        $.post("<?php echo $_SITE['path'] . '/public/load/chat.php' ?>", {
            type: "create",
            id: id
        })
                .done(function (data) {
                    window.location = "<?php echo $_SITE['path'] ?>/chat/" + data.id
                });
    }



    function ClearMessage() {
        //chat_messagecontainer
        $("#chat_messagecontainer").html("");
        $("#chat_messagecontainer").html("");
        $("#chat_messagecontainer").html("");
    }


    function AddMessage(type, message, date) {
        if (type == 1) {
            $(".chat_messagecontainer").append('<div class="row">\n\
                \n\<div class="col-md-6"></div>\n\
                \n\<div class="col-md-6">\n\
                \n\<div class="chat_messagebox">' + message + '<br><br>\n\
                \n\ <small style="color:#e0e0e0;font-size:10px;float:right;">' + date + '</small>\n\
                \n\</div>\n\
                \n\</div>\n\
                \n\</div>\n\
            ');
        }

        if (type == 2) {
            $(".chat_messagecontainer").append('<div class="row">\n\
                \n\<div class="col-md-6">\n\
                \n\<div class="chat_messagebox">' + message + '<br><br>\n\
                \n\ <small style="color:#e0e0e0;font-size:10px;float:right;">' + date + '</small>\n\
                \n\</div>\n\
                \n\</div>\n\
                \n\<div class="col-md-6"></div>\n\
                \n\</div>\n\
            ');
        }
    }

    function SendMessage() {
        text = document.getElementById("message").value

        $.post("<?php echo $_SITE['path'] . '/public/load/chat.php' ?>", {
            type: "send",
            chat: "<?php echo $chat->id ?>",
            message: text
        })
                .done(function (data) {
                    console.log("Erfolg");
                    if (data.type == 'success') {
                        document.getElementById("message").value = ""
                        AddMessage('1', text, data.time);
                        chats.push(data.id);
                        ScrollDown();
                        UserSearch();
                    } else {
                        console.log(data.msg);
                    }
                });

    }

    function LoadMessage() {
        mykey = localStorage.getItem('<?php echo $user->username ?>');

        $.post("<?php echo $_SITE['path'] . '/public/load/chat.php' ?>", {
            type: "load",
            chat: "<?php echo $chat->id ?>",
            mykey: mykey
        })
                .done(function (data) {
                    for (x in data) {
                        if (chats.includes(data[x].id) == false) {
                            AddMessage(data[x].type, data[x].message, data[x].date);
                            chats.push(data[x].id);
                            DeleteMessage(data[x].id);
                            ScrollDown();
                            UserSearch();
                        }
                    }
                });
    }

    function ScrollDown() {
        var objDiv = document.getElementById("chat_messagecontainer");
        objDiv.scrollTop = objDiv.scrollHeight;
    }

    function DeleteMessage(id) {
        $.post("<?php echo $_SITE['path'] . '/public/load/chat.php' ?>", {
            id: id,
            type: "delete"
        })
                .done(function (data) {
                    console.log(data.msg);
                });
    }
</script>