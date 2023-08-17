
let path = {
  url:'',
  segment:'',
  file_name:'',
};
// getPage(data,redirect);
path.url = window.location.pathname;
//console.log("Path:", path);
path.segment = path.url.split("/");

//Get the last segment, which should be the filename
path.file_name = path.segment[path.segment.length - 1];


function redirectPage(data){

  //After the animation duration, redirect to a new page
  setTimeout(function () {
    window.location.href = data;
  }, 2000); //Change the time (in milliseconds) as needed

}

function checkPage(data){

  //Set Page
  var page = data.page;

  //Set Class Name
  var class_name;

  //Set Page Redirect
  var page_redirect;

  //Check Page
  switch(page){

    //index.html
    case 'index.html':

      //Set Class Name
      class_name = '.page.intro';

      //Page to Page
      page_redirect = 'form.html';

    break;

    //form.html
    case 'form.html':

      //Set Class Name
      class_name = '.page.form';

      //Page to Page
      page_redirect = 'result.php';

    break;

    //result.php
    case 'result.php':

      //Set Class Name
      class_name = '.page.result';

      //Page to Page
      page_redirect = 'form.html';

    break;
    

    break;

    default:
    break;

  }

  return {
    class_name:class_name,
    page_redirect:page_redirect
  };

}
