<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js" type="text/javascript"></script>
<script src="js/short.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body class="pattern-bg">
  <div class="page-header">
    <h1>Shorten all the things</h1>
    <a href="https://github.com/you"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_right_gray_6d6d6d.png" alt="Fork me on GitHub"></a>
  </div>
<center>
  <form method="POST" action="javascript:getShortUrl()">
    <input id="url" type="text" placeholder="http://reddit.com/r/programming" />
    <input class="btn" value="Shorten" type="submit">
  </form>
 <div id="result"></div>
</center>
</div>
</body>
</html>