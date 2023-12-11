<?php require_once('./php_librarys/bdlaia.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>Tu Título</title>
    
</head>

<body>
    <div class="container">
        <form method="post" action="" id="rankingForm" name="rankingForm">
            <button class="btn btn-danger" type="button" onclick="cargarTabla(1)">WARCELONA</button>
            <button class="btn btn-info" type="button" onclick="cargarTabla(2)">BRASIL</button>
            <button class="btn btn-light" type="button" onclick="cargarTabla(3)">KENIA</button>
            <button class="btn btn-info" type="button" onclick="cargarTabla(4)">INDIA</button>
            <button class="btn btn-light" type="button" onclick="cargarTabla('Global')">GLOBAL</button>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th> Posicion </th>
                    <th>Nombre Usuario</th>
                    <th>Puntuacion</th>
                </tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>
    </div>
    
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Modal 1</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Show a second modal and hide this one with the button below.
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Modal 2</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Hide this modal and show the first with the button below.
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Back to first</button>
      </div>
    </div>
  </div>
</div>
<button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">Open first modal</button>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function cargarTabla(pais) {
            fetch('./php_controllers/laiaController.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'pais=' + encodeURIComponent(pais),
                })
                .then(response => response.text())
                .then(data => {
                    actualizarTabla(data);
                })
                .catch(error => {
                    console.error('Error al realizar la solicitud:', error);
                });
        }

        function actualizarTabla(data) {
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = data;
        }
    </script>
</body>

</html>
