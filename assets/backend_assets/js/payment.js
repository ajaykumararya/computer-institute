$(document).ready(function () {


	$('#debtor_voucher_payment_list').DataTable({
		dom: 'Bfrtip,l',
		pageLength: '1000',
		"lengthMenu": [[10, 25, 50, 100, 1000, 2000, 5000], [10, 25, 50, 100, 1000, 2000, 5000]],
		buttons: [
			'excel', 'pdf', 'print'
		],
		"processing": true,
		"serverSide": true,
		"footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
             
            api.columns('.sum', { page: 'current'}).every( function () {
              var sum = this
                .data()
                .reduce( function (a, b) {
                    a=remove_comma(a);
                    b=remove_comma(b);
                    return intVal(a) + intVal(b);
                }, 0 );
              
              this.footer().innerHTML = format_indian_number(parseFloat(sum).toFixed(2));
            } );
        },
		"ajax": {
			"url": get_loc + "debtor_voucher_payment_list",
			"dataType": "json",
			"type": "POST",
			"data": { crsftoken: crsfharsh,filteroption:$('.cust_filter').val() }
		},
		"columns": [
			{
                "className":      'details-control',
                "orderable":      false,
                "data":           "OPEN",
                "defaultContent": ''
            },
			{ "data": "SR_NO" },
			{ "data": "PAYMENT_DATE" },
			{ "data": "FIRM_NAME" },
            { "data": "HRM_NAME" },
			{ "data": "PAYMENT_MODE" },
			{ "data": "PAYMENT_TYPE" },
			{ "data": "VOUCHER_AMOUNT" },
            { "data": "VOUCHER_DESC" },
			{ "data": "ACTION" },

		],
		"order": [[1, 'asc']]
	});








});