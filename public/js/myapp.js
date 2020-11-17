
$(function (){
    /*Enabel tooltip bootstrap*/
    $('[data-toggle="tooltip"]').tooltip();

    /**Easy select plugin*/
    $("select").easySelect({
        buttons: false,
        search: false,
        placeholderColor: '#6c757d',
        selectColor: '#495057',
        showEachItem: true,
        width: '100%',
        dropdownMaxHeight: '450px',
    })

    /*Handle open/close rightbar and sidebar */
    $('#toggle-sidebar').on('click',function(){
        $('#sidebar').toggleClass('hide-show-sidebar');
        $('#dropdown-user-992px').removeClass('hide-show-dropdown-navbar');
    })
    
    $('#toggle-navbar').on('click',function(){
        $('#dropdown-user-992px').toggleClass('hide-show-dropdown-navbar');
        $('#sidebar').removeClass('hide-show-sidebar');
    })

    $('.toggle-rightbar').on('click', function(){
        $('#rightbar_container').toggleClass('hide_rightbar');
    })

    
    //var activate_portfolio = $("input[type=checkbox]");
    $('.activate_portfolio').on('click', function(){
        var main = $( this ).parents( "main" );
    if($(this).prop('checked')==false){ 
      main.addClass('inactive_portfolio');
      $(this).next('label').html('Inactive');
    }else{
        main.removeClass('inactive_portfolio');
        $(this).next('label').html('Active');
    }
})


})

