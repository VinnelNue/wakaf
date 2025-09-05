   //pages/ahlih waris
	    function showDetail(id) {
        $('#detailPopup').modal('show');
        
        $.ajax({
            url: 'pages/ahli_waris/api2_ahli_waris.php?action=view&id=' + id,
            type: 'GET',
            success: function(response) {
                $('#detailContent').html(response);
            },
            error: function() {
                $('#detailContent').html('<div class="alert alert-danger">Gagal memuat data</div>');
            }
        });
    }

    //pages/wakif
 //pendistribusian


//pages/uang_wakaf untuk image triger
function openModal(src) {
    var modal = document.getElementById("imgModal");
    var modalImg = document.getElementById("modalImage");
    modal.style.display = "block";
    modalImg.src = src;
}
function closeModal() {
    document.getElementById("imgModal").style.display = "none";
}

$(function () {
  $.getJSON("value_dashboard.php", function(data) {
    new Morris.Area({
      element: 'revenue-chart',
      resize: true,
      data: data,
      xkey: 'y',
      ykeys: ['untung'],
      labels: ['Total Untung'],
      lineColors: ['#00a65a'],
      hideHover: 'auto'
    });
  });
});

/*$('#id_wakif').change(function() {
    var idWakif = $(this).val();
    $.ajax({
        url: 'get_uang_wakaf.php',
        method: 'POST',
        data: { id_wakif: idWakif },
        success: function(response) {
            $('#id_uang_wakaf').html(response);
        }
    });
});*/

/*<script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.querySelector("input[name='jumlah_uang']");
    const inputRaw = document.getElementById("jumlah_uang_raw");
    const selectWakif = document.querySelector("select[name='id_uang_wakaf']");
    const persenInput = document.getElementById("persentase");
    const hasilPerkembangan = document.getElementById("hasil_perkembangan");

    // Format angka ke Rupiah
    function formatRupiahInput(angka) {
        let number_string = angka.replace(/[^,\d]/g, '').toString();
        if (number_string === '') return 'Rp';
        let split = number_string.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp ' + rupiah;
    }

    // Hitung hasil pengembangan
    function hitungPerkembangan() {
        const jumlah = parseFloat(inputRaw?.value || 0);
        const persen = parseFloat(persenInput?.value || 0);
        if (!isNaN(jumlah) && !isNaN(persen)) {
            const hasil = (jumlah * persen) / 100;
            hasilPerkembangan.value = formatRupiahInput(hasil.toFixed(0));
        } else {
            hasilPerkembangan.value = '';
        }
    }

    // Event input jumlah uang (manual)
    if (input && inputRaw) {
        input.addEventListener('input', function () {
            const numeric = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiahInput(numeric);
            inputRaw.value = numeric || '';
            hitungPerkembangan();
        });
    }

    // Event input persentase
    if (persenInput) {
        persenInput.addEventListener('input', hitungPerkembangan);
    }

    // Event change pilih wakif
    if (selectWakif) {
        selectWakif.addEventListener("change", function () {
            const idWakif = this.value;
            if (idWakif) {
                fetch("pages/pengembangan_uang_wakaf/get_uang_wakaf.php?id_wakif=" + idWakif)
                    .then(response => response.json())
                    .then(data => {
                        const total = data.jumlah || '';
                        input.value = formatRupiahInput(total.toString());
                        inputRaw.value = total.toString();
                        hitungPerkembangan();
                    })
                    .catch(err => {
                        console.error("Gagal ambil data:", err);
                    });
            } else {
                input.value = 'Rp';
                inputRaw.value = '';
                hasilPerkembangan.value = '';
            }
        });
    }

    // Inisialisasi saat halaman pertama kali dibuka
    if (input && inputRaw) {
        input.value = formatRupiahInput(inputRaw.value || '');
    }
    hitungPerkembangan();
});
</script>

*/