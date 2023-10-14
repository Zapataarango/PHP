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

});

function openSidebar() {
	var sidebar = document.getElementById("mySidebar");
	if (sidebar.style.left === "0px") {
		sidebar.style.left = "-250px";
	} else {
		sidebar.style.left = "0px";
	}
}

function toggleSubMenu(menuId) {
	var submenu = document.getElementById(menuId);
	submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
}
