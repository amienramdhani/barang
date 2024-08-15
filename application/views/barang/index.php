<!DOCTYPE html>
<html>
<head>
    <title>Barang</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Barang</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah Barang</button>
        <a class="btn btn-success" href="<?= base_url('welcome') ?>">Home</a>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kategori</th>
                    <th>Barang</th>
                    <th>Stok</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="barangTable">
                <?php foreach ($barang as $brg): ?>
                    <tr>
                        <td><?= $brg['id'] ?></td>
                        <td><?= $brg['kategori'] ?></td>
                        <td><?= $brg['barang'] ?></td>
                        <td><?= $brg['stok'] ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editBarang(<?= $brg[
                                'id'
                            ] ?>)">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteBarang(<?= $brg[
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addBarangForm">
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select class="form-control" id="kategori_id" name="kategori_id" required>
                                <?php foreach ($kategori as $kat): ?>
                                    <option value="<?= $kat['id'] ?>"><?= $kat[
    'kategori'
] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="barang">Barang</label>
                            <input type="text" class="form-control" id="barang" name="barang" required>
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="number" class="form-control" id="stok" name="stok" required>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editBarangForm">
                        <input type="hidden" id="editId" name="id">
                        <div class="form-group">
                            <label for="editKategori_id">Kategori</label>
                            <select class="form-control" id="editKategori_id" name="kategori_id" required>
                                <?php foreach ($kategori as $kat): ?>
                                    <option value="<?= $kat['id'] ?>"><?= $kat[
    'kategori'
] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="editBarang">Barang</label>
                            <input type="text" class="form-control" id="editBarang" name="barang" required>
                        </div>
                        <div class="form-group">
                            <label for="editStok">Stok</label>
                            <input type="number" class="form-control" id="editStok" name="stok" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#addBarangForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '<?= site_url('barang/create') ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addModal').modal('hide');
                        location.reload();
                    }
                });
            });

            $('#editBarangForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '<?= site_url('barang/update') ?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#editModal').modal('hide');
                        location.reload();
                    }
                });
            });
        });

        function editBarang(id) {
            $.ajax({
                url: '<?= site_url('barang/edit') ?>/' + id,
                type: 'GET',
                success: function(response) {
                    var data = JSON.parse(response);
                    $('#editId').val(data.id);
                    $('#editKategori_id').val(data.kategori_id);
                    $('#editBarang').val(data.barang);
                    $('#editStok').val(data.stok);
                    $('#editModal').modal('show');
                }
            });
        }

        function deleteBarang(id) {
            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    url: '<?= site_url('barang/delete') ?>/' + id,
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
