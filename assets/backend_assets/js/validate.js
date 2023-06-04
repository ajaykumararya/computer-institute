$(document).ready(function () {
    $("#login").validate({
        rules: {
            "login_type": {
                required: true,
            },
            "user_id": {
                required: true,
            },
            "password": {
                required: true,
            }
        },

        submitHandler: function (form) { // for demo
            $('#checked').val('1');
        }
    });
    $("#edit_member").validate({
        rules: {
            "firstname": {
                required: true,
            },
            "regdate": {
                required: true,
            },
            "block": {
                required: true,
            },
            "state": {
                required: true,
            },
            "city": {
                required: true,
            },
             "contact": {
                required: true,
            },
        },

        submitHandler: function (form) { // for demo
            $('#checked').val('1');
        }
    });
    /* add Firm validation*/
    $("#addfirm").validate({
        rules: {
            "firmname": {
                required: true,
            },
            "state": {
                required: true,
            },
            "city": {
                required: true,
            },
            "user": {
                required: true,
            },
            "password": {
                required: true,
            },
        },

        submitHandler: function (form) { // for demo
            $('#checked').val('1');
        }
    });
    /* add Branch validation*/
    $("#addbranch").validate({
        rules: {
            'firmname': {
                required: true,
            },
            'branch_name': {
                required: true,
            },
            'prefix': {
                required: true,
            },
            'state': {
                required: true,
            },
            'city': {
                required: true,
            },
            'contact': {
                required: true,
            },
            'reg_date': {
                required: true,
            },
            'user': {
                required: true,
            },
        },
        submitHandler: function (form) { // for demo
            $('#check').val('1');
        }
    });
    /* edit Branch validation*/
    $("#editbranch").validate({
        rules: {
            'firmname': {
                required: true,
            },
            'branch_name': {
                required: true,
            },
            'prefix': {
                required: true,
            },
            'state': {
                required: true,
            },
            'city': {
                required: true,
            },
            'contact': {
                required: true,
            },
            'reg_date': {
                required: true,
            },
            'user': {
                required: true,
            },
            'password': {
                required: true,
            }
        },
        submitHandler: function (form) { // for demo
            $('#check').val('1');
        }
    });
    /* change Branch password validation*/
    $("#change_branch_password").validate({
        rules: {
            'newpass': {
                required: true,
            },
            'oldpass': {
                required: true,
            }
        },
        submitHandler: function (form) { // for demo
            $('.formchecked').val('1');
        }
    });
    /* add advisor validation*/
    $("#add_advisor").validate({
        rules: {
            'user': {
                required: true,
            },
            
            
        },
        submitHandler: function (form) { // for demo
            $('#formchecked').val('1');
        }
    });
    /* add member validation*/
    $("#add_member").validate({
        rules: {
            'user': {
                required: true,
            },
                    
        },
        submitHandler: function (form) { // for demo
            $('#formchecked').val('1');
        }
    });
     /* Resize Site Size validation*/
     $("#resize_site_size").validate({
        rules: {
            'site_size': {
                required: true,
            },
                    
        },
        submitHandler: function (form) { // for demo
            $('#checked_resize_site_form').val('1');
        }
    });
     /* Resize Part Size validation*/
     $("#resize_part_size").validate({
        rules: {
            'new_part_size': {
                required: true,
            },
                    
        },
        submitHandler: function (form) { // for demo
            $('#checked_resize_part_form').val('1');
        }
    });
      /* add exist member validation*/
      $("#add_exist_member").validate({
        rules: {
            'existmembername': {
                required: true,
            },
            'existsponsername': {
                required: true,
            },
            'existbranchname': {
                required: true,
            }    
        },
        submitHandler: function (form) { // for demo
            $('.add_exist_member_formchecked').val('1');
        }
    });
     /* add exist employee validation*/
     $("#add_exist_employee").validate({
        rules: {
            'existmembername': {
                required: true,
            },
            'existsponsername': {
                required: true,
            },
            'existbranchname': {
                required: true,
            }
                    
        },
        submitHandler: function (form) { // for demo
            $('.add_exist_employee_formchecked').val('1');
        }
    });
      /* add exist advisor validation*/
      $("#add_exist_advisor").validate({
        rules: {
            'existmembername': {
                required: true,
            },
            'existsponsername': {
                required: true,
            },
            'existbranchname': {
                required: true,
            }                    
        },
        submitHandler: function (form) { // for demo
            $('.add_exist_advisor_formchecked').val('1');
        }
    });
    /* advisor validation*/
    var navListItems = $('div.setup-panel div a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn');
    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function () {
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find(".firstname,.lastname,.regdate,.dob,.contact,.pan,.aadhar,.branch,.state,.city,.password"),
            isValid = true;

        $(".form-group").removeClass("error");
        for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');


    $('.contact').on('keypress', function (e) {

        var $this = $(this);
        var regex = new RegExp("^[0-9\b]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        // for 10 digit number only
        if ($this.val().length > 9) {
            e.preventDefault();
            return false;

        }

        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });
    /* for Aadhar Number validation*/
    $('.aadhar').on('keypress', function (e) {

        var $this = $(this);
        var regex = new RegExp("^[0-9\b]+$");
        var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        // for 12 digit number only
        if ($this.val().length > 11) {
            e.preventDefault();
            return false;

        }

        if (regex.test(str)) {
            return true;
        }
        e.preventDefault();
        return false;
    });
    
    $('body').on('keydown', '.input_num', function (e) {

        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode == 45) || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
    /* add advisor validation*/
    $("#purch_product").validate({
        rules: {
            'product_name': {
                required: true,
            }
        },
        submitHandler: function (form) { // for demo
            $('#formchecked').val('1');
        }
    });
    /*for add new site*/
    $("#add_new_site_form").validate({

        rules: {

            'site_name': {
                required: true,
            },
            'site_size': {
                required: true,
            },
            'selling_target': {
                required: true,
            }
        },
        submitHandler: function (form) { // for demo
            $('.checked').val('1');
        }
    });
    /* add Part validation*/
    $("#addPart").validate({
        rules: {
            "partname": {
                required: true,
            },
            "part_size": {
                required: true,
            },
        },

        submitHandler: function (form) { // for demo
            $('#checked').val('1');
        }
    });
});