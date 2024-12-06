<section class="fullCenter">

<style>
    /* Contenedor principal centrado */
    .fullCenter {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: url('https://www.eltrecetv.com.ar/resizer/v2/https%3A%2F%2Fthumbs.vodgc.net%2F2-146-Etc8x71726678153492-1726681898.jpg?auth=01653a516748f95cbb5e5aa0465bc9fc88721def16c1f47e1c7c4dd7692996c4&width=767') no-repeat center center/cover;
      margin: 0;
    }

/* Tarjeta del formulario */
.depth-1 {
  background: rgba(255, 255, 255, 0.9); /* Fondo blanco con opacidad */
  border-radius: 16px;
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1); /* Sombras suaves */
  padding: 2rem;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.depth-1:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
}

/* Etiquetas */
label {
  font-size: 1rem;
  font-weight: 600;
  color: #374151; /* Gris oscuro */
  margin-bottom: 0.5rem;
  display: block;
}

/* Campos de entrada */
input[type="email"],
input[type="password"] {
  border: 2px solid #c7c7c7; /* Borde gris claro */
  border-radius: 8px;
  padding: 0.75rem;
  font-size: 1rem;
  width: 100%;
  color: #000000; /* Letras negras */
  background: #ffffff; /* Fondo blanco */
  transition: border-color 0.3s, box-shadow 0.3s;
}

input[type="email"]:focus,
input[type="password"]:focus {
  border-color: #3b82f6; /* Azul suave */
  box-shadow: 0 0 5px rgba(59, 130, 246, 0.6);
  outline: none;
}

/* Botón */
button.primary {
  background-color: #000000; /* Negro inicial */
  color: #ffffff; /* Letras blancas */
  border: none;
  border-radius: 8px;
  padding: 0.875rem 1.75rem;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease, transform 0.3s ease;
  display: block;
  margin: 1.5rem auto 0;
}

button.primary:hover {
  background-color: #3b82f6; /* Azul al pasar el cursor */
  transform: translateY(-2px); /* Efecto de elevación */
}

/* Errores */
.error {
  font-size: 0.875rem;
  color: #dc2626; /* Rojo */
  margin-top: 0.5rem;
  font-weight: 600;
}

/* Responsive */
@media (min-width: 768px) {
  .row {
    display: flex;
    align-items: center;
  }

  .col-m-4 {
    flex: 0 0 33.33%;
  }

  .col-m-8 {
    flex: 0 0 66.67%;
  }

  .offset-m-2 {
    margin-left: 16.67%;
  }
}
  </style>





  <form class="grid" method="post" action="index.php?page=sec_login{{if redirto}}&redirto={{redirto}}{{endif redirto}}">
    <section class="depth-1 row col-12 col-m-8 offset-m-2 col-xl-6 offset-xl-3">
      <h1 class="col-12">Iniciar Sesión</h1>
      <div class="row">
        <label class="col-12 col-m-4 flex align-center" for="txtEmail">Correo Electrónico</label>
        <div class="col-12 col-m-8">
          <input class="width-full" type="email" id="txtEmail" name="txtEmail" value="{{txtEmail}}" />
        </div>
        {{if errorEmail}}
          <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorEmail}}</div>
        {{endif errorEmail}}
      </div>
      <div class="row">
        <label class="col-12 col-m-4 flex align-center" for="txtPswd">Contraseña</label>
        <div class="col-12 col-m-8">
         <input class="width-full" type="password" id="txtPswd" name="txtPswd" value="{{txtPswd}}" />
        </div>
        {{if errorPswd}}
        <div class="error col-12 py-2 col-m-8 offset-m-4">{{errorPswd}}</div>
        {{endif errorPswd}}
      </div>
    {{if generalError}}
      <div class="row">
        {{generalError}}
      </div>
    {{endif generalError}}
    <div class="row right flex-end px-4">
      <button class="primary" id="btnLogin" type="submit">Iniciar Sesión</button>
    </div>
    </section>
  </form>
</section>
