$('.login-admin').click(function (e) { 
    e.preventDefault();
    
    const user = $('#code-admin').val();
    const mdp = $('#mdp-admin').val();
    const grade = $('#grade-admin').val();

    if (user && mdp && grade){
        $(".msg-admin").html("Vous serez connecter dans quelques instants...");

        
        $.post(
            "./controleur/php/API.php", 
            {
                authAdmin: user,
                mdp: mdp,
                grade: grade
            },
            function (data) {
                const dataJson = JSON.parse(data)

                if(dataJson.code != 200){
                    $('.msg-admin').html(dataJson.data)
                }else{
                    window.location.reload()
                }
            }
        );  
    } else {
        $(".msg-admin").html("Vous devrez remplir tous les champs...");
    }
    
});

$('.signin-admin').click(function (e) { 
    e.preventDefault();
    
    const user = $('#code-admin-signin').val();
    const mdp = $('#mdp-admin-signin').val();
    const cmdp = $('#cmdp-admin-signin').val();

    if (user && mdp && cmdp){

        if (mdp === cmdp) {
            $(".msg-admin").html("Vous serez inscrire dans quelques instants, ensuite vous pourrez vous connecter...");

            var data = {
                code_access: user,
                mdp: mdp
            }
        
            $.post(
                "./controleur/php/API.php", 
                {
                    addAdmin: data
                },
                function (data) {
                    const dataJson = JSON.parse(data)    
                    
                    $('.msg-admin').html(dataJson.data)
                }
            ); 
            
        } else {
            $(".msg-admin").html("Le mot de passe doit être identique...");            
        } 

    } else {
        $(".msg-admin").html("Vous devrez remplir tous les champs...");
    }
    
});

$('.connexionBtn').click(function (e) { 
    e.preventDefault();

    const moduleUser = parseInt(localStorage.getItem('moduleUser')) - 1
    
    const tabModule = ['etudiant', 'financier', 'jury', 'section', 'titulaire']

    const mdp = $('#mdp').val();
    const user = $('#code_access').val();

    if(mdp && user){
        //console.log(tabModule[moduleUser] + ' : ' + user, "Sera connecter bientôt avec comme mdp : " + mdp)
        
        if (tabModule[moduleUser] == 'section') {
            $.post(
                "./controleur/php/API.php", 
                {
                    authSection: user,
                    mdp: mdp
                },
                function (data) {
                    const dataJson = JSON.parse(data)

                    if(dataJson.code != 200){
                        $('.custom-login p').html(dataJson.data)
                    }else{
                        window.location.reload()
                    }
                }
            );                          
        } else if (tabModule[moduleUser] == 'titulaire') {
            $.post(
                "./controleur/php/API.php", 
                {
                    authTitulaire: user,
                    mdp: mdp
                },
                function (data) {
                    const dataJson = JSON.parse(data)

                    if(dataJson.code != 200){
                        $('.custom-login p').html(dataJson.data)
                    }else{
                        window.location.reload()
                    }
                }
            ); 
            
        } else if (tabModule[moduleUser] == 'etudiant') {
            $.post(
                "./controleur/php/API.php", 
                {
                    authEtudiant: user,
                    mdp: mdp
                },
                function (data) {
                    const dataJson = JSON.parse(data)

                    if(dataJson.code != 200){
                        $('.custom-login p').html(dataJson.data)
                    }else{
                        window.location.reload()
                    }
                }
            ); 
            
        } else{
            $.post(
                "./controleur/php/API.php", 
                {
                    authFinance: user,
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

    }else{
        $('.custom-login p').html('Veuillez remplir tous les champs svp...')
    }
})

$('.moduleUser').click(function (e) { 
    e.preventDefault();
    const module = parseInt($(this).data('id'))
    localStorage.setItem('moduleUser', module)
});