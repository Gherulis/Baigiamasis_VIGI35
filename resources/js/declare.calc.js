window.onload = function() {
    var bath_cold_before = document.getElementById("bath_cold_before");
    var bath_cold = document.getElementById("bath_cold");
    var skirtumas = document.getElementById("skirtumas");

    function calculate() {
        var result = parseFloat(bath_cold.value) - bath_cold_before;
        skirtumas.innerHTML = result;
    }

    bath_cold.addEventListener("input", calculate);
}
