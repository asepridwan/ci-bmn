<div class="container mt-1 mb-4" style="background-color:silver;">
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link <?php if($this->uri->segment(2)=='profil'){echo "active";} ?>" href="<?=base_url().'bmn/profil';?>"><strong>Beranda</strong></a>
      </li>

      <?php
        $admin=$this->session->userdata('admin');
        if($admin==1){
          echo "
            <li class='nav-item'>
              <a class='nav-link ";if($this->uri->segment(2)=='bast'){echo "active";} echo "'  href='".base_url()."bmn/bast'><strong>BAST</strong></a>
            </li>
            <li class='nav-item'>
              <a class='nav-link ";if($this->uri->segment(2)=='bap'){echo "active";} echo "'  href='".base_url()."bmn/bap'><strong>BAP</strong></a>
            </li>
            <li class='nav-item'>
              <a class='nav-link ";if($this->uri->segment(2)=='sps'){echo "active";} echo "'  href='".base_url()."bmn/sps'><strong>SPS</strong></a>
            </li>
            <li class='nav-item'>
              <a class='nav-link ";if($this->uri->segment(2)=='insertaset'){echo "active";} echo "'  href='".base_url()."bmn/insertaset'><strong>Input Aset</strong></a>
            </li>
            <li class='nav-item'>
              <a class='nav-link ";if($this->uri->segment(2)=='createkodeaset'){echo "active";} echo "'  href='".base_url()."bmn/createkodeaset'><strong>Input Kode Aset</strong></a>
            </li>
            "
          ;
        }
      ?>

      <li class="nav-item">
        <a class="nav-link" href="<?=base_url().'bmn/logout';?>"><strong>Logout</strong></a>
      </li>
    </ul>
</div>
