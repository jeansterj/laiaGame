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
