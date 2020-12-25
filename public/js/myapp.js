
$(function (){
    tinymce.init({
        selector:'textarea#mytext',
        placeholder: 'Write description, or type somethin important about this strategy',
        branding: false,
        height: 248,
        min_height: 150,
        max_height: 350,
        menubar: 'edit format table tools',
        lineheight_formats: '0.5',
        toolbar_mode: 'floating',
        plugins: 'lists',
        toolbar: 'numlist bullist | undo redo | styleselect | bold italic | alignleft aligncenter alignright',
    
    });


    /*Enabel tooltip bootstrap*/
    $('[data-toggle="tooltip"]').tooltip();

    /**Easy select plugin*/
    $(".easySelect").easySelect({
        buttons: false,
        search: false,
        placeholderColor: '#6c757d',
        selectColor: '#495057',
        showEachItem: true,
        width: '100%',
        dropdownMaxHeight: '255px',
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
        $('#rightbar_container').toggleClass('toggle-container');
        $('#cover').toggleClass('backdrop-class');
    })

    $('.close-trade-deteils').on('click', function(){
        $('#trade_deteils').toggleClass('toggle-container');
        $('#cover').toggleClass('backdrop-class');
    })


    //Trade History switch view 
    $('#choose-table-view').on('click',function(){
        $('#table-view').show();
        $('#large-row-view').hide();
    })
    $('#choose-largerow-view').on('click',function(){
        $('#table-view').hide();
        $('#large-row-view').show();
    })

})

/* img slide  */

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = $(".selected-img > img");
  var img = $(".thumbnails-img > img");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < img.length; i++) {
    img[i].className = img[i].className.replace("active-img", "");
}
    if(img[slideIndex-1] != undefined){
    img[slideIndex-1].className += "active-img";
    slides[slideIndex-1].style.display = "block";
}
}

$(function (){
    var id;
    $(document).on('click', '.delete-item', function() {
        var id = (this.id);
        $("#modal_delete").attr('data-id', id);
        $('#modal_delete').modal('show');
        
        $("#btn-delete").on('click',function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            });
            $.ajax({
                type:'GET',
                url:"portfolio/d/"+id,
                success: function() {
                    $('#modal_delete').modal('hide');
                }
            })
        })
    });
})