document.addEventListener("DOMContentLoaded", function () {
  const trickCards = document.querySelectorAll(".trick-card-content");

  trickCards.forEach(function (card) {
    card.addEventListener("click", function () {
      card.classList.toggle("active");
    });
  });
});
