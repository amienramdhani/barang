<!DOCTYPE html>
<html>
<head>
    <title>Kategori</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Kategori</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah Kategori</button>
        <a class="btn btn-success" href="<?= base_url('welcome') ?>">Home</a>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="kategoriTable">
                <?php foreach ($kategori as $kat): ?>
                    <tr>
                        <td><?= $kat['id'] ?></td>
                        <td><?= $kat['kategori'] ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editKategori(<?= $kat[
                                'id'
                            ] ?>)">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteKategori(<?= $kat[
                                'id'
                            ] ?>)">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addKategoriForm">
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <input type="text" class="form-control" id="kategori" name="kategori" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editKategoriForm">
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editKategori">Kategori</label>
                            <input type="text" class="form-control" id="editKategori" name="kategori" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#addKategoriForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '<?= site_url('kategori/create') ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addModal').modal('hide');
                        location.reload();
                    }
                });
            });

            $('#editKategoriForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '<?= site_url('kategori/update') ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModal').modal('hide');
                        location.reload();
                    }
                });
            });
        });

        function editKategori(id) {
            $.ajax({
                url: '<?= site_url('kategori/edit') ?>/' + id,
                type: 'GET',
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#editId').val(data.id);
                    $('#editKategori').val(data.kategori);
                    $('#editModal').modal('show');
                }
            });
        }

        function deleteKategori(id) {
            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    url: '<?= site_url('kategori/delete') ?>/' + id,
                    type: 'GET',
                    success: function(response) {
                        location.reload();
                    }
                });
            }
        }
    </script>
</body>
</html>
