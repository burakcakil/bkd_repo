

var app = angular.module('myApp',[]);



app.controller("myCtrl", ['$scope','$http', 'fileUpload', function($scope, $http, fileUpload) {
  $scope.tel_pattern = /^\+?\d{10}$/;
  $scope.cep_tel_pattern = /^5\d{9}$/;
  $scope.integer_pattern = /^\d*$/;
  /*$scope.fields.bdate = new Date();
  this.isOpen = false;*/

  $scope.wordCount = function(text) {
    var s = text ? text.split(/\s+/) : 0; // it splits the text on space/tab/enter
    return s ? s.length : '0';

  };

  $scope.submit = function () {
    var data = $scope.fields;
    var uploadResponse = false;
    $http.post("http://localhost/ybiapi/candidate", data)
    .then(function(response) {
      //success
        if(response.data.result == "OK"){
          var fotograf = $scope.files1;
          var ozgecmis = $scope.files2;

          var uploadUrl = "http://localhost/ybiapi/upload?email="+$scope.fields.eposta;

          fileUpload.uploadFileToUrl(fotograf,ozgecmis, uploadUrl)
          .then(function(response){
              if(response == "OK"){
                $scope.result = true;
                alert("Başvurunuz başarıyla kaydedildi! Teşekkür ederiz.");
              }else{
                $scope.result = false;
                alert("Başvurunuz kaydedilirken hata oluştu. Lütfen dernek ile iletişime geçin.");
              }
              location.reload();
          });
        }else {
            $scope.result = false;
        }
    },function(response){
      //error;
      $scope.result = false;
    });
  }
}]);


app.directive('fileModel', ['$parse', function ($parse) {
            return {
               restrict: 'A',
               require: 'ngModel',
               link: function(scope, element, attrs, mCtrl) {

                  var model = $parse(attrs.fileModel);
                  var modelSetter = model.assign;

                    element.bind('change', function(){
                      if(element[0].files[0].size <= 3145728){
                        scope.sizeLimitExceeded = false;
                      }else {
                        scope.sizeLimitExceeded = true;
                      }
                       scope.$apply(function(){
                          modelSetter(scope, element[0].files[0]);
                       });
                    });
                  }
               }
         }]);

/*app.directive('sizeControl', function() {
 return {
   require: 'ngModel',
   link: function(scope, element, attr, mCtrl) {
     mCtrl.$validators.sizeControl = function(){
       element.on('change', function(){
         alert(element[0].files[0].size < 500000);
         return element[0].files[0].size < 500000;
       });
     }
   }
 };
});*/

app.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file1, file2, uploadUrl){
       var fd = new FormData();
       fd.append('fotograf', file1);
       fd.append('ozgecmis', file2);

       return $http.post(uploadUrl, fd, {
          transformRequest: angular.identity,
          headers: {'Content-Type': undefined}
       })
       .then(function(response) {
         return response.data;
       });
    }
 }]);
