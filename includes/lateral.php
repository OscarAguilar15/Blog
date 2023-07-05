<?php
require_once('includes/helpers.php');
?>
<div id="contenedor">
<aside id="sidebar">
            <?php if(isset($_SESSION['usuario'])):?>
                
                <div id="usuario-logueado" class="bloque">
                    <h3><?php echo $_SESSION['usuario']['nombre'].' '.$_SESSION['usuario']['apellidos'];?></h3>
                    <a class="boton boton-verde" href="logout.php">Crear entradas</a>
                    <a class="boton boton-naranja" href="logout.php">Datos</a>
                    <a class="boton" href="logout.php">Log Out</a>
                </div>
                
            <?php endif; ?>

            
            <div id="login" class="bloque">
                <h3>Identifícate</h3>
                <?php if(isset($_SESSION['error_login'])):?>
                
                <div class="alerta alerta-error">
                    <?= $_SESSION['error_login'];?></h3>
                </div>
                <?php endif; ?>
                <form action="login.php" method="post">
                    <label for="email">Email</label>
                    <input type="email" name="email">

                    <label for="email">Password</label>
                    <input type="password" name="password">

                    <input type="submit" value="Entrar">
                </form>
            </div>

            <div id="register" class="bloque">
                <?php if(isset($_SESSION['completado'])):?>
                    <div class="alerta alerta-exito">
                        <?php echo($_SESSION['completado']); ?>
                    </div>
                <?php elseif(isset($_SESSION['report'])): ?>
                    <div class="alerta alerta-error">
                        <?php echo "fallo al guardar usuario"; ?>
                    </div>
                <?php endif; ?>

                <h3>Registro</h3>
                <form action="registro.php" method="post">
                    <label for="nombre">nombre</label>
                    <input type="text" name="nombre">
                    <?php echo isset($_SESSION['report']) ? Showerror($_SESSION['report'],'nombre'): '' ?>

                    <label for="apellido">apellido</label>
                    <input type="text" name="apellido">
                    <?php echo isset($_SESSION['report']) ? Showerror($_SESSION['report'],'apellido') : ''?>

                    <label for="email">Email</label>
                    <input type="email" name="email">
                    <?php echo isset($_SESSION['report']) ? Showerror($_SESSION['report'],'email') : ''?>
                    
                    <label for="email">Password</label>
                    <input type="password" name="password">
                    <?php echo isset($_SESSION['report']) ? Showerror($_SESSION['report'],'pass') : ''?>
                    
                    <input type="submit" name="submit" value="Registro">
                </form>
                <?php borrarerrores(); ?> 
            </div>
        </aside>