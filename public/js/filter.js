/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/filter.js ***!
  \********************************/
$(document).ready(function () {
  $(document).on('click', '.form-check-input', function () {
    var ids = [];
    $('.form-check-input').each(function () {
      var id = $(this).attr('id');
      var idNum = id.substring(id.length - 1);

      if ($(this).is(":checked")) {
        ids.push(idNum);
      }
    });
    $('#post-container').children('div').each(function (idx, e) {
      checkCategoryChecked(e, ids);
    });
  });
});

function checkCategoryChecked(e, ids) {
  var element = $(e).find('h3');
  console.log(ids);

  if (ids.length === 0) {
    console.log('no constraints');
    $(e).show();
    return;
  }

  for (var i = 0; i < ids.length; i++) {
    if (element.hasClass('post' + ids[i])) {
      console.log('it has');
      $(e).show();
      return;
    } else {
      console.log('it doesnt');
      $(e).hide();
    }
  }
}
/******/ })()
;