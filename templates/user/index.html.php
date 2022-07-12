<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
</head>
    <body class="container">
        <div class="col-lg-5">
            <form method="post" name="form">
                    <label for="name" class="form-label">User</label>
                    <input type="text" class="form-control" id="nameUser" placeholder="Nombre">
                    <button type="button" id= "btnaddUser" class="btn btn-primary">Guardar</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
        <script src="../assets/js/ajax.user.js"></script>
        <label>Cola 1</label>
        <table id="cola1">
            <tbody></tbody>
        </table>
        <br>
        <label>Cola 2</label>
        <table id="cola2">
            <tbody></tbody>
        </table>

    </body>
</html>