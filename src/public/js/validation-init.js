var Script = function () {
    //
    // $.validator.setDefaults({
    //     submitHandler: function() { alert("submitted!"); }
    // });

    $().ready(function () {
        // validate the comment form when it is submitted
        $("#commentForm").validate();

        // validate signup form on keyup and submit
        $("#signupForm").validate({
            rules: {
                organization_code: 'required',
                organization_name: 'required',
                organization_email: 'required',
                type_voucher: 'required',
                username: {
                    required: true,
                    minlength: 2
                }, discont: {
                    number: true,
                    min: 0,
                    max: 100
                },
                password: {
                    minlength: 5
                },
                confirm_password: {
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {

                    email: true
                },
                topic: {
                    required: "#newsletter:checked",
                    minlength: 2
                },
                quota: {
                    required: true,
                    min: 0
                }
            },
            messages: {
                organization_code: "Please enter organization code",
                organization_name: "Please enter organization name",
                type_voucher: "Please choose type voucher",
                discont: "Max discount 100 %",
                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname",
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 2 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
                quota: "Please enter quota voucher limit"
            }
        });

        // propose username by combining first- and lastname
        $("#username").focus(function () {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if (firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });

        var type_all = $('.type_all');
        var type_personal = $('.type_personal');

        if (type_all.checked == false && type_personal.checked == false) {
            alert("You must choise type voucher");
            return false;
        }
        var genderM = $('#male');
        var genderF = $('#female');

        if (genderM.checked == false && genderF.checked == false) {
            alert("You must select male or female");
            return false;
        }

        $('.start_date').datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function (dateText, inst) {
                $('.end_date').datepicker('option', 'minDate', new Date(dateText));
            },
        });

        $('.end_date').datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function (dateText, inst) {
                $('.start_date').datepicker('option', 'maxDate', new Date(dateText));
            }
        });

        //code to hide topic selection, disable for demo
        var newsletter = $("#newsletter");
        // newsletter topics are optional, hide at first
        var inital = newsletter.is(":checked");
        var topics = $("#newsletter_topics")[inital ? "removeClass" : "addClass"]("gray");
        var topicInputs = topics.find("input").attr("disabled", !inital);
        // show when newsletter is checked
        newsletter.click(function () {
            topics[this.checked ? "removeClass" : "addClass"]("gray");
            topicInputs.attr("disabled", !this.checked);
        });
    });


}();