$('.page-scroll').on('click', function() {
	//ambil isi href
	var tujuan = $(this).attr('href');
	//tangkap elemen 
	var elemenTujuan = $(tujuan);

	//pindahkan scroll
	$('html').animate({
		'scrollTop': elemenTujuan.offset().top - 80
	}, 1000, 'easeOutQuart');
	e.preventDefault();
});

