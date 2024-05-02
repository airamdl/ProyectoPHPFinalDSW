<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="/css/login.css">
<div class="log-comple">
<?php foreach($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>
    <?php endforeach; ?>
<a href="./" class="login-volver">Volver</a>
<?php
include 'SignUp.php';

?>

<div class="login-toggle-container">
    <div class="login-toggle">
        <div class="login-toggle-panel login-toggle-left">
            <h1>¡Bienvenido de nuevo!</h1>
                <p>Regístrese con sus datos personales para <br>utilizar todas las funciones del sitio</p>
                    <button class="hidden" id="login"><a href="./login.php">Iniciar sesión</a></button>
        </div>

        <div class="login-toggle-panel login-toggle-right">
            <h1>¡Hola, amig@!</h1>
            <p><dd>Regístrese con sus datos personales para utilizar todas las funciones del sitio</dd></p>
                    <button class="hidden" id="register"> Regístrate</button> 
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="/js/login.js"></script>
</body>
</html>