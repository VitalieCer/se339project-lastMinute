$('.form').find('input').on('keyup blur focus', function (e) {

    var $this = $(this),
        label = $this.prev('label');

        if (e.type === 'keyup') {
            if ($this.val() === '') {
             label.removeClass('active highlight');
         } else {
            label.addClass('active highlight');
        }
     } else if (e.type === 'blur') {
         if( $this.val() === '' ) {
             label.removeClass('active highlight'); 
            } else {                
                label.removeClass('highlight');   
            }   
     } else if (e.type === 'focus') {

         if( $this.val() === '' ) {
                label.removeClass('highlight'); 
            } 
            else if( $this.val() !== '' ) {
                label.addClass('highlight');
            }
        }

    });

$('.form').find('textarea').on('keyup blur focus', function (e) {

    var $this = $(this),
        label = $this.prev('label');

        if (e.type === 'keyup') {
            if ($this.val() === '') {
             label.removeClass('active2 highlight');
         } else {
            label.addClass('active2 highlight');
        }
     } else if (e.type === 'blur') {
         if( $this.val() === '' ) {
             label.removeClass('active2 highlight'); 
            } else {                
                label.removeClass('highlight');   
            }   
     } else if (e.type === 'focus') {

         if( $this.val() === '' ) {
                label.removeClass('highlight'); 
            } 
            else if( $this.val() !== '' ) {
                label.addClass('highlight');
            }
        }

    });

$('.tab a').on('click', function (e) {
  
    e.preventDefault();

    $(this).parent().addClass('active');
    $(this).parent().siblings().removeClass('active');

    target = $(this).attr('href');

    $('.tab-content > div').not(target).hide();

    $(target).fadeIn(600);

});

/*$('.multi-field-wrapper').each(function() {
    var $wrapper = $('.multi-fields', this);
    $(".add-field", $(this)).click(function(e) {
        var obj = $('.multi-field:first-child', $wrapper).clone(true).appendTo($wrapper);
    });

    $('.multi-field .remove-field', $wrapper).click(function() {
        if ($('.multi-field', $wrapper).length > 1)
            $(this).parent('.multi-field').remove();
    });
});*/

$(document).ready(function() {
    var max_fields      = 10; 
    var wrapper         = $(".input_fields_wrap"); 
    var add_button      = $(".add_field_button");
    
    var counter = 1; 
    $(add_button).click(function(e){ 
        e.preventDefault();
        if(counter < max_fields){ 
            $(wrapper).append('<div><select class="button2" name="select'+counter+'"><option class="blank" value=""></option><option value="Algorithms" selected>Algorithms</option><option value="Mathematics" >Mathematics</option><option value="Functional Programming">Functional Programming</option><option value="Artificial Intelligence" >Artificial Intelligence</option><option value="cpp" >C++</option><option value="Python" >Python</option><option value="SQL" >SQL</option><option value="Distributed Systems">Distributed Systems</option><option value="Data Structures">Data Structures</option><option value="Java">Java</option><option value="Ruby">Ruby</option><option value="Databases">Databases</option><option value="Linux Shell">Linux Shell</option><option value="Security">Security</option></select><button type="button" class="remove_field button3">X</button></div>');
            counter++;
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault(); $(this).parent('div').remove();
    })
});
