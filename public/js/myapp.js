
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

    var activate_portfolio = $("#activate_portfolio");
    activate_portfolio.on('click', function(){
    if(activate_portfolio.prop('checked')==false){ 
       $('.portfolio_container, .portfolio_info').addClass('inactive_portfolio');
       activate_portfolio.next('label').html('Inactive');
    }else{
        $('.portfolio_container, .portfolio_info').removeClass('inactive_portfolio');
        activate_portfolio.next('label').html('Active');
    }
})


})

