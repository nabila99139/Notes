<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .form {
            border: 2px solid #ced4da;
            padding: 1rem;
            border-radius: 8px;
        }
    </style>
    <title>Notes App</title>
</head>

<body>
    <?php include "nav.php"; ?>
    <?php include "db.php"; ?>
    <?php include "edit.php"; ?>
    <?php
    if (isset($_POST["submit"])) {
        if(!isset($_POST["hidden"])){
            $title = $_POST["title"];
            $description = $_POST["description"];
            $sql = "INSERT INTO `notes`(`title`, `description`) VALUES ('$title', '$description')";
            $result = mysqli_query($conn, $sql);
        }
    }
    ?>

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1>Add Notes</h1>
                <form class="form" method="POST">
                    <div class="mb-3">
                        <label for="title">Judul</label>
                        <input type="text" class="form-control" id="title" placeholder="Masukkan judul konten" name="title">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi Konten</label>
                        <textarea class="form-control" id="description" rows="3" name="description" placeholder="Tulis disini..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Upload Notes</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h1>Notes</h1>

                <?php
                $sql = "SELECT * FROM `notes`";
                $results = mysqli_query($conn, $sql);
                $noNotes = true;
                while ($fetch = mysqli_fetch_assoc($results)) {
                    $noNotes = false;
                    echo '<div class="card my-3">
                                <div class="card-body">
                                    <h5 class="card-title">' . $fetch["title"] . '</h5>
                                    <p class="card-text">' . $fetch["description"] . '</p>
                                    <button type="button" class="btn btn-warning edit" data-bs-toggle="modal" data-bs-target="#exampleModal" id="' . $fetch["id"] . '">Edit</button>
                                    <a href="./delete.php?id=' . $fetch["id"] . '" class="btn btn-danger">Delete</a>
                                </div>
                            </div>';
                }
                if ($noNotes) {
                    echo '<div class="card my-3"> 
                            <div class="card-body">
                                <h5 class="card-title">Message :</h5>
                                <p class="card-text">No Notes Available</p>
                            </div>
                        </div>';
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        const editButtons = document.querySelectorAll(".edit"); // Gunakan ".edit" untuk memilih elemen dengan class "edit"
        const editTitle = document.getElementById("edit_title");
        const editDescription = document.getElementById("edit_description");
        const hiddenInput = document.getElementById("hidden");

        editButtons.forEach(element => {
            element.addEventListener("click", () => {
                const titleText = element.parentElement.querySelector(".card-title").innerText;
                const descriptionText = element.parentElement.querySelector(".card-text").innerText;

                editTitle.value = titleText;
                editDescription.value = descriptionText;
                hiddenInput.value = element.id;

                console.log(hiddenInput)

                const modal = new bootstrap.Modal(document.getElementById("exampleModal"));
                modal.show();
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>