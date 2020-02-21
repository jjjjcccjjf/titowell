$(document).ready(function() {
  //Updating
  $('.edit-row').on('click', function(){
    $('form')[0].reset() // reset the form
    const payload = $(this).data('payload')

    $('input[name=name]').removeAttr('required')
    $('input[name=name]').val(payload.name)

    $('input[name=email]').removeAttr('required')
    $('input[name=email]').val(payload.email)
    
    $('input[name=password]').removeAttr('required')
    $('input[name=password]').val(payload.password)    

    $('input[id=confirm_password]').removeAttr('required')
    $('input[id=confirm_password]').val(payload.confirm_password)

    $('form').attr('action', base_url + 'cms/dashboard/update/' + payload.id)
    $('.modal').modal()
  })

  // Adding
  $('.add-btn').on('click', function() {
    $('form')[0].reset() // reset the form

    $('input[name=name]').attr('required', 'required') 
    $('input[name=email]').attr('required', 'required') 
    $('input[name=password]').attr('required', 'required') 
    $('input[id=confirm_password]').attr('required', 'required') 

    $('form').attr('action', base_url + 'cms/dashboard/add')
    $('.modal').modal()
  })

  //Deleting
  $('.btn-delete').on('click', function(){

    if (confirm("Are you sure you want to delete this?")) {
      const id = $(this).data('id')

      invokeForm(base_url + 'cms/dashboard/delete', {id: id});
    }
  })

  $('#admin_form').on('submit', function(event) {
    if ($('input[id=confirm_password]').val() == $('input[name=password]').val()) {
      return true;
    } else {
      event.preventDefault();
      alert('Password mismatch')
    }
  });


})
