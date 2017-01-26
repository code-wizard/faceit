(function(){
	
angular.module("faceit",['angularUtils.directives.dirPagination'])
.run( function run($http){
          // $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
          $http.defaults.headers.post['X-CSRF-Token'] = $('meta[name="csrf-token"]').attr('content')//yii.getCsrfToken();
   });
})()