window.onload=function() {
    let fechaNacimiento = document.getElementById("fNacimiento");
    let hoy = new Date();
    let year = hoy.getFullYear();
    let fechaMin = year-18;
    let mesMin = String(hoy.getMonth()).padStart(2,"0");
    let diaMin = String(hoy.getDate()).padStart(2,"0");
    let fechaForm = fechaMin+"-"+mesMin+"-"+diaMin;
    fechaNacimiento.setAttribute("max",fechaForm);

}