<?php include "db.php" ?>

<?php

if(isset($_POST["hidden"])){
    $title = $_POST["edit_title"];
    $description = $_POST["edit_description"];
    $id = $_POST["hidden"];
    $sql = "UPDATE `notes` SET `id`='$id', `title`='$title', `description`='$description' WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);
}

echo '
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    <input type="hidden" name="hidden" id="hidden">
                    <div class="mb-3">
                        <label for="edit_title">Edit judul</label>
                        <input type="text" class="form-control" id="edit_title" placeholder="Edit judul konten" name="edit_title">
                    </div>
                    <div class="mb-3">
                        <label for="edit_description" class="form-label">Deskripsi Konten</label>
                        <textarea class="form-control" id="edit_description" rows="3" name="edit_description" placeholder="Edit Konten di sini..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Update Notes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
        ';
?>
