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
    <body ng-app="CMSApp">
        <div id="container" class="container" ng-controller="CMSController">
            <div ng-hide="formEnabled">
                <h1 class="heading">[[page_heading]]</h1>
                <input type="text" ng-model="articleList.search" ng-keydown="exposeHiddenRecords()" class="input-field" id="article_search" placeholder="Search"> &nbsp;
                    <a href="javascript:void(0);" ng-click="toggleModal()" class="article-form-link"><i class="glyphicon glyphicon-plus-sign"></i> New Article</a> &nbsp;&nbsp; Order by: <a class="text-bold" id="publication_date" ng-click="toggleOrderBy()">Pub Date</a> | <a id="article_title_order" ng-click="toggleOrderBy()">Title</a> &nbsp;&nbsp; <a ng-click="toggleSort()">{{sortText}}</a>
                <div id="articles" ng-repeat="article in articleList | orderBy: (sortDir ? '+' : '-')+(orderRows ? 'published_timestamp' : 'title') | limitTo:pageSize | filter:articleList.search | object2Array">
                    <div class="row article-row">
                        <div class="article-image-box col-md-5"><img src="{{article.image}}" class="img-responsive article-image-thumb"></div>
                        <div class="article-content col-md-9"><h4><a ng-href="/article/{{article.title_slug}}">{{article.title}}</a> | {{article.date_published}}</h4>{{article.summary}} &nbsp; <a href="javascript:void(0);" ng-click="toggleModal()" id="article-{{article.id}}" class="article-form-link"><i class="glyphicon glyphicon-pencil"></i></a></div>
                    </div>
                </div>
                <button ng-disabled="pageSize >= articleList.length" class="btn btn-block btn-info" ng-click="pageSize = pageSize + 3">load more</button>
            </div>
            <div ng-show="formEnabled">
                <h1 class="heading" id="form-heading"></h1>
                <div id="articleForm">
                    <div class="modal-body">
                        <form id="article_form" class="form-inline" role="form">
                            <input type="hidden" name="article_id" id="article_id" value="">
                            <div class="control-group">
                                <div class="controls">
                                    <input type="text" name="article_title" id="article_title" class="article-input input-field input-lg" placeholder="Enter a title for your article.">
                                </div>
                                <div class="controls">
                                    <input type="text" name="article_subhead" id="article_subhead" class="article-input input-field input-lg" placeholder="Enter a subheading for your article.">
                                </div>
                                <div class="controls">
                                    <input type="text" name="article_author" id="article_author" class="article-input input-field input-lg" placeholder="Enter an author name for your article.">
                                </div>
                                <div class="controls">
                                    <input type="text" name="article_image" id="article_image" class="article-input input-field input-lg" placeholder="Paste and image for your article.">
                                </div>
                                <div class="controls">
                                    <textarea  name="article_content" id="article_content" class="article-input input-field input-lg" placeholder="Enter the main content of your article."></textarea>
                                </div>
                            </div>
                            <div class="margin_top_20"><button name="cancelOk" id="cancelOk" class="btn btn-lg" ng-click="closeModal()">Cancel</button> <button name="save_article" id="save_article" type="submit" class="btn btn-lg btn-success" ng-click="saveArticle()">Save</button> <button ng-show="isEdit" ng-click="deleteArticle()" name="delete_article" id="delete_article" type="submit" class="btn btn-lg btn-danger">Delete</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="/bower_components/jquery/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/bower_components/angular/angular.min.js"></script>
        <script src="/js/home.js"></script>
    </body>
</html>