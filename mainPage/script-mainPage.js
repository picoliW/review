


function openRatingModal(seriesTitle, sinopse) {
    document.getElementById('selectedSeries').innerHTML = `Avalie a série ${seriesTitle}`;
    document.getElementById('ratingModal').style.display = 'block';
    document.getElementById('titulo').value = seriesTitle;
    document.getElementById('sinopse').innerHTML = `<h3>Sinopse:</h3> ${sinopse}`;
}

function closeRatingModal() {
    document.getElementById('ratingModal').style.display = 'none';
}
document.getElementById("overlay").addEventListener("click", closeRatingModal);
function submitRating() {
    event.preventDefault();
    if (validateForm()) {
        const rating = document.getElementById('rating').value;
        const episodesWatched = document.getElementById('episodesWatched').value;
        const titulo = document.getElementById('titulo').value;

        fetch('cu.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `titulo=${titulo}&rating=${rating}&episodes_watched=${episodesWatched}`


        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            closeRatingModal();
        })
        .catch(error => {
            console.error('Erro:', error);
        });
    }
}


function validateForm() {
    var rating = document.getElementById("rating").value;
    var episodesWatched = document.getElementById("episodesWatched").value;

    if (rating === "" || episodesWatched === "") {
        alert("Por favor, preencha todos os campos: avaliação e episódios assistidos.");
        return false;
    }
    return true;
}
