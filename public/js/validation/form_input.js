// source: https: //www.codegrepper.com/code-examples/whatever/onkeypress+avoid+to+type+special+characters
$('.nosymbol').on('keypress', function (event) {
    var regex = new RegExp("^[a-zA-Z0-9]+$");
    var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
});

// $(document).ready(function() {
//     $("#nosymbol").keypress(function(e) {
//         var keyCode = e.which;
//         if (!((keyCode >= 48 && keyCode <= 57) || (keyCode >= 65 && keyCode <= 90) || (keyCode >=
//                 97 && keyCode <= 122)) && keyCode != 8 && keyCode != 32) {
//             e.preventDefault();
//         }
//     });
// });

// https://www.technologycrowds.com/2015/11/how-to-allow-only-alphabets-in-jquery.html
$(function () {
    $('.only_alphabets').keydown(function (e) {
        if (e.shiftKey || e.ctrlKey || e.altKey) {
            e.preventDefault();
        } else {
            var key = e.keyCode;
            if (!((key == 8) || (key == 32) || (key == 46) || (key >= 35 && key <= 40) || (key >=
                    65 && key <= 90))) {
                e.preventDefault();
            }
        }
    });
});



        // $("#min_support").on("keypress keyup blur", function(event) {
        //     //sumber : https://jsfiddle.net/Behseini/ue8gj52t/
        //     //this.value = this.value.replace(/[^0-9\.]/g,'');
        //     $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        //     if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        //         event.preventDefault();
        //     }
        // });

        // $("#min_confidence").on("keypress keyup blur", function(event) {
        //     $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        //     if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        //         event.preventDefault();
        //     }
        // });

