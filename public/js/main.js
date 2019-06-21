$(document).ready(function () {
  $('.wrapper-category').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1
  });
  $('.add_to_cart_form').submit(function () {
    var id = $(this).find('#product_id').text();
    var quantity = $(this).find('#cart_quantity').val();
    window.location.href = "cart/add_to_cart.php?id=" + id + "&quantity=" + quantity;
    return false;
  });
  function numberWithDots(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  }
  $('.update_quantity').change(function () {
    var elem = $(this);
    var id = $(this).closest('td').find('.product_id').text();
    var quantity = $(this).val();
    $.post("update_cart.php", {'id': id, 'quantity' : quantity} ,
      function (data, textStatus, jqXHR) {
        r=JSON.parse(data);
        elem.closest('tr').find('.totalcost').text(numberWithDots(r.pcost));
        $('#totalquantity').text(r.tquantity);
        $('#totalprice').text(numberWithDots(r.tcost));
      },
      "text"
    );
  });
  $('#btnBuy').click(function (e) { 
    e.preventDefault();
    window.location.href = "checkout.php";
  });
  $('#btnXem').click(function (e) { 
    e.preventDefault();
    var userID =$('#userID').text();
    window.location.href = "user_product.php?uid=" + userID;
  });
});