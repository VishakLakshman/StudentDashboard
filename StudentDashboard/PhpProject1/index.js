$('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});

//$('input[name = "personType"]').on('click',function (e){
//   
//    e.preventDefault();
//    alert($(this).value);
//});

var currentValue = 0;

function handleClick(radioInput){
//    alert('Old value: ' + currentValue);
//    alert('New value: ' + radioInput.value);
//    currentValue = radioInput.value;

if(radioInput.value === "Faculty"){
   //alert('faculty clicked');
   $('#student').hide();
        $('#faculty').show();
   
   
}else{
  //alert('student clicked');
  $('#faculty').hide();
        $('#student').show();
  
     
}
}