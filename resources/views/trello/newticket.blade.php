<!DOCTYPE html>
<html>
    <head>
        <title>Single Ticket | Trello</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/style.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title"><?php echo $ticketTitle; ?></div>
                <br/>
                <a class="button" href="/trello">All Boards</a>
                <br/>
                <ul class="actions">
                  <li><a href="<?php echo $ticketURL; ?>"><i class="fa fa-trello"></i> Link to Trello</a></li>
                </ul>
            </div>
            <form action="/logout" method="get">
                <input type="submit" value="Logout">
            </form>
        </div>
    </body>
</html>
