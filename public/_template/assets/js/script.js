// Header
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobile-menu');
hamburger.addEventListener('click', function() {
    mobileMenu.classList.toggle('open'); 
    const icon = hamburger.querySelector('i'); 
    if (icon.classList.contains('fa-bars')) {
        icon.classList.remove('fa-bars'); 
        icon.classList.add('fa-times');  
    } else {
        icon.classList.remove('fa-times'); 
        icon.classList.add('fa-bars');  
    }
});

// Sous-Groupe
function toggleContent(index) {
    // Sélectionner le contenu et l'icône associés à l'index donné
    const content = document.getElementById(`describ-subgroup-${index}`);
    const icon = document.getElementById(`toggle-icon-${index}`);

    if (!content || !icon) {
        console.warn(`Élément avec l'index ${index} introuvable.`);
        return;
    }

    // Basculer la classe 'show' pour afficher ou masquer le contenu
    content.classList.toggle('show');

    // Modifier l'icône en fonction de l'état du contenu
    icon.innerHTML = content.classList.contains('show') ? '&#x2191;' : '&#x2193;'; // Flèche haut ou bas
}
// Agrandir l'image du profil
function openModal(imgElement) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById("imgInModal");
    modal.style.display = "block"; // Afficher la modale
    modalImg.src = imgElement.src; // Mettre l'image source dans la modale
}

// Fonction pour fermer la modale
function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.style.display = "none"; // Fermer la modale
}

// Ajouter un écouteur d'événements pour fermer la modale si l'utilisateur clique n'importe où dans l'écran
document.getElementById('imageModal').addEventListener('click', function(event) {
    if (event.target === this || event.target === document.getElementById("imgInModal")) {
        closeModal(); // Fermer la modale
    }
});
