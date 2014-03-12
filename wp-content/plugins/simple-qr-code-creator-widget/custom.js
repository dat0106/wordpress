(function($) {
  $(function() {
		$("#urlqrid,#messageqrid,#qrimagescr").hide();
		$("#qrtype").change(function(){
			if ($(this).val() == "buscardqr") {
				$("#buscardqrid").show();
				$("#urlqrid").hide();
				$("#messageqrid").hide();
			}
			if ($(this).val() == "urlqr") {
				$("#buscardqrid").hide();
				$("#urlqrid").show();
				$("#messageqrid").hide();
			}
			if ($(this).val() == "messageqr") {
				$("#buscardqrid").hide();
				$("#urlqrid").hide();
				$("#messageqrid").show();
			}
		});

		var qrin_addr = $("#wpqrin_addr").val();

		$("#qrin_form").submit(function(event) {
			event.preventDefault();

			qrin_addr = qrin_addr+"?qrtype="+document.getElementById("qrtype").value+"&";

			if(document.getElementById("qrtype").value == "messageqr"){
				qrin_addr=qrin_addr+"qrmessage="+document.getElementById("qrmessage").value.replace(/ /gi,"+");
			}
			else if(document.getElementById("qrtype").value == "urlqr"){
				qrin_addr=qrin_addr+"qrurl="+document.getElementById("qrurl").value;
			}
			else if(document.getElementById("qrtype").value == "buscardqr"){

				qrin_addr=qrin_addr+"flname="+document.getElementById("flname").value+"&org="+document.getElementById("org").value+"&phone="+document.getElementById("phone").value+"&addr="+document.getElementById("addr").value+"&city="+document.getElementById("city").value+"&state="+document.getElementById("state").value+"&email="+document.getElementById("email").value+"&website="+document.getElementById("website").value+"&notes="+document.getElementById("notes").value;
			}

			$("#qrimagescr").attr("src",qrin_addr);
			$("#buscardqrid").hide();
			$("#urlqrid").hide();
			$("#messageqrid").hide();
			$("#qrin_form #qrselect").hide();
			$("#wrqrin_submit").hide();
			$("#qrin_form").css("height","0");

			$("#qrimagescr").show();
			$("#wpqr_gen").css({"text-align":"center","padding":"5px 0"});
			$("#wpqr_gen img").css({"border":"1px dashed #999"});
		});

  });
})(jQuery);
