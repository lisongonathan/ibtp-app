$(document).ready(function(){ 
    $('.ue-ok').hide();
    $('.ue-no').hide();

    $('.annulerBtn').click(function (e) { 
        e.preventDefault();
        
        window.history.back()
        
    })

    $('.delEC').click(function (e) { 
        e.preventDefault();

        let id = parseInt($(this).data("id"))

        let isOK = confirm("Voulez vous vraiment supprimer ce cours ?")

        if(isOK){
            $.post(
                "./controleur/php/API.php",
                {
                    deleteMatiere: id
                },
                function(data){
                    window.location.reload()
                }
            )
        }
        
    });

    $('.update_admin_etudiant').click(function (e) { 
        e.preventDefault();

        let id = parseInt($(this).data("id"))
        let diplome = $('.update_diplome').val();
        let mdp = $('.update_pass').val();
        let promotion = $('.update_promotion').val();

        let data = {
            'id' : id,
            'diplome' : diplome,
            'mdp' : mdp,
            'promotion' : promotion
        }

        let isOK = confirm("Voulez vous vraiment Modifier le(s) information(s) de l'étudiant ?")

        if(isOK){
            $.post(
                "./controleur/php/API.php",
                {
                    updateAdminStudent: data
                },
                function(resp){
                    let respJSON = JSON.parse(resp)

                    if (respJSON.code == 200) {
                        alert(respJSON.data)
                        window.history.back()
                        
                    } else {
                        alert(respJSON.data)
                        
                    }
                }
            )
        }
        
    });

    $('.updateEC').click(function (e) { 
        e.preventDefault();

        let id = parseInt($(this).data("id"))

        window.location.href='index.php?editCours=' + id
        
    });

    $('.suppStudent').click(function (e) { 
        e.preventDefault();

        let id = parseInt($(this).data("id"))

        let isOK = confirm("Voulez vous vraiment supprimer cette etudiant ?")

        if(isOK){
            $.post(
                "./controleur/php/API.php",
                {
                    deleteEtudiant: id
                },
                function(data){
                    const dataJSON = JSON.parse(data)
                    alert(dataJSON.data)
                    window.history.back()
                }
            )
        }
        
    });

    $('#addUE-form').on('click', function(e){
        e.preventDefault()
        let designation = $('#ue-designation').val()
        let code = $('#ue-code').val()
        if(designation.length && code.length){
            $.post(
                "./controleur/php/API.php",
                {
                    uE_designation: designation,
                    uE_code: code
                },
                function(response){
                    let dataJSON = JSON.parse(response)
                    if(dataJSON.code == 200){
                        $('#ue-designation').val('')
                        $('#ue-code').val('')
                        $('.ue-ok').fadeIn('slow', function(){window.history.back()});
                    }else{
                        $('.ue-no').fadeIn('slow');
                    }
                })
        }else{
            alert("Veuillez completer tous les champs")
        }
    })

    // $('.suppUe').click(function (e) { 
    //     e.preventDefault();

    //     let id = parseInt($(this).data("id"))

    //     alert(this.id)
        
    //     let isOK = confirm("Voulez vous vraiment supprimer cette unite ?")

    //     if(isOK){
    //         $.post(
    //             "./controleur/php/API.php",
    //             {
    //                 delUE: id
    //             },
    //             function(data){
    //                 const response = JSON.parse(data)
    //                 alert(response.data)
    //                 window.location.reload()
    //             }
    //         )
    //     }
        
    // });


    $('.updateUe').click(function (e) { 
        e.preventDefault();

        let id = parseInt($(this).data("id"))

        const isOK = confirm('Souhaiter vous changer l\'intitule de l\'UE ?')
        if (isOK) {
            const intitule = prompt('Modifier l\'intitule ici...')
            if(intitule){
        
                if(isOK){
                    $.post(
                        "./controleur/php/API.php",
                        {
                            updateEC: id,
                            designation: intitule
                        },
                        function(data){
                            const response = JSON.parse(data)

                            alert(response.data)
                            const isOK = confirm('Souhaiter vous aussichanger le code de l\'UE ?')
                
                            if (isOK) {                
                                const code = prompt('Modifier le code ici...')
                                if (code) {
                        
                                    if(isOK){
                                        $.post(
                                            "./controleur/php/API.php",
                                            {
                                                updateEC: id,
                                                code: code
                                            },
                                            function(data){
                                                const response = JSON.parse(data)
                    
                                                alert(response.data)
                                                window.location.reload()
                                            }
                                        )
                                    }
                                    
                                }
                            } 
                            //window.location.reload()
                        }
                    )
                }
            }

        } else {
            const isOK = confirm('Souhaiter vous changer le code de l\'UE ?')

            if (isOK) {                
                const code = prompt('Modifier le code ici...')
                if (code) {
        
                    if(isOK){
                        $.post(
                            "./controleur/php/API.php",
                            {
                                updateEC: id,
                                code: code
                            },
                            function(data){
                                const response = JSON.parse(data)    
                                alert(response.data)
                                //window.location.reload()
                            }
                        )
                    }
                    
                }
            } else {
                //window.location.reload()
            }
            
        }
        
    });

    function getAllPromotions(){
      $.post(
        "./controleur/php/API.php",
        {
          promoOfSection: "all"
        },
        function(data){
              let dataJSON = JSON.parse(data)

              let nbrePromotion = 0

              $('.list-promotion').each(function (index, element) {
                // element == this
                let contenu = $(this).html()
                $(this).html('')
                if (index == 0 || index==3) {
                    $.each(dataJSON.data, function(key, value){  
                      nbrePromotion += 1            
                      if(value.orientation){
                          const orientation = value.orientation
                          contenu += '<li><a title="Tous les Enseignants" href="index.php?titulaires='+value.promo+'"><span class="mini-sub-pro">'+value.class+' '+orientation+'</span></a></li>'
                      }else{
                          const orientation = ""
                          contenu += '<li><a title="Tous les Enseignants Professors" href="index.php?titulaires='+value.promo+'"><span class="mini-sub-pro">'+value.class+' '+orientation+'</span></a></li>'
                      }
                    })
                    
                    $(this).prepend(contenu)
                    
                } else if(index == 1 || index==4){

                    $.each(dataJSON.data, function(key, value){  
                        nbrePromotion += 1            
                        if(value.orientation){
                            const orientation = value.orientation
                            contenu += '<li><a title="Tous les Etudiants" href="index.php?etudiants='+value.promo+'"><span class="mini-sub-pro">'+value.class+' '+orientation+'</span></a></li>'
                        }else{
                            const orientation = ""
                            contenu += '<li><a title="Tous les Etudiants" href="index.php?etudiants='+value.promo+'"><span class="mini-sub-pro">'+value.class+' '+orientation+'</span></a></li>'
                        }
                      })
                      
                      $(this).prepend(contenu)
                } else {
                    $.each(dataJSON.data, function(key, value){  
                      nbrePromotion += 1            
                      if(value.orientation){
                          const orientation = value.orientation
                          contenu += '<li><a title="Tous les cours" href="index.php?promotion='+value.promo+'"><span class="mini-sub-pro">'+value.class+' '+orientation+'</span></a></li>'
                      }else{
                          const orientation = ""
                          contenu += '<li><a title="Tous les cours" href="index.php?promotion='+value.promo+'"><span class="mini-sub-pro">'+value.class+' '+orientation+'</span></a></li>'
                      }
                    })
                    
                    $(this).prepend(contenu)
                    
                }
              
              $('.nbrePromo').html(nbrePromotion + ' Promotions')
              nbrePromotion = 0
              });

        }
      )        
    }
    getAllPromotions()
    //setInterval(getAllPromotions,10000)
   
   function getChefSection(){        
        $.post(
            "./controleur/php/API.php",
            {
                chefSection: "All"
            },
            function(data){
                let dataJSON = JSON.parse(data)

                $('.chefSection').prepend(dataJSON.data.grade + ', ' + dataJSON.data.nom + '<br> ' + dataJSON.data.post_nom)
                console.log($('.chefSection').html(), dataJSON.data.nom)
            }
        )
    }
    getChefSection()
    //setInterval(getChefSection, 1000);

    function getEffEtudiant(){        
        $.post(
            "./controleur/php/API.php",
            {
                effectifEtudiants: "All"
            },
            function(data){
                let dataJSON = JSON.parse(data)
                const total = parseInt(dataJSON.data)

                window.localStorage.setItem('EFT', total)

            }
        )
    }

    getEffEtudiant()

    //setInterval(getEffEtudiant, 1000);

    function getEffEnseignant(){        
        $.post(
            "./controleur/php/API.php",
            {
                effectifEnseignant: "All"
            },
            function(data){
                let dataJSON = JSON.parse(data)

                $('.nbreTitulaires').html(dataJSON.data)

            }
        )
    }

    getEffEnseignant()

    //setInterval(getEffEnseignant, 1000);

    function getEffMISTA(){        
        $.post(
            "./controleur/php/API.php",
            {
                effectM: "All"
            },
            function(data){
                let dataJSON = JSON.parse(data)

                $('#effectifM-ista').prepend(dataJSON.data)
            }
        )
    }

    getEffMISTA()

    //setInterval(getEffMISTA, 1000);

    function getEffFISTA(){        
        $.post(
            "./controleur/php/API.php",
            {
                effectF: "All"
            },
            function(data){
                let dataJSON = JSON.parse(data)

                $('#effectifF-ista').prepend(dataJSON.data)

            }
        )
    }

    getEffFISTA()

    //setInterval(getEffFISTA, 1000);

    const cibleEnrol = parseInt(window.localStorage.getItem('EFT'))*10
    $('.enrol').html(cibleEnrol)   

    function getEffEC(){        
        $.post(
            "./controleur/php/API.php",
            {
                effectifEC: "All"
            },
            function(data){
                let dataJSON = JSON.parse(data)

                $('.cours-s').html(dataJSON.data)

            }
        )
    }

    getEffEC()

   //setInterval(getEffEC, 1000);

   $('.add_etudiant').click(function (e) { 
    e.preventDefault();

    let dataStudent = {
        'NOM' : $('.nom_etudiant').val(),
        'POST-NOM' : $('.post_nom_etudiant').val(),
        'PRENOM' : $('.prenom_etudiant').val(),
        'NATIONALITE' : $('.nationalite_etudiant').val(),
        'DATE DE NAISSANCE' : $('.date_etudiant').val(),
        'LIEU DE NAISSANCE' : $('.lieu_naiss_etudiant').val(),
        'SEXE' : $('.sexe_etudiant').val(),
        'DIPLOME' : $('.diplome_etudiant').val(),
        'PROMOTION' : $('.promotion_etudiant').val(),
        'AJAC' : $('.ajac_etudiant').val(),
        'FRAIS ACADEMQIUE': $('.frais_acad_etudiant').val(),
        'FRAIS CONNEXE S1': parseFloat($('.frais_connexe_s1').val()),
        'FRAIS CONNEXE S2' : parseFloat($('.frais_connexe_s2').val())
    }

    if(dataStudent.dettes){
        alert("Vous signifierez plus tard les éléments constitutifs à reprendre")

    }
    
    $.each(dataStudent, function(key, value) {
        if(value){
            console.log(value)
        }else{

            if(key === 'NOM'){
                let info = prompt('Veuillez Completer le ' + key, '')
                while(!info){
                    info = prompt('Veuillez Completer le ' + key, '')
                }
    
                dataStudent[key] = info
            }else{
    
                dataStudent[key] = value

            }

            if(key === 'POST-NOM'){
                let info = prompt('Veuillez Completer le ' + key, '')
                while(!info){
                    info = prompt('Veuillez Completer le ' + key, '')
                }
    
                dataStudent[key] = info
            }else{
    
                dataStudent[key] = value

            }


            if(key === 'PRENOM'){
                let info = prompt('Veuillez Completer le ' + key, '')
                while(!info){
                    info = prompt('Veuillez Completer le ' + key, '')
                }
            }else{
    
                dataStudent[key] = value

            }
            
            if(key === 'DIPLOME'){
                let info = prompt('Veuillez Completer le ' + key, '')
                while(!info){
                    info = prompt('Veuillez Completer le ' + key, '')
                }
    
                dataStudent[key] = info
            }else{
    
                dataStudent[key] = value

            }

            
            if(key === 'PROMOTION'){
                console.log(key, value)
            }else{
    
                dataStudent[key] = value

            }

            
        }
    })

    $.post(
        "./controleur/php/API.php",
        {
            new_student :dataStudent
        },
        function (data) {
            const dataJSON = JSON.parse(data)

            if(dataJSON.code == 200){
                alert(dataJSON.data)
                window.location.reload()
            }else{
                alert(dataJSON.data)
            }
        }
    );  
    
   });

   $('.update_add_ajac_etudiant').click(function(e){
    e.preventDefault()

    let student = parseInt($(this).data('id'))

    let idMatiere = $('.ec_ajac').val()

    let cote = parseFloat($('.cote_ajac').val());

    while(cote < 0 || cote >= 10){
        alert("Cette matiere ne peut être considerer comme AJAC, parce que l'étudiant n'a pas échoué ")
        cote = parseFloat(prompt("Veuillez insérer la cote obtenu par l'étudiant, svp", ""))
    }

    if (idMatiere !== null && cote !== null) {        
        const dataStudent = {
            id : student,
            matiere : idMatiere,
            echec : cote
        }

        $.post(
            "./controleur/php/API.php",
            {
                ajac_student :dataStudent
            },
            function (data) {
                const dataJSON = JSON.parse(data)

                if(dataJSON.code == 200){
                    alert(dataJSON.data)
                    window.location.reload()
                }else{
                    alert(dataJSON.data)
                }
            }
        ); 
    } else {
        alert("Vous devrez signifier la matiere et la cote obtenue par l'étudiant...")
    }
   })

   $('.update_del_ajac_etudiant').click(function (e) { 
    e.preventDefault();
    let id = $(this).data('id')

    let isOK = confirm("Voulez vous vraiment supprimer cette AJAC ?")

    if(isOK){

        $.post(
            "./controleur/php/API.php",
            {
                del_ajac_student :id
            },
            function (data) {
                const dataJSON = JSON.parse(data)

                if(dataJSON.code == 200){
                    alert(dataJSON.data)
                    window.location.reload()
                }else{
                    alert(dataJSON.data)
                }
            }
        );
        
    }
   });

   $('#supp-jury').click(function (e) { 
    e.preventDefault();

    const id = $('#current-jury').val()

    $.post(
        "./controleur/php/API.php",
        {
            delete_jury :id
        },
        function (data) {
            const dataJSON = JSON.parse(data)

            if(dataJSON.code == 200){
                alert(dataJSON.data)
                window.location.reload()
            }else{
                alert(dataJSON.data)
            }
        }
    );
    
   });

   $('#sec-jury').change(function (e) { 
    e.preventDefault();

    if($(this).val() == $('#pres-jury').val()){
        alert('Le présindent du jury ne peut être à la fois président et secretaire')
        $(this).val(null)
    }
    
   });

   $('#add-jury').click(function(e){
    e.preventDefault()

    const nom_jury = $('#nom-jury').val() ? $('#nom-jury').val() : null

    const mdp_jury = $('#mdp-jury').val() ? $('#mdp-jury').val() : null

    const pres_jury = $('#pres-jury').val() ? $('#pres-jury').val() : null

    const sec_jury = $('#sec-jury').val() ? $('#sec-jury').val() : null

    const promotions_jury = $('#promotions-jury').val() ? $('#promotions-jury').val() : null

    const statut_jury = $('#statut-jury').prop('checked') == true ? 'on' : 'off'

    if (nom_jury && mdp_jury && pres_jury && sec_jury && promotions_jury && statut_jury) {

        let data = {
            JURY: nom_jury,
            MOT_DE_PASSE: mdp_jury,
            PRESIDENT: pres_jury,
            SECRETAIRE: sec_jury,
            PROMOTIONS: promotions_jury,
            STATUT: statut_jury
        }   

        if (data.PRESIDENT == data.SECRETAIRE) {
            alert('Le président du jury ne peut être aussi secretaire à la fois')

        } else {

            $.post(
                "./controleur/php/API.php",
                {
                    add_jury :data
                },
                function (data) {
                    const dataJSON = JSON.parse(data)
    
                    if(dataJSON.code == 200){
                        console.log(dataJSON.data)
                        window.location.reload()
                    }else{
                        alert(dataJSON.data)
                    }
                }
            );
        }
        
    } else {
        alert('Veuillez remplir tous les champs et verifier que le président n\'est pas le secretaire.') 

    }
   });

   $('#add-enseignant').click(function(e){
    e.preventDefault()

    const nom_enseignant = $('#nom-enseignant').val() ? $('#nom-enseignant').val() : null

    const post_nom_enseignant = $('#post-nom-enseignant').val() ? $('#post-nom-enseignant').val() : null

    const prenom_enseignant = $('#post-nom-enseignant').val() ? $('#post-nom-enseignant').val() : null

    const sexe_enseignant = $('#sexe-enseignant').val() ? $('#sexe-enseignant').val() : null

    const grade_enseignant = $('#grade-enseignant').val() ? $('#grade-enseignant').val() : null

    const statut_enseignant = $('#statut-enseignant').val() ?  $('#statut-enseignant').val() : null

    if (nom_enseignant &&  post_nom_enseignant && prenom_enseignant && sexe_enseignant && grade_enseignant && statut_enseignant) {

        let data = {
            NOM: nom_enseignant,
            POST_NOM: post_nom_enseignant,
            PRENOM: prenom_enseignant,
            SEXE: sexe_enseignant,
            GRADE: grade_enseignant,
            STATUT: statut_enseignant
        }

        $.post(
            "./controleur/php/API.php",
            {
                add_titulaire :data
            },
            function (data) {
                const dataJSON = JSON.parse(data)

                if(dataJSON.code == 200){
                    //console.log(dataJSON.data)
                    window.location.reload()
                }else{
                    alert(dataJSON.data)
                }
            }
        );
        
    } else {
        alert('Veuillez remplir tous les champs...') 

    }
   })

   $('#update-jury').click(function (e) { 
        e.preventDefault();

        const id = $('#current-jury').val()
        
        let new_mdp = prompt('Modifier le mot de passe de connexion du jury', '')

        while(!new_mdp){
            new_mdp = prompt('Le mot de passe de connexion du jury ne doit pas être vide', '')

            if(new_mdp){
                break
            }
        }

        $.post(
            "./controleur/php/API.php",
            {
                update_mdp_jury : parseInt($('#current-jury').val()),
                mdp: new_mdp

            },
            function (data) {
                const dataJSON = JSON.parse(data)
     
                if(dataJSON.code == 200){
                    alert(dataJSON.data)
                    window.location.reload()
                }else{
                    alert(dataJSON.data)
                }
         })
    
   });

   $('#update-mdp-titulaire').click(function (e) { 
        e.preventDefault();

        const id = $('#current-titulaire').val()

        let isOK = confirm('Voulez vous vraiment reinitialiser le mot de passe de connexion de cette enseignant')
        
        if (isOK) {
            let new_mdp = prompt('Entrer le mot de passe de recupération du compte de l\'enseignant', '')
    
            while(!new_mdp){
                new_mdp = prompt('Le mot de passe de connexion ne doit pas être vide', '')
            }

            $.post(
                "./controleur/php/API.php",
                {
                    update_mdp_titulaire : id,
                    mdp: new_mdp
    
                },
                function (data) {
                    const dataJSON = JSON.parse(data)
         
                    if(dataJSON.code == 200){
                        alert(dataJSON.data)
                        window.location.reload()
                    }else{
                        alert(dataJSON.data)
                    }
             })
            
        }
    
   });
   
   $('#current-jury').change(function (e) { 
    e.preventDefault();

    const id = parseInt($(this).val());

    $.post(
        "./controleur/php/API.php",
        {
            statut_jury :id
        },
        function (data) {
            const dataJSON = JSON.parse(data)

            if(dataJSON.data == "on"){
                $('#authorisation-jury').prop('checked', true);
            }else{
                $('#authorisation-jury').prop('checked', false);
            }
        }
    );
    
   });
   
   $('#current-titulaire').change(function (e) { 
    e.preventDefault();

    const id = parseInt($(this).val());

    $.post(
        "./controleur/php/API.php",
        {
            statut_titulaire :id
        },
        function (data) {
            const dataJSON = JSON.parse(data)

            if(dataJSON.data == "PERMANANT"){
                $('#statut-titulaire').prop('checked', true);
            }else{
                $('#statut-titulaire').prop('checked', false);
            }
        }
    );
    
   });

   $.post(
       "./controleur/php/API.php",
       {
           statut_titulaire :parseInt($('#current-titulaire').val())
       },
       function (data) {
           const dataJSON = JSON.parse(data)

           if(dataJSON.data == "PERMANANT"){
               $('#statut-titulaire').prop('checked', true);
           }else{
               $('#statut-titulaire').prop('checked', false);
           }
       }
   );

   $.post(
       "./controleur/php/API.php",
       {
           statut_jury : parseInt($('#current-jury').val())
       },
       function (data) {
           const dataJSON = JSON.parse(data)

           if(dataJSON.data == "on"){
               $('#authorisation-jury').prop('checked', true);
           }else{
               $('#authorisation-jury').prop('checked', false);
           }
    })

    $('#authorisation-jury').change(function (e) { 
        e.preventDefault();

        const statut = $(this).prop('checked') == true ? 'on' : 'off'

        $.post(
            "./controleur/php/API.php",
            {
                update_statut_jury : parseInt($('#current-jury').val()),
                statut: statut

            },
            function (data) {
                const dataJSON = JSON.parse(data)
     
                if(dataJSON.code == 200){
                    if(statut == 'on'){
                        alert("Ce JURY peut dorénavant faire la déliberation")
                    }else{
                        alert("Dorénavant ce Jury ne peut plus déliberer")
                    }
                }else{
                    alert(dataJSON.data)
                }
         })
        
    });

    $('#statut-titulaire').change(function (e) { 
        e.preventDefault();

        const statut = $(this).prop('checked') == true ? 'PERMANANT' : 'VISITEUR'

        $.post(
            "./controleur/php/API.php",
            {
                update_statut_titulaire : parseInt($('#current-titulaire').val()),
                statut: statut

            },
            function (data) {
                const dataJSON = JSON.parse(data)
     
                if(dataJSON.code == 200){
                    if(statut == 'PERMANANT'){
                        alert("Cette ENSEIGNANT fait desormais parti des PERMAMANTS")
                        window.location.reload()
                    }else{
                        alert("Cette ENSEIGNANT est dorénanvant un VISITEUR")
                        window.location.reload()
                    }
                }else{
                    alert(dataJSON.data)
                }
         })
        
    });

  })

