$(function () {
    $('#daily-sales').hide();
    $('#monthly-sales').hide();
    $('#customer-sales').hide();

    $('#report_name').select2({
        theme: "classic",
        placeholder: "Select report type",
        allowClear: true,
        width: '40%'
    });

    $('#customer_list').select2({
        theme: "classic",
        placeholder: "Select customer",
        allowClear: true,
        width: '100%'
    });

    $( "#fromdatepicker" ).datepicker();
    $( "#fromdatepicker" ).datepicker( "setDate", new Date() );

    $( "#todatepicker" ).datepicker();
    $( "#todatepicker" ).datepicker( "setDate", new Date() );


    $('#report_name').append("<option value='1'>Daily Sales </option>");
    $('#report_name').append("<option value='2'>Monthly Sales </option>");
    $('#report_name').append("<option value='3'>Customer Sales </option>");

    $('#report_name').on('change', function() {
        
        if ( this.value == 1 ) { // Daily Sales.
            $('#daily-sales').show();
            $('#monthly-sales').hide();
            $('#customer-sales').hide();
        } else if ( this.value == 2 ) { // Monthly Sales.
            $('#daily-sales').hide();
            $('#monthly-sales').show();
            $('#customer-sales').hide();
        } else if ( this.value == 3 ) { // Customer Sales.

            $('#daily-sales').hide();
            $('#monthly-sales').hide();
            $('#customer-sales').show();
            
            get_customers();
        } else {
            $('#daily-sales').hide();
            $('#monthly-sales').hide();
            $('#customer-sales').hide();
        }
    });

    $('#daily-sales-button').click(function(){
        get_customers_sales( 2, -1 ); 
    });

    $('#monthly-sales-button').click(function(){
        get_customers_sales( 3, -1 ); 
    });

    $('#customer-sales-button').click(function(){
        var customerId = $('#customer_list').val();
        if ( customerId == '' ) {
            alert( 'Select customer:' );
        } else {
            get_customers_sales( 1 ,customerId );    
        }
    });

    /**
     * 
     * @param {*} customerId 
     */
    function get_customers_sales( typeId, customerId ) {
        if ( typeId == 1 || typeId == 2 ) {
            $.ajax({
                url: customer_url + '/' + typeId + '/' + customerId,
                type: 'GET',
                data: {}
            }).done(function (data) {
                console.log( data );
            });
        } else if ( typeId == 3 ) {
            var fromDate = $('#fromdatepicker').val();
            var toDate = $('#todatepicker').val();
            $.ajax({
                url: customer_url + '/sales',
                type: 'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    "fromDate": fromDate,
                    "toDate": toDate,
                    "typeId": typeId
                }
            }).done(function (data) {
                console.log( data );
            });
        }
        
    }

    function get_customers() {
        $.ajax({
            url: customer_url,
            type: 'GET',
            data: {}
        }).done(function (data) {
            for ( var i = 0 ; i < data.data.length ; i++ ) {
                $('#customer_list').append("<option value=" +  data.data[i].id + ">" + data.data[i].name + "</option>");
            };
        });
    }

}); 
