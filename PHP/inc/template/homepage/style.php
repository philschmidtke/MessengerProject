<style>
    body {
        background: #171717;
    }


    nav {
        height:50px;
        width:auto;
        padding-left:20px;
        padding-right:20px;
        background: #2A2F32;
        display:block;
        line-height:50px;
        margin-top:50px;
    }

    nav a {
        color:white;
        font-size: 30px;
        margin-right:20px;
        text-decoration: none;
    }

    nav a:hover {
        color:white;
        opacity:0.8;
    }

    .logo {
        color: white;
        margin-top: 100px;
        margin-bottom: 15px;
    }

    .box {
        display: block;
        width: 100%;
        height: auto;
        padding-top: 15px;
        padding-bottom: 15px;
        padding-right: 5px;
        padding-left: 5px;
        background: rgba(0, 0, 0, 0.1);
        color: white;
        border-radius: 4px;
    }

    .box.index {
        height: 500px;
    }

    .content {
        height: 360px;
        max-height: 360px;
        overflow: scroll;
        overflow-x: hidden;
        scrollbar-width: none;
        width: 100%;
        padding-left: 15px;
        padding-right: 15px;
    }

    .content::-webkit-scrollbar {
        width: 5px;
    }

    /* Track */
    .content::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.2);
    }

    /* Handle */
    .content::-webkit-scrollbar-thumb {
        background: #2A2F32;
    }


    .input {
        width: 100%;
        height: 50px;
        border: 0px;
        border-radius: 4px;
        background: rgba(0, 0, 0, 0.2);
        color: white;
        padding: 10px;
    }

    .input:focus {
        outline: none;
    }

    .input.index {
        margin-top: 0px;
    }

    footer.index {
        width: 100%;
        margin-top: 15px;
    }

    footer.index a {
        float: right;
        text-decoration: none;
        margin-left: 20px;
    }

    .chat_box {
        height: auto;
        width: 100%;
        background: #212121;
        margin-top: 10px;
    }

    .avatar {
        height: 100px;
        margin-top: 150px;
        border-radius: 50%;
        border: 2px solid rgba(0, 0, 0, 0.2);
    }

    .chat_header {
        height: 50px;
        background: #2A2F32;
        width: 100%;
        padding: 10px;
        padding-top: 9px;
        border-right: 1px solid rgba(0, 0, 0, 0.5);
    }

    .chat_header img {
        height: 35px;
        border-radius: 50%;
    }

    .chat_search {
        height: 50px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.5);
        border-right: 1px solid rgba(0, 0, 0, 0.5);
        padding: 10px;
    }

    .chat_search input {
        height: 30px;
        width: 100%;
        border: 0px;
        border-radius: 50px;
        padding: 15px;
        background: #2A2F32;
        color: white;
    }

    .chat_search input:focus {
        outline: none;
    }

    .chat_contact {
        height: 75vh;
        width: 100%;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .chat_contact::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    .chat_contact::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.2);
    }

    /* Handle */
    .chat_contact::-webkit-scrollbar-thumb {
        background: #2A2F32;
    }

    .chat_user {
        height: 80px;
        width: 100%;
        border-bottom: 1px solid rgba(0, 0, 0, 0.5);
        padding-top: 10px;
        padding-bottom: 10px;
        display: block;
        color: white;
        text-decoration: none;
    }

    .chat_user:hover {
        color: white;
    }

    .chat_user img {
        height: 50px;
        border-radius: 50%;
        margin-top: 5px;
        margin-left: 15px;
    }

    .chat_messagebox {
        height: auto;
        width: 98%;
        padding: 20px;
        background: #2A2F32;
        color: white;
        margin-bottom: 15px;
        border-radius:4px;
    }

    .chat_messagecontainer {
        min-height: 65vh;
        max-height: 65vh;
        overflow: scroll;
        overflow-x: hidden;
        scrollbar-width: none;
        margin-top: 30px;
        margin-bottom: 50px;
    }

    .chat_messagecontainer::-webkit-scrollbar {
        display: none;
    }

    .button {
        height: 50px;
        width: 100%;
        border: 0px;
        text-transform: uppercase;
        font-weight: lighter;
        display: block;
        text-decoration: none;
        text-align: center;
        line-height: 50px;
        border-radius:4px;
    }

    .button:focus {
        outline: none;
    }


    .button.blue {
        background: #2962ff;
        color: white;
    }

    .button.green {
        background: #4caf50;
        color: white;
    }

    .button.red {
        background: #f44336;
        color: white;
    }

    .button.yellow {
        background: #ffeb3b;
        color: black;
    }

    .alert.alert-danger {
        background: #f44336;
        border:0px;
        color:white;
    }

    .alert.alert-success {
        background:#4caf50;
        border:0px;
        color:white;
    }

    .alert.alert-info {
        background:#1a237e;
        border:0px;
        color:white;
    }
</style>