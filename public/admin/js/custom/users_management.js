$(document).ready(function() {


	$('.edit-row').on('click', function(){
      $('form')[0].reset() // reset the form
      const payload = $(this).data('payload')
  
      $('input[name=fname]').removeAttr('required')
      $('input[name=lname]').removeAttr('required')
      $('input[name=pin]').removeAttr('required')
      $('input[name=birth_date]').removeAttr('required')
      $('input[name=height_in_feet]').removeAttr('required')
      $('input[name=height_in_inches]').removeAttr('required')
      $('input[name=initial_weight_in_pounds]').removeAttr('required')
  
      $('input[name=fname]').val(payload.fname)
      $('input[name=lname]').val(payload.lname)
      $('input[name=pin]').val(payload.pin)
      $('input[name=birth_date]').val(payload.birth_date)
      $('input[name=height_in_feet]').val(payload.height_in_feet)
      $('input[name=height_in_inches]').val(payload.height_in_inches)
      $('input[name=initial_weight_in_pounds]').val(payload.initial_weight_in_pounds)
      
      $('#profile_pic_modal_image').attr('src', payload.profile_pic_path)

      $('form').attr('action', base_url + 'cms/users/update/' + payload.id)
      $('.modal').modal()
    })
  
    // Adding
    $('.add-btn').on('click', function() {
      $('form')[0].reset() // reset the form
  
      $('input[name=name]').attr('required', 'required')
      $('input[name=email]').attr("required", 'required')
      $('input[name=password]').attr("required", 'required')
      $('input[id=confirm_password]').attr("required", 'required')
  
      $('form').attr('action', base_url + 'cms/users/add')
      $('.modal').modal()
    })
  
    //Deleting
    $('.btn-delete').on('click', function(){
      if (confirm("Are you sure you want to delete this?")) {
        const id = $(this).data('id')
        invokeForm(base_url + 'cms/users/delete', {id: id});
      }
  
    })


	$('.view-pin').on('mouseup mousedown', function(e){
	   if (e.type=="mousedown") {
	   		$(this).prev().text($(this).data('pin'))
	   } else if (e.type=='mouseup') {
	   		$(this).prev().text('********')
	   }
	})
	
})