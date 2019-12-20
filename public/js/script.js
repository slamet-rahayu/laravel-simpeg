$(document).ready(function () {
    $("#datepicker").datepicker();
});

(function($){
	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	  if (!$(this).next().hasClass('show')) {
		$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	  }
	  var $subMenu = $(this).next(".dropdown-menu");
	  $subMenu.toggleClass('show');

	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
		$('.dropdown-submenu .show').removeClass("show");
	  });

	  return false;
	});
})(jQuery)

function jabatan() {
	var jab = confirm ('Menghapus data jabatan akan menghapus seluruh data yang terkait');
	if (jab == true) {
		alert('data terhapus');
	}

}

function JSalert(){
	event.preventDefault();
	var form = event.target.form;
	swal({   title: "Seluruh data terkait akan terhapus!",   
    text: "Tetap Lanjutkan?",   
    type: "warning", 
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Ok",   
    cancelButtonText: "Batal",   
    closeOnConfirm: false,   
    closeOnCancel: true }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
		form.submit();   
        } 
        else {     
            } });
}

function sukses(){
	swal({
		title: "Berhasil!",
		text: "Data berhasil dimasukkan",
		type: "success",
		button: "ok",
		showConfirmButton: true
		
	  });
}

function edit(){
	swal({
		title: "Berhasil!",
		text: "Data berhasil diedit",
		type: "success",
		button: "ok",
		showConfirmButton: true
		
	  });
}

function hapus(){
	swal({
		title: "Berhasil!",
		text: "Data berhasil dihapus",
		type: "success",
		button: "ok",
		showConfirmButton: true
		
	  });
}

function yakin(){
	event.preventDefault();
	var form = event.target.form;
	swal({   title: "Data Belum Terkirm!",   
    text: "Tetap Kembali?",   
    type: "warning", 
    showCancelButton: true,   
    confirmButtonColor: "#DD6B55",   
    confirmButtonText: "Ok",   
    cancelButtonText: "Batal",   
    closeOnConfirm: false,   
    closeOnCancel: true }, 
    function(isConfirm){   
        if (isConfirm) 
    {   
		window.history.go(-1);   
        } 
        else {     
            } });
}

function jam() {
	var d = new Date();
	document.getElementById("time").innerHTML = d.toLocaleString();
}
setInterval(jam, 1000);

document.addEventListener('DOMContentLoaded', function() {
    var initialLocaleCode = 'id';
    var localeSelectorEl = document.getElementById('locale-selector');
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
      },
      locale: initialLocaleCode,
      buttonIcons: false, // show the prev/next text
      weekNumbers: true,
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        
      ]
    });

    calendar.render();

    // build the locale selector's options
    calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
      var optionEl = document.createElement('option');
      optionEl.value = localeCode;
      optionEl.selected = localeCode == initialLocaleCode;
      optionEl.innerText = localeCode;
      localeSelectorEl.appendChild(optionEl);
    });

    // when the selected option changes, dynamically change the calendar option
    localeSelectorEl.addEventListener('change', function() {
      if (this.value) {
        calendar.setOption('locale', this.value);
      }
    });

  });