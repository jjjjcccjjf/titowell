$(document).ready(function() {


	$('.edit-row').on('click', function(){
      $('form')[0].reset() // reset the form
      const payload = $(this).data('payload')
  
      $('input[name=label]').removeAttr('required')
      $('textarea[name=description]').removeAttr('required')
      $('textarea[name=notes_health_risks]').removeAttr('required')
      $('input[name=min_bmi]').removeAttr('required')
      $('input[name=max_bmi]').removeAttr('required')
  
      $('input[name=label]').val(payload.label)
      $('textarea[name=description]').val(payload.description)
      $('textarea[name=notes_health_risks]').val(payload.notes_health_risks)
      $('input[name=min_bmi]').val(payload.min_bmi)
      $('input[name=max_bmi]').val(payload.max_bmi)
      
      $('form').attr('action', base_url + 'cms/bmi_info/update/' + payload.id)
      $('.modal').modal()
    })
	
})