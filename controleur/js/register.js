$('.signinBtn').click(function (e) { 
    e.preventDefault();

    const typeUser = parseInt(localStorage.getItem('typeUser')) - 1
    
    const tabType = ['enseignant', 'etudiant']

    const user = parseInt($('.chosen-select').val())
    const mdp = $('.mdp-user').val();
    const cmdp = $('.cmdp-user').val();
    const addr = $('.addr-user').val();
    const tel = $('.tel-user').val();

    if(mdp && user && cmdp && addr && tel){
        if (mdp === cmdp) {
            //console.log("Mot de passe", "OK")
    
            if (addr) {
                if (tel) {
                    if (tabType[typeUser] == 'enseignant') {
                        //console.log(tabType[typeUser] + ' : ' + user, "Sera inscrit bientôt avec comme mdp : " + mdp + " = " + cmdp + ", adresse : " + addr + " et téléphone : " + tel)
                        $.post(
                            "./controleur/php/API.php", 
                            {
                                enseignant: user,
                                mdp: mdp,
                                addr: addr,
                                tel: tel
                            },
                            function (data) {
                                const dataJson = JSON.parse(data)
                                const statut = parseInt(dataJson.code)

                                if(statut == 200){
                                    alert(dataJson.data)
                                    window.location.replace('index.php')
                                }else{

                                    $('.custom-login p').html(dataJson.data)
                                }
                            }
                        );                          
                    }else{
                        $.post(
                            "./controleur/php/API.php", 
                            {
                                etudiant: user,
                                mdp: mdp,
                                addr: addr,
                                tel: tel
                            },
                            function (data) {
                                const dataJson = JSON.parse(data)
                                const statut = parseInt(dataJson.code)

                                if(statut == 200){
                                    alert(dataJson.data)
                                    window.location.replace('index.php')
                                }else{

                                    $('.custom-login p').html(dataJson.data)
                                }
                            }
                        ); 

                    }
                } else {
                    $('.custom-login p').html('Veuillez renseigner votre numéro de téléphone')
                }
            } else {
                $('.custom-login p').html('Veuillez renseigner votre adresse')
            }
        } else {
            $('.custom-login p').html('Les mots de passe doivent correspondre')
        }

    }else{
        $('.custom-login p').html('Veuillez remplir tous les champs svp...')
    }
})

$('.quitSigninBtn').click(function (e) { 
    e.preventDefault();
    const isOK = confirm('Vous avez déja un compte ?')

    if(isOK){
        window.location.replace('index.php')
    }
    
})

$('.user-type').click(function (e) { 
    e.preventDefault();
    const type = parseInt($(this).data('id'))
    localStorage.setItem('typeUser', type)
    if (type == 1) {
        window.location.replace('index.php?enseignants')
        
    } else {
        window.location.replace('index.php?etudiants')
        
    }
});