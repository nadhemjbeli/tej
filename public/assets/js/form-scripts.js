$("#contactForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
        formError();
        submitMSG(false, "Avez-vous rempli le formulaire correctement?");
    } else {
        // everything looks good!
        event.preventDefault();
        submitForm();
    }
});


function submitForm(){
	
    // Initiate Variables With Form Content
	var reference = $("#reference").val();
	var lieu_prise = $("#lieu_prise").val();
	
	var lieu_reprise = $("#lieu_reprise").val();
	var date_debut = $("#date_debut").val();
	var date_fin = $("#date_fin").val();
	var heure_debut = $("#heure_debut").val();
	var heure_fin = $("#heure_fin").val();
    var nom = $("#nom").val();
	var prenom = $("#prenom").val();
    var email = $("#email").val();
    var message = $("#message").val();
	var age = $("#age").val();
	var tel = $("#tel").val();
	var numvol = $("#numvol").val();
	var adresse = $("#adresse").val();
	var ville = $("#ville").val();
	var codepostal = $("#codepostal").val();
	
	var ad = $("#ad").val();
	var enf = $("#enf").val();
	var beb = $("#beb").val();
	
	
	
	var datafinale ="nom=" + nom + "&prenom=" + prenom + "&lieu_prise=" + lieu_prise + "&lieu_reprise=" + lieu_reprise + "&date_debut=" + date_debut + "&date_fin=" + date_fin + "&heure_debut=" + heure_debut + "&heure_fin=" + heure_fin + "&reference=" + reference + "&age=" + age + "&tel=" + tel + "&numvol=" + numvol;
	
	
	
	datafinale+= "&ad=" + ad + "&enf=" + enf + "&beb=" + beb ;
	
	
	
	if( $("#siege").is(":checked") )
       {
   			var siege=$("#siege").val();
			datafinale+="&siege=" + siege;
			
       }
	if( $("#conducteur").is(":checked") )
       {
   			var conducteur=$("#conducteur").val();
			datafinale+="&conducteur=" + conducteur;
       }
	if( $("#gps").is(":checked") )
       {
   			var gps=$("#gps").val();
			datafinale+="&gps=" + gps;
       }
	

	datafinale+= "&email=" + email + "&adresse=" + adresse + "&ville=" + ville + "&codepostal=" + codepostal + "&message=" + message;
	
	alert(datafinale);
	
    $.ajax({
        type: "POST",
        url: "php/form-process.php",
        data: datafinale,
        success : function(text){
            if (text == "success"){
                formSuccess();
            } else {
                formError();
                submitMSG(false,text);
            }
        }
    });
}

function formSuccess(){
    $("#contactForm")[0].reset();
    submitMSG(true, "Message Envoyé avec succès!")
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(this).removeClass();
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}