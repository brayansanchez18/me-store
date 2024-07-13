$(document).on("click",".modalEditOrder",function(){

	$("#myOrder").modal("show");

	var idOrder = $(this).attr("idOrder");
	var processOrder = $(this).attr("processOrder");
	var trackOrder = $(this).attr("trackOrder");
	var startOrder = $(this).attr("startOrder");
	var mediumOrder = $(this).attr("mediumOrder");
	var endOrder = $(this).attr("endOrder");

	$("#myOrder").on('shown.bs.modal', function () {

		if(idOrder != undefined){

			$(".bodyMyOrder").append(`<input type="hidden" name="idOrder" value="${idOrder}">`);

			$("#process_order").val(processOrder)
			$("#track_order").val(trackOrder);
			$("#start_date_order").val(startOrder);
			$("#medium_date_order").val(mediumOrder);
			$("#end_date_order").val(endOrder);

		}

	})


})

/*=============================================
Whatsapp
=============================================*/

if($(".getWarranty").length > 0){

	var getWarranty = $(".getWarranty");

	getWarranty.each((i)=>{

		$(getWarranty[i]).attr("href","https://wa.me/"+$(getWarranty[i]).attr("phone")+"?text="+encodeURIComponent("¡Hola! Quiero iniciar una garantía de la órden de compra N. "+$(getWarranty[i]).attr("order")))

	})

}

if($(".getRefund").length > 0){

	var getRefund = $(".getRefund");

	getRefund.each((i)=>{

		$(getRefund[i]).attr("href","https://wa.me/"+$(getRefund[i]).attr("phone")+"?text="+encodeURIComponent("¡Hola! Quiero un reembolso de dinero de la órden de compra N. "+$(getRefund[i]).attr("order")))

	})

}

if($(".questionOrder").length > 0){

	var questionOrder = $(".questionOrder");

	questionOrder.each((i)=>{

		$(questionOrder[i]).attr("href","https://wa.me/"+$(questionOrder[i]).attr("phone")+"?text="+encodeURIComponent("¡Hola! Tengo dudas acerca de la órden de compra N. "+$(questionOrder[i]).attr("order")))

	})

}