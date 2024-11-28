<?php
// Iniciar la sesión
session_start();
require_once 'config.php';

// Verificar si el usuario está autenticado y es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit();
}

// Obtener la lista de usuarios
$sql = "SELECT lpa_user_ID, lpa_user_username, lpa_user_role FROM lpa_users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
    <h1>Manage Users</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $user['lpa_user_username']; ?></td>
                    <td><?php echo $user['lpa_user_role']; ?></td>
                    <td>
                        <form action="update_role.php" method="POST">
                            <select name="user_role">
                                <option value="user" <?php if ($user['lpa_user_role'] == 'user') echo 'selected'; ?>>User</option>
                                <option value="admin" <?php if ($user['lpa_user_role'] == 'admin') echo 'selected'; ?>>Admin</option>
                            </select>
                            <input type="hidden" name="user_id" value="<?php echo $user['lpa_user_ID']; ?>">
                            <button type="submit">Update Role</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>

