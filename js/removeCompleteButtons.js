var button = document.getElementById("completePaid");

button.onclick = function() {
    this.parentNode.removeChild(button);
}