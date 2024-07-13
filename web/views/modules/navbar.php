<div class="container py-2 py-lg-4">
  <div class="row">
    <div class="col-12 col-lg-2 mt-1">
      <div class="d-flex justify-content-center">
        <a href="<?= $path ?>" class="navbar-brand">
          <img src="<?= $path ?>views/assets/img/template/logo.png" class="brand-image img-fluid py-3 px-5 p-lg-0 pe-lg-3">
        </a>
      </div>
    </div>

    <div class="col-12 col-lg-7 col-xl-8 mt-1 px-3 px-lg-0">
      <div class="dropdown px-1 float-start templateColor">
        <a id="dropdownSubMenu1" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle text-uppercase">
          <span class="d-lg-block d-none">Categorias<i class="ps-lg-2 fas fa-th-list"></i></span>
          <span class="d-lg-none d-block"><i class="fas fa-th-list"></i></span>
        </a>

        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
          <li class="dropdown-submenu dropdown-hover">
            <a id="dropdownSubMenu0" href="/ropa" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle text-uppercase" onclick="redirect('/ropa')">
              <i class="fas fa-tshirt pe-2 fa-xs"></i> Ropa
            </a>

            <ul class="border-0 shadow py-3 ps-3 d-block d-lg-none">
              <li>
                <a tabindex="-1" href="/ropa-para-dama" class="dropdown-item">Ropa Para Dama</a>
              </li>

              <li>
                <a tabindex="-1" href="/ropa-para-hombre" class="dropdown-item">Ropa Para Hombre</a>
              </li>

              <li>
                <a tabindex="-1" href="/ropa-deportiva" class="dropdown-item">Ropa Deportiva</a>
              </li>

              <li>
                <a tabindex="-1" href="/ropa-infantil" class="dropdown-item">Ropa Infantil</a>
              </li>
            </ul>

            <ul aria-labelledby="dropdownSubMenu0" class="dropdown-menu border-0 shadow menuSubcategory">
              <li>
                <a tabindex="-1" href="/ropa-para-dama" class="dropdown-item">Ropa Para Dama</a>
              </li>

              <li>
                <a tabindex="-1" href="/ropa-para-hombre" class="dropdown-item">Ropa Para Hombre</a>
              </li>

              <li>
                <a tabindex="-1" href="/ropa-deportiva" class="dropdown-item">Ropa Deportiva</a>
              </li>

              <li>
                <a tabindex="-1" href="/ropa-infantil" class="dropdown-item">Ropa Infantil</a>
              </li>
            </ul>
          </li>

          <li class="dropdown-submenu dropdown-hover">
            <a id="dropdownSubMenu1" href="/calzado" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle text-uppercase" onclick="redirect('/calzado')">
              <i class="fas fa-shoe-prints pe-2 fa-xs"></i> Calzado
            </a>

            <ul class="border-0 shadow py-3 ps-3 d-block d-lg-none">
              <li>
                <a tabindex="-1" href="/calzado-para-dama" class="dropdown-item">Calzado Para Dama</a>
              </li>

              <li>
                <a tabindex="-1" href="/calzado-para-hombre" class="dropdown-item">Calzado Para Hombre</a>
              </li>

              <li>
                <a tabindex="-1" href="/calzado-deportivo" class="dropdown-item">Calzado Deportivo</a>
              </li>

              <li>
                <a tabindex="-1" href="/calzado-infantil" class="dropdown-item">Calzado Infantil</a>
              </li>
            </ul>

            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow menuSubcategory">
              <li>
                <a tabindex="-1" href="/calzado-para-dama" class="dropdown-item">Calzado Para Dama</a>
              </li>

              <li>
                <a tabindex="-1" href="/calzado-para-hombre" class="dropdown-item">Calzado Para Hombre</a>
              </li>

              <li>
                <a tabindex="-1" href="/calzado-deportivo" class="dropdown-item">Calzado Deportivo</a>
              </li>

              <li>
                <a tabindex="-1" href="/calzado-infantil" class="dropdown-item">Calzado Infantil</a>
              </li>
            </ul>
          </li>

          <li class="dropdown-submenu dropdown-hover">
            <a id="dropdownSubMenu2" href="/tecnologia" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle text-uppercase" onclick="redirect('/tecnologia')">
              <i class="fas fa-laptop pe-2 fa-xs"></i> Tecnología
            </a>

            <ul class="border-0 shadow py-3 ps-3 d-block d-lg-none">
              <li>
                <a tabindex="-1" href="/telefonos-movil" class="dropdown-item">Teléfonos Móvil</a>
              </li>

              <li>
                <a tabindex="-1" href="/tabletas-electronicas" class="dropdown-item">Tabletas Electrónicas</a>
              </li>

              <li>
                <a tabindex="-1" href="/computadoras" class="dropdown-item">Computadoras</a>
              </li>

              <li>
                <a tabindex="-1" href="/auriculares" class="dropdown-item">Auriculares</a>
              </li>
            </ul>

            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow menuSubcategory">
              <li>
                <a tabindex="-1" href="/telefonos-movil" class="dropdown-item">Teléfonos Móvil</a>
              </li>

              <li>
                <a tabindex="-1" href="/tabletas-electronicas" class="dropdown-item">Tabletas Electrónicas</a>
              </li>

              <li>
                <a tabindex="-1" href="/computadoras" class="dropdown-item">Computadoras</a>
              </li>

              <li>
                <a tabindex="-1" href="/auriculares" class="dropdown-item">Auriculares</a>
              </li>
            </ul>
          </li>

          <li class="dropdown-submenu dropdown-hover">
            <a id="dropdownSubMenu3" href="/cursos" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle text-uppercase" onclick="redirect('/cursos')">
              <i class="fas fa-graduation-cap pe-2 fa-xs"></i> Cursos
            </a>

            <ul class="border-0 shadow py-3 ps-3 d-block d-lg-none">
              <li>
                <a tabindex="-1" href="/desarrollo-web" class="dropdown-item">Desarrollo Web</a>
              </li>

              <li>
                <a tabindex="-1" href="/aplicaciones-moviles" class="dropdown-item">Aplicaciones Móviles</a>
              </li>

              <li>
                <a tabindex="-1" href="/diseno-grafico" class="dropdown-item">Diseño Gráfico</a>
              </li>

              <li>
                <a tabindex="-1" href="/marketing-digital" class="dropdown-item">Marketing Digital</a>
              </li>
            </ul>

            <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow menuSubcategory">
              <li>
                <a tabindex="-1" href="/desarrollo-web" class="dropdown-item">Desarrollo Web</a>
              </li>

              <li>
                <a tabindex="-1" href="/aplicaciones-moviles" class="dropdown-item">Aplicaciones Móviles</a>
              </li>

              <li>
                <a tabindex="-1" href="/diseno-grafico" class="dropdown-item">Diseño Gráfico</a>
              </li>

              <li>
                <a tabindex="-1" href="/marketing-digital" class="dropdown-item">Marketing Digital</a>
              </li>
            </ul>
          </li>

          <li class="dropdown-submenu dropdown-hover">
            <a id="dropdownSubMenu4" href="/accesorios" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle text-uppercase" onclick="redirect('/accesorios')">
              <i class="fas fa-anchor pe-2 fa-xs"></i> Accesorios
            </a>

            <ul class="border-0 shadow py-3 ps-3 d-block d-lg-none">
              <li>
                <a tabindex="-1" href="/variedades" class="dropdown-item">Variedades</a>
              </li>
            </ul>

            <ul aria-labelledby="dropdownSubMenu4" class="dropdown-menu border-0 shadow menuSubcategory">
              <li>
                <a tabindex="-1" href="/variedades" class="dropdown-item">Variedades</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>

      <form class="form-inline">
        <div class="input-group input-group w-100 me-0 me-lg-4">
          <input class="form-control rounded-0 p-3 pe-5 inputSearch" type="search" placeholder="Buscar..." style="height:40px">
          <div class="input-group-append px-2 templateColor">
            <button class="btn btn-navbar text-white btnSearch" type="button">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>

    <div class="col-12 col-lg-3 col-xl-2 mt-1 px-3 px-lg-0">
      <div class="my-2 my-lg-0 d-flex justify-content-center">
        <a href="/carrito">
          <button class="bt btn-default float-start rounded-0 border-0 py-2 px-3 templateColor">
            <i class="fa fa-shopping-cart"></i>
          </button>
        </a>

        <div class="small border float-start ps-2 pe-5 w-100">
          TU CESTA <span id="shoppingBasket">0</span><br> USD $<span id="totalShop">0.00</span>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function redirect(value) {
    window.location = value;
  }

  if (window.matchMedia("(max-width:768px)").matches) {
    $(".menuSubcategory").remove();
  }
</script>