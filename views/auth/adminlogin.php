<link rel="stylesheet" href="/public/css/login.css">
<body>
<?php foreach($errores as $error): ?>
        <div>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        </div>
    <?php endforeach; ?>

    <div class="login-container">
        <h2>Login de Administrador</h2>
        <form method="post">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="usuario" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn" name="btnIniciar">Iniciar sesión</button>
            <!-- <div class ="signup-link">
            <a href="/admin/signup_admin.php">Registrarse</a>
            </div> -->
        </form>
    </div>
</body>
</html>