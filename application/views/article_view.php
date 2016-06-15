<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>[[page_title]]</title>

    <!-- Bootstrap -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/mini-cms.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body  ng-app="CMSApp">
    <h1>[[page_heading]]</h1>
    <div id="container" class="container">
        <h1 class="heading"><span id="article-title"></span><a href="/" class="pull-right"><i class="glyphicon glyphicon-home"></i></a></h1>
        <h3 class="subheading" id="subheader"></h3>
        <div id="article-details">by <span id="author"></span> &nbsp; Published on <span id="date_published"></span></div>
        <div id="article" class="article">
            <img src="" id="article-image" class="img-responsive pull-left article-image"> <span id="article-content"></span>
        </div>
        <button name="article-more" id="article-more" class="btn">read more</button>
    </div>
    <script>var article_id = [[article_id]];</script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/bower_components/jquery/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/js/article.js"></script>
  </body>
</html>