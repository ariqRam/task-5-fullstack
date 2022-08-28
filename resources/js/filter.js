$(document).ready(() => {
  $(document).on('click', '.form-check-input', () => {
    let ids = [];

    $('.form-check-input').each(function () {
      const id = $(this).attr('id');
      const idNum = id.substring(id.length - 1);
      if ($(this).is(":checked")) {
          ids.push(idNum);
      }
    });

    $('#post-container').children('div').each((idx, e) => {
      checkCategoryChecked(e, ids);
    });
  });
});

function checkCategoryChecked(e, ids) {
  const element = $(e).find('h3');
  console.log(ids)
  if(ids.length === 0) {
    console.log('no constraints');
    $(e).show();
    return;
  }
  for(let i=0; i < ids.length; i++) {
    if(element.hasClass('post' + ids[i])) {
      console.log('it has');
      $(e).show();
      return;
    } 
    else {
      console.log('it doesnt');
      $(e).hide();
    }
  }
}