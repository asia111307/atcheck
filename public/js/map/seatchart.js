$(document).ready(function() {

    function createMap(seats_rows, seats_container) {
        var $cart = $('#selected-seats');
        var seat_selected = false;

        seats_container.seatCharts({
            map: seats_rows,
            naming: {
                rows: ['', '', '', ''],
                top: false,
                left: false,
            },
            legend: {
                node: $('#legend'),
                items: [
                    ['c', 'available', 'Dostępne miejsce'],
                    ['f', 'unavailable', 'Zajęte miejsce']
                ]
            },
            click: function () {
                if (this.status() === 'available' && !seat_selected) {
                    // var's create a new <li> which we'll add to the cart items
                    $('<span> ' + this.settings.label + ' <a href="#" class="cancel-cart-item">[x]</a></span>')
                        .attr('id', 'cart-item-' + this.settings.id)
                        .data('seatId', this.settings.id)
                        .appendTo($cart);
                    seat_selected = true;
                    return 'selected';
                } else if (this.status() === 'selected') {
                    //remove the item from our cart and make this seat available
                    $('#cart-item-' + this.settings.id).remove();
                    $('#item-' + this.settings.id).remove();
                    seat_selected = false;
                    return 'available';
                } else if (this.status() === 'unavailable') {
                    return 'unavailable';
                } else {
                    return this.style();
                }
            }
        });

        $('#selected-seats').on('click', '.cancel-cart-item', function () {
            const id = $(this).parent().data('seatId');
            $('#seat-map').find(`#${id}`).click();
        });
    }

    function createMultiPartsMap(parts_number, seat_map) {
        var $cart = $('#selected-seats');
        var seat_selected = false;

        // divide all rows into carousel slides
        var parts_elements = [];  // slides elements
        var parts_rows = []; // sets of rows for slides
        const per_page = 4; // max number of rows on one slide
        var first_index = 0;
        var last_index = 4;

        for(var i=0; i<parts_number; i++) {
            parts_elements[i] = $(`#seat-map-${i}`);
            if(seat_map[first_index] === '_') {
                seat_map.splice(first_index, 1) // remove unnecessary first row of every set if it's blank
            }
            parts_rows[i] = seat_map.slice(first_index, last_index);
            first_index = last_index;
            last_index = last_index + per_page;
        }

        const last_rows = parts_rows[parts_rows.length-1]; // the last set of rows

        // check if the last slide does not contains only blank rows
        if((last_rows.length === 1 && last_rows[0] === '_' ) || last_rows.length === 0){ // if there are no rows on the last slide or if the only row is blank
            const row_index = parts_rows.indexOf(last_rows);
            if (row_index > -1) {
                parts_elements[row_index].parent().remove(); // remove unnecessary slide from node
                parts_rows.splice(row_index, 1); // remove unnecessary rows from list
                parts_elements.splice(row_index, 1); // remove unnecessary slide from list
            }
        } else if(last_rows.length < 4) { // fill the last slide to 4 rows
            const diff = 4 - last_rows.length;
            for(var i=0; i<diff; i++) {
                last_rows.push('_');
            }
        }

        // execute seatchart function for the first slide manually to have the legend
        parts_elements[0].seatCharts({
            map: parts_rows[0],
            naming: {
                rows: ['', '', '', ''],
                top: false,
                left: false,
            },
            legend: {
                node: $('#legend'),
                items: [
                    ['c', 'available', 'Dostępne miejsce'],
                    ['f', 'unavailable', 'Zajęte miejsce']
                ]
            },
            click: function () {
                if (this.status() === 'available' && !seat_selected) {
                    // //var's create a new <li> which we'll add to the cart items
                    $('<span> ' + this.settings.label + ' <a href="#" class="cancel-cart-item">[x]</a></span>')
                        .attr('id', 'cart-item-' + this.settings.id)
                        .data('seatId', this.settings.id)
                        .appendTo($cart);
                    seat_selected = true;
                    return 'selected';
                } else if (this.status() === 'selected') {
                    // //remove the item from our cart
                    $('#cart-item-' + this.settings.id).remove();
                    $('#item-' + this.settings.id).remove();
                    seat_selected = false;
                    return 'available';
                } else if (this.status() === 'unavailable') {
                    return 'unavailable';
                } else {
                    return this.style();
                }
            }
        });

        // execute seatchart function for the rest slides
        var final_parts_number = Math.ceil(seat_map.length / 4);
        for(var i = 1; i < final_parts_number; i++) {
            parts_elements[i].seatCharts({
                map: parts_rows[i],
                naming: {
                    rows: ['', '', '', ''],
                    top: false,
                    left: false,
                },
                click: function () {
                    if (this.status() === 'available' && !seat_selected) {
                        // //var's create a new <li> which we'll add to the cart items
                        $('<span> ' + this.settings.label + ' <a href="#" class="cancel-cart-item">[x]</a></span>')
                            .attr('id', 'cart-item-' + this.settings.id)
                            .data('seatId', this.settings.id)
                            .appendTo($cart);
                        seat_selected = true;
                        return 'selected';
                    } else if (this.status() === 'selected') {
                        // //remove the item from our cart
                        $('#cart-item-' + this.settings.id).remove();
                        $('#item-' + this.settings.id).remove();
                        seat_selected = false;
                        return 'available';
                    } else if (this.status() === 'unavailable') {
                        return 'unavailable';
                    } else {
                        return this.style();
                    }
                }

            });
        }

        $('#selected-seats').on('click', '.cancel-cart-item', function () {
            const id = $(this).parent().data('seatId');
            $('#multi_parts-map').find(`#${id}`).click();
        });
    }

    const seat_map = $('#room_arrangement').val().split('++');
    if (seat_map.length > 4) {
        const parts_number = $('#multi_parts_number').val();
        createMultiPartsMap(parts_number, seat_map)

    } else {
        const seats_container = $('#seat-map');
        createMap(seat_map, seats_container);
    }
});

