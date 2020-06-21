function assignPlaces() {
    const attendances = $('.attendance-id');
    const multi_parts = $('#multi_parts').val();
    attendances.each(function() {
        const seat_number = $(this).attr('id').split('++')[0];
        const name = $(this).attr('id').split('++')[1];
        const surname = $(this).attr('id').split('++')[2];
        if(seat_number) {
            let map_seat = '';
            if(!multi_parts) {
                map_seat = $('#seat-map').find(`#${seat_number}`);
            } else {
                const parts_number = $('#multi_parts_number').val();
                let index = 0;
                map_seat = $('#seat-map-0').find(`#${seat_number}`);
                while (!map_seat.length && index < parts_number) {
                    index++;
                    map_seat = $(`#seat-map-${index}`).find(`#${seat_number}`);
                }
            }
            if(map_seat.length) {
                map_seat.html(`<b>${seat_number}</b> <br><span class="preview-name">${name} ${surname}</span>`);
                map_seat.on('mouseover', () => {
                    map_seat.css('backgroundColor', 'lightgrey');
                    $(this).css('backgroundColor', 'lightgrey');
                }).on('mouseleave', () => {
                    map_seat.css('backgroundColor', '#649a24');
                    $(this).css('backgroundColor', 'unset');
                });
                $(this).on('mouseover', () => {
                    map_seat.css('backgroundColor', 'lightgrey');
                    $(this).css('backgroundColor', 'lightgrey');
                }).on('mouseleave', () => {
                    map_seat.css('backgroundColor', '#649a24');
                    $(this).css('backgroundColor', 'unset');
                })
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
            if(unavailablePlaces.includes($(this).text().split(" ")[0]) && !$(this).parent().hasClass('seatCharts-legendItem')) {
                $(this).addClass('taken');}
        });
    }
}

function checkMap() {
    const $this = $('#map-carousel');
    if ($('.carousel-inner .item:first').hasClass('active')) {
        $this.children('.left.carousel-control').hide();
        $this.children('.right.carousel-control').show();
    } else if ($('.carousel-inner .item:last').hasClass('active')) {
        $this.children('.right.carousel-control').hide();
        $this.children('.left.carousel-control').show();
    } else {
        $this.children('.carousel-control').show();
    }
}

$(document).ready(function(){
    assignPlaces();
    checkForUnavailablePlaces();
    $('#map-carousel').on('slid.bs.carousel', checkMap);
});
