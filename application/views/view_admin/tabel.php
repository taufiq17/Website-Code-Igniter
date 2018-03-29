<?php if($content=="tabel-kategori-artikel"){?>
<div class="row"> 
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
            Data Kategori Artikel : <a href="<?= site_url('adminoc/addkategori')?>">Tambah</a>
        </div>
        <div class="card-body no-padding">
            <table class="datatable table table-striped primary" cellspacing="0" width="100%">
               <thead>
                 <tr>
                     <th>No</th>
                     <th>ID. Kat</th>
                     <th>Kategori Artikel</th>
                     <th>.: Aksi :.</th>
                 </tr>
               </thead>
               <tbody>
                 <?php $no=1; foreach($datakategoriartikel as $row){ ?>  
                 <tr>
                      <td><?php echo $no++?></td>
                      <td><?= $row->id_katpost?></td>
                      <td><?php echo $row->kategori_post?></td>
                      <td>
                          <a href="<?= site_url('adminoc/edit_kategori/'.$row->id_katpost)?> ">
                              <button type="button" class="btn btn-primary btn-xs">
                                  <i class="fa fa-edit"></i> Ubah&nbsp;</button>
                          </a>
                          
                          <a href="<?= site_url('adminoc/delete_kategori/'.$row->id_katpost)?>">
                              <button type="button" class="btn btn-danger btn-xs">
                                  <i class="fa fa-edit"></i> Hapus</button>
                          </a>
                      </td>
                 </tr>
                 <?php } ?>
               </tbody>
            </table>
        </div>
      </div>
    </div>
</div>

<?php } ?>


<?php if($content=="tabel-artikel"){?>
<div class="row"> 
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
            Data Artikel : <a href="<?= site_url('adminoc/addartikel')?>">Tambah</a>
        </div>
        <div class="card-body no-padding">
            <table class="datatable table table-striped primary" cellspacing="0" width="100%">
               <thead>
                 <tr>
                     <th>No</th>
                     <th>Tgl. Post</th>
                     <th>Kategori Artikel</th>
                     <th>Judul</th>
                     <th>Thumb</th>
                     <th>Aktif</th>
                     <th>.: Aksi :.</th>
                 </tr>
               </thead>
               <tbody>
                   <?php $no=1; foreach($dataartikel as $row){ ?>
                 <tr>
                      <td><?php echo $no++?></td>
                      <td><?php echo $row->tgl_post?></td>
                      <td><?php echo $row->kategori_post?></td>
                      <td><?php echo $row->judul?></td>
                      <td>
                          <img alt="<?= $row->thumbs ?>" src="<?= base_url()?>flat-admin/img/foto-header/thumbs/<?= $row->thumbs ?>" width="50" height="50" >
                      </td>
                      <td>
                          <?php if ($row->post_aktif == 1){
                              echo 'Aktif';
                          }else{
                              echo 'Non Aktif';
                          }?>
                      </td>
                      <td>
                          <a href="<?= site_url('adminoc/edit_artikel/'.$row->id_post)?> ">
                              <button type="button" class="btn btn-primary btn-xs">
                                  <i class="fa fa-edit"></i> Ubah&nbsp;</button>
                          </a>
                          
                          <a href="<?= site_url('adminoc/delete_artikel/'.$row->id_post)?>">
                              <button type="button" class="btn btn-danger btn-xs">
                                  <i class="fa fa-edit"></i> Hapus</button>
                          </a>
                      </td>
                 </tr>
                   <?php } ?>
               </tbody>
            </table>
        </div>
      </div>
    </div>
</div>

<?php } ?>


<?php if($content=="tabel-aboutus"){?>
<div class="row"> 
    <div class="col-xs-12">
      <div class="card">
        <div class="card-header">
            Data About Us : <a href="">Tambah</a>
        </div>
        <div class="card-body no-padding">
            <table class="datatable table table-striped primary" cellspacing="0" width="100%">
               <thead>
                 <tr>
                     <th>No</th>
                     <th>Judul</th>
                     <th>.: Aksi :.</th>
                 </tr>
               </thead>
               <tbody>
                 <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                 </tr>
        
               </tbody>
            </table>
        </div>
      </div>
    </div>
</div>

<?php } ?>