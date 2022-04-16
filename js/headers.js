var cookieValue = parseInt(localStorage.getItem('x'));
console.log(cookieValue);


if (cookieValue==0) {
  x = 0;
  $('.wrapper').removeClass('hideHeaderClass');
  $('.helloworld').removeClass('hideHeaderClass');
  $('#header').removeClass('hideHeaderClass1');
  $('.liwrap').removeClass('liwrapClass');
  $('.liwrap p').removeClass('liwrapClassP');
  $('.mrpnldiv a p').removeClass('liwrapClassP');
  $('.clientinfoswrap p').removeClass('liwrapClassP');
  $('.clientinfoswrap').removeClass('liwrapClass');
  $('.hideheader').removeClass('hideHeaderNewClass');
  $('.hideheaderarrowimg').removeClass('hideHeaderNewImg');
  $('.mrpnldiv img').removeClass('liwrapClassP');
  $('#instimg').removeClass('liwrapClassP');
  $('#linkedinimg').removeClass('liwrapClassP');
} else {
  x = 1;
  $('.wrapper').addClass('hideHeaderClass');
  $('.helloworld').addClass('hideHeaderClass');
  $('.prefooter').addClass('hideHeaderClass2');
  $('.divfooter').addClass('hideHeaderClass2');
  $('.rightsreserved').addClass('hideHeaderClass');
  $('#header').addClass('hideHeaderClass1');
  $('.liwrap').addClass('liwrapClass');
  $('.liwrap p').addClass('liwrapClassP');
  $('.mrpnldiv a p').addClass('liwrapClassP');
  $('.clientinfoswrap p').addClass('liwrapClassP');
  $('.clientinfoswrap').addClass('liwrapClass');
  $('.hideheader').addClass('hideHeaderNewClass');
  $('.hideheaderarrowimg').addClass('hideHeaderNewImg');
  $('.mrpnldiv img').addClass('liwrapClassP');
  $('#instimg').addClass('liwrapClassP');
  $('#linkedinimg').addClass('liwrapClassP');

}

$( document ).ready(function() {
  if (cookieValue==0) {
  x = 0;
  $('.prefooter').removeClass('hideHeaderClass2');
  $('.divfooter').removeClass('hideHeaderClass2');
  $('.rightsreserved').removeClass('hideHeaderClass');
} else {
  x = 1;
  $('.prefooter').addClass('hideHeaderClass2');
  $('.divfooter').addClass('hideHeaderClass2');
  $('.rightsreserved').addClass('hideHeaderClass');
}
});

$('#hideheader1').click(
   function() {
     if (x==0) {
       $('.wrapper').addClass('hideHeaderClass');
       $('.helloworld').addClass('hideHeaderClass');
       $('.prefooter').addClass('hideHeaderClass2');
       $('.divfooter').addClass('hideHeaderClass2');
       $('.rightsreserved').addClass('hideHeaderClass');
       $('#header').addClass('hideHeaderClass1');
       $('.liwrap').addClass('liwrapClass');
       $('.liwrap p').addClass('liwrapClassP');
       $('.mrpnldiv a p').addClass('liwrapClassP');
       $('.clientinfoswrap p').addClass('liwrapClassP');
       $('.clientinfoswrap').addClass('liwrapClass');
       $('.hideheader').addClass('hideHeaderNewClass');
       $('.hideheaderarrowimg').addClass('hideHeaderNewImg');
       $('.mrpnldiv img').addClass('liwrapClassP');
       $('#instimg').addClass('liwrapClassP');
       $('#linkedinimg').addClass('liwrapClassP');
       x = 1;
     } else {
       $('.wrapper').removeClass('hideHeaderClass');
       $('.helloworld').removeClass('hideHeaderClass');
       $('.prefooter').removeClass('hideHeaderClass2');
       $('.divfooter').removeClass('hideHeaderClass2');
       $('.rightsreserved').removeClass('hideHeaderClass');
       $('#header').removeClass('hideHeaderClass1');
       $('.liwrap').removeClass('liwrapClass');
       $('.liwrap p').removeClass('liwrapClassP');
       $('.mrpnldiv a p').removeClass('liwrapClassP');
       $('.clientinfoswrap p').removeClass('liwrapClassP');
       $('.clientinfoswrap').removeClass('liwrapClass');
       $('.hideheader').removeClass('hideHeaderNewClass');
       $('.hideheaderarrowimg').removeClass('hideHeaderNewImg');
       $('.mrpnldiv img').removeClass('liwrapClassP');
       $('#instimg').removeClass('liwrapClassP');
       $('#linkedinimg').removeClass('liwrapClassP');
       x = 0;
     }
     localStorage.setItem('x', x);
   });

   $('#hideheader1').hover(
      function() {
         $('.hideheaderarrowimg').addClass('hideHeaderImgHover')
      },
      function() {
        $('.hideheaderarrowimg').removeClass('hideHeaderImgHover')
      }
   )

   $('.hellome').hover(
      function() {
        $('#additarrow').addClass('additarrowup')
        $('.additinfo').addClass('additinfoshow')
      },
      function() {
        $('#additarrow').removeClass('additarrowup')
        $('.additinfo').removeClass('additinfoshow')
      }
   )
