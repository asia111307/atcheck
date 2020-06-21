function savePlaceNumber() {
    var selected = $('.selected');
    if(selected.length) {
        var selected_id = $('.selected')[0].innerText;
        const seat_number_input = $('.seat_number')[0];
        seat_number_input.value = selected_id;
    }
}

function toggleButtonAvailability() {
    const buttons = $('.checkout-button');
    const selected_place = $('.selected')[0];
    buttons.each(function(e) {
      if(!$(this).hasClass('end-button')) {
          if(!selected_place){
              $(this).css('pointer-events', 'none');
              $(this).css('cursor', 'unset');

          } else {
              $(this).css('pointer-events', 'unset');
              $(this).css('cursor', 'pointer');
          }
      }
    })

}

function checkForUnavailablePlaces() {
    const unavailablePlaces = Array();
    $('.unavailable_place').each(function(){
        unavailablePlaces.push($(this).val());
    });

    const allPlaces = $('.seatCharts-seat.seatCharts-cell.available');
     if(unavailablePlaces){
         allPlaces.each(function(){
             if(unavailablePlaces.includes($(this).text()) && !$(this).parent().hasClass('seatCharts-legendItem')) {
                 $(this).addClass('unavailable');
                 $(this).css('pointer-events', 'none');
             }
         });
     }
}

$(document).ready(function(){
    $('.seatCharts-seat').on('click', function(){
        toggleButtonAvailability();
        savePlaceNumber();
    });
    var mode = $('#mode').val();
    if(mode === 'test') {
        var random_seat = $('#random_seat').val();
        var allPlaces = $('.seatCharts-seat.seatCharts-cell');
        var allSlides = $('.carousel-item');
        var seat;
        allPlaces.each(function(){
            if($(this).text() === random_seat) {
                $(this).click();
                seat = $(this);
            }
            $(this).css('pointer-events', 'none');
            $('.cancel-cart-item').remove();
        });
        allSlides.each(function() {
            if($.contains($(this).get(0), $(seat).get(0))) {
                $('#map-carousel').carousel($(this).index()-1);
            }
        });
        setTimeout(function() {
            $('#test-end-btn').click();
        }, 7000);
    } else {
        checkForUnavailablePlaces();
        toggleButtonAvailability();
    }
});
