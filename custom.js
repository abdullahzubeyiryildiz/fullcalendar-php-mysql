document.addEventListener('DOMContentLoaded', function() {
 
    
    var calendarEl = document.getElementById('calendar');
  
    const today = new Date().toISOString().slice(0, 10);

    function handleDateClick(info) {  
      let date = moment(info.date).format('YYYY-MM-DDTHH:mm');  
      $('#event-start').val(date); 
      $('#event-end').val(date); 
      $('#myModal').modal('show');
  }

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,listWeek'
      },
      locale:"tr",
      initialDate: today,
      navLinks: true, 
      nowIndicator: true,
      eventTimeFormat: { 
        hour: '2-digit',
        minute: '2-digit', 
        meridiem: false
      },  
      weekNumberCalculation: 'ISO', 
      editable: true,
      selectable: true,
      dayMaxEvents: true,  
      lazyFetching: true, 
      dateClick: handleDateClick,
      eventClick: function(info) { 
        
          $('#buttonDelete').attr('data-id',info.event.id);  
          $('#edit-id').val(info.event.id);  
          $('#edit-title').val(info.event.title);  
          $('#edit-start').val(moment(info.event.start).format('MM.DD.YYYY HH:mm'));
         
          if(info.event.end != null) {
              endTime = moment(info.event.end).format('MM.DD.YYYY HH:mm');
          }else{
              endTime = moment(info.event.start).format('MM.DD.YYYY HH:mm');
          } 

          $('#edit-end').val(endTime);
          $('#editModal').modal('show');
        },
      events: function (info, successCallback, failureCallback) {
            $.ajax({
                url: 'api.php',
                dataType: 'json',
                data: {
                    start: info.startStr,
                    end: info.endStr,
                    timezone: info.timeZone,
                    action: 'list'
                },
                success: function (response) {
                    successCallback(response);
                },
                error: function (xhr, status, error) {
                    failureCallback(error);
                }
            });
        }, 
        eventDrop: function(info) {
            var event = info.event;
            var start = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
            var end = moment(event.end).format('YYYY-MM-DD HH:mm:ss');
            var id = event.id;
            
            $.ajax({
              url: 'api.php?action=dropupdate',
              type: 'POST',
              data: {
                action: 'update',
                id: id,
                start: start,
                end: end
              },
              success: function(response) {
                if (response.success) { 
                 toastr.success(response.message);
                } else { 
                 toastr.success(response.message);
                }
              },
              error: function(xhr, status, error) { 
                toastr.error('Bir hata oluştu.');
              }
            });
          }
    });
 

    calendar.setOption('buttonText', {
      dayGridMonth: 'Ay',
      timeGridWeek:'Hafta',
      listWeek:'Liste',
      today:'Bugün',
    });
 
    calendar.render(); 
 

  $('#event-form').on('submit', function(event) { 
    event.preventDefault();
    var data = $(this).serializeArray();     

    $.ajax({
      url: 'api.php?action=create',
      type: 'POST',
      dataType: 'json',
      data: data,
      success: function(response) { 
        if(response.success == true) {
          $('#myModal').modal('hide');
          calendar.refetchEvents();
          toastr.success(response.message);
        }
      
      },
      error: function(xhr, status, error) {
        toastr.error('Bir hata oluştu.');
      }
    });
  });
  
    $('#edit-form').on('submit', function(e) {
      e.preventDefault();
      var form = $(this).serialize(); 
  
      $.ajax({
          url: 'api.php?action=update',
          method: 'POST',
          data: form,
          success: function(response) { 
              if (response.success == true) {
                  $('#editModal').modal('hide');
                  calendar.refetchEvents();
                  toastr.success(response.message);
              } else { 
                toastr.error(response.error);
              }
          },
          error: function(xhr, status, error) {
            toastr.error('Bir hata oluştu.');
          }
      });
  });
  
  
  
  function deleteEvent(id) { 
    var confirmDelete = confirm("Silmek İstediğinize Eminmisiniz?"); 
    if (confirmDelete) {
      $.ajax({
        url: 'api.php?action=delete',
        type: 'POST',
        data: { action: 'delete', id: id },
        dataType: 'json',
        success: function(response) { 
          if (response.success) { 
            calendar.refetchEvents();
            $('#editModal').modal('hide'); 
       
          }
        }
      });
    }
  }
  
  
  $('#buttonDelete').on('click', function(e) {
      e.preventDefault();
    let id = $(this).attr('data-id');
      deleteEvent(id);
  });

 
  
  
    });