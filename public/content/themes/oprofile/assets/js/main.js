// modules are defined as an array
// [ module function, map of requires ]
//
// map of requires is short require name -> numeric require
//
// anything defined in a previous bundle is accessed via the
// orig method which is the require for previous bundles
parcelRequire = (function (modules, cache, entry, globalName) {
  // Save the require from previous bundle to this closure if any
  var previousRequire = typeof parcelRequire === 'function' && parcelRequire;
  var nodeRequire = typeof require === 'function' && require;

  function newRequire(name, jumped) {
    if (!cache[name]) {
      if (!modules[name]) {
        // if we cannot find the module within our internal map or
        // cache jump to the current global require ie. the last bundle
        // that was added to the page.
        var currentRequire = typeof parcelRequire === 'function' && parcelRequire;
        if (!jumped && currentRequire) {
          return currentRequire(name, true);
        }

        // If there are other bundles on this page the require from the
        // previous one is saved to 'previousRequire'. Repeat this as
        // many times as there are bundles until the module is found or
        // we exhaust the require chain.
        if (previousRequire) {
          return previousRequire(name, true);
        }

        // Try the node require function if it exists.
        if (nodeRequire && typeof name === 'string') {
          return nodeRequire(name);
        }

        var err = new Error('Cannot find module \'' + name + '\'');
        err.code = 'MODULE_NOT_FOUND';
        throw err;
      }

      localRequire.resolve = resolve;
      localRequire.cache = {};

      var module = cache[name] = new newRequire.Module(name);

      modules[name][0].call(module.exports, localRequire, module, module.exports, this);
    }

    return cache[name].exports;

    function localRequire(x) {
      return newRequire(localRequire.resolve(x));
    }

    function resolve(x) {
      return modules[name][1][x] || x;
    }
  }

  function Module(moduleName) {
    this.id = moduleName;
    this.bundle = newRequire;
    this.exports = {};
  }

  newRequire.isParcelRequire = true;
  newRequire.Module = Module;
  newRequire.modules = modules;
  newRequire.cache = cache;
  newRequire.parent = previousRequire;
  newRequire.register = function (id, exports) {
    modules[id] = [function (require, module) {
      module.exports = exports;
    }, {}];
  };

  var error;
  for (var i = 0; i < entry.length; i++) {
    try {
      newRequire(entry[i]);
    } catch (e) {
      // Save first error but execute all entries
      if (!error) {
        error = e;
      }
    }
  }

  if (entry.length) {
    // Expose entry point to Node, AMD or browser globals
    // Based on https://github.com/ForbesLindesay/umd/blob/master/template.js
    var mainExports = newRequire(entry[entry.length - 1]);

    // CommonJS
    if (typeof exports === "object" && typeof module !== "undefined") {
      module.exports = mainExports;

      // RequireJS
    } else if (typeof define === "function" && define.amd) {
      define(function () {
        return mainExports;
      });

      // <script>
    } else if (globalName) {
      this[globalName] = mainExports;
    }
  }

  // Override the current require with this new one
  parcelRequire = newRequire;

  if (error) {
    // throw error from earlier, _after updating parcelRequire_
    throw error;
  }

  return newRequire;
})({
  "Dt8r": [function (require, module, exports) {

  }, {}], "uDrZ": [function (require, module, exports) {

  }, { "./vendor/_reset.css": "Dt8r" }], "j5Ly": [function (require, module, exports) {
    function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() { }; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it.return != null) it.return(); } finally { if (didErr) throw err; } } }; }

    function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

    function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

    console.log("CAROUSEL.js Chargé !");
    var carousel = {
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
      init: function init() {
        console.log('Methode init'); // je cible la div contenant les "slides" pour la ranger dans la propriété "slidesContainer"

        carousel.slidesContainer = document.querySelector('.customer-quotes__container'); //je cible tous boutons :

        carousel.buttons = document.querySelectorAll('.carousel__nav__button'); // Boucle qui va parcourir mon tableau de boutons

        var _iterator = _createForOfIteratorHelper(carousel.buttons),
          _step;

        try {
          for (_iterator.s(); !(_step = _iterator.n()).done;) {
            var button = _step.value;
            button.addEventListener('click', carousel.handleClick);
          }
        } catch (err) {
          _iterator.e(err);
        } finally {
          _iterator.f();
        }

        carousel.start();
        carousel.checkAutoRestart();
      },
      // lorsque je clic sur un bouton, je dois arreter le défilement automatique, il faut vérifier quand reprendre le défilement automatique, pour se faire on a codé la methode suivante avec un setInterval en 5500ms (donc on va avoir un morceau de code qui va se s'exectuer toute les demi secondes)
      checkAutoRestart: function checkAutoRestart() {
        setInterval(function () {
          console.log('je suis dans checkAutoRestart'); // je récupère la date actuelle

          var currentDate = new Date();
          var currentTimestamp = currentDate.getTime(); //console.log('timestamp actuel : ' + currentTimestamp );
          // si il y a déjà eu un VRAI clic utilisateur

          if (carousel.lastClickDate) {
            // alors je calcule le temps qui s'est écoulé entre le VRAI clic utilisateur et MAINTENANT !
            var elapsed = currentTimestamp - carousel.lastClickDate;
            console.log('temps écoulé depuis dernier clic : ' + elapsed);

            if (elapsed > 3000) {
              carousel.lastClickDate = null;
              carousel.start();
            }
          }
        }, 500);
      },
      // methode pour lancer le defilement automatique
      start: function start() {
        carousel.timer = setInterval(function () {
          var newSlide = carousel.currentSlide++;
          var newSlideToDisplay = newSlide % carousel.buttons.length; //console.log(newSlideToDisplay)
          // Illustration du modulo (le reste d'une division)
          // 1 / 3 le reste de la division vaut 1
          // 2 / 3 le reste de la division vaut 2 
          // 3 / 3 le reste de la division vaut 0
          // 4 / 3 le reste de la division vaut 1
          // 5 / 3 le reste de la division vaut 2
          // 6 / 3 le reste de la division vaut 0

          carousel.buttons[newSlideToDisplay].click();
        }, carousel.duration);
      },
      // methode click sur bouton
      handleClick: function handleClick(evt) {
        // vérification : est ce que le clock est vraiment un click déclenché par le visiteur 
        if (evt.isTrusted) {
          console.log('VRAI CLIC, je viens sauvegarder dans la propriété carousel.lastClickDate le timestamp !'); //! ci dessous, ce morceau de code vas nous permettre de gérer le defilement auto / l'arret du defilement auto de mon diapo
          // enregistrement de la date du click du visiteur
          // je récupère un objet et grace a la methode getTime()
          // je vais pouvoir récupérer le timestamp

          var currentDate = new Date(); //console.log(currentDate.getTime());

          carousel.lastClickDate = currentDate.getTime();
          carousel.stop();
        } // par sécurité, nous préférons interdire le comportement par defaut


        evt.preventDefault(); // nous avons besoin de savoir sur quel bouton j'ai cliqué

        var clickedButton = evt.currentTarget;
        var slideToDisplay = clickedButton.dataset.slideNumber;
        /*
        console.log('dataset SlideNumer : ' +  clickedButton.dataset.slideNumber);
        clickedButton.style.backgroundColor = "#f0f";
        clickedButton.style.borderRadius = "20px";
        */

        carousel.displaySlide(slideToDisplay); // méthode pour ajouter la classe active au bouton sur lequel j'ai cliqué
        // je lui donne un ELEMENT bouton

        carousel.setCurrentButton(clickedButton);
      },
      // methode pour arreter le défilement auto
      stop: function stop() {
        clearInterval(carousel.timer);
      },
      // methode pour colorer le bouton cliqué en bleu
      setCurrentButton: function setCurrentButton(clickedButton) {
        // je veux avant toute chose cibler le bouton
        // qui est actuelement en bleu, avant de colorer le bouton sur lequel j'ai cliqué
        // ->
        // je cible l'élement qui a pour classe carousel__nav__button ET la classe active
        var currentButton = document.querySelector('.carousel__nav__button.active');
        currentButton.classList.remove('active'); // maintenant il ne me reste plus qu'a ajouter la classe active au bouton clickedButton

        clickedButton.classList.add('active');
      },
      // methode pour afficher une slide
      displaySlide: function displaySlide(slideNumber) {
        // il faut faire scroller horizontalement l'élément contenant les slides.
        // pour se faire nous avons besoin de connaitre la largeur d'une silde, puis de la multiplier par le numéro de la slide demandé 
        // récupération de la largeur d'une slide en pixels
        var slideWidth = carousel.slidesContainer.offsetWidth;
        /*
        console.log('Je dois afficher la slide : ' + slideNumber + ', et la largeur du conteneur des slides est de : ' + slideWidth );
        */
        // calcul du scroll horizontal à effectuer pour afficher la slide demandée

        var horizontalScroll = slideWidth * slideNumber; //console.log(slideWidth + '*' +  slideNumber + '=' + horizontalScroll);
        // nous faison scroller le container des slides

        carousel.slidesContainer.scroll(horizontalScroll, 0);
      }
    };
    document.addEventListener('DOMContentLoaded', carousel.init);
  }, {}], "Eofe": [function (require, module, exports) {

  }, { "./../webfonts/fa-brands-400.woff2": [["fa-brands-400.6e5ea318.woff2", "qUWF"], "qUWF"], "./../webfonts/fa-brands-400.ttf": [["fa-brands-400.9031edcf.ttf", "Lu1x"], "Lu1x"], "./../webfonts/fa-regular-400.woff2": [["fa-regular-400.1fe874a2.woff2", "M504"], "M504"], "./../webfonts/fa-regular-400.ttf": [["fa-regular-400.a873e7e8.ttf", "Evul"], "Evul"], "./../webfonts/fa-solid-900.woff2": [["fa-solid-900.11371868.woff2", "PerI"], "PerI"], "./../webfonts/fa-solid-900.ttf": [["fa-solid-900.e8bc292a.ttf", "FJZt"], "FJZt"], "./../webfonts/fa-v4compatibility.woff2": [["fa-v4compatibility.3eea3448.woff2", "aHes"], "aHes"], "./../webfonts/fa-v4compatibility.ttf": [["fa-v4compatibility.f8ac7f38.ttf", "QxVP"], "QxVP"] }], "YWzR": [function (require, module, exports) {
    "use strict";

    require("./scss/main.scss");

    require("./js/carousel.js");

    require("@fortawesome/fontawesome-free/css/all.css");
  }, { "./scss/main.scss": "uDrZ", "./js/carousel.js": "j5Ly", "@fortawesome/fontawesome-free/css/all.css": "Eofe" }]
}, {}, ["YWzR"], null)
//# sourceMappingURL=main.bcdc44b9.js.map