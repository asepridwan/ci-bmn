<!doctype html>
<html lang="en">
  <head>
    <title>Laboratori only for you or for everyone</title>
    <!-- Required meta tags -->
    <!-- <meta charset="utf-8"> -->
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->
    <?php include_once 'basisstyiledanjs.php' ;?>

    <script>
    $(document).ready(function(){
      $('#klik').on('click',function(){
        $.ajax({
          url       : 'http://www.omdbapi.com/',
          type      : 'get',
          dataType  : 'json',
          data      : {
                        'apikey': 'f4809b85',
                        's'     : $('#cari').val()
                      },
          success   : function (result) {
            let nonton = result.Search;
            if(result.Response=="True"){
              $.each(nonton, function(i, data){
                $('#me').append(`
                  <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                    <img src="`+ data.Poster +`" class="card-img-top" alt="NO IMAGE">
                    <div class="card-body">
                      <h5 class="card-title">`+ data.Title+`</h5>
                      <p class="card-text">`+ data.Year+`</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                    </div>
                    </div>
                  `);
              });
            }else {
              $('#me').html('<h3>'+result.Error+'</h3>')
            }
          }
        });
      });
    });
    </script>

  </head>
  <body>
    <div class="container">
      <div class="row mt-3 justify-content-center">
        <div class="col-md-8">
          <div class="input-group mb-3">
            <input class="form-control" type="text" size="100" name="cari" id="cari" placeholder="uji coba cari rest api di omdbapi.com">
            <button class="btn btn-dark" type="button" id="klik">Cari</button>
          </div>
        </div>
      </div>
      <div class="row" id="me">
      </div>
    </div>
  </body>
</html>
