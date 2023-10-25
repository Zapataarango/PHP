$(document).ready(function () {
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function () {
		if (this.checked) {
			checkbox.each(function () {
				this.checked = true;
			});
		} else {
			checkbox.each(function () {
				this.checked = false;
			});
		}
	});
	checkbox.click(function () {
		if (!this.checked) {
			$("#selectAll").prop("checked", false);
		}
	});

	$("#btnAgregarItem").click(function(event) {
		return false;
	 });

	 $("#btnRemoverItem").click(function(event) {
		return false;
	 });

	 $("#menu-heading").click(function(event) {
		return false;
	 });
});

function agregarItem(idElementoOrigen, idElementoDestino){
	var option=document.createElement("option");
	option.text=document.getElementById(idElementoOrigen).value;
	document.getElementById(idElementoDestino).add(option);
}

function removerItem(idElementoDestino){
	var listBox = document.getElementById(idElementoDestino);
	if (listBox.options.length > 0) {
	  listBox.remove(listBox.options.length - 1);
	}
}


function openSidebar() {
    var sidebar = document.getElementById("mySidebar");
    if (sidebar.style.left === "0px") {
        sidebar.style.left = "-250px"; // Cierra el menú lateral
    } else {
        sidebar.style.left = "0px"; // Abre el menú lateral
    }
}
function toggleSubMenu(menuId) {
    var submenu = document.getElementById(menuId);
    if (submenu.style.display === 'block') {
        submenu.style.display = 'none'; // Oculta el submenu
    } else {
        submenu.style.display = 'block'; // Muestra el submenu
    }
}
