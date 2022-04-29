console.log("CAROUSEL.js Chargé !");

const carousel = {
    // cette propriété nous permet de cibler la div contenant les "slides"
    slidesContainer: null,
    // propriété permettant de récupérer les differents boutons qui déclencheront l'animation du carousel
    buttons: null,
    // stocke la date du dernier clic
    lastClickDate: null,
    // cette propriété stockera le timer de l'auto slide
    timer: null,
    // le carousel commence par defaut à la slide numéro 0
    currentSlide: 0,
    // temps pour l'autoscroll
    duration: 2000,


    init: function(){
        console.log('Methode init');
        // je cible la div contenant les "slides" pour la ranger dans la propriété "slidesContainer"
        carousel.slidesContainer = document.querySelector('.customer-quotes__container');

        //je cible tous boutons :
        carousel.buttons = document.querySelectorAll('.carousel__nav__button');

        // Boucle qui va parcourir mon tableau de boutons
        for(let button of carousel.buttons){
            button.addEventListener('click', carousel.handleClick);
        }

        carousel.start();
        carousel.checkAutoRestart();
    },


    // lorsque je clic sur un bouton, je dois arreter le défilement automatique, il faut vérifier quand reprendre le défilement automatique, pour se faire on a codé la methode suivante avec un setInterval en 5500ms (donc on va avoir un morceau de code qui va se s'exectuer toute les demi secondes)
    checkAutoRestart: function(){
        setInterval(function(){
            console.log('je suis dans checkAutoRestart');
            // je récupère la date actuelle
            const currentDate = new Date();
            const currentTimestamp = currentDate.getTime();
            //console.log('timestamp actuel : ' + currentTimestamp );

            // si il y a déjà eu un VRAI clic utilisateur
            if(carousel.lastClickDate){
                // alors je calcule le temps qui s'est écoulé entre le VRAI clic utilisateur et MAINTENANT !
                let elapsed = currentTimestamp - carousel.lastClickDate;
                console.log('temps écoulé depuis dernier clic : ' + elapsed );

                if(elapsed > 3000){
                    carousel.lastClickDate = null;
                    carousel.start();
                }


            }
        }, 500);
    },




    // methode pour lancer le defilement automatique
    start: function(){
        carousel.timer = setInterval(
            function(){
                let newSlide = carousel.currentSlide++;
                let newSlideToDisplay = newSlide % carousel.buttons.length;
                //console.log(newSlideToDisplay)
                // Illustration du modulo (le reste d'une division)
                // 1 / 3 le reste de la division vaut 1
                // 2 / 3 le reste de la division vaut 2 
                // 3 / 3 le reste de la division vaut 0
                // 4 / 3 le reste de la division vaut 1
                // 5 / 3 le reste de la division vaut 2
                // 6 / 3 le reste de la division vaut 0

                carousel.buttons[newSlideToDisplay].click();

            }, 
            carousel.duration);
    },

    // methode click sur bouton
    handleClick: function(evt){
        // vérification : est ce que le clock est vraiment un click déclenché par le visiteur 
        if(evt.isTrusted){
            console.log('VRAI CLIC, je viens sauvegarder dans la propriété carousel.lastClickDate le timestamp !');
             //! ci dessous, ce morceau de code vas nous permettre de gérer le defilement auto / l'arret du defilement auto de mon diapo
            // enregistrement de la date du click du visiteur
            // je récupère un objet et grace a la methode getTime()
            // je vais pouvoir récupérer le timestamp
            const currentDate = new Date();
            //console.log(currentDate.getTime());
            carousel.lastClickDate = currentDate.getTime();
            carousel.stop();
        }

        // par sécurité, nous préférons interdire le comportement par defaut
        evt.preventDefault();

        // nous avons besoin de savoir sur quel bouton j'ai cliqué
        const clickedButton = evt.currentTarget;

        let slideToDisplay = clickedButton.dataset.slideNumber;
        /*
        console.log('dataset SlideNumer : ' +  clickedButton.dataset.slideNumber);
        clickedButton.style.backgroundColor = "#f0f";
        clickedButton.style.borderRadius = "20px";
        */
        carousel.displaySlide(slideToDisplay);
        // méthode pour ajouter la classe active au bouton sur lequel j'ai cliqué
        // je lui donne un ELEMENT bouton
        carousel.setCurrentButton(clickedButton);
    },

    // methode pour arreter le défilement auto
    stop: function(){
       clearInterval(carousel.timer);
    },

    // methode pour colorer le bouton cliqué en bleu
    setCurrentButton: function(clickedButton){
        // je veux avant toute chose cibler le bouton
        // qui est actuelement en bleu, avant de colorer le bouton sur lequel j'ai cliqué
        // ->
        // je cible l'élement qui a pour classe carousel__nav__button ET la classe active
        const currentButton = document.querySelector('.carousel__nav__button.active');
        currentButton.classList.remove('active');
        // maintenant il ne me reste plus qu'a ajouter la classe active au bouton clickedButton
        clickedButton.classList.add('active');
    },

    // methode pour afficher une slide
    displaySlide: function(slideNumber){
        // il faut faire scroller horizontalement l'élément contenant les slides.
        // pour se faire nous avons besoin de connaitre la largeur d'une silde, puis de la multiplier par le numéro de la slide demandé 

        // récupération de la largeur d'une slide en pixels
        let slideWidth = carousel.slidesContainer.offsetWidth;
        /*
        console.log('Je dois afficher la slide : ' + slideNumber + ', et la largeur du conteneur des slides est de : ' + slideWidth );
        */
        // calcul du scroll horizontal à effectuer pour afficher la slide demandée
        let horizontalScroll = slideWidth * slideNumber;
        //console.log(slideWidth + '*' +  slideNumber + '=' + horizontalScroll);

        // nous faison scroller le container des slides
        carousel.slidesContainer.scroll(horizontalScroll,0);
    }

};


document.addEventListener('DOMContentLoaded', carousel.init);
