const searchInput = document.getElementById('searchInput');
  const kategoriBlocks = document.querySelectorAll('.kategori-block');
  const noResultsAlert = document.getElementById('no-results-alert');

  // Ambil headline elemen dan judulnya, langsung normalize (lowercase + trim + collapse spasi)
  const headlineBlock = document.querySelector('.top-news');
  const headlineTextElem = headlineBlock ? headlineBlock.querySelector('.headline-text') : null;
  const headlineJudul = headlineTextElem
    ? headlineTextElem.textContent.toLowerCase().trim().replace(/\s+/g, ' ')
    : '';

  searchInput.addEventListener('input', function () {
    // Normalize query juga (lowercase + trim + collapse spasi)
    const query = this.value.toLowerCase().trim().replace(/\s+/g, ' ');

    let totalVisibleCards = 0;

    // Filter berita di kategori
    kategoriBlocks.forEach(block => {
      let visibleCards = 0;
      const cardsInBlock = block.querySelectorAll('.news-card');

      cardsInBlock.forEach(card => {
        // Normalize judul juga
        const rawJudul = card.getAttribute('data-judul');
        const judul = rawJudul.toLowerCase().trim().replace(/\s+/g, ' ');
        const col = card.closest('.col');

        if (judul.includes(query)) {
          col.style.display = 'block';
          visibleCards++;
          totalVisibleCards++;
        } else {
          col.style.display = 'none';
        }
      });

      block.style.display = visibleCards === 0 ? 'none' : 'block';
    });

    // Cek headline match
    const isHeadlineMatch = headlineJudul.includes(query);

    // Tampilkan alert sesuai kondisi
    if (query.length > 0 && totalVisibleCards === 0) {
      if (isHeadlineMatch) {
        noResultsAlert.style.display = 'block';
        noResultsAlert.innerHTML = '<i class="bi bi-info-circle"></i> Berita ada pada headline.';
      } else {
        noResultsAlert.style.display = 'block';
        noResultsAlert.innerHTML = '<i class="bi bi-exclamation-circle"></i> Tidak ada berita ditemukan.';
      }
    } else {
      noResultsAlert.style.display = 'none';
    }
  });
