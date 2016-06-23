<!DOCTYPE html>
<html>
    <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 18px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">FindAndCompare</div>
                <form method="post" action="/findCompare">
                    <hr />
                    <label>URL Number 1 </label><input type="text" name="url1" placeholder="http://www.URL 1"></input><br />
                    <label>URL Number 2 </label><input type="text" name="url2" placeholder="http://www.URL 2"></input><br />
                    <hr />
                    <?php echo csrf_field(); ?>
                    <input type="submit" value="FindAndCompare" ></input>
                </form>
            </div>
        </div>
    </body>
</html>
