
var url="http://localhost/cola/public/api/"
$( "#btnaddUser" ).click(function() {
    $.ajax({
        url: url+"user",
        type: 'post',
        dataType: 'json',
        contentType: 'application/json',
        data:JSON.stringify({nombre:$("#nameUser").val()}),
        success: function(response){
            console.log(response.id); 
            addUserToCola(response.id);
        }
     });
});


function addUserToCola(idUser){
    $.ajax({
        url: url+"cola",
        type: 'post',
        dataType: 'json',
        contentType: 'application/json',
        data:JSON.stringify({id:idUser}),
        success: function(response){
            cargarCola(1); 
            cargarCola(2); 

        }
     });

}

function cargarCola(colaInt) {
    $("#cola"+colaInt+" tbody").html("");
    $.ajax({
        url: url+"cola/"+colaInt,
        type: 'get',
        dataType: 'JSON',
        success: function(response){
            var len = response.length;
            var tr_str_head = "<td>Cola"+colaInt+"<td>";     
            for(var i=0; i<len; i++){
                var nombre = response[i].nombre;
                var tr_str = 
                    "<td align='center'>" + nombre + "</td>"
                    ;

                $("#cola"+colaInt+" tbody").append(tr_str);
            }

        }
    });
}

$(document).ready(function(){
    cargarCola(1);
    cargarCola(2);
});
