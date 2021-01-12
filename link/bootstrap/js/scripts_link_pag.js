$(document).ready(function(){
     //Aplicando as mascaras nos inputs cpf, valor e vencimento.
    $("#btn_emitir_link").click(function (){
		 if($('#form')[0].checkValidity()) {
			 
         $("#myModal").modal('show');
         $("#link").addClass("hide");
         var descricao = $("#descricao").val();
		 var valor = $("#valor").val();
         var quantidade = $("#quantidade").val();
         var vencimento = $("#vencimento").val();
		 var message = $("#message").val();
		 var request = $("#request").val();
		 var method = $("#method").val();
		 console.log(parseInt(valor))
		 //console.log(parseInt(message))
		 
		 
		 if(parseInt(valor)=="NaN"){
				$("#myModal").modal('hide');
			
				alert("Dados inválidos.");
				
				return false;
			}
		 
		       
         	$.ajax({
		  url: "../linkPagamento/emitir_com_link.php",
		  data:{descricao:descricao,valor:valor,quantidade:quantidade,message:message,request:request,method:method,vencimento:vencimento},
		  type:'post',
		  dataType:'json',
		  success: function(resposta){
                      $("#myModal").modal('hide');
                      console.log(resposta)
			if(resposta.code == 200){
							 $("#myModalResult").modal('show');	
                             $("#link").removeClass("hide");
                             var html = "<th>"+resposta.data.charge_id+"</th>"
								 html+= "<th><a target='blank' href='"+resposta.data.payment_url+"'> clique aqui para acessar o link de pagamento </a></a></th>"
								 html+= "<th>"+resposta.data.payment_method+"</th>"
                                 html+= "<th>"+resposta.data.status+"</th>"
                                 html+= "<th>"+resposta.data.total+"</th>"
                                 
                             $("#result_table").html(html);
								
                      
			}else{
                            $("#myModal").modal('hide');
                            alert("Code: "+ resposta.code)
			}
		  },
                  error:function (resposta){
                      $("#myModal").modal('hide');
                      alert("Ocorreu um erro - Mensagem: "+resposta.responseText)
                  }
		});
		} //endif
		else {
                alert("Você deverá preencher todos dados do formulário.")
            }
     })
     
     
})