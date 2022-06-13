
<!-- JQuery -->
<script type="text/javascript" src="<?php echo base_url()?>assets/dashboards/js/jquery-3.4.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="<?php echo base_url()?>assets/dashboards/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="<?php echo base_url()?>assets/dashboards/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="<?php echo base_url()?>assets/dashboards/js/mdb.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/dashboards/js/addons/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/dashboards/js/addons/datatables-select.min.js"></script>
<!-- Initializations -->
<script type="text/javascript">
    // Animations initialization
    new WOW().init();

</script>
<script type="text/javascript">
    //Datatable config
    $('#dt-material-checkbox').dataTable({
        "scrollY": true,
        "scrollX": true,
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0
        }],
        select: {
            style: 'os',
            selector: 'td:first-child'
        }
    });

</script>



<script>
    $(document).ready(function(){
        $('.add_cart').click(function(){
            var product_id= $(this).data("productid");
            var product_name= $(this).data("productname");

            var product_unitprice= $(this).data("price");//Prix unitaire
            var product_price_buy = $(this).data("product_price_buy");//Prix d'achat 
            var quantity = $('#' + product_id).val();
            var product_price = $('#sales_price' + product_id).val(); //Prix de vente

            if(quantity != '' && quantity > 0 && product_price !='' && product_price > 0)
            {
                $.ajax({
                        url:"<?php echo base_url();?>shopping_cart/add",
                        method:"POST",
                        data:{product_id:product_id, product_name:product_name, product_price:product_price, quantity:quantity, product_unitprice:product_unitprice, product_price_buy:product_price_buy},
                        success:function (data) {
                            alert("Article ajouté à la facture");
                            $('#cart_details').html(data);
                            $('#' + product_id).val('');
                            $('#sales_price' + product_id).val('');
                        }
                    });
            }
            else {
                alert("Saisissez la quantité ou le prix de vente svp !");
            }
        });

        $('#cart_details').load("<?php echo base_url();?>shopping_cart/load");

        //Suppression
        $(document).on('click', '.remove_inventory', function(){
            var row_id = $(this).attr("id");
            if(confirm("Etes-vous sûr de retirer cet article de votre facture ?"))
            {
              $.ajax({

                url:"<?php echo base_url();?>shopping_cart/remove",
                method:"POST",
                data:{row_id:row_id},
                success:function(data)
                {
                  alert("Article retiré de la facture");
                  $('#cart_details').html(data);
                }

              });

            }else{
              return false;
            }
        });

        $(document).on('click', '#clear_cart', function(){
          if(confirm("Etes-vous sûr de vider la facture ?"))
          {
            $.ajax({
              url:"<?php echo base_url();?>shopping_cart/clear",
              success:function(data)
                {
                  alert("Votre facture a été vidé avec succès .");
                  $('#cart_details').html(data);
                }
            });
          }
          else{
            return false;
          }
        });
    });
</script>

</body>

</html>