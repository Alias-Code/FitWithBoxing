// TRAITEMENT FORMULAIRE INSCRIPTION

document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".registration-form");
  const errorDiv = document.getElementById("error-messages");

  form.addEventListener("submit", function (event) {
    event.preventDefault();
    errorDiv.innerHTML = "";

    // CONSTANTES

    const nom = document.getElementById("nom").value.trim();
    const prenom = document.getElementById("prenom").value.trim();
    const email = document.getElementById("email").value.trim();
    const motDePasse = document.getElementById("mot_de_passe").value.trim();
    const adresse = document.getElementById("adresse").value.trim();
    const ville = document.getElementById("ville").value.trim();
    const codePostal = document.getElementById("code_postal").value.trim();
    const telephone = document.getElementById("telephone").value.trim();
    const reponse = document.getElementById("reponse").value.trim();
    const conditionsUtilisation = document.getElementById(
      "conditions_utilisation"
    );

    let errors = [];

    // VERIFICATIONS CHAMPS

    if (nom.length < 2 || nom.length > 50) {
      errors.push("Le nom doit contenir entre 2 et 50 caractères.");
    }

    if (prenom.length < 2 || prenom.length > 50) {
      errors.push("Le prénom doit contenir entre 2 et 50 caractères.");
    }

    if (email.length === 0 || !isValidEmail(email)) {
      errors.push("Veuillez saisir une adresse e-mail valide.");
    }

    if (motDePasse.length < 6 || motDePasse.length > 20) {
      errors.push("Le mot de passe doit contenir entre 6 et 20 caractères.");
    }

    if (adresse.length === 0 || adresse.length > 255) {
      errors.push("Veuillez saisir une adresse valide.");
    }

    if (ville.length === 0 || ville.length > 20) {
      errors.push("Veuillez saisir une ville valide.");
    }

    if (!/^\d{5}$/.test(codePostal)) {
      errors.push("Veuillez saisir un code postal valide (5 chiffres).");
    }

    if (!/^\d{10}$/.test(telephone)) {
      errors.push(
        "Veuillez saisir un numéro de téléphone valide (10 chiffres)."
      );
    }

    if (reponse.split(" ").length > 1) {
      errors.push("Veuillez saisir un seul mot maximum pour la réponse.");
    }

    if (!conditionsUtilisation.checked) {
      errors.push("Veuillez accepter les conditions d'utilisation.");
    }

    if (errors.length > 0) {
      errors.forEach((error) => {
        const errorMessage = document.createElement("div"); // Crée un nouvel élément div pour afficher le message d'erreur.
        errorMessage.textContent = error; // Définit le texte du message d'erreur en fonction de l'erreur actuelle.
        errorDiv.appendChild(errorMessage); // Ajoute l'élément div contenant le message d'erreur à la fin de la liste d'éléments enfants de errorDiv.
      });
      errorDiv.style.display = "block";
    } else {
      form.submit();
    }
  });

  function isValidEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    /*
        /^        : Indique le début de la chaîne.
        [^\s@]+   : Correspond à un ou plusieurs caractères qui ne sont ni un espace ni un '@'. 
                   Cela garantit qu'il y a au moins un caractère avant le '@'.
        @         : Correspond simplement au caractère '@'.
        [^\s@]+   : Comme le premier, cela correspond à un ou plusieurs caractères qui ne sont ni un espace ni un '@'. 
                   Cela garantit qu'il y a au moins un caractère après le '@'.
        \.        : Correspond à un point '.'. Nous devons échapper le point avec '\' car '.' a une signification spéciale en regex.
        [^\s@]+   : Correspond à un ou plusieurs caractères qui ne sont ni un espace ni un '@'. 
                   Cela garantit qu'il y a au moins un caractère après le '.'.
        $         : Indique la fin de la chaîne.
    */
    return regex.test(email);
  }
});

// AFFICHAGE DU MOT DE PASSE

document.addEventListener("DOMContentLoaded", function () {
  const afficherMotDePasseCheckbox = document.getElementById(
    "afficher_mot_de_passe"
  );
  const motDePasseInput = document.getElementById("mot_de_passe");

  afficherMotDePasseCheckbox.addEventListener("change", function () {
    if (afficherMotDePasseCheckbox.checked) {
      motDePasseInput.type = "text";
    } else {
      motDePasseInput.type = "password";
    }
  });
});

// AJOUT DE PRODUIT PAR QUANTITE

document.addEventListener("DOMContentLoaded", function () {
  const quantityInput = document.getElementById("quantity");
  const btnMin = document.getElementById("btnMin");
  const btnPlus = document.getElementById("btnPlus");

  btnMin.addEventListener("click", function () {
    let currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
      quantityInput.value = currentValue - 1;
    }
  });

  btnPlus.addEventListener("click", function () {
    let currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
  });
});

// NOTE PAR ETOILE

document.addEventListener("DOMContentLoaded", function () {
  const stars = document.querySelectorAll(".star");
  const noteInput = document.getElementById("note");

  stars.forEach((star) => {
    star.addEventListener("click", function () {
      const clickedRating = parseInt(star.getAttribute("number"));

      noteInput.value = clickedRating;

      stars.forEach((star) => {
        const currentRating = parseInt(star.getAttribute("number"));

        if (currentRating <= clickedRating) {
          star.classList.add("text-warning");
        } else {
          star.classList.remove("text-warning");
        }
      });
    });
  });
});
