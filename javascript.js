// Fungsi untuk membuka popup
function openPopup() {
  document.getElementById('tablePopup').style.display = 'flex';
}

// Fungsi untuk menutup popup
function closePopup() {
  document.getElementById('tablePopup').style.display = 'none';
}

// Tutup popup ketika klik di luar area konten
window.onclick = function(event) {
  const popup = document.getElementById('tablePopup');
  if (event.target == popup) {
    popup.style.display = 'none';
  }
}
