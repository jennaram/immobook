function toggleDescription(propertyId) {
    const container = document.getElementById(`description-${propertyId}`);
    const button = document.getElementById(`btn-${propertyId}`);
    
    if (container.classList.contains('expanded')) {
        container.classList.remove('expanded');
        button.textContent = 'Lire la suite';
    } else {
        container.classList.add('expanded');
        button.textContent = 'Voir moins';
    }
}

// Vérifier si le texte est trop long
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.description-container').forEach(container => {
        const content = container.querySelector('.description-content');
        const button = container.nextElementSibling;
        
        if (content.scrollHeight <= container.clientHeight) {
            button.style.display = 'none';
        }
    });
});