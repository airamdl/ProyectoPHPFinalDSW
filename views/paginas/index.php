<h1>PERSONAJES MÁS DESTACADOS</h1>
<div class="lista">
    <?php foreach ($personajes as $personaje): ?>
        <div class="personaje">
            <h2 class="nombre-personaje"><?php echo $personaje->nombre; ?></h2>
            <p class="rol"><?php echo $personaje->rol; ?></p>
            <p class="procedencia"><?php echo $personaje->procedencia; ?></p>
            <p class="recurso"><?php echo $personaje->recurso; ?></p>
            <p class="tipo-golpe"><?php echo $personaje->tipoGolpe; ?></p>
        </div>
    <?php endforeach; ?>
</div>