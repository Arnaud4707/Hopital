//document.getElementById("connexion").addEventListener("submit", connect(event));
//function connect(){
//    var input = document.getElementById("user").innerHTML;
//    var input2 = document.getElementById("pass").innerHTML;
//        if (input === '' || input2 === ''){
//         document.getElementById("error").innerHTML = "Sorry! <code>preventDefault()</code> won't let you check this!<br>";
//         event.preventDefault();
//     }
//    
//}
if (document.getElementById("connexion") !== null){
    document.getElementById("connexion").addEventListener("submit", function(event){
        var login = document.getElementsByName("login")[0].value;
        var password = document.getElementsByName("password")[0].value;
        if (login === '' || password === ''){
            document.getElementById("error").innerHTML = "<div class='alert alert-danger'>Veuillez compléter tous les champs!</div>";
            event.preventDefault();
        }
    });
}

if (document.getElementById("inscription") !== null){
    document.getElementById("inscription").addEventListener("submit", function(event){
    var login = document.getElementsByName("login")[0].value;
    var password = document.getElementsByName("password")[0].value;
    var passwordverify = document.getElementsByName("passwordVerif")[0].value;
    var nom = document.getElementsByName("nom")[0].value;
    var prenom = document.getElementsByName("prenom")[0].value;
        if (login === '' || password === '' || nom === '' || prenom === '' || passwordverify === ''){
         document.getElementById("error").innerHTML = "<div class='alert alert-danger'>Veuillez compléter tous les champs!</div>";
         event.preventDefault();
     }
});
}

//document.getElementById("conge").addEventListener("submit", function(event){
//    var idp = document.getElementByName("idp")[0].value;
//    var debut = document.getElementByName("debut")[0].value;
//    var fin = document.getElementByName("fin")[0].value;
//        if (idp === '' || debut === '' || fin === ''){
//         document.getElementById("error").innerHTML = "<div class='alert alert-danger'>Veuillez compléter tous les champs!</div>";
//         event.preventDefault();
//     }
//    event.preventDefault();
//});
//
//
//document.getElementById("ajoueSalarie").addEventListener("submit", function(event){
//    var input = document.getElementByName("prenom").innerHTML;
//    var input2 = document.getElementByName("nom").innerHTML;
//    var input2 = document.getElementByName("age").innerHTML;
//    var input2 = document.getElementByName("address").innerHTML;
//    var input2 = document.getElementByName("code").innerHTML;
//        if (input === '' || input2 === ''){
//         document.getElementById("error").innerHTML = "<div class='alert alert-danger'>Veuillez compléter tous les champs!</div>";
//         event.preventDefault();
//     }
//    event.preventDefault();
//});
//    
//    
//});document.getElementById("conge").addEventListener("submit", function(event){
//    var input = document.getElementByName("idp").innerHTML;
//    var input2 = document.getElementByName("debut").innerHTML;
//    var input2 = document.getElementByName("fin").innerHTML;
//        if (input === '' || input2 === ''){
//         document.getElementById("error").innerHTML = "<div class='alert alert-danger'>Veuillez compléter tous les champs!</div>";
//         event.preventDefault();
//     }
//    event.preventDefault();
//});