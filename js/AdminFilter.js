var adminFilters = {
    transac : [],
    type        : [],
    city        : [],
    depart      : [],
    region      : [],
    price_min   : [],
    price_max   : []
}



////////////////////////////////////////////////////////////// INPUT TYPE DE TRANSACTION
$('.transaction').click(function(){

    this.dataName           = $(this).attr('name');
    var adminFiltersTransac   = adminFilters.transac;
    var inTransFilter       = adminFiltersTransac.indexOf(this.dataName)

    

    if(inTransFilter > -1){

        adminFiltersTransac.splice(inTransFilter, 1)

    }else
    {

        adminFiltersTransac.push(this.dataName)

    }
        

    if(adminFiltersTransac == "achat"){
        $('.pPrice').addClass('hide')
        $('.admin_select_buy').removeClass('hide')

    }else if(adminFiltersTransac == "location"){
        $('.pPrice').addClass('hide')  
        $('.admin_select_rent').removeClass('hide')


    }else{
        $('.pPrice').removeClass('hide')
        $('.admin_select_buy').addClass('hide')
        $('.admin_select_rent').addClass('hide')

    }





})// FIN DE LA FUNCTION POUR INPUT TYPE DE TRANSACTION

////////////////////////////////////////////////////////////// INPUT TYPE DE BIENS
$('.AdminTypeFilter').click(function(){

    this.dataName               = $(this).attr('name');
    var adminFiltersType        = adminFilters.type;
    var inTypeFilter            = adminFiltersType.indexOf(this.dataName)

    

    if(inTypeFilter > -1){

        adminFiltersType.splice(inTypeFilter, 1)

    }else
    {

        adminFiltersType.push(this.dataName)

    }

        
})// FIN DE LA FUNCTION POUR INPUT TYPE DE BIENS


////////////////////////////////////////////////////////////// INPUT CITY

$('.adminInputCity').click(function(){

    this.dataName   = $(this).attr('name');
    var adminFiltersCity = adminFilters.city;
    var inCityFilter     = adminFiltersCity.indexOf(this.dataName)

    

    if(inCityFilter > -1){

        adminFiltersCity.splice(inCityFilter, 1)

    }else
    {

        adminFiltersCity.push(this.dataName)

    }

})// FIN DE LA FUNCTION POUR INPUT CITY

////////////////////////////////////////////////////////////// INPUT PRIX, DEPART, REGION



$('.adminFilter').click(function(e){

    e.preventDefault()

    if(adminFilters.transac == "achat"){

        this.priceMin       =   parseInt($('.admin_select_price_min').val())
        this.priceMax       =   parseInt($('.admin_select_price_max').val())

    }else if(adminFilters.transac == "location"){
       

        this.priceMin       =   parseInt($('.admin_rent_select_price_min').val())
        this.priceMax       =   parseInt($('.admin_rent_select_price_max').val())


    }else{
        this.priceMin       =   0
        this.priceMax       =   1000000
    }


    

    this.region         =   parseInt($('.admin_select_region').val())
    this.depart         =   parseInt($('.admin_select_depart').val())
   

    var adminFiltersPriceMin  =   adminFilters.price_min
    var adminFiltersPriceMax  =   adminFilters.price_max

    var adminFiltersDepart    =   adminFilters.depart
    var adminFiltersRegion    =   adminFilters.region
    
    if(isNaN(this.depart)){
        adminFiltersDepart = []
    }else{
        adminFiltersDepart.splice(0,1)
        adminFiltersDepart.push(this.depart)
    }

    if(isNaN(this.region)){
        adminFiltersRegion = []
    }else{
        adminFiltersRegion.splice(0,1)
        adminFiltersRegion.push(this.region)
    }
    
    

    if(this.priceMin >= this.priceMax ){
        $('.alert-danger').empty().removeClass("hide").append('Le prix maximum est inférieur ou égal au prix minimum.')
    }else{
        $('.alert-danger').empty().addClass("hide")
        adminFiltersPriceMin.splice(0,1)
        adminFiltersPriceMin.push(this.priceMin)
        adminFiltersPriceMax.splice(0,1)
        adminFiltersPriceMax.push(this.priceMax)
    }

    
})


