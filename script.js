$(document).ready(function() {

  // Először is, lekérjük az összes rendelést az adatbázisból és megjelenítjük őket.
  $.ajax({
    url: 'get_orders.php',
    type: 'get',
    success: function(response) {
      $('#order-list').html(response);
    }
  });

  // Az Új sorszám gomb lenyomásakor hozzáadunk egy új rendelést az adatbázishoz és megjelenítjük a listában.
  $('#new-order-btn').on('click', function() {
    $.ajax({
      url: 'add_order.php',
      type: 'post',
      success: function(response) {
        $('#order-list').append(response);
      }
    });
  });

  // Az Elkészült gomb lenyomásakor megváltoztatjuk a rendelés állapotát az adatbázisban és eltávolítjuk a listából.
  $(document).on('click', '.btn-done', function() {
    var id = $(this).attr('data-id');
    $.ajax({
      url: 'update_order.php',
      type: 'post',
      data: {
        id: id,
        done: 1
      },
      success: function(response) {
        $('#order-' + id).addClass('done');
      }
    });
  });

  // A Lezárás gomb lenyomásakor eltávolítjuk a rendelést a listából és áthelyezzük a closed_order adatbázis táblába.
  $(document).on('click', '.btn-close', function() {
    var id = $(this).attr('data-id');
    $.ajax({
      url: 'close_order.php',
      type: 'post',
      data: {
        id: id
      },
      success: function(response) {
        $('#order-' + id).remove();
      }
    });
  });

  // A Reset gomb lenyomásakor kiürítjük a closed_order adatbázis táblát.
  $('#reset-order').on('click', function() {
    $.ajax({
      url: 'reset_order.php',
      type: 'post',
      success: function(response) {
        $('#order-list').empty();
      }
    });
  });

});
