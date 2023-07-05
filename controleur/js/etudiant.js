(function ($) {
    "use strict";

    function getStatistiqueAcademique(){
        $.post(
            "./controleur/php/API.php",
            {
                statEtudiant :1
            },
            function (data) {
                const dataJSON = JSON.parse(data)
    
                if(dataJSON.code == 200){
                    console.log(dataJSON.data)
    
                    var total = ['SEMESTRE 1']
                    var matieres = []
    
                    $.each(dataJSON.data, function (key, value) { 
                         total.push(value.total)
                         matieres.push(value.ec)
                    });
    
       
                    c3.generate({
                        bindto: '#sem_1',
                        data:{
                            columns: [
                                total,
                            ],
                            colors:{
                                'SEMESTRE 1': '#006DF0'
                            },
                            type: 'spline'
                        }
                    });
                
                }else{
                    $('.graph-sem1').html(dataJSON.data);
                }
            }
        );
    
        $.post(
            "./controleur/php/API.php",
            {
                statEtudiant :2
            },
            function (data) {
                const dataJSON = JSON.parse(data)
    
                if(dataJSON.code == 200){
                    console.log(dataJSON.data)
    
                    var total = ['SEMESTRE 2']
                    var matieres = []
    
                    $.each(dataJSON.data, function (key, value) { 
                         total.push(value.total)
                         matieres.push(value.ec)
                    });
    
                    c3.generate({
                        bindto: '#sem_2',
                        data:{
                            columns: [
                                total,
                            ],
                            colors:{
                                'SEMESTRE 2': '#933EC5'
                            },
                            type: 'spline'
                        }
                    });
                
                }else{
                    $('.graph-sem2').html(dataJSON.data);
                }
            }
        );

    }

    getStatistiqueAcademique()

    setInterval(getStatistiqueAcademique, 3000);
   
   
   
   })(jQuery); 