
var opciones = document.querySelectorAll('.tocar');
var opcionequis = document.getElementById("opcionequis");
var sombra = document.getElementById("sombra");
var texto = document.getElementById("cantidad");
var click = true;
var som = false;

function aplicarBlur() {
    if (click == true) {
        sombra.style.display = "grid";
        sombra.style.animation = "sombra both 0.5s";
    }
}

function sacarBlur() {
    if (click == true) {
        click = false;
        sombra.style.animation = "sacarsombra both 0.5s";
    }
}

sombra.addEventListener('animationend', function handleAnimationEnd() {
    if (som == true) {
        som = false;
        sombra.style.display = "none";
    } else {
        som = true;
    }
    click = true;
});

opciones.forEach(element => {
    element.addEventListener('click', () => {
        let parentNode = element.parentNode;
        let cantidad = parentNode.querySelector("#can").textContent;
        let idInput = parentNode.querySelector("#id").value;
        texto.textContent = cantidad;
        document.getElementById("input").value = idInput;
        aplicarBlur();
    });
});

opcionequis.addEventListener('click', sacarBlur);
