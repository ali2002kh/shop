<template>
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <div class="col-md-4 d-flex align-items-center">
              <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
              </a>
              <span class="mb-3 mb-md-0 text-muted">&copy; 2022 Company, Inc</span>
            </div>
            <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                <li class="ms-3"><a class="text-muted" href="#"><i class="fa fa-instagram" style="font-size:25px"></i></a></li>
                <li class="ms-3"><a class="text-muted" href="#"><i class="fa fa-telegram" style="font-size:25px"></i></a></li>
                <li class="ms-3"><a class="text-muted" href="#"><i class="fa fa-whatsapp" style="font-size:25px"></i></a></li>
            </ul>
          </footer>
          <a href="tel:09335107705" class="nav-link active text-muted mx-4">09335107705</a>
          <router-link :to="{name: 'about-us'}" class="nav-link active text-muted mx-4">about us</router-link>
          <p class="text-muted m-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur laborum accusantium sunt asperiores, error exercitationem praesentium dolorem quasi, debitis ipsam fugiat tenetur, officiis reprehenderit voluptate facilis itaque illum eligendi voluptates.</p>
    </div>
</template>