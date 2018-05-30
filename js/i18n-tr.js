/* Turkish initialisation for the jQuery UI date picker plugin. */
/* Written by Burak Cakil (burakcakil[at]gmail[dot]com) */
jQuery(function($){
	$.datepicker.regional['tr'] = {
		closeText: 'Kapat',
		prevText: 'Onceki',
		nextText: 'Sonraki',
		currentText: 'Simdiki',
		monthNames: ['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran',
		'Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'],
		monthNamesShort: ['Oca','Şub','Mar','Nis','May','Haz',
		'Tem','Ağu','Eyl','Eki','Kas','Ara'],
		dayNames: ['Pazartesi','Salı','Çarşamba','Perşembe','Cuma','Cumartesi','Pazar'],
		dayNamesShort: ['Pzt','Sal','Çrş','Prş','Cum','Cts','Paz'],
		dayNamesMin: ['Pt','Sa','Çr','Pr','Cu','Ct','Pz'],
		weekHeader: 'Hf',
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: '',
		minDate: '-38Y',
		maxDate: 0,
		numberOfMonths: 1,
		showButtonPanel: false,
    changeMonth: true,
    changeYear: true,
    yearRange: '-38:+nn'
		};
	$.datepicker.setDefaults($.datepicker.regional['tr']);
});
