<?php
include('authentication.php');
include('includes/header.php');
include('includes/topbar.php');
include('includes/sidebar.php');
include('../admin/config/dbconn.php');
?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container-fluid">
          
        </div>
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              
            </div>
            <!-- /.row -->
          </div><!-- /.container-fluid -->
        </section>
      </div>
    </div>
    <div class="wrapper">

      <div class="modal fade" id="AppointmentDetails">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="modalTitle" class="modal-title">Appointment Details</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div id="modalBody" class="modal-body">
              <div class="viewdetails">

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- <script>
        $(function () {

          $('.userdata').click(function (e) {
            var clientTag = document.getElementById("client-label");
            var requiredId = clientTag.getAttribute('data-id');
            window.location.href = 'edit-appointment.php?id=' + requiredId;

          });

          function ini_events(ele) {
            ele.each(function () {

              var eventObject = {
                title: $.trim($(this).text())
              }

              $(this).data('eventObject', eventObject)

              $(this).draggable({
                zIndex: 1070,
                revert: true,
                revertDuration: 0
              })

            })
          }

          ini_events($('#external-events div.external-event'))

          var date = new Date()
          var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()
          var scheds = $.parseJSON('<?php echo ($sched_arr) ?>');

          var Calendar = FullCalendar.Calendar;
          var Draggable = FullCalendar.Draggable;

          var containerEl = document.getElementById('external-events');
          var checkbox = document.getElementById('drop-remove');
          var calendarEl = document.getElementById('calendar');

          new Draggable(containerEl, {
            itemSelector: '.external-event',
            eventData: function (eventEl) {
              return {
                title: eventEl.innerText,
                backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
              };
            }
          });

          var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },

            events: function (event, successCallback) {
              var events = []
              Object.keys(scheds).map(k => {
                events.push({
                  id: scheds[k].id,
                  title: scheds[k].pname,
                  start: moment(scheds[k].timestamp).format('YYYY-MM-DD[T]HH:mm'),
                  end: moment(scheds[k].enddate).format('hh:mm'),
                  backgroundColor: scheds[k].bgcolor,
                  borderColor: scheds[k].bgcolor
                });
              })
              successCallback(events)

            },
            eventClick: function (info) {
              var userid = info.event.id;

              $.ajax({
                type: "post",
                url: "calendar_action.php",
                data: { userid: userid },
                success: function (response) {
                  $('.viewdetails').html(response);
                  $("#AppointmentDetails").modal();
                }
              });
            },



            navLinks: true,
            businessHours: [
              {
                daysOfWeek: [1, 2, 3, 4, 5, 6],
                startTime: '09:00',
                endTime: '18:00'
              }
            ], // display business hours
            editable: true,
            selectable: true,
            droppable: false, //
          });

          calendar.render();

          var currColor = '#3c8dbc' //Red by default
          // Color chooser button
          $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            // Save color
            currColor = $(this).css('color')
            // Add color effect to button
            $('#add-new-event').css({
              'background-color': currColor,
              'border-color': currColor
            })
          })
          $('#add-new-event').click(function (e) {
            e.preventDefault()
            // Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
              return
            }

            // Create events
            var event = $('<div />');
            event.css({
              'background-color': currColor,
              'border-color': currColor,
              'color': '#fff'
            }).addClass('external-event')
            event.text(val)
            $('#external-events').prepend(event)

            // Add draggable funtionality
            ini_events(event)

            // Remove event from text input
            $('#new-event').val('')
          })
        })
      </script> -->
      <?php include('includes/footer.php'); ?>