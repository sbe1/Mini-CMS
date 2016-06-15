var CMSApp = angular.module('CMSApp', []);
CMSApp.controller('CMSController', function ($scope, $http) {
    $scope.formEnabled = false;
    $scope.isEdit = false;
    $scope.orderRows = true;
    $scope.sortDir = false;
    $scope.sortText =  'Sort '+($scope.sortDir ? '+' : '-');
    $scope.toggleModal = function () {
        $scope.currentArticle = this.article;
        if ($scope.formEnabled === true) {
            $scope.closeModal();
        }
        else {
            $scope.formEnabled = true;
        }
        if ($scope.formEnabled) {
            if ($scope.currentArticle) {
                $scope.isEdit = true;
                $('#form-heading').html('Edit Article');
                $('#article_id').val($scope.currentArticle.id);
                $('#article_title').val($scope.currentArticle.title);
                $('#article_subhead').val($scope.currentArticle.subheader);
                $('#article_author').val($scope.currentArticle.author);
                $('#article_image').val($scope.currentArticle.image);
                $('#article_content').val($scope.currentArticle.content);
            }
            else {
                $('#form-heading').html('New Article');
                $('#article_form')[0].reset();
            }
        }
    };
    $scope.closeModal = function () {
        $scope.formEnabled = false;
        $scope.isEdit = false;
        $('#article_form')[0].reset();
    };
    $scope.saveArticle = function () {
        var saveUrl = "/api/save";
        var data = {title: $('#article_title').val(), subheader: $('#article_subhead').val(), author: $('#article_author').val(), image: $('#article_image').val(), content: $('#article_content').val()};
        data['summary'] = (data['content'].length > 255) ? data['content'].substring(0, 255) : data['content'];
        if ($scope.currentArticle) {
            $scope.currentArticle['id'] = data['id'] = $('#article_id').val();
            $scope.currentArticle['title'] = data['title'];
            $scope.currentArticle['subheader'] = data['subheader'];
            $scope.currentArticle['author'] = data['author'];
            $scope.currentArticle['image'] = data['image'];
            $scope.currentArticle['content'] = data['content'];
            saveUrl = "/api/update/" + data['id'];
        }
        $http({
            url: saveUrl,
            method: "POST",
            data: data,
        }).success(function (data, status, headers, config) {
            // We have to request the article list with save or update actions
            // because there is server side processing that affects the updated
            // article list display.
            $http({
                url: '/api/articles',
                method: 'GET'
            }).success(function (data, status, headers, config) {
                $scope.articleList = data;
                $scope.dataSize = data.length;
                $scope.closeModal();
            }).error(function (data, status, headers, config) {
                $scope.status = status;
            });
            $scope.closeModal();
        }).error(function (data, status, headers, config) {
            $scope.status = status;
            $scope.closeModal();
        });
        $scope.closeModal();
    };
    $scope.deleteArticle = function () {
        $http({
            url: '/api/delete/' + $scope.currentArticle.id,
            method: 'GET'
        }).success(function (data, status, headers, config) {
            $scope.articleList.splice($scope.articleList.indexOf($scope.currentArticle),1);
            $scope.closeModal();
        }).error(function (data, status, headers, config) {
            $scope.status = status;
        });
    };
    $scope.toggleOrderBy = function () {
        $scope.orderRows = !$scope.orderRows;
        if ($scope.orderRows) {
            $('#publication_date').addClass('text-bold');
            $('#article_title_order').removeClass('text-bold');
        }
        else {
            $('#article_title_order').addClass('text-bold');
            $('#publication_date').removeClass('text-bold');
        }
    };
    $scope.toggleSort = function () {
        $scope.sortDir = !$scope.sortDir;
        $scope.sortText =  'Sort '+($scope.sortDir ? '+' : '-');
    };
    $scope.exposeHiddenRecords = function () {
        $scope.pageSize = $scope.articleList.length;
    };
    $http({
        url: '/api/articles',
        method: 'GET'
    }).success(function (data, status, headers, config) {
        $scope.articleList = data;
        $scope.dataSize = data.length;
        $scope.pageSize = 3;
        $scope.closeModal();
    }).error(function (data, status, headers, config) {
        $scope.status = status;
    });
});
// Ensures that 
CMSApp.filter('object2Array', function() {
    return function(input) {
      var out = []; 
      for(i in input){
        out.push(input[i]);
      }
      return out;
    }
  });
(function ($, doc) {
    $('#article_form').submit(function (event) {
        event.preventDefault();
        return false;
    });
})(jQuery, document);