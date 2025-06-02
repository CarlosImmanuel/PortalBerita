    function showEditForm(id, isi) {
        document.getElementById('edit-form-' + id).style.display = 'block';
        document.getElementById('isi-komentar-' + id).style.display = 'none';
    }

    function hideEditForm(id) {
        document.getElementById('edit-form-' + id).style.display = 'none';
        document.getElementById('isi-komentar-' + id).style.display = 'block';
    }
