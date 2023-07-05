$(document).ready(function(){

    $('.perception-rubrique').click(function (e) { 
        var rubrique = $(this).data('id')
        e.preventDefault();

        window.location.href='index.php?perception='+rubrique
    });
    
    $('.add-paiement').click(function (e) { 
        e.preventDefault();
        
        var str = window.location.href
        var str = new URL(str)
        var rubrique = str.searchParams.get("perception")

        var montant = prompt('Entrer le montant payé par l\'étudiant', '')

        if (montant == null) {
            alert('Le montant de doit pas être vide')
        } else {
            

            var preuve = prompt('Entrer le numero du reussit de l\'étudiant', '')

            if (preuve == null) {
                alert('La preuve est obligatoire, veuillez recommencer l\'enregistrement')
            } else {

                var isOK = confirm("Un fois que le montant : "+montant+" enregistré dans la rubrique, il ne sera plus possible de le modifier.\nVous êtes bien sûr ?")
        
                if (isOK) {
                    
                    var data = {
                        rubrique : rubrique,
                        etudiant : $(this).data('id'),
                        montant : montant,
                        preuve: preuve
                    }
        
                    $.post(
                        "./controleur/php/API.php",
                        {
                            add_paiement : data
                        },
                        function(resp){
                            let dataJSON = JSON.parse(resp)
                
                            if(dataJSON.code == 200){ 
        
                                alert(dataJSON.data)
                                window.location.reload()  
            
                            }else{
                                alert(dataJSON.data)
                            }
                        }
                    )        
                }
                
            }
            
        }

        
    });
})