(function () {
  console.log("vive les profs du TIM");
  let elm__fig = document.querySelectorAll(".prof__figure");
  console.log(elm__fig.length);

  let elm__prof__section = document.querySelectorAll(".prof__section");
  for (let elm__prof of elm__prof__section) {
    elm__prof.style.display = "none";
  }

  for (const elm of elm__fig) {
    elm.addEventListener("mousedown", function () {
      let elm__prof__section = document.querySelectorAll(".prof__section");
      for (let elm__prof of elm__prof__section) {
        elm__prof.style.display = "none";
      }

      id__figure = elm.id.split("_")[1]; // "fig_234"  ["fig", "234"]
      // id__figure = elm.id
      console.log(id__figure);
      elm__prof__section = document.querySelector("#des_" + id__figure);
      console.log(elm__prof__section.id);
      elm__prof__section.style.display = "block";
    });
  }
})();

//[VARIABLES]
const zoneProfs = document.querySelector(".zoneProfs");
const formRadios = document.querySelector(".radiobouton");
const images = document.querySelectorAll(".prof__figure");
let deplacement = 0;
const limiteGauche = 0;
let section;
let limiteDroite;

//[CONSOLE LOG]
console.log(images.length / 3);
console.log(section);

// Fonction pour afficher les boutons radio en fonction du nombre d'images
function afficherBoutonsRadio() {
  section = Math.ceil(images.length / 3); // Calcule le nombre de boutons radio à afficher  (arrondi supérieur)
  const indexImageActuelle = Math.abs(deplacement / 100) + 1;
  formRadios.innerHTML = ""; // Vide la zone des boutons radio
  // Crée un bouton radio pour chaque section
  for (let i = 1; i <= section; i++) {
    const inputRadio = document.createElement("input");
    inputRadio.type = "radio";
    inputRadio.name = "radioProf";
    inputRadio.value = i;
    inputRadio.classList.add(`radio${i}`);
    formRadios.appendChild(inputRadio);
  }
}

// Fonction pour mettre à jour les boutons radio en fonction du déplacement
function mettreAJourBoutonRadio() {
  const indexImageActuelle = Math.abs(deplacement / 100) + 1; // Calcule l'index de l'image actuelle
  const radios = formRadios.querySelectorAll("input"); // Sélectionne tous les boutons radio
  radios.forEach((radio, index) => {
    // Pour chaque bouton radio
    radio.checked = index + 1 === indexImageActuelle; // Coche le bouton radio correspondant à l'image actuelle
    console.log(indexImageActuelle);
  });
}

// Fonction pour déplacer le carousel vers la droite
function suiv() {
  limiteDroite = section * -100;
  console.log(section);
  if (deplacement > limiteDroite + 100) {
    // Si le déplacement est plus petit que la limite de droite
    // On déplace le carousel vers la droite
    deplacement -= 100;
    zoneProfs.style.transform = `translateX(${deplacement}%)`;
    mettreAJourBoutonRadio();
  }
}

// Fonction pour déplacer le carousel vers la gauche
function prec() {
  section = Math.floor(images.length / 3);
  if (deplacement < limiteGauche) {
    // Si le déplacement est plus grand que la limite de gauche
    // On déplace le carousel vers la gauche
    deplacement += 100;
    zoneProfs.style.transform = `translateX(${deplacement}%)`;
    mettreAJourBoutonRadio();
  }
}

// Fonction pour afficher l'image en fonction du bouton radio clique
function afficherImage(index) {
  deplacement = -(index - 1) * 100;
  zoneProfs.style.transform = `translateX(${deplacement}%)`;
}

// Fonction pour ajouter un événement de clic à chaque bouton radio
function ajouterEvenementBoutonRadio() {
  const radios = formRadios.querySelectorAll("input"); // Sélectionne tous les boutons radio
  radios.forEach((radio, index) => {
    // Pour chaque bouton radio
    radio.addEventListener("click", () => {
      // Ajoute un événement de clic
      afficherImage(index + 1); // Affiche l'image correspondante
    });
  });
}

// Appelle la fonction d'affichage des boutons radio au chargement de la page
afficherBoutonsRadio();
ajouterEvenementBoutonRadio();
