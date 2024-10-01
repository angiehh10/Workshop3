<?php

/**
 * Obtiene las provincias desde la base de datos
 */
function getProvinces() {
    $conn = getConnection();
    $sql = "SELECT id, name FROM provinces";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die('Error al obtener provincias: ' . mysqli_error($conn));
    }

    $provinces = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $provinces[$row['id']] = $row['name'];
    }

    mysqli_close($conn);
    return $provinces;
}

/**
 * Conexión a la base de datos
 */
function getConnection() {
    $connection = mysqli_connect('localhost', 'root', '', 'tarea3');

    if (!$connection) {
        die('Error de conexión: ' . mysqli_connect_error());
    }

    return $connection;
}

/**
 * Guarda un usuario específico en la base de datos, incluyendo la provincia
 */
function saveUser($user) {
  $firstName = $user['firstName'];
  $lastName = $user['lastName'];
  $username = $user['email'];
  $provinceId = $user['province_id'];

  // Usar sentencias preparadas para evitar inyecciones SQL
  $conn = getConnection();
  $stmt = $conn->prepare("INSERT INTO users (name, lastname, username, province_id) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("sssi", $firstName, $lastName, $username, $provinceId);

  if ($stmt->execute()) {
    return true;
  } else {
    return false; // Manejar el error adecuadamente aquí
  }
}
