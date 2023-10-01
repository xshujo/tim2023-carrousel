(function () {
    console.log("Début du carrousel");
    let carrousel = document.querySelector('.carrousel');
    let carrousel__x = document.querySelector('.carrousel__x');
    let carrousel__figure = document.querySelector('.carrousel__figure:first-of-type');
    let carrousel__fond = document.querySelector('.carrousel__figure:last-of-type');
    let carrousel__form = document.querySelector('.carrousel__form');
    let carrousel__image_sui = document.querySelector('.carrousel__image_sui');
    let carrousel__image_pre = document.querySelector('.carrousel__image_pre');

    let galerie = document.querySelector('.galerie');
    let galerie__img = galerie.querySelectorAll('img');

    /** 
     * On ferme le carrousel
     */
    carrousel__x.addEventListener('mousedown', function () {
        carrousel.classList.remove('carrousel--activer');
    });

    /**
     * On navigue vers l'image suivante
     */
    carrousel__image_sui.addEventListener('mousedown', function () {
        index++;

        if (index == galerie__img.length) {
            index = 0;
        }

        carrousel__form.children[index].checked = true;

        affiche_image_carrousel();
    });

    /**
     * On navigue vers l'image précédente
     */
    carrousel__image_pre.addEventListener('mousedown', function () {
        index--;

        if (index < 0) {
            index = galerie__img.length - 1;
        }

        carrousel__form.children[index].checked = true;

        affiche_image_carrousel(); 
    });

    /**
     * On initialize l'index
     */
    let position = 0;
    let index = 0;
    let ancienIndex = -1;

    /**
     * Pour chaque image de la galerie, l'ajouter dans le carrousel
     */
    if (position != galerie__img.length) {
        for (const elt of galerie__img) {
            elt.dataset.index = position;
            elt.addEventListener('mousedown', function () {
                carrousel.classList.add('carrousel--activer');
                index = this.dataset.index;
                carrousel__form.children[index].checked = true;
                affiche_image_carrousel();
            });
            ajouter_une_image_dans_carrousel(elt);
            ajouter_une_image_de_fond(elt);
            ajouter_un_bouton_radio_dans_carrousel();
        }
    }

    /**
     * Création dynamique d'une image pour le carrousel
     * 
     * @param {*} elt une image de la galerie
     */
    function ajouter_une_image_dans_carrousel(elt) {
        let img = document.createElement('img');
        img.classList.add('carrousel__img');
        img.src = elt.src;
        carrousel__figure.appendChild(img);
        img.addEventListener('mousedown', function () {
            index++;
            if (index == galerie__img.length) {
                index = 0;
            }
            carrousel__form.children[index].checked = true;
            affiche_image_carrousel();
        });
    }

    function ajouter_une_image_de_fond(elt) {
        let img_fond = document.createElement('img');
        img_fond.classList.add('carrousel__img');
        img_fond.src = elt.src;
        carrousel__fond.appendChild(img_fond);
    }

    function ajouter_un_bouton_radio_dans_carrousel() {
        let rad = document.createElement('input');
        rad.setAttribute('type', 'radio');
        rad.setAttribute('name', 'carrousel');
        rad.classList.add('carrousel__rad');
        rad.dataset.index = position;
        rad.addEventListener('mousedown', function () {
            index = this.dataset.index;
            affiche_image_carrousel();
        })
        position = position + 1;
        carrousel__form.appendChild(rad);
    }

    /**
     * Affiche la nouvelle image du carrousel
     */
    function affiche_image_carrousel() {
        if (ancienIndex != -1) {
            carrousel__figure.children[ancienIndex].classList.remove('carrousel__img--activer');
            carrousel__fond.children[ancienIndex].classList.remove('carrousel__fond--activer');
        }
        carrousel__figure.children[index].classList.add('carrousel__img--activer');
        carrousel__fond.children[index].classList.add('carrousel__fond--activer');
        ancienIndex = index;
    }
})()