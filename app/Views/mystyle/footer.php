</div>
</div>

<!-- Jquery Core Js -->
<script src="<?= base_url() ?>mystyle/assets/bundles/libscripts.bundle.js" defer></script>

<!-- Plugin Js -->
<script src="<?= base_url() ?>mystyle/assets/bundles/apexcharts.bundle.js" defer></script>
<script src="<?= base_url() ?>mystyle/assets/bundles/dataTables.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Jquery Page Js -->
<script src="<?= base_url() ?>mystyle/js/template.js"></script>
<script src="<?= base_url() ?>mystyle/js/page/index.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?= base_url() ?>mystyle/js/sampslider.js"></script>
<script src="<?= base_url() ?>owl-carousel/owl.carousel.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>


<script>
    $('#myDataTable')
        .addClass('nowrap')
        .dataTable({
            responsive: true,
            columnDefs: [{
                targets: [-1, -3],
                className: 'dt-body-left'
            }],
            dom: 'Bfrtip',
            buttons: [{
                extend: 'copyHtml5',
                footer: true
            }, {
                extend: 'excelHtml5',
                footer: true
            }, {
                extend: 'csvHtml5',
                footer: true
            }, {
                extend: 'pdfHtml5',
                footer: true,
            }],
            ordering: false,
        });
    $('.deleterow').on('click', function() {
        var tablename = $(this).closest('table').DataTable();
        tablename
            .row($(this)
                .parents('tr'))
            .remove()
            .draw();

    });


    $(document).ready(function() {

        $(".owl-carousel").owlCarousel();

    });


    hljs.initHighlightingOnLoad();

    $('.hero__scroll').on('click', function(e) {
        $('html, body').animate({
            scrollTop: $(window).height()
        }, 1200);
    });
</script>
</body>

</html>