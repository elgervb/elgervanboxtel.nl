
var app = angular.module('default', ['ngRoute'])

.config(["$routeProvider", "$locationProvider", function($routeProvider, $locationProvider) {

  $routeProvider
    .when('/buttons', {
      templateUrl: '/js/app/modules/sections/buttons.html'
    })
    .when('/colors', {
      controller: 'ColorController',
      templateUrl: '/js/app/modules/sections/colors.html'
    })
    .when('/forms', {
      templateUrl: '/js/app/modules/sections/forms.html'
    })
    .when('/lists', {
      templateUrl: '/js/app/modules/sections/lists.html'
    })
    .when('/tables', {
      templateUrl: '/js/app/modules/sections/tables.html'
    })
    .when('/typography', {
      templateUrl: '/js/app/modules/sections/typography.html'
    })
    .when('/columns', {
      templateUrl: '/js/app/modules/sections/columns.html'
    })
    .otherwise({
      templateUrl: '/js/app/modules/main.html'
    });

  $locationProvider.html5Mode('true');

}]); // end config

/**
 * Convert a hex string to a CMYK string
 */
app.filter("hex2cmykFilter", function(){
  return function(hex, query){
    
    // convert to rgb
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    var RGB = result ? {
      'r': parseInt(result[1], 16),
      'g': parseInt(result[2], 16),
      'b': parseInt(result[3], 16)
      }
      : {'r':255,'g':255,'b':255};
  
    result = {'c':0, 'm':0, 'y':0, 'k':0};
    r = RGB.r / 255;
    g = RGB.g / 255;
    b = RGB.b / 255;
    result.k = Math.min( 1 - r, 1 - g, 1 - b );
    result.c = ( 1 - r - result.k ) / ( 1 - result.k );
    result.m = ( 1 - g - result.k ) / ( 1 - result.k );
    result.y = ( 1 - b - result.k ) / ( 1 - result.k );
    result.c = Math.round( result.c * 100 );
    result.m = Math.round( result.m * 100 );
    result.y = Math.round( result.y * 100 );
    result.k = Math.round( result.k * 100 );
    return result.c + " " + result.m + " " + result.y + " " + result.k;
  };
});
/**
 * Convert a hex string to a HSL string
 */
app.filter("hex2hslFilter", function(){
  return function(hex, query){
    
    // convert to rgb
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    var RGB = result ? {
      'r': parseInt(result[1], 16),
      'g': parseInt(result[2], 16),
      'b': parseInt(result[3], 16)
      }
      : {'r':255,'g':255,'b':255};

    var r = RGB.r / 255, 
        g = RGB.g / 255,
        b = RGB.b / 255;
    var max = Math.max(r, g, b), min = Math.min(r, g, b);
    var h, s, l = (max + min) / 2;

    if (max == min) { h = s = 0; } 
    else {
      var d = max - min;
      s = l > 0.5 ? d / (2 - max - min) : d / (max + min);

      switch (max){
        case r: h = (g - b) / d + (g < b ? 6 : 0); break;
        case g: h = (b - r) / d + 2; break;
        case b: h = (r - g) / d + 4; break;
      }
      
      h /= 6;
    }
    
    return ((h*100+0.5)|0) + " " + ((s*100+0.5)|0) + '% ' + ((l*100+0.5)|0) + '%';
  };
});
/**
 * Convert a hex string to a RGB string
 */
app.filter("hex2rgbFilter", function(){
  return function(hex, query){
    // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
    var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
    hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
    });

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? 
        parseInt(result[1], 16) + " " + parseInt(result[2], 16) + " " + parseInt(result[3], 16)
     : null;
  };
});

app.controller('ColorController', ['$scope', function($scope){

   $scope.colors_primary = [
      {code:'#333333', name:'Dark regular', sass:'dark-regular'},
      {code:'#666666', name:'Grey dark', sass:'grey-dark'},
      {code:'#d3d3d3', name:'Grey light', sass:'grey-light'},
      {code:'#eeeeee', name:'Grey regular', sass:'grey-regular'},
      {code:'#f2f2f2', name:'Light regular', sass:'light-regular'},

      {code:'#e74c3c', name:'Red regular', sass:'red-regular'},
      {code:'#3498db', name:'Blue regular', sass:'blue-regular'},
      {code:'#2ecc71', name:'Green regular', sass:'green-regular'},
      {code:'#1abc9c', name:'Turquoise regular', sass:'turquoise-regular'},
      {code:'#e67e22', name:'Orange regular', sass:'orange-regular'},
      {code:'#9b59b6', name:'Purple regular', sass:'purple-regular'},
      {code:'#E8C53A', name:'Yellow regular', sass:'yellow-regular'},
    ];
}]);