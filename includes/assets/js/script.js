document.addEventListener("DOMContentLoaded", function() {
    var checkbox = document.getElementById("tiene_empresa");
    var rutEmpresaField = document.getElementById("rut_empresa_field");

    // Mostrar/ocultar el campo de RUT de la empresa en función del checkbox
    checkbox.addEventListener("change", function() {
        if (checkbox.checked) {
            rutEmpresaField.style.display = "block";
        } else {
            rutEmpresaField.style.display = "none";
            document.getElementById("rut_empresa").value = ""; // Limpiar el valor si no está marcado
        }
    });
});