<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<img id="edit-me" class="img-responsive" src="../uploads/player/A-Cat-Snatching-Wires-Out-of-a-Server.jpg" width="500" height="375" alt=""/>

</body> <script src="../Scripts/jquery-1.11.2.min.js"></script>
<script data-preload="true" data-path="../pixie/" src="../pixie/pixie-integrate.js"></script>

<script>
    var myPixie = Pixie.setOptions({
        replaceOriginal: true,
        appendTo: 'body'
    });

    $('#edit-me').on('click', function(e) {
        myPixie.open({
            url: e.target.src,
            image: e.target
        });
    });
</script>
</html>