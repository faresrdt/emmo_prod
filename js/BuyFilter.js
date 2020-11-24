var filters = {
    type : [],
    city : [],
    price_min :[],
    price_max : []
}



////////////////////////////////////////////////////////////// INPUT TYPE DE TRANSACTION
$('.input-type-buy').click(function(){

    this.dataName   = $(this).attr('name');
    var filtersType = filters.type;
    var inArray     = filtersType.indexOf(this.dataName)

    

    if(inArray > -1){

        filtersType.splice(inArray, 1)

    }else
    {

        filtersType.push(this.dataName)

    }
        
})// FIN DE LA FUNCTION POUR INPUT-TYPE


////////////////////////////////////////////////////////////// INPUT CITY

$('.input-city-buy').click(function(){

    this.dataName   = $(this).attr('name');
    var filtersCity = filters.city;
    var inArray     = filtersCity.indexOf(this.dataName)

    // filtersCity.push(this.dataName)
    

    if(inArray > -1){

        filtersCity.splice(inArray, 1)

    }else
    {

        filtersCity.push(this.dataName)

    }
    

})

////////////////////////////////////////////////////////////// INPUT PRIX



$('.buyFilter').click(function(e){

    e.preventDefault()
    this.priceMin       =   parseInt($('.select_price_min').val())
    this.priceMax       =   parseInt($('.select_price_max').val())
   

    var filterPriceMin  =   filters.price_min
    var filterPriceMax  =   filters.price_max
    
    
    if(this.priceMin >= this.priceMax ){
        $('.alert-danger').empty().removeClass("hide").append('Le prix maximum est inférieur ou égal au prix minimum.')
    }else{
        $('.alert-danger').empty().addClass("hide")
        filterPriceMin.splice(0,1)
        filterPriceMin.push(this.priceMin)
        filterPriceMax.splice(0,1)
        filterPriceMax.push(this.priceMax)
    }


})


///////// AJAX TO PHP SCAN DU TABLEAU FILTERS AVEC IF SWITCH CASE ET APPEND DE "RESULT"

$('.input-buy, .buyFilter').click(function(){

    // console.log(filters)
    $.ajax({

        url:'/library/BuyFilter.php',
        type:'get',
        data : {filters : filters},
        dataType:'json',
        success: function(result){

            
            $('.result').empty();
            
            for (i=0 ; i<result.length ; i++)
            {                
                $('.result').append('<div class="col-sm-10 col-md-6 col-lg-4 mt-4">' +
                                        '<div class="card ' + result[i].titre + '">'+
                                            '<img class="card-img-top" src="../img/' + result[i].photo1 + '">' + '</img>'+
                                            '<div class="card-block">'+
                                            '<h4 class="card-title">' + result[i].titre + '</h4>'+
                                            '<div class="card-text">' + result[i].description.substr(0,110) + '...' + '</div>'+
                                            '</div>'+
                                            '<div class="card-footer">'+
                                            '<span class="col-md-6">' + new Intl.NumberFormat().format(result[i].prix) + '€</span>'+
                                            '<a href= "../controllers/ItemController.php?id='+ result[i].id + '"' +
                                            '<button type="button" class="col-md-6 btn btn-primary">Voir Plus</button>'+
                                            '</a>'+
                                            '</div>'+
                                            '</div>'+
                                            '</div>').hide().fadeIn(400)
               
            }//FIN DE FOR
        },//FIN DE SUCCESS
        error: function(result){
            console.log('erreur ajax')
            console.log(result)
        }
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





                
