(function($) {

	skel.breakpoints({
		wide: '(max-width: 1680px)',
		normal: '(max-width: 1280px)',
		narrow: '(max-width: 980px)',
		narrower: '(max-width: 840px)',
		mobile: '(max-width: 736px)',
		mobilep: '(max-width: 480px)'
	});

	$(function() {

		var	$window = $(window),
			$body = $('body');

		// Disable animations/transitions until the page has loaded.
			$body.addClass('is-loading');

			$window.on('load', function() {
				$body.removeClass('is-loading');
			});

		// Fix: Placeholder polyfill.
			$('form').placeholder();

		// Prioritize "important" elements on narrower.
			skel.on('+narrower -narrower', function() {
				$.prioritize(
					'.important\\28 narrower\\29',
					skel.breakpoint('narrower').active
				);
			});

	});

})(jQuery);

$(document).on("click",".upload",function(e){
    
    e.preventDefault();
	$('.random').click();
});
$(document).on("click","input[type=button]",function(e){
    
		e.preventDefault();
   });
$('#demo-category').change(function(){

		subject=this.value;

});

$(document).on("click","#tup",function(e){


		
		e.preventDefault();
		
		var tid=$('#tid').val();
		alert(subject);
		var batch=$('#batch').val();
		var topic=$('#topic').val();
		var extra=$('#extra').val();

		var formData = new FormData();
		formData.append("tup","0215");
		formData.append('tid',tid);
		formData.append('subject',subject);
		formData.append('topic',topic);
		formData.append('extra',extra);
		formData.append('batch',batch);
		formData.append('Upload', $('#tup-upl')[0].files[0]);
		

		
				 $.ajax({
          type: "POST",
          url: "tup.php",
          data: formData,
          //use contentType, processData for sure.
          contentType: false, 
          processData: false,
          beforeSend: function() {
         
            },
				   xhr: function () {
		        var xhr = new window.XMLHttpRequest();
		        xhr.upload.addEventListener("progress", function (evt) {
		            if (evt.lengthComputable) {
		                var percentComplete = evt.loaded / evt.total;
		                console.log(percentComplete);
		                $('.inner').css({
		                    width: percentComplete * 100 + '%'
		                });
		                var rounded=Math.round(percentComplete*100);
		                $('.percent').html(rounded+ '%');
		            }
		        }, false);
		        xhr.addEventListener("progress", function (evt) {
		            if (evt.lengthComputable) {
		                var percentComplete = evt.loaded / evt.total;
		                console.log(percentComplete);
		                $('.inner').css({
		                    width: percentComplete * 100 + '%'
		                });
		               var rounded=Math.round(percentComplete*100);
		                $('.percent').html(rounded+ '%');
		            }
		        }, false);
		        return xhr;
		    },
	       success: function(msg) {                    
                alert(msg);                 
            },
            error: function() {                   
             
            }
        })



});



$('#ac').on('change', function() {

	var opt=this.value;

	if(opt==2)
	{
		$('.email-stuff').hide();
		$.ajax({
									  type: "POST",
									  url: "index.php",
									  data: {tch:"tch"},
									  cache: false,
									  success: function(data){
									    
									    	console.log(data);
									    	$('#roll').attr("placeholder","Teacher ID");
		$('#batch').attr("placeholder","Department");
									  }
									});

		
	}
	else
	{
		$('.email-stuff').show();
		$('#roll').attr("placeholder","Student Roll No.");
		$('#batch').attr("placeholder","Batch eg. B15");
		$.ajax({
									  type: "POST",
									  url: "index.php",
									  data: {tch:"stud"},
									  cache: false,
									  success: function(data){
									    
									    	console.log(data);
									    	$('#roll').attr("placeholder","Student Roll No.");
		$('#batch').attr("placeholder","Batch eg. B15");
		
									  }
									});
	}

	});
$(document).on("click","#register",function(e){


		
		$('#register').attr('value','Loading');
		if(!$('#terms').is(":checked"))
		{

			alert("Please agree to the terms and conditions of Kode X");
			return false;
		}	
		e.preventDefault();
		
		var tid=$('#full').val();
		
		var batch=$('#batch').val();
		var topic=$('#password').val();
		var extra=$('#password1').val();
		var roll=$('#roll').val();
		var mob=$('#mob').val();
		var email=$('#email').val();

		var formData = new FormData();
		formData.append("register","0215");
		formData.append('full',tid);
		formData.append('email',email);
		formData.append('password',topic);
		formData.append('password1',extra);
		formData.append('roll',roll);
		formData.append('mob',mob);
		formData.append('batch',batch);
		formData.append('Upload', $('#reg-file')[0].files[0]);
		

		
				 $.ajax({
          type: "POST",
          url: "index.php",
          data: formData,
          //use contentType, processData for sure.
          contentType: false, 
          processData: false,
          beforeSend: function() {
         
            },
            success: function(msg) {     

            	console.log(msg);
		$('#register').attr('value','Submit'); 
            	alert(msg);	
            	/*
                if(msg!=2 || msg!=1)
                {
                alert(msg);                 
            	}
            	else if (msg==2) {
            			window.location.href="http://localhost/grapevine/Portals/index.php";

            	}
            	else if(msg==1)
            	{
            		window.location.href="http://localhost/grapevine/tup.php";
            	}
            	else
            	{
            		alert(msg);
            	}
		*/
			

            },
            error: function() {                   
             
            }
        })

});

$(document).on("change",".random",function(){

		
		 var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
            	$('.imagePreview').show();
                $(".imagePreview").attr("src",this.result);
}
        }

});