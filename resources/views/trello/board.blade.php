<!DOCTYPE html>
<html>
    <head>
        <title>Send Ticket | Trello</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="/style.css" rel="stylesheet" type="text/css">



    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">NEW TICKET</div>
                <a class="button" href="/trello">All Boards</a>
                {!! Form::open(['url'=>'/trello/createticket','method'=>'PUT']) !!}

                  <div class="field">
                    <div class="select-wrapper">
                      <select name="topic" id="topic">
                        <?php foreach($topics as $topic):
                          echo("<option value='{$topic["name"]}'>{$topic["name"]}</option>");
                        endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="field">
                    <input type="text" name="title" id="title" placeholder="Title" />
                  </div>
                  <div class="field">
                    <textarea name="description" id="description" placeholder="Descripcion" rows="4"></textarea>
                  </div>
                  <!--
                  <div class="field">
                    <input type="checkbox" id="human" name="human" /><label for="human">I'm a human</label>
                  </div>
                  -->
                  <div class="field">
                    <label>Who you are?</label>
                    <?php foreach($members as $member):
                      echo "<input type='radio' id='member_{$member["id"]}' name='member' value='{$member["id"]}'/><label for='member_{$member["id"]}'>{$member["fullName"]}</label><br/>";
                    endforeach; ?>
                  </div>
                  <div class="field">
                    <label>Priority?</label>
                    <input type="radio" id="priority_high" name="priority" value="top"/><label for="priority_high">High</label>
                    <input type="radio" id="priority_low" name="priority" checked="checked" value="bottom"/><label for="priority_low">Basic</label>
                  </div>
                  <ul class="actions">
                    <input type="hidden" name="backlog" value="<?php echo $backlog; ?>" />
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" value="Send ticket" />
                  </ul>

                  {!! Form::close() !!}

                  <form action="/logout" method="get">
                      <input type="submit" value="Logout">
                  </form>
            </div>
        </div>
    </body>
</html>
