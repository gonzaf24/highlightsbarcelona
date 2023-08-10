document.addEventListener("DOMContentLoaded", function () {
  const trickCard = document.getElementById("trick-card");

  trickCard.addEventListener("click", function () {
    trickCard.classList.toggle("active");
  });
});
