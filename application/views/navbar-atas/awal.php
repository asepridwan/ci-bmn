<div class="container mt-4 mb-4" style="background-color:silver;">
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link <?php if($this->uri->segment(2)=='profil'){echo "active";} ?>" href="<?=base_url().'bmn/profil';?>">Beranda</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($this->uri->segment(2)=='bast'){echo "active";} ?>" href="<?=base_url().'bmn/bast';?>">BAST</a>
      </li>
      <?php
      // $admin=$this->session->userdata('admin');
      // if($admin==1){echo "
      // <li class='nav-item'>
      //   <a class='nav-link ";if($this->uri->segment(2)=='bast'){echo "active";} echo "'  href='".base_url()."bmn/bast'>BAST BMN</a>
      // </li>";} 
      ?>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url().'bmn/logout';?>">Logout</a>
      </li>
    </ul>
</div>
