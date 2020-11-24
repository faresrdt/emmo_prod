  // Changement de class menu-active

  $(document).ready(function (){
    var title = $('title')
    var nav = $('.nav-a')

    for ($i = 0 ; $i<nav.length ; $i++)
    {
       if (title.eq(0).text() === nav.eq($i).text()){
        var newTitle = title.eq(0).text();
        var newNav = nav.eq($i).text();
        var navI = nav.eq($i).parent();


        nav.parent().removeClass('menu-active')
        navI.addClass('menu-active')
       }
    }
  })

        
  // Changement de class MEDIA QUERIES
 
  
  
  $(document).ready(function(){

    var mq1 = window.matchMedia("(max-width: 992px)")
    var mq2 = window.matchMedia("(max-width: 750px)")

    function mediaQueries992(mq1) {
      if (mq1.matches) { // If media query matches
        
        $("#header > div").removeClass('container');
        $("#header > div").addClass('container-fluid');
        $("#logo").removeClass('col-md-6')
  
      } else {
        
        $("#header > div").addClass('container');
        $("#header > div").removeClass('container-fluid');
        $("#logo").addClass('col-md-6')

      }
    }


    function mediaQueries750(mq2) {
      if (mq2.matches) { // If media query matches
        
        $("#logo > h1").addClass('h1-logo-nav')
  
      } else {
        
        $("#logo > h1").removeClass('h1-logo-nav')

      }
    }

    mediaQueries992(mq1) // Call listener function at run time
    mediaQueries750(mq2) // Call listener function at run time
    mq1.addListener(mediaQueries992) // Attach listener function on state changes
    mq2.addListener(mediaQueries750) // Attach listener function on state changes
  })


  