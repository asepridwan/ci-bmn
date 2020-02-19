<!DOCTYPE html>
<html>
<head>
	<title>Entri BAST</title>
	<?php include_once 'basisstyiledanjs.php' ;?>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

	<script type="text/javascript">
    var BASE_URL = "<?php echo base_url();?>";
	</script>

  <script type="text/javascript">
    $(function() {
            $( "#nama" ).autocomplete({ //the recipient text field with id #username
            source:
            function( request, response ) {
              $.ajax({
                  url: BASE_URL+"bmn/search_username",
                  dataType: "json",
                  data: request,
                  success: function(data){
                      if(data.response == 'true') {
                         response(data.message);
                      }
                  }
              });
          }
      });
    });
    </script>
    <script type="text/javascript">
      $(function() {
              $( "#jnsaset" ).autocomplete({ //the recipient text field with id #username
              source:
              function( request, response ) {
                $.ajax({
                    url: BASE_URL+"bmn/jnsaset",
                    dataType: "json",
                    data: request,
                    success: function(data){
                        if(data.response == 'true') {
                           response(data.message);
                        }
                    }
                });
            }
        });
      });
      </script>
  <style>
  .note
  {
      text-align: center;
      height: 80px;
      background: -webkit-linear-gradient(left, #0072ff, #8811c5);
      color: #fff;
      font-weight: bold;
      line-height: 80px;
  }
  .form-content
  {
      padding: 5%;
      border: 1px solid #ced4da;
      margin-bottom: 2%;
  }
  .form-control{
      border-radius:1.5rem;
  }
  .btnSubmit
  {
      border:none;
      border-radius:1.5rem;
      padding: 1%;
      width: 20%;
      cursor: pointer;
      background: #0062cc;
      color: #fff;
  }
  </style>
</head>
<body>

	<?php include_once 'navbar-atas/awal.php';?>

<form method="post" action="<?php echo base_url().'bmn/entribast/1'; ?>"
<div class="container register-form">
          <div class="form">
              <div class="note">
                  <p>FORMULIR ENTRI ASET TERKAIT BMN.</p>
              </div>

              <div class="form-content">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                              <input type="text" name="pns" id="nama" class="form-control" autofocus placeholder="Nama User *" required/>
                          </div>
                          <div class="form-group">
                              <input type="text" name="jnsaset" id="jnsaset" class="form-control"  placeholder="Jenis Aset *" required/>
                          </div>
                          <div class="form-group">
                              <input type="text" name="nup" id="nup" maxlength="4" class="form-control"  placeholder="NUP *" required/>
                          </div>
													<div class="form-group">
                              <input type="date" name="tgl" id="tgl" class="form-control"  required/>
                          </div>
                          <div class="form-group">
                              <input type="text" name="bast" id="bast" class="form-control"  placeholder="Nomor BAST *" required/>
                          </div>
                      </div>
                  </div>
                  <input type="submit" name="submit" value="Submit">
              </div>
          </div>
      </div>
    </form>
		<?php
		if($this->session->flashdata('error')==true){
			echo "<p style='color:red;' align='center'>".$this->session->flashdata('error')."</p><br>";
		}
		if($this->uri->segment(3)==1){
			$x=1;
			echo "<Strong>List aset yang dipegang atas nama ".mb_strtoupper($user)."</strong> <br>";
			echo "<table class=table>
						<thead>
						<tr>
							<th scope=col>#</th>
							<th scope=col>BARCODE</th>
							<th scope=col>JENIS BARANG</th>
							<th scope=col>MERK / TYPE</th>
							<th scope=col>USER</th>
						</tr>";
			foreach($check as $row){
				echo "<tbody>
							<tr>
							<td>".$x++."</td>
							<td>".$row->Barcode."</td>
							<td>".$row->jenisBarang."</td>
							<td>".$row->merkType."</td>
							<td>".$row->user."</td>
							</tr>
							</tbody>";
			}
			echo "</thead></table>";
		}
		?>
</body>
</html>
