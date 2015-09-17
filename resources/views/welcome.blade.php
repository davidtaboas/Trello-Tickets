<!DOCTYPE html>
<html>
    <head>
        <title>Trello Tickets</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/style.css" rel="stylesheet" type="text/css">

        <script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="//api.trello.com/1/client.js?key=5a74c1310f7d58fd4daf07a6df84b25d"></script>
        <script type="text/javascript">
        function AuthenticateTrello() {
          Trello.authorize({
            name: "Trello Tickets",
            type: "popup",
            interactive: true,
            expiration: "never",
            persist: true,
            success: function () { onAuthorizeSuccessful(); },
            scope: { write: true, read: true },
          });
        }
        function onAuthorizeSuccessful() {
          var token = Trello.token();
          window.location.replace("/auth?token=" + token);
        }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Trello Tickets</div>




                <a href="javascript:void(0)" onClick="AuthenticateTrello()">Connect With Trello</a>
            </div>
        </div>
    </body>
</html>
