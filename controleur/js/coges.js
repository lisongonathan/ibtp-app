$(document).ready(function(){

    $('.add-rubrique').click(function (e) { 
        e.preventDefault();

        const designation = $('#designation-frais').val();
        
        $.post(
            "./controleur/php/API.php",
            {
                addFrais: designation
            },
            function(resp){
                let dataJSON = JSON.parse(resp)
                if(dataJSON.code == 200){
                    window.location.reload()
                }else{
                    $('.msg-rubrique').html(dataJSON.data);
                }
            }
        )
    });

    $('.add-fixation').click(function (e) { 
        e.preventDefault();

        const coges = parseInt($(this).data('id'));
        const designation = $('#designation-rubrique').val();
        const montant = $('#montant-rubrique').val();
        const monnaie = $('#monnaie-rubrique').val();
        const semestre = $('#semestre-rubrique').val();
        const operateur = $('#operateur-rubrique').val();
        const code_access = $('#code-rubrique').val();
        let liste_classes = $('#classes-rubrique').val();

        let data = {
            id_coges: coges,
            rubrique: designation,
            montant : montant,
            monnaie: monnaie,
            semestre: semestre,
            id_operateur: operateur,
            code_access: code_access,
            id_niveaux: liste_classes
        }

        
        $.post(
            "./controleur/php/API.php",
            {
                addFinance: data
            },
            function(resp){
                let dataJSON = JSON.parse(resp)
                if(dataJSON.code == 200){
                    window.location.reload()
                }else{
                    $('.msg-rubrique').html(dataJSON.data);
                }
            }
        )
    });
    
    $('.add-operateur').click(function (e) { 
        e.preventDefault();
        
        const mdp = $('#mdp-agent').val();
        const grade = $('#grade-agent').val();
        const agent = $('#operateur-agent').val();

        let data = {
            mdp: mdp,
            grade: grade,
            id_agent : agent
        }
        
        $.post(
            "./controleur/php/API.php",
            {
                addOperateur: data
            },
            function(resp){
                let dataJSON = JSON.parse(resp)
                if(dataJSON.code == 200){
                    window.location.reload()
                }else{
                    $('.msg-operateur').html(dataJSON.data);
                }
            }
        )
    });

    $('#currentRubrique').change(function (e) { 
        e.preventDefault();
        
        $.post(
            "./controleur/php/API.php",
            {
                liste_paiements_rubrique : $(this).val()
            },
            function(resp){
                let dataJSON = JSON.parse(resp)
                
                $('#details_recettes').html('')
    
                if(dataJSON.code == 200){
                    let contenu = ''

                    $.each(dataJSON.data, function (index, element) {             
                        if (element.nom !== null) {    
                            // element == this
                        const key = parseInt(index) + 1
        
                            contenu += '<tr>' + 
                                            '<td>'+ key +'</td>'+
                                            '<td>'+ element.nom + ' ' + element.post_nom + ' ' + element.prenom +'</td>'+
                                            '<td>'+ element.TOTAL + ' ' + element.monnaie +'</td>'+
                                            '<td>'+ element.DETTES + ' ' + element.monnaie +'</td>'+
                                            '<td>'+ element.semestre +'</td>'+
                                            '<td class="datatable-ct">'+
                                                '<div class="button-ap-list responsive-btn">'+
                                                    '<div class="btn-group btn-custom-groups btn-custom-groups-one">'+
                                                        '<a type="button" class="btn btn-primary" href="index.php?financeEtudiant='+ element.id +'"><i class="fa fa-print"></i></a>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</td>'+
                                        '</tr>'
                            
                        } 
                         
                    });

                    
                    $('#details_recettes').html(contenu);      
                }
            }
        )
        
    });
        
    $.post(
        "./controleur/php/API.php",
        {
            liste_paiements_rubrique : $('#currentRubrique').val()
        },
        function(resp){
            let dataJSON = JSON.parse(resp)
            $('#details_recettes').html('')

            if(dataJSON.code == 200){
                let contenu = ''

                $.each(dataJSON.data, function (index, element) {             
                    if (element.nom !== null) {    
                        // element == this
                        const key = parseInt(index) + 1
    
                        contenu += '<tr>' + 
                                        '<td>'+ key +'</td>'+
                                        '<td>'+ element.nom + ' ' + element.post_nom + ' ' + element.prenom +'</td>'+
                                        '<td>'+ element.TOTAL + ' ' + element.monnaie +'</td>'+
                                        '<td>'+ element.DETTES + ' ' + element.monnaie +'</td>'+
                                        '<td>'+ element.semestre +'</td>'+
                                        '<td class="datatable-ct">'+
                                            '<div class="button-ap-list responsive-btn">'+
                                                '<div class="btn-group btn-custom-groups btn-custom-groups-one">'+
                                                    '<a type="button" class="btn btn-primary" href="index.php?financeEtudiant='+ element.id +'"><i class="fa fa-print"></i></a>'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                    '</tr>'
                        
                    } 
                     
                });
                
                $('#details_recettes').html(contenu); 
          
            }
        }
    )

    $('.updatePassAdmin').click(function (e) { 
        e.preventDefault();

        const coges = $(this).data('id');
        const currMdp = $('.current-mdp-admin').val();
        const newMdp = $('.mdp-admin').val();
        const confMdp = $('.cmdp-admin').val();

        if (newMdp == confMdp) {

            let data = {
                coges,
                currMdp,
                newMdp
            }
            
            $.post(
                "./controleur/php/API.php",
                {
                    update_pass_coges : data
                },
                function(resp){
                    let dataJSON = JSON.parse(resp)
        
                    if(dataJSON.code == 200){ 
                        $('.msg-admin').html(dataJSON.data); 
                        $('.cmdp-admin').val(''); 
                        $('.mdp-admin').val('');
                        $('.current-mdp-admin').val('');
    
                    }else{
                        $('.msg-admin').html(dataJSON.data);
                    }
                }
            )
            
        } else {
            $('.msg-admin').html("Le mot de passe doit correspondre...<br />Veuillez insérer le même mot de passe.");
            
        }

    })

    $('.print-recettes').click(function(e){
        let data = {
            debut : $('#date-debut-recettes').val(),
            fin : $('#date-fin-recettes').val(),
            rubrique : $('.currentRubrique').val(),
        }
        
        window.location.href='index.php?print_recettes='+data.rubrique+'&debut='+data.debut+'&fin='+data.fin
    })
})