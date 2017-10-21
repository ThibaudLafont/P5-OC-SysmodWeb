function scrollToForm(id) {
    if($('.form_error').length !=0 || $('.form_success').length != 0){
        var height = $(id).offset().top;
        console.log('coucou');
        $('html').scrollTop(height);
    }
}