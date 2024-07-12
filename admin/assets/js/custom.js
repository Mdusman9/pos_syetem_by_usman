//customs.js//
$(document).ready(function () {
    alertify.set('notifier','position','top-right');
    

	$(document).on('click', '.increment', function () {

		var $quantityInput = $(this).closest('.qtyBox').find('.qty');
		var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

		if(!isNaN(currentValue)){
			var qtyVal = currentValue + 1;
			$quantityInput.val(qtyVal);
			 quantityInDec(productId, qtyVal);
		}
	});
$(document).on('click', '.decrement', function () {

		var $quantityInput = $(this).closest('.qtyBox').find('.qty');
		var productId = $(this).closest('.qtyBox').find('.prodId').val();
        var currentValue = parseInt($quantityInput.val());

		if(!isNaN(currentValue)  && currentValue > 1){
			var qtyVal = currentValue - 1;
			$quantityInput.val(qtyVal);
			 quantityInDec(productId, qtyVal);
		}
	});

	function quantityInDec(prodId,qty){
        $.ajax({
            type:"POST",
            url:"orders-code.php",
            data:{
                'productInDec' : true,
				'product_id' : prodId,
				'quantity' : qty
            },success: function(response){
                var res = JSON.parse(response);
                //console.log(res)
				if (res.status == 200) {
					$('#productArea').load(' #productContent');
					alertify.success(res.message);
				} else {
					$('#productArea').load(' #productContent');
					alertify.error(res.message);
				}

            }
          
        });
    }
	// proceed to place order button click
	
	$(document).on('click', '.proceedToPlace', function () {

		//console.log('.proceedToPlace');
		
	
		var cphone = $('#cphone').val();
		var payment_mode = $('#payment_mode').val();
		//console.log(cphone);
		//console.log(payment_mode);
		
	
		if(payment_mode == ''){
	
			swal("Select Payment Mode","Select your payment mode","warning");
			return false;
		}
	
		if(cphone == '' && !$.isNumeric(cphone)){
	
			swal("Enter Phone Number","Enter Valid Phone Number","warning");
			return false;
		} 
	      
		var data = {
			'proceedToPlaceBtn': true,
			'cphone': cphone,
			'payment_mode': payment_mode,
		};

		$.ajax({
			type: "POST",
			url: "orders-code.php",
			data: data,
			success: function (response) { 
				var res=JSON.parse(response);
				console.log(data);
				if(res.status==200){
					window.location.href="orders-summary.php";
				}else if(res.status==404){
					swal(res.message,res.message,res.status_type,{
					buttons:{
						catch : {
							text:"Add Customer ",
							value:"catch"
						},
						cancel :"cancel"
					}
				})
				.then((value)=>{ 
					switch(value){
                       case "catch":
						$('#c_phone').val(cphone);
						$('#addCustomerModel').modal('show');
                       //console.log("Pop the customer add mopdel")  
					   break;
					   default:
					}

				});

				}else{
					swal(res.message,res.message,res.status_type);

				}
			
			}
		});
	});
	//add new customer
	$(document).on('click','.saveCustomer',function () {
		var c_name=$('#c_name').val();
		var c_phone=$('#c_phone').val();
		var c_email=$('#c_email').val();
		if(c_name != '' && c_phone !='')
		{
            if($.isNumeric(c_phone)){
				var data={
					'saveCustomerBtn': true,
					'name': c_name,
					'phone': c_phone,
					'email': c_email


				};
				$.ajax({
					type: "POST",
					url: "orders-code.php",
					data: data,
					success: function (response) {
						//Errroe solved
						swal('Customer Added','Customer added succefully','success');
							$('#addCustomerModel').modal('hide');
						//errror
						/*var res=JSON.parse(response);

						if(res.status==200){
							swal(res.message,res.message,res.status_type);
							$('#addCustomerModel').modal('hide');
						}else if(res.status==422){
							swal(res.message,res.message,res.status_type);
						}
						else{
							swal(res.message,res.message,res.status_type);
						}*/
						
					}
				});

			}else{
				swal('PLease Valid Mobile Number'," ",'warning');
			}
		}else{
			swal('PLease Fill Required Fields'," ",'warning');	
		}
		
	});
	$(document).on('click','#saveOrder', function () {
		$.ajax({
			type: "POST",
			url: "orders-code.php",
			data: {
				'saveOrder':true
			},
			success: function (response) {
				swal('Order Placed','Order Placed Succesfully','success');
				$('#orderPlaceSuccessMessage').text('Order Placed Succesfully');
				$('#orderSuccessModal').modal('show');
				/*var res1 =JSON.parse(response);
				if(res1.status ==200){
					swal(res1.message,res1.message,res1.status_type);

				}else{
					swal(res1.message,res1.message,res1.status_type);
				}*/
				
			}
		});

		
	});
	
});
function printMyBillingArea(){
	var divContents = document.getElementById("myBillingArea").innerHTML;
	var a = window.open('','');
	a.document.write('<html><title>POS System</title>');                     	 
	a.document.write('<body style="font-family:fangsong;">');                     	 
	a.document.write(divContents);
	a.document.write('</body></html>'); 
	a.document.close();
	a.print();

  }
/*window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF();
function downloadPDF(inv){
	var elementHTML = document.querySelector("#myBillingArea");
	docPDF.html(elementHTML,{
      callback: function(){
           docPDF.save(inv+'.pdf')
	  },
	  x:15,
	  y:15,
	  width:170,
	  windowwidth:650

	});

}*/
window.onload = function(){
	  document.getElementById("download").addEventListener("click",()=>{
		const bill = this.document.getElementById("myBillingArea");
		console.log(window);
		const date = new Date();
		formattedDate=date.getDate;
		var opt = {
			margin:       1,
			filename:     formattedDate+'_myfile.pdf',
			image:        { type: 'jpeg', quality: 0.98 },
			html2canvas:  { scale: 2 },
			jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
		  };
		html2pdf().from(bill).set(opt).save();
		
	  })
}