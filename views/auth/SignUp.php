<div class="login-container" id="login-container">
        <div class="login-form-container login-sign-up">
            <form method="POST" enctype="multipart/form-data">
                <h1>Crea una cuenta<i class="mdi mdi-current-ac:"></i></h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>o usa tu email para registrarte</span>
                <form action=".php" method="post">
                <input type="text" name="Usuario[usuario]" placeholder="Nombre" required>
                <input type="password" name="Usuario[password]" placeholder="Password" required>
                <input type="submit" name="registrar" value="Registrarse">
                </form>


            </form>
        </div>