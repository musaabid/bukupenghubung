(function($){
	
	$(document).ready(function(){

		// Init bootstrap tooltip
		$('[data-toggle="tooltip"]').tooltip()

		var datatable_language = {
				search: "Cari",
				lengthMenu: "Tampilkan _MENU_ data per halaman",
				zeroRecords: "Maaf, data tidak ditemukan",
				info: "Menampilkan hal _PAGE_ dari _PAGES_ halaman",
				infoEmpty: "Tidak ada data",
				infoFiltered: "(disaring dari _MAX_ data)",
				paginate: {
					first: "Pertama",
					previous: "Sebelumnya",
					next: "Selanjutnya",
					last: "Terakhir"
				}
		};

		/* Data table di semua halaman manajemen */
		$('#datatable').DataTable({
			responsive: {
        		details: {
           		type: "column"
        		}
   		},
			language: datatable_language,
			columnDefs: [
				{
					targets: [0,5],
					orderable: false,
					searchable: false
				}
			],
			order: [
				[ 1, "asc" ]
			]
		});

		$('#datatable_diskusi').DataTable({
			responsive: {
        		details: {
           		type: "column"
        		}
   		},
			language: datatable_language,
			columnDefs: [
				{
					targets: [0,5],
					orderable: false,
					searchable: false
				}
			],
			order: [
				[ 3, "asc" ]
			]
		});

		// Checkbox di datatable
		$('#togglecb').click(function () {
			if ( $("#togglecb").is(':checked') ) {
				$("input[type=checkbox]").each(function () {
					$(this).prop("checked", true);
				});
			} else {
				$("input[type=checkbox]").each(function () {
					$(this).prop("checked", false);
				});
			}
		});

		// Hapus multidata
		$('#bulkDelete').click(function(bulkDelete){
			bulkDelete.preventDefault();
			if(confirm( 'Yakin menghapus data?' )){
				var ids = $('input[type=checkbox].cbRow:checked').map(function(_, el) {
					return $(el).val();
				}).get();

				$.ajax({
					url: bp.deleteRoute,
					type: "POST",
					data: {
						_method 	: 'DELETE',
						_token	: Laravel.csrfToken,
						ids		: ids
					},
					success: function (response) {
						location.reload();
					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus, errorThrown);
					}
				});
			}

		});

		// Radio highlight
		$( '.bpo-radio label' ).click(function(){
			$(this).addClass('btn-primary');
			$(this).siblings( 'label' ).removeClass('btn-primary');
		});

		informasiTambahan( $('input[type=radio][name=level]:checked').val() );

		// Tampilkan informasi tambahan
		$('input[type=radio][name=level]').change(function() {
			informasiTambahan(this.value);
		});

		//Datepicker
		var d = new Date();
		var today_date = d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear();
		$('[data-toggle="datepicker"]').datepicker({
			format: 'dd-mm-yyyy',
			endDate: today_date
		});

		// Validasi form
		$('#form').validate({
			rules: {
				password_confirmation: {
      			equalTo: "#password"
    			}
			},
			errorPlacement: function(error, element) {
				error.insertAfter(element);
			}, 
			highlight: function(element) {
				$(element).closest('.form-group').addClass('has-error');
			},
			unhighlight: function(element) {
				$(element).closest('.form-group').removeClass('has-error');
			}
		});

		// Extend pesan error jquery validation
		$.extend($.validator.messages, {
			required: 'Kolom ini harus di isi.',
			number: 'Silahkan memasukan angka saja.',
			equalTo: 'Silahkan masukan password yang sama'
		});

		$('.deleteForm').submit(function(){
			return confirm('Yakin ingin menghapus data?');
		});

		// Ajax kirim balasan diskusi
		$('#sendDiscussion').click(function(sendDiscussion){
			sendDiscussion.preventDefault();
			var balasan = $('#discussion_content').val();
			if( balasan ){
				$.ajax({
					url: bp.chatRoute,
					type: "POST",
					data: {
						_token			: Laravel.csrfToken,
						id_parent 		: bp.id_parent,
						id_wali_kelas	: bp.id_wali_kelas,
						id_siswa			: bp.id_siswa,
						pengirim			: bp.pengirim,
						isi_diskusi		: balasan
					},
					success: function (response) {
						//location.reload();
						//console.log(response);
						$('#discussion_content').val('');
						$('#discussions').load( location.href + ' #discussions > *');
						setTimeout(function() {
							$("#discussions").scrollTop($("#discussions")[0].scrollHeight);
						}, 1000);

					},
					error: function(jqXHR, textStatus, errorThrown) {
						console.log(textStatus, errorThrown);
					}
				});
			}
		});

		$("#discussions").scrollTop($("#discussions")[0].scrollHeight);

	});


	// Fungsi menampilkan informasi tambahan
	function informasiTambahan(level){
		if(level == 'admin' || level == 'guru'){
			$( '#data-ortu, #kelas-siswa' ).fadeOut( 'fast' );
			$( '#data-guru' ).fadeIn();
		} else if(level == 'siswa') {
			$( '#data-guru' ).fadeOut( 'fast' );
			$( '#data-ortu, #kelas-siswa' ).fadeIn();
		}
	}


})(jQuery);
