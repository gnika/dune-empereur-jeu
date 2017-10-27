$(document).ready( function(){

    var namevalid = false;
    var emailvalid = false;
    
    $('#sendbtn').attr("disabled","disabled");
    
    $('#clientemail').blur(function(){
        var email = $('#clientemail');
        $.ajax({
            type: "GET",
            url: URL_MAIN_ABS + "Contact/ajax/checkemail/clientemail/" + email.val() ,
            success: function( msg){
                if( msg == 'valid' ) {
                    emailvalid = true;
                    $('#emailError').html('');
                    toggleSubmit();
                }
                else {
                    emailvalid = false;
                    $('#emailError').html('Votre adresse e-mail est invalide');
                    toggleSubmit();
                }
                //alert( 'success : ' + msg );
            }
        });
    }); 
    
    $('#clientname').blur(function(){
        var name = $('#clientname');
        $.ajax({
            type: "GET",
            url: URL_MAIN_ABS + "Contact/ajax/checkname/clientname/" + name.val() ,
            success: function( msg){
                if( msg == 'valid' ) {
                    namevalid = true;
                    $('#nameError').html('');
                    toggleSubmit();
                }
                else {
                    namevalid = false;
                    $('#nameError').html('La longueur de votre nom doit être compris entre 3 et 40 caractères');
                    toggleSubmit();
                }
                //alert( 'success : ' + msg );
            }
        });
    }); 
    
    function toggleSubmit(){
        if( namevalid && emailvalid ){
            $('#sendbtn').attr("disabled","");
        }
        else {
            $('#sendbtn').attr("disabled","disabled");
        }
    }
    
});