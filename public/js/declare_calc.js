function calculateDifference(type, value) {
    var before = document.getElementById(type + '_before').value;
    var difference = value - before;
    var resultElem = document.getElementById(type + '_result');
    resultElem.value = difference;
    resultElem.innerHTML = difference +"m<sup>3</sup>";
    if (difference < 0) {
        resultElem.style.color = "red";

    } else {
        resultElem.style.color = "black";
    }




}



