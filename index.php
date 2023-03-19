<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name='viewport' content='width=device-width, initial-scale=1.0' />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pratik Yazılımcı - Fullcalender</title>
 
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet' /> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"  />

</head>
<body>


<div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 mt-2 mb-5">
       <button class='btn btn-primary btn-block' data-toggle='modal' data-target='#myModal'>Etkinlik Ekle</button> 
    </div>
    <div class="col-lg-12">

    <div id="calendar"></div>

    </div>
  </div>
</div>

<!-- Modal -->
<div class='modal fade' id='myModal'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h4 class='modal-title'>Etkinlik Ekle</h4>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
      </div>
      <div class='modal-body'>
        <form id='event-form'>
          <div class='form-group'>
            <label for='event-title'>Başlık:</label>
            <input type='text' class='form-control' id='event-title' name='title'>
          </div>
          <div class='form-group'>
            <label for='event-start'>Başlangıç Tarihi:</label>
            <input type='datetime-local' class='form-control' id='event-start' name='start'>
          </div>
          <div class='form-group'>
            <label for='event-end'>Bitiş Tarihi:</label>
            <input type='datetime-local' class='form-control' id='event-end' name='end'>
          </div> 
          <button type='submit' class='btn btn-primary'>Kaydet</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content"> 
          <form id="edit-form"> 
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Event Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-title" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" id="edit-title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-start" class="col-form-label">Start:</label>
                        <input type="text" class="form-control" id="edit-start" name="start" readonly  required>
                    </div>
                    <div class="form-group">
                        <label for="edit-end" class="col-form-label">End:</label>
                        <input type="text" class="form-control" id="edit-end" name="end" readonly required>
                    </div>
                    <input type="hidden" class="form-control" id="edit-id" name="id" > 
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-danger" id="buttonDelete" data-id="">Sil</button> 
             <button type='submit' class="btn btn-primary" id="save">Kaydet</button> 
            </div> 
        </form>
        </div>
    </div>
</div>
 

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" ></script> 

<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"  ></script>

<script src="custom.js"></script>
</body>
</html>