
$(document).ready(function () {
    $('#s_time').datetimepicker({
        format: 'hh:mm A'
    });
    $('#e_time').datetimepicker({
        format: 'hh:mm A'
    });
    $('#gendeleteModal').on('shown.bs.modal', function (e) {
        $('.gendeleteConfirm').click((event)=>{
            let url = $(e.relatedTarget).attr('target');
            $.ajax({
                method: 'DELETE',
                url: url,
                success: function (result) {
                    console.log(result);
                    if (result.success) {
                        window.location.reload();
                    } else {
                        alert('Internal Server Error');
                    }
                },
            });
        });
    });

    $('#add_time_slot').on('submit', (e) => {
        e.preventDefault();
        let data = $(e.target).serialize();
        let url = $(e.target).attr('action');
        $.ajax({
            method: 'POST',
            url: url,
            data: data,
            success: function (result) {
		console.log(result.success);
		    if(result.success === true){
		    $('#snackbar').addClass('show');
                   setTimeout(function () {
                        $('#snackbar').removeClass('show');
                    }, 2000);
		}else if(result.success === 'duplicate') {
		alert("Record Exist with same data");
		}
                
            },
        });


    });
    $("#invoice_link").on('keypress',(e)=>{
        let url = $("#invoice_link").val();
        let phone = $("#invoice_whatsapp_link").attr('phone');
        let link = "https://api.whatsapp.com/send/?phone=+"+phone+"&text="+url;
        $('#invoice_whatsapp_link').attr('href',link);
    });
    $("#mobile").intlTelInput({
	    allowDropdown:true,
	    preferredCountries: ["kw"],
    });
});
