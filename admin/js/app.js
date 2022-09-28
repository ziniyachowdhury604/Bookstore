$('#ste').click(function() {
    $(this).siblings('input').removeAttr('name')
    $(this).siblings('input').removeAttr('required')
    $(this).siblings('input').removeAttr('value')
    $($($(this).parents('.col-md-6'))).toggleClass('d-none')
    $($($(this).parents('.col-md-6'))).siblings('.col-md-6').toggleClass('d-none')
    $($($(this).parents('.col-md-6'))).siblings('.col-md-6').find('input').attr('name', 'user_email')
    $($($(this).parents('.col-md-6'))).siblings('.col-md-6').find('input').attr('required', 'required')

})
$('#sti').click(function() {
    $(this).siblings('input').removeAttr('name')
    $(this).siblings('input').removeAttr('required')
    $(this).siblings('input').removeAttr('value')
    $($($(this).parents('.col-md-6'))).toggleClass('d-none')
    $($($(this).parents('.col-md-6'))).siblings('.col-md-6').toggleClass('d-none')
    $($($(this).parents('.col-md-6'))).siblings('.col-md-6').find('input').attr('name', 'user_id')
    $($($(this).parents('.col-md-6'))).siblings('.col-md-6').find('input').attr('required', 'required')
    
})