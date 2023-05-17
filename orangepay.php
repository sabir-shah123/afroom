<style>
    .success, .error {
			border: 1px solid;
			margin: 10px 0px;
			padding: 15px 10px 15px 50px;
			background-repeat: no-repeat;
			background-position: 10px center;
		}
		
    .error{
			color: #D8000C;
			background-color: #FFBABA;
			background-image: url('https://i.imgur.com/GnyDvKN.png');
		}
		
		.success {
			color: #4F8A10;
			background-color: #DFF2BF;
			background-image: url('https://i.imgur.com/Q9BGTuy.png');
		}
		
		
		
		
</style>

<div class="row my-4">
     <div class="col-md-12 mx-auto">
         <form action="#" method="POST">
             
         <div class="row"> 
         <div class="col-md-12 text-center mb-4">
             <span class="alert alert-info">
                 To get otp please dial USSD #144#391# from your phone 
             </span>
         </div>
             <div class="col-md-8 text-left">
                      <label for="phone" class="text-left">Phone Number:</label>
                      <input type="text" id="o_phone" name="o_phone" class="form-control" placeholder="456 345 654" required><br>
             </div>
             <div class="col-md-4 text-left">
                 <label for="otp" class="">OTP:</label>
                      <input type="text" id="o_otp" name="o_otp" class="form-control" required>
             </div>
             
             <div class="col-md-12">
                     <div class="" id="info-message"></div>
             </div>
         </div>
         <div class="row">
             <div class="col-md-12 text-right">
                 <input type="button" id="orangesubmit" class="btn btn-primary form-control" value="Pay now">
             </div>
         </div>
         </form>
     </div>
</div>
<script>
    function handleresult(data){
        if($('#aorangepaybutton').length){
            $('#aorangepaybutton').show();
        }else{
            $('#orangesubmit').show();
        }
         try {
             if(typeof data=='string'){
                  data = JSON.parse(data);
             }
                        
                        
                        if (data.status && data.status=="200") {
                            // process the successful response data
                             let detail = data.detail;
                              $('#info-message').addClass('success');
                              $('#info-message').text(detail);
                              
                              setTimeout(function() {
                                  location.reload();
                            }, 1000);
                             
                        } else {
                            // handle the error response data
                            let detail = data.detail || 'Unknown error';
                            let errorMsg = `Orange API error (${data.status}): ${detail}`;
                            console.error(errorMsg);
                            // show the error message to the user
                            $('#info-message').removeClass('success');
                            $('#info-message').addClass('error');
                            $('#info-message').text(errorMsg);
                            // highlight the input field with the error
                            let errorInputId = data.code === '24' ? 'o_phone' : 'o_otp';
                            $('#' + errorInputId).addClass('is-invalid');
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                        // show a generic error message to the user
                        $('#info-message').addClass('error');
                        $('#info-message').text('An unexpected error occurred. Please try again later.');
                    }
    }
</script>


