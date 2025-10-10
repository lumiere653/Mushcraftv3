// Wait for the DOM to load
document.addEventListener("DOMContentLoaded", function() {
    // Get buttons by their ID
    const btnExplore = document.getElementById("btnExplore");
    const btnLearn = document.getElementById("btnLearn");

    // Add click event listeners
    btnExplore.addEventListener("click", function() {
        alert("You must login first!");
    });

    btnLearn.addEventListener("click", function() {
        alert("You must login first!");
    });
});
