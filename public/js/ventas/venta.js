/**
 * Created by Piotr on 10/09/2017.
 */
$(document).ready(function() {
    $('#btn_cliente').on('click',function(e){
        e.preventDefault();
        $('#FormCreateCliente')[0].reset();
        $('#reg_cliente').modal({
            show:true,
            backdrop:'static'
        });
    });
});