///////// AJAX TO PHP SCAN DU TABLEAU FILTERS AVEC IF SWITCH CASE ET APPEND DE "RESULT"

$('.adminFilter').click(function(){

    console.log(adminFilters)
    $.ajax({

        url:'../library/AdminFilter.php',
        type:'get',
        data : {adminFilters : adminFilters},
        dataType:'json',
        success: function(result){

            
            var region = []
            region["1"] = "Auvergne-Rhône-Alpes";
            region["2"] = "Bourgogne-France-Comté";
            region["3"] = "Bretagne";
            region["4"] = "Centre-Val de Loire";
            region["5"] = "Corse";
            region["6"] = "Grand Est";
            region["7"] = "Haut-de-France";
            region["8"] = "Île-de-France";
            region["9"] = "Normandie";
            region["10"] = "Nouvelle-Aquitaine";
            region["11"] = "Occitanie";
            region["12"] = "Pays-de-la-Loire";
            region["13"] = "Provence-Alpes-Côte-d'Azur";

            departements = []; 
            departements['01'] = 'Ain'; 
            departements['02'] = 'Aisne'; 
            departements['03'] = 'Allier'; 
            departements['04'] = 'Alpes de Haute Provence'; 
            departements['05'] = 'Hautes Alpes'; 
            departements['06'] = 'Alpes Maritimes'; 
            departements['07'] = 'Ardèche'; 
            departements['08'] = 'Ardennes'; 
            departements['09'] = 'Ariège'; 
            departements['10'] = 'Aube'; 
            departements['11'] = 'Aude'; 
            departements['12'] = 'Aveyron'; 
            departements['13'] = 'Bouches du Rhône'; 
            departements['14'] = 'Calvados'; 
            departements['15'] = 'Cantal'; 
            departements['16'] = 'Charente'; 
            departements['17'] = 'Charente Maritime'; 
            departements['18'] = 'Cher'; 
            departements['19'] = 'Corrèze'; 
            departements['2A'] = 'Corse du Sud'; 
            departements['2B'] = 'Haute Corse'; 
            departements['21'] = 'Côte d\'Or'; 
            departements['22'] = 'Côtes d\'Armor'; 
            departements['23'] = 'Creuse'; 
            departements['24'] = 'Dordogne'; 
            departements['25'] = 'Doubs';
            departements['26'] = 'Drôme'; 
            departements['27'] = 'Eure'; 
            departements['28'] = 'Eure et Loir'; 
            departements['29'] = 'Finistère'; 
            departements['30'] = 'Gard'; 
            departements['31'] = 'Haute Garonne'; 
            departements['32'] = 'Gers'; 
            departements['33'] = 'Gironde'; 
            departements['34'] = 'Hérault'; 
            departements['35'] = 'Ille et Vilaine'; 
            departements['36'] = 'Indre'; 
            departements['37'] = 'Indre et Loire'; 
            departements['38'] = 'Isère'; 
            departements['39'] = 'Jura'; 
            departements['40'] = 'Landes'; 
            departements['41'] = 'Loir et Cher'; 
            departements['42'] = 'Loire'; 
            departements['43'] = 'Haute Loire'; 
            departements['44'] = 'Loire Atlantique'; 
            departements['45'] = 'Loiret'; 
            departements['46'] = 'Lot'; 
            departements['47'] = 'Lot et Garonne'; 
            departements['48'] = 'Lozère'; 
            departements['49'] = 'Maine et Loire'; 
            departements['50'] = 'Manche'; 
            departements['51'] = 'Marne'; 
            departements['52'] = 'Haute Marne'; 
            departements['53'] = 'Mayenne'; 
            departements['54'] = 'Meurthe et Moselle'; 
            departements['55'] = 'Meuse'; 
            departements['56'] = 'Morbihan'; 
            departements['57'] = 'Moselle'; 
            departements['58'] = 'Nièvre'; 
            departements['59'] = 'Nord'; 
            departements['60'] = 'Oise'; 
            departements['61'] = 'Orne'; 
            departements['62'] = 'Pas de Calais'; 
            departements['63'] = 'Puy de Dôme'; 
            departements['64'] = 'Pyrénées Atlantiques'; 
            departements['65'] = 'Hautes Pyrénées'; 
            departements['66'] = 'Pyrénées Orientales'; 
            departements['67'] = 'Bas Rhin'; 
            departements['68'] = 'Haut Rhin'; 
            departements['69'] = 'Rhône-Alpes'; 
            departements['70'] = 'Haute Saône'; 
            departements['71'] = 'Saône et Loire'; 
            departements['72'] = 'Sarthe'; 
            departements['73'] = 'Savoie'; 
            departements['74'] = 'Haute Savoie'; 
            departements['75'] = 'Paris'; 
            departements['76'] = 'Seine Maritime'; 
            departements['77'] = 'Seine et Marne'; 
            departements['78'] = 'Yvelines'; 
            departements['79'] = 'Deux Sèvres'; 
            departements['80'] = 'Somme'; 
            departements['81'] = 'Tarn'; 
            departements['82'] = 'Tarn et Garonne'; 
            departements['83'] = 'Var'; 
            departements['84'] = 'Vaucluse'; 
            departements['85'] = 'Vendée'; 
            departements['86'] = 'Vienne'; 
            departements['87'] = 'Haute Vienne'; 
            departements['88'] = 'Vosges'; 
            departements['89'] = 'Yonne'; 
            departements['90'] = 'Territoire de Belfort'; 
            departements['91'] = 'Essonne'; 
            departements['92'] = 'Hauts de Seine'; 
            departements['93'] = 'Seine St Denis'; 
            departements['94'] = 'Val de Marne'; 
            departements['95'] = 'Val d\'Oise'; 
            departements['97'] = 'DOM'; 
            departements['971'] = 'Guadeloupe'; 
            departements['972'] = 'Martinique'; 
            departements['973'] = 'Guyane'; 
            departements['974'] = 'Réunion'; 
            departements['975'] = 'Saint Pierre et Miquelon'; 
            departements['976'] = 'Mayotte';
                
            $('.adminResult').empty();
            
            for (i=0 ; i<result.length ; i++)
            {                
                region.forEach((regName, index) => {
                    if (index == result[i].region){
                        result[i].region = regName
                    }
                  }) 

                  departements.forEach((depName, index) => {
                    if (index == result[i].departement){
                        result[i].departement = depName
                    }
                  }) 

                  if(result[i].transac == "Achat"){
                    var prix = result[i].prix + '€'
                  }else{
                    var prix = result[i].prix + ' €/mois'
                  }
                $('.adminResult').append('<tr>'+
                                    '<th scope="row">' + result[i].id + '</th>' +
                                    '<td class="col_titre">' + result[i].titre + '</td>' +
                                    '<td class="col_type">' + result[i].type + '</td>' +
                                    '<td class="col_transac">' + result[i].transac + '</td>' +
                                    '<td class="col_ville">' + result[i].ville + '</td>' +
                                    '<td class="col_depart">' + result[i].departement + '</td>' +    
                                    '<td class="col_region">' + result[i].region + '</td>'+
                                    '<td class="col_prix">' + prix + '</td>'+
                                    '<td class="col_lien">' + '<a href =' + 'ItemController.php?id=' + result[i].id + ' class="btn btn-primary btn_voir_admin"' +'>Voir' +
                                    '</a>' +
                                    '</td>'+
                                    '</tr>') 
                
                
               
            }//FIN DE FOR
        }//FIN DE SUCCESS
    });//FIN DE AJAX



// SI LE TABLEAU FILTERS EST VIDE 

    var fTypeLength = filters.type.length
    var fCityLength = filters.city.length
    var fPMaxLength = filters.price_max.length
    var fPMinLength = filters.price_min.length


    if( fTypeLength === 0 && fCityLength === 0 && fPMinLength === 0 && fPMaxLength === 0){
        $('.result').empty();
        $('.result').append('<div>' +
                                '<p class="big-text">'+
                                '<i class="fas fa-long-arrow-alt-left"></i> ' + 
                                '<span>Trouvez votre bonheur en sélectionnant un ou plusieurs filtres dans cette colone.</span>'+
                            '</div>')
    }
    
})





                
