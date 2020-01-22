<!--main content start-->
<style>
  .label { font-size:120%; }
</style>
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <div class="row">
                <aside class="col-md-12"><a href="<?php echo base64_decode($this->input->get('source_url')) ?>"><button class="btn btn-white btn-xs">&laquo; Back to users</button></a></aside>
                <br>
                <br>
              </div>
              <div class="row">
                  <aside class="col-lg-3">
                      <h4 class="drg-event-title">Classes</h4>
                      <div id='external-events'>
                        <?php foreach ($activities as $value): ?>
                          <div class='external-event label' style='background: <?php echo $value->color ?>; cursor: default;'><?php echo $value->name ?></div> 
                        <?php endforeach ?>
                      </div>
                      <br>
                      <h4 class="drg-event-title">Moods</h4>
                      <div id='external-events'>
                          <div class='external-event label' style='background: #faea76; cursor: default;'>5 - 😄</div> 
                          <div class='external-event label' style='background: #faea76; cursor: default;'>4 - 😃</div> 
                          <div class='external-event label' style='background: #faea76; cursor: default;'>3 - 🙂</div> 
                          <div class='external-event label' style='background: #faea76; cursor: default;'>2 - 😐</div> 
                          <div class='external-event label' style='background: #faea76; cursor: default;'>1 - 🙁</div> 
                      </div>
                  </aside>
                  <aside class="col-lg-9">
                      <section class="panel">
                          <div class="panel-body">
                              <div id="calendar" class="has-toolbar"></div>
                          </div>
                      </section>
                  </aside>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->

      <script>
      $(document).ready(function() {
          
            var Script = function () {

            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                eventRender: function(info, el) {
                  el.tooltip({title: info.description, placement: 'top',
                    trigger: 'hover',
                    container: 'body'})
                },
                events: [
                  <?php $numItems = count($attendance); $i = 0; foreach($attendance as $value): ?>
                    {
                        title: '<?php echo $value->attendee_name ?>\n<?php echo $value->mood ?>',
                        start: new Date(<?php echo (int)$value->y ?>, <?php echo (int)$value->m ?>, <?php echo (int)$value->d ?>),
                        color: '<?php echo $value->activity_color ?> !important',
                        description: '<?php echo $value->comment ?>'
                    }
                    <?php 
                    if(++$i === $numItems) { 
                      //
                    } 
                    else {
                     echo ','; 
                    } # if not last item put comma?>
                  <?php endforeach; ?>
                ]
            });


         }();
      });

      </script>