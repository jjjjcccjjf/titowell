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
      $('.edit-modal').modal()
    })
  
    // Adding
    $('.add-btn').on('click', function() {
      $('form')[0].reset() // reset the form
  
      $('input[name=name]').attr('required', 'required')
      $('input[name=email]').attr("required", 'required')
      $('input[name=password]').attr("required", 'required')
      $('input[id=confirm_password]').attr("required", 'required')
  
      $('form').attr('action', base_url + 'cms/users/add')
      $('.edit-modal').modal()
    })  
    
    //BMI
    $('.btn-bmi').on('click', function() {

      let bmi = $(this).data('payload')
      let namey = $(this).data('namey')

      $('#bmi-name').empty().html(namey)
      $('#bmi-label').empty().html(bmi.label)
      $('#bmi-min').empty().html(bmi.min_bmi)
      $('#bmi-max').empty().html(bmi.max_bmi)
      $('#bmi-description').empty().html(bmi.description)
      $('#bmi-notes').empty().html(bmi.notes_health_risks)
  
      $('.bmi-modal').modal()
    })

    //TITO
    $('.btn-tito').on('click', function(){ 
        $('.tito-modal tbody').empty(); //initialize tbody

        let stringy = '';
        let payload = $(this).data('payload')

        for(let i = 0; i < payload.length; i++) {
          stringy += `<tr>`
          stringy += `<td>`+payload[i].datetime_f+`</td>`
          stringy += `<td>`+payload[i].weight_in_pounds_f+`</td>`
          stringy += `<td>`+payload[i].datetime_day_f+`</td>`
          stringy += `<td>`+payload[i].type_f+`</td>`
          stringy += `</tr>`
        }

        $('.modal tbody').html(stringy)
        $('.tito-modal').modal()
    })

    //Pedometer
    $('.btn-pedometer').on('click', function(){ 
        $('.pedometer-modal tbody').empty(); //initialize tbody

        let stringy = '';
        let payload = $(this).data('payload')

        for(let i = 0; i < payload.length; i++) {
          stringy += `<tr>`
          stringy += `<td>`+payload[i].datetime_f+`</td>`
          stringy += `<td>`+payload[i].step_count+`</td>`
          stringy += `</tr>`
        }

        $('.modal tbody').html(stringy)
        $('.pedometer-modal').modal()
    })

    //Wellness program
    $('.btn-wellness-program').on('click', function(){ 
        $('.wellness-program-modal tbody').empty(); //initialize tbody

        let stringy = '';
        let payload = $(this).data('payload')

        for(let i = 0; i < payload.length; i++) {
          stringy += `<tr>`
          stringy += `<td>`+payload[i].activity_name+`</td>`
          stringy += `<td>`+payload[i].datetime_f+`</td>`
          stringy += `<td>`+payload[i].datetime_day_f+`</td>`
          stringy += `<td>`+payload[i].mood+`</td>`
          stringy += `<td>`+payload[i].comment+`</td>`
          stringy += `</tr>`
        }

        $('.modal tbody').html(stringy)
        $('.wellness-program-modal').modal()
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