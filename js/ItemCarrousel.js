// Codes des touches du clavier.
const TOUCHE_GAUCHE = 37;
const TOUCHE_DROITE = 39;


// La liste des slides du carrousel.

var id = $(location).attr('search').split("?id=")[1]




var pics = $(".pics")
var slides = [];

$(document).ready(function(){

    $.ajax({

        url:'../library/Carrousel.php',
        type:'get',
        data : {id : id},
        dataType:'json',
        success: function(result){
            slides.push(result[0].photo1)
            slides.push(result[0].photo2)
            slides.push(result[0].photo3)
    
               }//FIN DE SUCCESS
        });//FIN DE AJAX

})
    

var state;


function onSliderGoToNext()
{
    // Passage à la slide suivante.
    state.index++;

    // Est-ce qu'on est arrivé à la fin de la liste des slides ?
    if(state.index == slides.length)
    {
        // Oui, on revient au début (le carrousel est circulaire).
        state.index = 0;
    }

    // Mise à jour de l'affichage.
    refreshSlider();
}


function onSliderGoToPrevious()
{
    // Passage à la slide précédente.
    state.index--;

    // Est-ce qu'on est revenu au début de la liste des slides ?
    if(state.index < 0)
    {
        // Oui, on revient à la fin (le carrousel est circulaire).
        state.index = slides.length - 1;
    }

    // Mise à jour de l'affichage.
    refreshSlider();
}

function onSliderKeyUp(event)
{
    /*
     * Les gestionnaires d'évènements d'appui sur une touche (évènements
     * keydown, keyup, keypress) contiennent une propriété keyCode dans l'objet
     * event représentant le code de la touche du clavier.
     *
     * Il existe de très nombreux codes, plus ou moins standards, voir la page :
     * https://developer.mozilla.org/en-US/docs/Web/API/KeyboardEvent/keyCode
     */

    switch(event.keyCode)
    {
        case TOUCHE_DROITE:
        // On passe à la slide suivante.
        onSliderGoToNext();
        break;

        case TOUCHE_GAUCHE:
        // On passe à la slide précédente.
        onSliderGoToPrevious();
        break;
    }
}

function refreshSlider()
{
    

    var slideState = slides[state.index]
    source = "../img/" + slideState

    $('.carousel-item img')[0].src = source

    // var i = state.index.toString()
    
    var liPoint = $('.li-point')

    
    for ($i = 0 ; $i<liPoint.length ; $i++)
    {
       if (state.index.toString() === $('.li-point')[$i].dataset.slideTo){
        
        var navI = liPoint.eq($i);
        liPoint.removeClass('active')
        navI.addClass('active')

       }
    }
    


}

/***********************************************************************************/
/* ******************************** CODE PRINCIPAL *********************************/
/***********************************************************************************/

/*
 * Installation d'un gestionnaire d'évènement déclenché quand l'arbre DOM sera
 * totalement construit par le navigateur.
 *
 * Le gestionnaire d'évènement est une fonction anonyme que l'on donne en deuxième
 * argument directement à document.addEventListener().
 */

$(document).ready(function()
{
    // Initialisation du carrousel.
    state       = {};
    state.index = 0;                   // On commence à la première slide


    // Installation des gestionnaires d'évènement.
    $("a.carousel-control-prev").click(onSliderGoToPrevious)
    $("a.carousel-control-next").click(onSliderGoToNext)

    /*
     * L'évènement d'appui sur une touche doit être installé sur l'ensemble de la
     * page, on ne recherche pas une balise en particulier dans l'arbre DOM.
     *
     * L'ensemble de la page c'est la balise <html> et donc la variable document.
     */
    $(document).on('keyup', onSliderKeyUp);
    // Equivalent à installEventHandler('html', 'keyup', onSliderKeyUp);


    // Affichage initial.
    // refreshSlider();
});

