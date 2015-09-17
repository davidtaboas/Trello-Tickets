<!DOCTYPE html>
<html>
    <head>
        <title>All Boards | Trello</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/style.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Boards</div>
                <ul>
                <?php

                foreach($boards as $board){
                    echo "<li><a href='/trello/{$board["id"]}'>{$board["name"]}</a></li>";
                }
                ?>
                </ul>
            </div>
            <form action="/logout" method="get">
                <input type="submit" value="Logout">
            </form>
        </div>
    </body>
</html>
