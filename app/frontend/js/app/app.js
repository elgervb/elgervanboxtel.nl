document.addEventListener("DOMContentLoaded", function(event) {

  echo.init({
    offset: 100,
    throttle: 250,
    unload: false,
    callback: function (element, op) {
      console.log(element, 'has been', op + 'ed');
    }
  });

});